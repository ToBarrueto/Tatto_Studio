<?php
session_start();
if ($_SESSION['tipo_usuario'] == 'tatuador') {
    include '../conexion.php';
    $usuario_id = $_SESSION['usuario_id'];
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
                      
                    <div class="col-md-6">
                        <!-- Mostrar las citas reservadas -->
                        <div class="mt-3">
                            <h3>Citas Confirmadas</h3> 
                            <?php
                            // Determinar el número de página actual
                            $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

                            // Calcular el offset para la consulta SQL
                            $offset = ($pagina_actual - 1) * 5; // 5 elementos por página

                            // Consulta SQL para obtener las citas del tatuador con paginación
                            $sql_citas = "SELECT c.nombre_cliente, c.telefono, c.correo, hd.estado, hd.fecha, c.cotizacion
                            FROM citas c 
                            INNER JOIN horarios_disponibles hd ON c.hora_disponible_id = hd.id
                            WHERE c.usuario_id = ? AND hd.estado = 'Confirmada'
                            LIMIT 5 OFFSET ?";
                            $stmt_citas = mysqli_prepare($conexion, $sql_citas);
                            mysqli_stmt_bind_param($stmt_citas, "ii", $usuario_id, $offset);
                            mysqli_stmt_execute($stmt_citas);
                            $result_citas = mysqli_stmt_get_result($stmt_citas);

                            if (mysqli_num_rows($result_citas) > 0) {
                                echo "<table class='table'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Nombre Cliente</th>";
                                echo "<th>Teléfono</th>";
                                echo "<th>Fecha</th>";
                                echo "<th>Ganancia</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while ($row_cita = mysqli_fetch_assoc($result_citas)) {
                                    // Formatear la fecha
                                    $fecha_formateada = date("d/m/Y", strtotime($row_cita['fecha']));

                                    // Mostrar los detalles de la cita
                                    echo "<tr>";
                                    echo "<td>" . $row_cita['nombre_cliente'] . "</td>";
                                    echo "<td>" . $row_cita['telefono'] . "</td>"; 
                                    echo "<td>" . $fecha_formateada . "</td>"; // Fecha formateada
                                    echo "<td>$ " . $row_cita['cotizacion'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";

                                // Calcular el número total de páginas
                                $sql_count = "SELECT COUNT(*) as total FROM citas c 
                                            INNER JOIN horarios_disponibles hd ON c.hora_disponible_id = hd.id
                                            WHERE c.usuario_id = ? AND hd.estado = 'Tomada'";
                                $stmt_count = mysqli_prepare($conexion, $sql_count);
                                mysqli_stmt_bind_param($stmt_count, "i", $usuario_id);
                                mysqli_stmt_execute($stmt_count);
                                $result_count = mysqli_stmt_get_result($stmt_count);
                                $row_count = mysqli_fetch_assoc($result_count);
                                $total_citas = $row_count['total'];
                                $total_paginas = ceil($total_citas / 5); // 5 elementos por página

                                // Mostrar enlaces de paginación
                                echo "<div class='row'>";
                                echo "<div class='col'>";
                                echo "<nav aria-label='Page navigation'>";
                                echo "<ul class='pagination justify-content-center'>";
                                if ($pagina_actual != 1) {
                                    echo "<li class='page-item'><a class='page-link' href='panel_agenda.php?pagina=1'>Primera</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='panel_agenda.php?pagina=" . ($pagina_actual - 1) . "'>&laquo;</a></li>";
                                }
                                for ($i = 1; $i <= $total_paginas; $i++) {
                                    echo "<li class='page-item " . ($pagina_actual == $i ? 'active' : '') . "'><a class='page-link' href='panel_agenda.php?pagina=" . $i . "'>$i</a></li>";
                                }
                                if ($pagina_actual != $total_paginas) {
                                    echo "<li class='page-item'><a class='page-link' href='panel_agenda.php?pagina=" . ($pagina_actual + 1) . "'>&raquo;</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='panel_agenda.php?pagina=" . $total_paginas . "'>Última</a></li>";
                                }
                                echo "</ul>";
                                echo "</nav>";
                                echo "</div>";
                                echo "</div>";
                            } else {
                                echo "<p>No hay citas reservadas en este momento.</p>";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Mostrar las citas reservadas -->
                        <div class="mt-3">
                            <h3>Citas Reservadas</h3> 
                            <?php
                            // Determinar el número de página actual
                            $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

                            // Calcular el offset para la consulta SQL
                            $offset = ($pagina_actual - 1) * 5; // 5 elementos por página

                            // Consulta SQL para obtener las citas del tatuador con paginación
                            $sql_citas = "SELECT c.nombre_cliente, c.telefono, c.correo, hd.estado, hd.fecha, c.cotizacion
                            FROM citas c 
                            INNER JOIN horarios_disponibles hd ON c.hora_disponible_id = hd.id
                            WHERE c.usuario_id = ? AND hd.estado = 'Tomada'
                            LIMIT 5 OFFSET ?";
                            $stmt_citas = mysqli_prepare($conexion, $sql_citas);
                            mysqli_stmt_bind_param($stmt_citas, "ii", $usuario_id, $offset);
                            mysqli_stmt_execute($stmt_citas);
                            $result_citas = mysqli_stmt_get_result($stmt_citas);

                            if (mysqli_num_rows($result_citas) > 0) {
                                echo "<table class='table'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Nombre Cliente</th>";
                                echo "<th>Teléfono</th>";
                                echo "<th>Fecha</th>";
                                echo "<th>Ganancia</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while ($row_cita = mysqli_fetch_assoc($result_citas)) {
                                    // Formatear la fecha
                                    $fecha_formateada = date("d/m/Y", strtotime($row_cita['fecha']));

                                    // Mostrar los detalles de la cita
                                    echo "<tr>";
                                    echo "<td>" . $row_cita['nombre_cliente'] . "</td>";
                                    echo "<td>" . $row_cita['telefono'] . "</td>";
                                    echo "<td>" . $fecha_formateada . "</td>"; // Fecha formateada
                                    echo "<td>$ " . $row_cita['cotizacion'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";

                                // Calcular el número total de páginas
                                $sql_count = "SELECT COUNT(*) as total FROM citas c 
                                            INNER JOIN horarios_disponibles hd ON c.hora_disponible_id = hd.id
                                            WHERE c.usuario_id = ? AND hd.estado = 'Tomada'";
                                $stmt_count = mysqli_prepare($conexion, $sql_count);
                                mysqli_stmt_bind_param($stmt_count, "i", $usuario_id);
                                mysqli_stmt_execute($stmt_count);
                                $result_count = mysqli_stmt_get_result($stmt_count);
                                $row_count = mysqli_fetch_assoc($result_count);
                                $total_citas = $row_count['total'];
                                $total_paginas = ceil($total_citas / 5); // 5 elementos por página

                                // Mostrar enlaces de paginación
                                echo "<div class='row'>";
                                echo "<div class='col'>";
                                echo "<nav aria-label='Page navigation'>";
                                echo "<ul class='pagination justify-content-center'>";
                                if ($pagina_actual != 1) {
                                    echo "<li class='page-item'><a class='page-link' href='panel_agenda.php?pagina=1'>Primera</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='panel_agenda.php?pagina=" . ($pagina_actual - 1) . "'>&laquo;</a></li>";
                                }
                                for ($i = 1; $i <= $total_paginas; $i++) {
                                    echo "<li class='page-item " . ($pagina_actual == $i ? 'active' : '') . "'><a class='page-link' href='panel_agenda.php?pagina=" . $i . "'>$i</a></li>";
                                }
                                if ($pagina_actual != $total_paginas) {
                                    echo "<li class='page-item'><a class='page-link' href='panel_agenda.php?pagina=" . ($pagina_actual + 1) . "'>&raquo;</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='panel_agenda.php?pagina=" . $total_paginas . "'>Última</a></li>";
                                }
                                echo "</ul>";
                                echo "</nav>";
                                echo "</div>";
                                echo "</div>";
                            } else {
                                echo "<p>No hay citas reservadas en este momento.</p>";
                            }
                            ?>
                        </div>
                    </div>
                    

                   

                    

                    <!-- Columna de la tabla (2/3) -->
                    <div class="col-md-8">
                        <!-- Mostrar los horarios disponibles -->
                        <div class="mt-3">
                            <h3>Gestion de horas</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><button class="btn" id="ordenarFecha">Fecha</th>
                                        <th><button class="btn" id="ordenarTurno">Turno</th>
                                        <th><button class="btn" id="ordenarEstado">Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Aquí se mostrarán los horarios disponibles utilizando PHP -->
                                    <?php
                                    // Conexión a la base de datos
                                    include '../conexion.php';

                                    $usuario_id = $_SESSION['usuario_id'];

                                    // Consulta SQL para obtener las citas del tatuador
                                    $sql_citas = "SELECT * FROM citas WHERE usuario_id = ?";
                                    $stmt_citas = mysqli_prepare($conexion, $sql_citas);
                                    mysqli_stmt_bind_param($stmt_citas, "i", $usuario_id);
                                    mysqli_stmt_execute($stmt_citas);
                                    $result_citas = mysqli_stmt_get_result($stmt_citas);

                                    // Definir la cantidad de registros por página
                                    $registros_por_pagina = 5;

                                    // Obtener el número de página actual
                                    $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

                                    // Calcular el offset
                                    $offset = ($pagina_actual - 1) * $registros_por_pagina;
                                    

                                    // Consulta SQL para obtener los horarios disponibles de la página actual
                                    $sql = "SELECT id, DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha_formato, 
                                                   CASE 
                                                       WHEN turno = 'am' THEN 'Mañana'
                                                       WHEN turno = 'pm' THEN 'Tarde'
                                                   END AS turno_formato, 
                                                   estado 
                                            FROM horarios_disponibles 
                                            WHERE usuario_id = ?
                                            LIMIT ? OFFSET ?";
                                    $stmt = mysqli_prepare($conexion, $sql);
                                    $usuario_id = $_SESSION['usuario_id'];
                                    mysqli_stmt_bind_param($stmt, "iii", $usuario_id, $registros_por_pagina, $offset);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $id, $fecha_formato, $turno_formato, $estado);
                                    

                                    // Mostrar los resultados
                                    while (mysqli_stmt_fetch($stmt)) {
                                        echo "<tr>";
                                        echo "<td>$fecha_formato</td>";
                                        echo "<td>$turno_formato</td>";
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
                                        echo "<option value='Disponible' " . ($estado == 'Disponible' ? 'selected' : '') . ">Disponible</option>";
                                        echo "<option value='Tomada' " . ($estado == 'Tomada' ? 'selected' : '') . ">Tomada</option>";
                                        echo "<option value='Cerrada' " . ($estado == 'Cerrada' ? 'selected' : '') . ">Cerrada</option>";
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
                                    

                                    
                                    // Cerrar la consulta
                                    mysqli_stmt_close($stmt);

                                    // Obtener el número total de registros
                                    $sql_total = "SELECT COUNT(*) AS total FROM horarios_disponibles WHERE usuario_id = ?";
                                    $stmt_total = mysqli_prepare($conexion, $sql_total);
                                    mysqli_stmt_bind_param($stmt_total, "i", $usuario_id);
                                    mysqli_stmt_execute($stmt_total);
                                    mysqli_stmt_bind_result($stmt_total, $total_registros);
                                    mysqli_stmt_fetch($stmt_total);
                                    mysqli_stmt_close($stmt_total);

                                    // Calcular el número total de páginas
                                    $total_paginas = ceil($total_registros / $registros_por_pagina);

                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Formulario para agregar un nuevo horario -->
                        <div class="mt-5">
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
                    
                </div>
            </div>

            <!-- Mostrar enlaces para navegar entre páginas -->
            <div class="row">
                <div class="col">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <?php if ($pagina_actual != 1) : ?>
                                <li class="page-item"><a class="page-link" href="panel_agenda.php?pagina=1">Primera</a></li>
                                <li class="page-item"><a class="page-link" href="panel_agenda.php?pagina=<?php echo $pagina_actual - 1; ?>">&laquo;</a></li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $total_paginas; $i++) : ?>
                                <li class="page-item <?php echo $i == $pagina_actual ? 'active' : ''; ?>"><a class="page-link" href="panel_agenda.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php endfor; ?>
                            <?php if ($pagina_actual != $total_paginas) : ?>
                                <li class="page-item"><a class="page-link" href="panel_agenda.php?pagina=<?php echo $pagina_actual + 1; ?>">&raquo;</a></li>
                                <li class="page-item"><a class="page-link" href="panel_agenda.php?pagina=<?php echo $total_paginas; ?>">Última</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>

            

           


        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="../assets/js/script.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    // Obtener referencia a los botones de ordenamiento
    var btnOrdenarFecha = document.getElementById('ordenarFecha');
    var btnOrdenarTurno = document.getElementById('ordenarTurno');
    var btnOrdenarEstado = document.getElementById('ordenarEstado');
    var tabla = document.querySelector('.table');
    var filas = tabla.querySelectorAll('tbody tr');

    // Función para comparar dos valores según el tipo de columna
    function comparar(a, b, columna) {
        if (columna === 0) {
            // Convertir las fechas a objetos Date para compararlas
            var fechaA = new Date(a);
            var fechaB = new Date(b);
            return fechaB - fechaA; // Ordenar de más reciente a más antigua
        } else {
            return a.localeCompare(b);
        }
    }

    // Función para ordenar las filas de la tabla
    function ordenarTabla(columna) {
        var filasArray = Array.from(filas);
        filasArray.sort(function (filaA, filaB) {
            var valorA = filaA.querySelectorAll('td')[columna].textContent;
            var valorB = filaB.querySelectorAll('td')[columna].textContent;
            return comparar(valorA, valorB, columna);
        });

        // Vaciar la tabla y volver a agregar las filas ordenadas
        tabla.querySelector('tbody').innerHTML = '';
        filasArray.forEach(function (fila) {
            tabla.querySelector('tbody').appendChild(fila);
        });
    }

    // Agregar eventos clic a los botones de ordenamiento
    btnOrdenarFecha.addEventListener('click', function () {
        ordenarTabla(0); // La primera columna es la fecha
    });

    btnOrdenarTurno.addEventListener('click', function () {
        ordenarTabla(1); // La segunda columna es el turno
    });

    btnOrdenarEstado.addEventListener('click', function () {
        ordenarTabla(2); // La tercera columna es el estado
    });
});
    </script>
</body>

</html>

<?php
} else {
    header("Location:../index.php");
}
?>
