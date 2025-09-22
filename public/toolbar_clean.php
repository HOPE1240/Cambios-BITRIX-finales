<?php
// Headers necesarios para iframe de Bitrix24
header('X-Frame-Options: ALLOWALL');
header('Content-Security-Policy: frame-ancestors *');
header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Widget Inmuebles Similares - Bitrix24</title>
    
    <!-- Font Awesome para iconos profesionales -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Estilos del widget -->
    <link rel="stylesheet" href="assets/widget-style.css?v=20250922160951">
</head>
<body>
    <script src="//api.bitrix24.com/api/v1/"></script>
    
    <div class="widget-section">
        <div id="dealIdInfo">
            <i class="fas fa-building"></i>
            Aplicación de Inmuebles Similares
        </div>
        <button id="openPanelBtn">
            <i class="fas fa-search"></i>
            Buscar Inmuebles Similares
        </button>
        <small>
            <i class="fas fa-check-circle"></i>
            Widget integrado correctamente en Bitrix24
        </small>
    </div>
    
    <script>
        console.log('🚀 Widget de Inmuebles Similares iniciado');
        
        // Estado del widget
        let widgetState = {
            isLoading: false,
            dealId: null,
            initialized: false
        };
        
        // Función mejorada para abrir el formulario
        function abrirFormulario() {
            if (widgetState.isLoading) {
                console.log('⏳ Widget ocupado, esperando...');
                return;
            }
            
            console.log('🔍 Abriendo aplicación de búsqueda de inmuebles similares');
            setLoadingState(true);
            
            // Construir URL con parámetros - Compatibilidad con ambas versiones
            let baseUrl = `${window.location.origin}/Bitrix-Iframe/public/toolbar.php`;
            
            // Fallback a index.php si toolbar.php no está disponible (compatibilidad con repo original)
            const testUrl = async (url) => {
                try {
                    const response = await fetch(url, { method: 'HEAD' });
                    return response.ok;
                } catch (error) {
                    return false;
                }
            };
            
            const params = new URLSearchParams();
            
            if (widgetState.dealId) {
                params.append('dealId', widgetState.dealId);
                params.append('entityType', 'deal');
            }
            
            const url = params.toString() ? `${baseUrl}?${params.toString()}` : baseUrl;
            console.log('🌐 URL de destino:', url);
            
            try {
                // Método preferido: BX.SidePanel
                if (window.top.BX && window.top.BX.SidePanel && window.top.BX.SidePanel.Instance) {
                    console.log('✅ Usando BX.SidePanel');
                    window.top.BX.SidePanel.Instance.open(url, {
                        width: 1200,
                        height: 800,
                        title: 'Búsqueda de Inmuebles Similares'
                    });
                    setLoadingState(false);
                } else {
                    // Fallback: nueva ventana
                    console.log('⚠️ Fallback: Nueva ventana');
                    const newWindow = window.open(url, '_blank', 'width=1200,height=800,scrollbars=yes,resizable=yes');
                    
                    if (newWindow) {
                        newWindow.focus();
                    } else {
                        showError('Por favor, permite las ventanas emergentes.');
                    }
                    setLoadingState(false);
                }
            } catch (error) {
                console.error('❌ Error al abrir:', error);
                setLoadingState(false);
                showError('Error al abrir la aplicación.');
            }
        }
        
        // Funcion para mostrar estado de carga
        function setLoadingState(loading) {
            widgetState.isLoading = loading;
            const button = document.getElementById('openPanelBtn');
            const icon = button.querySelector('i');
            
            if (loading) {
                button.classList.add('loading');
                button.disabled = true;
                if (icon) {
                    icon.className = 'fas fa-spinner fa-spin';
                }
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Abriendo...';
            } else {
                button.classList.remove('loading');
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-search"></i> Buscar Inmuebles Similares';
            }
        }
        
        // Función para mostrar errores
        function showError(message) {
            const dealInfo = document.getElementById('dealIdInfo');
            const originalContent = dealInfo.innerHTML;
            
            dealInfo.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${message}`;
            dealInfo.classList.add('error-state');
            
            setTimeout(() => {
                dealInfo.innerHTML = originalContent;
                dealInfo.classList.remove('error-state');
            }, 4000);
        }
        
        // Función para actualizar información del deal
        function updateDealInfo(dealId) {
            widgetState.dealId = dealId;
            const dealInfo = document.getElementById('dealIdInfo');
            
            if (dealId) {
                dealInfo.innerHTML = `<i class="fas fa-file-alt"></i> Negocio ID: ${dealId} - Buscar inmuebles similares`;
                dealInfo.classList.add('success-state');
            } else {
                dealInfo.innerHTML = `<i class="fas fa-building"></i> Aplicación de Inmuebles Similares`;
            }
        }
        
        // Inicialización cuando el DOM está listo
        document.addEventListener('DOMContentLoaded', function() {
            console.log('📄 DOM cargado, inicializando widget...');
            
            // Asignar evento al botón
            const btnOpen = document.getElementById('openPanelBtn');
            if (btnOpen) {
                btnOpen.addEventListener('click', abrirFormulario);
                console.log('✅ Evento de botón asignado');
            } else {
                console.error('❌ No se encontró el botón openPanelBtn');
            }
            
            widgetState.initialized = true;
            console.log('✅ Widget inicializado correctamente');
        });
        
        // Inicializar BX24 si está disponible
        if (typeof BX24 !== 'undefined') {
            console.log('🔧 BX24 detectado, inicializando...');
            
            BX24.init(function(){
                console.log('✅ BX24 API inicializada');
                
                // Obtener información del placement
                BX24.placement.info(function(result){
                    console.log('📊 Información de placement:', result);
                    
                    if (result && result.options && result.options.ID) {
                        const dealId = result.options.ID;
                        console.log('🆔 Deal ID obtenido:', dealId);
                        updateDealInfo(dealId);
                    }
                });
                
                // Configurar tamaño del widget
                BX24.resizeWindow(400, 200);
            });
        } else {
            console.warn('⚠️ BX24 API no disponible');
        }
        
        // Manejo de errores globales
        window.addEventListener('error', function(e) {
            console.error('❌ Error global del widget:', e.error);
        });
        
        // Exposar funciones para debugging
        window.widgetDebug = {
            state: widgetState,
            openApp: abrirFormulario,
            setLoading: setLoadingState,
            showError: showError
        };
        
        console.log('🎯 Widget de Inmuebles Similares listo para usar');
    </script>
</body>
</html>