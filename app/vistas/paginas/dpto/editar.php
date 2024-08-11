<?php 
  $titulo = 'Editar Departamento';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">
  <?php if (!isset($_SESSION['usuario_id'])): ?>

    <div class="row mb-4">
      <div class="col">
        <a href="<?php echo RUTA_URL;?>/paginas/index" class="btn btn-secondary btn-sm">Volver</a>
      </div>
    </div>

  <?php else: ?>
    <div class="row mb-4">
      <div class="col">
        <a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=dptos" class="btn btn-secondary btn-sm">Volver</a>
      </div>
    </div>
  <?php endif; ?>

  <form action="<?php echo RUTA_URL;?>/dptocontroller/editarDpto/<?php echo $datos['id']?>" method="POST">
    <h2 class="mt-3 mb-4">Editar Departamento</h2>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group mb-3">
          <label for="nombre" class="form-label">Nombre:<sup>*</sup></label>
          <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $datos['nombre']; ?>">
        </div>
      </div>
    </div>
    <button class="btn btn-primary" type="submit" name="submit" value="submit">Editar Departamento</button>
  </form>  
</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>