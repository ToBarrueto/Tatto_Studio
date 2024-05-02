<?php
session_start();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $fecha = $_POST["fecha"];
    $turno = $_POST["turno"];

    // Verificar si la sesión está iniciada y obtener el ID del usuario
    if (isset($_SESSION['usuario_id'])) {
        // Incluir el archivo de conexión a la base de datos
        include '../conexion.php';

        // Obtener el ID del usuario de la sesión
        $usuario_id = $_SESSION['usuario_id'];

        // Preparar la consulta SQL para insertar un nuevo horario
        $sql_insertar = "INSERT INTO horarios_disponibles (usuario_id, fecha, turno) VALUES (?, ?, ?)";
    
        // Preparar la declaración
        $stmt = mysqli_prepare($conexion, $sql_insertar);
        mysqli_stmt_bind_param($stmt, "iss", $usuario_id, $fecha, $turno,);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            // Redirigir a la página de configuración de horarios con éxito
            header("Location: panel_agenda.php?mensaje=Horario agregado exitosamente.");
            exit();
        } else {
            echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
    } else {
        // Si la sesión no está iniciada, redirigir al usuario a iniciar sesión
        header("Location: ../index.php");
        exit();
    }
} else {
    echo "Acceso no permitido.";
}
?>