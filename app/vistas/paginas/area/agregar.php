<?php 
  $titulo = 'Crear Área';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>
<main class="main-container w-100 m-auto">

  <div class="row mb-4 g-0">

    <div class="col-md-1">
      <?php if (!isset($_SESSION['usuario_id'])): ?>
        <a href="<?php echo RUTA_URL;?>/paginas/index" class="btn btn-secondary btn-sm">Volver</a>
      <?php else: ?>
        <a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=areas" class="btn btn-secondary btn-sm">Volver</a>
      <?php endif; ?>
    </div>
        
    <div class="col-md-11">   
      <h2 class="mt-3 mb-4">Crear Área</h2>    
      <form action="<?php echo RUTA_URL;?>/areacontroller/agregararea" method="POST">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="nombre" class="form-label">Nombre:<sup>*</sup></label>
              <input type="text" id="nombre" name="nombre" class="form-control">
            </div>

            <div class="form-group mb-3">
              <label for="dpto_id">Departamento: <sup>*</sup></label>
              <input type="number" id="dpto_id" name="dpto_id" class="form-control form-control-lg">
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