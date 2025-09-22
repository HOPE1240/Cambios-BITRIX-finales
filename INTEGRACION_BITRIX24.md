# 🏠 Integración de Inmuebles Similares con Bitrix24

## 📋 Requisitos Previos

1. **Servidor web** con PHP 7.4+ (XAMPP, WAMP, o servidor de producción)
2. **Acceso de administrador** a Bitrix24
3. **Dominio público** o servidor accesible desde Internet (para producción)

## 🚀 Pasos de Instalación

### 1. Configuración del Servidor

1. **Subir archivos** a tu servidor web:
   ```
   /ruta-de-tu-servidor/Bitrix-Iframe/
   ├── api/
   ├── config/
   ├── public/
   └── README.md
   ```

2. **Verificar permisos** de escritura en la carpeta `api/` para el archivo `jwt_token.txt`

3. **Probar acceso** directo:
   ```
   https://tu-dominio.com/Bitrix-Iframe/public/index.php
   ```

### 2. Configuración en Bitrix24

#### 2.1 Crear Aplicación Local

1. Ir a **Bitrix24** → **Aplicaciones** → **Desarrollador** → **Aplicaciones locales**
2. Hacer clic en **"Crear aplicación local"**
3. Llenar los datos:
   - **Nombre**: `Inmuebles Similares`
   - **Código**: `inmuebles_similares`
   - **Tipo**: `Aplicación web`

#### 2.2 Configurar Placement (Ubicación)

1. En la configuración de la aplicación, ir a **"Ubicaciones"**
2. Agregar nueva ubicación:
   - **Tipo**: `CRM_DEAL_DETAIL_TAB` (para deals/negocios)
   - **URL del handler**: `https://tu-dominio.com/Bitrix-Iframe/public/toolbar.php`
   - **Título**: `Inmuebles Similares`

#### 2.3 Configuraciones Adicionales

**Para otros módulos CRM:**
- `CRM_LEAD_DETAIL_TAB` - Prospectos
- `CRM_CONTACT_DETAIL_TAB` - Contactos  
- `CRM_COMPANY_DETAIL_TAB` - Empresas

### 3. URLs de Configuración

**Para desarrollo local (XAMPP):**
```
Handler URL: http://localhost/Bitrix-Iframe/public/toolbar.php
```

**Para producción:**
```
Handler URL: https://tu-dominio.com/Bitrix-Iframe/public/toolbar.php
```

### 4. Verificación de Funcionamiento

1. **Ir a un Deal/Negocio** en Bitrix24
2. **Buscar la pestaña** "Inmuebles Similares"
3. **Hacer clic en el botón** "🏠 Buscar Inmuebles Similares"
4. **Verificar** que se abre el panel lateral con el formulario

## 🔧 Configuración Avanzada

### Variables de Entorno (Opcional)

Crear archivo `.env` en la raíz del proyecto:
```env
MOBILIA_BASE_URL=http://54.145.54.14:8080/mobilia-test/ws/Extra
MOBILIA_AUTH_URL=http://54.145.54.14:8080/mobilia-test/ws/Auth
MOBILIA_PROVIDER_KEY=8492C616295D3CABC67FDF19DF547
```

### SSL/HTTPS (Recomendado para producción)

1. **Configurar certificado SSL** en tu servidor
2. **Actualizar todas las URLs** a `https://`
3. **Verificar** que Bitrix24 puede acceder a tu servidor

## 🐛 Solución de Problemas

### Error 404
- Verificar que las rutas en `app.js` sean correctas
- Comprobar que Apache/Nginx esté funcionando
- Revisar permisos de archivos

### No se muestra la pestaña
- Verificar que la URL del handler sea accesible desde Internet
- Comprobar la configuración de Placement en Bitrix24
- Revisar los logs de Bitrix24

### Error de autenticación JWT
- Verificar las credenciales en `config/config.php`
- Comprobar permisos de escritura en `api/jwt_token.txt`
- Revisar conectividad con la API de Mobilia

## 📞 Soporte

Si tienes problemas con la integración:
1. Revisar los logs del servidor web
2. Usar las herramientas de desarrollador del navegador
3. Verificar la configuración de red y SSL