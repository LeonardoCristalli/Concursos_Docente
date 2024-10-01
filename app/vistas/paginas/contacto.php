<?php 
  $titulo = "Contacto";
  require_once RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo RUTA_URL; ?>/">Inicio</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
    </ol>
  </nav>

  <div class="index-intro mb-5 text-center mx-auto">
    <h2>LLAMADO A CONCURSOS DOCENTES: </h2>
    <p>
      Mail: concursos@frro.utn.edu.ar
    </p>
  </div>

</main>

<?php require_once RUTA_APP . '/vistas/inc/footer.php'; ?>