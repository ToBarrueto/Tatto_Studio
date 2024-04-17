<?php 
session_start();
  if ($_SESSION['tipo_usuario'] == 'admin')
    {

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="fondo">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
          
      
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
            </ul>

            <a href="../index.php">Cerrar Sesion</a>

          </div>
        </nav>

        <h1 class="h1-custom">Panel admin</h1>
        
        
    </div>
</body>
</html>

<?php }
  else{
    header("Location:../index.php");
  }?>