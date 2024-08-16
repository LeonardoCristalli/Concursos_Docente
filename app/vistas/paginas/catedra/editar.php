<?php 
  $titulo = 'Editar Cátedra';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">

  <div class="row mb-4 g-0">

    <div class="col-md-1">
      <a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=catedras" class="btn btn-secondary btn-sm">Volver</a>
    </div>

    <div class="col-md-11">
      <h2 class="mt-3 mb-4">Editar Cátedra</h2>
      <form action="<?php echo RUTA_URL;?>/catedracontroller/editarcatedra/<?php echo $datos['id']?>" method="POST">
        <div class="row">
          <div class="col-md-6">

            <div class="form-group mb-3">
              <label for="nombre" class="form-label">Nombre: <sup>*</sup></label>
              <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $datos['nombre']; ?>">
            </div>

            <div class="form-group mb-3">
              <label for="descrip" class="form-label">Descripción:</label>
              <textarea id="descrip" name="descrip" class="form-control" value="<?php echo $datos['descrip']; ?>"></textarea>
            </div>

            <div class="form-group mb-3">
              <label for="plan" class="form-label">Plan: <sup>*</sup></label>
              <input type="text" id="plan" name="plan" class="form-control" value="<?php echo $datos['plan']; ?>">
            </div>

            <div class="form-group mb-3">
              <label for="ano_cursado" class="form-label">Año de Cursado: <sup>*</sup></label>
              <input type="text" id="ano_cursado" name="ano_cursado" class="form-control" value="<?php echo $datos['ano_cursado']; ?>">
            </div>

            <div class="form-group mb-3">
              <label for="hs_semanales" class="form-label">Horas Semanales: <sup>*</sup></label>
              <input type="number" id="hs_semanales" name="hs_semanales" class="form-control" value="<?php echo $datos['hs_semanales']; ?>">
            </div>

          </div>

          <div class="col-md-6">

            <div class="form-group mb-3">
              <label for="tipo_cursado" class="form-label">Tipo de Cursado: <sup>*</sup></label>
              <input type="text" id="tipo_cursado" name="tipo_cursado" class="form-control" value="<?php echo $datos['tipo_cursado']; ?>">
            </div>

            <div class="form-group mb-3">
              <label for="electiva" class="form-label">Electiva: <sup>*</sup></label>
              <div>
                <label class="radio-inline">
                  <input type="radio" name="electiva" value="1" <?php if ($datos['electiva'] == 1) echo 'checked'; ?>> Sí 
                </label>
                <label class="radio-inline">
                  <input type="radio" name="electiva" value="0" <?php if ($datos['electiva'] == 0) echo 'checked'; ?>> No
                </label>
              </div>
            </div>
            
            <div class="form-group mb-3">
              <label for="area_id" class="form-label">Area: <sup>*</sup></label>
              <input type="number" id="area_id" name="area_id" class="form-control" value="<?php echo $datos['area_id']; ?>">
            </div>

            <div class="d-flex justify-content-end">
              <button class="btn btn-primary" type="submit" name="submit" value="submit">Editar Cátedra</button>
            </div>
            
          </div>
        </div>          
      </form>
    </div>
  </div>
</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>