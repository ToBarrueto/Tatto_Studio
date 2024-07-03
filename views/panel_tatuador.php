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
                    SUM(CASE WHEN estado = 'Confirmada' THEN 1 ELSE 0 END) AS horas_confirmadas
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
                                        <h5 class="card-title-custom4">Horas Confirmadas</h5>
                                        <p class="card-text-custom"><?php echo $datos_horas['horas_confirmadas']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                echo "<th>Correo</th>";
                                echo "<th>Fecha</th>";
                                echo "<th>Ganancia</th>";
                                echo "<th>Estado</th>";
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
                                    echo "<td>" . $row_cita['correo'] . "</td>";
                                    echo "<td>" . $fecha_formateada . "</td>"; // Fecha formateada
                                    echo "<td>$ " . $row_cita['cotizacion'] . "</td>";
                                    echo "<td>" . $row_cita['estado'] . "</td>"; // Estado
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
                                    echo "<li class='page-item'><a class='page-link' href='panel_tatuador.php?pagina=1'>Primera</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='panel_tatuador.php?pagina=" . ($pagina_actual - 1) . "'>&laquo;</a></li>";
                                }
                                for ($i = 1; $i <= $total_paginas; $i++) {
                                    echo "<li class='page-item " . ($pagina_actual == $i ? 'active' : '') . "'><a class='page-link' href='panel_tatuador.php?pagina=" . $i . "'>$i</a></li>";
                                }
                                if ($pagina_actual != $total_paginas) {
                                    echo "<li class='page-item'><a class='page-link' href='panel_tatuador.php?pagina=" . ($pagina_actual + 1) . "'>&raquo;</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='panel_tatuador.php?pagina=" . $total_paginas . "'>Última</a></li>";
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

                        <div class="mt-3">
                            <h3>Citas Tomadas</h3>
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
                                echo "<th>Correo</th>";
                                echo "<th>Fecha</th>";
                                echo "<th>Ganancia</th>";
                                echo "<th>Estado</th>";
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
                                    echo "<td>" . $row_cita['correo'] . "</td>";
                                    echo "<td>" . $fecha_formateada . "</td>"; // Fecha formateada
                                    echo "<td>$ " . $row_cita['cotizacion'] . "</td>";
                                    echo "<td>" . $row_cita['estado'] . "</td>"; // Estado
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
                                    echo "<li class='page-item'><a class='page-link' href='panel_tatuador.php?pagina=1'>Primera</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='panel_tatuador.php?pagina=" . ($pagina_actual - 1) . "'>&laquo;</a></li>";
                                }
                                for ($i = 1; $i <= $total_paginas; $i++) {
                                    echo "<li class='page-item " . ($pagina_actual == $i ? 'active' : '') . "'><a class='page-link' href='panel_tatuador.php?pagina=" . $i . "'>$i</a></li>";
                                }
                                if ($pagina_actual != $total_paginas) {
                                    echo "<li class='page-item'><a class='page-link' href='panel_tatuador.php?pagina=" . ($pagina_actual + 1) . "'>&raquo;</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='panel_tatuador.php?pagina=" . $total_paginas . "'>Última</a></li>";
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