<?php
// Verificar si se proporcionó un ID de reserva en la URL
if (isset($_GET['id'])) {
    $reserva_id = $_GET['id'];

    // Incluir el archivo de conexión a la base de datos
    include '../conexion.php';

    // Definir el nuevo estado
    $nuevo_estado = 'Confirmada';

    // Consulta SQL para actualizar el estado en la tabla horarios_disponibles
    $sql = "UPDATE horarios_disponibles SET estado = '$nuevo_estado' WHERE id = (SELECT hora_disponible_id FROM citas WHERE id = $reserva_id)";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        // Si la actualización fue exitosa, redirigir a la página micuenta.php
        header("Location: micuenta.php");
        exit();
    } else {
        // Si hubo un error al ejecutar la consulta, mostrar un mensaje de error
        echo "Hubo un problema al actualizar el estado de la reserva: " . $conexion->error;
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
} else {
    // Si no se proporcionó un ID de reserva en la URL, redirigir a alguna otra página
    header("Location: index.php");
    exit();
}
?>