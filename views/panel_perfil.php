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
                    <a href="#" class="sidebar-link">
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
            <div class="row">
                <!-- Columna para mostrar los datos del tatuador -->
                <div class="col-md-6">
                    <div class="mb-3 mt-3">
                        <h3 class="fw-bold fs-4 mb-3">Datos del Tatuador</h3>
                        <table class="table">
                            <tbody>
                                <?php
                                // Verificar si la sesión está iniciada y obtener el ID del usuario
                                if (isset($_SESSION['usuario_id'])) {
                                    // Incluir el archivo de conexión a la base de datos
                                    include '../conexion.php';

                                    // Obtener el ID del usuario de la sesión
                                    $usuario_id = $_SESSION['usuario_id'];

                                    // Consultar la tabla "tatuadores" para obtener los datos del tatuador
                                    $consulta_tatuador = mysqli_query($conexion, "SELECT * FROM tatuadores WHERE usuario_id = '$usuario_id'");
                                    $datos_tatuador = mysqli_fetch_array($consulta_tatuador);

                                    // Verificar si se encontraron datos del tatuador
                                    if ($datos_tatuador) {
                                        // Mostrar los datos del tatuador en una tabla
                                        echo '<tr><th>Foto de perfil:</th><td><img src="' . $datos_tatuador['imagen_perfil'] . '" alt="Imagen del Tatuador" class="img-fluid"></td></tr>';
                                        echo '<tr><th>Nombre:</th><td>' . $datos_tatuador['nombre'] . '</td></tr>';
                                        echo '<tr><th>Descripción:</th><td>' . $datos_tatuador['descripcion'] . '</td></tr>';
                                        echo '<tr><th>Estilos:</th><td>' . $datos_tatuador['estilos'] . '</td></tr>';
                                        echo '<tr><th>Tarifa por cm2:</th><td>' . $datos_tatuador['precioBase'] . '</td></tr>';
                                    } else {
                                        echo "<tr><td colspan='2'>No se encontraron datos del tatuador.</td></tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='2'>No se ha iniciado sesión.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Columna para el formulario de edición -->
                <div class="col-md-6">
                    <div class="mb-3 mt-3">
                        <h3 class="fw-bold fs-4 mb-3">Editar Perfil</h3>
                        <!-- Formulario para editar los datos del tatuador -->
                        <form action="actualizar_perfil.php" method="POST" enctype="multipart/form-data" >
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    value="<?php echo $datos_tatuador['nombre']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción:</label>
                                <textarea class="form-control" id="descripcion"
                                    name="descripcion"><?php echo $datos_tatuador['descripcion']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="estilos" class="form-label">Estilos:</label>
                                <input type="text" class="form-control" id="estilos" name="estilos"
                                    value="<?php echo $datos_tatuador['estilos']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="precioBase" class="form-label">Tarifa por cm2:</label>
                                <input type="text" class="form-control" id="precioBase" name="precioBase"
                                    value="<?php echo $datos_tatuador['precioBase']; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="imagen_perfil" class="form-label">Imagen de perfil:</label>
                                <input type="file" class="form-control" id="imagen_perfil" name="imagen_perfil">
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </form>
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