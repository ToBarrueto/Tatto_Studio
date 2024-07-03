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

                        <h3> Crear usuarios</h3>

                        <?php
                            // Incluir el archivo de conexión a la base de datos
                            include '../conexion.php';

                            // Obtener todos los usuarios registrados
                            $sql_usuarios = "SELECT * FROM usuarios";
                            $resultado_usuarios = $conexion->query($sql_usuarios);
                            ?>


                        <div class="container mt-5">
                            <div class="row g-5 ">
                                <div class="card-2 col-6 col-md-4">
                                    <div>
                                        <h5 class="mt-3 mb-3">Agregar Nuevo Usuario</h5>
                                        <form action="crear_usuario.php" method="POST">
                                            <div class="form-group mt-3 mb-3">
                                                <label for="username">Nombre de usuario:</label>
                                                <input type="text" name="username" id="username" class="form-control"
                                                    required>

                                            </div>
                                            <div class="form-group mt-3 mb-3">
                                                <label for="password">Contraseña:</label>
                                                <input type="password" name="password" id="password"
                                                    class="form-control" required>
                                            </div>
                                            <div class="form-group mt-3 mb-3">
                                                <label for="tipo_usuario">Tipo de usuario:</label>
                                                <select name="tipo_usuario" id="tipo_usuario" class="form-control"
                                                    required>
                                                    <option value="cliente">Cliente</option>
                                                    <option value="tatuador">Tatuador</option>
                                                    <option value="admin">Administrador</option>
                                                </select>
                                            </div>
                                           <div class="text-center mb-3">
                                            <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                                        </div>
                                        </form>

                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-8">
                                    <div>
                                        <h5 class="mt-3 mb-3">Usuarios Registrados</h5>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre de usuario</th>
                                                    <th>Tipo de usuario</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            if ($resultado_usuarios->num_rows > 0) {
                                                while ($fila = $resultado_usuarios->fetch_assoc()) {
                                                    // Verificar si el tipo de usuario es "tatuador" o "admin"
                                                    if ($fila['tipo_usuario'] === 'tatuador' || $fila['tipo_usuario'] === 'admin') {
                                                        echo "<tr>";
                                                        echo "<td>" . $fila['id'] . "</td>";
                                                        echo "<td>" . $fila['username'] . "</td>";
                                                        echo "<td>" . $fila['tipo_usuario'] . "</td>";
                                                        echo "</tr>";
                                                    }
                                                }
                                            } else {
                                                echo "<tr><td colspan='3'>No se encontraron usuarios.</td></tr>";
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
</body>

</html>

<?php
// Cerrar la conexión a la base de datos
$conexion->close();
?>


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