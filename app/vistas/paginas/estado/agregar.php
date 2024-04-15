<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=estados" class="btn btn-light">Volver</a>

<div class="card card-body bg-light mt-5">

  <h2>Crear Estado</h2>

  <form action="<?php echo RUTA_URL;?>/estadocontroller/agregarEstado" method="POST">
  
    <div class="form-group">
      <label for="descrip">Descripción: <sup>*</sup></label>
      <input type="text" id="descrip" name="descrip" class="form-control form-control-lg">
    </div>
    
    <button type="submit" name="submit" value="submit">Crear Estado</button>
  </form>
</div>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>