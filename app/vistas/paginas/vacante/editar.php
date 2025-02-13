<?php
  $titulo = 'Editar Vacante';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">

  <?php if ($_SESSION['tipo_usu'] !== 'Admin'): ?>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo RUTA_URL; ?>/">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=vacantes">Vacantes</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar Vacante</li>
      </ol>
    </nav>
  <?php endif; ?>

  <div class="row mb-4 g-0">

    <?php if ($_SESSION['tipo_usu'] == 'Admin'): ?>
      <div class="col-md-1">
        <a href="<?php echo RUTA_URL;?>/paginas/irAlCRUD?entidad=vacantes" class="btn btn-secondary btn-sm">Volver</a>
      </div>
    <?php endif; ?>

    <div class="col-md-11">
      <h2>Editar Vacante</h2>
      <form action="<?php echo RUTA_URL;?>/vacanteController/editarvacante/<?php echo $datos['id']?>" method="POST">
        <div class="row">
          <div class="col-md-6">

            <div class="form-group mb-3">
              <label for="descrip" class="form-label">Descripción: <sup>*</sup></label>
              <textarea id="descrip" name="descrip" class="form-control"><?php echo $datos['descrip']; ?></textarea>
            </div>

            <div class="form-group mb-3">
              <label for="fecha_ini" class="form-label">Fecha de Inicio:<sup>*</sup></label>
              <input type="date" id="fecha_ini" name="fecha_ini" class="form-control" value="<?php echo $datos['fecha_ini']; ?>">
            </div>

            <div class="form-group mb-3">
              <label for="fecha_fin" class="form-label">Fecha de Cierre:<sup>*</sup></label>
              <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" value="<?php echo $datos['fecha_fin']; ?>">
            </div>

            <div class="form-group mb-3">
              <label for="req" class="form-label">Requerimientos:<sup>*</sup></label>
              <textarea id="req" name="req" class="form-control"><?php echo $datos['req']; ?></textarea>
            </div>

            <div class="form-group mb-3">
              <label for="tiempo" class="form-label">Tiempo:<sup>*</sup></label>
              <input type="text" id="tiempo" name="tiempo" class="form-control" value="<?php echo $datos['tiempo']; ?>">
            </div>
          </div>

          <div class="col-md-6">

            <div class="form-group mb-3">
              <label for="exp" class="form-label">Experiencia:<sup>*</sup></label>
              <input type="text" id="exp" name="exp" class="form-control" value="<?php echo $datos['exp']; ?>">
            </div>

            <div class="form-group mb-3">
              <label for="catedra_id" class="form-label">Catedra:<sup>*</sup></label>
              <select id="catedra_id" name="catedra_id" class="form-select">
                <?php foreach ($datos['catedras'] as $catedra): ?>
                  <?php if ($catedra->id == $datos['catedra_id']): ?>
                    <option value="<?php echo $catedra->id; ?>" selected>
                      <?php echo htmlspecialchars($catedra->nombre); ?>
                    </option>
                  <?php else: ?>
                    <option value="<?php echo $catedra->id; ?>">
                      <?php echo htmlspecialchars($catedra->nombre); ?>
                    </option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
            
            <div class="d-flex justify-content-center">
              <button class="btn btn-primary mb-3" type="submit" name="submit" value="submit">Editar Vacante</button>
            </div>

          </div>

        </div>
      </form>
    </div>
  </div>
</main>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>