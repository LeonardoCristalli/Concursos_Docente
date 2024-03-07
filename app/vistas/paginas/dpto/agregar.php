<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<a href="<?php echo RUTA_URL;?>/paginas/dpto/listar" class="btn btn-light"><i class="fa fa-backward"></i>Volver</a>

<div class="card card-body bg-light mt-5">

  <h2>Crear Departamento</h2>

  <form action="<?php echo RUTA_URL;?>/paginas/agregarDpto" method="POST">
  
    <div class="form-group">
      <label for="nombre">Nombre: <sup>*</sup></label>
      <input type="text" id="nombre" name="nombre" class="form-control form-control-lg">
    </div>

    <input type="submit" class="btn btn-success" value="Crear Departamento">
  </form>
</div>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>