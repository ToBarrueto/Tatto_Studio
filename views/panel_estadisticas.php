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

                        <?php

                        include '../conexion.php';

                        $sql = "SELECT t.nombre AS tatuador, COUNT(hd.id) AS horas_tomadas
                        FROM tatuadores t
                        INNER JOIN horarios_disponibles hd ON t.usuario_id = hd.usuario_id
                        WHERE hd.estado = 'Tomada'
                        GROUP BY t.nombre";
                        $resultado = mysqli_query($conexion, $sql);

                        $datos_tatuadores31 = array();
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                        $datos_tatuadores1[$fila['tatuador']] = $fila['horas_tomadas'];
                        }

                        $sql = "SELECT t.nombre AS tatuador, SUM(c.comision) AS comision_total
                                FROM tatuadores t
                                INNER JOIN citas c ON t.usuario_id = c.usuario_id
                                GROUP BY t.nombre";
                        $resultado = mysqli_query($conexion, $sql);

                        $datos_tatuadores = array();
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            $datos_tatuadores[$fila['tatuador']] = $fila['comision_total'];
                        }

                        $sql = "SELECT 
                        t.nombre AS tatuador, 
                        SUM(CASE WHEN c.alto * c.ancho > 100 THEN 1 ELSE 0 END) AS tatuajes_grandes,
                        SUM(CASE WHEN c.alto * c.ancho <= 100 THEN 1 ELSE 0 END) AS tatuajes_pequenos
                                FROM 
                                    tatuadores t
                                    INNER JOIN citas c ON t.usuario_id = c.usuario_id
                                GROUP BY 
                                    t.nombre";
                        
                        $resultado = mysqli_query($conexion, $sql);
                    
                        // Crear un array para almacenar los datos
                        $datos_tatuadores3 = array();
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            $datos_tatuadores3[$fila['tatuador']] = array(
                                'tatuajes_grandes' => $fila['tatuajes_grandes'],
                                'tatuajes_pequenos' => $fila['tatuajes_pequenos']
                            );
                        }

                        $sql = "SELECT 
                                t.nombre AS tatuador, 
                                SUM(CASE WHEN c.color = 'Si' THEN 1 ELSE 0 END) AS tatuajes_color,
                                SUM(CASE WHEN c.color = 'No' THEN 1 ELSE 0 END) AS tatuajes_bn
                            FROM 
                                tatuadores t
                                INNER JOIN citas c ON t.usuario_id = c.usuario_id
                            GROUP BY 
                                t.nombre";
                    
                    $resultado = mysqli_query($conexion, $sql);

                    // Crear un array para almacenar los datos
                    $datos_tatuadores4 = array();
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $datos_tatuadores4[$fila['tatuador']] = array(
                            'tatuajes_color' => $fila['tatuajes_color'],
                            'tatuajes_bn' => $fila['tatuajes_bn']
                        );
                    }

                    $sql = "SELECT MONTH(hd.fecha) AS mes, SUM(c.precio_total) AS ingresos_por_mes
                            FROM citas c
                            INNER JOIN horarios_disponibles hd ON c.hora_disponible_id = hd.id
                            GROUP BY mes
                            ORDER BY mes";
                    $resultado = mysqli_query($conexion, $sql);

                    // Inicializar el array de datos de ingresos por mes
                    $datos_ingresos_mes = array();

                    // Recorrer los resultados y almacenarlos en el array
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        // Obtener el nombre del mes a partir del número del mes
                        $nombre_mes = date("F", mktime(0, 0, 0, $fila['mes'], 1));
                        
                        // Almacenar los ingresos por mes en el array
                        $datos_ingresos_mes[$nombre_mes] = $fila['ingresos_por_mes'];
                    }


                    $sql = "SELECT MONTH(hd.fecha) AS mes, SUM(c.comision) AS comision_por_mes
                            FROM citas c
                            INNER JOIN horarios_disponibles hd ON c.hora_disponible_id = hd.id
                            GROUP BY mes
                            ORDER BY mes";
                    $resultado = mysqli_query($conexion, $sql);

                    // Inicializar el array de datos de ingresos por mes
                    $datos_comision_mes = array();

                    // Recorrer los resultados y almacenarlos en el array
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        // Obtener el nombre del mes a partir del número del mes
                        $nombre_mes = date("F", mktime(0, 0, 0, $fila['mes'], 1));
                        
                        // Almacenar las comisiones por mes en el array
                        $datos_comision_mes[$nombre_mes] = $fila['comision_por_mes'];
                    }

                    $sql = "SELECT SUM(precio_total) AS ganancia_total FROM citas";

                    // Ejecutar la consulta
                    $result = $conexion->query($sql);

                    // Procesar los resultados
                    $ganancia_total = 0;
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $ganancia_total = $row["ganancia_total"];
                    }

                    $sql = "SELECT SUM(comision) AS comision_total FROM citas";

                    // Ejecutar la consulta
                    $result = $conexion->query($sql);

                    // Procesar los resultados
                    $comision_total = 0;
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $comision_total = $row["comision_total"];
                    }





                        
                        $conexion->close();
                        ?>


        <div class="main">

            <main class="content px-3 py-4">
                <div class="container-fluid">
                

                    <div class="container">
                        <div class="row">

                        <div class="row">

                            <h2 class="mt-2">Estadisticas de tatuadores</h2>

                            <div class="col-md-3 mt-4 text-center">
                                <h4>Color / BYN </h4>
                                <canvas id="graficoColor" width="300" height="300"></canvas>
                            </div>

                            <div class="col-md-3 mt-4 text-center">
                                <h4>Grandes / Pequeños</h4>
                                <canvas id="graficoTatuajes" width="300" height="300"></canvas>
                            </div>
                            
                            <div class="col-md-3 mt-4 text-center">
                                <h4>Horas Tomadas</h4>
                                <canvas id="graficoHorasTomadas" width="300" height="300"></canvas>
                            </div>

                            <div class="col-md-3 mt-4 text-center">
                                <h4>Comision Generada</h4>
                                <canvas id="graficoComisionTatuador" width="300" height="300"></canvas>
                            </div>

                            

                        </div>

                            <!-- Columna izquierda -->
                            <h2 class="mt-4">Estadisticas del estudio</h2>
                            <div class="col-md-3 mt-4 text-center">
                                <h3>Ingresos Mensuales</h3>
                                <canvas id="ingresosPorMesChart" width="300" height="300"></canvas>
                            </div>
                            <!-- Columna derecha -->
                            <div class="col-md-3 mt-4 text-center">
                                <h3>Ganancia Mensual</h3>
                                <canvas id="graficoComisiones" width="300" height="300"></canvas>
                            </div>

                            <div class="col-md-3 mt-4 text-center">
                                <h3>Ingresos Totales</h3>
                                <canvas id="graficoGananciaTotal" width="300" height="300"></canvas>
                            </div>

                            <div class="col-md-3 mt-4 text-center">
                                <h3>Ganancia Total</h3>
                                <canvas id="graficoComisionTotal" width="300" height="300"></canvas>
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
    var data = <?php echo json_encode($datos_tatuadores1); ?>;
    var tatuadores = Object.keys(data);
    var horasTomadas = Object.values(data);

    var myChart = new Chart(ctx, {
        type: 'bar',
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
    var ctx = document.getElementById('graficoComisionTatuador').getContext('2d');
    var data = <?php echo json_encode($datos_tatuadores); ?>;
    var tatuadores = Object.keys(data);
    var comisiones = Object.values(data);

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: tatuadores,
            datasets: [{
                label: 'Comisión Generada (CLP)',
                data: comisiones,
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
            title: {}
        }
    });
</script>

<script>
    var ctx = document.getElementById('graficoTatuajes').getContext('2d');
    var data = <?php echo json_encode($datos_tatuadores3); ?>;
    var tatuadores = Object.keys(data);
    var tatuajesGrandes = [];
    var tatuajesPequenos = [];

    // Separar los datos en arreglos para tatuajes grandes y pequeños
    for (var tatuador in data) {
        tatuajesGrandes.push(data[tatuador]['tatuajes_grandes']);
        tatuajesPequenos.push(data[tatuador]['tatuajes_pequenos']);
    }

    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: tatuadores,
            datasets: [{
                label: 'Tatuajes Grandes',
                data: tatuajesGrandes,
                backgroundColor: 'rgba(255, 99, 132, 0.6)'
            }, {
                label: 'Tatuajes Pequeños',
                data: tatuajesPequenos,
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Cantidad de Tatuajes Grandes y Pequeños por Tatuador'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('graficoColor').getContext('2d');
    var data = <?php echo json_encode($datos_tatuadores4); ?>;
    var tatuadores = Object.keys(data);
    var tatuajesColor = [];
    var tatuajesBN = [];

    // Separar los datos en arreglos para tatuajes a color y en blanco y negro
    for (var i = 0; i < tatuadores.length; i++) {
        var tatuador = tatuadores[i];
        tatuajesColor.push(data[tatuador]['tatuajes_color']);
        tatuajesBN.push(data[tatuador]['tatuajes_bn']);
    }

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: tatuadores,
            datasets: [{
                label: 'Tatuajes a Color',
                data: tatuajesColor,
                backgroundColor: 'rgba(255, 99, 132, 0.6)'
            }, {
                label: 'Tatuajes en Blanco y Negro',
                data: tatuajesBN,
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Cantidad de Tatuajes a Color y en Blanco y Negro por Tatuador'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<script>
        // Obtener el contexto del canvas
        var ctx = document.getElementById('ingresosPorMesChart').getContext('2d');

        // Datos de ingresos por mes (obtenidos desde PHP)
        var datosIngresosMes = <?php echo json_encode($datos_ingresos_mes); ?>;

        // Nombres de los meses
        var meses = Object.keys(datosIngresosMes);

        // Valores de los ingresos por mes
        var ingresosPorMes = Object.values(datosIngresosMes);

        // Crear el gráfico de barras
        var ingresosPorMesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Ingresos por Mes',
                    data: ingresosPorMes,
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
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

<script>
        // Obtener el contexto del lienzo para el gráfico
        var ctx = document.getElementById('graficoComisiones').getContext('2d');

        // Datos para el gráfico (nombres de los meses y comisiones por mes)
        var nombresMeses = <?php echo json_encode(array_keys($datos_comision_mes)); ?>;
        var comisionesPorMes = <?php echo json_encode(array_values($datos_comision_mes)); ?>;

        // Crear el gráfico de barras
        var graficoComisiones = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: nombresMeses,
                datasets: [{
                    label: 'Comisiones por Mes',
                    data: comisionesPorMes,
                    backgroundColor: [
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
                borderColor: [

                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

<script>
    var ctx3 = document.getElementById('graficoGananciaTotal').getContext('2d');
    var gananciaData = <?php echo $ganancia_total; ?>;
    var myChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: ['Ingresos Totales'],
            datasets: [{
                label: 'Ingreso Total del Estudio',
                data: [gananciaData],
                backgroundColor: [
                    'rgba(255, 49, 11, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 122, 122, 0.1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Ingresos Total del Estudio'
            }
        }
    });
</script>

<script>
    var ctx3 = document.getElementById('graficoComisionTotal').getContext('2d');
    var gananciaData = <?php echo $comision_total; ?>;
    var myChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: ['Ganancia Total'],
            datasets: [{
                label: 'Ganancia Total del Estudio',
                data: [gananciaData],
                backgroundColor: [
                    'rgba(0, 147, 11, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 122, 122, 0.1)'
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