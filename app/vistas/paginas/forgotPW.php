<?php 
  $titulo = 'Recuperar Contraseña';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto d-flex flex-column align-items-center">
  <div class="card p-4 shadow-lg" style="max-width: 400px; width: 100%;">
    <form action="<?php echo RUTA_URL;?>/logincontroller/forgotpw" method="POST" class="form-forgot-password">
      <h1 class="h4 mb-4 text-center">Recuperar Contraseña</h1>

      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
        <label for="email">Correo electrónico</label>
      </div>

      <button class="btn btn-primary w-100 py-2 mb-3" type="submit">Enviar</button>

      <div class="d-flex justify-content-between">
        <a href="<?php echo RUTA_URL;?>/logincontroller/index" class="btn btn-link p-0">Volver al inicio de sesión</a>
      </div>
      
      <div id="success-message" class="alert alert-success d-none mt-3" role="alert"></div>
      <div id="error-message" class="alert alert-danger d-none mt-3" role="alert"></div>
    </form>
  </div>
</main>

<script>
  <?php if(isset($_SESSION["mensaje_exito"])): ?>
    var successMessage = "<?php echo $_SESSION["mensaje_exito"]; ?>";
    <?php unset($_SESSION["mensaje_exito"]); ?>
  <?php else: ?>
    var successMessage = "";
  <?php endif; ?>

  <?php if(isset($_SESSION["mensaje_error"])): ?>
    var errorMessage = "<?php echo $_SESSION["mensaje_error"]; ?>";
    <?php unset($_SESSION["mensaje_error"]); ?>
  <?php else: ?>
    var errorMessage = "";
  <?php endif; ?>

  if(successMessage !== "") {
    var successMessageElement = document.getElementById("success-message");
    successMessageElement.textContent = successMessage;
    successMessageElement.classList.remove("d-none");
  }

  if(errorMessage !== "") {
    var errorMessageElement = document.getElementById("error-message");
    errorMessageElement.textContent = errorMessage;
    errorMessageElement.classList.remove("d-none");
  }
</script>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>
