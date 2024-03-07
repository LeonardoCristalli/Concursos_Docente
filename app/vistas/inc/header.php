<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo isset($titulo) ? $titulo : 'Concursos_Docentes'; ?></title>

    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/css/estilos.css">
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container">
          <a class="navbar-brand" href="<?php echo RUTA_URL; ?>">Concursos Docentes</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </nav>
    </header>