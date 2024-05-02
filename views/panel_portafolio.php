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
                    <a href="panel_tatuador.php">StudioINK</a>
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
                        <h3 class="fw-bold fs-4 mb-3">Portafolio</h3>

                        

                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <?php
                            // Incluir archivo de conexión a la base de datos
                            include '../conexion.php';

                            // Obtener el ID del tatuador de la sesión
                            $usuario_id = $_SESSION['usuario_id'];

                            // Consulta para obtener todas las imágenes del tatuador
                            $consulta = "SELECT id, ruta_imagen, descripcion FROM portafolio WHERE usuario_id = ?";
                            $stmt = mysqli_prepare($conexion, $consulta);
                            mysqli_stmt_bind_param($stmt, "i", $usuario_id);
                            mysqli_stmt_execute($stmt);
                            $resultado = mysqli_stmt_get_result($stmt);

                            // Verificar si se encontraron imágenes
                            if ($resultado && mysqli_num_rows($resultado) > 0) {
                                // Mostrar cada imagen
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    $id_imagen = $fila['id'];
                                    $ruta_imagen = $fila['ruta_imagen'];
                                    $descripcion = $fila['descripcion'];

                                    // Mostrar la imagen y la descripción
                                    echo '<div class="col">';
                                    echo '<div class="card h-100">';
                                    echo '<img src="' . $ruta_imagen . '" class="card-img-top img-thumbnail" alt="Imagen">';
                                    echo '<div class="card-body">';
                                    echo '<p class="card-text">' . $descripcion . '</p>';
                                    echo '<form action="eliminar_imagen.php" method="POST">';
                                    echo '<input type="hidden" name="id_imagen" value="' . $id_imagen . '">';
                                    echo '<button type="submit" class="btn btn-danger">Eliminar</button>';
                                    echo '</form>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<p >Tu portafolio no tiene imagenes</p>';
                            }

                            // Cerrar la conexión a la base de datos
                            mysqli_close($conexion);
                            ?>
                        </div>

                        <form action="subir_imagen.php" method="POST" enctype="multipart/form-data">
                            <div class="mt-3">
                                <label for="imagen">Agregar imagen al portafolio:</label>

                                <div class="mt-3">
                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*"
                                    required>
                                </div>

                            </div>
                            <div class="mt-3">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                            </div>
                            <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Subir imagen</button>
                                </div>
                        </form>

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