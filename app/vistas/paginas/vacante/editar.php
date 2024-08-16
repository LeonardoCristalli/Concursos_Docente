<?php
  $titulo = 'Editar Vacante';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">

  <div class="row mb-4 g-0">

    <div class="col-md-1">
      <a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=vacantes" class="btn btn-secondary btn-sm">Volver</a>
    </div>

    <div class="col-md-11">
      <h2>Editar Vacante</h2>
      <form action="<?php echo RUTA_URL;?>/vacanteController/editarvacante/<?php echo $datos['id']?>" method="POST">        
        <div class="row">
          <div class="col-md-6">

            <div class="form-group mb-3">
              <label for="descrip" class="form-label">Descripción: <sup>*</sup></label>
              <textarea id="descrip" name="descrip" class="form-control"><?php echo $datos['descrip']; ?></textarea>
            </div>

            <div class="form-group mb-3">
              <label for="fecha_ini" class="form-label">Fecha de Inicio:<sup>*</sup></label>
              <input type="date" id="fecha_ini" name="fecha_ini" class="form-control" value="<?php echo $datos['fecha_ini']; ?>">
            </div>

            <div class="form-group mb-3">
              <label for="fecha_fin" class="form-label">Fecha de Cierre:<sup>*</sup></label>
              <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" value="<?php echo $datos['fecha_fin']; ?>">
            </div>

            <div class="form-group mb-3">
              <label for="req" class="form-label">Requerimientos:<sup>*</sup></label>
              <textarea id="req" name="req" class="form-control"><?php echo $datos['req']; ?></textarea>
            </div>

            <div class="form-group mb-3">
              <label for="tiempo" class="form-label">Tiempo:<sup>*</sup></label>
              <input type="text" id="tiempo" name="tiempo" class="form-control" value="<?php echo $datos['tiempo']; ?>">
            </div>
          </div>

          <div class="col-md-6">

            <div class="form-group mb-3">
              <label for="exp" class="form-label">Experiencia:<sup>*</sup></label>
              <input type="text" id="exp" name="exp" class="form-control" value="<?php echo $datos['exp']; ?>">
            </div>

            <div class="form-group mb-3">
              <label for="catedra_id" class="form-label">Catedra:<sup>*</sup></label>
              <input type="number" id="catedra_id" name="catedra_id" class="form-control" value="<?php echo $datos['catedra_id']; ?>">
            </div>
            
            <div class="d-flex justify-content-center">
              <button class="btn btn-primary mb-3" type="submit" name="submit" value="submit">Editar Vacante</button>
            </div>

          </div>

        </div>
      </form>
    </div>
  </div>
</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>