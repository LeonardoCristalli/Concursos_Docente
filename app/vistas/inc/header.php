<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo isset($titulo) ? $titulo : 'Inicio'; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/css/estilos.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
  <header class="bg-dark text-white py-3">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 d-flex align-items-center">

          <a href="<?= RUTA_URL; ?>">
            <img src="<?= RUTA_URL; ?>/img/Logo_UTN.png" alt="Logo de la Facultad" class="img-fluid" style="max-width: 80px;">
          </a>

          <?php if (!isset($_SESSION['usuario_id'])): ?>

            <nav class="ms-3">
              <ul class="nav">
                <li class="nav-item"><a href="<?php echo RUTA_URL; ?>/index" class="nav-link text-secondary">Inicio</a></li>
                <li class="nav-item"><a href="<?php echo RUTA_URL; ?>/vacanteController/vacanteUsuario" class="nav-link text-white">Vacantes</a></li>
                <li class="nav-item"><a href="<?php echo RUTA_URL; ?>/paginas/about" class="nav-link text-white">Sobre Nosotros</a></li>
                <li class="nav-item"><a href="<?php echo RUTA_URL; ?>/paginas/contacto" class="nav-link text-white">Contacto</a></li>
              </ul>
            </nav>

          <?php else: ?>
            <?php switch ($_SESSION['tipo_usu']) {              
              case 'Usuario':
            ?>                
              <ul class="nav justify-content-center">
                <li><a href="<?php echo RUTA_URL; ?>/index" class="nav-link text-secondary">Inicio</a></li>
                <li><a href="<?php echo RUTA_URL; ?>/vacantecontroller/vacanteusuario" class="nav-link text-white">Vacantes</a></li>
                <li><a href="<?php echo RUTA_URL; ?>/paginas/resultados" class="nav-link text-white">Resultados</a></li>
                <li><a href="<?php echo RUTA_URL; ?>/paginas/about" class="nav-link text-white">Sobre Nosotros</a></li>
                <li><a href="<?php echo RUTA_URL; ?>/paginas/contacto" class="nav-link text-white">Contacto</a></li>

              </ul>   

            <?php break; 
              case 'RA':
            ?>
              <ul class="nav justify-content-center">
                <li><a href="<?php echo RUTA_URL; ?>/index" class="nav-link text-secondary">Inicio</a></li>
                <li><a href="<?php echo RUTA_URL; ?>/paginas/RAPanel" class="nav-link text-white">Inscripciones</a></li>                  
                <li><a href="<?php echo RUTA_URL; ?>/paginas/irAlCRUD?entidad=vacantes" class="nav-link text-white">Vacantes</a></li>
              </ul>

            <?php break;
              case 'JC':
            ?>
              <ul class="nav justify-content-center">
                <li><a href="<?php echo RUTA_URL; ?>/index" class="nav-link text-secondary">Inicio</a></li>
                <li><a href="<?php echo RUTA_URL; ?>/paginas/RAPanel" class="nav-link text-white">Vacantes</a></li>
                <li><a href="<?php echo RUTA_URL; ?>/paginas/OMPanel" class="nav-link text-white">Orden de Mérito</a></li>
                <li><a href="<?php echo RUTA_URL; ?>/paginas/resultados" class="nav-link text-white">Resultados</a></li>
              </ul>  

            <?php break;
              case 'Admin':
            ?>
              <ul class="nav justify-content-center">
                <li><a href="<?php echo RUTA_URL; ?>/paginas/adminPanel" class="nav-link text-secondary">Inicio</a></li>
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
        <div class="col-md-6 d-flex justify-content-end align-items-center">
          <form class="me-3">
            <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
          </form>
          <?php if (!isset($_SESSION['usuario_id'])): ?>
            <div class="btn-group">
              <a href="<?php echo RUTA_URL; ?>/paginas/login" class="btn btn-outline-light me-2">Iniciar sesión</a>
              <a href="<?php echo RUTA_URL; ?>/usuarioController/agregarUsuario" class="btn btn-warning">Registrarse</a>
            </div>
          <?php else: ?>
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ajustes
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="<?php echo RUTA_URL; ?>/usuarioController/editarUsuario/<?php echo $_SESSION['usuario_id']; ?>">Perfil</a></li>
                <li><a class="dropdown-item" href="<?php echo RUTA_URL; ?>/paginas/logout">Cerrar Sesión</a></li>
              </ul>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>
