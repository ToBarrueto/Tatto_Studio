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

                        <h1>Reportes</h1>

                        <div class="container text-center mt-4">

                            <div class="container text-center">
                                <div class="row g-5">

                                    <div class="col-6">
                                        <div class="card-2">
                                            <h3 class="mt-4 mb-4">Generar Reporte Mensual de Desempeño</h3>
                                            <form class="mb-4" action="generar_reporte.php" method="GET" target="_blank">
                                                <label for="mes">Mes:</label>
                                                <select name="mes" id="mes">
                                                    <option value="1">Enero</option>
                                                    <option value="2">Febrero</option>
                                                    <option value="3">Marzo</option>
                                                    <option value="4">Abril</option>
                                                    <option value="5">Mayo</option>
                                                    <option value="6">Junio</option>
                                                    <option value="7">Julio</option>
                                                    <option value="8">Agosto</option>
                                                    <option value="9">Septiembre</option>
                                                    <option value="10">Octubre</option>
                                                    <option value="11">Noviembre</option>
                                                    <option value="12">Diciembre</option>
                                                </select>
                                                <label for="año">Año:</label>
                                                <input type="number" name="año" id="año" min="1900" max="2100"
                                                    value="<?php echo date('Y'); ?>">
                                                    <div class="mt-3">
                                                        <button type="submit" class="btn btn-dark">Generar Reporte PDF</button>
                                                    </div>
                                            </form>
                                        </div>                                  
                                    </div>

                                    <div class="col-6">
                                        <div class="card-2">
                                            <h3 class="mt-4 mb-4">Generar Reporte Anual de Desempeño</h3>
                                            <form class="mb-4" action="generar_reporte_AD.php" method="GET" target="_blank">
                                                
                                                <label for="año">Año:</label>
                                                <input type="number" name="año" id="año" min="1900" max="2100"
                                                    value="<?php echo date('Y'); ?>">
                                                    <div class="mt-3">
                                                        <button type="submit" class="btn btn-dark">Generar Reporte PDF</button>
                                                    </div>
                                            </form>
                                        </div>                                  
                                    </div>

                                    <div class="col-6">
                                        <div class="card-2">
                                            <h3 class="mt-4 mb-4">Generar Reporte Mensual de Ganancias</h3>
                                            <form class="mb-4" action="generar_reporte.php" method="GET" target="_blank">
                                                <label for="mes">Mes:</label>
                                                <select name="mes" id="mes">
                                                    <option value="1">Enero</option>
                                                    <option value="2">Febrero</option>
                                                    <option value="3">Marzo</option>
                                                    <option value="4">Abril</option>
                                                    <option value="5">Mayo</option>
                                                    <option value="6">Junio</option>
                                                    <option value="7">Julio</option>
                                                    <option value="8">Agosto</option>
                                                    <option value="9">Septiembre</option>
                                                    <option value="10">Octubre</option>
                                                    <option value="11">Noviembre</option>
                                                    <option value="12">Diciembre</option>
                                                </select>
                                                <label for="año">Año:</label>
                                                <input type="number" name="año" id="año" min="1900" max="2100"
                                                    value="<?php echo date('Y'); ?>">
                                                    <div class="mt-3">
                                                        <button  type="submit" class="btn btn-dark">Generar Reporte PDF</button>
                                                    </div>
                                            </form>
                                        </div>                                  
                                    </div>

                                    <div class="col-6">
                                        <div class="card-2">
                                            <h3 class="mt-4 mb-4">Generar Reporte Anual de Ganancias</h3>
                                            <form class="mb-4" action="generar_reporte.php" method="GET" target="_blank">
                                                <label for="año">Año:</label>
                                                <input type="number" name="año" id="año" min="1900" max="2100"
                                                    value="<?php echo date('Y'); ?>">
                                                    <div class="mt-3">
                                                        <button type="submit" class="btn btn-dark">Generar Reporte PDF</button>
                                                    </div>
                                            </form>
                                        </div>                                  
                                    </div>

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
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>

<?php }
  else{
    header("Location:../index.php");
  }?>