<?php
session_start();
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar que el nombre de usuario no esté en uso
    $sql_verificar = "SELECT id FROM usuarios WHERE username = ?";
    $stmt_verificar = mysqli_prepare($conexion, $sql_verificar);
    mysqli_stmt_bind_param($stmt_verificar, "s", $username);
    mysqli_stmt_execute($stmt_verificar);
    mysqli_stmt_store_result($stmt_verificar);
    if (mysqli_stmt_num_rows($stmt_verificar) > 0) {
        echo "El nombre de usuario ya está en uso.";
    } else {
        // Insertar el nuevo usuario como cliente
        $tipo_usuario = "cliente";
        $sql_insertar = "INSERT INTO usuarios (username, password, tipo_usuario) VALUES (?, ?, ?)";
        $stmt_insertar = mysqli_prepare($conexion, $sql_insertar);
        mysqli_stmt_bind_param($stmt_insertar, "sss", $username, $password, $tipo_usuario);
        if (mysqli_stmt_execute($stmt_insertar)) {
            $_SESSION['registro_exitoso'] = true;
            header("Location: index.php");
            exit;
        } else {
            echo "ERROR: No se pudo ejecutar la consulta. " . mysqli_error($conexion);
        }
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
