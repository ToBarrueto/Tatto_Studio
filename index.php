<?php
session_start();
session_destroy();
include("controllers/validar.php")
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="assets/css/ES.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>


<body class=" bg-black bg-gradient text-primary d-flex justify-content-center align-items-center vh-100">



    <div class="Card">

        <div class="Form-Container">

            <div  class="Cara Login bg-body-secondary bg-opacity-10 p-5 rounded-5 shadow">

                <h1  class="mt-5 text-center fs-1 fw-bold">Login</h1>

                    <form method="post" class="mt-4">

                        <div class="mb-3">

                            <label class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control" name="Nusuario" placeholder="Usuario">

                        </div>
                        
                        <div class="mb-3">

                            <label class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="Pass" placeholder="Contraseña">

                            <div class="d-flex justify-content-around mt-1">

                                <div class="d-flex align-items-center gap-1 m-1">

                                    <input class="form-check-input" type="checkbox" />
                                    <div class="pt-1">Recuerdame</div>

                                </div>

                                <div class="pt-1 m-3">

                                    <a href="#" class="text-decoration-none text-info fw-semibold fst-italic " >Has olvidado tu contraseña?</a>

                                </div>

                            </div>

                            <div class="mt-2 d-flex gap-1 justify-content-center">

                                <div>No tienes una cuenta?</div>
                                <a href='views/registrarse.php' class="text-decoration-none text-info fw-semibold fst-italic" > Registrate</a>

                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary" name="inicioSesion" >Iniciar Sesión</button>

                    </form>
            </div>



           

        </div>    
    </div> 



    <script src="assets/js/script.js"></script>

</body>


</html>