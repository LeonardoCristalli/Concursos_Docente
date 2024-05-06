<?php 
  $titulo = 'Listar Inscripciones';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">

  <div class="row mb-4">
    <div class="col">
      <a href="<?php echo RUTA_URL;?>/paginas/adminPanel" class="btn btn-secondary btn-sm">Volver</a>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-10">
      <h2>Inscripciones</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="thead-dark">
            <tr>
              <th class="text-center">Vacante ID</th>  
              <th class="text-center">Usuario ID</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Puntaje</th>    
              <th> </th>
              <th> </th>
            </tr>              
          </thead>  
          <tbody>
            <?php foreach($datos['inscripciones'] as $inscripcion) : ?>
            <tr>
              <td><?php echo $inscripcion->vacante_id; ?></td>
              <td><?php echo $inscripcion->usuario_id; ?></td>
              <td><?php echo $inscripcion->fecha; ?></td>
              <td><?php echo $inscripcion->puntaje; ?></td>
           
              <td><a href="<?php echo RUTA_URL; ?>/inscripcionController/editarInscripcion/<?php echo $inscripcion->vacante_id; ?>/<?php echo $inscripcion->usuario_id; ?>">Editar</a></td>
              <td>
                <form action="<?php echo RUTA_URL;?>/inscripcionController/borrarInscripcion/<?php echo $inscripcion->vacante_id; ?>/<?php echo $inscripcion->usuario_id; ?>" method="POST">
                  <input type="hidden" name="vacante_id" value="<?php echo $inscripcion->vacante_id; ?>">
                  <input type="hidden" name="usuario_id" value="<?php echo $inscripcion->usuario_id; ?>">
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
        <a href="<?php echo RUTA_URL; ?>/inscripcionController/agregarInscripcion" class="btn btn-primary w-100">Crear</a>
      </div>
    </div>
  </div>
</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>