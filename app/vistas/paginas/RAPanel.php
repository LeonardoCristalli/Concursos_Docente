<?php 
  $titulo = "Panel Administrativo";
  require_once RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo RUTA_URL; ?>/">Inicio</a></li>
      <li class="breadcrumb-item active" aria-current="page">Inscriptos</li>
    </ol>
  </nav>

  <div class="row">
    <!-- Lista de vacantes -->
    <div class="col-md-4">
      <h2>Vacantes</h2>
      <div class="list-group">
        <?php if(isset($datos['vacantesDetalles']) && is_array($datos['vacantesDetalles'])): ?>
          <?php foreach($datos['vacantesDetalles'] as $vacante): ?>
            <a href="<?php echo RUTA_URL; ?>/inscripcioncontroller/obtenerDetallesInscripPorVacanteId/<?php echo $vacante->id; ?>" 
               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
              <div>
                <h6 class="mb-1"><?php echo htmlspecialchars($vacante->catedra_nombre); ?></h6>
                <small class="text-muted">ID: <?php echo $vacante->id; ?></small>
              </div>
              <span class="badge bg-<?php 
                switch($vacante->estado_descrip) {
                  case 'Nueva': echo 'secondary'; break;
                  case 'Abierta': echo 'success'; break;
                  case 'Cerrada': echo 'danger'; break;
                  case 'Evaluada': echo 'warning'; break;
                  case 'Publicada': echo 'info'; break;
                  default: echo 'secondary';
                }
              ?>">
                <?php echo $vacante->estado_descrip; ?>
              </span>
            </a>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="alert alert-info">
            No hay vacantes disponibles
          </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Panel de inscripciones -->
    <div class="col-md-8">
      <?php if(isset($datos['inscripciones'])): ?>
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">Inscripciones</h5>
          </div>
          <div class="card-body">
            <?php if(empty($datos['inscripciones'])): ?>
              <div class="alert alert-info">
                No hay inscripciones para esta vacante
              </div>
            <?php else: ?>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Postulante</th>
                      <th>Usuario</th>
                      <th>Fecha</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($datos['inscripciones'] as $inscripcion): ?>
                      <tr>
                        <td><?php echo $inscripcion->nombre . ' ' . $inscripcion->apellido; ?></td>
                        <td><?php echo $inscripcion->usuario; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($inscripcion->fecha)); ?></td>
                        <td>
                          <a href="<?php echo RUTA_URL; ?>/usuariocontroller/descargarCV/<?php echo $inscripcion->usuario_id; ?>" 
                             class="btn btn-sm btn-outline-primary">Ver CV</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php else: ?>
        <div class="text-center p-5 text-muted">
          <h4>Seleccione una vacante para ver sus inscripciones</h4>
        </div>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php require_once RUTA_APP . '/vistas/inc/footer.php'; ?>