<?php
// Verificar si se ha enviado el ID del usuario a eliminar
if(isset($_POST['id_usuario'])) {
    // Incluir el archivo de conexión a la base de datos
    include '../conexion.php';

    // Obtener el ID del usuario a eliminar
    $id_usuario = $_POST['id_usuario'];

    // Eliminar los registros relacionados en la tabla citas
    $sql_citas = "DELETE FROM citas WHERE usuario_id = ?";
    $stmt_citas = $conexion->prepare($sql_citas);
    $stmt_citas->bind_param("i", $id_usuario);
    $stmt_citas->execute();
    $stmt_citas->close();

    // Eliminar los registros relacionados en la tabla horarios_disponibles
    $sql_horarios = "DELETE FROM horarios_disponibles WHERE usuario_id = ?";
    $stmt_horarios = $conexion->prepare($sql_horarios);
    $stmt_horarios->bind_param("i", $id_usuario);
    $stmt_horarios->execute();
    $stmt_horarios->close();

    // Eliminar los registros relacionados en la tabla portafolio
    $sql_portafolio = "DELETE FROM portafolio WHERE usuario_id = ?";
    $stmt_portafolio = $conexion->prepare($sql_portafolio);
    $stmt_portafolio->bind_param("i", $id_usuario);
    $stmt_portafolio->execute();
    $stmt_portafolio->close();

    // Eliminar al tatuador de la tabla tatuadores
    $sql_tatuador = "DELETE FROM tatuadores WHERE usuario_id = ?";
    $stmt_tatuador = $conexion->prepare($sql_tatuador);
    $stmt_tatuador->bind_param("i", $id_usuario);
    $stmt_tatuador->execute();
    $stmt_tatuador->close();

    // Eliminar al usuario de la tabla usuarios
    $sql_usuario = "DELETE FROM usuarios WHERE id = ?";
    $stmt_usuario = $conexion->prepare($sql_usuario);
    $stmt_usuario->bind_param("i", $id_usuario);
    $stmt_usuario->execute();
    $stmt_usuario->close();

    // Cerrar la conexión a la base de datos
    $conexion->close();

    // Redireccionar de vuelta a la página panel_trabajadores.php después de eliminar
    header("Location: panel_agregartrabajador.php");
    exit();
} else {
    // Si no se ha enviado el ID del usuario a eliminar, redireccionar a la página principal
    header("Location: ../index.php");
    exit();
}
?>
