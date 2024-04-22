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
                        <h3 class="fw-bold fs-4 mb-3">Agenda</h3>
                    </div>
                </div>
            </main>

            <div class="container">
        <div class="row">
            <!-- Columna del formulario (1/3) -->
            <div class="col-md-4">
                <!-- Formulario para agregar un nuevo horario -->
                <div class="mt-3">
                    <h3>Agregar Hora</h3>
                    <form action="agregar_horario.php" method="POST">
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha:</label>
                            <input type="date" id="fecha" name="fecha" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="turno" class="form-label">Turno:</label>
                            <select id="turno" name="turno" class="form-select" required>
                                <option value="am">Mañana</option>
                                <option value="pm">Tarde</option>
                            </select>
                        </div>




                        <button type="submit" class="btn btn-primary">Agregar Horario</button>
                    </form>
                </div>
            </div>

            <!-- Columna de la tabla (2/3) -->
            <div class="col-md-8">
                <!-- Mostrar los horarios disponibles -->
                <div class="mt-3">
                    <h3>Agenda</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Turno</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí se mostrarán los horarios disponibles utilizando PHP -->
                            <?php
// Conexión a la base de datos
include '../conexion.php';

// Consulta SQL para obtener los horarios disponibles
$sql = "SELECT id, fecha, turno, estado FROM horarios_disponibles WHERE usuario_id = ?";
$stmt = mysqli_prepare($conexion, $sql);
$usuario_id = $_SESSION['usuario_id'];
mysqli_stmt_bind_param($stmt, "i", $usuario_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id, $fecha, $turno, $estado);

// Mostrar los resultados

    while (mysqli_stmt_fetch($stmt)) {
        echo "<tr>";
        echo "<td>$fecha</td>";
        echo "<td>$turno</td>";
        echo "<td>$estado</td>";
        echo "<td>";
        echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editarModal$id'>Editar</button> ";
        echo "<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#eliminarModal$id'>Eliminar</button>";
        echo "</td>";
        echo "</tr>";

        // Modal de edición para cada hora
        echo "<div class='modal fade' id='editarModal$id' tabindex='-1' aria-labelledby='editarModalLabel$id' aria-hidden='true'>";
        echo "<div class='modal-dialog'>";
        echo "<div class='modal-content'>";
        echo "<div class='modal-header'>";
        echo "<h5 class='modal-title' id='editarModalLabel$id'>Editar Hora</h5>";
        echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
        echo "</div>";
        echo "<div class='modal-body'>";
        echo "<form action='editar_horario.php' method='POST'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<div class='mb-3'>";
        echo "<label for='estado' class='form-label'>Estado:</label>";
        echo "<select id='estado' name='estado' class='form-select' required>";
        echo "<option value='Disponible' ".($estado == 'Disponible' ? 'selected' : '').">Disponible</option>";
        echo "<option value='Tomada' ".($estado == 'Tomada' ? 'selected' : '').">Tomada</option>";
        echo "<option value='Cerrada' ".($estado == 'Cerrada' ? 'selected' : '').">Cerrada</option>";
        echo "</select>";
        echo "</div>";
        echo "<button type='submit' class='btn btn-primary'>Guardar Cambios</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        // Modal de eliminación para cada hora
        echo "<div class='modal fade' id='eliminarModal$id' tabindex='-1' aria-labelledby='eliminarModalLabel$id' aria-hidden='true'>";
        echo "<div class='modal-dialog'>";
        echo "<div class='modal-content'>";
        echo "<div class='modal-header'>";
        echo "<h5 class='modal-title' id='eliminarModalLabel$id'>Confirmar Eliminación</h5>";
        echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
        echo "</div>";
        echo "<div class='modal-body'>";
        echo "¿Estás seguro de que quieres eliminar este horario?";
        echo "</div>";
        echo "<div class='modal-footer'>";
        echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>";
        echo "<a href='eliminar_horario.php?id=$id' class='btn btn-danger'>Eliminar</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
}

// Cerrar la consulta y la conexión a la base de datos
mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



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