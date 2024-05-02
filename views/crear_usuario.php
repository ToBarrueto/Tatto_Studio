<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Preparar la consulta para insertar el nuevo usuario
    $sql_insertar_usuario = "INSERT INTO usuarios (username, password, tipo_usuario) VALUES ('$username', '$password', '$tipo_usuario')";

    // Ejecutar la consulta
    if ($conexion->query($sql_insertar_usuario) === TRUE) {
        // Redirigir a la página panel_crearusuario.php
        header("Location: panel_crearusuario.php");
        exit(); // ¡Importante! Asegúrate de salir del script después de la redirección
    } else {
        echo "Error al agregar usuario: " . $conexion->error;
    }
} else {
    // Redireccionar si se intenta acceder directamente a este script
    header("Location: panel_admin.php");
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>