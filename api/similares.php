<?php
// filepath: c:\xampp\htdocs\Bitix-Iframe\api\similares.php

/**
 * Endpoint para consultar inmuebles similares usando JWT Mobilia.
 * - Obtiene el JWT automáticamente y lo renueva si está vencido.
 * - Usa el JWT en el header Authorization para la consulta.
 * - Parámetros obligatorios: propertyTypeCode, sectorCode, forRent, onSale, branchCode.
 * - Parámetros opcionales: fromRooms, toRooms, fromArea, toArea, fromPrice, toPrice.
 */

// Configura la respuesta como JSON
header('Content-Type: application/json; charset=utf-8');

// Configuración Mobilia
define('MOBILIA_AUTH_URL', 'http://54.145.54.14:8080/mobilia-test/ws/Auth');
define('MOBILIA_BASE_URL', 'http://54.145.54.14:8080/mobilia-test/ws/Extra');
define('MOBILIA_PROVIDER_KEY', '8492C616295D3CABC67FDF19DF547'); 
define('JWT_CACHE_FILE', __DIR__ . '/jwt_token.txt');

/**
 * Obtiene el JWT y lo renueva si está vencido.
 * El JWT dura 3 horas según la documentación.
 */
function getJwtToken() {
    // Si existe el archivo y no está vencido, úsalo
    if (file_exists(JWT_CACHE_FILE)) {
        $data = json_decode(file_get_contents(JWT_CACHE_FILE), true);
        if ($data && isset($data['token'], $data['exp']) && $data['exp'] > time()) {
            return $data['token'];
        }
    }
    // Solicita nuevo JWT
    $url = MOBILIA_AUTH_URL . '?operation=getAccessJWToken&subject=' . MOBILIA_PROVIDER_KEY;
    $resp = file_get_contents($url);
    $json = json_decode($resp, true);
    if (!$json || empty($json['JWT'])) {
        http_response_code(401);
        echo json_encode(['error'=>'No se pudo obtener el JWT', 'response'=>$resp]);
        exit;
    }
    // El JWT dura 3 horas
    $exp = time() + (3 * 3600);
    file_put_contents(JWT_CACHE_FILE, json_encode(['token'=>$json['JWT'], 'exp'=>$exp]));
    return $json['JWT'];
}

/**
 * Construye los parámetros para la consulta a Mobilia.
 * Valida obligatorios y agrega opcionales si existen.
 */
function buildParams($input) {
    $params = [
        'operation' => 'getMatchingProperties',
        'propertyTypeCode' => $input['propertyTypeCode'] ?? '',
        'sectorCode' => $input['sectorCode'] ?? '',
        'forRent' => $input['forRent'] ?? 'T',
        'onSale' => $input['onSale'] ?? 'F',
        'branchCode' => $input['branchCode'] ?? 'OCCIDENTE'
    ];
    // Opcionales
    foreach (['fromRooms','toRooms','fromArea','toArea','fromPrice','toPrice'] as $key) {
        if (!empty($input[$key])) $params[$key] = $input[$key];
    }
    // Validación
    if ($params['propertyTypeCode'] === '' || $params['sectorCode'] === '') {
        http_response_code(400);
        echo json_encode(['error'=>'Faltan parámetros obligatorios: propertyTypeCode y/o sectorCode']);
        exit;
    }
    return $params;
}

/**
 * Realiza la consulta a la API Mobilia usando JWT en el header.
 */
function callMobiliaApi($params, $jwt) {
    $url = MOBILIA_BASE_URL . '?' . http_build_query($params);
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_HTTPHEADER => ["Authorization: Bearer $jwt"],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 25,
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    return [$response, $httpCode, $error, $url];
}

// --- BLOQUE PRINCIPAL ---
$input = json_decode(file_get_contents('php://input'), true) ?: [];

$params = buildParams($input); // Construye parámetros
$jwt = getJwtToken();          // Obtiene JWT válido
list($out, $http, $err, $url) = callMobiliaApi($params, $jwt); // Llama a Mobilia

// Manejo de errores y respuesta
if ($err || $http >= 400) {
    http_response_code($http ?: 502);
    echo json_encode([
        'error'  => 'Error consultando servicio',
        'detail' => $err,
        'http'   => $http,
        'url'    => $url
    ]);
    exit;
}

http_response_code($http ?: 200);
echo $out ?: json_encode(['error'=>'Sin respuesta del servicio']);