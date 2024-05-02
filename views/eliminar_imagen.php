<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_imagen"])) {
    // Obtener el ID de la imagen a eliminar
    $id_imagen = $_POST["id_imagen"];

    // Conectar a la base de datos
    include '../conexion.php';

    // Consulta para obtener la ruta de la imagen
    $consulta = "SELECT ruta_imagen FROM portafolio WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "i", $id_imagen);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    // Verificar si se encontró la imagen
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $ruta_imagen = $fila['ruta_imagen'];

        // Eliminar la imagen de la base de datos
        $consulta_eliminar = "DELETE FROM portafolio WHERE id = ?";
        $stmt_eliminar = mysqli_prepare($conexion, $consulta_eliminar);
        mysqli_stmt_bind_param($stmt_eliminar, "i", $id_imagen);
        if (mysqli_stmt_execute($stmt_eliminar)) {
            // Eliminar la imagen del sistema de archivos
            if (unlink($ruta_imagen)) {
                // Redirigir de vuelta al panel de portafolio
                header("Location: panel_portafolio.php");
                exit();
            } else {
                echo "Error al eliminar la imagen del sistema de archivos.";
            }
        } else {
            echo "Error al eliminar la imagen de la base de datos.";
        }
    } else {
        echo "No se encontró la imagen a eliminar.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Solicitud no válida.";
}
?>