<?php 
  $titulo = "Orden de Mérito";
  require_once RUTA_APP . '/vistas/inc/header.php'; 
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
    <div class="col-md-4">
      <h2>Vacantes</h2>
      <table class="table table-striped table-hover table-sm">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Cátedra</th>  
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th> 
          </tr>              
        </thead>  
        <tbody>
          <?php $cont = 1; ?>
          <?php if(isset($datos['vacantes']) && !empty($datos['vacantes'])) : ?>
            <?php foreach($datos['vacantes'] as $vacanteDetalle) : ?>
              <tr>
                <th scope="row"><?php echo $cont++; ?></th>
                <td><?php echo $vacanteDetalle->nombre_catedra; ?></td> 
                <td><?php echo !empty($vacanteDetalle->estado_descrip) ? $vacanteDetalle->estado_descrip : 'Estado no disponible'; ?></td>
                <td>
                  <a href="<?php echo RUTA_URL . '/paginas/OMPanel?vacante_id=' . $vacanteDetalle->id; ?>" class="btn btn-primary btn-sm">Gestionar Vacante</a>
                </td> 
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr><td colspan="4">No hay vacantes disponibles.</td></tr> 
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="col-md-8">
      <?php if(isset($datos['vacante_id']) && isset($datos['estado_vacante'])) : ?>
        <?php 
          $estadoId = $datos['estado_vacante'];
          $isEvaluada = $estadoId == 1003; 
          $isCerrada = $estadoId == 3 || isset($_GET['editar']); 
        ?>

        <?php if ($estadoId == 1004) : // Estado "Publicada" ?>
          <h6>La vacante: <?php echo $datos['vacante_descrip']; ?> está publicada.</h6>
          <div class="d-flex justify-content-end mt-3">
            <a href="<?php echo RUTA_URL; ?>/vacanteController/finalizarVacante/<?php echo $datos['vacante_id']; ?>" class="btn btn-danger me-2">Finalizar Vacante</a>
          </div>
        <?php elseif ($isCerrada) : ?>
          <h6>Inscripciones para la vacante: <?php echo $datos['vacante_descrip']; ?></h6>
          <div class="table-responsive" id="inscripciones-vacante">
            <form action="<?php echo RUTA_URL; ?>/inscripcionController/asignarPuntajes" method="POST">
              <input type="hidden" name="vacante_id" value="<?php echo $datos['vacante_id']; ?>">
              <table class="table table-striped table-hover table-sm">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Inscripto</th>
                    <th scope="col">Puntaje</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $cont = 1; ?>
                  <?php foreach ($datos['inscripciones'] as $inscripcion) : ?>
                    <tr>
                      <th scope="row"><?php echo $cont++; ?></th>
                      <td><?php echo $inscripcion->usuario; ?></td>
                      <td>
                        <select id="puntaje_<?php echo $inscripcion->usuario_id; ?>" 
                                name="puntajes[<?php echo $inscripcion->usuario_id; ?>]" 
                                class="form-select" 
                                required>
                          <option value="" disabled selected>Seleccionar</option>
                          <?php for ($i = 1; $i <= count($datos['inscripciones']); $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                          <?php endfor; ?>
                        </select>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-primary" type="submit">Asignar Puntajes</button>
              </div>
            </form>
          </div>
        <?php elseif ($isEvaluada) : ?>
          <h6>Orden de Mérito para la vacante: <?php echo $datos['vacante_descrip']; ?></h6>
          <div class="table-responsive">
            <table class="table table-striped table-hover table-sm">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Inscripto</th>
                  <th scope="col">Puntaje</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php $cont = 1; ?>
                <?php foreach ($datos['inscripciones'] as $inscripcion) : ?>
                  <tr>
                    <th scope="row"><?php echo $cont++; ?></th>
                    <td><?php echo $inscripcion->usuario; ?></td>
                    <td><?php echo $inscripcion->puntaje; ?></td>
                    <td>
                      <?php if ($inscripcion->puntaje == 1): ?>
                        <a href="<?php echo $inscripcion->cv_url; ?>" class="btn btn-info btn-sm" download>Descargar CV</a>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-end mt-3">
            <a href="<?php echo RUTA_URL; ?>/vacanteController/publicarOM/<?php echo $datos['vacante_id']; ?>" class="btn btn-success me-2">Publicar</a>
            <a href="?vacante_id=<?php echo $datos['vacante_id']; ?>&editar=true" class="btn btn-secondary">Actualizar OM</a>
          </div>
        <?php else : ?>
          <div class="alert alert-info">Selecciona una vacante para ver el detalle.</div>
        <?php endif; ?>
      <?php else : ?>
        <div class="alert alert-info">Selecciona una vacante para ver el detalle.</div>
      <?php endif; ?>
    </div>
  </div>
</main>

<script>
  function actualizarOpciones() {
    const selects = document.querySelectorAll('.form-select');
    let valoresSeleccionados = Array.from(selects).map(select => select.value).filter(value => value);

    selects.forEach(select => {
      let opciones = select.querySelectorAll('option');
      opciones.forEach(opcion => {
        if (valoresSeleccionados.includes(opcion.value) && opcion.value !== select.value) {
          opcion.disabled = true;
        } else {
          opcion.disabled = false;
        }
      });
    });
  }

  document.addEventListener('DOMContentLoaded', function() {
    actualizarOpciones();
  });

  document.querySelectorAll('.form-select').forEach(function(select) {
    select.addEventListener('change', actualizarOpciones);
  });
</script>

<script>
  document.querySelector('form').addEventListener('submit', function(event) {
    const selects = document.querySelectorAll('.form-select');
    let valoresSeleccionados = [];
    let valid = true;

    selects.forEach(select => {
      if (select.value) {
        if (valoresSeleccionados.includes(select.value)) {
          valid = false;
        }
        valoresSeleccionados.push(select.value);
      } else {
        valid = false;
      }
    });

    if (!valid) {
      event.preventDefault();
      alert('Todos los puntajes deben ser seleccionados y únicos.');
    }
  });
</script>

<?php require_once RUTA_APP . '/vistas/inc/footer.php'; ?>
