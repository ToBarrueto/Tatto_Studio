<?php 
session_start();
  if ($_SESSION['tipo_usuario'] == 'cliente')
    {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Tatuador</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<body class="fondo">
<div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand" href="cliente_view.php"><img class="logo" src="../assets/img/logo.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
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
            <a class="nav-link btn" href="../index.php">Cerrar Sesion</a>
          </li>
            </ul>
          </div>
        </nav>
    </div>

        <?php
        // Establecer la conexión con la base de datos
        include '../conexion.php'; 

    // Obtener el ID del tatuador de la URL
    if (isset($_GET['id'])) {
        $tatuador_id = $_GET['id'];

        // Consultar el ID de usuario del tatuador
        $sql_usuario_id = "SELECT usuario_id FROM tatuadores WHERE id = $tatuador_id";
        $resultado_usuario_id = $conexion->query($sql_usuario_id);

        if ($resultado_usuario_id->num_rows > 0) {
            $fila_usuario_id = $resultado_usuario_id->fetch_assoc();
            $usuario_id = $fila_usuario_id['usuario_id'];

            // Consultar los datos del tatuador con el ID especificado
            $sql_tatuador = "SELECT * FROM tatuadores WHERE id = $tatuador_id";
            $resultado_tatuador = $conexion->query($sql_tatuador);

            if ($resultado_tatuador->num_rows > 0) {
                // Mostrar los detalles del tatuador
                $tatuador = $resultado_tatuador->fetch_assoc();

                echo '<div class="card-perfil">';
                echo "<h1>{$tatuador['nombre']}</h2>";
                echo '<img src="' . $tatuador["imagen_perfil"] . '" alt="' . $tatuador["nombre"] . '">';
                echo "<p>Estilos: {$tatuador['estilos']}</p>";
                echo "<p>Sobre mi: {$tatuador['descripcion']}</p>";
                echo '</div>';

                // Consultar el portafolio del tatuador
                $sql_portafolio = "SELECT * FROM portafolio WHERE usuario_id = $usuario_id";
                $resultado_portafolio = $conexion->query($sql_portafolio);

                if ($resultado_portafolio->num_rows > 0) {
                    echo '<div>';
                    echo '<div class="row">';

                    while ($fila_portafolio = $resultado_portafolio->fetch_assoc()) {
                        echo '<div class="col-md-4">';
                        echo '<div class="card" >';
                        echo '<img src="'. $fila_portafolio["ruta_imagen"].'" alt="Imagen de Tatuaje">';
                        echo '</div>';
                        echo '</div>';
                    }

                    echo '</div>';
                    echo '</div>';
                } else {
                    echo 'El tatuador no tiene imágenes en su portafolio.';
                }
            } else {
                echo "Tatuador no encontrado.";
            }
        } else {
            echo "ID de tatuador no válido.";
        }
    } else {
        echo "ID del tatuador no especificado.";
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
} else {
    header("Location:../index.php");
}
?>