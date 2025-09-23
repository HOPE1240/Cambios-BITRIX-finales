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
            --primary-color: #005D83;
            --primary-light: #0074a3;
            --primary-dark: #004663;
            --secondary-color: #B6BD00;
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
            background: linear-gradient(135deg, var(--secondary-color) 0%, #9aa600 100%);
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
            background: var(--secondary-color);
            color: white;
        }

        .btn-export-excel:hover {
            background: #9aa600;
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

        /* Autocomplete styles */
        .autocomplete-container {
            position: relative;
            width: 100%;
            display: block;
        }

        .autocomplete-container input {
            width: 100% !important;
            box-sizing: border-box;
            min-width: 0;
        }

        /* Asegurar que el input del sector tenga el mismo ancho */
        #sector {
            width: 100% !important;
            min-width: 0;
            flex: 1;
        }

        .autocomplete-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--surface-color);
            border: 1px solid var(--border-color);
            border-top: none;
            border-radius: 0 0 var(--radius-md) var(--radius-md);
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
            box-shadow: var(--shadow-lg);
        }

        .autocomplete-suggestions.show {
            display: block;
        }

        .autocomplete-suggestion {
            padding: 12px 16px;
            cursor: pointer;
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.2s ease;
            font-size: 0.875rem;
        }

        .autocomplete-suggestion:last-child {
            border-bottom: none;
        }

        .autocomplete-suggestion:hover {
            background: var(--background-color);
        }

        .autocomplete-suggestion.selected {
            background: var(--primary-color);
            color: white;
        }

        .autocomplete-suggestion .match {
            font-weight: 600;
            color: var(--primary-color);
        }

        .autocomplete-suggestion.selected .match {
            color: white;
        }

        .autocomplete-no-results {
            padding: 12px 16px;
            color: var(--text-muted);
            font-style: italic;
            text-align: center;
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
            background: var(--secondary-color);
            color: white;
        }

        .select-btn:hover {
            background: #9aa600;
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

        /* Notification System */
        .notification-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }

        .notification {
            background: white;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-lg);
            padding: 16px 20px;
            margin-bottom: 12px;
            border-left: 4px solid;
            display: flex;
            align-items: center;
            gap: 12px;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease;
            position: relative;
            max-width: 100%;
            word-wrap: break-word;
        }

        .notification.show {
            opacity: 1;
            transform: translateX(0);
        }

        .notification.success {
            border-left-color: var(--success-color);
            background: linear-gradient(135deg, #f0f9ff 0%, #e6fffa 100%);
        }

        .notification.warning {
            border-left-color: var(--warning-color);
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
        }

        .notification.error {
            border-left-color: var(--danger-color);
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        }

        .notification-icon {
            font-size: 18px;
            flex-shrink: 0;
        }

        .notification.success .notification-icon {
            color: var(--success-color);
        }

        .notification.warning .notification-icon {
            color: var(--warning-color);
        }

        .notification.error .notification-icon {
            color: var(--danger-color);
        }

        .notification-content {
            flex: 1;
            font-weight: 500;
            color: var(--text-primary);
            font-size: 14px;
            line-height: 1.4;
        }

        .notification-close {
            background: none;
            border: none;
            font-size: 18px;
            color: var(--text-muted);
            cursor: pointer;
            padding: 0;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .notification-close:hover {
            color: var(--text-primary);
        }

        /* Notification with Actions Styles */
        .confirm-notification {
            max-width: 500px;
            padding: 16px 20px;
        }

        .notification-actions {
            display: flex;
            gap: 10px;
            margin-left: 12px;
            flex-shrink: 0;
        }

        .notification-btn {
            background: none;
            border: 1px solid transparent;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .notification-btn.btn-cancel {
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-muted);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .notification-btn.btn-cancel:hover {
            background: rgba(255, 255, 255, 0.15);
            color: var(--text-primary);
        }

        .notification-btn.btn-confirm {
            background: var(--danger-color);
            color: white;
            border-color: var(--danger-color);
        }

        .notification-btn.btn-confirm:hover {
            background: #c53030;
            border-color: #c53030;
        }

        /* Confirmation Modal Styles */
        .confirmation-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .confirmation-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }

        .confirmation-content {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            padding: 0;
            max-width: 420px;
            width: 90%;
            position: relative;
            z-index: 1;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }

        .confirmation-modal.show .confirmation-content {
            transform: scale(1);
        }

        .confirmation-header {
            background: linear-gradient(135deg, var(--warning-color) 0%, #f6ad55 100%);
            color: white;
            padding: 20px 24px;
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .confirmation-header i {
            font-size: 24px;
        }

        .confirmation-header h3 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .confirmation-body {
            padding: 32px 24px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 120px;
        }

        .confirmation-body p {
            margin: 0;
            font-size: 1.1rem;
            color: var(--text-primary);
            line-height: 1.5;
            font-weight: 500;
            text-align: center;
            max-width: 100%;
            width: 100%;
        }

        .confirmation-actions {
            padding: 20px 24px 24px;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn-confirm-cancel {
            background: #f7fafc;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
            padding: 10px 20px;
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-confirm-cancel:hover {
            background: #edf2f7;
            color: var(--text-primary);
        }

        .btn-confirm-accept {
            background: var(--danger-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-confirm-accept:hover {
            background: #c53030;
        }
    </style>
</head>
<body>
    <!-- Notification Container -->
    <div id="notificationContainer" class="notification-container"></div>
    
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
                            <button id="exportBtn" class="btn btn-success btn-lg">
                                <i class="fas fa-file-excel me-2"></i>
                                Exportar a Excel
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

        <!-- Modal de Confirmación Personalizado -->
        <div id="confirmModal" class="confirmation-modal" style="display: none;">
            <div class="confirmation-overlay">
                <div class="confirmation-content">
                    <div class="confirmation-header">
                        <i class="fas fa-exclamation-triangle"></i>
                        <h3>Confirmar Acción</h3>
                    </div>
                    <div class="confirmation-body">
                        <p id="confirmMessage">¿Estás seguro de que quieres continuar?</p>
                    </div>
                    <div class="confirmation-actions">
                        <button id="confirmCancel" class="btn-confirm-cancel">
                            <i class="fas fa-times"></i> Cancelar
                        </button>
                        <button id="confirmAccept" class="btn-confirm-accept">
                            <i class="fas fa-check"></i> Confirmar
                        </button>
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
                        <div class="autocomplete-container">
                            <input id="sector" name="sector" type="text" 
                                   placeholder="Ej: Poblado, Centro, Laureles..." 
                                   autocomplete="off" required />
                            <div id="sector-suggestions" class="autocomplete-suggestions"></div>
                        </div>
                    </div>

                    <div class="filter-group">
                        <label for="branch"><i class="fas fa-building"></i> Sucursal</label>
                        <select id="branch" name="branch">
                            <option value="Todos" selected>Todas las sucursales</option>
                            <option value="BELEN">BELÉN</option>
                            <option value="BELLO">BELLO</option>
                            <option value="BELLOSUR">BELLOSUR</option>
                            <option value="CEDRITOS">CEDRITOS</option>
                            <option value="CENTRO">CENTRO</option>
                            <option value="CHICO">CHICO</option>
                            <option value="GUAYABAL">GUAYABAL</option>
                            <option value="ITAGUI">ITAGÜÍ</option>
                            <option value="LAURELES">LAURELES</option>
                            <option value="MOSQUERA">MOSQUERA</option>
                            <option value="NUEVOMUNDO">NUEVOMUNDO</option>
                            <option value="OCCIDENTE">OCCIDENTE</option>
                            <option value="POBLADO">POBLADO</option>
                            <option value="RIONEGRO">RIONEGRO</option>
                            <option value="SABANETA">SABANETA</option>
                            <option value="SALITRE">SALITRE</option>
                            <option value="SUR">SUR</option>
                            <option value="VIRTUAL">VIRTUAL</option>
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

                <!-- Fila de operaciones (oculta para equipo de arriendos) -->
                <div class="filter-row operations-row" style="display: none;">
                    <div class="filter-group full-width">
                        <label><i class="fas fa-tags"></i> Tipo de Operación</label>
                        <div class="checkbox-group">
                            <label class="checkbox-item">
                                <input type="checkbox" id="forRent" name="forRent" value="T" checked>
                                <span class="checkmark">Arriendo</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" id="onSale" name="onSale" value="T">
                                <span class="checkmark">Venta</span>
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
        
        // Debug: verificar que los elementos existan
        console.log('Elementos encontrados:', {
            searchForm: !!searchForm,
            searchBtn: !!searchBtn,
            statusEl: !!statusEl,
            resultsEl: !!resultsEl
        });
        
        if (!searchForm) {
            console.error('No se encontró el formulario de búsqueda con ID "searchForm"');
        }
        
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
                        <div style="font-size: 3rem; margin-bottom: 20px;"><i class="fas fa-search"></i></div>
                        <h3 style="color: #2d3748; margin-bottom: 12px;">No encontramos coincidencias exactas</h3>
                        <p style="margin-bottom: 16px;"><strong>Sugerencias para mejorar tu búsqueda:</strong></p>
                        <ul style="text-align: left; display: inline-block; color: #4a5568;">
                            <li>Prueba con un tipo de propiedad diferente</li>
                            <li>Amplía el área de búsqueda o cambia el sector</li>
                            <li>Ajusta el rango de precio</li>
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
                <div style="background: linear-gradient(135deg, var(--secondary-color) 0%, #9aa600 100%); color: white; padding: 24px; border-radius: 12px; margin-bottom: 24px; text-align: center; box-shadow: 0 4px 20px rgba(182, 189, 0, 0.3);">
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
                            <span class="detail-label"><i class="fas fa-map-marker-alt"></i> Sector:</span>
                            <span class="detail-value">${propertyData.sector}</span>
                        </div>
                        
                        <div class="detail-row">
                            <span class="detail-label"><i class="fas fa-bed"></i> Habitaciones:</span>
                            <span class="detail-value">${propertyData.rooms}</span>
                        </div>
                        
                        ${areaInfo !== 'No especificada' ? `
                        <div class="detail-row">
                            <span class="detail-label"><i class="fas fa-ruler-combined"></i> Área:</span>
                            <span class="detail-value">${areaInfo}</span>
                        </div>
                        ` : ''}
                        
                        <div class="detail-row">
                            <span class="detail-label"><i class="fas fa-tag"></i> Operación:</span>
                            <span class="detail-value">${operationType}</span>
                        </div>
                    </div>
                    
                    <div class="property-price">
                        <span class="price-label"><i class="fas fa-dollar-sign"></i> Precio:</span>
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
                
                // Mostrar notificación elegante según los resultados
                if (properties.length > 0) {
                    showNotification(`Búsqueda exitosa: ${properties.length} inmuebles encontrados`, 'success');
                } else {
                    showNotification('No se encontraron inmuebles con los criterios especificados', 'warning');
                }
                
                render(properties);
                setTimeout(hideStatus, 3000);

            } catch (error) {
                console.error('Error en búsqueda:', error);
                showStatus(`Error: ${error.message}`, 'error');
                showNotification(`Error en la búsqueda: ${error.message}`, 'error');
                setTimeout(hideStatus, 5000);
            } finally {
                isSearching = false;
                searchBtn.disabled = false;
            }
        }

        // Event listener del formulario
        searchForm.addEventListener('submit', function(e) {
            console.log('Formulario enviado - event listener ejecutado');
            e.preventDefault();

            // Función para construir el payload basada en el repositorio
            function buildPayload() {
                console.log('Construyendo payload...');
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
                    } else if (key === 'sectorCode') {
                        // Si se selecciona una sucursal específica, enviar sectorCode vacío
                        const branchValue = getValue('#branch');
                        if (branchValue && branchValue !== 'Todos') {
                            payload[key] = ''; // Enviar sector vacío cuando hay sucursal específica
                            console.log('Sucursal específica seleccionada, enviando sectorCode vacío');
                        } else if (val === '') {
                            // Si no hay sucursal específica y el sector está vacío, no incluir
                            // (esto será capturado por la validación más adelante)
                        }
                    }
                });

                priceFields.forEach(([selector, key]) => {
                    const val = getValue(selector);
                    if (val !== '') {
                        payload[key] = unformatPrice(val);
                    }
                });

                // Manejo especial para checkboxes (fijos para equipo de arriendos)
                payload.forRent = 'T'; // Siempre T para arriendo
                payload.onSale = 'F';  // Siempre F para venta
                
                console.log('Payload construido:', payload);
                return payload;
            }

            const apiData = buildPayload();

            // Validaciones básicas
            if (!apiData.propertyTypeCode) {
                showStatus('Por favor selecciona un tipo de inmueble', 'error');
                setTimeout(hideStatus, 3000);
                return;
            }

            // El sector es obligatorio solo si no se ha seleccionado una sucursal específica
            const branchValue = document.querySelector('#branch')?.value;
            if (!apiData.sectorCode && (!branchValue || branchValue === 'Todos')) {
                showStatus('Por favor ingresa un sector o selecciona una sucursal específica', 'error');
                setTimeout(hideStatus, 3000);
                return;
            }

            console.log('Datos de búsqueda (modo arriendo):', apiData);
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

        // Sistema de notificaciones elegantes
        function showNotification(message, type = 'success', duration = 4000) {
            const container = document.getElementById('notificationContainer');
            if (!container) return;
            
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            
            const iconMap = {
                success: 'fas fa-check-circle',
                warning: 'fas fa-exclamation-triangle', 
                error: 'fas fa-times-circle'
            };
            
            notification.innerHTML = `
                <i class="notification-icon ${iconMap[type] || iconMap.success}"></i>
                <div class="notification-content">${message}</div>
                <button class="notification-close" onclick="closeNotification(this)">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            container.appendChild(notification);
            
            // Mostrar con animación
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);
            
            // Auto cerrar
            setTimeout(() => {
                closeNotification(notification.querySelector('.notification-close'));
            }, duration);
        }
        
        function closeNotification(closeBtn) {
            const notification = closeBtn.closest('.notification');
            if (notification) {
                notification.classList.remove('show');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }
        }

        // Sistema de notificación de confirmación elegante
        function showConfirmNotification(message, onConfirm, onCancel = null, duration = 8000) {
            const container = document.getElementById('notificationContainer');
            if (!container) return;
            
            const notification = document.createElement('div');
            notification.className = 'notification warning confirm-notification';
            
            notification.innerHTML = `
                <i class="notification-icon fas fa-exclamation-triangle"></i>
                <div class="notification-content">${message}</div>
                <div class="notification-actions">
                    <button class="notification-btn btn-cancel" onclick="cancelConfirmNotification(this)">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button class="notification-btn btn-confirm" onclick="acceptConfirmNotification(this)">
                        <i class="fas fa-check"></i> Confirmar
                    </button>
                </div>
            `;
            
            // Guardar las funciones de callback en el elemento
            notification._onConfirm = onConfirm;
            notification._onCancel = onCancel;
            
            container.appendChild(notification);
            
            // Mostrar con animación
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);
            
            // Auto cerrar después del tiempo especificado
            setTimeout(() => {
                if (notification.parentNode) {
                    cancelConfirmNotification(notification.querySelector('.btn-cancel'));
                }
            }, duration);
        }
        
        function acceptConfirmNotification(btn) {
            const notification = btn.closest('.notification');
            if (notification && notification._onConfirm) {
                notification._onConfirm();
            }
            notification.classList.remove('show');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }
        
        function cancelConfirmNotification(btn) {
            const notification = btn.closest('.notification');
            if (notification && notification._onCancel) {
                notification._onCancel();
            }
            notification.classList.remove('show');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }

        // Modal de confirmación personalizado
        function showConfirmModal(message, onConfirm, onCancel = null) {
            const modal = document.getElementById('confirmModal');
            const messageEl = document.getElementById('confirmMessage');
            const acceptBtn = document.getElementById('confirmAccept');
            const cancelBtn = document.getElementById('confirmCancel');
            
            messageEl.textContent = message;
            modal.style.display = 'flex';
            
            // Mostrar con animación
            setTimeout(() => {
                modal.classList.add('show');
            }, 10);
            
            // Manejadores de eventos
            const handleAccept = () => {
                hideConfirmModal();
                if (onConfirm) onConfirm();
            };
            
            const handleCancel = () => {
                hideConfirmModal();
                if (onCancel) onCancel();
            };
            
            const handleOverlayClick = (e) => {
                if (e.target === modal.querySelector('.confirmation-overlay')) {
                    handleCancel();
                }
            };
            
            // Limpiar eventos anteriores
            acceptBtn.replaceWith(acceptBtn.cloneNode(true));
            cancelBtn.replaceWith(cancelBtn.cloneNode(true));
            modal.replaceWith(modal.cloneNode(true));
            
            // Obtener nuevas referencias
            const newModal = document.getElementById('confirmModal');
            const newAcceptBtn = document.getElementById('confirmAccept');
            const newCancelBtn = document.getElementById('confirmCancel');
            
            // Agregar nuevos eventos
            newAcceptBtn.addEventListener('click', handleAccept);
            newCancelBtn.addEventListener('click', handleCancel);
            newModal.addEventListener('click', handleOverlayClick);
        }
        
        function hideConfirmModal() {
            const modal = document.getElementById('confirmModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }

        // Funciones de selección y gestión de propiedades
        function updateSelectedSummary() {
            const summarySection = document.getElementById('selectedSummary');
            const summaryCount = document.getElementById('summaryCount');
            const summaryList = document.getElementById('selectedSummaryList');
            
            console.log('Actualizando resumen. Propiedades seleccionadas:', selectedProperties.length);
            
            if (!summarySection || !summaryCount || !summaryList) {
                console.error('No se encontraron elementos DOM para el resumen');
                return;
            }
            
            if (selectedProperties.length > 0) {
                summarySection.style.display = 'block';
                summaryCount.textContent = selectedProperties.length;
                
                const summaryHTML = selectedProperties.map((property, index) => `
                    <div class="summary-item" data-property-index="${index}">
                        <strong>${property.type || 'N/A'}</strong> • ${property.sector || 'N/A'}<br>
                        <span class="price-info">Precio: ${property.price || 'N/A'}</span> • <span class="rooms-info">${property.rooms || 'N/A'} hab</span>
                    </div>
                `).join('');
                
                summaryList.innerHTML = summaryHTML;
                console.log('HTML del resumen generado:', summaryHTML);
            } else {
                summarySection.style.display = 'none';
                console.log('Ocultando sección de resumen - no hay propiedades seleccionadas');
            }
        }

        function selectProperty(propertyData) {
            console.log('Intentando seleccionar propiedad:', propertyData);
            
            const isAlreadySelected = selectedProperties.some(p => p.code === propertyData.code);
            
            if (isAlreadySelected) {
                showNotification('Esta propiedad ya está seleccionada.', 'warning');
                return;
            }
            
            selectedProperties.push(propertyData);
            console.log('Propiedad agregada. Total seleccionadas:', selectedProperties.length);
            console.log('Todas las propiedades:', selectedProperties);
            
            saveSelections();
            updatePropertyCards();
            updateSelectedSummary(); // Mostrar la lista actualizada
            showNotification(`${propertyData.type} seleccionado exitosamente`, 'success');
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
                showNotification('No hay inmuebles seleccionados para mostrar.', 'warning');
                // Asegurar que el modal esté cerrado si no hay propiedades
                closeDetailsModal();
                return;
            }

            const modalList = document.getElementById('modalPropertiesList');
            const modalCount = document.getElementById('modalPropertyCount');
            
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
            
            // Gestión mejorada de instancias del modal
            const modalElement = document.getElementById('detailsModal');
            let existingModal = bootstrap.Modal.getInstance(modalElement);
            
            if (existingModal) {
                // Si ya existe una instancia, solo actualizar contenido y mostrar
                if (!modalElement.classList.contains('show')) {
                    existingModal.show();
                }
            } else {
                // Si no existe instancia, crear una nueva
                const bootstrapModal = new bootstrap.Modal(modalElement, {
                    backdrop: true,
                    keyboard: true,
                    focus: true
                });
                bootstrapModal.show();
            }
            
            // Asegurar que el botón de exportar funcione
            const exportBtn = document.getElementById('exportBtn');
            if (exportBtn) {
                // Remover listeners anteriores y agregar nuevo
                exportBtn.replaceWith(exportBtn.cloneNode(true));
                document.getElementById('exportBtn').addEventListener('click', exportToExcel);
            }
        }

        function closeDetailsModal() {
            const modalElement = document.getElementById('detailsModal');
            const modal = bootstrap.Modal.getInstance(modalElement);
            
            if (modal) {
                modal.hide();
                
                // Asegurar que el modal se pueda volver a abrir después
                modalElement.addEventListener('hidden.bs.modal', function handleModalHidden() {
                    // Remover el event listener para evitar acumulación
                    modalElement.removeEventListener('hidden.bs.modal', handleModalHidden);
                    
                    // Limpiar cualquier backdrop residual
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) {
                        backdrop.remove();
                    }
                    
                    // Asegurar que el body no tenga clases residuales
                    document.body.classList.remove('modal-open');
                    document.body.style.removeProperty('padding-right');
                }, { once: true });
            }
        }

        function removeProperty(propertyCode) {
            // Encontrar la propiedad para mostrar información en la confirmación
            const property = selectedProperties.find(p => p.code === propertyCode);
            const propertyName = property ? `${property.type} - ${property.sector}` : 'esta propiedad';
            
            showConfirmNotification(
                `¿Deseas quitar ${propertyName} de la selección?`,
                function() {
                    // Función de confirmación
                    selectedProperties = selectedProperties.filter(p => p.code !== propertyCode);
                    saveSelections();
                    updatePropertyCards(); // Update cards visual state
                    updateSelectedSummary(); // Update summary section
                    
                    // Si no quedan propiedades seleccionadas, cerrar el modal
                    if (selectedProperties.length === 0) {
                        closeDetailsModal();
                        showNotification('Propiedad removida. No hay más inmuebles seleccionados', 'success');
                    } else {
                        // Si aún quedan propiedades, actualizar el modal
                        openDetailsModal();
                        showNotification('Propiedad removida de la selección', 'success');
                    }
                }
            );
        }

        function clearAllProperties() {
            showConfirmNotification(
                '¿Deseas limpiar todas las selecciones?',
                function() {
                    // Función de confirmación
                    console.log('Limpiando todas las selecciones. Antes:', selectedProperties.length);
                    selectedProperties = [];
                    console.log('Después de limpiar:', selectedProperties.length);
                    
                    saveSelections();
                    updateSelectedSummary(); // Actualizar la vista de inmuebles seleccionados
                    updatePropertyCards(); // Actualizar el estado visual de las tarjetas
                    closeDetailsModal(); // Cerrar modal ya que no hay propiedades
                    showNotification('Todas las selecciones han sido limpiadas', 'success');
                }
            );
        }

        function exportToExcel() {
            if (selectedProperties.length === 0) {
                showNotification('No hay propiedades seleccionadas para exportar.', 'warning');
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

        // Función para limpiar cache si hay problemas
        function clearCache() {
            localStorage.removeItem('selectedProperties');
            selectedProperties = [];
            updateSelectedSummary();
            updatePropertyCards();
            showNotification('Cache limpiado correctamente', 'success');
        }

        // Agregar función al objeto window para debugging
        window.debugApp = {
            selectedProperties: () => selectedProperties,
            clearCache: clearCache,
            updateSummary: updateSelectedSummary,
            updateCards: updatePropertyCards
        };

        // Inicializar la aplicación
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Aplicación iniciada. Propiedades seleccionadas guardadas:', selectedProperties.length);
            updateSelectedSummary();
            updatePropertyCards();
            initializeSectorAutocomplete();
        });

        // Lista completa de sectores de Colombia (1300+ sectores)
        const SECTORES_COMPLETOS = ['POBLADO', 'SAN DIEGO', 'NUEVO POBLADO', 'CASTROPOL', 'MANILA', 'PROVENZA', 'PATIO BONITO', 'LAS LOMAS', 'ALEJANDRIA', 'LOS PARRA', 'LOS BALSOS', 'SANTA MARIA DE LOS ANGELES', 'LA FRONTERA M', 'EL CAMPESTRE', 'LOS GONZALEZ', 'LA COLA DEL ZORRO', 'LA CONCHA', 'EL TESORO', 'SAN LUCAS', 'OVIEDO', 'TRANSVERSAL INFERIOR', 'TRANSVERSAL SUPERIOR', 'INTERCONTINENTAL', 'MILLA DE ORO', 'LOMA DE LOS PARRAS', 'BARRIO COLOMBIA', 'COLINA CAMPESTRE M', 'CARIBE', 'INDUSTRIALES', 'LAS PALMAS M', 'CHAGUALO', 'LA AGUACATALA', 'LA TOMATERA', 'LAS SANTAS', 'LA CALERA', 'LOMA DEL INDIO', 'LA ASOMADERA', 'TRANSVERSAL INTERMEDIA', 'LALINDE', 'ASTORGA', 'VIZCAYA', 'SAN JULIAN', 'ALTOS DEL POBLADO', 'CANTIZAL', 'DOMINIO INMOBILIARIO', 'AVENIDA LAS VEGAS', 'La Visitación', 'LAURELES', 'ESTADIO', 'LA CASTELLANA', 'LAS ACACIAS', 'LOS CONQUISTADORES', 'SAN JOAQUÍN', 'BOLIVARIANA', 'LORENA', 'EL VELÓDROMO', 'FLORIDA NUEVA', 'NARANJAL', 'SURAMERICANA', 'LOS COLORES', 'LA CUARTA BRIGADA', 'CARLOS E. RESTREPO', 'VELODROMO', 'MANZANARES', 'SAN PABLO', 'FLORESTA', 'SAN GERMAN', 'SANTA MONICA', 'ÉXITO COLOMBIA', 'NUEVA VILLA ABURRA', 'BARRIO CORDOBA', 'ALMERIA', 'SAN JUAQUIN', 'UNICENTRO', 'LA TABLAZA', 'AMERICA NIZA', 'CORTIJO', 'LA CAMPAÑA', 'LA ALPUJARRA', 'SANTA TERESITA', 'FERRINI', 'CALASANZ PARTE ALTA', 'SIMÓN BOLÍVAR', 'BARRIO CRISTÓBAL', 'SANTA MÓNICA', 'CAMPO ALEGRE', 'EL DANUBIO', 'SANTA LUCÍA', 'LA FLORESTA', 'LA AMÉRICA', 'LOS OLIVOS', 'LOS PINOS', 'CALASANZ', 'SANTA MONICA N°1', 'SANTA MONICA N°2', 'FÁTIMA', 'ROSALES', 'BELEN', 'GRANADA', 'SAN BERNARDO', 'LAS PLAYAS', 'DIEGO ECHAVARRÍA', 'LA MOTA', 'LA HONDONADA', 'EL RINCÓN', 'LOMA DE LOS BERNAL', 'LA GLORIA', 'ALTAVISTA', 'LA PALMA', 'LOS ALPES', 'LAS VIOLETAS', 'LAS MERCEDES', 'NUEVA VILLA DEL ABURRÁ', 'MIRAVALLE', 'NOGAL LOS ALMENDROS', 'CERRO NUTIBARA', 'RODEO', 'ALAMEDA', 'ALIADAS', 'MALIBU', 'LA NUBIA', 'RODEO ALTO', 'GUAYABAL', 'MAYORCA', 'CRISTO REY', 'SANTA FE', 'ZONA INDUSTRIAL DE BELEN', 'LA COLINITA', 'CAMPO AMOR', 'EL PESEBRE', 'BLANQUIZAL', 'SANTA ROSA DE LIMA', 'LOS ALCÁZARES', 'METROPOLITANO', 'LA PRADERA', 'JUAN XXIII', 'ANTONIO NARIÑO', 'SAN JAVIER N.º 1', 'SAN JAVIER N.º 2', 'VEINTE DE JULIO', 'EL SALADO', 'NUEVOS CONQUISTADORES', 'LAS INDEPENDENCIAS', 'EL CORAZÓN', 'BELENCITO', 'BETANIA', 'EDUARDO SANTOS', 'EL SOCORRO', 'Andalucía ', 'ENVIGADO', 'LAS VEGAS', 'EL PORTAL', 'SAN MARCOS', 'PONTEVEDRA', 'JARDINES', 'VILLAGRANDE', 'LA SEBASTIANA', 'EL ESCOBERO', 'LAS FLORES', 'URIBE ÁNGEL', 'ALTO DE MISAEL', 'LAS ORQUÍDEAS', 'EL ESMERALDAL', 'LOMA EL ATRAVEZADO', 'ZUÑIGA', 'LOMA DE LAS BRUJAS', 'EL CHOCHO', 'LA INMACULADA', 'EL CHINGUÍ', 'LA MINA', 'SAN RAFAEL', 'LAS ANTILLAS', 'EL TRIANÓN', 'LOMA DEL BARRO', 'LA PAZ', 'LAS CASITAS', 'PRIMAVERA', 'MILÁN', 'VALLEJUELOS', 'ALCALÁ', 'EL DORADO', 'SAN JOSÉ', 'LOS NARANJOS', 'BARRIO MESA', 'ZONA CENTRO', 'BARRIO OBRERO', 'LA FRONTERA', 'BUCAREST', 'CUMBRES', 'CAMINO VERDE', 'LA SALLE', 'LA MAGNOLIA', 'LOMA DE LOS BENEDICTINOS', 'LA AVADIA', 'LOMA DEL ATRAVESADO', 'LOMA DEL CHOCHO', 'ACANTO', 'OTRA PARTE', 'GUALANDAYES', 'CENTRO DE ENVIGADO', 'LA FE', 'LA FLORIDA', 'EL GUÁIMARO', 'EL CONSUELO', 'LAS COMETAS', 'SEÑORIAL', 'SAN JOSE LAS ESTATUA', 'LOMA DE LOS MESA', 'Loma El Atravesado', 'Loma Del Escobero', 'Loma Benedictinos', 'La Catedral', 'La Abadia', 'La Cuenca', 'Loma Del Esmeraldal', 'Alto De Palmas', 'Oasis', 'MALL LA SEBASTIANA', 'MANGAZUL', 'Abadia', 'ALTO DE LAS FLORES', 'VEREDA LAS BRISAS', 'MARÍA AUXILIADORA', 'LAS LOMITAS', 'LA DOCTORA', 'CAÑAVERALEJO', 'PAN DE AZÚCAR', 'SABANETA', 'Villa del Carmen', 'Vereda CaÑaveralejo', 'Vereda San Jose', 'Loma San Jose', 'San Remo', 'Vereda Las Lomitas', 'Callejon Del Banco', 'ALIADAS DEL SUR', 'ANCON SUR', 'CALLE DEL BANCO', 'CALLE LARGA', 'EL CARMELO', 'ENTREAMIGOS', 'HOLANDA', 'LA BARQUEREÑA', 'LAGOS DE LA DOCTORA', 'LOS ALCAZARES', 'LOS ARIAS', 'MANUEL RESTREPO', 'MARIA AUXILIADORA', 'PAN DE AZUCAR', 'PASO ANCHO', 'PLAYAS DE MARÍA', 'PRADOS DE SABANETA', 'PROMISIÓN', 'RESTREPO NARANJO', 'SABANETA REAL', 'SAN JOAQUIN', 'SAN JOSE', 'SANTA ANA', 'TRES ESQUINAS', 'VEGAS DE LA DOCTORA', 'VEGAS DE SAN JOSE', 'VILLAS DEL CARMEN', 'VIRGEN DEL CARMEN', 'ZONA INDUSTRIAL ', 'LA INDEPENDENCIA', 'SAN JUAN BAUTISTA', 'ARAUCARIA', 'CENTRO', 'ASTURIAS', 'VILLA PAULA', 'ARTEX', 'PLAYA RICA', 'SATEXCO', 'SAN ISIDRO', 'LA SANTA CRUZ ', 'SANTA CATALINA', 'SAMARIA', 'LA FINCA', 'YARUMITO', 'EL PALMAR', 'LAS MARGARITAS', 'MALTA', 'GLORIETA PILSEN', 'MONTE VERDE', 'CAMPAROLA', 'SAN PIO X', 'LA PALAMA', 'JARDINES MONTESACRO', 'LAS BRISAS', 'PILSEN', 'SAN JAVIER', 'VILLA LIA', '19 DE ABRIL', 'SAN GABRIEL', 'SAN ANTONIO', 'TRIANA', 'DITAIRES', 'SAN FRANCISCO', 'SANTA MARIA ', 'COLINAS DEL SUR', 'CENTRAL MAYORISTA', 'SAN FERNANDO', 'LA RAYA (GUAYABAL)', 'LAS AMÉRICAS', 'EL TABLAZO', 'CALATRAVA', 'LOMA LINDA', 'TERRANOVA', 'LA ALDEA', 'FERRARA', 'BALCONES DE SEVILLA', 'EL ROSARIO', 'LA UNIÓN', 'SANTA MARÍA LA NUEVA', 'ITAGUI', 'BARILOCHE', 'VIVIENDAS DEL SUR', 'LA ESMERALDA', 'GUAYABALÍA', 'VILLA VENTURA', 'EL GUAYABO', 'ASDESILLAS', 'Centro De La Moda', 'Suramérica', 'ANCÓN SAN MARTÍN', 'VILLA ALICIA ', 'VILLA MIRA', 'BELLAVISTA', 'CAMILO TORRES', 'CAQUETA', 'CHILE', 'EL PEDRERO', 'ESCOBAR', 'HORIZONTES', 'LA CHINCA', 'LA FERREIRA', 'LA FERRERIA', 'LA OSPINA', 'MONTERREY', 'QUEBRADA GRANDE', 'SAN AGUSTÍN', 'SAN ANDRES', 'SAN CAYETANO', 'SAN VICENTE', 'ZONA INDUSTRIAL', 'LA ESTRELLA', 'LA TROJA', 'SURAMERICA', 'TABLAZA', 'VILLA ALCÁNTARA', 'Poblado Del Sur', 'LA INMACULADA 1', 'Casa Jardin', 'CALDAS', 'BARRIOS UNIDOS', 'LOS CEREZOS', 'OLAYA HERRERA', 'LA DOCENA', 'FELIPE ECHAVARRÍA ', 'LA CHUSCALA', 'LA PLANTA', 'LA ACUARELA ', 'ANDALUCÍA', 'LA GORETTY', 'VILLA CAPRI', 'LA BUENA ESPERANZA', 'FUNDADORES', 'CENTENARIO', 'MANDALAY', 'LA PLAYITA', 'ANSERMA', 'PORVENIR', 'LA DORADA CALDAS', 'MADERA', 'BELLO', 'NIQUIA', 'AUTOPISTA MEDELLIN - BOGOTÁ', 'NAVARRA', 'CABAÑAS', 'Bucaros', 'Amazonia', 'Molinares', 'CabaÑitas', 'El Trapiche', 'Salento', 'Manchester', 'SERRAMONTE', 'GORETTI', 'Mirador', 'COPACABANA', 'Vereda Nemqueteba', 'GIRARDOTA', 'CABILDO', 'BARBOSA', 'CHICÓ NAVARRA', 'ALTOS DE SERREZUELA', ' BALCONES DE VISTA HERMOSA', ' BALMORAL NORTE', ' BUENAVISTA', ' CHAPARRAL', ' EL CODITO', ' EL REFUGIO DE SAN ANTONIO', ' EL VERBENAL', ' HORIZONTES', ' LA ESTRELLITA', ' LA LLANURITA', ' LOS CONSUELOS', ' MARANTÁ', ' MATURÍN', ' MEDELLÍN', ' MIRADOR DEL NORTE', ' NUEVO HORIZONTE', ' SAN ANTONIO NORTE', ' SANTANDERSITO', ' TIBABITA', ' VIÑA DEL MAR.'];

        // Sistema de autocompletado inteligente para sectores
        function initializeSectorAutocomplete() {
            console.log('Inicializando autocompletado con sectores embebidos...');
            setupAutocomplete(SECTORES_COMPLETOS);
        }

        function setupAutocomplete(sectores) {
            const sectorInput = document.getElementById('sector');
            const suggestionsContainer = document.getElementById('sector-suggestions');
            let selectedIndex = -1;

            // Debug: verificar que todos los sectores se cargaron
            console.log(`Sectores cargados: ${sectores.length}`);

            sectorInput.addEventListener('input', function() {
                const query = this.value.trim();
                if (query.length < 2) {
                    hideSuggestions();
                    return;
                }

                const suggestions = findSectorMatches(query, sectores);
                showSuggestions(suggestions, query);
            });

            sectorInput.addEventListener('keydown', function(e) {
                const suggestions = suggestionsContainer.querySelectorAll('.autocomplete-suggestion');
                
                switch(e.key) {
                    case 'ArrowDown':
                        e.preventDefault();
                        selectedIndex = Math.min(selectedIndex + 1, suggestions.length - 1);
                        updateSelection(suggestions);
                        break;
                    case 'ArrowUp':
                        e.preventDefault();
                        selectedIndex = Math.max(selectedIndex - 1, -1);
                        updateSelection(suggestions);
                        break;
                    case 'Enter':
                        e.preventDefault();
                        if (selectedIndex >= 0 && suggestions[selectedIndex]) {
                            selectSuggestion(suggestions[selectedIndex].textContent);
                        }
                        break;
                    case 'Escape':
                        hideSuggestions();
                        break;
                }
            });

            sectorInput.addEventListener('blur', function() {
                // Delay para permitir clicks en sugerencias
                setTimeout(() => hideSuggestions(), 150);
            });

            function findSectorMatches(query, sectores) {
                if (!query || query.length < 2) return [];
                
                const normalizedQuery = normalizeText(query);
                console.log('🔍 Buscando:', query, '→ normalizado:', normalizedQuery);
                
                const matches = [];
                
                sectores.forEach(sector => {
                    const normalizedSector = normalizeText(sector);
                    
                    // 1. COINCIDENCIA EXACTA (100 puntos)
                    if (normalizedSector === normalizedQuery) {
                        matches.push({ sector, score: 100, type: 'exacto' });
                        return;
                    }

                    // 2. COINCIDENCIA AL INICIO (95 puntos)
                    if (normalizedSector.startsWith(normalizedQuery)) {
                        matches.push({ sector, score: 95, type: 'inicio' });
                        return;
                    }

                    // 3. CONTIENE LA BÚSQUEDA COMPLETA (85 puntos)
                    if (normalizedSector.includes(normalizedQuery)) {
                        matches.push({ sector, score: 85, type: 'contiene' });
                        return;
                    }

                    // 4. BÚSQUEDA POR PALABRAS INDIVIDUALES (80-90 puntos)
                    const queryWords = normalizedQuery.split(' ').filter(word => word.length >= 2);
                    const sectorWords = normalizedSector.split(' ').filter(word => word.length >= 2);
                    
                    let wordMatches = 0;
                    let partialMatches = 0;
                    
                    queryWords.forEach(queryWord => {
                        sectorWords.forEach(sectorWord => {
                            if (sectorWord === queryWord) {
                                wordMatches += 2; // Coincidencia exacta de palabra
                            } else if (sectorWord.includes(queryWord) && queryWord.length >= 3) {
                                wordMatches += 1; // Coincidencia parcial
                            } else if (queryWord.includes(sectorWord) && sectorWord.length >= 3) {
                                partialMatches += 1; // Palabra del sector contenida en query
                            }
                        });
                    });

                    if (wordMatches > 0) {
                        const wordScore = Math.min(90, 70 + (wordMatches * 5) + (partialMatches * 2));
                        matches.push({ sector, score: wordScore, type: 'palabras' });
                        return;
                    }

                    // 5. CORRECCIÓN DE ERRORES COMUNES (60-80 puntos)
                    const queryFixed = fixCommonTypos(normalizedQuery);
                    if (queryFixed !== normalizedQuery) {
                        if (normalizedSector.includes(queryFixed)) {
                            matches.push({ sector, score: 75, type: 'corregido' });
                            return;
                        }
                        if (normalizedSector.startsWith(queryFixed)) {
                            matches.push({ sector, score: 80, type: 'corregido-inicio' });
                            return;
                        }
                    }

                    // 6. BÚSQUEDA FUZZY INTELIGENTE (50-70 puntos)
                    if (normalizedQuery.length >= 4) {
                        const similarity = calculateSimilarity(normalizedQuery, normalizedSector);
                        
                        if (similarity >= 70) {
                            matches.push({ sector, score: Math.round(similarity), type: 'fuzzy-alta' });
                        } else if (similarity >= 50 && normalizedQuery.length >= 6) {
                            matches.push({ sector, score: Math.round(similarity), type: 'fuzzy-media' });
                        }
                    }

                    // 7. BÚSQUEDA SIN ESPACIOS PARA ERRORES DE TIPEO (40-60 puntos)
                    const queryNoSpaces = normalizedQuery.replace(/\s/g, '');
                    const sectorNoSpaces = normalizedSector.replace(/\s/g, '');
                    
                    if (queryNoSpaces.length >= 4) {
                        if (sectorNoSpaces.includes(queryNoSpaces)) {
                            matches.push({ sector, score: 55, type: 'sin-espacios' });
                        } else if (sectorNoSpaces.startsWith(queryNoSpaces)) {
                            matches.push({ sector, score: 60, type: 'sin-espacios-inicio' });
                        }
                    }
                });

                // Ordenar por score y limitar resultados
                const sortedMatches = matches
                    .sort((a, b) => b.score - a.score)
                    .slice(0, 8);
                    
                console.log('🎯 Mejores resultados para "' + query + '":', 
                    sortedMatches.map(m => `${m.sector} (${m.score}% - ${m.type})`));
                
                return sortedMatches.map(match => match.sector);
            }

            // Función para corregir errores de tipeo comunes
            function fixCommonTypos(text) {
                const corrections = {
                    // Errores comunes en sectores populares
                    'pblado': 'poblado',
                    'plado': 'poblado',
                    'pobldo': 'poblado',
                    'pbaldo': 'poblado',
                    'larels': 'laureles',
                    'laurles': 'laureles',
                    'laureles': 'laureles',
                    'laurees': 'laureles',
                    'envgado': 'envigado',
                    'envigdo': 'envigado',
                    'enbigado': 'envigado',
                    'sabneta': 'sabaneta',
                    'sabanta': 'sabaneta',
                    'sabanet': 'sabaneta',
                    'itagy': 'itagui',
                    'itagi': 'itagui',
                    'itagüi': 'itagui',
                    'itague': 'itagui',
                    'beln': 'belen',
                    'belan': 'belen',
                    'blen': 'belen',
                    'guaybal': 'guayabal',
                    'guaybal': 'guayabal',
                    'guaybal': 'guayabal',
                    'caldas': 'caldas',
                    'caldas': 'caldas',
                    'belo': 'bello',
                    'bllo': 'bello',
                    'estrela': 'estrella',
                    'estrlla': 'estrella'
                };

                let corrected = text.toLowerCase();
                
                // Aplicar correcciones directas
                for (const [error, correction] of Object.entries(corrections)) {
                    if (corrected.includes(error)) {
                        corrected = corrected.replace(new RegExp(error, 'g'), correction);
                    }
                }

                return corrected;
            }

            // Función mejorada de similitud con peso para errores comunes
            function calculateSimilarity(str1, str2) {
                if (str1 === str2) return 100;
                
                const len1 = str1.length;
                const len2 = str2.length;
                const maxLen = Math.max(len1, len2);
                
                if (maxLen === 0) return 100;
                
                // Calcular distancia de Levenshtein
                const distance = levenshteinDistance(str1, str2);
                
                // Ajustar puntuación basada en longitud y patrones
                let similarity = ((maxLen - distance) / maxLen) * 100;
                
                // Bonificación si una cadena contiene la otra
                if (str1.includes(str2) || str2.includes(str1)) {
                    similarity += 10;
                }
                
                // Bonificación si comienzan igual
                const commonPrefix = getCommonPrefix(str1, str2);
                if (commonPrefix.length >= 3) {
                    similarity += (commonPrefix.length / maxLen) * 15;
                }
                
                // Penalización por diferencia de longitud muy grande
                const lengthDiff = Math.abs(len1 - len2);
                if (lengthDiff > maxLen * 0.5) {
                    similarity -= 10;
                }
                
                return Math.min(100, Math.max(0, similarity));
            }

            // Función auxiliar para obtener prefijo común
            function getCommonPrefix(str1, str2) {
                let i = 0;
                while (i < str1.length && i < str2.length && str1[i] === str2[i]) {
                    i++;
                }
                return str1.substring(0, i);
            }

            function normalizeText(text) {
                return text
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '') // Remover acentos
                    .replace(/[ñ]/g, 'n') // Normalizar ñ
                    .replace(/[°º]/g, '') // Remover símbolos de grado
                    .replace(/[^\w\s]/g, ' ') // Convertir símbolos a espacios
                    .replace(/\s+/g, ' ') // Espacios múltiples a uno
                    .trim();
            }

            function levenshteinDistance(str1, str2) {
                const matrix = [];
                for (let i = 0; i <= str2.length; i++) {
                    matrix[i] = [i];
                }
                for (let j = 0; j <= str1.length; j++) {
                    matrix[0][j] = j;
                }
                for (let i = 1; i <= str2.length; i++) {
                    for (let j = 1; j <= str1.length; j++) {
                        if (str2.charAt(i - 1) === str1.charAt(j - 1)) {
                            matrix[i][j] = matrix[i - 1][j - 1];
                        } else {
                            matrix[i][j] = Math.min(
                                matrix[i - 1][j - 1] + 1,
                                matrix[i][j - 1] + 1,
                                matrix[i - 1][j] + 1
                            );
                        }
                    }
                }
                return matrix[str2.length][str1.length];
            }

            function showSuggestions(suggestions, query) {
                selectedIndex = -1;
                
                if (suggestions.length === 0) {
                    suggestionsContainer.innerHTML = '<div class="autocomplete-no-results">No se encontraron sectores similares</div>';
                } else {
                    const normalizedQuery = normalizeText(query);
                    suggestionsContainer.innerHTML = suggestions.map(sector => {
                        const highlighted = highlightMatch(sector, query);
                        return `<div class="autocomplete-suggestion" data-sector="${sector}">${highlighted}</div>`;
                    }).join('');

                    // Agregar event listeners a las sugerencias
                    suggestionsContainer.querySelectorAll('.autocomplete-suggestion').forEach(suggestion => {
                        suggestion.addEventListener('click', function() {
                            selectSuggestion(this.dataset.sector);
                        });
                    });
                }

                suggestionsContainer.classList.add('show');
            }

            function highlightMatch(sector, query) {
                const normalizedSector = normalizeText(sector);
                const normalizedQuery = normalizeText(query);
                
                // Intentar resaltar coincidencia exacta primero
                let exactIndex = normalizedSector.indexOf(normalizedQuery);
                if (exactIndex !== -1) {
                    // Encontrar la posición real en el sector original
                    let realIndex = 0;
                    let normalizedIndex = 0;
                    
                    while (normalizedIndex < exactIndex && realIndex < sector.length) {
                        if (normalizeText(sector[realIndex]) === normalizedSector[normalizedIndex]) {
                            normalizedIndex++;
                        }
                        realIndex++;
                    }
                    
                    const start = sector.substring(0, realIndex);
                    const matchLength = query.length;
                    const match = sector.substring(realIndex, realIndex + matchLength);
                    const end = sector.substring(realIndex + matchLength);
                    
                    return `${start}<span class="match">${match}</span>${end}`;
                }

                // Si no hay coincidencia exacta, intentar resaltar palabras individuales
                const queryWords = normalizedQuery.split(' ').filter(word => word.length >= 2);
                let highlightedSector = sector;
                
                queryWords.forEach(word => {
                    if (word.length >= 3) {
                        // Crear una expresión regular para encontrar la palabra (insensible a mayúsculas)
                        const regex = new RegExp(`\\b(${escapeRegex(word)})`, 'gi');
                        highlightedSector = highlightedSector.replace(regex, '<span class="match">$1</span>');
                    }
                });
                
                return highlightedSector;
            }

            function escapeRegex(string) {
                return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            }

            function updateSelection(suggestions) {
                suggestions.forEach((suggestion, index) => {
                    suggestion.classList.toggle('selected', index === selectedIndex);
                });
            }

            function selectSuggestion(sector) {
                sectorInput.value = sector;
                hideSuggestions();
                sectorInput.focus();
            }

            function hideSuggestions() {
                suggestionsContainer.classList.remove('show');
                selectedIndex = -1;
            }
        }

        // Manejar cambios en la selección de sucursal
        function handleBranchChange() {
            const branchSelect = document.querySelector('#branch');
            const sectorInput = document.querySelector('#sector');
            const sectorLabel = document.querySelector('label[for="sector"]');
            
            if (branchSelect && sectorInput && sectorLabel) {
                branchSelect.addEventListener('change', function() {
                    const selectedBranch = this.value;
                    
                    if (selectedBranch && selectedBranch !== 'Todos') {
                        // Sucursal específica seleccionada - sector se vuelve opcional
                        sectorInput.style.opacity = '0.7';
                        sectorInput.placeholder = 'Opcional (puedes dejarlo vacío)';
                        sectorInput.removeAttribute('required'); // Quitar validación required
                        sectorLabel.innerHTML = '<i class="fas fa-map-marker-alt"></i> Sector <small class="text-muted">(opcional)</small>';
                        
                        console.log(`Sucursal ${selectedBranch} seleccionada - sector es ahora opcional`);
                    } else {
                        // "Todas las sucursales" seleccionado - sector es obligatorio
                        sectorInput.style.opacity = '1';
                        sectorInput.placeholder = 'Ej: El Poblado, Laureles, Envigado...';
                        sectorInput.setAttribute('required', 'required'); // Agregar validación required
                        sectorLabel.innerHTML = '<i class="fas fa-map-marker-alt"></i> Sector';
                        
                        console.log('Todas las sucursales seleccionadas - sector es obligatorio');
                    }
                });
                
                // Ejecutar una vez al cargar para establecer el estado inicial
                branchSelect.dispatchEvent(new Event('change'));
            }
        }

        // Inicializar el manejo de cambios de sucursal
        handleBranchChange();

        console.log('Aplicación de búsqueda de inmuebles iniciada correctamente');
    </script>
</body>
</html>
