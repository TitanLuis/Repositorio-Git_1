<?php
// Agrega esto al inicio del index.php
session_start();

// Verificar si hay una sesión activa
if (isset($_SESSION['user_id'])) {
    // Redirigir al dashboard correspondiente
    header("Location: vistas/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Salud</title>
    <link rel="stylesheet" href="assets/css/styles_login.css">
    <!-- Para carga íconos en local -->
    <link href="assets/fontawesome-free-6.7.2-web/css/fontawesome.css" rel="stylesheet" />
    <link href="assets/fontawesome-free-6.7.2-web/css/brands.css" rel="stylesheet" />
    <link href="assets/fontawesome-free-6.7.2-web/css/solid.css" rel="stylesheet" />
    <!-- - -->
</head>
<body>    
    
    <main>
        <h1>Bienvenido a la plataforma de salud</h1>
        <p>Inicia sesión para continuar.</p>
        
        <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
            <div class="error-message" style="color: red; margin-bottom: 15px; text-align: center;">
                Usuario o contraseña incorrectos
            </div>
        <?php endif; ?>
        
        <form action="auth/login.php" method="POST">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" placeholder="Ingresa tu usuario" required>
            <div class="password-wrapper">
                <div class="password-container">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                    <span id="togglePassword" class="toggle-icon"><i class="fa-solid fa-eye-slash"></i></span>
                </div>
            </div>     
            <button type="submit">Iniciar sesión</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2025 Salud. Todos los derechos reservados.</p>
        <p>Powered by TitanLuis</p>
    </footer>

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="assets/js/script_login.js"></script>
</body>
</html>