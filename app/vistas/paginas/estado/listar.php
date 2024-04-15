<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<div class="container fondo">
  <a href="<?php echo RUTA_URL;?>/paginas/adminPanel" class="btn btn-light">Volver</a>
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="thead-dark">
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">Descripción</th>           
              <th> </th>
              <th> </th>
            </tr>              
          </thead>  
          <tbody>
            <?php foreach($datos['estados'] as $estado) : ?>
            <tr>
              <td><?php echo $estado->id; ?></td>
              <td><?php echo $estado->descrip; ?></td>              
                            
              <td><a href="<?php echo RUTA_URL; ?>/estadocontroller/editarEstado/<?php echo $estado->id; ?>">Editar</a></td>
              <td>
                <form action="<?php echo RUTA_URL;?>/estadocontroller/borrarEstado/<?php echo $estado->id; ?>" method="POST">
                  <input type="hidden" name="id" value="<?php echo $estado->id; ?>">
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
        <a href="<?php echo RUTA_URL; ?>/estadocontroller/agregarEstado" class="btn btn-primary w-100">
          <i class="bi bi-plus-circle-fill"></i> Crear
        </a>
      </div>
    </div>
  </div>
</div>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>