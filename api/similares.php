<?php
// filepath: c:\xampp\htdocs\Bitrix-Iframe\api\similares.php

/**
 * Endpoint para consultar inmuebles similares usando JWT Mobilia.
 * - Obtiene el JWT automáticamente y lo renueva si está vencido.
 * - Usa el JWT en el header Authorization para la consulta.
 * - Parámetros obligatorios: propertyTypeCode, sectorCode, forRent, onSale, branchCode.
 * - Parámetros opcionales: fromRooms, toRooms, fromArea, toArea, fromPrice, toPrice.
 */

// Configura la respuesta como JSON y permite CORS
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Manejar preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Incluir configuración centralizada
require_once __DIR__ . '/../config/config.php';

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
    // Mapear campos con nombres alternativos
    $propertyTypeCode = $input['propertyTypeCode'] ?? $input['type'] ?? '';
    $sectorCode = $input['sectorCode'] ?? $input['sector'] ?? '';
    
    $params = [
        'operation' => 'getMatchingProperties',
        'propertyTypeCode' => $propertyTypeCode,
        'forRent' => $input['forRent'] ?? 'T',
        'onSale' => $input['onSale'] ?? 'F'
    ];
    
    // Solo agregar sectorCode si no está vacío
    if (!empty($sectorCode)) {
        $params['sectorCode'] = $sectorCode;
    }
    
    // Solo agregar branchCode si está especificado y no es "Todos"
    if (!empty($input['branchCode']) && $input['branchCode'] !== 'Todos') {
        $params['branchCode'] = $input['branchCode'];
    } else if (!empty($input['branch']) && $input['branch'] !== 'Todos') {
        $params['branchCode'] = $input['branch'];
    }
    
    // Opcionales con mapeo alternativo
    $optionalFields = [
        'fromRooms' => ['fromRooms', 'rmin'],
        'toRooms' => ['toRooms', 'rmax'],
        'fromArea' => ['fromArea', 'amin'],
        'toArea' => ['toArea', 'amax'],
        'fromPrice' => ['fromPrice', 'pmin'],
        'toPrice' => ['toPrice', 'pmax']
    ];
    
    foreach ($optionalFields as $targetField => $sourceFields) {
        foreach ($sourceFields as $sourceField) {
            if (!empty($input[$sourceField])) {
                $params[$targetField] = $input[$sourceField];
                break; // Usar el primer campo encontrado
            }
        }
    }
    
    // Validación mejorada
    if (empty($propertyTypeCode)) {
        http_response_code(400);
        echo json_encode([
            'error' => 'Parámetro obligatorio faltante: propertyTypeCode/type',
            'received' => array_keys($input),
            'status' => false
        ]);
        exit;
    }
    
    // sectorCode es obligatorio solo si no hay branchCode específico
    $hasBranchCode = !empty($params['branchCode']);
    if (empty($sectorCode) && !$hasBranchCode) {
        http_response_code(400);
        echo json_encode([
            'error' => 'Debe especificar sectorCode o branchCode',
            'detail' => 'sectorCode es obligatorio cuando no se especifica una sucursal específica',
            'received' => array_keys($input),
            'status' => false
        ]);
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
// Combinar parámetros GET y POST/JSON
$rawInput = file_get_contents('php://input');
$jsonInput = json_decode($rawInput, true) ?: [];
$input = array_merge($_GET, $jsonInput);

// Log para debugging (solo en desarrollo)
error_log("API Input: " . json_encode($input));

// Validar que se recibieron datos
if (empty($input) || (empty($_GET) && empty($jsonInput))) {
    http_response_code(400);
    echo json_encode([
        'error' => 'No se recibieron datos',
        'method' => $_SERVER['REQUEST_METHOD'],
        'content_type' => $_SERVER['CONTENT_TYPE'] ?? 'not set',
        'raw_input_length' => strlen($rawInput),
        'status' => false
    ]);
    exit;
}

try {
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
            'url'    => $url,
            'params' => $params,
            'status' => false
        ]);
        exit;
    }

    // Intentar parsear la respuesta
    $responseData = json_decode($out, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        // Si no es JSON válido, devolver la respuesta tal como está
        http_response_code($http ?: 200);
        echo $out ?: json_encode(['error'=>'Sin respuesta del servicio']);
    } else {
        // Es JSON válido, agregar información de estado
        $responseData['status'] = true;
        $responseData['statusCode'] = $http;
        http_response_code($http ?: 200);
        echo json_encode($responseData);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Error interno del servidor',
        'message' => $e->getMessage(),
        'status' => false
    ]);
}