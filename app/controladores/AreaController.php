<?php 
class AreaController extends Controlador {
  private $areaModelo;

  public function __construct() {
    $this->areaModelo = $this->modelo('Area');
  }

  public function agregarArea() {

    $dptoModelo = $this->modelo('Dpto');
    $dptos = $dptoModelo->obtenerDptos();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {        

      $datos = [
        'nombre' => trim($_POST['nombre']),  
        'dpto_id' => trim($_POST['dpto_id']),     
      ];

      if ($this->areaModelo->agregarArea($datos)) {
        redireccionar('/areacontroller/listarAreas');          
      } else {
        die ('No se pudo agregar el Área');
      }          
    } else {      
      $datos = [
        'nombre' => '',       
        'dpto_id' => '',
        'dptos' => $dptos
      ];

      $this->vista('paginas/area/agregar', $datos);
    }
  }

  public function editarArea($id) {
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $datos = [
        'id' => $id,
        'nombre' => trim($_POST['nombre']),
        'dpto_id' => trim($_POST['dpto_id']),     
      ];

      if ($this->areaModelo->actualizarArea($datos)) {  
        $this->listarAreas();
      } else {
        die('Algo salio mal');        
      }

    } else {
      $area = $this->areaModelo->obtenerAreaId($id);
      $datos = [
        'id' => $area->id,
        'nombre' => $area->nombre,          
        'dpto_id' => $area->dpto_id,
      ];

        $this->vista('paginas/area/editar', $datos);
    }
  }

  public function borrarArea($id) {

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      
      $id = $_POST['id'];

      if($this->areaModelo->borrarArea($id)) {
        redireccionar('/areacontroller/listarAreas');
      } else {
        die('Algo salio mal');
      }
    }
  }

  public function listarAreas() {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $registrosPorPagina = 4;
    $totalRegistros = $this->areaModelo->contarAreas();
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

    $areas = $this->areaModelo->obtenerAreasPaginados($pagina, $registrosPorPagina);

    $datos = [
      'areas' => $areas,
      'totalPaginas' => $totalPaginas,
      'paginaActual' => $pagina
    ];

    $this->vista('paginas/area/listar', $datos);
  }
  
}