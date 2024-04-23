<?php
session_start();

// Verificar si se han recibido los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cliente_id"])) {
    // Incluir la conexión a la base de datos
    include '../conexion.php'; // Asegúrate de incluir el archivo de conexión correcto
    
    // Recuperar los datos del formulario
    $cliente_id = $_POST['cliente_id'];
    $tatuador_id = $_POST['tatuador_id'];
    $nombre_cliente = $_POST['nombre_cliente'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $imagen_referencia = $_FILES['imagen_referencia']['name']; // Nombre del archivo de imagen
    $zona = $_POST['zona'];
    $alto = $_POST['alto'];
    $ancho = $_POST['ancho'];
    $color = $_POST['color'];
    $cantidad_sesiones = $_POST['cantidad_sesiones'];
    $hora_disponible_id = $_POST['hora']; // ID de la hora seleccionada
    
    // Directorio donde se guardará la imagen de referencia
    $directorio_destino = '../referencias/'; // Ruta del directorio donde deseas guardar las imágenes
    
    // Mover la imagen de referencia al directorio de destino
    if(move_uploaded_file($_FILES['imagen_referencia']['tmp_name'], $directorio_destino . $imagen_referencia)) {
        // Insertar los datos en la tabla citas
        $sql_insertar_cita = "INSERT INTO citas (cliente_id, tatuador_id, nombre_cliente, telefono, correo, imagen_referencia, zona, alto, ancho, color, cantidad_sesiones, hora_disponible_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Preparar la consulta
        $stmt = mysqli_prepare($conexion, $sql_insertar_cita);
        
        // Vincular los parámetros
        mysqli_stmt_bind_param($stmt, "iisssssddssi", $cliente_id, $tatuador_id, $nombre_cliente, $telefono, $correo, $imagen_referencia, $zona, $alto, $ancho, $color, $cantidad_sesiones, $hora_disponible_id);
        
        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            echo "Cita reservada con éxito.";
        } else {
            echo "Error al reservar la cita: " . mysqli_error($conexion);
        }
        
        // Cerrar la consulta
        mysqli_stmt_close($stmt);
    } else {
        echo "Error al subir la imagen de referencia.";
    }
    
    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Solicitud no válida.";
}
?>
