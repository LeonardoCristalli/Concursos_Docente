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
              <th class="text-center">Descripción</th>
              <th class="text-center">Plan</th>
              <th class="text-center">Año de Cursado</th>
              <th class="text-center">Hs Semanales</th>
              <th class="text-center">Tipo de Cursado</th>
              <th class="text-center">Electiva</th>
              <th class="text-center">Titulación</th>        
              <th> </th>
              <th> </th>
            </tr>              
          </thead>  
          <tbody>
            <?php foreach($datos['catedras'] as $catedra) : ?>
            <tr>
              <td><?php echo $catedra->id; ?></td>
              <td><?php echo $catedra->nombre; ?></td>
              <td><?php echo $catedra->descrip; ?></td>
              <td><?php echo $catedra->plan; ?></td>
              <td><?php echo $catedra->ano_cursado; ?></td>
              <td><?php echo $catedra->hs_semanales; ?></td>
              <td><?php echo $catedra->tipo_cursado; ?></td>
              <td><?php echo $catedra->electiva; ?></td>
              <td><?php echo $catedra->titulacion; ?></td>
              <td><?php echo $catedra->area_id; ?></td>
                            
              <td><a href="<?php echo RUTA_URL; ?>/catedracontroller/editarCatedra/<?php echo $catedra->id; ?>">Editar</a></td>
              <td>
                <form action="<?php echo RUTA_URL;?>/catedracontroller/borrarCatedra/<?php echo $catedra->id; ?>" method="POST">
                  <input type="hidden" name="id" value="<?php echo $catedra->id; ?>">
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
        <a href="<?php echo RUTA_URL; ?>/catedracontroller/agregarCatedra" class="btn btn-primary w-100">
          <i class="bi bi-plus-circle-fill"></i> Crear
        </a>
      </div>
    </div>
  </div>
</div>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>