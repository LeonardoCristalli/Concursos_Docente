<?php 
  $titulo = "Listar Vacantes";
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">

  <div class="row mb-4 g-0">

    <div class="col-md-1">
      <?php if ($_SESSION['tipo_usu'] == 'Admin'): ?>
        <a href="<?php echo RUTA_URL;?>/paginas/adminPanel" class="btn btn-secondary btn-sm">Volver</a>
      <?php endif; ?>
    </div>
  

    <div class="col-md-11">
      <h2>Vacantes</h2>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark">
            <tr>
              <th class="text-center">ID</th>  
              <th class="text-center">Descripción</th>
              <th class="text-center">Fecha de Inicio</th>
              <th class="text-center">Fecha de Cierre</th>
              <th class="text-center">Requerimientos</th>
              <th class="text-center">Duración</th>
              <th class="text-center">Experiencia</th>
              <th class="text-center">Cátedra</th>        
              <th class="text-center sticky-col" colpasn="2">Acciones</th>
            </tr>              
          </thead>  
          <tbody>
            <?php foreach($datos['vacantes'] as $vacante) : ?>
            <tr>
              <td class="text-center"><?php echo $vacante->id; ?></td>
              <td class="text-center"><?php echo $vacante->descrip; ?></td>
              <td class="text-center"><?php echo $vacante->fecha_ini; ?></td>
              <td class="text-center"><?php echo $vacante->fecha_fin; ?></td>
              <td class="text-center"><?php echo $vacante->req; ?></td>
              <td class="text-center"><?php echo $vacante->tiempo; ?></td>
              <td class="text-center"><?php echo $vacante->exp; ?></td>
              <td class="text-center"><?php echo $vacante->catedra_nombre; ?></td>
              <td class="sticky-col actions-cell">
                <a href="<?php echo RUTA_URL; ?>/vacantecontroller/editarVacante/<?php echo $vacante->id; ?>" class="btn btn-warning">Editar</a>
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
  <div class="row justify-content-center">
    <div class="col-auto">
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <?php if ($datos['totalPaginas'] > 1): ?>
            <?php for($i = 1; $i <= $datos['totalPaginas']; $i++): ?>
              <li class="page-item <?php echo ($i == $datos['paginaActual']) ? 'active' : ''; ?>">
                <a class="page-link" href="<?php echo RUTA_URL; ?>/vacantecontroller/listarvacantes?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
              </li>
            <?php endfor; ?>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </div>

  <div class="row">
    <div class="col-2 offset-10">
      <div>
        <a href="<?php echo RUTA_URL; ?>/vacantecontroller/agregarvacante" class="btn btn-primary w-100">Agregar Vacante</a>
      </div>
    </div>
  </div>
</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>