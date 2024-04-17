<?php 
session_start();
  if ($_SESSION['tipo_usuario'] == 'tatuador')
    {

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Tatuador</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="fondo">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
          
      
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
            </ul>
            <form class="d-flex">
              <a href="../index.php">Cerrar Sesion</a>
            </form>
          </div>
        </nav>

        <h1 class="h1-custom">Reservas Pendientes</h1>
        <div class="reservas">
            <!-- Aquí se mostrarán las reservas pendientes del tatuador -->
        </div>

        <h1 class="h1-custom">Editar Perfil</h1>
        <div class="perfil">
            <!-- Aquí se mostrará y permitirá editar la información del perfil del tatuador -->
        </div>

        <h1 class="h1-custom">Portafolio</h1>
        <div class="portafolio">
        </div>
    </div>
</body>
</html>

<?php }
  else{
    header("Location:../index.php");
  }?>