# 🚀 INSTALACIÓN PLACEMENT BITRIX24 - INMUEBLES SIMILARES

## 📋 Información del Sistema

### URLs Activas
- **Aplicación Principal**: https://9ae31cd8ce4b.ngrok-free.app/Bitrix-Iframe/public/toolbar.php
- **Handler del Placement**: https://9ae31cd8ce4b.ngrok-free.app/Bitrix-Iframe/public/toolbar_clean.php
- **Instalador Web**: https://9ae31cd8ce4b.ngrok-free.app/Bitrix-Iframe/placement_installer.html

### Configuración OAuth
- **Client ID**: FoxEAOqFLaqn7mLgW7CsbbiTosYOfNl7T743YCoymZqJvNZpa8
- **Placement**: CRM_DEAL_DETAIL_TAB
- **Título**: Inmuebles Similares

## 🎯 MÉTODOS DE INSTALACIÓN

### MÉTODO 1: Instalador Web Completo ⭐ (RECOMENDADO)
```
URL: https://9ae31cd8ce4b.ngrok-free.app/Bitrix-Iframe/placement_installer.html
```

**Pasos:**
1. Abre Bitrix24 en tu navegador
2. Ve a la URL del instalador
3. Haz clic en "🚀 Instalar Placement"
4. Verifica que aparezca el mensaje de éxito
5. Ve a CRM → Negocios → Abre cualquier negocio
6. Busca el tab "Inmuebles Similares"

### MÉTODO 2: Script de Consola 🛠️
```javascript
// Copia y pega en la consola del navegador (F12) dentro de Bitrix24
```

**Pasos:**
1. Abre Bitrix24 en tu navegador
2. Presiona F12 para abrir las herramientas de desarrollador
3. Ve a la pestaña "Console"
4. Copia todo el contenido de `console_installer.js`
5. Pégalo en la consola y presiona Enter
6. Sigue las instrucciones en pantalla

### MÉTODO 3: API Manual 🔧
```javascript
BX24.callMethod('placement.bind', {
    PLACEMENT: 'CRM_DEAL_DETAIL_TAB',
    HANDLER: 'https://9ae31cd8ce4b.ngrok-free.app/Bitrix-Iframe/public/toolbar_clean.php',
    TITLE: 'Inmuebles Similares',
    DESCRIPTION: 'Búsqueda inteligente de inmuebles similares'
});
```

## ✅ VERIFICACIÓN DE INSTALACIÓN

### Cómo verificar que funciona:
1. **Ve a CRM → Negocios**
2. **Abre cualquier negocio existente**
3. **Busca el tab "Inmuebles Similares"** en los detalles
4. **Haz clic en el tab** - debe abrir la aplicación
5. **Verifica que carga la interfaz** de búsqueda de propiedades

### Si no aparece el tab:
1. Verifica que eres administrador de Bitrix24
2. Refresca la página del negocio
3. Verifica que ngrok sigue activo
4. Ejecuta el verificador de estado

## 🔧 COMANDOS DE VERIFICACIÓN

### Verificar ngrok activo:
```powershell
Invoke-WebRequest -Uri "https://9ae31cd8ce4b.ngrok-free.app/Bitrix-Iframe/public/toolbar.php" -Method Head
```

### Verificar placement instalado (consola Bitrix24):
```javascript
BX24.callMethod('placement.list', {}, function(result) {
    console.log(result.data());
});
```

### Eliminar placement si es necesario:
```javascript
BX24.callMethod('placement.unbind', {
    PLACEMENT: 'CRM_DEAL_DETAIL_TAB',
    HANDLER: 'https://9ae31cd8ce4b.ngrok-free.app/Bitrix-Iframe/public/toolbar_clean.php'
});
```

## 📁 ARCHIVOS CREADOS

1. **placement_installer.html** - Instalador web completo con interfaz gráfica
2. **placement_installer_2025.js** - Script JavaScript para integración automática
3. **console_installer.js** - Script para consola del navegador
4. **toolbar.php** - Aplicación principal (ya existía, mejorada)
5. **toolbar_clean.php** - Handler del placement (ya existía, mejorada)

## 🛡️ SEGURIDAD Y AUTENTICACIÓN

- ✅ **Iframe Headers**: X-Frame-Options: ALLOWALL
- ✅ **CSP Policy**: frame-ancestors *
- ✅ **OAuth 2.0**: Client ID configurado
- ✅ **JWT Authentication**: Provider key actualizada
- ✅ **HTTPS**: Ngrok con SSL

## 🎯 PRÓXIMOS PASOS

1. **Ejecutar instalación** usando el método preferido
2. **Verificar funcionamiento** en un negocio real
3. **Documentar el proceso** para otros usuarios
4. **Configurar OAuth** permanente si es necesario
5. **Migrar a dominio propio** cuando esté listo

## 📞 SOPORTE

Si algún método falla:
1. Verifica que ngrok sigue activo
2. Confirma permisos de administrador en Bitrix24
3. Revisa la consola del navegador para errores
4. Usa el instalador web que tiene diagnósticos integrados

---

**Última actualización**: 22 Sep 2025, 19:40 GMT
**Estado ngrok**: ✅ Activo
**Estado API**: ✅ Funcionando