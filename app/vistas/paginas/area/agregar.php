<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=areas" class="btn btn-light"><i class="fa fa-backward"></i>Volver</a>

<div class="card card-body bg-light mt-5">

  <h2>Crear Área</h2>

  <form action="<?php echo RUTA_URL;?>/areacontroller/agregarArea" method="POST">
  
    <div class="form-group">
      <label for="nombre">Nombre: <sup>*</sup></label>
      <input type="text" id="nombre" name="nombre" class="form-control form-control-lg">
    </div>

    <div class="form-group">
      <label for="dpto_id">Departamento: <sup>*</sup></label>
      <input type="number" id="dpto_id" name="dpto_id" class="form-control form-control-lg">
    </div>
    
    <br/>
    <button type="submit" name="submit" value="submit">Crear Área</button>
  </form>
</div>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>