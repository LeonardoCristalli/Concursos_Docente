<?php

define('DB_HOST', '(localdb)\MSSQLLocalDB');
define('DB_USUARIO', 'llamados_vacantes_login');
define('DB_PASSWORD', 'jumba123');
define('DB_NOMBRE', 'llamados_vacantes');

define('RUTA_APP', dirname(dirname(__FILE__)));

// Configuración para ngrok
$protocol = "https";
$host = "d581-190-2-112-143.ngrok-free.app"; // Actualiza esta línea cada vez que reinicies ngrok

define('RUTA_URL', $protocol . "://" . $host . '/concursos_docente');

define('NOMBRE_SITIO', 'Concursos Docentes');
date_default_timezone_set('America/Argentina/Buenos_Aires');

function redireccionar($pagina) {
    header('Location: ' . RUTA_URL . $pagina);
    exit;
}

// Habilitar visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);