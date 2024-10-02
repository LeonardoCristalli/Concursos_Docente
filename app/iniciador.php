<?php

session_start();

require_once 'config/configurar.php';

spl_autoload_register(function($nombreClase) {
  $archivo = 'librerias/' . $nombreClase . '.php';
  if (file_exists($archivo)) {
    require_once $archivo;
  } else {
    die("La clase {$nombreClase} no existe.");
  }
});