<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=vacantes" class="btn btn-light"><i class="fa fa-backward"></i>Volver</a>

<div class="card card-body bg-light mt-5">

  <h2>Crear Vacante</h2>

  <form action="<?php echo RUTA_URL;?>/vacantecontroller/agregarVacante" method="POST">
  
    <div class="form-group">
      <label for="descrip">Descripción: <sup>*</sup></label>
      <input type="text" id="descrip" name="descrip" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="fecha_ini">Fecha de Inicio: <sup>*</sup></label>
      <input type="date" id="fecha_ini" name="fecha_ini" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="fecha_fin">Fecha de Fin: <sup>*</sup></label>
      <input type="date" id="fecha_fin" name="fecha_fin" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="req">Requerimientos: <sup>*</sup></label>
      <input type="text" id="req" name="req" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="tiempo">Tiempo: <sup>*</sup></label>
      <input type="text" id="tiempo" name="tiempo" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="exp">Experiencia: <sup>*</sup></label>
      <input type="text" id="exp" name="exp" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="motivo_id">Motivo: <sup>*</sup></label>
      <input type="number" id="motivo_id" name="motivo_id" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="estado_id">Estado: <sup>*</sup></label>
      <input type="number" id="estado_id" name="estado_id" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="catedra_id">Cátedra: <sup>*</sup></label>
      <input type="number" id="catedra_id" name="catedra_id" class="form-control form-control-lg">
    </div>

    <button type="submit" name="submit" value="submit">Crear Cátedra</button>
  </form>
</div>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>