<?php 
session_start();
  if ($_SESSION['tipo_usuario'] == 'tatuador')
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
            <nav class="navbar navbar-expand px-4 py-3">
                <form action="#" class="d-none d-sm-inline-block">

                </form>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="../assets/img/account.png" class="avatar img-fluid" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end rounded">

                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">

                        <?php 
                        echo "<h3>Bienvenido $_SESSION[usuario] </h3>";
                        ?>

                    </div>

                        <?php

                    if (isset($_SESSION['usuario_id'])) {

                        include '../conexion.php';

                        $usuario_id = $_SESSION['usuario_id'];

                        $consulta_tatuador = mysqli_query($conexion, "SELECT * FROM tatuadores WHERE usuario_id = '$usuario_id'");
                        $datos_tatuador = mysqli_fetch_array($consulta_tatuador);
                        
                        if ($datos_tatuador) {
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
    </main>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>

<?php }
  else{
    header("Location:../index.php");
  }?>