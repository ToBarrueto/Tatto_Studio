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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body class="fondo">
<nav class="navbar navbar-expand-lg navbar-light ">
          <a class="navbar-brand mr-auto" href="cliente_view.php">
          <img class="logo" src="../assets/img/logo.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
          </button>
      
          <div class="collapse navbar-collapse justify-content-end " id="navbarSupportedContent">
            <ul class="navbar-nav mg-auto   nav-underline">

              <li class="nav-item">
                <a class="nav-link" href="#">Nosotros</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="tatuadores_view.php">Tatuadores</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Perforadores</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href='micuenta.php'>Mis reservas</a>
              </li>
              <li class="nav-item">
                    <a class="nav-link btn" href="../index.php">Cerrar Sesion</a>
              </li>
              
            </ul>
          </div>
        </nav>



    

  <h1 class="h1-custom ">Tatuadores</h1>

  <div class="card-container m-5 ">
    
  <?php
  // Conexión a la base de datos
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "tattoo_studio";
  
  // Crea la conexión
  $conn = new mysqli($servername, $username, $password, $database);
  
  // Verifica la conexión
  if ($conn->connect_error) {
      die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
  }
  
  /// Realizar la consulta a la base de datos para obtener los datos de los tatuadores
  $sql = "SELECT id,nombre, estilos, imagen_perfil FROM tatuadores";
  $resultado = $conn->query($sql);
  
  // Verificar si se obtuvieron resultados


if ($resultado->num_rows > 0) {
    // Mostrar los datos de los tatuadores
    while ($row = $resultado->fetch_assoc()) {
        echo '<div class="card">';
        echo '<img class="imagen-tatuador" src="' . $row["imagen_perfil"] . '" alt="' . $row["nombre"] . '">';
        echo '<h2>' . $row["nombre"] . '</h2>';
        echo '<p>' . $row["estilos"] . '</p>';
        echo '<a class="btn-ver" href="tatuador_detalle.php?id=' . $row["id"] . '">Ver detalles</a>';
        echo '</div>';
    }
} else {echo "No se encontraron tatuadores.";
}
 
  
  
  // Cierra la conexión a la base de datos
  $conn->close();
  ?>
</div>





<footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-box">
                        <img src="img/logo.png" alt="">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam repellendus sunt praesentium aspernatur iure molestias.</p>
                    <h3></h3>
                    <div class="card-area">
                            <i class=""></i>
                            <i class=""></i>
                            <i class=""></i>
                            <i class=""></i>
                    </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-box">
                        <h2>Contacto</h2>
                    <ul>
                        <li><i class="bi bi-envelope"></i><a href="#">Link.Studio@gmail.com</a></li>
                        <li><i class="bi bi-telephone"></i><a href="#">+5692254885</a></li>
                        <li><i class="bi bi-map-fill"></i><a href="#">DuocUC-San joaquin</a></li>

                    </ul>
                    </div>                    
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-box">
                        <h2>Domain</h2>
                    <ul>
                        <li><a href="#">Web </a></li>
                        <li><a href="#">Cloud</a></li>
                        <li><a href="#">CMS </a></li>
                        <li><a href="#">WordPress</a></li>
                        <li><a href="#">Email</a></li>
                        <li><a href="#">VPS</a></li>
                    </ul>
                    </div>                    
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-box">
                        <h2>Newsletter</h2>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequuntur doloremque earum similique fugiat nobis. Facere?</p>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Enter your Email ..." aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2"><i class="fa fa-long-arrow-right"></i></span>
                        </div>
                        <h2>Redes Sociales</h2>
                        <p class="socials">
                          <i class="bi bi-whatsapp"></i>
                          <i class="bi bi-facebook"></i>
                          <i class="bi bi-linkedin"></i>
                          <i class="bi bi-instagram"></i>
                        </p>
                    </div>
                    
                </div>
                
            </div>
        </div>

        <div class="text-center py-3">
          <p class="mb-0">&copy; 2024 TattoStudioINK</p>
        </div>

  </footer>
</body>

</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</html>

<?php }
  else{
    header("Location:../index.php");
  }?>