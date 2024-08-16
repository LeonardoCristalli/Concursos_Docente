<?php 
  $titulo = 'Listar Estados';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto"> 

  <div class="row mb-4 g-0">

    <div class="col-md-1">
      <a href="<?php echo RUTA_URL;?>/paginas/adminPanel" class="btn btn-secondary btn-sm">Volver</a>
    </div>

    <div class="col-md-11">
      <h2>Estados</h2>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark">
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">Descripción</th>           
              <th class="text-center sticky-col" colpasn="2">Acciones</th>
            </tr>              
          </thead>  
          <tbody>
            <?php foreach($datos['estados'] as $estado) : ?>
            <tr>
              <td class="text-center"><?php echo $estado->id; ?></td>
              <td class="text-center"><?php echo $estado->descrip; ?></td>

              <td class="sticky-col actions-cell">
                <a href="<?php echo RUTA_URL; ?>/estadocontroller/editarestado/<?php echo $estado->id; ?>" class="btn btn-warning">Editar</a>
                <form action="<?php echo RUTA_URL;?>/estadocontroller/borrarestado/<?php echo $estado->id; ?>" method="POST">
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

  <div class="row justify-content-center">
    <div class="col-auto">
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <?php if ($datos['totalPaginas'] > 1): ?>
            <?php for($i = 1; $i <= $datos['totalPaginas']; $i++): ?>
              <li class="page-item <?php echo ($i == $datos['paginaActual']) ? 'active' : ''; ?>">
                <a class="page-link" href="<?php echo RUTA_URL; ?>/estadocontroller/listarestados?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
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
        <a href="<?php echo RUTA_URL; ?>/estadocontroller/agregarestado" class="btn btn-primary w-100">Agregar Estado</a>
      </div>
    </div>
  </div>
</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>