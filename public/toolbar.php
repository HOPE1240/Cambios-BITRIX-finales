<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda de Inmuebles Similares - Acrecer</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/modal.css">
    
    <style>
        /* CSS Variables para consistencia */
        :root {
            --primary-color: #1B5E88;
            --primary-light: #2870a0;
            --primary-dark: #164a6b;
            --secondary-color: #A4C73C;
            --success-color: #48bb78;
            --danger-color: #e53e3e;
            --warning-color: #ed8936;
            --surface-color: #ffffff;
            --background-color: #f8fafc;
            --border-color: #e2e8f0;
            --text-primary: #2d3748;
            --text-secondary: #4a5568;
            --text-muted: #718096;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --radius-sm: 6px;
            --radius-md: 8px;
            --radius-lg: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--background-color);
            line-height: 1.6;
            color: var(--text-primary);
        }
        
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header profesional */
        .app-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            color: white;
            padding: 32px;
            border-radius: var(--radius-lg);
            margin-bottom: 32px;
            box-shadow: var(--shadow-md);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .app-title {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .app-icon {
            background: rgba(255, 255, 255, 0.2);
            padding: 16px;
            border-radius: var(--radius-md);
            font-size: 2rem;
        }

        .app-title h1 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .app-title p {
            opacity: 0.9;
            font-size: 1rem;
        }

        .deal-context {
            background: rgba(255, 255, 255, 0.15);
            padding: 12px 20px;
            border-radius: var(--radius-md);
            font-size: 0.9rem;
        }

        /* Panel de selecciones */
        .selected-summary {
            background: linear-gradient(135deg, var(--success-color) 0%, #38a169 100%);
            color: white;
            padding: 24px;
            border-radius: var(--radius-lg);
            margin-bottom: 32px;
            box-shadow: var(--shadow-md);
        }

        .selected-summary-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .selected-summary-header h3 {
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .summary-count {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .selected-summary-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .summary-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 16px;
            border-radius: var(--radius-md);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .selected-summary-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-view-details,
        .btn-export-excel,
        .btn-clear-all {
            padding: 12px 20px;
            border: none;
            border-radius: var(--radius-md);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-view-details {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-view-details:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .btn-export-excel {
            background: #22c55e;
            color: white;
        }

        .btn-export-excel:hover {
            background: #16a34a;
        }

        .btn-clear-all {
            background: var(--danger-color);
            color: white;
        }

        .btn-clear-all:hover {
            background: #c53030;
        }

        /* Filtros container */
        .filters-container {
            background: var(--surface-color);
            border: 1px solid var(--border-color);
            padding: 32px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 32px;
        }

        .filters-container h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .filters-container p {
            color: var(--text-secondary);
            margin-bottom: 32px;
            font-size: 0.95rem;
        }

        /* Grid de filtros */
        .filters-grid {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .filter-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 24px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group.full-width {
            grid-column: 1 / -1;
        }

        .filter-group label {
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 8px;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-group input,
        .filter-group select {
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            transition: all 0.2s ease;
            background: var(--surface-color);
            color: var(--text-primary);
        }

        .filter-group input:focus,
        .filter-group select:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
            background: var(--surface-color);
        }

        /* Checkboxes de operaciones */
        .operations-row {
            border-top: 1px solid var(--border-color);
            padding-top: 20px;
            margin-top: 10px;
        }

        .checkbox-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            background: var(--surface-color);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .checkbox-item:hover {
            border-color: var(--primary-color);
            background: var(--background-color);
        }

        .checkbox-item.checked {
            border-color: var(--secondary-color);
            background: #f0f9e8;
        }

        .checkbox-item input {
            margin: 0;
        }

        .checkmark {
            font-weight: 500;
            color: var(--text-secondary);
        }

        /* Botón de búsqueda */
        .search-btn {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            color: white;
            border: none;
            padding: 16px 32px;
            border-radius: var(--radius-md);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            max-width: 400px;
            margin: 24px auto;
            display: block;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(27, 94, 136, 0.3);
        }

        .search-btn:disabled {
            background: #94a3b8;
            cursor: not-allowed;
            transform: none;
        }

        /* Estados de carga */
        .search-btn.loading {
            position: relative;
            pointer-events: none;
        }

        .search-btn.loading::after {
            content: '';
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: translateY(-50%) rotate(360deg); }
        }

        /* Resultados */
        .results-container {
            margin-top: 32px;
        }

        .properties-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 24px;
        }

        .property-card {
            background: var(--surface-color);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-md);
            transition: all 0.2s ease;
            position: relative;
        }

        .property-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-color);
        }

        .property-card.selected {
            border-color: var(--success-color);
            background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);
        }

        .property-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .property-type {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 1.1rem;
        }

        .property-code {
            background: var(--primary-color);
            color: white;
            padding: 6px 12px;
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            font-weight: 600;
            font-family: 'Courier New', monospace;
        }

        .property-details {
            margin-bottom: 20px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #f7fafc;
        }

        .detail-row:last-child {
            margin-bottom: 0;
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .detail-value {
            color: var(--text-primary);
            font-weight: 500;
            text-align: right;
        }

        .property-price {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            padding: 16px 20px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            text-align: center;
            margin-bottom: 20px;
        }

        .price-label {
            font-weight: 600;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .price-value {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.2rem;
            margin-top: 4px;
        }

        .property-actions {
            display: flex;
            gap: 8px;
        }

        .select-btn, .visualize-btn {
            padding: 12px 16px;
            border: none;
            border-radius: var(--radius-md);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            flex: 1;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .select-btn {
            background: var(--success-color);
            color: white;
        }

        .select-btn:hover {
            background: #38a169;
        }

        .select-btn:disabled {
            background: #94a3b8;
            cursor: not-allowed;
        }

        .visualize-btn {
            background: var(--primary-color);
            color: white;
        }

        .visualize-btn:hover {
            background: var(--primary-dark);
        }

        /* Status messages */
        .status {
            margin-top: 20px;
            padding: 16px 20px;
            border-radius: var(--radius-md);
            text-align: center;
            font-weight: 500;
            display: none;
        }

        .status.loading {
            background: #e0f2fe;
            color: #0277bd;
            border: 1px solid #b3e5fc;
        }

        .status.success {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        .status.error {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-container {
                padding: 16px;
            }
            
            .filter-row {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            
            .checkbox-group {
                flex-direction: column;
                gap: 12px;
            }
            
            .selected-summary-actions {
                flex-direction: column;
            }
            
            .btn-view-details, 
            .btn-export-excel, 
            .btn-clear-all {
                width: 100%;
                justify-content: center;
            }

            .properties-grid {
                grid-template-columns: 1fr;
            }

            .app-title {
                flex-direction: column;
                gap: 12px;
                text-align: center;
            }

            .header-content {
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>
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
                <button type="button" class="btn-view-details" onclick="openDetailsModal()">
                    <i class="fas fa-eye"></i> Ver Detalles Completos
                </button>
                <button type="button" class="btn-export-excel" onclick="exportToExcel()">
                    <i class="fas fa-file-excel"></i> Exportar a Excel
                </button>
                <button type="button" class="btn-clear-all" onclick="clearAllProperties()">
                    <i class="fas fa-trash"></i> Limpiar Todo
                </button>
            </div>
        </div>

        <!-- Modal Bootstrap para detalles de propiedades -->
        <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h4 class="modal-title mb-0" id="detailsModalLabel">Inmuebles Seleccionados</h4>
                            <small class="opacity-75">Resumen detallado de propiedades</small>
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

        <!-- Formulario de filtros -->
        <div class="filters-container">
            <h2><i class="fas fa-search"></i> Configuración de Búsqueda</h2>
            <p class="text-muted mb-4">Ajusta los filtros según las necesidades de tu cliente</p>
            
            <form id="searchForm">
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
                            <option value="PARQUEADERO">Parqueadero</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="sector"><i class="fas fa-map-marker-alt"></i> Sector</label>
                        <input id="sector" name="sector" type="text" placeholder="Ej: Poblado, Centro, Laureles..." required />
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

                <div class="filter-row">
                    <div class="filter-group">
                        <label for="rmin"><i class="fas fa-bed"></i> Habitaciones Mínimas</label>
                        <input id="rmin" name="rmin" type="number" min="0" max="20" placeholder="0" />
                    </div>

                    <div class="filter-group">
                        <label for="rmax"><i class="fas fa-bed"></i> Habitaciones Máximas</label>
                        <input id="rmax" name="rmax" type="number" min="0" max="20" placeholder="10" />
                    </div>

                    <div class="filter-group">
                        <label for="amin"><i class="fas fa-expand-arrows-alt"></i> Área Mínima (m²)</label>
                        <input id="amin" name="amin" type="number" min="0" placeholder="0" />
                    </div>
                </div>

                <div class="filter-row">
                    <div class="filter-group">
                        <label for="amax"><i class="fas fa-expand-arrows-alt"></i> Área Máxima (m²)</label>
                        <input id="amax" name="amax" type="number" min="0" placeholder="500" />
                    </div>

                    <div class="filter-group">
                        <label for="pmin"><i class="fas fa-dollar-sign"></i> Precio Mínimo</label>
                        <input id="pmin" name="pmin" type="text" placeholder="Ej: 500.000.000" />
                    </div>

                    <div class="filter-group">
                        <label for="pmax"><i class="fas fa-dollar-sign"></i> Precio Máximo</label>
                        <input id="pmax" name="pmax" type="text" placeholder="Ej: 1.000.000.000" />
                    </div>
                </div>

                <!-- Fila de operaciones -->
                <div class="filter-row operations-row">
                    <div class="filter-group full-width">
                        <label><i class="fas fa-tags"></i> Tipo de Operación</label>
                        <div class="checkbox-group">
                            <label class="checkbox-item">
                                <input type="checkbox" id="forRent" name="forRent" value="T" checked>
                                <span class="checkmark">🏠 Arriendo</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" id="onSale" name="onSale" value="T" checked>
                                <span class="checkmark">🏠 Venta</span>
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="search-btn" id="searchBtn">
                    <i class="fas fa-search"></i> Buscar Inmuebles Similares
                </button>
            </form>
        </div>

        <!-- Status y Resultados -->
        <div id="status" class="status" style="display: none;"></div>
        <div id="results" class="results-container" style="display: none;"></div>
    </div>

    <!-- Scripts -->
    <script src="//api.bitrix24.com/api/v1/"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Variables globales
        const searchForm = document.getElementById('searchForm');
        const searchBtn = document.getElementById('searchBtn');
        const statusEl = document.getElementById('status');
        const resultsEl = document.getElementById('results');
        let isSearching = false;
        
        // Variable para propiedades seleccionadas
        let selectedProperties = JSON.parse(localStorage.getItem('selectedProperties') || '[]');
        
        // Función para guardar en localStorage
        function saveSelections() {
            localStorage.setItem('selectedProperties', JSON.stringify(selectedProperties));
        }

        // Formateo de precios
        function formatPrice(value) {
            const cleanValue = value.replace(/[^\d]/g, '');
            if (cleanValue === '') return '';
            return cleanValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function unformatPrice(value) {
            return value.replace(/\./g, '');
        }

        // Event listeners para formateo de precios
        document.getElementById('pmin').addEventListener('input', function(e) {
            e.target.value = formatPrice(e.target.value);
        });

        document.getElementById('pmax').addEventListener('input', function(e) {
            e.target.value = formatPrice(e.target.value);
        });

        // Manejo de checkboxes visuales
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.checkbox-item').forEach(item => {
                const checkbox = item.querySelector('input[type="checkbox"]');
                
                // Estado inicial
                if (checkbox.checked) {
                    item.classList.add('checked');
                }
                
                item.addEventListener('click', function(e) {
                    if (e.target.type !== 'checkbox') {
                        checkbox.checked = !checkbox.checked;
                    }
                    
                    if (checkbox.checked) {
                        item.classList.add('checked');
                    } else {
                        item.classList.remove('checked');
                    }
                });
            });
        });

        // Función para mostrar estado
        function showStatus(message, type = 'loading') {
            statusEl.style.display = 'block';
            statusEl.className = `status ${type}`;
            statusEl.innerHTML = message;
        }

        function hideStatus() {
            statusEl.style.display = 'none';
        }

        // Función para mostrar resultados - basada en el repositorio
        function render(list) {
            resultsEl.innerHTML = '';
            resultsEl.style.display = 'block'; // Mostrar el contenedor de resultados

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
                <div style="background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); color: white; padding: 24px; border-radius: 12px; margin-bottom: 24px; text-align: center; box-shadow: 0 4px 20px rgba(72, 187, 120, 0.3);">
                    <div style="font-size: 2.5rem; margin-bottom: 12px;">🎯</div>
                    <h2 style="margin: 0; font-size: 1.5rem; font-weight: 700;">${successMessage}</h2>
                    <p style="margin: 8px 0 0; opacity: 0.9; font-size: 1rem;">Revisa cada opción y selecciona las que mejor se adapten</p>
                </div>
            `;
            
            resultsEl.appendChild(header);

            const gridContainer = document.createElement('div');
            gridContainer.className = 'properties-grid';
            
            list.forEach(function(pr, index) {
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
                } else {
                    mainPrice = 'Precio no disponible';
                }

                // Información del área
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

                const propertyData = {
                    type: pr.PropertyType || pr.type || 'Propiedad',
                    code: pr.propertyCode || 'PROP-' + (index + 1),
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
                            <i class="fas fa-check"></i> Seleccionar Inmueble
                        </button>
                        <button class="visualize-btn" data-property='${JSON.stringify(propertyData)}' onclick="visualizeProperty(${JSON.stringify(propertyData).replace(/"/g, '&quot;')})">
                            <i class="fas fa-eye"></i> Ver Detalles
                        </button>
                    </div>
                `;

                // Verificar si ya está seleccionado
                const isSelected = selectedProperties.some(p => p.code === propertyData.code);
                if (isSelected) {
                    div.classList.add('selected');
                    div.innerHTML = div.innerHTML.replace('<i class="fas fa-check"></i> Seleccionar Inmueble', '<i class="fas fa-check"></i> Ya Seleccionado');
                    div.querySelector('.select-btn').disabled = true;
                }
                
                gridContainer.appendChild(div);
            });

            resultsEl.appendChild(gridContainer);
            
            // Actualizar el estado visual después de renderizar
            setTimeout(updatePropertyCards, 100);
        }

        function formatPriceDisplay(value) {
            if (!value || value === '0') return '0';
            return Number(value).toLocaleString('es-CO');
        }

        // Función para formatear valores como moneda
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

        // Función principal de búsqueda
        async function searchProperties(formData) {
            if (isSearching) return;

            try {
                isSearching = true;
                showStatus('Buscando inmuebles similares...', 'loading');
                searchBtn.disabled = true;

                const response = await fetch('../api/similares.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData)
                });

                const data = await response.json();

                if (!response.ok) {
                    console.error('Error de API:', data);
                    throw new Error(data.error || `Error del servidor: ${response.status}`);
                }

                if (data.status === false) {
                    console.error('Error en respuesta:', data);
                    throw new Error(data.error || 'Error en la búsqueda');
                }

                // Verificar si tiene propiedades
                const properties = data.properties || data.data || [];
                showStatus(`Búsqueda completada. ${properties.length} inmuebles encontrados.`, 'success');
                render(properties);
                setTimeout(hideStatus, 3000);

            } catch (error) {
                console.error('Error en búsqueda:', error);
                showStatus(`Error: ${error.message}`, 'error');
                setTimeout(hideStatus, 5000);
            } finally {
                isSearching = false;
                searchBtn.disabled = false;
            }
        }

        // Event listener del formulario
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Función para construir el payload basada en el repositorio
            function buildPayload() {
                const getValue = sel => (document.querySelector(sel)?.value || '').trim();
                const getChecked = sel => document.querySelector(sel)?.checked;

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
                    ['#amax', 'toArea']
                ];

                // Campos de precio - usar función especial para desformatear
                const priceFields = [
                    ['#pmin', 'fromPrice'], 
                    ['#pmax', 'toPrice']
                ];

                textFields.forEach(([selector, key]) => {
                    const val = getValue(selector);
                    // No incluir branchCode si el valor es "Todos" - esto permite traer TODAS las sucursales
                    if (val !== '' && !(key === 'branchCode' && val === 'Todos')) {
                        payload[key] = val;
                    }
                });

                priceFields.forEach(([selector, key]) => {
                    const val = getValue(selector);
                    if (val !== '') {
                        payload[key] = unformatPrice(val);
                    }
                });

                // Manejo especial para checkboxes
                const forRent = getChecked('#forRent');
                const onSale = getChecked('#onSale');
                
                payload.forRent = forRent ? 'T' : 'F';
                payload.onSale = onSale ? 'T' : 'F';

                return payload;
            }

            const apiData = buildPayload();

            // Validaciones básicas
            if (!apiData.propertyTypeCode) {
                showStatus('Por favor selecciona un tipo de inmueble', 'error');
                setTimeout(hideStatus, 3000);
                return;
            }

            if (!apiData.sectorCode) {
                showStatus('Por favor ingresa un sector', 'error');
                setTimeout(hideStatus, 3000);
                return;
            }

            // Validar que al menos una opción de operación esté seleccionada
            if (apiData.forRent === 'F' && apiData.onSale === 'F') {
                showStatus('Debes seleccionar al menos una opción: Arriendo o Venta', 'error');
                setTimeout(hideStatus, 3000);
                return;
            }

            console.log('Datos de búsqueda:', apiData);
            searchProperties(apiData);
        });

        // Inicialización de BX24
        if (typeof BX24 !== 'undefined') {
            BX24.init(function(){
                console.log('BX24 API inicializada');

                BX24.placement.info(function(result){
                    if (result && result.options && result.options.ID) {
                        const dealId = result.options.ID;
                        document.getElementById('dealContext').style.display = 'block';
                        document.getElementById('dealIdValue').textContent = dealId;
                    }
                });
            });
        }

        // Funciones de selección y gestión de propiedades
        function updateSelectedSummary() {
            const summarySection = $('#selectedSummary');
            const summaryCount = $('#summaryCount');
            const summaryList = $('#selectedSummaryList');
            
            if (!summarySection || !summaryCount || !summaryList) return;
            
            if (selectedProperties.length > 0) {
                summarySection.style.display = 'block';
                summaryCount.textContent = selectedProperties.length;
                
                const summaryHTML = selectedProperties.map(property => `
                    <div class="summary-item">
                        <strong>${property.type}</strong> • ${property.sector}<br>
                        💰 ${property.price} • 🛏️ ${property.rooms} hab
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
                                            <h6 class="section-title"><i class="fas fa-dollar-sign"></i> Información de Precio</h6>
                                            <div class="detail-grid">
                                                <div class="detail-item">
                                                    <span class="detail-label">Precio:</span>
                                                    <span class="detail-value price-highlight">${propertyData.price}</span>
                                                </div>
                                                <div class="detail-item">
                                                    <span class="detail-label">Habitaciones:</span>
                                                    <span class="detail-value">${propertyData.rooms || 'No especificado'}</span>
                                                </div>
                                                <div class="detail-item">
                                                    <span class="detail-label">Área:</span>
                                                    <span class="detail-value">${propertyData.area || 'No especificada'}</span>
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
                        card.classList.add('selected');
                        selectBtn.innerHTML = '<i class="fas fa-check"></i> Ya Seleccionado';
                        selectBtn.disabled = true;
                    } else {
                        card.classList.remove('selected');
                        selectBtn.innerHTML = '<i class="fas fa-check"></i> Seleccionar Inmueble';
                        selectBtn.disabled = false;
                    }
                }
            });
        }

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
            updatePropertyCards(); // Update cards visual state
        }

        function clearAllProperties() {
            if (confirm('¿Estás seguro de que quieres limpiar todas las selecciones?')) {
                selectedProperties = [];
                saveSelections();
                closeDetailsModal();
                updatePropertyCards();
            }
        }

        function exportToExcel() {
            if (selectedProperties.length === 0) {
                alert('No hay propiedades seleccionadas para exportar.');
                return;
            }

            // Crear CSV
            const headers = ['Tipo', 'Código', 'Sector', 'Habitaciones', 'Operación', 'Precio'];
            const csvContent = [
                headers.join(','),
                ...selectedProperties.map(prop => [
                    prop.type || '',
                    prop.code || '',
                    prop.sector || '',
                    prop.rooms || '',
                    prop.operation || '',
                    prop.price || ''
                ].join(','))
            ].join('\\n');

            // Descargar archivo
            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = `inmuebles_seleccionados_${new Date().toISOString().split('T')[0]}.csv`;
            link.click();
        }

        // Inicializar la aplicación
        document.addEventListener('DOMContentLoaded', function() {
            updateSelectedSummary();
        });

        console.log('Aplicación de búsqueda de inmuebles iniciada correctamente');
    </script>
</body>
</html>
