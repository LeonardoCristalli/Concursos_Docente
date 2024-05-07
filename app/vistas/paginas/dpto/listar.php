<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<div class="container fondo">
  <a href="<?php echo RUTA_URL;?>/paginas/adminPanel" class="btn btn-secondary btn-sm">Volver</a>
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="thead-dark">
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">Nombre</th>           
              <th> </th>
              <th> </th>
            </tr>              
          </thead>  
          <tbody>
            <?php foreach($datos['dptos'] as $dpto) : ?>
            <tr>
              <td><?php echo $dpto->id; ?></td>
              <td><?php echo $dpto->nombre; ?></td>
              <td>
                <a href="<?php echo RUTA_URL; ?>/dptocontroller/editarDpto/<?php echo $dpto->id; ?>" class="btn btn-warning">Editar</a>
              </td>
              <td>
                <form action="<?php echo RUTA_URL;?>/dptocontroller/borrarDpto/<?php echo $dpto->id; ?>" method="POST">
                  <input type="hidden" name="id" value="<?php echo $dpto->id; ?>">
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
        <a href="<?php echo RUTA_URL; ?>/dptocontroller/agregarDpto" class="btn btn-primary w-100">
          <i class="bi bi-plus-circle-fill"></i> Crear
        </a>
      </div>
    </div>
  </div>
</div>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>