<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'dbtest1');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

function sanitizar($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}


/**
 * Registra una acción en el sistema de logs
 * 
 * @param mysqli $conn Conexión a la base de datos
 * @param int $id_usuario ID del usuario que realiza la acción
 * @param string $accion Tipo de acción (ej: 'CREACION_PACIENTE')
 * @param string $tabla Tabla afectada
 * @param int $id_registro ID del registro afectado
 * @param mixed $valores_antes Valor anterior (opcional)
 * @param mixed $valores_despues Valor nuevo (opcional)
 * @return bool True si se registró correctamente
 */
 function registrarLog($conn, $usuario_id, $accion, $tabla_afectada = null, $registro_id = null, $valores_antes = null, $valores_despues = null) {

//  function registrarLog($conn, $id_usuario, $accion, $tabla, $id_registro, $valor_anterior = null, $valor_nuevo = null) {

    // Serializar valores si son arrays u objetos
    if (is_array($valores_antes) || is_object($valores_antes)) {
        $valores_antes = json_encode($valores_antes);
    }
    
    if (is_array($valores_despues) || is_object($valores_despues)) {
        $valores_despues = json_encode($valores_despues);
    }
    
    $stmt = $conn->prepare("INSERT INTO logs (
        usuario_id, accion, tabla_afectada, registro_id, valores_antes, valores_despues, fecha_registro, ip_origen
        -- id_usuario, accion, tabla, id_registro, valor_anterior, valor_nuevo, fecha_registro, ip
    ) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)");
    
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    $stmt->bind_param(
        "ississs", 
        $usuario_id, $accion, $tabla_afectada, $registro_id, $valores_antes, $valores_despues, $ip
    );
    
    return $stmt->execute();
}


// function registrarLog($conn, $usuario_id, $accion, $tabla_afectada = null, $registro_id = null, $valores_antes = null, $valores_despues = null) {
//     $ip = $_SERVER['REMOTE_ADDR'];
//     $stmt = $conn->prepare("INSERT INTO logs (usuario_id, accion, tabla_afectada, registro_id, valores_antes, valores_despues, ip_origen) 
//                           VALUES (?, ?, ?, ?, ?, ?, ?)");
//     $stmt->bind_param("ississs", $usuario_id, $accion, $tabla_afectada, $registro_id, $valores_antes, $valores_despues, $ip);
//     $stmt->execute();
// }