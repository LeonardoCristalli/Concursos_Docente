<?php 
  class DptoController extends Controlador {
    private $dptoModelo;
    
    public function __construct() {
      $this->dptoModelo = $this->modelo('Dpto');
    }

    public function agregarDpto() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {        
        $datos = [
          'nombre' => trim($_POST['nombre']),       
        ];

        if ($this->dptoModelo->agregarDpto($datos)) {
          $dptos = $this->dptoModelo->obtenerDptos();
          $datos = [
            'dptos' => $dptos
          ];

            $this->vista('paginas/dpto/listar', $datos);
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
          redireccionar('/paginas/dpto/listar');
        } else {
          die('Algo salio mal');
        }
      }
    }

  }
?>