<?php 
session_start();
if ($_SESSION['tipo_usuario'] == 'cliente') {
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Tatuador</title>
    <link rel="stylesheet" href="../assets/css/landing.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</head>

<body>

    <header>
        <a href="landing.php" class="logo">TattoStudioINK</a>
        <nav>
            <ul>
                <li><a href="landing.php#">Inicio</a></li>
                <li><a href="landing.php#nosotros">Nosotros</a></li>
                <li><a href="landing.php#servicios">Servicios</a></li>
                <li><a href="landing.php#tatuadores">Tatuadores</a></li>
                <li>
                    <a href="#">Mi Cuenta &#x25BE;</a>
                    <ul class="dropdown">
                        <li><a href="micuenta.php">Mis Reservas</a></li>
                        <li><a href="../index.php">Cerrar Sesion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirmación de Cierre de Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas cerrar sesión?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a id="confirmLogout" class="btn btn-dark">Salir</a>
                </div>
            </div>
        </div>
    </div>


    <div class="zona3 d-flex justify-content-center ">
        <div class="container text-center ">
            <div class="row">

                <?php
                include '../conexion.php'; 
    
                if (isset($_GET['id'])) {
                    $tatuador_id = $_GET['id'];
    
                    $sql_usuario_id = "SELECT usuario_id FROM tatuadores WHERE id = $tatuador_id";
                    $resultado_usuario_id = $conexion->query($sql_usuario_id);
    
                    if ($resultado_usuario_id->num_rows > 0) {
                        $fila_usuario_id = $resultado_usuario_id->fetch_assoc();
                        $usuario_id = $fila_usuario_id['usuario_id'];
    
                        $sql_tatuador = "SELECT * FROM tatuadores WHERE id = $tatuador_id";
                        $resultado_tatuador = $conexion->query($sql_tatuador);
    
                        if ($resultado_tatuador->num_rows > 0) {
                            $tatuador = $resultado_tatuador->fetch_assoc();
    
                            // Mostrar el portafolio del tatuador
                            $sql_portafolio = "SELECT * FROM portafolio WHERE usuario_id = $usuario_id";
                            $resultado_portafolio = $conexion->query($sql_portafolio);
    
                            if ($resultado_portafolio->num_rows > 0) {
                                echo "<h1 class='title-custom5'>Trabajos de {$tatuador['nombre']}</h1>";
                                echo "<p class='p-custom5'>{$tatuador['descripcion']}</p>";
                                
                                // Contador para rastrear el número de imágenes mostradas
                                $contador = 0;
    
                                // Abre la primera fila
                                echo '<div class="row">';
    
                                while ($fila_portafolio = $resultado_portafolio->fetch_assoc()) {
                                    // Si el contador alcanza 3, cierra la fila actual y abre una nueva
                                    if ($contador % 4 == 0 && $contador != 0) {
                                        echo '</div>'; // Cierra la fila actual
                                        echo '<div class="row g-2">'; // Abre una nueva fila
                                    }
    
                                    echo '<div class="col-md-3">';
                                    echo '<img src="'. $fila_portafolio["ruta_imagen"].'" alt="Imagen de Tatuaje" class="img-fluid m-2">';
                                    echo '</div>';
    
                                    $contador++;
                                }
    
                                // Cierra la fila final
                                echo '</div>';
                                
                            } else {
                                echo 'El tatuador no tiene imágenes en su portafolio.';
                            }
    
                            echo '</div>'; 
                            echo '</div>'; 
                            echo '</div>'; 

            echo '<div class="zona4 d-flex justify-content-center ">';
            echo '<div class="container text-center ">';
            
            echo '<div class="row d-flex justify-content-center mt-5">';
            

             // Formulario de reserva de citas
           
                echo '<div class="card col-8 mt-5">';
                echo '<div class="card-body">';
                echo '<h2>Cotiza y Agenda tu Hora</h2>';
                echo '<form action="procesar_reserva.php" method="POST" enctype="multipart/form-data">';
                echo '<input type="hidden" name="tatuador_id" value="' . $usuario_id . '">';

                // Campo de ID de cliente
                echo '<input type="hidden" name="cliente_id" value="' . $_SESSION['usuario_id'] . '">';

                // Campos adicionales
                echo '<div class="row">';
                echo '<div class="col-md-6 mt-3">';
                echo '<div class="mb-2">';
                echo '<label for="nombre_cliente" class="form-label">Nombre Completo:</label>';
                echo '<input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" required>';
                echo '</div>';

                echo '<div class="mb-2">';
                echo '<label for="telefono" class="form-label">Número de Celular:</label>';
                echo '<input type="tel" class="form-control" id="telefono" name="telefono" required>';
                echo '</div>';

                echo '<div class="mb-2">';
                echo '<label for="correo" class="form-label">Correo Electrónico:</label>';
                echo '<input type="email" class="form-control" id="correo" name="correo" required>';
                echo '</div>';

                echo '<div class="mb-2">';
                echo '<label for="imagen_referencia" class="form-label">Imagen de Referencia:</label>';
                echo '<input type="file" class="form-control" id="imagen_referencia" name="imagen_referencia">';
                echo '</div>';
                echo '</div>';

                echo '<div class="col-md-6 mt-3">';
                echo '<div class="mb-2">';
                echo '<label for="alto" class="form-label">Alto del Tatuaje (cm):</label>';
                echo '<input type="number" class="form-control" id="alto" name="alto" required>';
                echo '</div>';

                echo '<div class="mb-2">';
                echo '<label for="ancho" class="form-label">Ancho del Tatuaje (cm):</label>';
                echo '<input type="number" class="form-control" id="ancho" name="ancho" required>';
                echo '</div>';

                echo '<div class="mb-2">';
                echo '<label for="color" class="form-label">Color:</label>';
                echo '<select class="form-select" id="color" name="color">';
                echo '<option value="si">Con color</option>';
                echo '<option value="no">Sin color</option>';
                echo '</select>';
                echo '</div>';

                echo '<div class="mb-2">';
                echo '<label for="cotizacion" class="form-label">Cotización:</label>';
                echo '<input type="text" class="form-control" id="cotizacion_aproximada" name="cotizacion" readonly>';
                echo '</div>';

                echo '<div class="mb-2">';
                echo '<label for="comision" class="form-label">Comisión:</label>';
                echo '<input type="text" class="form-control" id="comision_aproximada"  name="comision" readonly>';
                echo '</div>';

                echo '<div class="mb-2">';
                echo '<label for="precio_total" class="form-label">Precio Total:</label>';
                echo '<input type="text" class="form-control" id="precio_total_aproximado" name="precio_total" readonly>';
                echo '</div>';

                echo '<button type="button" onclick="calcularCotizacion()" class="btn btn-dark mt-2">Calcular Cotización</button>';
                
                
                echo '</div>';
                echo '</div>';
                echo '</div>';

                // Consulta para obtener el precioBasePorCm2 del tatuador
                $sql_precio_base = "SELECT precioBase FROM tatuadores WHERE id = $tatuador_id";
                $resultado_precio_base = $conexion->query($sql_precio_base);

                if ($resultado_precio_base->num_rows > 0) {
                    $fila_precio_base = $resultado_precio_base->fetch_assoc();
                    
                } else {
                    $precioBasePorCm2 = 0;
                }

                echo '<input type="hidden" id="precioBase" value="' . $fila_precio_base['precioBase'] . '">';
                echo '<script>console.log("Precio base obtenido de la base de datos:", ' . $fila_precio_base['precioBase'] . ');</script>';


                // Selección de hora disponible
                echo '<div class="mb-3">';
                echo '<label for="hora" class="form-label">Seleccionar Hora Disponible:</label>';
                echo '<select class="form-select" id="hora" name="hora" required>';
                echo '</div>';

                setlocale(LC_TIME, 'es_ES.UTF-8');

                // Consulta para obtener las horas disponibles
                $sql_horas_disponibles = "SELECT * FROM horarios_disponibles WHERE usuario_id = $usuario_id AND estado = 'Disponible'";
                $resultado_horas_disponibles = $conexion->query($sql_horas_disponibles);

                if ($resultado_horas_disponibles->num_rows > 0) {
                    while ($fila_hora = $resultado_horas_disponibles->fetch_assoc()) {
                        // Formatear la fecha en el formato deseado en español
                        $fecha_formateada = strftime('%d-%B-%Y', strtotime($fila_hora['fecha']));

                        // Convertir el valor del turno a "Mañana" o "Tarde"
                        $turno_texto = ($fila_hora['turno'] == 'am') ? 'Mañana' : 'Tarde';

                        echo "<option value='{$fila_hora['id']}'>$fecha_formateada - $turno_texto</option>";
                    }
                } else {
                    echo '<option value="" disabled>No hay horas disponibles</option>';
                }

                echo '</select>';
                echo '</div>';

                echo '<button type="submit" class="btn btn-dark mb-3">Reservar cita</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                            
                        } else {
                            echo "Tatuador no encontrado.";
                        }
                    } else {
                        echo "ID de tatuador no válido.";
                    }
                } else {
                    echo "ID del tatuador no especificado.";
                }

                $conexion->close();
                } else {
                    header("Location:../index.php");
                }
                ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    window.addEventListener("scroll", function() {
        var header = document.querySelector("header");
        header.classList.toggle("abajo", window.scrollY > 0);
    })
    </script>

    <script>
    function calcularCotizacion() {
        var alto = document.getElementById('alto').value;
        var ancho = document.getElementById('ancho').value;
        var color = document.getElementById('color').value;
        var precioBasePorCm2 = document.getElementById('precioBase').value;

        // Verificar el valor del precio base en la consola del navegador
        console.log("Precio base por cm2 obtenido de la base de datos:", precioBasePorCm2);

        // Calcular el área del tatuaje
        var area = alto * ancho;

        // Calcular el precio base del tatuaje
        var precioBase = area * precioBasePorCm2;

        // Aplicar un costo adicional si el tatuaje es a color
        if (color === 'si') {
            var costoColor = precioBase * 0.20;
            precioBase += costoColor;
        }

        // Calcular la comisión
        var comision = precioBase * 0.20;

        // Calcular el precio total
        var cotizacionTotal = precioBase + comision;

        // Mostrar la cotización, la comisión y el precio total en el formulario
        document.getElementById('cotizacion_aproximada').value = Math.floor(precioBase);
        document.getElementById('comision_aproximada').value = Math.floor(comision);
        document.getElementById('precio_total_aproximado').value = Math.floor(cotizacionTotal);
    }
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var logoutLink = document.querySelector('a[href="../index.php"]');
        var confirmLogoutButton = document.getElementById('confirmLogout');

        if (logoutLink) {
            logoutLink.addEventListener('click', function(event) {
                event.preventDefault();
                var logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'));
                logoutModal.show();
            });

            confirmLogoutButton.addEventListener('click', function() {
                window.location.href = '../index.php';
            });
        }
    });
    </script>

    


</body>

</html>