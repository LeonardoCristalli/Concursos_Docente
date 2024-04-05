<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<main class="main-container w-100 m-auto">

  <div class="row mb-4">
    <div class="col">
      <a href="<?php echo RUTA_URL;?>/paginas/index" class="btn btn-secondary btn-sm">Volver</a>
    </div>
  </div>

  <form action="<?php echo RUTA_URL;?>/usuarioController/agregarUsuario" method="POST" class="form-signup">

    <h2 class="mt-3 mb-4">Crear Usuario</h2>
    
    <div class="row">

      <div class="col-md-6">

        <div class="form-group">
          <label for="nombre">Nombre: <sup>*</sup></label>
          <input type="text" id="nombre" name="nombre" class="form-control">
        </div>

        <div class="form-group">
          <label for="apellido">Apellido: <sup>*</sup></label>
          <input type="text" id="apellido" name="apellido" class="form-control form-control-lg">
        </div>

        <div class="form-group">
          <label for="fecha_nac">Fecha de Nacimiento: <sup>*</sup></label>
          <input type="date" id="fecha_nac" name="fecha_nac" class="form-control form-control-lg">
        </div>

        <div class="form-group">
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

        <div class="form-group">
          <label for="direccion">Dirección: <sup>*</sup></label>
          <input type="text" id="direccion" name="direccion" class="form-control form-control-lg">
        </div>

        <div class="form-group">
          <label for="telefono">Teléfono: <sup>*</sup></label>
          <input type="tel" id="telefono" name="telefono" class="form-control form-control-lg">
        </div>

        <div class="form-group">
          <label for="nro_dni">DNI: <sup>*</sup></label>
          <input type="text" id="nro_dni" name="nro_dni" class="form-control form-control-lg">
        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group">
          <label for="email">Email: <sup>*</sup></label>
          <input type="email" id="email" name="email" class="form-control form-control-lg">
        </div>

        <div class="form-group">
          <label for="cuil">Cuil: <sup>*</sup></label>
          <input type="text" id="cuil" name="cuil" class="form-control form-control-lg">
        </div>

        <div class="form-group">
          <label for="tipo_usu">Tipo de Usuario: </label>
          <input type="text" id="tipo_usu" name="tipo_usu" class="form-control form-control-lg">
        </div>

        <div class="form-group">
          <label for="nro_legajo">Número de Legajo: </label>
          <input type="text" id="nro_legajo" name="nro_legajo" class="form-control form-control-lg">
        </div>

        <div class="form-group">
          <label for="usuario">Usuario: <sup>*</sup></label>
          <input type="text" id="usuario" name="usuario" class="form-control form-control-lg">
        </div>

        <div class="form-group">
          <label for="password">Password: <sup>*</sup></label>
          <input type="password" id="password" name="password" class="form-control form-control-lg">
        </div>

      </div>

    </div>

    <button type="submit" name="submit" value="submit">Crear Usuario</button>
  </form>

</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>