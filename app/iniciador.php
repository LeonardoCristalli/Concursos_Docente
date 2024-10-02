<?php

session_start();

require_once 'config/configurar.php';

spl_autoload_register(function($nombreClase) {
  require_once 'librerias/' .$nombreClase. '.php';
});