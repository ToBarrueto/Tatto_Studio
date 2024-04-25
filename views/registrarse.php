
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container">
        <h2 class="mt-5">Registro de Cliente</h2>
        <form action="procesar_registro.php" method="post" class="mt-4">
            <div class="form-group">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" class="form-control mt-1" required>
            </div>
            <div class="form-group mt-3">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control mt-1" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Registrarse</button>
        </form>
    </div>


</body>
</html>
