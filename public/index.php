<?php

// Recibir parámetros de Bitrix24
$dealId = $_GET['dealId'] ?? '';
$entityType = $_GET['entityType'] ?? '';

$tipos = [
    'APARTAMENTO'     => 'Apartamento',
    'APARATESTUDIO'   => 'Apartaestudio', 
    'CASA'            => 'Casa',
    'BODEGA'          => 'Bodega',
    'OFICINA'         => 'Oficina',
    'FINCA'           => 'Finca',
    'LOCAL'           => 'Local',
    'LOTE'            => 'Lote',
    'CONSULTORIO'     => 'Consultorio',
    'HOTEL'           => 'Hotel',
    'EDIFICIO'        => 'Edificio',
    'CABAÑA'          => 'Cabaña',
    'APSUITE'         => 'Aparta Suite',
    'SUITEHT'         => 'Suite Hot',
    'CASA_COM'        => 'Casa Comercial',
    'BURBUJA'         => 'Burbuja',
    'CASACAMPESTRE'   => 'Casa Campestre',
    'BD1'             => 'Bodega Producto',
    'BD2'             => 'Bodega de partes',
    'PRUEBA'          => 'Prueba',
    '1'               => '1',
    'PARQUEADERO'     => 'Parqueadero'
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda de Inmuebles Similares</title>
    <style>
        /* Estilos para vista completa integrada */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8fafc;
            line-height: 1.6;
            color: #2d3748;
        }

        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header de la aplicación */
        .app-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .app-title h1 {
            color: white;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .app-title p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
        }

        .deal-context {
            background: rgba(255, 255, 255, 0.15);
            padding: 8px 16px;
            border-radius: 8px;
            color: white;
        }

        .context-label {
            font-weight: 600;
        }

        .context-value {
            font-weight: 700;
            margin-left: 8px;
        }

        /* Filtros organizados */
        .filters-container {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .filters-container h2 {
            color: #2d3748;
            font-size: 1.4rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filters-grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .filter-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            align-items: start;
        }

        .operations-row {
            grid-template-columns: 1fr;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .filter-group.full-width {
            grid-column: 1 / -1;
        }

        .filter-group label {
            font-weight: 600;
            color: #4a5568;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .filter-group input,
        .filter-group select {
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s ease;
            background: white;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        /* Checkboxes mejorados */
        .checkbox-group {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            background: white;
            transition: all 0.2s ease;
        }

        .checkbox-item:hover {
            border-color: #667eea;
            background: #f7fafc;
        }

        .checkbox-item input {
            margin: 0;
        }

        .checkmark {
            font-weight: 500;
            color: #4a5568;
        }

        /* Estilos adicionales para grid de filtros */
        .filter-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
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
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .filter-group input,
        .filter-group select {
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s ease;
            background: white;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .operations-row {
            border-top: 1px solid #e2e8f0;
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
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            background: white;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .checkbox-item:hover {
            border-color: #667eea;
            background: #f7fafc;
        }

        .checkbox-item input {
            margin: 0;
        }

        .checkmark {
            font-weight: 500;
            color: #4a5568;
        }

        /* Responsivo para filtros */
        @media (max-width: 992px) {
            .filter-row {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 640px) {
            .filter-row {
                grid-template-columns: 1fr;
            }
            
            .checkbox-group {
                flex-direction: column;
            }
        }
        .search-section {
            text-align: center;
            margin-top: 24px;
        }

        .search-btn {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            border: none;
            padding: 16px 32px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(72, 187, 120, 0.4);
        }

        /* Resultados */
        .results-container {
            margin-top: 24px;
        }

        /* Error messages */
        .error-message {
            color: #e53e3e;
            font-size: 0.85rem;
            margin-top: 4px;
        }

        /* Status */
        .status {
            margin-top: 16px;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
        }
        
        .view-selections-btn {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            white-space: nowrap;
        }
        
        .view-selections-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
        }
        
        .header-title h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .header-title p {
            opacity: 0.9;
            font-size: 16px;
        }
        
        .close-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            white-space: nowrap;
        }
        
        .close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
        }
        
        .bitrix-info {
            background: rgba(255,255,255,0.1);
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            backdrop-filter: blur(10px);
        }
        
        .form-container {
            padding: 40px;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }
        
        .form-group {
            position: relative;
        }
        
        .form-group label {
            display: block;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .form-group.required label::after {
            content: " *";
            color: #e53e3e;
        }
        
        .checkbox-group {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }
        
        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 10px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .checkbox-item:hover {
            border-color: #667eea;
            background: white;
        }
        
        .checkbox-item input[type="checkbox"] {
            width: auto;
            margin: 0;
        }
        
        .checkbox-item.checked {
            border-color: #667eea;
            background: #667eea;
            color: white;
        }
        
        .search-section {
            background: #f8f9fa;
            padding: 30px 40px;
            border-top: 1px solid #e2e8f0;
        }
        
        .search-btn {
            width: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }
        
        .search-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }
        
        .status {
            margin-top: 20px;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            font-weight: 500;
        }
        
        .status.loading {
            background: #bee3f8;
            color: #2b6cb0;
        }
        
        .status.success {
            background: #c6f6d5;
            color: #2f855a;
        }
        
        .status.error {
            background: #fed7d7;
            color: #c53030;
        }
        
        .results {
            margin-top: 30px;
        }
        
        .property-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        
        .property-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        
        .property-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
        }
        
        .property-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 10px;
            font-size: 14px;
            color: #4a5568;
        }
        
        .property-price {
            font-size: 16px;
            font-weight: 600;
            color: #667eea;
            margin-top: 10px;
        }
        
        .error-message {
            color: #e53e3e;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }
        
        .loading-spinner {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .checkbox-group {
                flex-direction: column;
            }
            
            .form-container {
                padding: 20px;
            }
            
            .search-section {
                padding: 20px;
            }
        }

        /* Estilos para el resumen de selecciones en la vista principal */
        .selected-summary {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            margin: 20px;
            border-radius: 15px;
            padding: 20px;
            color: white;
            box-shadow: 0 10px 25px rgba(72, 187, 120, 0.3);
            animation: slideIn 0.5s ease-out;
        }

        .selected-summary-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .selected-summary-header h3 {
            margin: 0;
            font-size: 1.2em;
        }

        .summary-count {
            background: rgba(255, 255, 255, 0.3);
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: bold;
        }

        .selected-summary-list {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            max-height: 150px;
            overflow-y: auto;
        }

        .summary-item {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 12px;
            border-radius: 8px;
            margin-bottom: 8px;
            font-size: 0.9em;
        }

        .summary-item:last-child {
            margin-bottom: 0;
        }

        .selected-summary-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn-view-details {
            background: #2d3748;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            flex: 1;
            max-width: 200px;
            transition: all 0.3s ease;
        }

        .btn-view-details:hover {
            background: #1a202c;
            transform: translateY(-2px);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <link rel="stylesheet" href="assets/modern-style.css" />
</head>
<body>
    <div class="main-container">
        <!-- Header de la aplicación -->
        <div class="app-header">
            <div class="header-content">
                <div class="app-title">
                    <h1>� Búsqueda de Inmuebles Similares</h1>
                    <p>Encuentra las mejores opciones para tu cliente</p>
                </div>
                <?php if ($dealId): ?>
                    <div class="deal-context">
                        <span class="context-label">Deal ID:</span>
                        <span class="context-value"><?= htmlspecialchars($dealId) ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Panel de inmuebles seleccionados (si hay) -->
        <div id="selectedSummary" class="selected-summary" style="display: none;">
            <div class="selected-summary-header">
                <h3>🏠 Inmuebles Seleccionados</h3>
                <span id="summaryCount" class="summary-count">0</span>
            </div>
            <div id="selectedSummaryList" class="selected-summary-list"></div>
            <div class="selected-summary-actions">
                <button type="button" class="btn-view-details" onclick="showSelectedPanel()">
                    👁️ Ver Detalles
                </button>
            </div>
        </div>

        <!-- Filtros organizados en grid moderno -->
        <div class="filters-container">
            <h2>🔍 Filtros de Búsqueda</h2>
            
            <form id="filtro" class="filters-grid">
                <!-- Fila 1: Filtros principales -->
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="type">🏠 Tipo de Propiedad</label>
                        <select id="type" name="type" required>
                            <?php foreach ($tipos as $codigo => $nombre): ?>
                                <option value="<?= $codigo ?>" <?= $codigo === 'APARTAMENTO' ? 'selected' : '' ?>>
                                    <?= $nombre ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="sector">📍 Sector</label>
                        <input id="sector" name="sector" type="text" placeholder="Ej: Poblado, Centro..." required />
                        <div class="error-message" id="sectorError" style="display: none;">El sector es obligatorio</div>
                    </div>

                    <div class="filter-group">
                        <label for="branch">🏢 Sucursal</label>
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
                        <label for="rmin">🛏️ Habitaciones Mínimas</label>
                        <input id="rmin" name="rmin" type="number" min="0" max="20" placeholder="0" />
                        <div class="error-message" id="rminError" style="display: none;">Debe ser un número válido</div>
                    </div>

                    <div class="filter-group">
                        <label for="rmax">🛏️ Habitaciones Máximas</label>
                        <input id="rmax" name="rmax" type="number" min="0" max="20" placeholder="10" />
                        <div class="error-message" id="rmaxError" style="display: none;">Debe ser un número válido</div>
                    </div>

                    <div class="filter-group">
                        <!-- Espacio vacío para mantener la alineación -->
                    </div>
                </div>

                <!-- Fila 3: Área -->
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="amin">📐 Área Mínima (m²)</label>
                        <input id="amin" name="amin" type="number" min="0" max="10000" placeholder="0" />
                        <div class="error-message" id="aminError" style="display: none;">Debe ser un número válido</div>
                    </div>

                    <div class="filter-group">
                        <label for="amax">📐 Área Máxima (m²)</label>
                        <input id="amax" name="amax" type="number" min="0" max="10000" placeholder="500" />
                        <div class="error-message" id="amaxError" style="display: none;">Debe ser un número válido</div>
                    </div>

                    <div class="filter-group">
                        <!-- Espacio vacío para mantener la alineación -->
                    </div>
                </div>

                <!-- Fila 4: Precio -->
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="pmin">💰 Precio Mínimo</label>
                        <input id="pmin" name="pmin" type="number" min="0" max="999999999999" placeholder="0" />
                        <div class="error-message" id="pminError" style="display: none;">Debe ser un número válido</div>
                    </div>

                    <div class="filter-group">
                        <label for="pmax">💰 Precio Máximo</label>
                        <input id="pmax" name="pmax" type="number" min="0" max="999999999999" placeholder="1000000000" />
                        <div class="error-message" id="pmaxError" style="display: none;">Debe ser un número válido</div>
                    </div>

                    <div class="filter-group">
                        <!-- Espacio vacío para mantener la alineación -->
                    </div>
                </div>

                <!-- Fila 5: Operaciones -->
                <div class="filter-row operations-row">
                    <div class="filter-group full-width">
                        <label>🏷️ Tipo de Operación</label>
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

                <!-- Botón de búsqueda -->
                <div class="search-section">
                    <button type="button" id="buscar" class="search-btn">
                        🔍 Buscar Inmuebles Similares
                    </button>
                    <div id="status" class="status" style="display: none;"></div>
                </div>
            </form>
        </div>

        <!-- Resultados -->
        <div id="results" class="results-container"></div>
    </div>

    <!-- Modal personalizado para confirmaciones -->
    <div id="confirmModal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">✅ Inmueble Seleccionado</h3>
            </div>
            <div class="modal-body">
                <p id="modalMessage">El inmueble ha sido agregado a tu lista de selecciones.</p>
                <div id="modalPropertyInfo" class="property-summary"></div>
            </div>
            <div class="modal-actions">
                <button id="modalContinue" class="modal-btn primary">Continuar Buscando</button>
                <button id="modalFinish" class="modal-btn secondary">Ver Selecciones</button>
            </div>
        </div>
    </div>

    <!-- Panel de inmuebles seleccionados -->
    <div id="selectedPanel" class="selected-panel" style="display: none;">
        <div class="selected-header">
            <h3>🏠 Inmuebles Seleccionados</h3>
            <span id="selectedCount" class="selected-count">0</span>
        </div>
        <div id="selectedList" class="selected-list"></div>
        <div class="selected-actions">
            <button id="clearAll" class="btn-clear">Limpiar Todo</button>
            <button id="backToSearch" class="btn-back">← Volver a Búsqueda</button>
        </div>
    </div>

    <script src="//api.bitrix24.com/api/v1/"></script>
    <script src="assets/app.js"></script>
    <script>
        // Función simple para enviar a Bitrix (directa)
        function enviarABitrix() {
            console.log('🚀 enviarABitrix ejecutada');
            alert('Función ejecutada! Verificando selecciones...');
            
            // Verificar si hay selecciones
            if (typeof selectedProperties !== 'undefined' && selectedProperties.length > 0) {
                alert('Hay ' + selectedProperties.length + ' inmuebles seleccionados. Enviando...');
                sendAllToBitrix();
            } else {
                alert('No hay inmuebles seleccionados.');
            }
        }

        // Función simple para cerrar la aplicación
        function cerrarAplicacion() {
            console.log('🚪 Cerrando aplicación...');
            
            if (typeof BX24 !== 'undefined' && BX24.closeApplication) {
                console.log('🚪 Cerrando con BX24.closeApplication()');
                BX24.closeApplication();
            } else if (typeof BX24 !== 'undefined' && BX24.close) {
                console.log('🚪 Cerrando con BX24.close()');
                BX24.close();
            } else {
                console.log('🚪 Cerrando con window.close()');
                window.close();
            }
        }

        // Inicializar todo cuando la página carga
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🔧 Inicializando aplicación...');
            
            // Inicializar BX24
            if (typeof BX24 !== 'undefined') {
                BX24.init(function(){
                    console.log('✅ BX24 API cargada correctamente');
                });
            } else {
                console.warn('⚠️ BX24 API no disponible');
            }
            
            // Actualizar panel de selecciones si está disponible
            if (typeof updateSelectedPanel === 'function') {
                updateSelectedPanel();
                console.log('✅ Panel de selecciones actualizado');
            }
            
            // Actualizar resumen de selecciones en la vista principal
            if (typeof updateSelectedSummary === 'function') {
                updateSelectedSummary();
                console.log('✅ Resumen de selecciones actualizado');
            }
        });
        
        // Función para cerrar la aplicación Bitrix24
        const numberInputs = ['rmin', 'rmax', 'amin', 'amax', 'pmin', 'pmax'];
        
        numberInputs.forEach(inputId => {
            const input = document.getElementById(inputId);
            const errorDiv = document.getElementById(inputId + 'Error');
            
            input.addEventListener('input', function() {
                // Permitir solo números
                this.value = this.value.replace(/[^0-9]/g, '');
                
                // Validar rangos
                if (this.value && parseInt(this.value) < 0) {
                    this.value = '';
                }
                
                // Ocultar error si está correcto
                if (this.value === '' || !isNaN(this.value)) {
                    errorDiv.style.display = 'none';
                    this.style.borderColor = '#e2e8f0';
                } else {
                    errorDiv.style.display = 'block';
                    this.style.borderColor = '#e53e3e';
                }
            });
        });

        // Manejo de checkboxes visuales
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

        // Validación del sector obligatorio
        const sectorInput = document.getElementById('sector');
        const sectorError = document.getElementById('sectorError');
        
        sectorInput.addEventListener('blur', function() {
            if (!this.value.trim()) {
                sectorError.style.display = 'block';
                this.style.borderColor = '#e53e3e';
            } else {
                sectorError.style.display = 'none';
                this.style.borderColor = '#e2e8f0';
            }
        });

        // Validación de rangos
        function validateRanges() {
            const rmin = parseInt(document.getElementById('rmin').value) || 0;
            const rmax = parseInt(document.getElementById('rmax').value) || 999;
            const amin = parseInt(document.getElementById('amin').value) || 0;
            const amax = parseInt(document.getElementById('amax').value) || 999999;
            const pmin = parseInt(document.getElementById('pmin').value) || 0;
            const pmax = parseInt(document.getElementById('pmax').value) || 999999999999;

            let isValid = true;

            if (rmin > rmax) {
                document.getElementById('rmaxError').textContent = 'Debe ser mayor que habitaciones mínimas';
                document.getElementById('rmaxError').style.display = 'block';
                isValid = false;
            }

            if (amin > amax) {
                document.getElementById('amaxError').textContent = 'Debe ser mayor que área mínima';
                document.getElementById('amaxError').style.display = 'block';
                isValid = false;
            }

            if (pmin > pmax) {
                document.getElementById('pmaxError').textContent = 'Debe ser mayor que precio mínimo';
                document.getElementById('pmaxError').style.display = 'block';
                isValid = false;
            }

            return isValid;
        }

        // Validar rangos al cambiar los valores
        ['rmin', 'rmax', 'amin', 'amax', 'pmin', 'pmax'].forEach(id => {
            document.getElementById(id).addEventListener('change', validateRanges);
        });

        // Función para cerrar la aplicación Bitrix24
        function closeBitrixApp() {
            if (typeof BX24 !== 'undefined') {
                BX24.closeApplication();
            } else {
                // Si no está en Bitrix24, cerrar la ventana/pestaña
                window.close();
            }
        }

        // Función para seleccionar una propiedad
        function selectProperty(propertyData) {
            // Verificar si ya está seleccionado
            const isAlreadySelected = selectedProperties.some(p => p.code === propertyData.code);
            
            if (isAlreadySelected) {
                showModal('⚠️ Inmueble Ya Seleccionado', 'Este inmueble ya está en tu lista de selecciones.', propertyData);
                return;
            }
            
            // Agregar a la lista de selecciones
            selectedProperties.push(propertyData);
            saveSelections();
            
            // Actualizar visual de las tarjetas
            updatePropertyCards();
            
            // Mostrar modal de confirmación
            showModal(
                '✅ Inmueble Agregado', 
                `Has agregado este inmueble a tu lista. Tienes ${selectedProperties.length} inmueble${selectedProperties.length !== 1 ? 's' : ''} seleccionado${selectedProperties.length !== 1 ? 's' : ''}.`, 
                propertyData
            );
        }

        // Función de diagnóstico simple para BX24
        function diagnoseBX24() {
            console.log('=== DIAGNÓSTICO BX24 ===');
            console.log('BX24 existe:', typeof BX24 !== 'undefined');
            console.log('URL actual:', window.location.href);
            console.log('En iframe:', window !== window.top);
            
            if (typeof BX24 !== 'undefined') {
                console.log('BX24.callMethod existe:', typeof BX24.callMethod === 'function');
                console.log('BX24.init existe:', typeof BX24.init === 'function');
                console.log('Propiedades de BX24:', Object.keys(BX24));
                
                // Probar inicialización
                if (typeof BX24.init === 'function') {
                    console.log('Intentando BX24.init...');
                    BX24.init(() => {
                        console.log('BX24.init completado');
                    });
                }
            } else {
                console.warn('❌ BX24 no está disponible. Esto debe ejecutarse dentro de Bitrix24.');
            }
            console.log('========================');
        }

        // Función para enviar todas las selecciones a Bitrix24
        function sendAllToBitrix() {
            console.log('🚀 Iniciando sendAllToBitrix');
            diagnoseBX24(); // Ejecutar diagnóstico
            
            if (selectedProperties.length === 0) {
                showModal('⚠️ Sin Selecciones', 'No hay inmuebles seleccionados para enviar.', null);
                return;
            }

            // Mostrar modal de carga con animación
            showLoadingModal();
            
            // Función para procesar el envío
            function processSubmission() {
                console.log('🔄 Iniciando processSubmission()');
                
                // Obtener el ID del deal desde la URL
                const urlParams = new URLSearchParams(window.location.search);
                const dealId = urlParams.get('dealId');

                console.log('📋 Deal ID obtenido:', dealId);

                if (!dealId) {
                    hideLoadingModal();
                    showConfirmationModal('❌ Error', 'No se pudo identificar la negociación. Verifica que estés accediendo desde Bitrix24.', false);
                    return;
                }

                // Crear mensaje del comentario mejorado para Bitrix24
                let comment = `📋 PROPIEDADES SIMILARES ENCONTRADAS\n\n`;
                comment += `✅ Se encontraron ${selectedProperties.length} opciones que coinciden con los criterios del cliente:\n\n`;
                
                selectedProperties.forEach((property, index) => {
                    comment += `${index + 1}. 🏠 ${property.type.toUpperCase()}\n`;
                    comment += `   📍 Ubicación: ${property.sector}\n`;
                    comment += `   🛏️ Habitaciones: ${property.rooms}\n`;
                    comment += `   💰 Precio: ${property.price}\n`;
                    comment += `   🏷️ Tipo: ${property.operation}\n`;
                    comment += `   ─────────────────────────────\n\n`;
                });
                
                comment += `📅 Búsqueda realizada: ${new Date().toLocaleString('es-CO')}\n`;
                comment += `🤖 Generado automáticamente por el sistema de inmuebles similares`;

                console.log('💬 Comentario preparado:', {
                    length: comment.length,
                    preview: comment.substring(0, 100) + '...'
                });

                console.log('📡 Llamando a BX24.callMethod...');
                
                // Verificar que BX24.callMethod existe
                if (typeof BX24.callMethod !== 'function') {
                    console.error('❌ BX24.callMethod no es una función');
                    hideLoadingModal();
                    showConfirmationModal('❌ Error', 'API de Bitrix24 no está disponible correctamente.', false);
                    return;
                }

                // Agregar comentario al deal con timeout mejorado
                let callCompleted = false;
                let timeoutReached = false;
                
                console.log('📡 Preparando llamada a BX24...');
                
                // Timeout principal a 5 segundos (más agresivo)
                const callTimeout = setTimeout(() => {
                    if (!callCompleted) {
                        timeoutReached = true;
                        console.error('⏰ TIMEOUT: La llamada a Bitrix24 no respondió en 5 segundos');
                        hideLoadingModal();
                        showConfirmationModal(
                            '⏰ Timeout',
                            'La conexión con Bitrix24 está tardando mucho. Verifica tu conexión e intenta nuevamente.',
                            false
                        );
                    }
                }, 5000); // 5 segundos timeout más agresivo
                
                // Timeout de emergencia a 8 segundos
                const emergencyTimeout = setTimeout(() => {
                    if (!callCompleted && !timeoutReached) {
                        console.error('🚨 TIMEOUT EMERGENCIA: Forzando cancelación');
                        hideLoadingModal();
                        showConfirmationModal(
                            '❌ Error de Conexión',
                            'No se pudo conectar con Bitrix24. Intenta recargar la página.',
                            false
                        );
                    }
                }, 8000);

                console.log('📡 Ejecutando BX24.callMethod...');
                
                try {
                    BX24.callMethod('crm.timeline.comment.add', {
                        entityId: dealId,
                        entityType: 'deal',
                        comment: comment
                    }, function(result) {
                        if (timeoutReached) {
                            console.log('⏰ Respuesta recibida después del timeout, ignorando...');
                            return;
                        }
                        
                        callCompleted = true;
                        clearTimeout(callTimeout);
                        clearTimeout(emergencyTimeout);
                    hideLoadingModal();
                    
                    console.log('📨 Respuesta recibida de Bitrix24:', {
                        hasError: !!result.error(),
                        data: result.data ? result.data() : null,
                        error: result.error ? result.error() : null
                    });
                    
                    if (result.error()) {
                        const error = result.error();
                        console.error('❌ Error al enviar:', error);
                        showConfirmationModal(
                            '❌ Error de Envío', 
                            `No se pudieron guardar las selecciones.\n\nCódigo: ${error.error || 'UNKNOWN'}\nDescripción: ${error.error_description || 'Error desconocido'}`, 
                            false
                        );
                    } else {
                        const commentId = result.data();
                        console.log('✅ Enviado exitosamente. ID del comentario:', commentId);
                        
                        // Éxito - Guardar información del envío exitoso
                        const sentCount = selectedProperties.length;
                        const sentProperties = [...selectedProperties]; // Copia para mostrar
                        
                        console.log('🧹 Limpiando selecciones...');
                        
                        // Limpiar selecciones después del envío exitoso
                        selectedProperties = [];
                        saveSelections();
                        updateSelectedPanel();
                        
                        showConfirmationModal(
                            '✅ ¡Enviado Exitosamente!', 
                            `Se han guardado ${sentCount} inmuebles en la negociación.\n\nComentario ID: ${commentId}`, 
                            true,
                            sentProperties
                        );
                    }
                });
                
                console.log('📡 BX24.callMethod iniciado, esperando respuesta...');
                
                } catch (error) {
                    callCompleted = true;
                    clearTimeout(callTimeout);
                    clearTimeout(emergencyTimeout);
                    hideLoadingModal();
                    console.error('❌ Error al ejecutar BX24.callMethod:', error);
                    showConfirmationModal(
                        '❌ Error Técnico',
                        'Error al ejecutar la llamada a Bitrix24: ' + error.message,
                        false
                    );
                }
            }

            // Verificar si BX24 está disponible
            if (typeof BX24 !== 'undefined' && BX24.callMethod) {
                console.log('✅ BX24 API disponible, procesando envío...');
                
                // Agregar timeout para evitar carga infinita
                const timeoutId = setTimeout(() => {
                    hideLoadingModal();
                    showConfirmationModal(
                        '⏰ Tiempo Agotado', 
                        'El envío está tomando más tiempo del esperado. Por favor, verifica tu conexión e intenta nuevamente.', 
                        false
                    );
                }, 15000); // 15 segundos timeout
                
                // Limpiar timeout si se completa antes
                const originalProcessSubmission = processSubmission;
                processSubmission = function() {
                    clearTimeout(timeoutId);
                    originalProcessSubmission();
                };
                
                processSubmission();
            } else {
                console.warn('⚠️ BX24 API no disponible, esperando...');
                // Intentar cargar BX24 nuevamente
                let attempts = 0;
                const maxAttempts = 6; // Reducido de 10 a 6
                
                const checkBX24 = setInterval(() => {
                    attempts++;
                    console.log(`🔄 Intento ${attempts}/${maxAttempts} de conectar con BX24...`);
                    
                    if (typeof BX24 !== 'undefined' && BX24.callMethod) {
                        clearInterval(checkBX24);
                        console.log('✅ BX24 API conectada, procesando envío...');
                        processSubmission();
                    } else if (attempts >= maxAttempts) {
                        clearInterval(checkBX24);
                        hideLoadingModal();
                        showConfirmationModal(
                            '❌ Error de Integración', 
                            'No se pudo conectar con Bitrix24.\n\nAsegúrate de:\n• Estar accediendo desde el CRM de Bitrix24\n• Tener permisos para comentar en deals\n• Que la conexión a internet sea estable', 
                            false
                        );
                    }
                }, 1000); // Aumentado a 1 segundo entre intentos
            }
        }

        // Función para mostrar modal de carga
        function showLoadingModal() {
            const modal = $('#confirmModal');
            const modalTitle = $('#modalTitle');
            const modalMessage = $('#modalMessage');
            const modalPropertyInfo = $('#modalPropertyInfo');
            const modalActions = document.querySelector('.modal-actions');
            const modalContinue = $('#modalContinue');
            const modalFinish = $('#modalFinish');
            
            modalTitle.innerHTML = '⏳ Enviando a Bitrix24...';
            modalMessage.innerHTML = 'Guardando las selecciones en la negociación...<br><small>Por favor espera un momento.</small>';
            modalPropertyInfo.innerHTML = `
                <div style="text-align: center; padding: 20px;">
                    <div class="loading-spinner" style="display: inline-block; margin: 0 auto;"></div>
                    <p style="margin-top: 15px; color: #4a5568; font-size: 14px;">
                        Conectando con Bitrix24...
                    </p>
                </div>
            `;
            
            // Mostrar botón de cancelar
            modalContinue.textContent = 'Cancelar';
            modalContinue.onclick = () => {
                modal.style.display = 'none';
                console.log('🚫 Envío cancelado por el usuario');
            };
            modalFinish.style.display = 'none';
            modalActions.style.display = 'flex';
            
            modal.style.display = 'flex';
        }

        // Función para ocultar modal de carga
        function hideLoadingModal() {
            // El modal se ocultará cuando se muestre el modal de confirmación
        }

        // Función para mostrar modal de confirmación final
        function showConfirmationModal(title, message, isSuccess, sentProperties = null) {
            const modal = $('#confirmModal');
            const modalTitle = $('#modalTitle');
            const modalMessage = $('#modalMessage');
            const modalPropertyInfo = $('#modalPropertyInfo');
            const modalActions = document.querySelector('.modal-actions');
            const modalContinue = $('#modalContinue');
            const modalFinish = $('#modalFinish');
            
            modalTitle.innerHTML = title;
            modalMessage.innerHTML = message;
            
            if (isSuccess && sentProperties) {
                modalPropertyInfo.innerHTML = `
                    <div style="background: #f0fff4; padding: 15px; border-radius: 10px; border: 1px solid #9ae6b4;">
                        <strong>📋 Inmuebles enviados:</strong><br>
                        ${sentProperties.map((p, i) => `${i+1}. ${p.type} - ${p.sector} (${p.price})`).join('<br>')}
                        <br><br>
                        <div style="color: #38a169; font-weight: bold; text-align: center;">
                            🎉 ¡Envío exitoso! La aplicación se cerrará automáticamente en <span id="countdownTimer">3</span> segundos...
                        </div>
                    </div>
                `;
                
                modalContinue.textContent = '🔍 Seguir Buscando';
                modalFinish.textContent = '✅ Cerrar Ahora';
                
                // Función para cerrar la aplicación
                const closeApp = () => {
                    if (typeof BX24 !== 'undefined' && BX24.closeApplication) {
                        console.log('🚪 Cerrando aplicación con BX24.closeApplication()');
                        BX24.closeApplication();
                    } else {
                        console.log('🚪 Cerrando ventana con window.close()');
                        window.close();
                    }
                };
                
                modalContinue.onclick = () => {
                    modal.style.display = 'none';
                    clearInterval(countdownInterval);
                };
                
                modalFinish.onclick = closeApp;
                
                // Countdown automático para cerrar en 5 segundos
                let countdown = 5;
                const countdownElement = document.getElementById('countdownTimer');
                
                const countdownInterval = setInterval(() => {
                    countdown--;
                    if (countdownElement) {
                        countdownElement.textContent = countdown;
                    }
                    
                    if (countdown <= 0) {
                        clearInterval(countdownInterval);
                        console.log('⏰ Tiempo agotado, cerrando aplicación automáticamente...');
                        closeApp();
                    }
                }, 1000);
                
            } else {
                modalPropertyInfo.innerHTML = '';
                modalContinue.textContent = 'Entendido';
                modalFinish.style.display = 'none';
                
                modalContinue.onclick = () => {
                    modal.style.display = 'none';
                };
            }
            
            modalActions.style.display = 'flex';
            modal.style.display = 'flex';
        }

        // Test simple al final del script
        console.log('📜 Script cargado completamente');
        console.log('📜 Función enviarABitrix disponible:', typeof enviarABitrix);
        console.log('� Función sendAllToBitrix disponible:', typeof sendAllToBitrix);
    </script>
</body>
</html>
</body>
</html>
</body>
</html>