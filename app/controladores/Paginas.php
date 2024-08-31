<?php
require_once RUTA_APP . '/controladores/UsuarioController.php';
require_once RUTA_APP . '/controladores/DptoController.php';
require_once RUTA_APP . '/controladores/AreaController.php';
require_once RUTA_APP . '/controladores/CatedraController.php';
require_once RUTA_APP . '/controladores/VacanteController.php';
require_once RUTA_APP . '/controladores/EstadoController.php';

class Paginas extends Controlador {
  private $usuarioModelo;
  private $dptoModelo;
  private $areaModelo;
  private $catedraModelo;
  private $vacanteModelo;
  private $estadoModelo;
  private $inscripcionModelo;

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
    session_start();
    $this->vista('paginas/index');
  }

  public function login() {
    session_start();

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
    session_start();

    $vacantes = $this->vacanteModelo->obtenerVacantes();
    $datos = [
      'vacantes' => $vacantes
    ];

    $this->vista('paginas/vacante/listar', $datos);
  }

  public function listarInscripciones() {
    session_start();

    $inscripciones = $this->inscripcionModelo->obtenerInscripciones();
    $datos = [
      'inscripciones' => $inscripciones
    ];

    $this->vista('paginas/inscripcion/listar', $datos);
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
          $usuarioController = new UsuarioController();  
          $usuarioController->listarUsuarios();
        break;

        case 'dptos':
          $dptoController = new DptoController();  
          $dptoController->listarDptos();
        break;

        case 'areas':
          $areaController = new AreaController();  
          $areaController->listarAreas();
        break;

        case 'catedras':
          $catedraController = new CatedraController();  
          $catedraController->listarCatedras();
        break;

        case 'estados':
          $estadoController = new EstadoController();  
          $estadoController->listarEstados();
        break;

        case 'vacantes':
          $vacanteController = new VacanteController();  
          $vacanteController->listarVacantes();
        break;

        case 'inscripciones':
          $inscripciones = $this->inscripcionModelo->obtenerInscripciones();
          $datos = [
            'inscripciones' => $inscripciones
          ];

          $this->vista('paginas/inscripcion/listar', $datos);
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

    $usuario = $this->usuarioModelo->obtenerUsuarioId($usuario_id);

    if(!empty($usuario->cv)) {

      $file_path = 'C:\xampp\htdocs\Concursos_Docente\public\uploads\\' . $usuario->cv;

      if (file_exists($file_path)) {

        $vacante_id = isset($_GET['vacante_id']) ? $_GET['vacante_id'] : null;

        if ($vacante_id !== null) {

          if ($this->inscripcionModelo->estaInscripto($usuario_id, $vacante_id)) {
            $vacantes = $this->vacanteModelo->obtenerVacantesAbiertas();
            $_SESSION['vacantes'] = $vacantes;
            redireccionar('/vacantecontroller/vacanteusuario?toast=yaInscripto');
          } else {
            $datos = [
              'vacante_id' => $vacante_id,
              'usuario_id' => $usuario_id,
              'fecha' => $date,
            ];

            if ($this->inscripcionModelo->crearInscripcion($datos)) {
              $vacantes = $this->vacanteModelo->obtenerVacantesAbiertas();
              $_SESSION['vacantes'] = $vacantes;
              redireccionar('/vacantecontroller/vacanteusuario?toast=exito');
            } else {
              die('No se pudo crear la inscripción');
            }
          }
        } else {
          die ('Falta el parámetro vacante_id en la URL');
        }

      } else {
        die ('No se encuentra el cv en la dirección almacenada');
      }

    } else {
      $vacantes = $this->vacanteModelo->obtenerVacantesAbiertas();
      $_SESSION['vacantes'] = $vacantes;
      redireccionar('/vacantecontroller/vacanteusuario?toast=error');
    }
  }

  public function RAPanel() {
    session_start();

    if (!isset($_SESSION['vacantesDetalles'])) {
      $_SESSION['vacantesDetalles'] = $this->vacanteModelo->obtenerDetalleVacantes();
    }

    $this->vista('paginas/RAPanel');
  }

   public function about() {
    session_start();

    $this->vista('paginas/about');
   }

   public function contacto() {
    session_start();

    $this->vista('paginas/contacto');
   }

   public function recuperarPW() {
    $this->vista('paginas/forgotPW');
   }

}