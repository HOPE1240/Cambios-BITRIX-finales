// 🚀 SCRIPT DE INSTALACIÓN AUTOMÁTICA PLACEMENT - BITRIX24 2025
// Basado en la documentación oficial: https://apidocs.bitrix24.com/api-reference/widgets/placement-bind.html

(function() {
    'use strict';
    
    console.log('🚀 Iniciando instalación automática de placement CRM_DEAL_DETAIL_TAB...');
    
    // Configuración según documentación 2025
    const PLACEMENT_CONFIG = {
        PLACEMENT: 'CRM_DEAL_DETAIL_TAB',
        HANDLER: 'https://9ae31cd8ce4b.ngrok-free.app/Bitrix-Iframe/public/toolbar_clean.php',
        TITLE: 'Inmuebles Similares',
        DESCRIPTION: 'Búsqueda inteligente de inmuebles similares',
        LANG_ALL: {
            es: {
                TITLE: 'Inmuebles Similares',
                DESCRIPTION: 'Búsqueda inteligente de inmuebles similares'
            },
            en: {
                TITLE: 'Similar Properties',
                DESCRIPTION: 'Smart property search tool'
            }
        }
    };
    
    // Función para registrar el placement usando placement.bind
    function registerPlacementOfficial() {
        return new Promise((resolve, reject) => {
            console.log('📋 Registrando placement usando placement.bind (método oficial)...');
            
            if (typeof BX24 === 'undefined') {
                reject(new Error('BX24 no está disponible'));
                return;
            }
            
            BX24.callMethod('placement.bind', PLACEMENT_CONFIG, function(result) {
                if (result.error()) {
                    console.error('❌ Error en placement.bind:', result.error(), result.error_description());
                    reject(new Error(result.error_description()));
                } else {
                    console.log('✅ Placement registrado correctamente:', result.data());
                    resolve(result.data());
                }
            });
        });
    }
    
    // Función para verificar si el placement ya existe
    function checkExistingPlacements() {
        return new Promise((resolve) => {
            console.log('🔍 Verificando placements existentes...');
            
            if (typeof BX24 === 'undefined') {
                resolve([]);
                return;
            }
            
            BX24.callMethod('placement.list', {}, function(result) {
                if (result.error()) {
                    console.warn('⚠️ Error al obtener lista de placements:', result.error());
                    resolve([]);
                } else {
                    const placements = result.data();
                    console.log('📋 Placements existentes:', placements);
                    resolve(placements);
                }
            });
        });
    }
    
    // Función para eliminar placement existente si es necesario
    function unbindExistingPlacement() {
        return new Promise((resolve) => {
            console.log('🗑️ Eliminando placement existente...');
            
            BX24.callMethod('placement.unbind', {
                PLACEMENT: PLACEMENT_CONFIG.PLACEMENT,
                HANDLER: PLACEMENT_CONFIG.HANDLER
            }, function(result) {
                if (result.error()) {
                    console.warn('⚠️ No se pudo eliminar placement existente:', result.error());
                } else {
                    console.log('✅ Placement existente eliminado');
                }
                resolve();
            });
        });
    }
    
    // Función principal de instalación
    async function installPlacement() {
        try {
            console.log('🔧 Iniciando instalación del placement...');
            
            // Paso 1: Verificar si BX24 está disponible
            if (typeof BX24 === 'undefined') {
                throw new Error('BX24 API no está disponible. Asegúrate de estar en Bitrix24.');
            }
            
            // Paso 2: Inicializar BX24
            await new Promise((resolve) => {
                BX24.init(() => {
                    console.log('✅ BX24 inicializado');
                    resolve();
                });
            });
            
            // Paso 3: Verificar placements existentes
            const existingPlacements = await checkExistingPlacements();
            const existingPlacement = existingPlacements.find(p => 
                p.placement === PLACEMENT_CONFIG.PLACEMENT && 
                p.handler === PLACEMENT_CONFIG.HANDLER
            );
            
            if (existingPlacement) {
                console.log('⚠️ Placement ya existe, eliminando primero...');
                await unbindExistingPlacement();
            }
            
            // Paso 4: Registrar el nuevo placement
            const result = await registerPlacementOfficial();
            
            console.log('🎉 ¡Placement instalado correctamente!');
            
            // Paso 5: Mostrar confirmación
            if (typeof BX24.fitWindow === 'function') {
                BX24.fitWindow();
            }
            
            // Crear notificación visual
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #28a745;
                color: white;
                padding: 15px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.2);
                z-index: 10000;
                font-family: Arial, sans-serif;
                font-size: 14px;
                max-width: 300px;
            `;
            notification.innerHTML = `
                <strong>✅ Instalación Exitosa</strong><br>
                El tab "Inmuebles Similares" ya está disponible en los negocios.<br>
                <small>Ve a CRM → Negocios → Abre cualquier negocio</small>
            `;
            
            document.body.appendChild(notification);
            
            // Remover notificación después de 8 segundos
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 8000);
            
            return true;
            
        } catch (error) {
            console.error('❌ Error en instalación:', error);
            
            // Mostrar error visual
            const errorNotification = document.createElement('div');
            errorNotification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #dc3545;
                color: white;
                padding: 15px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.2);
                z-index: 10000;
                font-family: Arial, sans-serif;
                font-size: 14px;
                max-width: 300px;
            `;
            errorNotification.innerHTML = `
                <strong>❌ Error en Instalación</strong><br>
                ${error.message}<br>
                <small>Verifica que tengas permisos de administrador</small>
            `;
            
            document.body.appendChild(errorNotification);
            
            setTimeout(() => {
                if (errorNotification.parentNode) {
                    errorNotification.parentNode.removeChild(errorNotification);
                }
            }, 10000);
            
            return false;
        }
    }
    
    // Ejecutar instalación automática
    function onReady(callback) {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', callback);
        } else {
            callback();
        }
    }
    
    onReady(() => {
        // Esperar un momento para que BX24 se inicialice
        setTimeout(() => {
            installPlacement();
        }, 1000);
    });
    
    // Exportar para uso manual
    window.InmueblesSimilaresPlacement = {
        install: installPlacement,
        config: PLACEMENT_CONFIG,
        register: registerPlacementOfficial,
        check: checkExistingPlacements
    };
    
})();