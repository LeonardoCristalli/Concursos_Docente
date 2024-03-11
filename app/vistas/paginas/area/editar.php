<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=areas" class="btn btn-light"><i class="fa fa-backward"></i>Volver</a>

<div class="card card-body bg-light mt-5">

  <h2>Editar Área</h2>

  <form action="<?php echo RUTA_URL;?>/areacontroller/editarArea/<?php echo $datos['id']?>" method="POST">
    
    <div class="form-group">
      <label for="nombre">Nombre: <sup>*</sup></label>
      <input type="text" id="nombre" name="nombre" class="form-control form-control-lg" value="<?php echo $datos['nombre']; ?>">
    </div>

    <div class="form-group">
      <label for="dpto_id">Departamento: <sup>*</sup></label>
      <input type="number" id="dpto_id" name="dpto_id" class="form-control form-control-lg" value="<?php echo $datos['dpto_id']; ?>">
    </div>
    
    <input type="submit" class="btn btn-success" value="Editar Área">

  </form>  
</div>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>