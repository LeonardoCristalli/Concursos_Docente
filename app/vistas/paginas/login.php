<?php 
  $titulo = 'Iniciar Sesión';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto d-flex flex-column align-items-center">

  <div class="card p-4 shadow-lg" style="max-width: 400px; width: 100%;">
    <form action="<?php echo RUTA_URL;?>/logincontroller/login" method="POST" class="form-login">

      <h1 class="h4 mb-4 text-center">Iniciar sesión</h1>
  
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario" required>
        <label for="username">Usuario</label>
      </div>

      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
        <label for="password">Contraseña</label>
      </div>

      <div class="form-check text-start mb-3">
        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">Recordarme</label>
      </div>

      <button class="btn btn-primary w-100 py-2 mb-3" type="submit">Log in</button>

      <div class="d-flex justify-content-between">
        <a href="<?php echo RUTA_URL;?>/paginas/recuperarpw" class="btn btn-link p-0">¿Olvidaste tu contraseña?</a>
      </div>
      
      <div id="error-message" class="alert alert-danger d-none mt-3" role="alert"></div>

    </form>
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
