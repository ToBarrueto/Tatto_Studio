<?php
include '../conexion.php';

if (isset($_GET['id'])) {
    $reserva_id = $_GET['id'];

    $sql = "SELECT citas.*, tatuadores.nombre AS nombre_tatuador, 
    DATE_FORMAT(horarios_disponibles.fecha, '%d/%m/%Y') AS fecha_formato,
    horarios_disponibles.id AS horario_disponible_id
    FROM citas 
    INNER JOIN tatuadores ON citas.usuario_id = tatuadores.usuario_id 
    INNER JOIN horarios_disponibles ON citas.hora_disponible_id = horarios_disponibles.id 
    WHERE citas.id = $reserva_id";

    // Ejecutar la consulta
    $resultado = $conexion->query($sql);

    // Verificar si se encontraron resultados
    if ($resultado->num_rows > 0) {
        // Obtener los datos de la reserva, el nombre del tatuador y la fecha
        $fila_reserva = $resultado->fetch_assoc();
        $nombre_tatuador = $fila_reserva['nombre_tatuador'];
        $fecha_reserva = $fila_reserva['fecha_formato'];
        $horario_disponible_id = $fila_reserva['horario_disponible_id'];

        // Calcular el 15% del precio total
        $precio_total = $fila_reserva['precio_total'];
        $precio_15_porcentaje = $precio_total * 0.15;

        // Formatear los precios en formato de moneda chilena
        $precio_total_clp = number_format($precio_total, 0, ',', '.');
        $precio_15_porcentaje_clp = number_format($precio_15_porcentaje, 0, ',', '.');
        ?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Reserva</title>
    <link rel="stylesheet" href="../assets/css/landing.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script
        src="https://www.paypal.com/sdk/js?client-id=ARPOFtWdnhuV3YwzncncSwHL7vXVXBVqLU3iFbrQ4O5cWqkPDM2JMqWRLEL7PbMh5S12Lw2EiZw9igzx&currency=USD">
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

<body>
    <div class="zona3 d-flex justify-content-center">
        <div class="container">
            <h1 class="title-custom3 text-center">Pagar Reserva</h1>
            <div class="row">
                <div class="row d-flex justify-content-center">
                    <div class="card col-8 mt-5">
                        <div class="card-body">
                            <h1>Datos de Reserva</h1>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <div class="mb-4">
                                        <p><strong class="p-custom4">Nombre del Cliente: </strong>
                                            <?php echo $fila_reserva['nombre_cliente']; ?></p>
                                    </div>
                                    <div class="mb-4">
                                        <p><strong class="p-custom4">Teléfono: </strong>
                                            <?php echo $fila_reserva['telefono']; ?></p>
                                    </div>
                                    <div class="mb-4">
                                        <p><strong class="p-custom4">Correo: </strong>
                                            <?php echo $fila_reserva['correo']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="mb-4">
                                        <p><strong class="p-custom4">Tatuador: </strong> <?php echo $nombre_tatuador; ?>
                                        </p>
                                    </div>
                                    <div class="mb-4">
                                        <p><strong class="p-custom4">Fecha de la Reserva: </strong>
                                            <?php echo $fecha_reserva; ?></p>
                                    </div>
                                    <div class="mb-4">
                                        <p><strong class="p-custom4">Total Reserva (15%): </strong>
                                            $<?php echo $precio_15_porcentaje_clp; ?></p>
                                    </div>
                                    <div class="mb-4">

                                    </div>
                                    <div class="mt-3">
                                        <p class="p-custom4">Realizar pago</p>
                                        <div id="paypal-button-container"></div>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>



                </p>
            </div>
        </div>
    </div>
    </div>
</body>


<script>
function clpToUsd(clpAmount) {
    // Eliminar los puntos del formato CLP
    clpAmount = clpAmount.replace(/\./g, '');
    // Convertir a número
    clpAmount = parseFloat(clpAmount);
    // Aquí realizar la conversión real de CLP a USD
    // Por ahora, supongamos que 1 CLP equivale a 0.0014 USD
    return clpAmount * 0.0011;
}

// Valor en CLP
var precio_15_porcentaje_clp = '<?php echo $precio_15_porcentaje_clp; ?>';

// Convertir a USD
var precio_15_porcentaje_usd = clpToUsd(precio_15_porcentaje_clp);


console.log("Monto en CLP:", precio_15_porcentaje_clp);
console.log("Monto en USD:", precio_15_porcentaje_usd);

paypal.Buttons({

    // Sets up the transaction when a payment button is clicked

    createOrder: (data, actions) => {

        return actions.order.create({

            purchase_units: [{

                amount: {

                    value: precio_15_porcentaje_usd.toFixed(
                        2) // Can also reference a variable or function

                }

            }]

        });

    },

    // Finalize the transaction after payer approval

    onApprove: (data, actions) => {
    return actions.order.capture().then(function(orderData) {
        // La transacción se realizó con éxito
        alert(`Transacción exitosa.`);
        // Redirigir a actualizar_estado.php con el ID de la reserva
        window.location.href = `actualizar_estado.php?id=<?php echo $reserva_id; ?>`;
    });
}

}).render('#paypal-button-container');
</script>

</html>
<?php
    } else {
        // Si no se encontró ninguna reserva con el ID proporcionado, mostrar un mensaje de error
        echo "No se encontró ninguna reserva con el ID proporcionado.";
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
} else {
    // Si no se proporcionó un ID de reserva en la URL, redireccionar a alguna otra página
    header("Location: index.php");
    exit();
}
?>