<?php 
class EstadoController extends Controlador {
  private $estadoModelo;

  public function __construct() {
    $this->estadoModelo = $this->modelo('Estado');
  }

  public function agregarEstado() {
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {        
      $datos = [
        'descrip' => trim($_POST['descrip']),       
      ];

      if ($this->estadoModelo->agregarEstado($datos)) {
        redireccionar('/estadocontroller/listarestados');
      } else {
        die ('No se pudo agregar el usuario');
      }          
    } else {
      $datos = [
        'descrip' => '',         
      ];

      $this->vista('paginas/estado/agregar', $datos);
    }
  }

  public function editarEstado($id) {
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $datos = [
        'id' => $id,
        'descrip' => trim($_POST['descrip']),          
      ];

      if ($this->estadoModelo->actualizarEstado($datos)) {  
        redireccionar('/estadocontroller/listarestados');
      } else {
        die('Algo salio mal');        
      }

    } else {
      $estado = $this->estadoModelo->obtenerEstadoId($id);
      $datos = [
        'id' => $estado->id,
        'descrip' => $estado->descrip,          
      ];

        $this->vista('paginas/estado/editar', $datos);
    }
  }

  public function borrarEstado($id) {
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      
      $id = $_POST['id'];

      if($this->estadoModelo->borrarEstado($id)) {
        redireccionar('/estadocontroller/listarestados');
      } else {
        die('Algo salio mal');
      }
    }
  }

   public function listarEstados() {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $registrosPorPagina = 4;
    $totalRegistros = $this->estadoModelo->contarEstados();
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

    $estados = $this->estadoModelo->obtenerEstadosPaginados($pagina, $registrosPorPagina);

    $datos = [
      'estados' => $estados,
      'totalPaginas' => $totalPaginas,
      'paginaActual' => $pagina
    ];

    $this->vista('paginas/estado/listar', $datos);
  }

}