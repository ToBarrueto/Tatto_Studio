<?php 
session_start();
if ($_SESSION['tipo_usuario'] == 'tatuador') {
    include '../conexion.php';

    // Obtener el ID de usuario del tatuador
    $usuario_id = $_SESSION['usuario_id'];

    // Consulta para obtener las estadísticas de horas
    $sql_horas = "SELECT 
                    COUNT(*) AS total_horas,
                    SUM(CASE WHEN estado = 'Disponible' THEN 1 ELSE 0 END) AS horas_disponibles,
                    SUM(CASE WHEN estado = 'Tomada' THEN 1 ELSE 0 END) AS horas_tomadas,
                    SUM(CASE WHEN estado = 'Cerrada' THEN 1 ELSE 0 END) AS horas_cerradas
                  FROM horarios_disponibles 
                  WHERE usuario_id = $usuario_id";

    $resultado_horas = $conexion->query($sql_horas);
    $datos_horas = $resultado_horas->fetch_assoc();

    // Mostrar el panel del tatuador
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel tatuador</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/stylepanel.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="panel_tatuador.php">TattoStudioINK</a>
                </div>
            </div>
            <ul class="sidebar-nav">

                <li class="sidebar-item">
                    <a href="panel_tatuador.php" class="sidebar-link">
                        <i class="lni lni-world"></i>
                        <span>Resumen</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="panel_agenda.php" class="sidebar-link">
                        <i class="lni lni-calendar"></i>
                        <span>Agenda</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="panel_perfil.php" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Mi perfil</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="panel_portafolio.php" class="sidebar-link">
                        <i class="lni lni-briefcase"></i>
                        <span>Portafolio</span>
                    </a>
                </li>

            </ul>
            <div class="sidebar-footer">
                <a href="../index.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Cerrar Sesion</span>
                </a>
            </div>
        </aside>


        <div class="main">
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <?php 
                        echo "<h3 class='mt-3'>Bienvenido $_SESSION[usuario] </h3>";
                        ?>

                        <div class="row mt-5 mb-5">
                            <!-- Tarjeta para la cantidad total de horas -->
                            <div class="col-md-3">
                                <div class="card-custom">
                                    <div class="card-body-custom">
                                        <h5 class="card-title-custom">Cantidad Total de Horas</h5>
                                        <p class="card-text-custom"><?php echo $datos_horas['total_horas']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <!-- Tarjeta para horas disponibles -->
                            <div class="col-md-3">
                                <div class="card-custom2">
                                    <div class="card-body-custom">
                                        <h5 class="card-title-custom2">Horas Disponibles</h5>
                                        <p class="card-text-custom"><?php echo $datos_horas['horas_disponibles']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <!-- Tarjeta para horas tomadas -->
                            <div class="col-md-3">
                                <div class="card-custom3">
                                    <div class="card-body-custom">
                                        <h5 class="card-title-custom3">Horas Tomadas</h5>
                                        <p class="card-text-custom"><?php echo $datos_horas['horas_tomadas']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <!-- Tarjeta para horas cerradas -->
                            <div class="col-md-3">
                                <div class="card-custom4">
                                    <div class="card-body-custom">
                                        <h5 class="card-title-custom4">Horas Cerradas</h5>
                                        <p class="card-text-custom"><?php echo $datos_horas['horas_cerradas']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php

                    if (isset($_SESSION['usuario_id'])) {

                        include '../conexion.php';

                        $usuario_id = $_SESSION['usuario_id'];

                        $consulta_tatuador = mysqli_query($conexion, "SELECT * FROM tatuadores WHERE usuario_id = '$usuario_id'");
                        $datos_tatuador = mysqli_fetch_array($consulta_tatuador);
                        
                        if ($datos_tatuador) {
                            echo "<h3 class='mt-3 mb-3'>Tus datos</h3>";
                            echo "<p>Nombre: " . $datos_tatuador['nombre'] . "</p>";
                            echo "<p>Descripción: " . $datos_tatuador['descripcion'] . "</p>";
                            echo "<p>Estilos: " . $datos_tatuador['estilos'] . "</p>";
                        } else {
                            echo "<p>No se encontraron datos del tatuador.</p>";
                        }
                    } else {
                        echo "<p>No se ha iniciado sesión.</p>";
                    }
                    ?>
                    </div>
                </div>
             </div>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>


<?php 
    // Cerrar conexión a la base de datos
    $conexion->close();
} else {
    header("Location:../index.php");
}
?>