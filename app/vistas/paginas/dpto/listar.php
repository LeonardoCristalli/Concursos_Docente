<?php 
  $titulo = 'Listar Departamentos';
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
      <h2>Departamentos</h2>
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

  <div class="row justify-content-center">
    <div class="col-auto">
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <?php if ($datos['totalPaginas'] > 1): ?>
            <?php for($i = 1; $i <= $datos['totalPaginas']; $i++): ?>
              <li class="page-item <?php echo ($i == $datos['paginaActual']) ? 'active' : ''; ?>">
                <a class="page-link" href="?entidad=dptos&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
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
        <a href="<?php echo RUTA_URL; ?>/dptocontroller/agregarDpto" class="btn btn-primary w-100">Agregar Dpto</a>
      </div>
    </div>
  </div>
</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>