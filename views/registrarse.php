
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>



<body  class="bg-black bg-gradient text-primary d-flex justify-content-center align-items-center vh-100">

    <div class="Card">

        <div class="Form-Container">

            <div class="Cara Registro  bg-body-secondary bg-opacity-10 p-5 rounded-5 shadow">

                <h1 class="mt-5 text-center fs-1 fw-bold">Registro</h1>

                <form action="procesar_registro.php" method="post" class="mt-4">

                    <div class=" mb-3">

                        <label for="username">Nombre de Usuario:</label>
                        <input type="text" id="username" name="username" class="form-control mt-1" required>

                    </div>


                    <div class=" mb-3">

                        <label for="username">Correo:</label>
                        <input type="text" id="correo" name="correo" class="form-control mt-1" required>

                    </div>


                    <div class="mb-3">

                        <label for="username">Telefono:</label>
                        <input type="number" id="telefono" name="telefono" class="form-control mt-1" required>

                    </div>


                    <div class=" mt-3">

                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" class="form-control mt-1" required>

                    </div>


                    <button type="submit" class="btn btn-primary mt-3">Registrarse</button>


                    <div class="mt-2 d-flex gap-1 justify-content-center">

                        <div>ya tienes una cuenta?</div>
                        <a href='../index.php' class="text-decoration-none text-info fw-semibold fst-italic" > Login</a>

                    </div>

                </form>

             </div>
        </div>
    </div>


</body>
</html>
