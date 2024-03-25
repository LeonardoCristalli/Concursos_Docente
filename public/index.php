<?php
  require_once '../app/iniciador.php';
  $iniciar = new Core;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> <?php echo isset($titulo) ? $titulo : 'Inicio'; ?> </title>
  <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/css/estilos.css">
</head>
<body>

<header>
  <nav>
    <div class="container">  
      <div class="logo-container">
        <a class="navbar-brand mr-auto" href="<?php echo RUTA_URL; ?>">
          <img class="logo" src="<?php echo RUTA_URL; ?>/img/logo.jpg" alt="Logo de la Facultad">
        </a>
      </div>
      <ul class="menu-main">
        <li><a href="<?php echo RUTA_URL; ?>/index">HOME</a></li>
        <li><a href="#">ABOUT</a></li>
        <li><a href="#">CONTACT</a></li>                        
      </ul>
    </div>
    <ul class="menu-member">
      <li><a href="<?php echo RUTA_URL; ?>/paginas/signup">SIGN UP</a></li>
      <li><a href="<?php echo RUTA_URL; ?>/paginas/login" class="header-login-a">LOGIN</a></li>
    </ul>
  </nav>
</header>
<section class="index-intro">
  <div class="index-intro-bg">
    <div class="wrapper">
      <div class="index-intro-c1">
        <div class="video"></div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque dignissimos labore nihil ex corporis repudiandae ea optio quidem iste, itaque quibusdam dolorum, animi corrupti assumenda adipisci deleniti atque omnis earum.</p>
      </div>
      <div class="index-intro-c2">
        <h2>We make<br/>professionals</h2>
        <a href="#">NEWS HERE</a>
      </div>
  </div>
</section>