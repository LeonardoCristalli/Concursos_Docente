<?php
  $titulo = 'Editar Usuario';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">

  <?php if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usu'] !== 'Admin'): ?>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo RUTA_URL; ?>/">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Perfil</li>
      </ol> 
    </nav>
  <?php endif; ?>

  <div class="row mb-4 g-0">

    <div class="col-md-1">
      <?php if (isset($_SESSION['usuario_id']) && $_SESSION['tipo_usu'] === 'Admin'): ?>
        <a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=usuarios" class="btn btn-secondary btn-sm">Volver</a>           
      <?php endif; ?>
    </div>

    <div class="col-md-11">
      <h2>Editar Usuario</h2>
      <form action="<?php echo RUTA_URL;?>/usuarioController/editarUsuario/<?php echo $datos['id']?>" method="POST" class="form-signup" enctype="multipart/form-data">        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="nombre" class="form-label">Nombre:<sup>*</sup></label>
              <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $datos['nombre']; ?>">
            </div>

            <div class="form-group mb-3">
              <label for="apellido" class="form-label">Apellido:<sup>*</sup></label>
              <input type="text" id="apellido" name="apellido" class="form-control" value="<?php echo $datos['apellido']; ?>">
            </div>

            <div class="form-group mb-3">
              <label for="fecha_nac" class="form-label">Fecha de Nacimiento:<sup>*</sup></label>
              <input type="date" id="fecha_nac" name="fecha_nac" class="form-control" value="<?php echo $datos['fecha_nac']; ?>">
            </div>

            <div class="form-group mb-3">
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

            <div class="form-group mb-3">
              <label for="direccion" class="form-label">Dirección: <sup>*</sup></label>
              <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo $datos['direccion']; ?>">
            </div>

            <div class="form-group mb-3">
              <label for="telefono" class="form-label">Teléfono: <sup>*</sup></label>
              <input type="tel" id="telefono" name="telefono" class="form-control" value="<?php echo $datos['telefono']; ?>">
            </div>

            <div class="form-group mb-3">
              <label for="email" class="form-label">Email: <sup>*</sup></label>
              <input type="email" id="email" name="email" class="form-control" value="<?php echo $datos['email']; ?>">
            </div>

            <div class="form-group mb-3">
              <label for="nro_dni" class="form-label">DNI: <sup>*</sup></label>
              <input type="text" id="nro_dni" name="nro_dni" class="form-control" value="<?php echo $datos['nro_dni']; ?>">
            </div>

          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="cuil" class="form-label">Cuil: <sup>*</sup></label>
              <input type="text" id="cuil" name="cuil" class="form-control" value="<?php echo $datos['cuil']; ?>">
            </div>

            <?php if($datos['mostrar_tipo_usu']): ?>
                <div class="mb-3">
                    <label for="tipo_usu">Tipo de Usuario:</label>
                    <select name="tipo_usu" class="form-control">
                        <option value="Usuario" <?php echo ($datos['tipo_usu'] == 'Usuario') ? 'selected' : ''; ?>>Usuario</option>
                        <option value="JC" <?php echo ($datos['tipo_usu'] == 'JC') ? 'selected' : ''; ?>>Jefe de Cátedra</option>
                        <option value="RA" <?php echo ($datos['tipo_usu'] == 'RA') ? 'selected' : ''; ?>>Responsable Administrativo</option>
                        <option value="Admin" <?php echo ($datos['tipo_usu'] == 'Admin') ? 'selected' : ''; ?>>Administrador</option>
                    </select>
                </div>
            <?php endif; ?>

            <fieldset>
              <div class="form-group mb-3">
                <label for="usuario" class="form-label">Usuario: <sup>*</sup></label>
                <input type="text" id="usuario" name="usuario" class="form-control" value="<?php echo $datos['usuario']; ?>">
              </div>

              <div class="form-group mb-3">
                <label for="password" class="form-label">Password: <sup>*</sup></label>
                <input type="password" id="password" name="password" class="form-control" value="">
                <div id="passwordHelpBlock" class="form-text">
                  La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número.
                </div>
              </div>
            </fieldset>

            <div class="form-group mb-3">
              <label for="cv" class="form-label">CV:</label>
              <?php if (!empty($datos['cv'])): ?>
                <span>Archivo actual: <?php echo htmlspecialchars($datos['cv']); ?></span>
                <input type="hidden" name="cv" value="<?php echo htmlspecialchars($datos['cv']); ?>">
              <?php endif; ?>
              <input class="form-control" type="file" id="cv" name="cv">
            </div> 


            <div class="d-flex justify-content-center">
              <button class="btn btn-primary mb-3" type="submit" name="submit" value="submit">Editar Usuario</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>
