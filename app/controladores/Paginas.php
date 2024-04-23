<?php

class Paginas extends Controlador {

  public function __construct() {            
    $this->usuarioModelo = $this->modelo('Usuario');
    $this->dptoModelo = $this->modelo('Dpto');
    $this->areaModelo = $this->modelo('Area');
    $this->catedraModelo = $this->modelo('Catedra');
    $this->vacanteModelo = $this->modelo('Vacante');
    $this->estadoModelo = $this->modelo('Estado');
    $this->inscripcionModelo = $this->modelo('Inscripcion');
  } 

  public function index() {
    $this->vista('paginas/index');
  }

  public function login() {
    $this->vista('paginas/login');
  }

  public function logout() {
    session_start();
    session_unset();
    session_destroy();
    $this->vista('paginas/index');
  }

  public function adminPanel() {

    session_start();

    if (!isset($_SESSION['usuario_id'])) {
      redireccionar('/paginas/login');
    }

    $this->vista('paginas/adminPanel');
  }

  public function listarVacantes() {
    $vacantes = $this->vacanteModelo->obtenerVacantes();
    $datos = [
      'vacantes' => $vacantes
    ];

    $this->vista('paginas/vacante/listar', $datos);
  }

  public function irAlCRUD() {

    session_start();

    if (!isset($_SESSION['usuario_id'])) {
      redireccionar('/paginas/index');
    }

    if(isset($_GET['entidad'])) {

      $entidad = $_GET['entidad'];

      switch($entidad) {

        case 'usuarios':
          $usuarios = $this->usuarioModelo->obtenerUsuarios();
          $datos = [
            'usuarios' => $usuarios
          ];

          $this->vista('paginas/usuario/listar', $datos);
        break;

        case 'dptos':
          $dptos = $this->dptoModelo->obtenerDptos();
          $datos = [
            'dptos' => $dptos
          ];

          $this->vista('paginas/dpto/listar', $datos);
        break;

        case 'areas':
          $areas = $this->areaModelo->obtenerAreas();
          $datos = [
            'areas' => $areas
          ];

          $this->vista('paginas/area/listar', $datos);
        break;

        case 'catedras':
          $catedras = $this->catedraModelo->obtenerCatedras();
          $datos = [
            'catedras' => $catedras
          ];

          $this->vista('paginas/catedra/listar', $datos);
        break;

        case 'estados':
          $estados = $this->estadoModelo->obtenerEstados();
          $datos = [
            'estados' => $estados
          ];

          $this->vista('paginas/estado/listar', $datos);
        break;

        case 'vacantes':
          $vacantes = $this->vacanteModelo->obtenerVacantes();
          $datos = [
            'vacantes' => $vacantes
          ];

          $this->vista('paginas/vacante/listar', $datos);
        break;

        default:
          redireccionar('/paginas');
        break;
      }
    } else {
      redireccionar('/paginas');
    }
  }
  
  public function inscripcion() {
    session_start();
    $usuario_id = $_SESSION['usuario_id'];
    $date = date('Y-m-d');
    $vacante_id = isset($_GET['vacante_id']) ? $_GET['vacante_id'] : null;

    if ($vacante_id !== null) {
      $datos = [
        'vacante_id' => $vacante_id,
        'usuario_id' => $usuario_id,
        'fecha' => $date,
      ];

      if ($this->inscripcionModelo->crearInscripcion($datos)) {
      
      } else {
        die('No se pudo crear la inscripción');
      }
    } else {
      die ('Falta el parámetro vacante_id en la URL');
    }
  }
}

?>