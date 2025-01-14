<?php 
  $titulo = 'Crear Vacante';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">

  <?php if (isset($_SESSION['mensaje_error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?php echo $_SESSION['mensaje_error']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['mensaje_error']); ?>
  <?php endif; ?>

  <?php if ($_SESSION['tipo_usu'] !== 'Admin'): ?>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo RUTA_URL; ?>/">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=vacantes">Vacantes</a></li>
        <li class="breadcrumb-item active" aria-current="page">Crear Vacante</li>
      </ol>
    </nav>
  <?php endif; ?>
  
  <div class="row mb-4 g-0">

    <?php if ($_SESSION['tipo_usu'] == 'Admin'): ?>
      <div class="col-md-1">
        <a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=vacantes" class="btn btn-secondary btn-sm">Volver</a>
      </div>
    <?php endif; ?>

    <div class="col-md-11">

      <h2 class="mt-3 mb-4">Crear Vacante</h2>
      <form action="<?php echo RUTA_URL;?>/vacanteController/agregarVacante" method="POST">
        <div class="row justify-content-center">

          <div class="col-md-5">

            <div class="form-group mb-3">
              <label for="descrip" class="form-label">Descripción: <sup>*</sup></label>
              <textarea id="descrip" name="descrip" class="form-control"></textarea>
            </div>

            <div class="form-group mb-3">
              <label for="fecha_ini" class="form-label">Fecha de Inicio:<sup>*</sup></label>
              <input type="date" id="fecha_ini" name="fecha_ini" class="form-control" 
                     min="<?php echo date('Y-m-d'); ?>" 
                     value="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="form-group mb-3">
              <label for="fecha_fin" class="form-label">Fecha de Cierre:<sup>*</sup></label>
              <input type="date" id="fecha_fin" name="fecha_fin" class="form-control">
            </div>

            <div class="form-group mb-3">
              <label for="req" class="form-label">Requerimientos:<sup>*</sup></label>
              <textarea id="req" name="req" class="form-control"></textarea>
            </div>

            <div class="form-group mb-3">
              <label for="tiempo" class="form-label">Tiempo:<sup>*</sup></label>
              <input type="text" id="tiempo" name="tiempo" class="form-control">
            </div>
          </div>

          <div class="col-md-5">

            <div class="form-group mb-3">
              <label for="exp" class="form-label">Experiencia:<sup>*</sup></label>
              <input type="text" id="exp" name="exp" class="form-control">
            </div>

            <div class="form-group mb-3">
              <label for="catedra_id" class="form-label">Catedra:<sup>*</sup></label>
              <select id="catedra_id" name="catedra_id" class="form-select">
                <option value="" disabled selected></option>
                <?php foreach($datos['catedras'] as $catedra): ?>
                  <option value="<?php echo $catedra->id; ?>"><?php echo $catedra->nombre; ?></option>                
                <?php endforeach; ?>
              </select>
            </div>

            <input type="hidden" name="fecha_desde" value="<?php echo date('Y-m-d'); ?>">

            <div class="form-group mb-3">
              <label for="observacion" class="form-label">Observación:</label>
              <input type="text" id="observacion" name="observacion" class="form-control">
            </div>

            <div class="d-flex justify-content-end">
              <button class="btn btn-primary" type="submit" name="submit" value="submit">Crear</button>
            </div>  

          </div>
        </div>
      </form>
    </div>
  </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fechaIni = document.getElementById('fecha_ini');
    const fechaFin = document.getElementById('fecha_fin');
    
    // Establecer fecha mínima de cierre al cargar la página
    const fechaInicial = new Date(fechaIni.value);
    fechaInicial.setDate(fechaInicial.getDate() + 1);
    fechaFin.min = fechaInicial.toISOString().split('T')[0];

    // Actualizar fecha mínima de cierre cuando cambia fecha de inicio
    fechaIni.addEventListener('change', function() {
        const fechaInicio = new Date(fechaIni.value);
        fechaInicio.setDate(fechaInicio.getDate() + 1);
        fechaFin.min = fechaInicio.toISOString().split('T')[0];
        if(fechaFin.value && fechaFin.value <= fechaIni.value) {
            fechaFin.value = fechaInicio.toISOString().split('T')[0];
        }
    });
});
</script>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>