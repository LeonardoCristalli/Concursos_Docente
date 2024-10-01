<?php
  $titulo = 'Listar Cátedras';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto"> 

  <div class="row mb-4 g-0">

    <div class="col-md-1">
      <a href="<?php echo RUTA_URL;?>/paginas/adminPanel" class="btn btn-secondary btn-sm">Volver</a>
    </div>

    <div class="col-md-11">
      <h2>Cátedras</h2>
      <div class="table-responsive mb-4">
        <table class="table table-striped">
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
              <th class="text-center">ID Área</th>
              <th class="text-center sticky-col" colpasn="2">Acciones</th>
            </tr>              
          </thead>  
          <tbody>
            <?php foreach($datos['catedras'] as $catedra) : ?>
            <tr>
              <td class="text-center"><?php echo $catedra->id; ?></td>
              <td class="text-center"><?php echo $catedra->nombre; ?></td>
              <td class="text-center"><?php echo $catedra->descrip; ?></td>
              <td class="text-center"><?php echo $catedra->plan; ?></td>
              <td class="text-center"><?php echo $catedra->ano_cursado; ?></td>
              <td class="text-center"><?php echo $catedra->hs_semanales; ?></td>
              <td class="text-center"><?php echo $catedra->tipo_cursado; ?></td>
              <td class="text-center"><?php echo $catedra->electiva; ?></td>
              <td class="text-center"><?php echo $catedra->area_id; ?></td>

              <td class="sticky-col actions-cell">
                <a href="<?php echo RUTA_URL; ?>/catedracontroller/editarcatedra/<?php echo $catedra->id; ?>" class="btn btn-warning">Editar</a>
                <form action="<?php echo RUTA_URL;?>/catedracontroller/borrarcatedra/<?php echo $catedra->id; ?>" method="POST">
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

  <div class="row justify-content-center">
    <div class="col-auto">
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <?php if ($datos['totalPaginas'] > 1): ?>
            <?php for($i = 1; $i <= $datos['totalPaginas']; $i++): ?>
              <li class="page-item <?php echo ($i == $datos['paginaActual']) ? 'active' : ''; ?>">
                <a class="page-link" href="<?php echo RUTA_URL; ?>/catedracontroller/listarcatedras?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
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
        <a href="<?php echo RUTA_URL; ?>/catedracontroller/agregarcatedra" class="btn btn-primary w-100">Agregar Cátedra</a>
      </div>
    </div>
  </div>
</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>