<?php
session_start();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha seleccionado un archivo
    if (isset($_FILES["imagen_perfil"]) && $_FILES["imagen_perfil"]["error"] == UPLOAD_ERR_OK) {
        // Directorio de almacenamiento de las imágenes de perfil
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
            // Obtener otros datos del formulario
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $estilos = $_POST["estilos"];
            $usuario_id = $_POST["usuario_id"];
            $tipo_usuario = $_POST["tipo_usuario"];

            // Conectar a la base de datos (asegúrate de incluir tu archivo de conexión)
            include '../conexion.php';

            // Insertar el nuevo usuario en la tabla correspondiente según el tipo de usuario
            if ($tipo_usuario == 'tatuador') {
                $sql_insertar = "INSERT INTO tatuadores (usuario_id, nombre, descripcion, imagen_perfil, estilos) 
                                 VALUES (?, ?, ?, ?, ?)";
            } elseif ($tipo_usuario == 'perforador') {
                $sql_insertar = "INSERT INTO perforadores (usuario_id, nombre, descripcion, imagen_perfil, estilos) 
                                 VALUES (?, ?, ?, ?, ?)";
            }

            // Preparar la consulta SQL
            $stmt = mysqli_prepare($conexion, $sql_insertar);
            mysqli_stmt_bind_param($stmt, "issss", $usuario_id, $nombre, $descripcion, $ruta_archivo, $estilos);

            // Ejecutar la consulta
            if (mysqli_stmt_execute($stmt)) {
                // Redirigir a la página de creación de usuario con éxito
                header("Location: panel_agregartrabajador.php?mensaje=Usuario agregado exitosamente.");
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