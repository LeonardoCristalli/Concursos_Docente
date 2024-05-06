<?php 

class InscripcionController extends Controlador {
  private $inscripcionModelo;

  public function __construct() {
    $this->inscripcionModelo = $this->modelo('Inscripcion');
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
}
?>