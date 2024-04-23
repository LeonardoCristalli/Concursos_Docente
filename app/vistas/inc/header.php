<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> <?php echo isset($titulo) ? $titulo : 'Inicio'; ?> </title>
  <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/css/estilos.css">
</head>
<body>

  <header class="text-bg-dark">
    <div class="container">
      <div class="row align-items-center">
        
        <!-- Sección izquierda -->
        <div class="col-lg-6 d-flex align-items-center">
          <a href="<?php echo RUTA_URL; ?>">
            <img src="<?php echo RUTA_URL; ?>/img/logo.jpg" alt="Logo de la Facultad" style="width: 80px; height: auto;">
          </a>
          <ul class="nav justify-content-center">
            <li><a href="<?php echo RUTA_URL; ?>/index" class="nav-link text-secondary">Home</a></li>
            <li><a href="<?php echo RUTA_URL; ?>/vacanteController/vacanteUsuario" class="nav-link text-white">Vacantes</a></li>
            <li><a href="#" class="nav-link text-white">Sobre Nosotros</a></li>
            <li><a href="#" class="nav-link text-white">Contacto</a></li>
          </ul>
        </div>

        <!-- Sección derecha -->
        <div class="col-lg-6 d-flex justify-content-end align-items-center">
          <form class="col-lg-auto me-3">
            <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
          </form>
          <?php if (!isset($_SESSION['usuario_id'])): ?>            
            <div class="col-lg-auto">
              <a href="<?php echo RUTA_URL; ?>/paginas/login" class="btn btn-outline-light me-2">Login</a>
              <a href="<?php echo RUTA_URL; ?>/usuarioController/agregarUsuario" class="btn btn-warning">Sign-up</a>
            </div>  
          <?php else: ?>
            <div class="col-lg-auto">
              <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Ajustes
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="">Perfil</a></li>
                    <li><a class="dropdown-item" href="<?php echo RUTA_URL; ?>/paginas/logout">Cerrar Sesión</a></li>
                  </ul>
              </div>
            </div>          
          <?php endif; ?>
        </div>

      </div>
    </div>
  </header>