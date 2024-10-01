<?php 
  $titulo = 'Restablecer Contraseña';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto d-flex flex-column align-items-center">
  <div class="card p-4 shadow-lg" style="max-width: 400px; width: 100%;">
    <form action="<?php echo RUTA_URL;?>/logincontroller/actualizarpw" method="POST">
      <h1 class="h4 mb-4 text-center">Restablecer Contraseña</h1>

      <input type="hidden" name="token" value="<?php echo $datos['token']; ?>"> 

      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" name="password" placeholder="Nueva contraseña" required>
        <label for="password">Nueva contraseña</label>
      </div>

      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirmar contraseña" required>
        <label for="confirm_password">Confirmar contraseña</label>
      </div>

      <button class="btn btn-primary w-100 py-2 mb-3" type="submit">Restablecer Contraseña</button>

      <div id="error-message" class="alert alert-danger d-none my-4" role="alert"></div>
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
