<?php
// Datos de conexión a la base de datos
$host = "localhost"; // Cambia esto si tu servidor de base de datos no está en localhost
$usuario = "root"; // Cambia esto si has configurado un usuario diferente
$contrasena = ""; // Cambia esto si has configurado una contraseña diferente
$base_de_datos = "tattoo_studio"; // Nombre de la base de datos que creaste

// Crear conexión
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error al conectar con la base de datos: " . $conexion->connect_error);
}
?>