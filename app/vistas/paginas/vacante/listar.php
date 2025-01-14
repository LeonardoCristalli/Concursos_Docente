<?php 
  $titulo = "Listar Vacantes";
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container">
  <?php if ($_SESSION['tipo_usu'] !== 'Admin'): ?>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo RUTA_URL; ?>/">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Vacantes</li>
      </ol>
    </nav>
  <?php endif; ?>
  
  <div class="row mb-4">
    <?php if ($_SESSION['tipo_usu'] == 'Admin'): ?>
      <div class="col-md-1">
        <a href="<?php echo RUTA_URL;?>/paginas/adminPanel" class="btn btn-secondary btn-sm">Volver</a>      
      </div>
    <?php endif; ?>
  
    <div class="col-md-8">
      <h2>Vacantes</h2>
    </div>
  
    <div class="col-md-3 text-end">
      <a href="<?php echo RUTA_URL; ?>/vacantecontroller/agregarvacante" class="btn btn-primary">
        Agregar Vacante
      </a>
    </div>
  </div>

  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php foreach($datos['vacantes'] as $vacante): ?>
      <div class="col">
        <div class="card h-100 shadow-sm hover-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <h5 class="card-title mb-0">
                <?php echo htmlspecialchars($vacante->catedra_nombre ?? ''); ?>
              </h5>
              <span class="badge bg-<?php 
                switch($vacante->estado_descrip) {
                  case 'Nueva':
                    echo 'secondary';
                    break;
                  case 'Abierta':
                    echo 'success';
                    break;
                  case 'Cerrada':
                    echo 'danger';
                    break;
                  case 'Evaluada':
                    echo 'warning';
                    break;
                  case 'Publicada':
                    echo 'info';
                    break;
                  case 'Orden de Mérito':
                    echo 'primary';
                    break;
                  default:
                    echo 'secondary';
                }
              ?>">
                <?php echo htmlspecialchars($vacante->estado_descrip ?? ''); ?>
              </span>
            </div>

            <div class="vacancy-details mb-3">
              <p class="mb-1">Descripción: <?php echo htmlspecialchars($vacante->descrip ?? ''); ?></p>
              <p class="mb-1">Fecha Inicio: <?php echo htmlspecialchars($vacante->fecha_ini); ?></p>
              <p class="mb-1">Fecha Fin: <?php echo htmlspecialchars($vacante->fecha_fin); ?></p>
              <p class="mb-1">Requisitos: <?php echo htmlspecialchars($vacante->req); ?></p>
              <p class="mb-1">Tiempo: <?php echo htmlspecialchars($vacante->tiempo); ?></p>
              <p class="mb-1">Experiencia: <?php echo htmlspecialchars($vacante->exp); ?></p>
            </div>

            <div class="d-flex justify-content-end gap-2">
              <button class="btn btn-sm btn-outline-primary" 
                      onclick="window.location.href='<?php echo RUTA_URL; ?>/vacantecontroller/editarvacante/<?php echo $vacante->id; ?>'">
                Editar
              </button>
              <button class="btn btn-sm btn-outline-danger" 
                      onclick="confirmarBorrado(<?php echo $vacante->id; ?>, '<?php echo $vacante->catedra_nombre; ?>')">
                Eliminar
              </button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <?php if ($datos['totalPaginas'] > 1 && $datos['totalPaginas'] > $datos['paginaActual']): ?>
    <div class="text-center mt-4">
      <button id="loadMore" class="btn btn-primary">
        Cargar más vacantes
      </button>
    </div>
  <?php endif; ?>

  <script>
  let paginaActual = <?php echo $datos['paginaActual']; ?>;
  
  document.getElementById('loadMore')?.addEventListener('click', function() {
      paginaActual++;
      fetch(`${RUTA_URL}/vacantecontroller/obtenerMasVacantes?pagina=${paginaActual}`)
          .then(response => response.json())
          .then(data => {
              // Agregar nuevas cards
              const container = document.querySelector('.row.row-cols-1');
              data.vacantes.forEach(vacante => {
                  // Agregar card al contenedor
              });
              
              // Ocultar botón si no hay más páginas
              if (paginaActual >= <?php echo $datos['totalPaginas']; ?>) {
                  this.style.display = 'none';
              }
          });
  });
  </script>
</main>

<!-- Modal de Confirmación -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro que deseas eliminar la vacante <span id="vacanteName"></span>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="deleteForm" action="" method="POST" style="display: inline;">
          <input type="hidden" name="id" id="deleteId">
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function confirmarBorrado(id, nombre) {
  document.getElementById('vacanteName').textContent = nombre;
  document.getElementById('deleteId').value = id;
  document.getElementById('deleteForm').action = '<?php echo RUTA_URL; ?>/vacantecontroller/borrarvacante/' + id;
  
  new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>