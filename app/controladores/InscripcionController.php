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
    $usuarioId = $_SESSION['usuario_id'];
    $tipoUsuario = $_SESSION['tipo_usu'];
    $vacantes = [];
    
    if ($tipoUsuario === 'RA') {
      $vacantes = $this->vacanteModelo->obtenerVacantes();
    } elseif ($tipoUsuario === 'JC') {
      $vacantes = $this->vacanteModelo->obtenerVacantesPorUsuarioId($usuarioId);
    }
    
    $inscripciones = $this->inscripcionModelo->obtenerDetallesInscripPorVacanteId($vacante_id);
    $datos = [
      'vacantesDetalles' => $vacantes,
      'inscripciones' => $inscripciones,
      'vacante_id' => $vacante_id
    ];

    $this->vista('paginas/RAPanel', $datos);
  }
  
  public function asignarPuntajes() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $vacante_id = $_POST['vacante_id'];
      $puntajes = $_POST['puntajes'];

      foreach ($puntajes as $usuario_id => $puntaje) {
        $this->inscripcionModelo->asignarPuntaje($vacante_id, $usuario_id, $puntaje);
      }

      $this->vacanteModelo->actualizarEstadoVacante($vacante_id, 4);

      $_SESSION['vacantesDetalles'] = $this->vacanteModelo->obtenerVacantesCerradasEvaluadasPublicadasPorJefeCatedraId($_SESSION['usuario_id']);

      $_SESSION['mensaje_exito'] = "Puntajes asignados correctamente.";
      redireccionar('/paginas/OMPanel');
    }
  }

  public function obtenerDetallesParaOMPanel($vacante_id) {
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