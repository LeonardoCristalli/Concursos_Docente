<?php 

define('DB_HOST', '(localdb)\MSSQLLocalDB');
define('DB_USUARIO', 'llamados_vacantes_login');
define('DB_PASSWORD', 'jumba123');
define('DB_NOMBRE', 'llamados_vacantes');

define('RUTA_APP', dirname(dirname(__FILE__)));
define('RUTA_URL', 'http://localhost/Concursos_Docente');
define('NOMBRE_SITIO', 'Concursos Docentes');
date_default_timezone_set('America/Argentina/Buenos_Aires');

function redireccionar($pagina) {
  header('Location: ' . RUTA_URL . $pagina);
  exit; 
}