<?php
  require_once 'config/Configurar.php';
  
  require_once 'helpers/url_helper.php';

  spl_autoload_register(function($nombreClase) {
    require_once 'librerias/' .$nombreClase. '.php';
  });