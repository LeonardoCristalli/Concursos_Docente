<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=estados" class="btn btn-light"><i class="fa fa-backward"></i>Volver</a>

<div class="card card-body bg-light mt-5">

  <h2>Editar Estados</h2>

  <form action="<?php echo RUTA_URL;?>/estadocontroller/editarEstado/<?php echo $datos['id']?>" method="POST">

    <div class="form-group">
      <label for="descrip">Descripción: <sup>*</sup></label>
      <input type="text" id="descrip" name="descrip" class="form-control form-control-lg" value="<?php echo $datos['descrip']; ?>">
    </div>
    
    <input type="submit" class="btn btn-success" value="Editar Estado">

  </form>  
</div>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>