<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<main class="main-container w-100 m-auto">

  <div class="row">

    <div class="col-md-8 offset-md-2">
      <form action="<?php echo RUTA_URL;?>/logincontroller/login" method="POST" class="form-login">

        <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>
    
        <div class="form-floating">
          <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario" required>
          <label for="username">Usuario</label>
        </div>

        <div class="form-floating">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          <label for="password">Contraseña</label>
        </div>

        <div class="form-check text-start my-3">
          <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault"> Recordarme </label>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">Log in</button>
      </form>
    </div>

    <div class="col-md-2">
      <div class="d-flex justify-content-start mt-3">
        <a href="<?php echo RUTA_URL;?>/paginas/index" class="btn btn-secondary btn-sm">Volver</a>
      </div>
    </div>

    <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
    
  </div>

</main>

<script>
  <?php if(isset($_SESSION["mensaje_error"])): ?>
    var errorMessage = "<?php echo $_SESSION["mensaje_error"]; ?>";
    <?php unset($_SESSION["mensaje_error"]); ?>
  <?php else: ?>
    var errorMessage = "";
  <?php endif; ?>

  if(errorMessage !== "") {
    var errorMessageElement = document.getElementById("error-message");
    errorMessageElement.textContent = errorMessage;
    errorMessageElement.classList.remove("d-none"); 
  }
</script>


<?php require RUTA_APP . '/vistas/inc/footer.php'; ?> 