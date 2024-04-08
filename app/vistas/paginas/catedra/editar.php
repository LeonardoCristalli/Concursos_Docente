<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<main class="main-container w-100 m-auto">

  <div class="row mb-4">
    <div class="col">
      <a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=catedras" class="btn btn-secondary btn-sm">Volver</a>
    </div>
  </div>

  <form action="<?php echo RUTA_URL;?>/catedracontroller/editarCatedra/<?php echo $datos['id']?>" method="POST" class="form-signup">

    <h2 class="mt-3 mb-4">Editar Cátedra</h2>
    
    <div class="row">
      <div class="col-md-6">

        <div class="form-group">
          <label for="nombre">Nombre: <sup>*</sup></label>
          <input type="text" id="nombre" name="nombre" class="form-control form-control-lg" value="<?php echo $datos['nombre']; ?>">
        </div>

        <div class="form-group">
          <label for="descrip">Descripción:</label>
          <textarea id="descrip" name="descrip" class="form-control" value="<?php echo $datos['descrip']; ?>"></textarea>
        </div>

        <div class="form-group">
          <label for="plan">Plan: <sup>*</sup></label>
          <input type="text" id="plan" name="plan" class="form-control form-control-lg" value="<?php echo $datos['plan']; ?>">
        </div>

        <div class="form-group">
          <label for="ano_cursado">Año de Cursado: <sup>*</sup></label>
          <input type="text" id="ano_cursado" name="ano_cursado" class="form-control form-control-lg" value="<?php echo $datos['ano_cursado']; ?>">
        </div>

        <div class="form-group">
          <label for="hs_semanales">Horas Semanales: <sup>*</sup></label>
          <input type="number" id="hs_semanales" name="hs_semanales" class="form-control form-control-lg" value="<?php echo $datos['hs_semanales']; ?>">
        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group">
          <label for="tipo_cursado">Tipo de Cursado: <sup>*</sup></label>
          <input type="text" id="tipo_cursado" name="tipo_cursado" class="form-control form-control-lg" value="<?php echo $datos['tipo_cursado']; ?>">
        </div>

        <div class="form-group">
          <label for="electiva">Electiva: <sup>*</sup></label>
          <div>
            <label class="radio-inline">
              <input type="radio" name="electiva" value="1" <?php if ($datos['electiva'] == 1) echo 'checked'; ?>> Sí 
            </label>
            <label class="radio-inline">
              <input type="radio" name="electiva" value="0" <?php if ($datos['electiva'] == 0) echo 'checked'; ?>> No
            </label>
          </div>
        </div>
        
        <div class="form-group">
          <label for="area_id">Area: <sup>*</sup></label>
          <input type="number" id="area_id" name="area_id" class="form-control form-control-lg" value="<?php echo $datos['area_id']; ?>">
        </div>

      </div>
    </div>

    <button type="submit" name="submit" value="submit" class="btn btn-success">Editar Cátedra</button>
  </form>

</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>