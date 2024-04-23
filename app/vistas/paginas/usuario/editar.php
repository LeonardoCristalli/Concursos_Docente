<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=usuarios" class="btn btn-light">Volver</a>

<div class="card card-body bg-light mt-5">

  <h2>Editar Usuario</h2>

  <form action="<?php echo RUTA_URL;?>/usuariocontroller/editarUsuario/<?php echo $datos['id']?>" method="POST">

    <div class="form-group">
      <label for="nombre">Nombre: <sup>*</sup></label>
      <input type="text" id="nombre" name="nombre" class="form-control form-control-lg" value="<?php echo $datos['nombre']; ?>">
    </div>

    <div class="form-group">
      <label for="apellido">Apellido: <sup>*</sup></label>
      <input type="text" id="apellido" name="apellido" class="form-control form-control-lg" value="<?php echo $datos['apellido']; ?>">
    </div>

    <div class="form-group">
      <label for="fecha_nac">Fecha de Nacimiento: <sup>*</sup></label>
      <input type="date" id="fecha_nac" name="fecha_nac" class="form-control form-control-lg" value="<?php echo $datos['fecha_nac']; ?>">
    </div>

    <div class="form-group">
      <label>Sexo: <sup>*</sup></label><br/>
      <div class="form-check">
        <input type="radio" id="masculino" name="sexo" class="form-check-input" value="M" <?php echo ($datos['sexo'] === 'M') ? 'checked' : ''; ?>>
        <label class="form-check-label" for="masculino">Masculino</label><br>
      </div>
      <div class="form-check">
        <input type="radio" id="femenino" name="sexo" class="form-check-input" value="F" <?php echo ($datos['sexo'] === 'F') ? 'checked' : ''; ?>>
        <label class="form-check-label" for="femenino">Femenino</label>
      </div>
    </div>

    <div class="form-group">
      <label for="fecha_nac">Fecha de Nacimiento: <sup>*</sup></label>
      <input type="date" id="fecha_nac" name="fecha_nac" class="form-control form-control-lg" value="<?php echo $datos['fecha_nac']; ?>">
    </div>

    <div class="form-group">
      <label for="direccion">Dirección: <sup>*</sup></label>
      <input type="text" id="direccion" name="direccion" class="form-control form-control-lg" value="<?php echo $datos['direccion']; ?>">
    </div>

    <div class="form-group">
      <label for="telefono">Teléfono: <sup>*</sup></label>
      <input type="tel" id="telefono" name="telefono" class="form-control form-control-lg" value="<?php echo $datos['telefono']; ?>">
    </div>

    <div class="form-group">
      <label for="email">Email: <sup>*</sup></label>
      <input type="email" id="email" name="email" class="form-control form-control-lg" value="<?php echo $datos['email']; ?>">
    </div>

    <div class="form-group">
      <label for="nro_dni">DNI: <sup>*</sup></label>
      <input type="text" id="nro_dni" name="nro_dni" class="form-control form-control-lg" value="<?php echo $datos['nro_dni']; ?>">
    </div>

    <div class="form-group">
      <label for="cuil">Cuil: <sup>*</sup></label>
      <input type="text" id="cuil" name="cuil" class="form-control form-control-lg" value="<?php echo $datos['cuil']; ?>">
    </div>

    <fieldset>
      <div class="form-group">
        <label for="tipo_usu">Tipo de Usuario: <sup>*</sup></label>
        <input type="text" id="tipo_usu" name="tipo_usu" class="form-control form-control-lg" value="<?php echo $datos['tipo_usu']; ?>">
      </div>

      <div class="form-group">
        <label for="nro_legajo">Número de Legajo: <sup>*</sup></label>
        <input type="text" id="nro_legajo" name="nro_legajo" class="form-control form-control-lg" value="<?php echo $datos['nro_legajo']; ?>">
      </div>
    </fieldset>

    <div class="form-group">
      <label for="usuario">Usuario: <sup>*</sup></label>
      <input type="text" id="usuario" name="usuario" class="form-control form-control-lg" value="<?php echo $datos['usuario']; ?>">
    </div>

    <div class="form-group">
      <label for="password">Password: <sup>*</sup></label>
      <input type="password" id="password" name="password" class="form-control form-control-lg" value="<?php echo $datos['password']; ?>">
    </div>

    <input type="submit" class="btn btn-success" value="Editar Usuario">

  </form>  
</div>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>