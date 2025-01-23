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
  private $uploadPath; 

  public function __construct() {            
    $this->usuarioModelo = $this->modelo('Usuario');
    $this->dptoModelo = $this->modelo('Dpto');
    $this->areaModelo = $this->modelo('Area');
    $this->catedraModelo = $this->modelo('Catedra');
    $this->vacanteModelo = $this->modelo('Vacante');
    $this->estadoModelo = $this->modelo('Estado');
    $this->inscripcionModelo = $this->modelo('Inscripcion');
    $this->uploadPath = RUTA_APP . '/uploads/';
  } 

  public function index() {
    $this->vista('paginas/index');
  }

  public function login() {
    $this->vista('paginas/login');
  }

  public function logout() {
    session_unset();
    session_destroy();
    $this->vista('paginas/index');
  }

  public function adminPanel() {
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

  public function listarInscripciones() {
    $inscripciones = $this->inscripcionModelo->obtenerInscripciones();
    $datos = [
      'inscripciones' => $inscripciones
    ];

    $this->vista('paginas/inscripcion/listar', $datos);
  }

  public function irAlCRUD() {
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
    $usuario_id = $_SESSION['usuario_id'];
    $date = date('Y-m-d');

    $usuario = $this->usuarioModelo->obtenerUsuarioId($usuario_id);

    if(!empty($usuario->cv)) {
      $file_path = $this->uploadPath . $usuario->cv;

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
    if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usu'] !== 'RA' && $_SESSION['tipo_usu'] !== 'JC') {
      redireccionar('/');
    }

    $usuarioId = $_SESSION['usuario_id'];
    $tipoUsuario = $_SESSION['tipo_usu'];
    $vacantes = [];

    if ($tipoUsuario === 'RA') {
      $vacantes = $this->vacanteModelo->obtenerVacantes();
    } elseif ($tipoUsuario === 'JC') {
      $vacantes = $this->vacanteModelo->obtenerVacantesPorUsuarioId($usuarioId);
    }
    
    $datos = [
      'vacantesDetalles' => $vacantes
    ];

    $this->vista('paginas/RAPanel', $datos);
  }

  public function about() {
    $this->vista('paginas/about');
  }

  public function contacto() {
    $this->vista('paginas/contacto');
  }

  public function recuperarPW() {
    $this->vista('paginas/forgotPW');
  }

  public function OMPanel() {
    $usuarioId = $_SESSION['usuario_id'];
    $vacantesCerradasEvaluadas = $this->vacanteModelo->obtenerVacantesCerradasEvaluadasPublicadasPorJefeCatedraId($usuarioId);

    $vacanteSeleccionada = null;
    $inscripciones = [];
    $vacante_descrip = null;
    $estadoVacante = null;

    if (isset($_GET['vacante_id'])) {
      $vacante_id = $_GET['vacante_id'];
      $vacanteSeleccionada = $this->vacanteModelo->obtenerVacanteId($vacante_id);
      $inscripciones = $this->inscripcionModelo->obtenerDetallesInscripPorVacanteId($vacante_id);
      $vacante_descrip = $vacanteSeleccionada ? $vacanteSeleccionada->descrip : null;
      $estadoVacante = $vacanteSeleccionada ? $vacanteSeleccionada->estado_id : null;
      
    }

    usort($inscripciones, function($a, $b) {
      return $a->puntaje <=> $b->puntaje; 
    });

    $datos = [
      'vacantes' => $vacantesCerradasEvaluadas,
      'inscripciones' => $inscripciones,     
      'vacante_descrip' => $vacante_descrip,
      'vacante_id' => $vacanteSeleccionada ? $vacanteSeleccionada->id : null,
      'estado_vacante' => $estadoVacante
    ];

    $this->vista('paginas/OMPanel', $datos);
  }

  public function resultados() {
    
    $vacantesPublicadas = $this->vacanteModelo->obtenerVacantesPublicadas();
    $vacanteId = isset($_GET['vacante_id']) ? $_GET['vacante_id'] : null;
    $vacanteDetalles = [];
    $inscripciones = [];

    if ($vacanteId) {
      $vacanteDetalles = $this->vacanteModelo->obtenerVacanteId($vacanteId);
      $inscripciones = $this->inscripcionModelo->obtenerOMPorVacanteId($vacanteId);
    }
    
    $datos = [
      'vacantes' => $vacantesPublicadas,
      'vacanteDetalles' => $vacanteDetalles,
      'inscripciones' => $inscripciones,
      'vacante_id' => $vacanteId
    ];

    $this->vista('paginas/resultados', $datos);
  }
  
}