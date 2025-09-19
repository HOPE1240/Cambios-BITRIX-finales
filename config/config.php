<?php
// filepath: c:\xampp\htdocs\Bitix-Iframe\config\config.php

// URL base para las peticiones a la API de Mobilia
define('MOBILIA_BASE_URL', 'http://54.145.54.14:8080/mobilia-test/ws/Extra');

// URL para autenticación JWT
define('MOBILIA_AUTH_URL', 'http://54.145.54.14:8080/mobilia-test/ws/Auth');

// Provider Key para autenticación JWT (subject)
define('MOBILIA_PROVIDER_KEY', '8492C616295D3CABC67FDF19DF547');

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