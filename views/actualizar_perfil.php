<?php
session_start();

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si la sesión está iniciada y obtener el ID del usuario
    if (isset($_SESSION['usuario_id'])) {
        // Incluir el archivo de conexión a la base de datos
        include '../conexion.php';

        // Obtener el ID del usuario de la sesión
        $usuario_id = $_SESSION['usuario_id'];

        // Obtener los datos enviados por el formulario
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
        $estilos = mysqli_real_escape_string($conexion, $_POST['estilos']);

        // Actualizar los datos del tatuador en la base de datos
        $actualizar = mysqli_query($conexion, "UPDATE tatuadores SET nombre='$nombre', descripcion='$descripcion', estilos='$estilos' WHERE usuario_id='$usuario_id'");

        if ($actualizar) {
            // Redirigir al usuario de vuelta a su perfil con un mensaje de éxito
            header("Location: panel_perfil.php?exito=1");
            exit();
        } else {
            // Si la actualización falla, mostrar un mensaje de error
            echo "Error al actualizar los datos del tatuador.";
        }
    } else {
        // Si no hay sesión iniciada, redirigir al usuario a la página de inicio de sesión
        header("Location: ../index.php");
        exit();
    }
} else {
    // Si el formulario no ha sido enviado, redirigir al usuario a la página de inicio de sesión
    header("Location: ../index.php");
    exit();
}
?>