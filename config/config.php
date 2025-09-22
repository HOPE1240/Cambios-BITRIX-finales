<?php
// filepath: c:\xampp\htdocs\Bitrix-Iframe\config\config.php

// URL base para las peticiones a la API de Mobilia - PRODUCCIÓN
define('MOBILIA_BASE_URL', 'https://acrecer.mbp.com.co/acrecer-mobilia/ws/Extra');

// URL para autenticación JWT - PRODUCCIÓN
define('MOBILIA_AUTH_URL', 'https://acrecer.mbp.com.co/acrecer-mobilia/ws/Auth');

// Provider Key para autenticación JWT (subject) - PRODUCCIÓN
define('MOBILIA_PROVIDER_KEY', '8492C616295D3CABC67F');

// Archivo temporal para guardar el JWT
define('JWT_CACHE_FILE', __DIR__ . '/../api/jwt_token.txt');

// Parámetros permitidos para las consultas a la API
function mobilia_allowed_params() {
    return [
        'operation',
        'propertyTypeCode',
        'sectorCode',
        'branchCode',
        'fromRooms', 'toRooms',
        'fromArea', 'toArea',
        'fromPrice', 'toPrice',
        'forRent', 'onSale'
    ];
}