<?php
session_start();
$registro_exitoso = isset($_SESSION['registro_exitoso']) ? $_SESSION['registro_exitoso'] : false;
if ($registro_exitoso) {
    unset($_SESSION['registro_exitoso']);
}
include("controllers/validar.php")
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/ES.css">
</head>

<body>
  <div class="body-custom">

    <div class="container-form login">
      <div class="information">
        <div class="info-childs">
          <h2>TattoStudioINK</h2>
          <p>Si no tienes una cuenta creada, Registrate aquí.</p>
          <input type="button" value="Registrarse" id="sign-up">
        </div>
      </div>
      <div class="form-information">
        <div class="form-information-childs">
          <h2>Iniciar Sesión</h2>
          <form method="post" class="form form-login" novalidate>
            <div>
              <label>
                <input type="text" placeholder="Nombre de Usuario" name="Nusuario">
              </label>
            </div>
            <div>
              <label>
                <input type="password" placeholder="Contraseña" name="Pass">
              </label>
            </div>
            <input type="submit" value="Iniciar Sesión" name="inicioSesion">
            <div class="alerta-error">Todos los campos son obligatorios</div>
            <div class="alerta-exito">Te registraste correctamente</div>
          </form>
        </div>
      </div>
    </div>


    <div class="container-form register hide">
      <div class="information">
        <div class="info-childs">
          <h2>TattoStudioINK</h2>
          <p>Si ya tienes una cuenta creada, Inicia sesión.</p>
          <input type="button" value="Iniciar Sesión" id="sign-in">
        </div>
      </div>
      <div class="form-information">
        <div class="form-information-childs">
          <h2>Crear una Cuenta</h2>
          <form action="procesar_registro.php" method="post" class="form form-register" novalidate>
            <div>
              <label>
                <input type="text" placeholder="Nombre Usuario" name="username">
              </label>
            </div>

            <div>
              <label>
                <input type="password" placeholder="Contraseña" name="password">
              </label>
            </div>

            <input type="submit" value="Registrarse">
            <div class="alerta-error">Todos los campos son obligatorios</div>
            <div class="alerta-exito">Te registraste correctamente</div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registroModalLabel">Registro Exitoso</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ¡Te has registrado correctamente!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
  </script>
  <script>
    const containerFormRegister = document.querySelector(".register");
    const containerFormLogin = document.querySelector(".login");

    document.getElementById("sign-in").addEventListener("click", () => {
      containerFormRegister.classList.add("hide");
      containerFormLogin.classList.remove("hide");
    });

    document.getElementById("sign-up").addEventListener("click", () => {
      containerFormLogin.classList.add("hide");
      containerFormRegister.classList.remove("hide");
    });

    <?php if ($registro_exitoso): ?>
    const registroModal = new bootstrap.Modal(document.getElementById('registroModal'));
    registroModal.show();
    <?php endif; ?>
  </script>
</body>

</html>
