<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<div class="container fondo">
  <a href="<?php echo RUTA_URL;?>/paginas" class="btn btn-light"><i class="fa fa-backward"></i>Volver</a>
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="thead-dark">
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">Nombre</th>     
              <th class="text-center">Departamento</th>        
              <th> </th>
              <th> </th>
            </tr>              
          </thead>  
          <tbody>
            <?php foreach($datos['areas'] as $area) : ?>
            <tr>
              <td><?php echo $area->id; ?></td>
              <td><?php echo $area->nombre; ?></td>
              <td><?php echo $area->dpto_id; ?></td>
                            
              <td><a href="<?php echo RUTA_URL; ?>/areacontroller/editarArea/<?php echo $area->id; ?>">Editar</a></td>
              <td>
                <form action="<?php echo RUTA_URL;?>/areacontroller/borrarArea/<?php echo $area->id; ?>" method="POST">
                  <input type="hidden" name="id" value="<?php echo $area->id; ?>">
                  <input type="submit" class="btn btn-danger" value="Borrar">
                </form>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-2 offset-10">
      <div>
        <a href="<?php echo RUTA_URL; ?>/areacontroller/agregarArea" class="btn btn-primary w-100">
          <i class="bi bi-plus-circle-fill"></i> Crear
        </a>
      </div>
    </div>
  </div>
</div>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>