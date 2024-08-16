<?php 
  $titulo = 'Editar Estado';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">

  <div class="row mb-4 g-0">

    <div class="col-1">
      <a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=estados" class="btn btn-secondary btn-sm">Volver</a>
    </div>

    <div class="col-md-11">
      <h2 class="mt-3 mb-4">Editar Estado</h2>
      <form action="<?php echo RUTA_URL;?>/estadocontroller/editarestado/<?php echo $datos['id']?>" method="POST">        
        <div class="row">
          <div class="col-md-6">

            <div class="form-group mb-3">
              <label for="descrip" class="form-label">Descripción:<sup>*</sup></label>
              <input type="text" id="descrip" name="descrip" class="form-control" value="<?php echo $datos['descrip']; ?>">
            </div>

            <div class="d-flex justify-content-end">
              <button class="btn btn-primary" type="submit" name="submit" value="submit">Editar Estado</button>
            </div>
          </div>
        </div>       
      </form>
    </div>      
  </div>
</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>