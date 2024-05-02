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


                        $sql = "SELECT t.nombre AS tatuador, COUNT(hd.id) AS horas_tomadas
                        FROM tatuadores t
                        INNER JOIN horarios_disponibles hd ON t.usuario_id = hd.usuario_id
                        WHERE hd.estado = 'Tomada'
                        GROUP BY t.nombre";
                        $resultado = mysqli_query($conexion, $sql);

                        // Array para almacenar los datos
                        $datos_tatuadores = array();
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                        $datos_tatuadores[$fila['tatuador']] = $fila['horas_tomadas'];
                        }

                        // $colores = array('#FF5733', '#33FF57', '#5733FF', '#33FFFF');

                        $sql = "SELECT 
                            t.nombre AS tatuador,
                            SUM(c.precio_total) AS dinero_generado
                        FROM 
                            citas c
                        INNER JOIN 
                            tatuadores t ON c.usuario_id = t.usuario_id
                        GROUP BY 
                            t.nombre
                        ORDER BY 
                            dinero_generado DESC";

                            $result = $conexion->query($sql);

                            // Procesar los resultados en un formato adecuado para Chart.js
                            $datos_tatuadores_dinero = array();
                            while ($row = $result->fetch_assoc()) {
                                $datos_tatuadores_dinero[$row['tatuador']] = $row['dinero_generado'];
                            }

                            $sql = "SELECT SUM(comision) AS ganancia_studio FROM citas";
                            $result = $conexion->query($sql);

                            // Procesar los resultados
                            $ganancia_studio = 0;
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $ganancia_studio = $row["ganancia_studio"];
                            }

                            $ganancia_formateada = number_format($ganancia_studio, 0, ',', '.');

                            $sql = "SELECT SUM(precio_total) AS ganancia_total FROM citas";

                            // Ejecutar la consulta
                            $result = $conexion->query($sql);

                            // Procesar los resultados
                            $ganancia_total = 0;
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $ganancia_total = $row["ganancia_total"];
                            }

                            $ganancia_total_formateada = number_format($ganancia_total, 0, ',', '.');




                        // Cerrar la conexión a la base de datos
                        $conexion->close();
                        ?>

                        <!-- Mostrar las tarjetas con el resumen -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card-custom">
                                    <div class="card-body-custom">
                                        <h5 class="card-title-custom">Clientes Registrados</h5>
                                        <p class="card-text-custom">
                                            <?php echo $total_clientes; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-custom2">
                                    <div class="card-body-custom">
                                        <h5 class="card-title-custom2">Tatuadores Registrados</h5>
                                        <p class="card-text-custom">
                                            <?php echo $total_tatuadores; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-custom3">
                                    <div class="card-body-custom">
                                        <h5 class="card-title-custom3">Ingresos generados</h5>
                                        <p class="card-text-custom">$
                                            <?php echo $ganancia_total_formateada; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-custom4">
                                    <div class="card-body-custom">
                                        <h5 class="card-title-custom4">Comision Estudio</h5>
                                        <p class="card-text-custom">$
                                            <?php echo $ganancia_formateada; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="container">
                        <div class="row">

                        <div class="col-md-2 text-center">
                               
                                <canvas id="g" width="250" height="250"></canvas>
                            </div>

                            <!-- Columna izquierda -->
                            <div class="col-md-4 text-center">
                                <h3>Ganancia del estudio</h3>
                                <canvas id="graficoGananciaTotal" width="250" height="250"></canvas>
                            </div>
                            
                            
                            <!-- Columna derecha -->
                            <div class="col-md-4 ml-2 text-center">
                                <h3>Desglose de Ganancias</h3>
                                <canvas id="graficoDineroGenerado" width="250" height="250"></canvas>
                            </div>

                            <div class="col-md-2 text-center">
                               
                                <canvas id="g" width="250" height="250"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    var ctx = document.getElementById('graficoHorasTomadas').getContext('2d');
    var data = <?php echo json_encode($datos_tatuadores); ?>;
    var tatuadores = Object.keys(data);
    var horasTomadas = Object.values(data);

    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: tatuadores,
            datasets: [{
                label: 'Horas Tomadas',
                data: horasTomadas,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            title: {
            }
        }
    });
</script>

<script>
    var ctx2 = document.getElementById('graficoDineroGenerado').getContext('2d');
    var dineroData = <?php echo json_encode($datos_tatuadores_dinero); ?>;
    var tatuadores2 = Object.keys(dineroData);
    var dineroGenerado = Object.values(dineroData);

    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: tatuadores2,
            datasets: [{
                label: 'Dinero Generado',
                data: dineroGenerado,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            title: {
                display: true,
                text: 'Dinero Generado por Tatuador'
            }
        }
    });
</script>

<script>
    var ctx3 = document.getElementById('graficoGananciaTotal').getContext('2d');
    var gananciaData = <?php echo $ganancia_studio; ?>;
    var myChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: ['Ganancia Total'],
            datasets: [{
                label: 'Ganancia Total del Estudio',
                data: [gananciaData],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Ganancia Total del Estudio'
            }
        }
    });
</script>


</body>

</html>

<?php }
  else{
    header("Location:../index.php");
  }?>