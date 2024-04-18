<?php 
session_start();
if ($_SESSION['tipo_usuario'] == 'cliente') {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Tatuador</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .card-perfil {
            text-align: center;
            margin-bottom: 20px;
        }
        .portafolio {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            margin-top: 5px;
        }
        .portafolio .card {
            width: calc(33.33% - 20px);
        }
        .portafolio .card img {
            max-width: 100%;
            height: auto;
        }
        @media (max-width: 992px) {
            .portafolio .card {
                width: calc(50% - 20px);
            }
        }
        @media (max-width: 768px) {
            .portafolio .card {
                width: calc(50% - 20px);
            }
        }
        @media (max-width: 576px) {
            .portafolio .card {
                width: calc(100% - 20px);
            }
        }
    </style>
</head>
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

            echo '<div class="card-perfil">';
            echo "<h1>{$tatuador['nombre']}</h2>";
            echo '<img src="' . $tatuador["imagen_perfil"] . '" alt="' . $tatuador["nombre"] . '">';
            echo "<p>Estilos: {$tatuador['estilos']}</p>";
            echo "<p>Sobre mi: {$tatuador['descripcion']}</p>";
            echo '</div>';


            ?>
            <?php
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
</html>