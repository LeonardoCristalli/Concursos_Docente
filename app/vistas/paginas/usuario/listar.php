<?php 
  $titulo = 'Listar Usuarios';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto"> 
  
  <?php if (isset($_SESSION['mensaje_exito'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?php echo $_SESSION['mensaje_exito']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['mensaje_exito']); ?>
  <?php endif; ?>

  <div class="row mb-4">
    <div class="col-md-1">
      <a href="<?php echo RUTA_URL;?>/paginas/adminPanel" class="btn btn-secondary btn-sm">Volver</a>
    </div>
    
    <div class="col-md-8">
      <h2>Usuarios</h2>
    </div>

    <div class="col-md-3 text-end">
      <a href="<?php echo RUTA_URL; ?>/usuariocontroller/agregarUsuario" class="btn btn-primary">
        Agregar Usuario
      </a>
    </div>
  </div>

  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php foreach($datos['usuarios'] as $usuario): ?>
      <div class="col">
        <div class="card h-100 shadow-sm hover-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <h5 class="card-title mb-0">
                <?php echo htmlspecialchars($usuario->nombre . ' ' . $usuario->apellido); ?>
              </h5>
              <span class="badge bg-<?php 
                switch($usuario->tipo_usu) {
                  case 'Admin':
                    echo 'danger';  // rojo
                    break;
                  case 'RA':
                    echo 'warning'; // amarillo
                    break;
                  case 'JC':
                    echo 'success'; // verde
                    break;
                  default:
                    echo 'info';    // azul - para Usuario normal
                }
              ?>">
                <?php echo htmlspecialchars($usuario->tipo_usu); ?>
              </span>
            </div>

            <div class="user-details mb-3">
              <p class="mb-1">Email: <?php echo htmlspecialchars($usuario->email); ?></p>
              <p class="mb-1">Tel: <?php echo htmlspecialchars($usuario->telefono); ?></p>
              <p class="mb-1">DNI: <?php echo htmlspecialchars($usuario->nro_dni); ?></p>
            </div>

            <div class="d-flex justify-content-end gap-2">
              <button class="btn btn-sm btn-outline-primary" 
                      onclick="window.location.href='<?php echo RUTA_URL; ?>/usuariocontroller/editarUsuario/<?php echo $usuario->id; ?>'">
                Editar
              </button>
              <button class="btn btn-sm btn-outline-danger" 
                      onclick="confirmarBorrado(<?php echo $usuario->id; ?>, '<?php echo $usuario->nombre . ' ' . $usuario->apellido; ?>')">
                Eliminar
              </button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>

<!-- Modal de Confirmación -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ¿Estás seguro que deseas eliminar al usuario <span id="userName"></span>?
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
</div>

<!-- Toast para mensajes -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto">Notificación</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" id="toastMessage"></div>
  </div>
</div>

<script>
function confirmarBorrado(id, nombre) {
  document.getElementById('userName').textContent = nombre;
  document.getElementById('deleteId').value = id;
  document.getElementById('deleteForm').action = '<?php echo RUTA_URL; ?>/usuariocontroller/borrarUsuario/' + id;
  
  new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

document.addEventListener('DOMContentLoaded', function() {
  const urlParams = new URLSearchParams(window.location.search);
  const toast = urlParams.get('toast');
  
  if (toast) {
    const toastElement = document.getElementById('liveToast');
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastElement);
    const toastMessage = document.getElementById('toastMessage');
    
    switch(toast) {
      case 'usuarioCreado':
        toastMessage.textContent = 'Usuario creado exitosamente';
        break;
    }
    
    toastBootstrap.show();
  }
});
</script>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>
