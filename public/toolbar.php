<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Font Awesome CDN for professional icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap 5 CDN for professional components -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts for professional typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Professional CSS Files -->
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/modal.css">
</head>
<body>
    <div class="main-container">
        <!-- Header de la aplicación -->
        <div class="app-header">
            <div class="header-content">
                <div class="app-title">
                    <div class="app-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div>
                        <h1>Búsqueda Inteligente de Inmuebles</h1>
                        <p>Encuentra las mejores opciones para tus clientes de manera eficiente y profesional</p>
                    </div>
                </div>
                <div id="dealContext" class="deal-context" style="display: none;">
                    <span class="context-label"><i class="fas fa-file-alt"></i> Deal ID:</span>
                    <span class="context-value" id="dealIdValue">-</span>
                </div>
            </div>
        </div>

        <!-- Panel de inmuebles seleccionados (si hay) -->
        <div id="selectedSummary" class="selected-summary" style="display: none;">
            <div class="selected-summary-header">
                <h3><i class="fas fa-star"></i> Inmuebles Seleccionados</h3>
                <span id="summaryCount" class="summary-count">0</span>
            </div>
            <div id="selectedSummaryList" class="selected-summary-list"></div>
            <div class="selected-summary-actions">
                <button type="button" id="btnViewDetails" class="btn-view-details">
                    <i class="fas fa-eye"></i> Ver Detalles Completos
                </button>
                <button type="button" id="btnClearAll" class="btn-clear-all">
                    <i class="fas fa-trash"></i> Limpiar Todo
                </button>
            </div>
        </div>

        <!-- Modal Profesional con Bootstrap -->
        <div id="detailsModal" class="modal fade" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-primary text-white">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clipboard-list me-3 fs-4"></i>
                            <div>
                                <h4 class="modal-title mb-0" id="detailsModalLabel">Inmuebles Seleccionados</h4>
                                <small class="opacity-75">Resumen detallado de propiedades</small>
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body p-4">
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="alert alert-info border-0 bg-light">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Total de propiedades seleccionadas:</strong> 
                                    <span id="modalPropertyCount" class="badge bg-primary ms-2">0</span>
                                </div>
                            </div>
                        </div>
                        
                        <div id="modalPropertiesList" class="row g-4">
                            <!-- Las tarjetas de propiedades se cargarán aquí -->
                        </div>
                    </div>
                    
                    <div class="modal-footer bg-light border-0 p-4">
                        <div class="w-100 text-center">
                            <button id="exportBtn" class="btn btn-success btn-lg me-3">
                                <i class="fas fa-file-excel me-2"></i>
                                Exportar a Excel
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-lg" id="clearAllBtn">
                                <i class="fas fa-trash me-2"></i>
                                Limpiar Selección
                            </button>
                        </div>
                        <div class="w-100 mt-3">
                            <small class="text-muted d-block text-center">
                                <i class="fas fa-lightbulb me-1"></i>
                                El archivo Excel se descargará automáticamente con formato profesional de tabla
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtros organizados en grid moderno -->
        <div class="filters-container">
            <h2><i class="fas fa-search"></i> Configuración de Búsqueda Inteligente</h2>
            <p>
                <i class="fas fa-lightbulb"></i> <strong>Tip:</strong> Ajusta los filtros según las necesidades específicas de tu cliente para obtener resultados más precisos
            </p>
            
            <form id="filtro" class="filters-grid">
                <!-- Fila 1: Filtros principales -->
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="type"><i class="fas fa-home"></i> Tipo de Propiedad</label>
                        <select id="type" name="type" required>
                            <option value="APARTAMENTO" selected>Apartamento</option>
                            <option value="APARATESTUDIO">Apartaestudio</option>
                            <option value="CASA">Casa</option>
                            <option value="BODEGA">Bodega</option>
                            <option value="OFICINA">Oficina</option>
                            <option value="FINCA">Finca</option>
                            <option value="LOCAL">Local</option>
                            <option value="LOTE">Lote</option>
                            <option value="CONSULTORIO">Consultorio</option>
                            <option value="HOTEL">Hotel</option>
                            <option value="EDIFICIO">Edificio</option>
                            <option value="CABAÑA">Cabaña</option>
                            <option value="APSUITE">Aparta Suite</option>
                            <option value="SUITEHT">Suite Hot</option>
                            <option value="CASA_COM">Casa Comercial</option>
                            <option value="BURBUJA">Burbuja</option>
                            <option value="CASACAMPESTRE">Casa Campestre</option>
                            <option value="BD1">Bodega Producto</option>
                            <option value="BD2">Bodega de partes</option>
                            <option value="PRUEBA">Prueba</option>
                            <option value="1">1</option>
                            <option value="PARQUEADERO">Parqueadero</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="sector"><i class="fas fa-map-marker-alt"></i> Sector</label>
                        <input id="sector" name="sector" type="text" placeholder="Ej: Poblado, Centro, Laureles..." required />
                        <div class="error-message" id="sectorError">El sector es obligatorio</div>
                    </div>

                    <div class="filter-group">
                        <label for="branch"><i class="fas fa-building"></i> Sucursal</label>
                        <select id="branch" name="branch">
                            <option value="Todos" selected>Todas las sucursales</option>
                            <option value="POBLADO">POBLADO</option>
                            <option value="OCCIDENTE">OCCIDENTE</option>
                            <option value="BOGOTA SUR">BOGOTÁ SUR</option>
                        </select>
                    </div>
                </div>

                <!-- Fila 2: Habitaciones -->
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="rmin"><i class="fas fa-bed"></i> Habitaciones Mínimas</label>
                        <input id="rmin" name="rmin" type="number" min="0" max="20" placeholder="0" />
                        <div class="error-message" id="rminError">Debe ser un número válido</div>
                    </div>

                    <div class="filter-group">
                        <label for="rmax"><i class="fas fa-bed"></i> Habitaciones Máximas</label>
                        <input id="rmax" name="rmax" type="number" min="0" max="20" placeholder="10" />
                        <div class="error-message" id="rmaxError">Debe ser un número válido</div>
                    </div>

                    <div class="filter-group">
                        <!-- Espacio vacío para mantener la alineación -->
                    </div>
                </div>

                <!-- Fila 3: Área -->
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="amin"><i class="fas fa-expand-arrows-alt"></i> Área Mínima (m²)</label>
                        <input id="amin" name="amin" type="number" min="0" max="10000" placeholder="0" />
                        <div class="error-message" id="aminError">Debe ser un número válido</div>
                    </div>

                    <div class="filter-group">
                        <label for="amax"><i class="fas fa-expand-arrows-alt"></i> Área Máxima (m²)</label>
                        <input id="amax" name="amax" type="number" min="0" max="10000" placeholder="500" />
                        <div class="error-message" id="amaxError">Debe ser un número válido</div>
                    </div>

                    <div class="filter-group">
                        <!-- Espacio vacío para mantener la alineación -->
                    </div>
                </div>

                <!-- Fila 4: Precio -->
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="pmin"><i class="fas fa-dollar-sign"></i> Precio Mínimo</label>
                        <input id="pmin" name="pmin" type="text" placeholder="Ej: 500.000.000" data-price-input />
                        <div class="error-message" id="pminError">Debe ser un número válido</div>
                    </div>

                    <div class="filter-group">
                        <label for="pmax"><i class="fas fa-dollar-sign"></i> Precio Máximo</label>
                        <input id="pmax" name="pmax" type="text" placeholder="Ej: 1.000.000.000" data-price-input />
                        <div class="error-message" id="pmaxError">Debe ser un número válido</div>
                    </div>

                    <div class="filter-group">
                        <!-- Espacio vacío para mantener la alineación -->
                    </div>
                </div>

                <!-- Fila 5: Operaciones -->
                <div class="filter-row operations-row">
                    <div class="filter-group full-width">
                        <label><i class="fas fa-tags"></i> Tipo de Operación</label>
                        <div class="checkbox-group">
                            <label class="checkbox-item">
                                <input type="checkbox" id="forRent" name="forRent" value="T" checked>
                                <span class="checkmark"><i class="fas fa-key"></i> Arriendo</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" id="onSale" name="onSale" value="T" checked>
                                <span class="checkmark"><i class="fas fa-handshake"></i> Venta</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Botón de búsqueda -->
                <div class="search-section">
                    <button type="button" id="buscar" class="search-btn">
                        <i class="fas fa-search"></i> Buscar Inmuebles Similares
                    </button>
                    <div id="status" class="status" style="display: none;"></div>
                </div>
            </form>
        </div>

        <!-- Resultados -->
        <div id="results" class="results-container"></div>
    </div>

    <script src="//api.bitrix24.com/api/v1/"></script>
    <script>
        // Funcionalidad completa de la aplicación
        const $ = selector => document.querySelector(selector);
        const resultsEl = $('#results');
        const statusEl = $('#status');
        const buscarBtn = $('#buscar');
        let selectedProperties = JSON.parse(localStorage.getItem('selectedProperties') || '[]');

        function saveSelections() {
            localStorage.setItem('selectedProperties', JSON.stringify(selectedProperties));
            updateSelectedSummary();
        }

        // Funciones para formatear precios con separadores de miles
        function formatPrice(value) {
            // Remover caracteres no numéricos excepto dígitos
            const cleanValue = value.replace(/[^\d]/g, '');
            
            if (cleanValue === '') return '';
            
            // Agregar puntos como separadores de miles
            return cleanValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
        
        function unformatPrice(value) {
            // Remover puntos para obtener el valor numérico
            return value.replace(/\./g, '');
        }
        
        function setupPriceFormatting() {
            const priceInputs = document.querySelectorAll('[data-price-input]');
            
            priceInputs.forEach(input => {
                // Formatear al escribir
                input.addEventListener('input', function(e) {
                    const cursorPosition = e.target.selectionStart;
                    const oldValue = e.target.value;
                    const formattedValue = formatPrice(oldValue);
                    
                    e.target.value = formattedValue;
                    
                    // Mantener la posición del cursor ajustada
                    const newCursorPosition = cursorPosition + (formattedValue.length - oldValue.length);
                    e.target.setSelectionRange(newCursorPosition, newCursorPosition);
                });
                
                // Evitar caracteres no válidos
                input.addEventListener('keypress', function(e) {
                    // Permitir solo números, backspace, delete, tab, escape, enter
                    if ([8, 9, 27, 13, 46].indexOf(e.keyCode) !== -1 ||
                        // Permitir Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                        (e.keyCode === 65 && e.ctrlKey === true) ||
                        (e.keyCode === 67 && e.ctrlKey === true) ||
                        (e.keyCode === 86 && e.ctrlKey === true) ||
                        (e.keyCode === 88 && e.ctrlKey === true)) {
                        return;
                    }
                    // Asegurar que sea un número
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
                
                // Formatear al perder el foco
                input.addEventListener('blur', function(e) {
                    e.target.value = formatPrice(e.target.value);
                });
            });
        }

        function updateSelectedSummary() {
            const summarySection = $('#selectedSummary');
            const summaryCount = $('#summaryCount');
            const summaryList = $('#selectedSummaryList');
            
            if (!summarySection || !summaryCount || !summaryList) return;
            
            if (selectedProperties.length > 0) {
                summarySection.style.display = 'block';
                summaryCount.textContent = selectedProperties.length;
                
                const summaryHTML = selectedProperties.map(property => `
                    <div style="margin-bottom: 8px; padding: 8px; background: rgba(255,255,255,0.2); border-radius: 6px;">
                        <strong>${property.type}</strong> • ${property.sector}<br>
                        <i class="fas fa-dollar-sign"></i> ${property.price} • <i class="fas fa-bed"></i> ${property.rooms} hab
                    </div>
                `).join('');
                
                summaryList.innerHTML = summaryHTML;
            } else {
                summarySection.style.display = 'none';
            }
        }

        function selectProperty(propertyData) {
            const isAlreadySelected = selectedProperties.some(p => p.code === propertyData.code);
            
            if (isAlreadySelected) {
                alert('Esta propiedad ya está seleccionada.');
                return;
            }
            
            selectedProperties.push(propertyData);
            saveSelections();
            updatePropertyCards();
            alert('✅ Inmueble seleccionado: ' + propertyData.type + ' en ' + propertyData.sector);
        }

        function visualizeProperty(propertyData) {
            // Crear modal de visualización profesional
            const modalHTML = `
                <div class="modal fade" id="visualizeModal" tabindex="-1" aria-labelledby="visualizeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="visualizeModalLabel">
                                    <i class="fas fa-home"></i>
                                    Detalle del Inmueble ${propertyData.code}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="property-detail-section">
                                            <h6 class="section-title"><i class="fas fa-info-circle"></i> Información General</h6>
                                            <div class="detail-grid">
                                                <div class="detail-item">
                                                    <span class="detail-label">Código:</span>
                                                    <span class="detail-value">${propertyData.code}</span>
                                                </div>
                                                <div class="detail-item">
                                                    <span class="detail-label">Tipo:</span>
                                                    <span class="detail-value">${propertyData.type || 'No especificado'}</span>
                                                </div>
                                                <div class="detail-item">
                                                    <span class="detail-label">Sector:</span>
                                                    <span class="detail-value">${propertyData.sector || 'No especificado'}</span>
                                                </div>
                                                <div class="detail-item">
                                                    <span class="detail-label">Operación:</span>
                                                    <span class="detail-value">${propertyData.operation || 'No especificado'}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="property-detail-section">
                                            <h6 class="section-title"><i class="fas fa-dollar-sign"></i> Información Financiera</h6>
                                            <div class="detail-grid">
                                                <div class="detail-item">
                                                    <span class="detail-label">Precio Venta:</span>
                                                    <span class="detail-value price-highlight">${fmt(propertyData.sale_price)}</span>
                                                </div>
                                                <div class="detail-item">
                                                    <span class="detail-label">Precio Arriendo:</span>
                                                    <span class="detail-value price-highlight">${fmt(propertyData.rent_price)}</span>
                                                </div>
                                                <div class="detail-item">
                                                    <span class="detail-label">Administración:</span>
                                                    <span class="detail-value">${fmt(propertyData.admin_price)}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="property-detail-section">
                                            <h6 class="section-title"><i class="fas fa-home"></i> Características</h6>
                                            <div class="detail-grid">
                                                <div class="detail-item">
                                                    <span class="detail-label">Habitaciones:</span>
                                                    <span class="detail-value">${propertyData.rooms || 'No especificado'}</span>
                                                </div>
                                                <div class="detail-item">
                                                    <span class="detail-label">Baños:</span>
                                                    <span class="detail-value">${propertyData.bathrooms || 'No especificado'}</span>
                                                </div>
                                                <div class="detail-item">
                                                    <span class="detail-label">Garajes:</span>
                                                    <span class="detail-value">${propertyData.garages || 'No especificado'}</span>
                                                </div>
                                                <div class="detail-item">
                                                    <span class="detail-label">Área:</span>
                                                    <span class="detail-value">${propertyData.area ? propertyData.area + ' m²' : 'No especificado'}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="property-detail-section">
                                            <h6 class="section-title"><i class="fas fa-map-marker-alt"></i> Ubicación</h6>
                                            <div class="detail-grid">
                                                <div class="detail-item full-width">
                                                    <span class="detail-label">Dirección:</span>
                                                    <span class="detail-value">${propertyData.address || 'No especificada'}</span>
                                                </div>
                                                <div class="detail-item">
                                                    <span class="detail-label">Ciudad:</span>
                                                    <span class="detail-value">${propertyData.city || 'No especificada'}</span>
                                                </div>
                                                <div class="detail-item">
                                                    <span class="detail-label">Estrato:</span>
                                                    <span class="detail-value">${propertyData.stratum || 'No especificado'}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times"></i> Cerrar
                                </button>
                                <button type="button" class="btn btn-success" onclick="selectProperty(${JSON.stringify(propertyData).replace(/"/g, '&quot;')}); bootstrap.Modal.getInstance(document.getElementById('visualizeModal')).hide();">
                                    <i class="fas fa-check"></i> Seleccionar Inmueble
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Remover modal anterior si existe
            const existingModal = document.getElementById('visualizeModal');
            if (existingModal) {
                existingModal.remove();
            }
            
            // Añadir modal al DOM
            document.body.insertAdjacentHTML('beforeend', modalHTML);
            
            // Mostrar modal
            const modal = new bootstrap.Modal(document.getElementById('visualizeModal'));
            modal.show();
            
            // Limpiar modal cuando se cierre
            document.getElementById('visualizeModal').addEventListener('hidden.bs.modal', function () {
                this.remove();
            });
        }

        function updatePropertyCards() {
            document.querySelectorAll('.property-card').forEach(card => {
                const selectBtn = card.querySelector('.select-btn');
                if (selectBtn) {
                    const propertyData = JSON.parse(selectBtn.getAttribute('data-property'));
                    const isSelected = selectedProperties.some(p => p.code === propertyData.code);
                    
                    if (isSelected) {
                        card.style.opacity = '0.7';
                        selectBtn.textContent = '✅ Ya Seleccionado';
                        selectBtn.disabled = true;
                        selectBtn.style.background = '#cbd5e0';
                    } else {
                        card.style.opacity = '1';
                        selectBtn.textContent = '✅ Seleccionar Inmueble';
                        selectBtn.disabled = false;
                        selectBtn.style.background = '#48bb78';
                    }
                }
            });
        }

        function validateForm() {
            let isValid = true;
            const errors = [];

            const sector = $('#sector').value.trim();
            if (!sector) {
                $('#sectorError').style.display = 'block';
                $('#sector').style.borderColor = '#e53e3e';
                errors.push('El sector es obligatorio');
                isValid = false;
            } else {
                $('#sectorError').style.display = 'none';
                $('#sector').style.borderColor = '#e2e8f0';
            }

            // Validar precios
            const pmin = $('#pmin').value.trim();
            const pmax = $('#pmax').value.trim();
            
            if (pmin && isNaN(unformatPrice(pmin))) {
                $('#pminError').style.display = 'block';
                $('#pmin').style.borderColor = '#e53e3e';
                errors.push('El precio mínimo debe ser un número válido');
                isValid = false;
            } else {
                $('#pminError').style.display = 'none';
                $('#pmin').style.borderColor = '#e2e8f0';
            }
            
            if (pmax && isNaN(unformatPrice(pmax))) {
                $('#pmaxError').style.display = 'block';
                $('#pmax').style.borderColor = '#e53e3e';
                errors.push('El precio máximo debe ser un número válido');
                isValid = false;
            } else {
                $('#pmaxError').style.display = 'none';
                $('#pmax').style.borderColor = '#e2e8f0';
            }
            
            // Validar que precio mínimo no sea mayor que máximo
            if (pmin && pmax) {
                const minPrice = parseInt(unformatPrice(pmin));
                const maxPrice = parseInt(unformatPrice(pmax));
                if (minPrice > maxPrice) {
                    $('#pmaxError').style.display = 'block';
                    $('#pmax').style.borderColor = '#e53e3e';
                    errors.push('El precio máximo debe ser mayor que el precio mínimo');
                    isValid = false;
                }
            }

            const forRent = $('#forRent').checked;
            const onSale = $('#onSale').checked;
            if (!forRent && !onSale) {
                errors.push('Debes seleccionar al menos una opción: Arriendo o Venta');
                isValid = false;
            }

            if (errors.length > 0) {
                showStatus('❌ ' + errors.join('. '), 'error');
            }

            return isValid;
        }

        function showStatus(message, type) {
            statusEl.style.display = 'block';
            statusEl.textContent = message;
            statusEl.className = 'status ' + type;
            
            if (type === 'success') {
                setTimeout(function() {
                    statusEl.style.display = 'none';
                }, 5000);
            }
        }

        function buildPayload() {
            const getValue = function(sel) { return ($(sel) && $(sel).value || '').trim(); };
            const getChecked = function(sel) { return $(sel) && $(sel).checked; };
            const getPriceValue = function(sel) { 
                const value = getValue(sel);
                return value ? unformatPrice(value) : '';
            };

            const payload = { operation: 'getMatchingProperties' };

            const textFields = [
                ['#type', 'propertyTypeCode'],
                ['#sector', 'sectorCode'],
                ['#branch', 'branchCode'],
                ['#rmin', 'fromRooms'], 
                ['#rmax', 'toRooms'],
                ['#amin', 'fromArea'],  
                ['#amax', 'toArea']
            ];

            // Campos de precio - usar función especial para desformatear
            const priceFields = [
                ['#pmin', 'fromPrice'], 
                ['#pmax', 'toPrice']
            ];

            textFields.forEach(function(field) {
                const selector = field[0];
                const key = field[1];
                const val = getValue(selector);
                if (val !== '' && !(key === 'branchCode' && val === 'Todos')) {
                    payload[key] = val;
                }
            });

            priceFields.forEach(function(field) {
                const selector = field[0];
                const key = field[1];
                const val = getPriceValue(selector);
                if (val !== '') {
                    payload[key] = val;
                }
            });

            const forRent = getChecked('#forRent');
            const onSale = getChecked('#onSale');
            
            payload.forRent = forRent ? 'T' : 'F';
            payload.onSale = onSale ? 'T' : 'F';

            return payload;
        }

        function render(list) {
            resultsEl.innerHTML = '';

            if (!list.length) {
                resultsEl.innerHTML = `
                    <div style="text-align: center; padding: 60px 20px; color: #718096; background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                        <div style="font-size: 3rem; margin-bottom: 20px;">🔍</div>
                        <h3 style="color: #2d3748; margin-bottom: 12px;">¡No encontramos coincidencias exactas!</h3>
                        <p style="margin-bottom: 16px;">💡 <strong>Sugerencias para mejorar tu búsqueda:</strong></p>
                        <ul style="text-align: left; display: inline-block; color: #4a5568;">
                            <li>🏠 Prueba con un tipo de propiedad diferente</li>
                            <li>📍 Amplía el área de búsqueda o cambia el sector</li>
                            <li>💰 Ajusta el rango de precio</li>
                            <li><i class="fas fa-bed"></i> Modifica el número de habitaciones</li>
                        </ul>
                    </div>
                `;
                return;
            }

            const header = document.createElement('div');
            const successMessage = list.length === 1 ? 
                'Encontramos 1 inmueble que coincide con los criterios de tu cliente' :
                `Encontramos ${list.length} inmuebles perfectos para las necesidades de tu cliente`;
            
            header.innerHTML = `
                <div style="background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); color: white; padding: 20px; border-radius: 12px; margin-bottom: 24px; text-align: center;">
                    <h2 style="margin: 0; font-size: 1.3rem; font-weight: 700;">${successMessage}</h2>
                    <p style="margin: 8px 0 0 0; opacity: 0.9;">💡 Revisa cada opción y selecciona las más adecuadas para presentar a tu cliente</p>
                </div>
            `;
            resultsEl.appendChild(header);

            const gridContainer = document.createElement('div');
            gridContainer.style.display = 'grid';
            gridContainer.style.gridTemplateColumns = 'repeat(auto-fill, minmax(280px, 1fr))';
            gridContainer.style.gap = '16px';
            
            // Hacer responsive para móviles
            if (window.innerWidth <= 768) {
                gridContainer.style.gridTemplateColumns = '1fr';
                gridContainer.style.gap = '12px';
            }

            list.forEach(function(pr, index) {
                const div = document.createElement('div');
                div.className = 'property-card';
                
                // Professional card styling
                const isMobile = window.innerWidth <= 768;
                div.style.cssText = `
                    background: var(--surface-color);
                    border: 1px solid var(--border-color);
                    border-radius: var(--radius-lg);
                    padding: ${isMobile ? '20px' : '24px'};
                    box-shadow: var(--shadow-md);
                    transition: all 0.2s ease;
                    width: 100%;
                    max-width: 100%;
                    position: relative;
                `;
                
                const operations = [];
                if (pr.forRent === 'T' || pr.RentValue) operations.push('Arriendo');
                if (pr.onSale === 'T' || pr.saleValue) operations.push('Venta');
                const operationType = operations.length > 0 ? operations.join(' / ') : 'No especificado';
                
                let mainPrice = '';
                if (pr.saleValue && pr.saleValue > 0) {
                    mainPrice = fmt(pr.saleValue);
                } else if (pr.RentValue && pr.RentValue > 0) {
                    mainPrice = fmt(pr.RentValue);
                } else {
                    mainPrice = 'Precio no disponible';
                }

                const propertyData = {
                    type: pr.PropertyType || pr.type || 'Propiedad',
                    code: pr.propertyCode || 'PROP-' + (index + 1),
                    sector: pr.Sector || pr.sector || 'No especificado',
                    rooms: pr.numberOfRooms || pr.rooms || 'No especificado',
                    price: mainPrice,
                    operation: operationType
                };

                div.innerHTML = `
                    <div style="border-bottom: 1px solid var(--border-color); padding-bottom: 12px; margin-bottom: 16px;">
                        <h3 style="margin: 0; color: var(--text-primary); font-size: clamp(1rem, 2.5vw, 1.25rem); line-height: 1.4; font-weight: 600;">${propertyData.type}</h3>
                        <span style="color: var(--text-secondary); font-size: clamp(0.75rem, 2vw, 0.875rem); font-weight: 500;">#${propertyData.code}</span>
                    </div>
                    
                    <div style="margin-bottom: 16px; display: flex; flex-direction: column; gap: 8px;">
                        <div style="font-size: clamp(0.8rem, 2.2vw, 0.875rem); display: flex; align-items: center; gap: 8px; color: var(--text-secondary);">
                            <i class="fas fa-map-marker-alt" style="color: var(--primary-color); width: 16px;"></i>
                            <strong style="color: var(--text-primary);">Sector:</strong>
                            <span style="word-break: break-word;">${propertyData.sector}</span>
                        </div>
                        <div style="font-size: clamp(0.8rem, 2.2vw, 0.875rem); display: flex; align-items: center; gap: 8px; color: var(--text-secondary);">
                            <i class="fas fa-bed" style="color: var(--primary-color); width: 16px;"></i>
                            <strong style="color: var(--text-primary);">Habitaciones:</strong>
                            <span>${propertyData.rooms}</span>
                        </div>
                        <div style="font-size: clamp(0.8rem, 2.2vw, 0.875rem); display: flex; align-items: center; gap: 8px; color: var(--text-secondary);">
                            <i class="fas fa-tags" style="color: var(--primary-color); width: 16px;"></i>
                            <strong style="color: var(--text-primary);">Operación:</strong>
                            <span>${operationType}</span>
                        </div>
                    </div>
                    
                    <div style="font-size: clamp(1rem, 3vw, 1.25rem); font-weight: 700; color: var(--primary-color); margin-bottom: 16px; text-align: center; padding: 12px; background: var(--background-color); border-radius: var(--radius-md); border: 1px solid var(--border-color);">
                        <i class="fas fa-dollar-sign" style="margin-right: 4px;"></i>${mainPrice}
                    </div>
                    
                    <div style="display: flex; gap: 8px; flex-direction: column;">
                        <button class="select-btn" data-property='${JSON.stringify(propertyData)}' 
                                onclick="selectProperty(${JSON.stringify(propertyData).replace(/"/g, '&quot;')})"
                                style="width: 100%; padding: 12px 16px; background: var(--success-color); color: white; border: none; border-radius: var(--radius-md); font-weight: 600; cursor: pointer; font-size: clamp(0.875rem, 2.5vw, 0.95rem); min-height: 48px; touch-action: manipulation; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 8px;">
                            <i class="fas fa-check"></i> Seleccionar Inmueble
                        </button>
                        
                        <button class="visualize-btn" data-property='${JSON.stringify(propertyData)}' 
                                onclick="visualizeProperty(${JSON.stringify(propertyData).replace(/"/g, '&quot;')})"
                                style="width: 100%; padding: 12px 16px; background: var(--primary-color); color: white; border: none; border-radius: var(--radius-md); font-weight: 600; cursor: pointer; font-size: clamp(0.875rem, 2.5vw, 0.95rem); min-height: 48px; touch-action: manipulation; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 8px;">
                            <i class="fas fa-eye"></i> Visualizar Inmueble
                        </button>
                    </div>
                `;
                
                gridContainer.appendChild(div);
            });

            resultsEl.appendChild(gridContainer);
            setTimeout(updatePropertyCards, 100);
        }

        function fmt(value) {
            if (value == null || value === '' || value === 0) return 'No disponible';
            try {
                return new Intl.NumberFormat('es-CO', { 
                    style: 'currency', 
                    currency: 'COP',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(Number(value));
            } catch (e) {
                return value;
            }
        }

        // Evento de búsqueda
        buscarBtn.addEventListener('click', function() {
            resultsEl.innerHTML = '';
            
            if (!validateForm()) {
                return;
            }

            buscarBtn.disabled = true;
            buscarBtn.classList.add('loading');
            buscarBtn.innerHTML = '⏳ Analizando tu búsqueda...';
            showStatus('🔍 Conectando con la base de datos de Mobilia...', 'loading');
            
            const payload = buildPayload();

            fetch(window.location.origin + '/Bitrix-Iframe/api/similares.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Error HTTP ' + response.status + ': ' + response.statusText);
                }
                return response.json();
            })
            .then(function(data) {
                const properties = data.properties || [];
                
                render(properties);
                
                if (properties.length > 0) {
                    showStatus('✅ ¡Búsqueda completada! Se encontraron ' + properties.length + ' inmuebles similares.', 'success');
                } else {
                    showStatus('ℹ️ No se encontraron inmuebles con los criterios especificados.', 'info');
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
                showStatus('❌ Error al realizar la búsqueda: ' + error.message, 'error');
            })
            .finally(function() {
                buscarBtn.disabled = false;
                buscarBtn.classList.remove('loading');
                buscarBtn.innerHTML = '🔍 Buscar Inmuebles Similares';
            });
        });

        // Funcionalidad del modal profesional con Bootstrap
        function openDetailsModal() {
            if (selectedProperties.length === 0) {
                alert('No hay inmuebles seleccionados para mostrar.');
                return;
            }

            const modalList = $('#modalPropertiesList');
            const modalCount = $('#modalPropertyCount');
            
            // Actualizar contador
            modalCount.textContent = selectedProperties.length;
            
            // Crear tarjetas profesionales para cada propiedad
            const propertiesHTML = selectedProperties.map((property, index) => `
                <div class="col-lg-6 col-xl-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-light border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0 text-primary">
                                    <i class="fas fa-home me-2"></i>
                                    ${property.type || 'Propiedad'}
                                </h5>
                                <span class="badge bg-primary">
                                    #${property.code || 'N/A'}
                                </span>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="row g-3 mb-3">
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        <small class="text-muted me-2">Sector:</small>
                                        <strong>${property.sector || 'No especificado'}</strong>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-bed text-primary me-2"></i>
                                        <small class="text-muted me-2">Habitaciones:</small>
                                        <strong>${property.rooms || 'N/E'}</strong>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-tags text-primary me-2"></i>
                                        <small class="text-muted me-2">Operación:</small>
                                        <strong>${property.operation || 'N/E'}</strong>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center p-3 bg-light rounded">
                                <div class="h5 text-success mb-0">
                                    <i class="fas fa-dollar-sign me-1"></i>
                                    ${property.price || 'No disponible'}
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-transparent border-0">
                            <button class="btn btn-outline-danger btn-sm w-100" onclick="removeProperty('${property.code}')">
                                <i class="fas fa-times me-1"></i>
                                Quitar de selección
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
            
            modalList.innerHTML = propertiesHTML;
            
            // Usar Bootstrap modal
            const bootstrapModal = new bootstrap.Modal($('#detailsModal'));
            bootstrapModal.show();
        }

        function closeDetailsModal() {
            const modal = bootstrap.Modal.getInstance($('#detailsModal'));
            if (modal) {
                modal.hide();
            }
        }

        function removeProperty(propertyCode) {
            selectedProperties = selectedProperties.filter(p => p.code !== propertyCode);
            saveSelections();
            openDetailsModal(); // Refresh modal content
        }

        function clearAllProperties() {
            if (confirm('¿Estás seguro de que quieres limpiar todas las selecciones?')) {
                selectedProperties = [];
                saveSelections();
                closeDetailsModal();
            }
        }

        function exportToExcel() {
            if (selectedProperties.length === 0) {
                alert('No hay inmuebles seleccionados para exportar.');
                return;
            }

            // Crear contenido CSV para Excel
            const headers = ['Tipo de Propiedad', 'Código', 'Sector', 'Habitaciones', 'Operación', 'Precio'];
            const csvContent = [
                headers.join(','),
                ...selectedProperties.map(property => [
                    `"${property.type || 'No especificado'}"`,
                    `"${property.code || 'N/A'}"`,
                    `"${property.sector || 'No especificado'}"`,
                    `"${property.rooms || 'No especificado'}"`,
                    `"${property.operation || 'No especificado'}"`,
                    `"${property.price || 'No disponible'}"`
                ].join(','))
            ].join('\n');

            // Agregar BOM para caracteres especiales
            const BOM = '\uFEFF';
            const csvWithBOM = BOM + csvContent;

            // Crear y descargar archivo
            const blob = new Blob([csvWithBOM], { type: 'text/csv;charset=utf-8;' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = `inmuebles-seleccionados-${new Date().toISOString().split('T')[0]}.csv`;
            link.click();
            URL.revokeObjectURL(url);

            alert('✅ Archivo Excel exportado exitosamente!\n📊 Abre el archivo con Excel para ver la tabla completa.');
        }

        // Inicialización
        document.addEventListener('DOMContentLoaded', function() {
            // Detección de dispositivo móvil
            const isMobile = window.innerWidth <= 768 || /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            
            if (isMobile) {
                // Optimizaciones específicas para móvil
                document.body.style.fontSize = '16px'; // Prevenir zoom en iOS
                
                // Mejorar scrolling en iOS
                document.body.style.webkitOverflowScrolling = 'touch';
                
                // Agregar clase móvil para CSS específico
                document.documentElement.classList.add('mobile-device');
            }
            
            updateSelectedSummary();
            
            // Inicializar formateo de precios
            setupPriceFormatting();
            
            // Event listeners para el modal
            const btnViewDetails = $('#btnViewDetails');
            const btnClearAll = $('#clearAllBtn'); // Nuevo ID del modal Bootstrap
            const exportBtn = $('#exportBtn');

            if (btnViewDetails) {
                btnViewDetails.addEventListener('click', openDetailsModal);
            }

            if (btnClearAll) {
                btnClearAll.addEventListener('click', clearAllProperties);
            }

            if (exportBtn) {
                exportBtn.addEventListener('click', exportToExcel);
            }

            // Cerrar modal al hacer clic fuera
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeDetailsModal();
                    }
                });
            }

            // Cerrar modal con ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeDetailsModal();
                }
            });
            
            if (typeof BX24 !== 'undefined') {
                BX24.init(function(){
                    console.log('✅ BX24 API cargada correctamente');
                    
                    BX24.placement.info(function(ctx){
                        if (ctx.options && ctx.options.ID) {
                            const dealId = ctx.options.ID;
                            document.getElementById('dealContext').style.display = 'block';
                            document.getElementById('dealIdValue').textContent = dealId;
                        }
                    });
                });
            }

            // Función para hacer el grid responsive
            function updateGridResponsiveness() {
                const grids = document.querySelectorAll('.results-container > div:last-child');
                grids.forEach(grid => {
                    if (window.innerWidth <= 768) {
                        grid.style.gridTemplateColumns = '1fr';
                        grid.style.gap = '12px';
                    } else if (window.innerWidth <= 992) {
                        grid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(280px, 1fr))';
                        grid.style.gap = '16px';
                    } else {
                        grid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(300px, 1fr))';
                        grid.style.gap = '20px';
                    }
                });
            }

            // Event listener para resize
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(updateGridResponsiveness, 100);
            });
        });
    </script>
    
    <!-- Bootstrap 5 JavaScript CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>