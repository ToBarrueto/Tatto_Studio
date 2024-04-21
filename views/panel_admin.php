<?php 
session_start();
  if ($_SESSION['tipo_usuario'] == 'admin')
    {



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
                    <a href="panel_admin.php">TattoStudioINK</a>
                </div>
            </div>
            <ul class="sidebar-nav">

                <li class="sidebar-item">
                    <a href="panel_admin.php" class="sidebar-link">
                        <i class="lni lni-world"></i>
                        <span>Resumen</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="panel_crearusuario.php" class="sidebar-link">
                        <i class="lni lni-circle-plus"></i>
                        <span>Crear usuario</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="panel_agregartrabajador.php" class="sidebar-link">
                        <i class="lni lni-users"></i>
                        <span>Registrar trabajador</span>
                    </a>
                </li>



                <li class="sidebar-item">
                    <a href="panel_trabajadores.php" class="sidebar-link">

                        <i class="lni lni-network"></i>
                        <span> Ver Trabajadores</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="panel_estadisticas.php" class="sidebar-link">
                        <i class="lni lni-bar-chart"></i>
                        <span>Estadisticas</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="panel_reportes.php" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>Reportes</span>
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
                        echo "<h3>Bienvenido $_SESSION[usuario] </h3>";
                        ?>

                        <?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Consulta para obtener la cantidad de clientes registrados
$sql_clientes = "SELECT COUNT(*) AS total_clientes FROM usuarios WHERE tipo_usuario = 'cliente'";
$resultado_clientes = $conexion->query($sql_clientes);
$total_clientes = $resultado_clientes->fetch_assoc()['total_clientes'];

// Consulta para obtener la cantidad de tatuadores registrados
$sql_tatuadores = "SELECT COUNT(*) AS total_tatuadores FROM usuarios WHERE tipo_usuario = 'tatuador'";
$resultado_tatuadores = $conexion->query($sql_tatuadores);
$total_tatuadores = $resultado_tatuadores->fetch_assoc()['total_tatuadores'];

// Consulta para obtener la cantidad de perforadores registrados
$sql_perforadores = "SELECT COUNT(*) AS total_perforadores FROM usuarios WHERE tipo_usuario = 'perforador'";
$resultado_perforadores = $conexion->query($sql_perforadores);
$total_perforadores = $resultado_perforadores->fetch_assoc()['total_perforadores'];

// Consulta para obtener la cantidad total de usuarios registrados
$sql_total_usuarios = "SELECT COUNT(*) AS total_usuarios FROM usuarios";
$resultado_total_usuarios = $conexion->query($sql_total_usuarios);
$total_usuarios = $resultado_total_usuarios->fetch_assoc()['total_usuarios'];

// Cerrar la conexión a la base de datos
$conexion->close();
?>

                        <!-- Mostrar las tarjetas con el resumen -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card-custom">
                                    <div class="card-body-custom">
                                        <h5 class="card-title-custom">Clientes Registrados</h5>
                                        <p class="card-text-custom"><?php echo $total_clientes; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-custom2">
                                    <div class="card-body-custom">
                                        <h5 class="card-title-custom2">Tatuadores Registrados</h5>
                                        <p class="card-text-custom"><?php echo $total_tatuadores; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-custom3">
                                    <div class="card-body-custom">
                                        <h5 class="card-title-custom3">Perforadores Registrados</h5>
                                        <p class="card-text-custom"><?php echo $total_perforadores; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-custom4">
                                    <div class="card-body-custom">
                                        <h5 class="card-title-custom4">Usuarios Registrados</h5>
                                        <p class="card-text-custom"><?php echo $total_usuarios; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>



                </div>
        </div>
    </div>
    </main>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="../assets/js/script.js"></script>
</body>

</html>

<?php }
  else{
    header("Location:../index.php");
  }?>