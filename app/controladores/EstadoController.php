<?php 
  class EstadoController extends Controlador {
    public function __construct() {
      $this->estadoModelo = $this->modelo('Estado');
    }

    public function agregarEstado() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {        
        $datos = [
          'descrip' => trim($_POST['descrip']),       
        ];

        if ($this->estadoModelo->agregarEstado($datos)) {
          $estados = $this->estadoModelo->obtenerEstados();
          $datos = [
            'estados' => $estados
          ];

            $this->vista('paginas/estado/listar', $datos);
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

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $datos = [
          'id' => $id,
          'descrip' => trim($_POST['descrip']),          
        ];

        if ($this->estadoModelo->actualizarEstado($datos)) {  

          $estados = $this->estadoModelo->obtenerEstados();
          $datos = [
            'estados' => $estados
          ];

          $this->vista('paginas/estado/listar', $datos);

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

      if($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        $id = $_POST['id'];

        if($this->estadoModelo->borrarEstado($id)) {
          redireccionar('/paginas/estado/listar');
        } else {
          die('Algo salio mal');
        }
      }
    }

  }
?>