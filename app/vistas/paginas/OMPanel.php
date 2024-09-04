<?php 
  $titulo = "Orden de Mérito";
  require_once RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">
  <div class="row">
    <!-- Sección de Vacantes -->
    <div class="col-md-4">
      <h2>Vacantes</h2>
      <table class="table table-striped table-hover table-sm">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Cátedra</th>  
            <th scope="col">Estado</th>
          </tr>              
        </thead>  
        <tbody>
          <?php $cont = 1; ?>
          <?php if(isset($_SESSION['vacantesDetalles'])) : ?>
            <?php foreach($_SESSION['vacantesDetalles'] as $vacanteDetalle) : ?>
              <tr>
                <th scope="row"><?php echo $cont++; ?></th>
                <td>
                  <!-- Enlace para gestionar la vacante -->
                  <a href="<?php echo RUTA_URL . '/inscripcionController/obtenerDetallesParaOMPanel/' . $vacanteDetalle->id; ?>" class="btn btn-primary btn-sm">
                    Gestionar Vacante
                  </a>
                </td>
                <td><?php echo $vacanteDetalle->estado_descrip; ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr>
              <td colspan="3">No hay vacantes disponibles.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Sección de Inscripciones y Asignación de Puntajes -->
    <div class="col-md-8">
      <?php if (isset($datos['inscripciones']) && !empty($datos['inscripciones'])) : ?>
        <div class="table-responsive" id="inscripciones-vacante">
          <h2>Inscripciones para <?php echo $datos['vacante_nombre']; ?></h2>
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

    // Recoge los valores seleccionados
    for (let i = 1; i <= totalInscripciones; i++) {
      let select = document.getElementById('puntaje_' + i);
      if (select) {
        let selectedValue = select.value;
        if (selectedValue) {
          valoresSeleccionados.push(selectedValue);
        }
      }
    }

    // Actualiza las opciones disponibles en cada select
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
    actualizarOpciones(); // Inicializa el formulario con las opciones correctas
  });
</script>

<?php require_once RUTA_APP . '/vistas/inc/footer.php'; ?>
