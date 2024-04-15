<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<main class="main-container w-100 m-auto">

  <div class="row mb-4">
    <div class="col">
      <a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=vacantes" class="btn btn-secondary btn-sm">Volver</a>
    </div>
  </div>

  <form action="<?php echo RUTA_URL;?>/vacanteController/agregarVacante" method="POST" class="form-signup">

    <h2 class="mt-3 mb-4">Crear Vacante</h2>
    
    <div class="row">
      <div class="col-md-6">

        <div class="form-group">
          <label for="descrip">Descripción: <sup>*</sup></label>
          <textarea id="descrip" name="descrip" class="form-control form-control-lg"></textarea>
        </div>

        <div class="form-group">
          <label for="fecha_ini">Fecha de Inicio:<sup>*</sup></label>
          <input type="date" id="fecha_ini" name="fecha_ini" class="form-control form-control-lg">
        </div>

        <div class="form-group">
          <label for="fecha_fin">Fecha de Cierre:<sup>*</sup></label>
          <input type="date" id="fecha_fin" name="fecha_fin" class="form-control form-control-lg">
        </div>

        <div class="form-group">
          <label for="req">Requerimientos:<sup>*</sup></label>
          <textarea id="req" name="req" class="form-control form-control-lg"></textarea>
        </div>

        <div class="form-group">
          <label for="tiempo">Tiempo:<sup>*</sup></label>
          <input type="text" id="tiempo" name="tiempo" class="form-control form-control-lg">
        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group">
          <label for="exp">Experiencia:<sup>*</sup></label>
          <input type="text" id="exp" name="exp" class="form-control form-control-lg">
        </div>

        <div class="form-group">
          <label for="estado_id">Estado:<sup>*</sup></label>
          <input type="number" id="estado_id" name="estado_id" class="form-control form-control-lg"></input>
        </div>

        <div class="form-group">
          <label for="catedra_id">Catedra:<sup>*</sup></label>
          <input type="number" id="catedra_id" name="catedra_id" class="form-control form-control-lg"></input>
        </div>

        <input type="hidden" name="fecha_desde" value="<?php echo date('Y-m-d'); ?>">

        <div class="form-group">
          <label for="observacion">Observación:</label>
          <input type="text" id="observacion" name="observacion" class="form-control">
        </div>
      </div>
    </div>

    <button type="submit" name="submit" value="submit">Crear Vacante</button>
  </form>

</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>