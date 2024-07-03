<?php
session_start();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha seleccionado un archivo
    if (isset($_FILES["imagen_perfil"]) && $_FILES["imagen_perfil"]["error"] == UPLOAD_ERR_OK) {
        // Directorio de almacenamiento de las imágenes
        $directorio_destino = "../assets/img/";

        // Obtener información del archivo cargado
        $nombre_archivo = basename($_FILES["imagen_perfil"]["name"]);
        $ruta_archivo = $directorio_destino . $nombre_archivo;

        // Validar el tipo de archivo (opcional)
        $tipo_archivo = strtolower(pathinfo($ruta_archivo, PATHINFO_EXTENSION));
        if ($tipo_archivo != "jpg" && $tipo_archivo != "jpeg" && $tipo_archivo != "png" && $tipo_archivo != "gif") {
            echo "Solo se permiten archivos JPG, JPEG, PNG o GIF.";
            exit();
        }

        // Mover el archivo cargado al directorio de destino
        if (move_uploaded_file($_FILES["imagen_perfil"]["tmp_name"], $ruta_archivo)) {
            // Obtener los demás datos del formulario
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $estilos = $_POST["estilos"];
            $precioBase = $_POST["precioBase"];

            $usuario_id = $_SESSION['usuario_id'];

            // Conectar a la base de datos (asegúrate de incluir tu archivo de conexión)
            include '../conexion.php';

            // Actualizar la foto de perfil del tatuador en la base de datos
            $actualizar = mysqli_query($conexion, "UPDATE tatuadores SET nombre='$nombre', descripcion='$descripcion', estilos='$estilos', precioBase='$precioBase', imagen_perfil='$ruta_archivo' WHERE usuario_id='$usuario_id'");

            if ($actualizar) {
                // Redirigir a la página de perfil del tatuador
                header("Location: panel_perfil.php");
                exit();
            } else {
                echo "Error al actualizar la foto de perfil.";
            }

            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);
        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        echo "No se ha seleccionado ningún archivo.";
    }
} else {
    echo "Acceso no permitido.";
}
?>