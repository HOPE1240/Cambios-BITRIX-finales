// Selector corto
const $ = selector => document.querySelector(selector);

// Elementos principales
const resultsEl = $('#results');
const statusEl = $('#status');
const buscarBtn = $('#buscar');

// Sistema de inmuebles seleccionados
let selectedProperties = JSON.parse(localStorage.getItem('selectedProperties') || '[]');

// Función para guardar selecciones
function saveSelections() {
    localStorage.setItem('selectedProperties', JSON.stringify(selectedProperties));
    updateSelectedSummary(); // Solo actualizar el resumen, no el header
}

// Función para actualizar el resumen de selecciones en la vista principal
function updateSelectedSummary() {
    const summarySection = $('#selectedSummary');
    const summaryCount = $('#summaryCount');
    const summaryList = $('#selectedSummaryList');
    
    if (!summarySection || !summaryCount || !summaryList) return;
    
    if (selectedProperties.length > 0) {
        // Mostrar la sección
        summarySection.style.display = 'block';
        summaryCount.textContent = selectedProperties.length;
        
        // Crear el HTML del listado
        const summaryHTML = selectedProperties.map(property => `
            <div class="summary-item">
                <strong>${property.type}</strong> • ${property.sector}<br>
                💰 ${property.price} • 🛏️ ${property.rooms} hab
            </div>
        `).join('');
        
        summaryList.innerHTML = summaryHTML;
    } else {
        // Ocultar la sección si no hay selecciones
        summarySection.style.display = 'none';
    }
}

// Función para mostrar modal personalizado
function showModal(title, message, propertyData) {
    const modal = $('#confirmModal');
    const modalTitle = $('#modalTitle');
    const modalMessage = $('#modalMessage');
    const modalPropertyInfo = $('#modalPropertyInfo');
    
    modalTitle.textContent = title;
    modalMessage.textContent = message;
    
    if (propertyData) {
        modalPropertyInfo.innerHTML = `
            <strong>${propertyData.type}</strong><br>
            📍 ${propertyData.sector}<br>
            🛏️ ${propertyData.rooms} habitaciones<br>
            💰 ${propertyData.price}
        `;
    }
    
    modal.style.display = 'flex';
    
    // Event listeners para los botones del modal
    $('#modalContinue').onclick = () => {
        modal.style.display = 'none';
    };
    
    $('#modalFinish').onclick = () => {
        modal.style.display = 'none';
        showSelectedPanel();
    };
}

// Función para mostrar el panel de selecciones
function showSelectedPanel() {
    $('#selectedPanel').style.display = 'block';
    updateSelectedPanel();
}

// Función para ocultar el panel de selecciones
function hideSelectedPanel() {
    $('#selectedPanel').style.display = 'none';
}

// Función para actualizar el panel de selecciones
function updateSelectedPanel() {
    const selectedList = $('#selectedList');
    const selectedCount = $('#selectedCount');
    
    selectedCount.textContent = selectedProperties.length;
    
    if (selectedProperties.length === 0) {
        selectedList.innerHTML = `
            <div style="text-align: center; padding: 60px 20px; color: #718096;">
                <div style="font-size: 3rem; margin-bottom: 20px;">🏠</div>
                <h3>No hay inmuebles seleccionados</h3>
                <p>Realiza una búsqueda y selecciona inmuebles para agregarlos aquí.</p>
            </div>
        `;
        return;
    }
    
    selectedList.innerHTML = selectedProperties.map((property, index) => `
        <div class="selected-item">
            <div class="selected-item-header">
                <span class="selected-item-title">${property.type} - ${property.sector}</span>
                <button class="remove-selected" onclick="removeSelection(${index})">×</button>
            </div>
            <div class="property-details">
                <div class="detail-row">
                    <span class="detail-label">📍 Sector:</span>
                    <span class="detail-value">${property.sector}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">🛏️ Habitaciones:</span>
                    <span class="detail-value">${property.rooms}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">🏷️ Operación:</span>
                    <span class="detail-value">${property.operation}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">💰 Precio:</span>
                    <span class="detail-value">${property.price}</span>
                </div>
            </div>
        </div>
    `).join('');
}

// Función para remover una selección
function removeSelection(index) {
    selectedProperties.splice(index, 1);
    saveSelections();
    updateSelectedPanel();
    updatePropertyCards(); // Actualizar el estado visual de las tarjetas
}

// Función para limpiar todas las selecciones
function clearAllSelections() {
    if (confirm('¿Estás seguro de que quieres eliminar todas las selecciones?')) {
        selectedProperties = [];
        saveSelections();
        updateSelectedPanel();
        updatePropertyCards();
    }
}

// Función para actualizar el estado visual de las tarjetas
function updatePropertyCards() {
    document.querySelectorAll('.property-card').forEach(card => {
        const selectBtn = card.querySelector('.select-btn');
        if (selectBtn) {
            const propertyData = JSON.parse(selectBtn.getAttribute('data-property'));
            const isSelected = selectedProperties.some(p => p.code === propertyData.code);
            
            if (isSelected) {
                card.classList.add('selected');
                selectBtn.textContent = '✅ Ya Seleccionado';
                selectBtn.disabled = true;
                
                // Agregar indicador visual
                if (!card.querySelector('.selection-indicator')) {
                    const indicator = document.createElement('div');
                    indicator.className = 'selection-indicator';
                    indicator.textContent = '✓';
                    card.style.position = 'relative';
                    card.appendChild(indicator);
                }
            } else {
                card.classList.remove('selected');
                selectBtn.textContent = '✅ Seleccionar Inmueble';
                selectBtn.disabled = false;
                
                // Remover indicador visual
                const indicator = card.querySelector('.selection-indicator');
                if (indicator) indicator.remove();
            }
        }
    });
}

// Event listeners para el panel de selecciones
document.addEventListener('DOMContentLoaded', () => {
    $('#clearAll').onclick = clearAllSelections;
    $('#backToSearch').onclick = hideSelectedPanel;
    // sendToBitrix se configurará en index.php después de definir la función
    
    // Actualizar resumen al cargar la página
    updateSelectedSummary();
});

// Función de validación completa
function validateForm() {
    let isValid = true;
    const errors = [];

    // Validar sector obligatorio
    const sector = $('#sector').value.trim();
    if (!sector) {
        document.getElementById('sectorError').style.display = 'block';
        $('#sector').style.borderColor = '#e53e3e';
        errors.push('El sector es obligatorio');
        isValid = false;
    } else {
        document.getElementById('sectorError').style.display = 'none';
        $('#sector').style.borderColor = '#e2e8f0';
    }

    // Validar que al menos una opción de operación esté seleccionada
    const forRent = $('#forRent').checked;
    const onSale = $('#onSale').checked;
    if (!forRent && !onSale) {
        errors.push('Debes seleccionar al menos una opción: Arriendo o Venta');
        isValid = false;
    }

    // Mostrar errores generales
    if (errors.length > 0) {
        showStatus('❌ ' + errors.join('. '), 'error');
    }

    return isValid;
}

// Función para mostrar estados
function showStatus(message, type = 'info') {
    statusEl.style.display = 'block';
    statusEl.textContent = message;
    statusEl.className = `status ${type}`;
    
    // Auto-ocultar después de 5 segundos si es exitoso
    if (type === 'success') {
        setTimeout(() => {
            statusEl.style.display = 'none';
        }, 5000);
    }
}

// Evento de búsqueda mejorado
buscarBtn.addEventListener('click', async () => {
    // Limpiar resultados anteriores
    resultsEl.innerHTML = '';
    
    // Validar formulario
    if (!validateForm()) {
        return;
    }

    // Indicar que está buscando
    buscarBtn.disabled = true;
    buscarBtn.innerHTML = '⏳ Buscando...';
    showStatus('🔍 Realizando búsqueda en Mobilia...', 'info');
    
    const payload = buildPayload();

    try {
        // URL absoluta que siempre funcione
        const apiUrl = `${window.location.origin}/Bitrix-Iframe/api/similares.php`;
        console.log('Haciendo petición a:', apiUrl);
        console.log('Payload:', payload);
        
        const response = await fetch(apiUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        if (!response.ok) {
            throw new Error(`Error HTTP ${response.status}: ${response.statusText}`);
        }

        const data = await response.json();
        const properties = data.properties || [];
        
        // Debug temporal - ver qué campos están disponibles
        if (properties.length > 0) {
            console.log('Campos disponibles en primera propiedad:', Object.keys(properties[0]));
            console.log('Primera propiedad completa:', properties[0]);
        }
        
        render(properties);
        
        if (properties.length > 0) {
            showStatus(`✅ ¡Búsqueda completada! Se encontraron ${properties.length} inmuebles similares.`, 'success');
        } else {
            showStatus('ℹ️ No se encontraron inmuebles con los criterios especificados. Intenta ajustar los filtros.', 'info');
        }
        
    } catch (error) {
        console.error('Error:', error);
        showStatus(`❌ Error al realizar la búsqueda: ${error.message}`, 'error');
    } finally {
        // Restaurar botón
        buscarBtn.disabled = false;
        buscarBtn.innerHTML = '🔍 Buscar Inmuebles Similares';
    }
});

/**
 * Construye el payload para la consulta
 */
function buildPayload() {
    const getValue = sel => ($(sel)?.value ?? '').trim();
    const getChecked = sel => $(sel)?.checked;

    // Mapeo de campos del formulario a payload
    const payload = { operation: 'getMatchingProperties' };

    // Campos de texto y selectores
    const textFields = [
        ['#type', 'propertyTypeCode'],
        ['#sector', 'sectorCode'],
        ['#branch', 'branchCode'],
        ['#rmin', 'fromRooms'], 
        ['#rmax', 'toRooms'],
        ['#amin', 'fromArea'],  
        ['#amax', 'toArea'],
        ['#pmin', 'fromPrice'], 
        ['#pmax', 'toPrice']
    ];

    textFields.forEach(([selector, key]) => {
        const val = getValue(selector);
        // No incluir branchCode si el valor es "Todos"
        if (val !== '' && !(key === 'branchCode' && val === 'Todos')) {
            payload[key] = val;
        }
    });

    // Manejo especial para checkboxes
    const forRent = getChecked('#forRent');
    const onSale = getChecked('#onSale');
    
    payload.forRent = forRent ? 'T' : 'F';
    payload.onSale = onSale ? 'T' : 'F';

    return payload;
}

/**
 * Renderiza la lista de propiedades con diseño mejorado
 */
function render(list) {
    resultsEl.innerHTML = '';

    if (!list.length) {
        resultsEl.innerHTML = `
            <div class="no-results">
                <div class="no-results-icon">🏠</div>
                <h3>No se encontraron propiedades</h3>
                <p>Intenta ajustar los criterios de búsqueda para obtener más resultados.</p>
            </div>
        `;
        return;
    }

    // Crear encabezado de resultados
    const header = document.createElement('div');
    header.className = 'results-header';
    header.innerHTML = `
        <h2>📋 Resultados de Búsqueda</h2>
        <span class="results-count">${list.length} inmueble${list.length !== 1 ? 's' : ''} encontrado${list.length !== 1 ? 's' : ''}</span>
    `;
    resultsEl.appendChild(header);

    // Crear contenedor de grid para las propiedades
    const gridContainer = document.createElement('div');
    gridContainer.className = 'properties-grid';

    list.forEach((pr, index) => {
        const div = document.createElement('div');
        div.className = 'property-card';
        
        // Determinar tipo de operación
        const operations = [];
        if (pr.forRent === 'T' || pr.RentValue) operations.push('Arriendo');
        if (pr.onSale === 'T' || pr.saleValue) operations.push('Venta');
        
        const operationType = operations.length > 0 ? operations.join(' / ') : 'No especificado';
        
        // Precio principal (priorizar venta sobre arriendo)
        let mainPrice = '';
        if (pr.saleValue && pr.saleValue > 0) {
            mainPrice = fmt(pr.saleValue);
        } else if (pr.RentValue && pr.RentValue > 0) {
            mainPrice = fmt(pr.RentValue);
        } else if (pr.price) {
            mainPrice = fmt(pr.price);
        } else {
            mainPrice = 'Precio no disponible';
        }

        // Información del área - buscar en diferentes campos posibles
        let areaInfo = 'No especificada';
        if (pr.area && pr.area > 0) {
            areaInfo = pr.area + ' m²';
        } else if (pr.Area && pr.Area > 0) {
            areaInfo = pr.Area + ' m²';
        } else if (pr.m2 && pr.m2 > 0) {
            areaInfo = pr.m2 + ' m²';
        } else if (pr.builtArea && pr.builtArea > 0) {
            areaInfo = pr.builtArea + ' m²';
        } else if (pr.privateArea && pr.privateArea > 0) {
            areaInfo = pr.privateArea + ' m²';
        }

        // Datos para la función de selección
        const propertyData = {
            type: pr.PropertyType || pr.type || 'Propiedad',
            code: pr.propertyCode || `PROP-${index + 1}`,
            sector: pr.Sector || pr.sector || 'No especificado',
            rooms: pr.numberOfRooms || pr.rooms || 'No especificado',
            price: mainPrice,
            operation: operationType,
            area: areaInfo
        };

        div.innerHTML = `
            <div class="property-header">
                <span class="property-type">${propertyData.type}</span>
                <span class="property-code">#${propertyData.code}</span>
            </div>
            
            <div class="property-details">
                <div class="detail-row">
                    <span class="detail-label">📍 Sector:</span>
                    <span class="detail-value">${propertyData.sector}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">🛏️ Habitaciones:</span>
                    <span class="detail-value">${propertyData.rooms}</span>
                </div>
                
                ${areaInfo !== 'No especificada' ? `
                <div class="detail-row">
                    <span class="detail-label">📐 Área:</span>
                    <span class="detail-value">${areaInfo}</span>
                </div>
                ` : ''}
                
                <div class="detail-row">
                    <span class="detail-label">🏷️ Operación:</span>
                    <span class="detail-value">${operationType}</span>
                </div>
            </div>
            
            <div class="property-price">
                <span class="price-label">💰 Precio:</span>
                <span class="price-value">${mainPrice}</span>
            </div>
            
            <div class="property-actions">
                <button class="select-btn" data-property='${JSON.stringify(propertyData)}' onclick="selectProperty(${JSON.stringify(propertyData).replace(/"/g, '&quot;')})">
                    ✅ Seleccionar Inmueble
                </button>
            </div>
        `;
        
        // Verificar si ya está seleccionado
        const isSelected = selectedProperties.some(p => p.code === propertyData.code);
        if (isSelected) {
            div.classList.add('selected');
            div.innerHTML = div.innerHTML.replace('✅ Seleccionar Inmueble', '✅ Ya Seleccionado');
            div.querySelector('.select-btn').disabled = true;
            
            // Agregar indicador visual
            const indicator = document.createElement('div');
            indicator.className = 'selection-indicator';
            indicator.textContent = '✓';
            div.style.position = 'relative';
            div.appendChild(indicator);
        }
        
        gridContainer.appendChild(div);
    });

    resultsEl.appendChild(gridContainer);
    
    // Actualizar el estado visual después de renderizar
    setTimeout(updatePropertyCards, 100);
}

/**
 * Formatea valores numéricos como moneda
 */
function fmt(value) {
    if (value == null || value === '' || value === 0) return 'No disponible';
    try {
        return new Intl.NumberFormat('es-CO', { 
            style: 'currency', 
            currency: 'COP',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(Number(value));
    } catch {
        return value;
    }
}

// Exponer funciones globalmente para que estén disponibles desde index.php
window.selectedProperties = selectedProperties;
window.saveSelections = saveSelections;
window.updateSelectedPanel = updateSelectedPanel;
window.showSelectedPanel = showSelectedPanel;
window.hideSelectedPanel = hideSelectedPanel;
window.updateSelectedSummary = updateSelectedSummary;