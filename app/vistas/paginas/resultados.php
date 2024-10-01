<?php 
  $titulo = 'Resultados Publicados'; 
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo RUTA_URL; ?>/">Inicio</a></li>
      <li class="breadcrumb-item active" aria-current="page">Resultados</li>
    </ol>
  </nav>
  
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
    <div class="col-md-4">
      <h2>Vacantes Publicadas</h2>
      <table class="table table-striped table-hover table-sm">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Cátedra</th>  
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
                <td>
                  <a href="?vacante_id=<?php echo $vacante->id; ?>" class="btn btn-info btn-sm">Ver Detalle</a>
                </td> 
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr><td colspan="3">No hay vacantes disponibles.</td></tr> 
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="col-md-8">
      <?php if (isset($datos['vacante_id']) && !empty($datos['inscripciones'])) : ?>
        <h2>Orden de Mérito para: <?php echo $datos['vacanteDetalles']->nombre_catedra; ?></h2>
        <div class="table-responsive mb-4">
          <table class="table table-striped table-hover table-sm">
            <thead class="thead-dark">
              <tr>
                <th scope="col">N°</th>
                <th scope="col">Inscripto</th>
                <th scope="col">Email</th>
              </tr>
            </thead>
            <tbody>
              <?php $cont = 1; ?>
              <?php foreach ($datos['inscripciones'] as $inscripcion) : ?>
                <tr>
                  <th scope="row"><?php echo $cont++; ?></th>
                  <td><?php echo $inscripcion->nombre; ?></td>
                  <td><?php echo $inscripcion->email; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else : ?>
        <div class="alert alert-info">Selecciona una vacante para ver el detalle.</div>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var inscripcionesVacante = document.getElementById("inscripciones-vacante");

    <?php if(!isset($datos['inscripciones']) || empty($datos['inscripciones'])) : ?>
      if (inscripcionesVacante) {
        inscripcionesVacante.style.display = "none";
      }
    <?php else: ?>
      if (inscripcionesVacante) {
        inscripcionesVacante.style.display = "block";
      }
    <?php endif; ?>
  });
</script>

