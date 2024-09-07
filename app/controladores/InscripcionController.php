<?php 

class InscripcionController extends Controlador {
  private $inscripcionModelo;
  private $vacanteModelo;

  public function __construct() {
    $this->inscripcionModelo = $this->modelo('Inscripcion');
    $this->vacanteModelo = $this->modelo('Vacante');
  }

  public function agregarInscripcion() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {        

      $datos = [
        'vacante_id' => trim($_POST['vacante_id']),  
        'usuario_id' => trim($_POST['usuario_id']),
        'fecha' => trim($_POST['fecha']),
        'puntaje' => trim($_POST['puntaje']),  
      ];

      if ($this->inscripcionModelo->agregarInscripcion($datos)) {

        $inscripciones = $this->inscripcionModelo->obtenerInscripciones();
        $datos = [
          'inscripciones' => $inscripciones,            
        ];

        $this->vista('paginas/inscripcion/listar', $datos);
          
      } else {
        die ('No se pudo agregar la Inscripción');
      }          
    } else {
      $datos = [
        'vacante_id' => '',       
        'usuario_id' => '',
        'fecha' => '',
        'puntaje' => '', 
      ];

      $this->vista('paginas/inscripcion/agregar', $datos);
    }
  }

  public function editarInscripcion($vacante_id, $usuario_id) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $datos = [
        'vacante_id' => $vacante_id,
        'usuario_id' => $usuario_id,
        'fecha' => trim($_POST['fecha']),
        'puntaje' => trim($_POST['puntaje']),     
      ];

      if ($this->inscripcionModelo->actualizarInscripcion($datos)) {  

        $inscripciones = $this->inscripcionModelo->obtenerInscripciones();
        $datos = [
          'inscripciones' => $inscripciones
        ];

        $this->vista('paginas/inscripcion/listar', $datos);

      } else {
        die('Algo salio mal');        
      }

    } else {
      $inscripcion = $this->inscripcionModelo->obtenerInscripcionId($vacante_id, $usuario_id);
      $datos = [
        'vacante_id' => $inscripcion->vacante_id,
        'usuario_id' => $inscripcion->usuario_id,          
        'fecha' => $inscripcion->fecha,
        'puntaje' => $inscripcion->puntaje,
      ];

      $this->vista('paginas/inscripcion/editar', $datos);
    }
  }

  public function borrarInscripcion($vacante_id, $usuario_id) {

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      
      $vacante_id = $_POST['vacante_id'];
      $usuario_id = $_POST['usuario_id'];

      if($this->inscripcionModelo->borrarInscripcion($vacante_id, $usuario_id)) {
        $inscripciones = $this->inscripcionModelo->obtenerInscripciones();
        $datos = [
          'inscripciones' => $inscripciones
        ];

        $this->vista('paginas/inscripcion/listar', $datos);
      } else {
        die('Algo salio mal');
      }
    }
  }

  public function obtenerDetallesInscripPorVacanteId($vacante_id) {
    session_start();

    $inscripciones = $this->inscripcionModelo->obtenerDetallesInscripPorVacanteId($vacante_id);
    $datos = [
      'inscripciones' => $inscripciones
    ];

    $this->vista('paginas/RAPanel', $datos);
  }
  
  public function asignarPuntajes() {
    session_start();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $vacanteId = filter_input(INPUT_POST, 'vacante_id', FILTER_SANITIZE_NUMBER_INT);
      $puntajes = filter_input(INPUT_POST, 'puntajes', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
        
      if ($vacanteId && !empty($puntajes)) {
        foreach ($puntajes as $usuarioId => $puntaje) {
            if (!$this->inscripcionModelo->asignarPuntaje($vacanteId, $usuarioId, $puntaje)) {
                $_SESSION['mensaje_error'] = "Hubo un problema al asignar los puntajes. Por favor, intente nuevamente.";
                redireccionar('/paginas/OMPanel');
                return;
            }
        }

        $_SESSION['mensaje_exito'] = "Puntajes asignados correctamente.";
        redireccionar('/paginas/OMPanel');
      } else {
        $_SESSION['mensaje_error'] = "Datos incompletos o inválidos.";
        redireccionar('/paginas/OMPanel');
      }
    } else {
      redireccionar('/paginas/index');
    }
  }


  public function obtenerDetallesParaOMPanel($vacante_id) {
    session_start();
    $vacante = $this->vacanteModelo->obtenerVacanteId($vacante_id);

    if (!$vacante || !$this->vacanteModelo->esVacanteCerrada($vacante_id)) {
      die('Vacante no encontrada o no está cerrada.');
    }

    $inscripciones = $this->inscripcionModelo->obtenerDetallesInscripPorVacanteId($vacante_id);
    $datos = [
      'vacante_descrip' => $vacante->descrip,
      'inscripciones' => $inscripciones,
      'vacante_id' => $vacante_id,
      'nombre_catedra' => $vacante->nombre_catedra, 
      'fecha_ini' => $vacante->fecha_ini,
      'fecha_fin' => $vacante->fecha_fin,
      'req' => $vacante->req
    ];

    $this->vista('paginas/OMPanel', $datos);
  }
}