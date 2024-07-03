<?php
session_start();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el usuario tiene sesión iniciada
    if (isset($_SESSION['usuario_id'])) {
        // Obtener el ID del horario a editar desde el formulario
        $id = $_POST['id'];

        // Obtener el nuevo estado del horario desde el formulario
        $nuevo_estado = $_POST['estado'];

        // Incluir el archivo de conexión a la base de datos
        include '../conexion.php';

        // Consulta SQL para actualizar el estado del horario
        $sql_actualizar = "UPDATE horarios_disponibles SET estado = ? WHERE id = ?";
        $stmt = mysqli_prepare($conexion, $sql_actualizar);
        mysqli_stmt_bind_param($stmt, "si", $nuevo_estado, $id);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            // Redirigir de vuelta a la página de la agenda con un mensaje de éxito
            header("Location: panel_agenda.php?mensaje=El horario se actualizó correctamente.");
            exit();
        } else {
            // Si hay un error al ejecutar la consulta, mostrar un mensaje de error
            echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
        }

        // Cerrar la conexión y liberar los recursos
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
    } else {
        // Si el usuario no tiene sesión iniciada, redirigir al inicio de sesión
        header("Location: ../index.php");
        exit();
    }
} else {
    // Si se intenta acceder al script directamente sin enviar datos por POST, redirigir al inicio
    header("Location: ../index.php");
    exit();
}
?>