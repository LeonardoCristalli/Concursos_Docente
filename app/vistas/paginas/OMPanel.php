<?php 
  $titulo = "Orden de Mérito";
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
            <th scope="col">Cátedra</th>  
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th> 
          </tr>              
        </thead>  
        <tbody>
          <?php $cont = 1; ?>
          <?php if(isset($_SESSION['vacantesDetalles'])) : ?>
            <?php foreach($_SESSION['vacantesDetalles'] as $vacanteDetalle) : ?>
              <tr>
                <th scope="row"><?php echo $cont++; ?></th>
                <td><?php echo $vacanteDetalle->nombre_catedra; ?></td> 
                <td><?php echo $vacanteDetalle->estado_descrip; ?></td>
                <td>
                  <a href="<?php echo RUTA_URL . '/inscripcionController/obtenerDetallesParaOMPanel/' . $vacanteDetalle->id; ?>" class="btn btn-primary btn-sm">Gestionar Vacante</a>
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
      <?php if (isset($datos['inscripciones']) && !empty($datos['inscripciones'])) : ?>
        <div class="d-flex justify-content-between mb-3">
          <h2>Inscripciones para la vacante <?php echo $datos['vacante_descrip']; ?></h2> 
          <div class="p-3 mb-2 bg-light rounded shadow-sm">
            <h5 class="mb-1">Cátedra: <?php echo $datos['nombre_catedra']; ?></h5>
            <p class="mb-1">Fecha de Inicio: <?php echo $datos['fecha_ini']; ?></p>
            <p class="mb-1">Fecha de Cierre: <?php echo $datos['fecha_fin']; ?></p>
            <p class="mb-1">Requerimientos: <?php echo $datos['req']; ?></p>
          </div>
        </div>

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
                      <div class="form-group">
                        <select id="puntaje_<?php echo $inscripcion->usuario_id; ?>" 
                                name="puntajes[<?php echo $inscripcion->usuario_id; ?>]" 
                                class="form-select" 
                                required 
                                onchange="actualizarOpciones()">
                          <option value="" disabled selected>Seleccionar</option>
                          <?php for ($i = 1; $i <= count($datos['inscripciones']); $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                          <?php endfor; ?>
                        </select>
                      </div>
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
      <?php else : ?>
        <div class="alert alert-info">Selecciona una vacante para asignar puntajes.</div>
      <?php endif; ?>
    </div>
  </div>
</main>

<script>
  function actualizarOpciones() {
    const totalInscripciones = <?php echo count($datos['inscripciones']); ?>;
    let valoresSeleccionados = [];
    for (let i = 1; i <= totalInscripciones; i++) {
      let select = document.getElementById('puntaje_' + i);
      if (select) {
        let selectedValue = select.value;
        if (selectedValue) {
          valoresSeleccionados.push(selectedValue);
        }
      }
    }

    for (let i = 1; i <= totalInscripciones; i++) {
      let select = document.getElementById('puntaje_' + i);
      if (select) {
        let opciones = select.options;
        for (let j = 1; j <= totalInscripciones; j++) {
          opciones[j].disabled = valoresSeleccionados.includes(opciones[j].value) && opciones[j].value !== select.value;
        }
      }
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    actualizarOpciones();
  });
</script>

<?php require_once RUTA_APP . '/vistas/inc/footer.php'; ?>
