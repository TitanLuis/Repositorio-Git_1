<?php
session_start();

// Verificar si hay una sesión activa
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Verificar que el usuario tenga permisos para editar otros usuarios
// if ($_SESSION['user_type'] > 2 || ($_SESSION['user_type'] == 2 && $usuario['tipo_us'] == 1)) {
//     $_SESSION['error'] = "No tienes permisos para editar este usuario";
//     header("Location: ../index.php");
//     exit();
// }

// Obtener información del usuario para mostrar en el dashboard
$user_type = $_SESSION['user_type'];
$full_name = $_SESSION['full_name'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Salud Renal</title>
    <link rel="stylesheet" href="../assets/css/styles_dashboard.css">
    <!-- Font Awesome -->
    <link href="../assets/fontawesome-free-6.7.2-web/css/fontawesome.css" rel="stylesheet" />
    <link href="../assets/fontawesome-free-6.7.2-web/css/brands.css" rel="stylesheet" />
    <link href="../assets/fontawesome-free-6.7.2-web/css/solid.css" rel="stylesheet" />
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <div class="container">
        <?php include '../includes/sidebar.php'; ?>
        
        <main class="main-content">
            <!-- <h1>Bienvenido, <?php echo htmlspecialchars($full_name); ?></h1> -->
            <div class="dashboard-section">
                
                <h2>Acciones Rápidas</h2>
                <div class="quick-actions">
                    <?php if ($_SESSION['user_type'] <= 2): ?>
                    <a href="../usuarios/index.php" class="quick-action">
                        <i class="fas fa-users-cog"></i>
                        <span>Gestionar Personal</span>
                    </a>
                    <?php endif; ?>
                    <a href="../pacientes/crear.php" class="quick-action">
                        <i class="fas fa-user-plus"></i>
                        <span>Nuevo Paciente</span>
                    </a>
                    <a href="../atenciones.php" class="quick-action">
                        <i class="fas fa-procedures"></i>
                        <span>Registrar Atención</span>
                    </a>
                </div>
            </div>
            <div class="dashboard-cards">
                <!-- Estadísticas rápidas -->
                <div class="card">
                    <div class="card-icon" style="background-color: #4e73df;">
                        <i class="fas fa-user-injured"></i>
                    </div>
                    <div class="card-info">
                        <h3>Pacientes Activos</h3>
                        <p>120</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-icon" style="background-color: #1cc88a;">
                        <i class="fas fa-procedures"></i>
                    </div>
                    <div class="card-info">
                        <h3>Atenciones Hoy</h3>
                        <p>24</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-icon" style="background-color: #f6c23e;">
                        <i class="fas fa-flask"></i>
                    </div>
                    <div class="card-info">
                        <h3>Exámenes Pendientes</h3>
                        <p>15</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-icon" style="background-color: #e74a3b;">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="card-info">
                        <h3>Citas Mañana</h3>
                        <p>18</p>
                    </div>
                </div>
            </div>
            
            <!-- Sección de gráficos o información adicional -->
            <div class="dashboard-section">
                <h2>Actividad Reciente</h2>
                <div class="recent-activity">
                    <p>Aquí iría un listado de las últimas atenciones o actividades registradas...</p>
                </div>
            </div>
        </main>
    </div>
    
    <script src="assets/js/script_dashboard.js"></script>
</body>
</html>