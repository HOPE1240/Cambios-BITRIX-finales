// Selector corto
const $ = selector => document.querySelector(selector);

// Elementos principales
const resultsEl = $('#results');
const statusEl = $('#status');
const buscarBtn = $('#buscar');

// Evento de búsqueda con validación de sector obligatorio
buscarBtn.addEventListener('click', async () => {
    resultsEl.innerHTML = '';
    const sectorValue = $('#sector').value.trim();

    // Validación: sector obligatorio
    if (!sectorValue) {
        statusEl.textContent = 'Por favor ingresa el sector antes de buscar.';
        $('#sector').focus();
        return;
    }

    statusEl.textContent = 'Buscando...';
    const payload = buildPayload();

    try {
        const response = await fetch('/Bitix-Iframe/api/similares.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        if (!response.ok) {
            statusEl.textContent = 'Error en la búsqueda (' + response.status + ')';
            return;
        }

        const data = await response.json();
        const properties = data.properties || [];
        render(properties);
        statusEl.textContent = properties.length
            ? `Se encontraron ${properties.length} inmuebles.`
            : 'No se encontraron resultados.';
    } catch (error) {
        statusEl.textContent = 'Error de red o servidor: ' + error.message;
    }
});

/**
 * Construye el payload para la consulta
 */
function buildPayload() {
    const getValue = sel => ($(sel)?.value ?? '').trim();

    // Mapeo de campos del formulario a payload
    const fields = [
        ['#type', 'propertyTypeCode'],
        ['#sector', 'sectorCode'],
        ['#branch', 'branchCode'],
        ['#rmin', 'fromRooms'], ['#rmax', 'toRooms'],
        ['#amin', 'fromArea'],  ['#amax', 'toArea'],
        ['#pmin', 'fromPrice'], ['#pmax', 'toPrice'],
        ['#forRent', 'forRent'], ['#onSale', 'onSale']
    ];

    const payload = { operation: 'getMatchingProperties' };

    fields.forEach(([selector, key]) => {
        const val = getValue(selector);
        if (val !== '') payload[key] = val;
    });

    return payload;
}

/**
 * Renderiza la lista de propiedades
 */
function render(list) {
    resultsEl.innerHTML = '';

    if (!list.length) {
        resultsEl.textContent = 'No hay propiedades para mostrar.';
        return;
    }

    list.forEach(pr => {
        const div = document.createElement('div');
        div.className = 'property';
        div.innerHTML = `
            <strong>${pr.PropertyType || pr.type || 'Propiedad'}</strong><br>
            Código: ${pr.propertyCode || ''}<br>
            Tipo: ${pr.PropertyType || pr.type || ''}<br>
            Sector: ${pr.Sector || pr.sector || ''}<br>
            Habitaciones: ${pr.numberOfRooms || pr.rooms || ''}<br>
            Precio: ${fmt(pr.RentValue || pr.saleValue || pr.price)}
        `;
        resultsEl.appendChild(div);
    });
}

/**
 * Formatea valores numéricos como moneda
 */
function fmt(value) {
    if (value == null || value === '') return '';
    try {
        return new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(Number(value));
    } catch {
        return value;
    }
}