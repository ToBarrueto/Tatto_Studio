<?php 
session_start();
  if ($_SESSION['tipo_usuario'] == 'cliente')
    {

?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Studio de Tatuajes - Clientes</title>
  <link rel="stylesheet" href="../assets/css/landing.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://www.paypal.com/sdk/js?client-id=ARPOFtWdnhuV3YwzncncSwHL7vXVXBVqLU3iFbrQ4O5cWqkPDM2JMqWRLEL7PbMh5S12Lw2EiZw9igzx&currency=USD"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</head>

<header>
        <a href="landing.php" class="logo">TattoStudioINK</a>
        <nav>
            <ul>
                <li><a href="landing.php">Inicio</a></li>
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


<body>

<div class="zona3 d-flex justify-content-center ">
        <div class="container text-center ">
            <div class="row">
                <div class="col">
                    <h1 class="title-custom3">Reservas Realizadas</h1>
                    <p class="p-custom3 mt-5">
                        Al realizar una reserva, Te llegara un correo con todos los detalles nesesarios , Recuerda que debes pagar el 15% de la reserva para confirmar tu hora.</p>
                </div>

                <?php 

    if ($_SESSION['tipo_usuario'] == 'cliente') {
        // Incluir el archivo de conexión a la base de datos
        include '../conexion.php'; 
        
        // Obtener el ID del cliente de la sesión
        $cliente_id = $_SESSION['usuario_id'];
        
        // Consulta SQL para obtener las citas del cliente
        $sql_citas = "SELECT citas.*, 
                            tatuadores.nombre AS nombre_tatuador, 
                            DATE_FORMAT(horarios_disponibles.fecha, '%d/%m/%Y') AS fecha_formato,
                            CASE 
                                WHEN horarios_disponibles.turno = 'am' THEN '09:00 a 14:00'
                                WHEN horarios_disponibles.turno = 'pm' THEN '16:00 a 21:00'
                            END AS hora_formato,
                            horarios_disponibles.estado AS estado_horario
                        FROM citas
                        INNER JOIN tatuadores ON citas.usuario_id = tatuadores.usuario_id
                        INNER JOIN horarios_disponibles ON citas.hora_disponible_id = horarios_disponibles.id
                        WHERE citas.cliente_id = $cliente_id";
                        
        $resultado_citas = $conexion->query($sql_citas);
        
        if ($resultado_citas->num_rows > 0) {
            // Mostrar la información de las citas del cliente
            echo '<div class="row justify-content-center">';
            echo '<div class="card m-4 col-7">';
            echo '<div class="table-responsive">';
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col">Tatuador</th>';
            echo '<th scope="col">Fecha</th>';
            echo '<th scope="col">Hora</th>';
            echo '<th scope="col">Precio Total</th>'; // Cambié el título de la columna
            echo '<th scope="col">Estado</th>';
            echo '<th scope="col">Reserva</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            while ($fila_cita = $resultado_citas->fetch_assoc()) {
                // Formatear el precio total a pesos chilenos
                $precio_total_clp = number_format($fila_cita['precio_total'], 0, ',', '.');
                
                // Mostrar los detalles de la cita en una fila de la tabla
                echo '<tr>';
                echo '<td>' . $fila_cita['nombre_tatuador'] . '</td>';
                echo '<td>' . $fila_cita['fecha_formato'] . '</td>';
                echo '<td>' . $fila_cita['hora_formato'] . '</td>';
                echo '<td>$' . $precio_total_clp . '</td>'; // Mostrar el precio total en formato CLP
                echo '<td>' . $fila_cita['estado_horario'] . '</td>';
                if ($fila_cita['estado_horario'] == 'Confirmada') {
                    echo '<td>Pagada</td>'; // Si el estado es "Confirmada", mostrar "Pagada" en lugar del enlace
                } else {
                    echo '<td><a href="detalle_reserva.php?id=' . $fila_cita['id'] . '">Ir a Pagar</a></td>';
                }
                echo '</tr>';
            }
            
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        } else {
            // No hay citas registradas
            echo '<div class="row justify-content-center">';
            echo '<div class="card m-4 col-6 text-center">';
            echo '<p class="fw-bold fs-5">No tienes citas registradas.</p>';
            echo '</div>';
            echo '</div>';
        }
        
        // Cerrar la conexión a la base de datos
        $conexion->close();
    } else {
        header("Location:../index.php");
        exit(); // Asegúrate de salir del script después de redirigir
    }
    ?>
    

                
            </div>
        </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
  integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

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

<?php }
  else{
    header("Location:../index.php");
  }?>