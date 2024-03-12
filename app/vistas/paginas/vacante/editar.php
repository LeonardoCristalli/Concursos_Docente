<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=vacantes" class="btn btn-light"><i class="fa fa-backward"></i>Volver</a>

<div class="card card-body bg-light mt-5">

  <h2>Editar Vacante</h2>

  <form action="<?php echo RUTA_URL;?>/vacantecontroller/editarVacante/<?php echo $datos['id']?>" method="POST">
    
    <div class="form-group">
      <label for="descrip">Descripción: <sup>*</sup></label>
      <input type="text" id="descrip" name="descrip" class="form-control form-control-lg" value="<?php echo $datos['descrip']; ?>">
    </div>

    <div class="form-group">
      <label for="fecha_ini">Fecha de Inicio: <sup>*</sup></label>
      <input type="date" id="fecha_ini" name="fecha_ini" class="form-control form-control-lg" value="<?php echo $datos['fecha_ini']; ?>">
    </div>

    <div class="form-group">
      <label for="fecha_fin">Fecha de Fin: <sup>*</sup></label>
      <input type="date" id="fecha_fin" name="fecha_fin" class="form-control form-control-lg" value="<?php echo $datos['fecha_fin']; ?>">
    </div>

    <div class="form-group">
      <label for="req">Requerimientos: <sup>*</sup></label>
      <input type="text" id="req" name="req" class="form-control form-control-lg" value="<?php echo $datos['req']; ?>">
    </div>

    <div class="form-group">
      <label for="tiempo">Tiempo: <sup>*</sup></label>
      <input type="text" id="tiempo" name="tiempo" class="form-control form-control-lg" value="<?php echo $datos['tiempo']; ?>">
    </div>

    <div class="form-group">
      <label for="exp">Experiencia: <sup>*</sup></label>
      <input type="text" id="exp" name="exp" class="form-control form-control-lg" value="<?php echo $datos['exp']; ?>">
    </div>

    <div class="form-group">
      <label for="motivo_id">Motivo: <sup>*</sup></label>
      <input type="number" id="motivo_id" name="motivo_id" class="form-control form-control-lg" value="<?php echo $datos['motivo_id']; ?>">
    </div>

    <div class="form-group">
      <label for="estado_id">Estado: <sup>*</sup></label>
      <input type="number" id="estado_id" name="estado_id" class="form-control form-control-lg" value="<?php echo $datos['estado_id']; ?>">
    </div>

    <div class="form-group">
      <label for="catedra_id">Cátedra: <sup>*</sup></label>
      <input type="number" id="catedra_id" name="catedra_id" class="form-control form-control-lg" value="<?php echo $datos['catedra_id']; ?>">
    </div>
    
    <input type="submit" class="btn btn-success" value="Editar Vacante">

  </form>  
</div>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>