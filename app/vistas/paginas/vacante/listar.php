<?php 
  $titulo = "Listar Vacantes";
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">

  <div class="row mb-4">
    <div class="col">
      <?php if ($_SESSION['tipo_usu'] == 'Admin'): ?>
        <a href="<?php echo RUTA_URL;?>/paginas/adminPanel" class="btn btn-secondary btn-sm">Volver</a>
      <?php endif; ?>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="thead-dark">
            <tr>
              <th class="text-center">ID</th>  
              <th class="text-center">Descripción</th>
              <th class="text-center">Fecha de Inicio</th>
              <th class="text-center">Fecha de Cierre</th>
              <th class="text-center">Requerimientos</th>
              <th class="text-center">Duración</th>
              <th class="text-center">Experiencia</th>
              <th class="text-center">Estado</th>
              <th class="text-center">Cátedra</th>        
              <th> </th>
              <th> </th>
            </tr>              
          </thead>  
          <tbody>
            <?php foreach($datos['vacantes'] as $vacante) : ?>
            <tr>
              <td><?php echo $vacante->id; ?></td>
              <td><?php echo $vacante->descrip; ?></td>
              <td><?php echo $vacante->fecha_ini; ?></td>
              <td><?php echo $vacante->fecha_fin; ?></td>
              <td><?php echo $vacante->req; ?></td>
              <td><?php echo $vacante->tiempo; ?></td>
              <td><?php echo $vacante->exp; ?></td>
              <td><?php echo $vacante->estado_descrip; ?></td>
              <td><?php echo $vacante->nombre_catedra; ?></td>
              <td>
                <a href="<?php echo RUTA_URL; ?>/vacantecontroller/editarVacante/<?php echo $vacante->id; ?>" class="btn btn-warning">
                  Editar
                </a>
              </td>
              <td>
                <form action="<?php echo RUTA_URL;?>/vacantecontroller/borrarVacante/<?php echo $vacante->id; ?>" method="POST">
                  <input type="hidden" name="id" value="<?php echo $vacante->id; ?>">
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
        <a href="<?php echo RUTA_URL; ?>/vacantecontroller/agregarVacante" class="btn btn-primary w-100">
          <i class="bi bi-plus-circle-fill"></i> Crear
        </a>
      </div>
    </div>
  </div>
</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>