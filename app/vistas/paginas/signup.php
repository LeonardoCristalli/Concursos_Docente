<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<a href="<?php echo RUTA_URL;?>/index" class="btn btn-light"><i class="fa fa-backward"></i>Volver</a>

<div class="card card-body bg-light mt-5">

  <h2>Crear Usuario</h2>

  <form action="<?php echo RUTA_URL;?>/usuarioController/agregarUsuario" method="POST">

    <div class="form-group">
      <label for="nombre">Nombre: <sup>*</sup></label>
      <input type="text" id="nombre" name="nombre" class="form-control form-control-lg">
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
      <label for="email">Email: <sup>*</sup></label>
      <input type="email" id="email" name="email" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="nro_dni">DNI: <sup>*</sup></label>
      <input type="text" id="nro_dni" name="nro_dni" class="form-control form-control-lg">
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

    <button type="submit" name="submit" value="submit">Crear Usuario</button>
  </form>
</div>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>