<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=catedras" class="btn btn-light"><i class="fa fa-backward"></i>Volver</a>

<div class="card card-body bg-light mt-5">

  <h2>Crear Cátedra</h2>

  <form action="<?php echo RUTA_URL;?>/catedracontroller/agregarCatedra" method="POST">
  
    <div class="form-group">
      <label for="nombre">Nombre: <sup>*</sup></label>
      <input type="text" id="nombre" name="nombre" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="descrip">Descripción: <sup>*</sup></label>
      <input type="text" id="descrip" name="descrip" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="plan">Plan: <sup>*</sup></label>
      <input type="text" id="plan" name="plan" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="ano_cursado">Año de Cursado: <sup>*</sup></label>
      <input type="text" id="ano_cursado" name="ano_cursado" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="hs_semanales">Horas Semanales: <sup>*</sup></label>
      <input type="number" id="hs_semanales" name="hs_semanales" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="tipo_cursado">Tipo de Cursado: <sup>*</sup></label>
      <input type="text" id="tipo_cursado" name="tipo_cursado" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="electiva">Electiva: <sup>*</sup></label>
      <input type="text" id="electiva" name="electiva" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="titulacion">Titulación: <sup>*</sup></label>
      <input type="text" id="titulacion" name="titulacion" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="area_id">Area: <sup>*</sup></label>
      <input type="number" id="area_id" name="area_id" class="form-control form-control-lg">
    </div>

    <input type="submit" class="btn btn-success" value="Crear Cátedra">
  </form>
</div>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>