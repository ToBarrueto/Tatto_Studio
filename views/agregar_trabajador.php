<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    include '../conexion.php';

    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $estilos = $_POST['estilos'];
    $imagen_perfil = $_FILES['imagen_perfil']['name'];
    $usuario_id = $_POST['usuario_id'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Ruta donde se guardarán las imágenes de perfil
    $ruta_imagen_perfil = "../assets/img/" . basename($imagen_perfil);

    // Mover la imagen de perfil a la carpeta de destino
    move_uploaded_file($_FILES['imagen_perfil']['tmp_name'], $ruta_imagen_perfil);

    // Insertar el nuevo usuario en la tabla correspondiente según el tipo de usuario
    if ($tipo_usuario == 'tatuador') {
        $sql_insertar = "INSERT INTO tatuadores (usuario_id, nombre, descripcion, imagen_perfil, estilos) VALUES ('$usuario_id', '$nombre', '$descripcion', '$ruta_imagen_perfil', '$estilos')";
    } elseif ($tipo_usuario == 'perforador') {
        // Insertar en la tabla de perforadores
        $sql_insertar = "INSERT INTO perforadores (usuario_id, nombre, descripcion, imagen_perfil, estilos) VALUES ('$usuario_id', '$nombre', '$descripcion', '$ruta_imagen_perfil', '$estilos')";
    }

    // Ejecutar la consulta de inserción
    if ($conexion->query($sql_insertar) === TRUE) {
        // Redireccionar a la página de creación de usuario con éxito
        header("Location: panel_trabajadores.php?mensaje=Usuario agregado exitosamente.");
    } else {
        // Mostrar mensaje de error si la consulta falla
        echo "Error al agregar usuario: " . $conexion->error;
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
} else {
    // Si no se ha enviado el formulario, redireccionar a la página de creación de usuario
    header("Location: panel_crearusuario.php");
}
?>