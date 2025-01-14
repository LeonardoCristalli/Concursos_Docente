<?php

define('DB_HOST', '(localdb)\MSSQLLocalDB');
define('DB_USUARIO', 'llamados_vacantes_login');
define('DB_PASSWORD', 'jumba123');
define('DB_NOMBRE', 'llamados_vacantes');

define('RUTA_APP', dirname(dirname(__FILE__)));

// Configuración para ngrok
$protocol = "https";
$host = "3256-2803-9800-98cb-7207-e907-93d0-3291-a741.ngrok-free.app";  // URL de ngrok actual

define('RUTA_URL', $protocol . "://" . $host . '/concursos_docente');

define('NOMBRE_SITIO', 'Concursos Docentes');
date_default_timezone_set('America/Argentina/Buenos_Aires');

function redireccionar($pagina) {
    header('Location: ' . RUTA_URL . $pagina);
    exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);