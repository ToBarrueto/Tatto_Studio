<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Verificar si se ha proporcionado un ID de horario a eliminar
    if (isset($_GET['id'])) {
        // Obtener el ID del horario a eliminar
        $horario_id = $_GET['id'];

        // Incluir el archivo de conexión a la base de datos
        include '../conexion.php';

        // Consulta SQL para eliminar el horario
        $sql_eliminar = "DELETE FROM horarios_disponibles WHERE id = ?";
        
        // Preparar la declaración
        $stmt = mysqli_prepare($conexion, $sql_eliminar);
        mysqli_stmt_bind_param($stmt, "i", $horario_id);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            // Redirigir a la página de agenda con un mensaje de éxito
            header("Location: panel_agenda.php?mensaje=Horario eliminado exitosamente.");
            exit();
        } else {
            echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
        }

        // Cerrar la conexión a la base de datos
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
    } else {
        // Si no se proporcionó un ID de horario, redirigir a la página de agenda
        header("Location: panel_agenda.php");
        exit();
    }
} else {
    echo "Acceso no permitido.";
}
?>