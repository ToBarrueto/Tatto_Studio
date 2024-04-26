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
  <title>Studio de Tatuajes - Clientes</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body class="fondo">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="#"><img class="logo" src="../assets/img/logo.png" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
          <a class="nav-link btn" href="micuenta.php">Mis Reservas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn" href="../index.php">Cerrar Sesion</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>


  <div id="textCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="carousel-text">
          <h5>Cotiza y Agenda tu Hora</h5>
          <p>En InkStudio Connect, hacemos que el proceso de reserva y cotizacion sea rápido, fácil y conveniente.</p>
          <button class="btn-carusel">Leer mas</button>
        </div>
      </div>
      <div class="carousel-item">
        <div class="carousel-text">
          <h5>Tatuadores Profesionales</h5>
          <p>Nuestros artistas son más que simplemente tatuadores; son expertos en transformar ideas en obras de arte
            duraderas en la piel.</p>
          <a href="tatuadores_view.php"><button class="btn-carusel">Ver Tatuadores</button></a>
        </div>
      </div>
      <div class="carousel-item">
        <div class="carousel-text">
          <h5>Perforistas</h5>
          <p>Nuestros perforistas de piercings son expertos en su oficio, utilizando técnicas precisas y herramientas de
            la más alta calidad para garantizar perforaciones limpias y seguras.</p>
          <button class="btn-carusel">Ver perforistas</button>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#textCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#textCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

</body>

<footer class="bg-dark text-white  fixed-bottom">
  <div class="text-center py-3 fondo">
    <p class="mb-0">&copy; 2024 TattoStudioINK</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
  integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</html>

<?php }
  else{
    header("Location:../index.php");
  }?>