<?php 
  $titulo = "Panel de Administrador";
  require_once RUTA_APP . '/vistas/inc/header.php'; ?>

<main class="main-container w-100 m-auto">
  <div class="container">
    <h2>Seleccionar Entidad</h2>
    <form action="<?php echo RUTA_URL; ?>/paginas/irAlCRUD" method="GET">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <label class="input-group-text" for="entidad">Opciones</label>
        </div>
        <select class="custom-select" id="entidad" name="entidad">
          <option selected>Elegir...</option>
          <option value="usuarios">Usuarios</option>
          <option value="dptos">Departamentos</option>
          <option value="areas">Áreas</option>
          <option value="catedras">Cátedras</option>
          <option value="vacantes">Vacantes</option>
          <option value="estados">Estados</option>
          <option value="inscripciones">Inscripciones</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Ir al CRUD</button>
    </form>
  </div>
</main>

<?php require_once RUTA_APP . '/vistas/inc/footer.php'; ?>
