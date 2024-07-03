<?php
session_start();

require '../vendor/autoload.php';

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
    $alto = $_POST['alto'];
    $ancho = $_POST['ancho'];
    $color = $_POST['color'];
    $cotizacion = $_POST['cotizacion'];
    $comision = $_POST['comision'];
    $precio_total = $_POST['precio_total'];
    $hora_disponible_id = $_POST['hora']; // ID de la hora seleccionada
    
    // Directorio donde se guardará la imagen de referencia
    $directorio_destino = '../referencias/'; // Ruta del directorio donde deseas guardar las imágenes
    
    // Mover la imagen de referencia al directorio de destino
    if(move_uploaded_file($_FILES['imagen_referencia']['tmp_name'], $directorio_destino . $imagen_referencia)) {
        // Insertar los datos en la tabla citas
        $sql_insertar_cita = "INSERT INTO citas (cliente_id, usuario_id, nombre_cliente, telefono, correo, imagen_referencia,  alto, ancho, color,cotizacion, comision, precio_total, hora_disponible_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Preparar la consulta
        $stmt = mysqli_prepare($conexion, $sql_insertar_cita);
        
        // Vincular los parámetros
        mysqli_stmt_bind_param($stmt, "iissssddsdddi", $cliente_id, $tatuador_id, $nombre_cliente, $telefono, $correo, $imagen_referencia, $alto, $ancho, $color,$cotizacion, $comision, $precio_total,  $hora_disponible_id);
        
        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            // Marcar la hora seleccionada como tomada en la tabla horarios_disponibles
            $sql_actualizar_hora = "UPDATE horarios_disponibles SET estado = 'Tomada' WHERE id = ?";
            $stmt_actualizar_hora = mysqli_prepare($conexion, $sql_actualizar_hora);
            mysqli_stmt_bind_param($stmt_actualizar_hora, "i", $hora_disponible_id);
            if (mysqli_stmt_execute($stmt_actualizar_hora)) {

                // Obtener los detalles de la cita incluyendo el nombre del tatuador y la hora formateada
                $sql_citas = "SELECT citas.*, 
                                tatuadores.nombre AS nombre_tatuador, 
                                DATE_FORMAT(horarios_disponibles.fecha, '%d/%m/%Y') AS fecha_formato,
                                CASE 
                                    WHEN horarios_disponibles.turno = 'am' THEN '09:00 a 14:00'
                                    WHEN horarios_disponibles.turno = 'pm' THEN '16:00 a 21:00'
                                END AS hora_formato,
                                horarios_disponibles.estado AS estado_horario
                            FROM citas
                            INNER JOIN tatuadores ON citas.usuario_id = tatuadores.usuario_id
                            INNER JOIN horarios_disponibles ON citas.hora_disponible_id = horarios_disponibles.id
                            WHERE citas.cliente_id = ?";
                $stmt_citas = mysqli_prepare($conexion, $sql_citas);
                mysqli_stmt_bind_param($stmt_citas, "i", $cliente_id);
                mysqli_stmt_execute($stmt_citas);
                $result = mysqli_stmt_get_result($stmt_citas);
                $detalle_cita = mysqli_fetch_assoc($result);
                
                // Formatear el precio en pesos chilenos
                $precio_formateado = number_format($precio_total, 0, ',', '.');
                $comision_formateada = number_format($precio_total * 0.15, 0, ',', '.');
                
                // Enviar el correo de confirmación
                // Enviar el correo de confirmación
                try {
                    $resend = Resend::client('re_Y4AyptWs_D1YDCdmTmrLfpmwj6Siv6sK5');
                    $resend->emails->send([ 
                        'from' => 'TattoStudioINK<onboarding@resend.dev>',
                        'to' => [$correo],
                        'subject' => 'Hora Tomada para el ' .$detalle_cita['fecha_formato'] . ' con ' . $detalle_cita['nombre_tatuador'] . '',
                        'html' => '<p>Estimado ' . $nombre_cliente . ',</p><p>Tu hora ah sido tomada exitosamente. Aquí están los detalles:</p><ul><li>Tatuador: ' . $detalle_cita['nombre_tatuador'] . '</li>
                        <li>Fecha: ' .$detalle_cita['fecha_formato'] . '</li><li>Precio Total: $' .  $precio_formateado . '</li></ul><p>Recuerda que debes pagar el 15% de tu reserva ($' . $comision_formateada . ') para que la hora quede confirmada.</p>
                        <p>Gracias por confiar en nosotros.</p>'
                        

                    ]);
                } catch (Exception $e) {
                    echo 'Error al enviar el correo: ',  $e->getMessage(), "\n";
                }
                
                // Redireccionar a la página de cuenta
                header("Location: micuenta.php");
            } else {
                echo "Error al reservar la cita: " . mysqli_error($conexion);
            }
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