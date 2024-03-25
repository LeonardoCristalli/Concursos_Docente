<?php 
  require_once RUTA_APP . '/vistas/inc/header.php'; 
?>

<div class="container">
  <form action="<?php echo RUTA_URL;?>/logincontroller/login" method="POST">

    <fieldset class="login-form">

      <legend>Iniciar sesión</legend>

      <div>
        <label for="username">Nombre de usuario</label>
        <input type="text" id="username" name="username" required>
      </div>

      <div>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
      </div>

      <div>
        <button type="submit" name="submit" value="submit">Iniciar sesión</button>
      </div>
      
    </fieldset>
  </form>
</div>

<!-- <p>¿Nuevo por aquí? <a href="registro.php">Regístrate</a></p>
<p>¿Olvidaste tu contraseña? <a href="recuperar_contraseña.php">Recupérala aquí</a></p> -->

<?php require_once RUTA_APP . '/vistas/inc/footer.php'; ?>