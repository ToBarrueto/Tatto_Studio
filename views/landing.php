<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>
    <link rel="stylesheet" href="../assets/css/landing.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


</head>

<body>

    <header>
        <a href="#" class="logo">TattoStudioINK</a>
        <nav>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Nosotros</a></li>
                <li><a href="#">Servicios</a></li>
                <li><a href="#">Tatuadores</a></li>
                <li>
                    <a href="#">Mi Cuenta &#x25BE;</a>
                    <ul class="dropdown">
                        <li><a href="#">Mis Datos</a></li>
                        <li><a href="#">Mis Reservas</a></li>
                        <li><a href="#">Cerrar Sesion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>


    <div class="zona1 d-flex justify-content-center ">
        <div class="container text-center ">
            <div class="row">
                <div class="col">
                    <h1 class="title">TattoStudioINK</h1>
                    <p class="p-custom">
                        "Nacemos desde el amor a la tinta, al arte y todos sus variantes, para poder regarlo por toda Santiago
                        en general. Entregando trabajos de calidad y que perduren en el tiempo, nuestra pasión por la expresión
                        artística nos impulsa a explorar nuevas formas, a innovar y a dejar una huella duradera en cada proyecto
                        que emprendemos. Nos comprometemos a cultivar la creatividad, a inspirar a otros y a enriquecer el mundo
                        que nos rodea con nuestras creaciones."</p>
                  </div>
                  
                  
            </div>
        </div>
    </div>

        <div>
            <h3>Sobre nosotros</h3>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"></script>

        <script type="text/javascript">
            window.addEventListener("scroll", function () {
                var header = document.querySelector("header");
                header.classList.toggle("abajo", window.scrollY > 0);
            })
        </script>
</body>

</html>