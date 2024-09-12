<?php 
  $titulo = 'Resultados Publicados'; 
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">
  <?php if (isset($_SESSION['mensaje_exito'])): ?>
    <div class="alert alert-success">
      <?php echo $_SESSION['mensaje_exito']; ?>
    </div>
    <?php unset($_SESSION['mensaje_exito']); ?>
  <?php elseif (isset($_SESSION['mensaje_error'])): ?>
    <div class="alert alert-danger">
      <?php echo $_SESSION['mensaje_error']; ?>
    </div>
    <?php unset($_SESSION['mensaje_error']); ?>
  <?php endif; ?>

  <div class="row">
    <div class="col-md-12">
      <h2>Resultados Publicados</h2>
      <table class="table table-striped table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Cátedra</th>
            <th scope="col">Descripción</th>
            <th scope="col">Fecha de Publicación</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php $cont = 1; ?>
          <?php if (isset($datos['vacantes']) && !empty($datos['vacantes'])) : ?>
            <?php foreach ($datos['vacantes'] as $vacante) : ?>
              <tr>
                <th scope="row"><?php echo $cont++; ?></th>
                <td><?php echo $vacante->nombre_catedra; ?></td>
                <td><?php echo $vacante->descrip; ?></td>
                <td><?php echo date('d-m-Y', strtotime($vacante->fecha_publicacion)); ?></td>
                <td>
                  <a href="<?php echo RUTA_URL . '/paginas/OMPanel?vacante_id=' . $vacante->id; ?>" class="btn btn-info btn-sm">Ver Detalle</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr><td colspan="5">No hay resultados publicados aún.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>
