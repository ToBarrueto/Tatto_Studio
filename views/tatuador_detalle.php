<?php 
session_start();
if ($_SESSION['tipo_usuario'] == 'cliente') {
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Tatuador</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>
<body class="fondo">
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="cliente_view.php"><img class="logo" src="../assets/img/logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn" href="#">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn" href="tatuadores_view.php">Tatuadores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn" href="#">Perforadores</a>
                </li>
                <li class="nav-item">
            <a class="nav-link btn" href="#">Mi Cuenta</a>
          </li>
                <li class="nav-item">
                    <a class="nav-link btn" href="../index.php">Cerrar Sesion</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<?php
include '../conexion.php'; 

if (isset($_GET['id'])) {
    $tatuador_id = $_GET['id'];

    $sql_usuario_id = "SELECT usuario_id FROM tatuadores WHERE id = $tatuador_id";
    $resultado_usuario_id = $conexion->query($sql_usuario_id);

    if ($resultado_usuario_id->num_rows > 0) {
        $fila_usuario_id = $resultado_usuario_id->fetch_assoc();
        $usuario_id = $fila_usuario_id['usuario_id'];

        $sql_tatuador = "SELECT * FROM tatuadores WHERE id = $tatuador_id";
        $resultado_tatuador = $conexion->query($sql_tatuador);

        if ($resultado_tatuador->num_rows > 0) {
            $tatuador = $resultado_tatuador->fetch_assoc();

            // Mostrar el portafolio del tatuador
            $sql_portafolio = "SELECT * FROM portafolio WHERE usuario_id = $usuario_id";
            $resultado_portafolio = $conexion->query($sql_portafolio);

            if ($resultado_portafolio->num_rows > 0) {
                echo '<h1 class="h1-custom">Portafolio</h1>';
                echo '<div class="portafolio">';
                while ($fila_portafolio = $resultado_portafolio->fetch_assoc()) {
                    echo '<div class="card">';
                    echo '<img src="'. $fila_portafolio["ruta_imagen"].'" alt="Imagen de Tatuaje">';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo 'El tatuador no tiene imágenes en su portafolio.';
            }

            echo '<h1 class="h1-custom mb-4">Haz tu reserva</h1>';
            
            echo '<div class="row">';
            echo '<div class="card col-3 ms-4">';
            echo "<h1>{$tatuador['nombre']}</h2>";
            echo '<img src="' . $tatuador["imagen_perfil"] . '" alt="' . $tatuador["nombre"] . '">';
            echo "<p>Estilos: {$tatuador['estilos']}</p>";
            echo "<p>Sobre mi: {$tatuador['descripcion']}</p>";
            echo '</div>';

             // Formulario de reserva de citas
           
echo '<div class="card col-8 ms-5">';
echo '<div class="card-body">';
echo '<h2>Reservar Cita</h2>';
echo '<form action="procesar_reserva.php" method="POST" enctype="multipart/form-data">';
echo '<input type="hidden" name="tatuador_id" value="' . $tatuador_id . '">';

// Campo de ID de cliente
echo '<input type="hidden" name="cliente_id" value="' . $_SESSION['usuario_id'] . '">';

// Campos adicionales
echo '<div class="row">';
echo '<div class="col-md-6">';
echo '<div class="mb-3">';
echo '<label for="nombre_cliente" class="form-label">Nombre Completo:</label>';
echo '<input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" required>';
echo '</div>';

echo '<div class="mb-3">';
echo '<label for="telefono" class="form-label">Número de Celular:</label>';
echo '<input type="tel" class="form-control" id="telefono" name="telefono" required>';
echo '</div>';

echo '<div class="mb-3">';
echo '<label for="correo" class="form-label">Correo Electrónico:</label>';
echo '<input type="email" class="form-control" id="correo" name="correo" required>';
echo '</div>';

echo '<div class="mb-3">';
echo '<label for="imagen_referencia" class="form-label">Imagen de Referencia:</label>';
echo '<input type="file" class="form-control" id="imagen_referencia" name="imagen_referencia">';
echo '</div>';
echo '</div>';

echo '<div class="col-md-6">';
echo '<div class="mb-3">';
echo '<label for="alto" class="form-label">Alto del Tatuaje (cm):</label>';
echo '<input type="number" class="form-control" id="alto" name="alto" required>';
echo '</div>';

echo '<div class="mb-3">';
echo '<label for="ancho" class="form-label">Ancho del Tatuaje (cm):</label>';
echo '<input type="number" class="form-control" id="ancho" name="ancho" required>';
echo '</div>';

echo '<div class="mb-3">';
echo '<label for="color" class="form-label">Color:</label>';
echo '<select class="form-select" id="color" name="color">';
echo '<option value="si">Con color</option>';
echo '<option value="no">Sin color</option>';
echo '</select>';
echo '</div>';

echo '<div class="mb-3">';
echo '<label for="zona" class="form-label">Zona:</label>';
echo '<select class="form-select" id="zona" name="zona">';
echo '<option value="Tronco-Espalda">Tronco-Espalda</option>';
echo '<option value="Cuello">Cuello</option>';
echo '<option value="Brazos-Manos">Brazos-Manos</option>';
echo '<option value="Piernas">Piernas</option>';
echo '<option value="Cara-Cabeza">Cara-Cabeza</option>';
echo '</select>';
echo '</div>';

echo '<div class="mb-3">';
echo '<label for="cantidad_sesiones" class="form-label">Cantidad de Sesiones:</label>';
echo '<input type="number" class="form-control" id="cantidad_sesiones" name="cantidad_sesiones" min="1" max="5" required>';
echo '</div>';

echo '<div class="mb-3">';
echo '<label for="cotizacion" class="form-label">Cotización:</label>';
echo '<span id="cotizacion_aproximada"></span>';
echo '</div>';
echo '</div>';


echo '</div>';
echo '</div>';

// Selección de hora disponible
echo '<div class="mb-3">';
echo '<label for="hora" class="form-label">Seleccionar Hora Disponible:</label>';
echo '<select class="form-select" id="hora" name="hora" required>';
echo '</div>';

setlocale(LC_TIME, 'es_ES.UTF-8');

// Consulta para obtener las horas disponibles
$sql_horas_disponibles = "SELECT * FROM horarios_disponibles WHERE usuario_id = $usuario_id AND estado = 'Disponible'";
$resultado_horas_disponibles = $conexion->query($sql_horas_disponibles);

if ($resultado_horas_disponibles->num_rows > 0) {
    while ($fila_hora = $resultado_horas_disponibles->fetch_assoc()) {
        // Formatear la fecha en el formato deseado en español
        $fecha_formateada = strftime('%d-%B-%Y', strtotime($fila_hora['fecha']));

        // Convertir el valor del turno a "Mañana" o "Tarde"
        $turno_texto = ($fila_hora['turno'] == 'am') ? 'Mañana' : 'Tarde';

        echo "<option value='{$fila_hora['id']}'>$fecha_formateada - $turno_texto</option>";
    }
} else {
    echo '<option value="" disabled>No hay horas disponibles</option>';
}

echo '</select>';
echo '</div>';

echo '<button type="submit" class="btn btn-primary">Reservar cita</button>';
echo '</form>';
echo '</div>';
echo '</div>';
echo '</div>';

            
        } else {
            echo "Tatuador no encontrado.";
        }
    } else {
        echo "ID de tatuador no válido.";
    }
} else {
    echo "ID del tatuador no especificado.";
}

$conexion->close();
} else {
    header("Location:../index.php");
}
?>
</body>

<footer class="bg-dark text-white mt-3">
  <div class="text-center py-3 fondo">
    <p class="mb-0">&copy; 2024 TattoStudioINK</p>
  </div>
</footer>

</html>