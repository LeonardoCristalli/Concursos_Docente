<?php 
class DptoController extends Controlador {
  private $dptoModelo;
  
  public function __construct() {
    $this->dptoModelo = $this->modelo('Dpto');
  }

  public function agregarDpto() {
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {        
      $datos = [
        'nombre' => trim($_POST['nombre']),       
      ];

      if ($this->dptoModelo->agregarDpto($datos)) {
        redireccionar('/dptocontroller/listarDptos');
      } else {
        die ('No se pudo agregar el usuario');
      }          
    } else {
      $datos = [
        'nombre' => '',         
      ];

      $this->vista('paginas/dpto/agregar', $datos);
    }
  }

  public function editarDpto($id) {
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $datos = [
        'id' => $id,
        'nombre' => trim($_POST['nombre']),          
      ];

      if ($this->dptoModelo->actualizarDpto($datos)) {  

        $dptos = $this->dptoModelo->obtenerDptos();
        $datos = [
          'dptos' => $dptos
        ];

        $this->vista('paginas/dpto/listar', $datos);

      } else {
        die('Algo salio mal');        
      }

    } else {
      $dpto = $this->dptoModelo->obtenerDptoId($id);
      $datos = [
        'id' => $dpto->id,
        'nombre' => $dpto->nombre,          
      ];

        $this->vista('paginas/dpto/editar', $datos);
    }
  }

  public function borrarDpto($id) {

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      
      $id = $_POST['id'];

      if($this->dptoModelo->borrarDpto($id)) {
        redireccionar('/dptocontroller/listarDptos');
      } else {
        die('Algo salio mal');
      }
    }
  }

  public function listarDptos() {
    session_start();
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $registrosPorPagina = 4;
    $totalRegistros = $this->dptoModelo->contarDptos();
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

    $dptos = $this->dptoModelo->obtenerDptosPaginados($pagina, $registrosPorPagina);

    $datos = [
      'dptos' => $dptos,
      'totalPaginas' => $totalPaginas,
      'paginaActual' => $pagina
    ];

    $this->vista('paginas/dpto/listar', $datos);
  }

}