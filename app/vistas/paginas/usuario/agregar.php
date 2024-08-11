<?php
  $titulo = 'Crear Usuario';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">

  <?php if (!isset($_SESSION['usuario_id'])): ?>

    <div class="row mb-4">
      <div class="col">
        <a href="<?php echo RUTA_URL;?>/paginas/index" class="btn btn-secondary btn-sm">Volver</a>
      </div>
    </div>

  <?php else: ?>
    <div class="row mb-4">
      <div class="col">
        <a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=usuarios" class="btn btn-secondary btn-sm">Volver</a>
      </div>
    </div>
  <?php endif; ?>
  
  <form action="<?php echo RUTA_URL;?>/usuarioController/agregarUsuario" method="POST" enctype="multipart/form-data" class="form-signup">
    <h2 class="mt-3 mb-4">Crear Usuario</h2>
    <div class="row">

      <div class="col-md-4">
        <fieldset>
          <legend>Información Personal</legend>

          <div class="form-group mb-3">
            <label for="nombre" class="form-label">Nombre:<sup>*</sup></label>
            <input type="text" id="nombre" name="nombre" class="form-control">
          </div>

          <div class="form-group mb-3">
            <label for="apellido" class="form-label">Apellido: <sup>*</sup></label>
            <input type="text" id="apellido" name="apellido" class="form-control">
          </div>

          <div class="form-group mb-3">
            <label for="fecha_nac" class="form-label">Fecha de Nacimiento: <sup>*</sup></label>
            <input type="date" id="fecha_nac" name="fecha_nac" class="form-control">
          </div>

          <div class="form-group mb-3">
            <label>Sexo: <sup>*</sup></label><br>
            <div class="form-check">
              <input type="radio" id="masculino" name="sexo" class="form-check-input" value="M">
              <label class="form-check-label" for="masculino">Masculino</label><br>
            </div>
            <div class="form-check">
              <input type="radio" id="femenino" name="sexo" class="form-check-input" value="F">
              <label class="form-check-label" for="femenino">Femenino</label>
            </div>
          </div>       

        </fieldset>
      </div>
      
      <div class="col-md-4">
        <fieldset>
          <legend>Información de Contacto</legend>

          <div class="form-group mb-3">
            <label for="direccion" class="form-label">Dirección: <sup>*</sup></label>
            <input type="text" id="direccion" name="direccion" class="form-control">
          </div>

          <div class="form-group mb-3">
            <label for="telefono" class="form-label">Teléfono: <sup>*</sup></label>
            <input type="tel" id="telefono" name="telefono" class="form-control">
          </div>

          <div class="form-group mb-3">
            <label for="email" class="form-label">Email: <sup>*</sup></label>
            <input type="email" id="email" name="email" class="form-control">
          </div>

        </fieldset>
      </div>

      <div class="col-md-4">
        <fieldset>
          <legend>Documentos</legend>

          <div class="form-group mb-3">
            <label for="nro_dni" class="form-label">DNI: <sup>*</sup></label>
            <input type="text" id="nro_dni" name="nro_dni" class="form-control">
          </div>

          <div class="form-group mb-3">
            <label for="cuil" class="form-label">Cuil: <sup>*</sup></label>
            <input type="text" id="cuil" name="cuil" class="form-control">
          </div>
          
        </fieldset>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <fieldset>
          <legend>Detalles de Usuario</legend>

          <div class="form-group mb-3">
            <label for="usuario" class="form-label">Usuario: <sup>*</sup></label>
            <input type="text" id="usuario" name="usuario" class="form-control">
          </div>

          <div class="form-group mb-3">
            <label for="password" class="form-label">Password: <sup>*</sup></label>
            <input type="password" id="password" name="password" class="form-control">
            <div id="passwordHelpBlock" class="form-text">
              La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número
            </div>
          </div>

        </fieldset>
      </div>

      <div class="col-md-6">
        <fieldset>
          <legend>Otros Detalles</legend>

          <div class="form-group mb-3">
            <label for="tipo_usu" class="form-label">Tipo de Usuario: </label>
            <input type="text" id="tipo_usu" name="tipo_usu" class="form-control">
          </div>

          <div class="form-group mb-3">
            <label for="nro_legajo" class="form-label">Número de Legajo: </label>
            <input type="text" id="nro_legajo" name="nro_legajo" class="form-control">
          </div>

          <div class="form-group mb-3">
            <label for="cv" class="form-label">CV:</label>
            <input type="file" id="cv" name="cv" class="form-control">
          </div>  

        </fieldset>
      </div>
    </div>
    
    <button class="btn btn-primary" type="submit" name="submit" value="submit">Crear</button>
  </form>
</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>