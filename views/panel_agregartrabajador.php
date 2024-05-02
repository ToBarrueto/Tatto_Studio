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

        <main class="main">

        <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">




           
                <div class="container">
                    <div class="row gx-5">
                    <div class="col-6 col-md-4 card-2 ml-4">
                    <h3 class="mt-2" >Registrar Trabajadores</h3>
                        <form action="agregar_trabajador.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-2 mt-4">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label for="descripcion" class="form-label">Descripción:</label>
                                <textarea id="descripcion" name="descripcion" rows="4" class="form-control"
                                    required></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="estilos" class="form-label">Estilos:</label>
                                <input type="text" id="estilos" name="estilos" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label for="imagen_perfil" class="form-label">Imagen de Perfil:</label>
                                <input type="file" id="imagen_perfil" name="imagen_perfil" class="form-control" required
                                    accept="image/*">
                            </div>
                            <div class="mb-2">
                                <label for="usuario_id" class="form-label">ID del Trabajador:</label>
                                <input type="number" id="usuario_id" name="usuario_id" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label for="tipo_usuario" class="form-label">Tipo de Usuario:</label>
                                <select id="tipo_usuario" name="tipo_usuario" class="form-control" required>
                                    <option value="tatuador">Tatuador</option>
                                    <option value="perforador">Perforador</option>
                                </select>
                            </div>
                            <div class="text-center mb-3">
                            <button type="submit" class="btn btn-primary mt-2">Agregar Usuario</button>
                            </div>
                        </form>
                        </div>
                        
                        <div class=" col-md-8 text-center">

                                <h3 class="mb-5">Trabajadores del estudio</h3>

                                <?php
                                    // Incluir el archivo de conexión a la base de datos
                                    include '../conexion.php';

                                    // Realizar la consulta para obtener todos los tatuadores
                                    $sql = "SELECT * FROM tatuadores";
                                    $resultado = $conexion->query($sql);

                                    // Verificar si hay resultados
                                    if ($resultado->num_rows > 0) {
                                        // Mostrar una tabla HTML con la información de cada tatuador
                                        echo "<h5>Tatuadores</h5>";
                                        echo "<div class='table-responsive'>";
                                        echo "<table class='table table-striped table-bordered'>";
                                        echo "<thead>";
                                        echo "<tr>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Descripción</th>";
                                        echo "<th>Estilos</th>";
                                        echo "<th>Acciones</th>"; // Columna para acciones
                                        echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        while ($row = $resultado->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['nombre'] . "</td>";
                                            echo "<td>" . $row['descripcion'] . "</td>";
                                            echo "<td>" . $row['estilos'] . "</td>";
                                            echo "<td>"; // Inicio de la celda de acciones
                                            echo "<form action='eliminar_trabajador.php' method='POST'>";
                                            echo "<input type='hidden' name='id_usuario' value='" . $row['usuario_id'] . "'>";
                                            echo "<button type='submit' class='btn btn-danger' onclick='return confirm(\"¿Estás seguro de que quieres eliminar a este usuario?\")'><i class='lni lni-trash-can'></i></button>";
                                            echo "</form>";
                                            echo "</td>"; // Fin de la celda de acciones
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";
                                        echo "</table>";
                                        echo "</div>";
                                    } else {
                                        echo "<p class='text-muted'>No se encontraron tatuadores.</p>";
                                    }

                                    // Cerrar la conexión a la base de datos
                                    $conexion->close();
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

<?php }
  else{
    header("Location:../index.php");
  }?>