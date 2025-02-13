<?php
  $titulo = 'Crear Usuario';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">
  <div class="row mb-4 g-0">

    <?php if (!isset($_SESSION['usuario_id'])): ?>
      <nav aria-label="breadcrumb" class="align-self-start w-100">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo RUTA_URL; ?>/">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page">Registro</li>
        </ol>
      </nav>
    <?php else: ?>
      <div class="col-md-1">
        <a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=usuarios" class="btn btn-secondary btn-sm">Volver</a>
      </div>
    <?php endif; ?>

    <div class="col-md-11">
      <h2 class="mt-3 mb-4">Crear Usuario</h2>    
      <form action="<?php echo RUTA_URL;?>/usuarioController/agregarUsuario" method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-4">
            <fieldset>
              <legend>Información Personal</legend>

              <div class="form-group mb-3">
                <label for="nombre" class="form-label">Nombre:<sup>*</sup></label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
                <?php if (isset($datos['errores']['nombre'])): ?>
                  <div class="text-danger"><?php echo $datos['errores']['nombre']; ?></div>
                <?php endif; ?>
              </div>

              <div class="form-group mb-3">
                <label for="apellido" class="form-label">Apellido: <sup>*</sup></label>
                <input type="text" id="apellido" name="apellido" class="form-control" value="<?php echo isset($_POST['apellido']) ? $_POST['apellido'] : ''; ?>">
                <?php if (isset($datos['errores']['apellido'])): ?>
                  <div class="text-danger"><?php echo $datos['errores']['apellido']; ?></div>
                <?php endif; ?>
              </div>

              <div class="form-group mb-3">
                <label for="fecha_nac" class="form-label">Fecha de Nacimiento:<sup>*</sup></label>
                <input type="date" id="fecha_nac" name="fecha_nac" class="form-control"
                      max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>"
                      min="<?php echo date('Y-m-d', strtotime('-100 years')); ?>"
                      value="<?php echo isset($_POST['fecha_nac']) ? $_POST['fecha_nac'] : date('Y-m-d', strtotime('-18 years')); ?>">
                <?php if (isset($datos['errores']['fecha_nac'])): ?>
                  <div class="text-danger"><?php echo $datos['errores']['fecha_nac']; ?></div>
                <?php endif; ?>
              </div>

              <div class="form-group mb-3">
                <label>Sexo: <sup>*</sup></label><br>
                <div class="form-check">
                  <input type="radio" id="masculino" name="sexo" class="form-check-input" value="M" <?php echo isset($_POST['sexo']) && $_POST['sexo'] == 'M' ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="masculino">Masculino</label><br>
                </div>
                <div class="form-check">
                  <input type="radio" id="femenino" name="sexo" class="form-check-input" value="F" <?php echo isset($_POST['sexo']) && $_POST['sexo'] == 'F' ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="femenino">Femenino</label>
                </div>
                <?php if (isset($datos['errores']['sexo'])): ?>
                  <div class="text-danger"><?php echo $datos['errores']['sexo']; ?></div>
                <?php endif; ?>
              </div>       

            </fieldset>
          </div>
          
          <div class="col-md-4">
            <fieldset>
              <legend>Información de Contacto</legend>

              <div class="form-group mb-3">
                <label for="direccion" class="form-label">Dirección: <sup>*</sup></label>
                <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo isset($_POST['direccion']) ? $_POST['direccion'] : ''; ?>">
                <?php if (isset($datos['errores']['direccion'])): ?>
                  <div class="text-danger"><?php echo $datos['errores']['direccion']; ?></div>
                <?php endif; ?>
              </div>

              <div class="form-group mb-3">
                <label for="telefono" class="form-label">Teléfono: <sup>*</sup></label>
                <input type="tel" id="telefono" name="telefono" class="form-control" value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : ''; ?>">
                <?php if (isset($datos['errores']['telefono'])): ?>
                  <div class="text-danger"><?php echo $datos['errores']['telefono']; ?></div>
                <?php endif; ?>
              </div>

              <div class="form-group mb-3">
                <label for="email" class="form-label">Email: <sup>*</sup></label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                <?php if (isset($datos['errores']['email'])): ?>
                  <div class="text-danger"><?php echo $datos['errores']['email']; ?></div>
                <?php endif; ?>
              </div>

            </fieldset>
          </div>

          <div class="col-md-4">
            <fieldset>
              <legend>Documentos</legend>

              <div class="form-group mb-3">
                <label for="nro_dni" class="form-label">DNI: <sup>*</sup></label>
                <input type="text" id="nro_dni" name="nro_dni" class="form-control" value="<?php echo isset($_POST['nro_dni']) ? $_POST['nro_dni'] : ''; ?>">
                <?php if (isset($datos['errores']['nro_dni'])): ?>
                  <div class="text-danger"><?php echo $datos['errores']['nro_dni']; ?></div>
                <?php endif; ?>
              </div>

              <div class="form-group mb-3">
                <label for="cuil" class="form-label">Cuil: <sup>*</sup></label>
                <input type="text" id="cuil" name="cuil" class="form-control" value="<?php echo isset($_POST['cuil']) ? $_POST['cuil'] : ''; ?>">
                <?php if (isset($datos['errores']['cuil'])): ?>
                  <div class="text-danger"><?php echo $datos['errores']['cuil']; ?></div>
                <?php endif; ?>
              </div>
              
            </fieldset>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <fieldset>
              <legend>Detalles de Usuario</legend>

              <div class="form-group mb-3">
                <label for="usuario" class="form-label">Usuario: <sup>*</sup></label>
                <input type="text" id="usuario" name="usuario" class="form-control" value="<?php echo isset($_POST['usuario']) ? $_POST['usuario'] : ''; ?>">
                <?php if (isset($datos['errores']['usuario'])): ?>
                  <div class="text-danger"><?php echo $datos['errores']['usuario']; ?></div>
                <?php endif; ?>
              </div>

              <div class="input-group mb-3">
                <div class="form-group">
                  <label for="password" class="form-label">Password: <sup>*</sup></label>
                  <input type="password" id="password" name="password" class="form-control pe-5">
                </div>                
                <span class="toggle-password position-absolute end-0 top-50 translate-middle-y me-3">
                  <i class="fas fa-eye"></i>
                </span>
                <div id="passwordHelpBlock" class="form-text">
                  La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número
                </div>
                 <?php if (isset($datos['errores']['password'])): ?>
                  <div class="text-danger"><?php echo $datos['errores']['password']; ?></div>
                <?php endif; ?>
              </div>
            </fieldset>
          </div>

          <?php if (!isset($_SESSION['usuario_id'])): ?>
            <input type="hidden" name="tipo_usu" value="Usuario">
          <?php elseif (isset($_SESSION['tipo_usu']) && $_SESSION['tipo_usu'] === 'Admin'): ?>
            <div class="col-md-3">
              <fieldset>
                <legend>Otros Detalles</legend>
                <div class="form-group mb-3">
                  <label for="tipo_usu" class="form-label">Tipo de Usuario: </label>
                  <select id="tipo_usu" name="tipo_usu" class="form-select" onchange="mostrarCatedra(this.value)">
                    <option value="" disabled selected></option>
                    <option value="Usuario">Usuario</option>
                    <option value="JC">Jefe de Cátedra</option>
                    <option value="RA">Responsable Administrativo</option>
                    <option value="Admin">Administrador</option>
                  </select>
                </div>

                <div class="form-group mb-3" id="catedraSelect" style="display:none;">
                  <label for="catedra_id" class="form-label">Cátedra:</label>
                  <select id="catedra_id" name="catedra_id" class="form-select">
                    <option value="" disabled selected></option>
                    <?php foreach($datos['catedras'] as $catedra): ?>
                      <option value="<?php echo $catedra->id; ?>"><?php echo $catedra->nombre; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </fieldset>
            </div>
          <?php endif; ?>

          <div class="col-md-5">
            <div class="form-group mb-3">
              <label for="cv" class="form-label">CV:</label>
              <input type="file" id="cv" name="cv" class="form-control">
            </div>    
          <div>

        </div>
        
        <div class="d-flex justify-content-end mt-3">
          <button class="btn btn-primary" type="submit" name="submit" value="submit">Crear</button>
        </div>
      </form>
    </div>
  </div>
</main>

<script>
  function mostrarCatedra(tipoUsuario) {
    var catedraSelect = document.getElementById('catedraSelect');
    if(tipoUsuario === 'JC') {
      catedraSelect.style.display = 'block';
    } else {
      catedraSelect.style.display = 'none';
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    var tipoUsuario = document.getElementById('tipo_usu').value;
    mostrarCatedra(tipoUsuario);
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.toggle-password').addEventListener('click', function() {
      let passwordInput = document.getElementById('password');
      let icon = this.querySelector('i');

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    });
  });
</script>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>