<?php
session_start();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha seleccionado un archivo
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {
        // Directorio de almacenamiento de las imágenes
        $directorio_destino = "../uploads/";

        // Obtener información del archivo cargado
        $nombre_archivo = basename($_FILES["imagen"]["name"]);
        $ruta_archivo = $directorio_destino . $nombre_archivo;

        // Validar el tipo de archivo (opcional)
        $tipo_archivo = strtolower(pathinfo($ruta_archivo, PATHINFO_EXTENSION));
        if ($tipo_archivo != "jpg" && $tipo_archivo != "jpeg" && $tipo_archivo != "png" && $tipo_archivo != "gif") {
            echo "Solo se permiten archivos JPG, JPEG, PNG o GIF.";
            exit();
        }

        // Mover el archivo cargado al directorio de destino
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_archivo)) {
            // Obtener la descripción de la imagen del formulario
            $descripcion = $_POST["descripcion"];

            $usuario_id = $_SESSION['usuario_id'];

            // Conectar a la base de datos (asegúrate de incluir tu archivo de conexión)
            include '../conexion.php';

            // Preparar la consulta SQL para insertar en la tabla "portafolio"
            $consulta = "INSERT INTO portafolio (usuario_id, ruta_imagen, descripcion) 
                         VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conexion, $consulta);
            mysqli_stmt_bind_param($stmt, "iss", $usuario_id, $ruta_archivo, $descripcion);

            // Ejecutar la consulta
            if (mysqli_stmt_execute($stmt)) {
                // Redirigir a la página de perfil del tatuador
                header("Location: panel_portafolio.php");
                exit();
            } else {
                echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
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