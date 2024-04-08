<?php require_once RUTA_APP . '/vistas/inc/header.php'; ?>

<div class="container mt-5">
  <h2>Seleccionar Entidad</h2>
  <form action="<?php echo RUTA_URL; ?>/paginas/irAlCRUD" method="GET">
    <div class="form-group">
      <label for="entidad">Entidad:</label>
      <select class="form-control" id="entidad" name="entidad">
        <option value="usuarios">Usuarios</option>
        <option value="dptos">Departamentos</option>
        <option value="areas">Áreas</option>
        <option value="catedras">Cátedras</option>
        <option value="vacantes">Vacantes</option>
        <option value="estados">Estados</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Ir al CRUD</button>
  </form>
</div>

<?php require_once RUTA_APP . '/vistas/inc/footer.php'; ?>
