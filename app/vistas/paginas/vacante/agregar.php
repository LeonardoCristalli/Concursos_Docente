<?php 
  $titulo = 'Crear Vacante';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">
  <div class="row mb-4 g-0">

    <div class="col-md-1">
      <a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=vacantes" class="btn btn-secondary btn-sm">Volver</a>
    </div>

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
              <input type="date" id="fecha_ini" name="fecha_ini" class="form-control">
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

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>