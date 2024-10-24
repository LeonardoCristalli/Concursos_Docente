<?php require_once RUTA_APP . '/vistas/inc/header.php'; ?>

<main class="main-container container">

  <div class="row justify-content-between align-items-start">
    
    <!-- Columna de introducción con el banner -->
    <div class="col-md-6 index-intro text-center">
      <h1>UTN: Abierta la inscripción al concurso docente 2024</h1>
      <div>
        <img src="<?php echo RUTA_URL; ?>/img/banner-concursos.jpg" alt="concursos-banner" class="img-fluid rounded shadow">
      </div>
    </div>

    <!-- Fila con las cards de novedades -->
    <div class="col-md-5">
      <div class="row d-flex flex-wrap">
        <!-- Card 1 -->
        <div class="col-md-6 d-flex">
          <div class="card index-card mb-3">
            <img src="<?php echo RUTA_URL; ?>/img/F.Aditiva.png" alt="curso-3d" class="card-img-top">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">Novedades</h5>
              <p class="card-text">Curso de Fabricación Aditiva</p>
              <div class="mt-auto">
                <a href="#" class="btn btn-primary">Ver Más</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-6 d-flex">
          <div class="card index-card mb-3 d-flex flex-column">
            <img src="<?php echo RUTA_URL; ?>/img/angular.png" alt="curso-angular" class="card-img-top">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">Curso Angular</h5>
              <p class="card-text">Detalles sobre el nuevo curso</p>
              <div class="mt-auto">
                <a href="#" class="btn btn-primary">Ver Más</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</main>

<?php require_once RUTA_APP . '/vistas/inc/footer.php'; ?>
