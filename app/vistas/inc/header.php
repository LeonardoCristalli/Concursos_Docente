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
        <div class="col-lg-6 d-flex align-items-center">   

          <?php if (!isset($_SESSION['usuario_id'])): ?>

            <a href="<?php echo RUTA_URL; ?>">
              <img src="<?php echo RUTA_URL; ?>/img/logo.jpg" alt="Logo de la Facultad" style="width: 80px; height: auto;">
            </a>

            <ul class="nav justify-content-center">
              <li><a href="<?php echo RUTA_URL; ?>/index" class="nav-link text-secondary">Inicio</a></li>
              <li><a href="<?php echo RUTA_URL; ?>/vacanteController/vacanteUsuario" class="nav-link text-white">Vacantes</a></li>
              <li><a href="#" class="nav-link text-white">Sobre Nosotros</a></li>
              <li><a href="#" class="nav-link text-white">Contacto</a></li>
            </ul>

          <?php else: ?>

            <a href="<?php echo RUTA_URL; ?>/index">
              <img src="<?php echo RUTA_URL; ?>/img/logo.jpg" alt="Logo de la Facultad" style="width: 80px; height: auto;">
            </a>

            <?php switch ($_SESSION['tipo_usu']) {              
              case 'Usuario':
            ?>                
                <ul class="nav justify-content-center">
                  <li><a href="<?php echo RUTA_URL; ?>/index" class="nav-link text-secondary">Inicio</a></li>
                  <li><a href="<?php echo RUTA_URL; ?>/vacanteController/vacanteUsuario" class="nav-link text-white">Vacantes</a></li>
                  <li><a href="#" class="nav-link text-white">Sobre Nosotros</a></li>
                  <li><a href="#" class="nav-link text-white">Contacto</a></li>
                </ul>   

            <?php break; 
              case 'RA':
            ?>
                <ul class="nav justify-content-center">
                  <li><a href="<?php echo RUTA_URL; ?>/index" class="nav-link text-secondary">Inicio</a></li>
                  <li><a href="<?php echo RUTA_URL; ?>/paginas/RAPanel" class="nav-link text-white">Vacantes</a></li>
                  <li><a href="#" class="nav-link text-white">Usuarios</a></li>
                  <li><a href="#" class="nav-link text-white">Otro</a></li>
                </ul>     

            <?php break;
              case 'JC':
            ?>
                <ul class="nav justify-content-center">
                  <li><a href="<?php echo RUTA_URL; ?>/index" class="nav-link text-secondary">Inicio</a></li>
                  <li><a href="<?php echo RUTA_URL; ?>/paginas/RAPanel" class="nav-link text-white">Vacantes</a></li>
                  <li><a href="#" class="nav-link text-white">Usuarios</a></li>
                  <li><a href="#" class="nav-link text-white">Otro</a></li>
                </ul>  

            <?php break;
              case 'Admin':
            ?>
                <ul class="nav justify-content-center">
                  <li><a href="<?php echo RUTA_URL; ?>/index" class="nav-link text-secondary">Inicio</a></li>
                  <li><a href="<?php echo RUTA_URL; ?>/paginas/RAPanel" class="nav-link text-white">Vacantes</a></li>
                  <li><a href="#" class="nav-link text-white">Usuarios</a></li>
                  <li><a href="#" class="nav-link text-white">Otro</a></li>
                </ul>  

            <?php break;
              default:
            ?>
                <ul class="nav justify-content-center">
                  <li><a href="<?php echo RUTA_URL; ?>/index" class="nav-link text-secondary">Inicio</a></li>
                  <li><a href="<?php echo RUTA_URL; ?>/vacanteController/vacanteUsuario" class="nav-link text-white">Vacantes</a></li>
                  <li><a href="#" class="nav-link text-white">Sobre Nosotros</a></li>
                  <li><a href="#" class="nav-link text-white">Contacto</a></li>
                </ul>
                
            <?php break;  
              } 
            ?>
          <?php endif; ?>
        </div>

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
                    <li><a class="dropdown-item" href="<?php echo RUTA_URL; ?>/usuarioController/editarUsuario/<?php echo $_SESSION['usuario_id']; ?>">Perfil</a></li>
                    <li><a class="dropdown-item" href="<?php echo RUTA_URL; ?>/paginas/logout">Cerrar Sesión</a></li>
                  </ul>
              </div>
            </div>          
          <?php endif; ?>
        </div>

      </div>
    </div>
  </header>