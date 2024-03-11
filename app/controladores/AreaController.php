<?php 

  class AreaController extends Controlador {

    public function __construct() {
      $this->areaModelo = $this->modelo('Area');
    }

    public function agregarArea() {

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {        

        $datos = [
          'nombre' => trim($_POST['nombre']),  
          'dpto_id' => trim($_POST['dpto_id']),     
        ];

        if ($this->areaModelo->agregarArea($datos)) {

          $areas = $this->areaModelo->obtenerAreas();
          $datos = [
            'areas' => $areas,            
          ];

            $this->vista('paginas/area/listar', $datos);
        } else {
          die ('No se pudo agregar el Área');
        }          
      } else {
        
        $datos = [
          'nombre' => '',       
          'dpto_id' => '', 
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

          $areas = $this->areaModelo->obtenerAreas();
          $datos = [
            'areas' => $areas
          ];

          $this->vista('paginas/area/listar', $datos);

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
          redireccionar('/paginas/area/listar');
        } else {
          die('Algo salio mal');
        }
      }
    }
  }
?>