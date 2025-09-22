<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            padding: 20px;
            margin: 0;
            background: #f8f9fa;
            text-align: center;
        }
        .widget-section {
            background: #e8f5e8;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #4caf50;
        }
        button {
            background: #0078d7;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            margin: 5px;
            transition: background 0.2s;
        }
        button:hover {
            background: #005fa3;
        }
        #dealIdInfo {
            background: #fff;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 14px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <script src="//api.bitrix24.com/api/v1/"></script>
    
    <div class="widget-section">
        <div id="dealIdInfo">Aplicación de Inmuebles Similares</div>
        <button id="openPanelBtn">🏠 Buscar Inmuebles Similares</button>
        <br><br>
        <small>Widget integrado correctamente en Bitrix24</small>
    </div>
    
    <script>
        console.log('Widget de Inmuebles Similares iniciado');
        
        // Función para abrir el formulario
        function abrirFormulario() {
            console.log('Abriendo formulario de búsqueda');
            const url = `${window.location.origin}/Bitrix-Iframe/public/index.php`;
            
            try {
                if (window.top.BX && window.top.BX.SidePanel && window.top.BX.SidePanel.Instance) {
                    window.top.BX.SidePanel.Instance.open(url, { 
                        width: 1200,
                        title: 'Búsqueda de Inmuebles Similares'
                    });
                } else {
                    window.open(url, '_blank', 'width=1200,height=800');
                }
            } catch (e) {
                console.error('Error al abrir:', e);
                window.open(url, '_blank', 'width=1200,height=800');
            }
        }
        
        // Asignar evento al botón
        document.addEventListener('DOMContentLoaded', function() {
            const btnOpen = document.getElementById('openPanelBtn');
            if (btnOpen) {
                btnOpen.onclick = abrirFormulario;
            }
        });
        
        // Inicializar BX24 si está disponible
        if (typeof BX24 !== 'undefined') {
            BX24.init(function(){
                console.log('BX24 disponible');
                
                BX24.placement.info(function(ctx){
                    console.log('Contexto:', ctx);
                    
                    if (ctx.options?.ID) {
                        const dealId = ctx.options.ID;
                        document.getElementById('dealIdInfo').textContent = 
                            `Negocio ID: ${dealId} - Buscar inmuebles similares`;
                    }
                });
            });
        }
    </script>
</body>
</html>