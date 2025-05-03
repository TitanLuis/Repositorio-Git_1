<?php
require_once '../config/conexion.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizar($_POST['username']);
    $password = sanitizar($_POST['password']);

    // Consulta para verificar el usuario
    // $sql = "SELECT u.*, tu.tipo_us as tipo_usuario_nombre 
    //         FROM usuarios u
    //         JOIN tipousuario tu ON u.tipo_us = tu.id_tipo_us
    //         WHERE u.n_doc_us = ?";

    $sql = "SELECT u.*, tu.tipo_us as tipo_usuario_nombre, c.cargo as cargo_nombre
            FROM usuarios u
            JOIN tipousuario tu ON u.tipo_us = tu.id_tipo_us
            JOIN cargousuario c ON u.cargo = c.id_cargo
            WHERE u.n_doc_us = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            // Establecer variables de sesión
            $_SESSION['user_id'] = $user['id_usuario'];
            $_SESSION['username'] = $user['n_doc_us'];
            $_SESSION['user_type'] = $user['tipo_us'];
            $_SESSION['user_type_name'] = $user['tipo_usuario_nombre'];
            $_SESSION['full_name'] = $user['nombres'] . ' ' . $user['ap_paterno'] . ' ' . $user['ap_materno'];
            $_SESSION['cargo'] = $user['cargo'];
            $_SESSION['cargo_nombre'] = $user['cargo_nombre']; // Necesitas JOIN en la consulta SQL
            
            // Redireccionar según el tipo de usuario
            header("Location: ../vistas/dashboard.php");
            exit();
        } else {
            // Contraseña incorrecta
            header("Location: ../index.php?error=1");
            exit();
        }
    } else {
        // Usuario no encontrado
        header("Location: ../index.php?error=1");
        exit();
    }
} else {
    // Método no permitido
    header("Location: ../index.php");
    exit();
}
?>