<?php 
  $titulo = "Nosotros";
  require_once RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo RUTA_URL; ?>/">Inicio</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
    </ol>
  </nav>

  <div class="index-intro text-center mx-auto">
    <p>
      La Universidad Tecnológica Nacional ha sido concebida desde su comienzo como una Institución abierta a todos los hombres capaces de contribuir
      al proceso de desarrollo de la economía argentina, con clara conciencia de su compromiso con el bienestar y la justicia social, su respeto por la ciencia y la cultura, y la necesidad de su aporte al progreso de la Nación y las regiones que la 
      componen, reivindicando los valores imprescriptibles de la libertad y la dignidad del pueblo argentino, y la integración armónica de los sectores sociales que la componen.
    </p>
    <p>
      Preparar profesionales idóneos en el ámbito de la tecnología capaces de actuar con eficiencia, responsabilidad, creatividad, sentido crítico y 
      sensibilidad social, para satisfacer las necesidades del medio socio productivo, y para generar y emprender alternativas innovadoras que 
      promuevan sustentablemente el desarrollo económico nacional y regional, en un marco de justicia y solidaridad social.
    </p>
  </div>
</main>

<?php require_once RUTA_APP . '/vistas/inc/footer.php'; ?>