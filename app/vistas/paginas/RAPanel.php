<?php 
  $titulo = "Panel Administrativo";
  require_once RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">
  <div class="row">
    <div class="col-md-4">
      <h2>Vacantes</h2>
      <table class="table table-striped table-hover table-sm">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Catedra</th>  
            <th scope="col">Estado</th>
            <th scope="col"></th>
          </tr>              
        </thead>  
        <tbody>
          <?php $cont = 1; ?>
          <?php if(isset($_SESSION['vacantesDetalles'])) : ?>
            <?php foreach($_SESSION['vacantesDetalles'] as $vacanteDetalle) : ?>
              <tr>
                <th scope="row"><?php echo $cont; ?></th>
                <td>
                  <a href="<?php echo RUTA_URL . '/inscripcionController/obtenerDetallesInscripPorVacanteId/' . $vacanteDetalle->id; ?>">
                    <?php echo $vacanteDetalle->nombre_catedra; ?>
                  </a>
                </td>
                <td><?php echo $vacanteDetalle->estado_descrip; ?></td>
              </tr>
              <?php $cont++; ?>
            <?php endforeach; ?>
          <?php else : ?>
            <tr>
              <td colspan="3">No hay vacantes disponibles.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="col-md-8">
      <div class="table-responsive" id="inscripciones-vacante">
        <h2>Inscripciones</h2>
        <table class="table table-striped table-hover table-sm">
           <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Usuario</th>              
              <th scope="col">Fecha de Inscripción</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($datos['inscripciones']) && !empty($datos['inscripciones'])) : ?>
              <?php $cont = 1; ?>
              <?php foreach ($datos['inscripciones'] as $inscripcion) : ?>
                <tr>
                  <th scope="row"><?php echo $cont; ?></th>
                  <td><?php echo $inscripcion->usuario; ?></td>
                  <td><?php echo $inscripcion->fecha; ?></td>
                  <td>
                    <a href="<?php echo RUTA_URL;?>/usuarioController/descargarCV/<?php echo $inscripcion->cv; ?>"  class="btn btn-sm btn-dark">
                      Descargar CV
                    </a>                  
                  </td>
                </tr>
                <?php $cont++; ?>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="3">No hay inscripciones para esta vacante.</td>
              </tr>
            <?php endif; ?>
          </tbody>  
        </table>
      </div>
    </div>
  </div>
</main>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var inscripcionesVacante = document.getElementById("inscripciones-vacante");

    <?php if(!isset($datos['inscripciones'])) : ?>

    if (inscripcionesVacante) {
      inscripcionesVacante.style.display = "none";
    }

    <?php endif; ?>
  });
</script>

<?php require_once RUTA_APP . '/vistas/inc/footer.php'; ?>
