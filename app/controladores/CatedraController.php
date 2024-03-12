<?php 

  class CatedraController extends Controlador {

    public function __construct() {
      $this->catedraModelo = $this->modelo('Catedra');
    }

    public function agregarCatedra() {

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {        

        $datos = [
          'nombre' => trim($_POST['nombre']),  
          'descrip' => trim($_POST['descrip']),
          'plan' => trim($_POST['plan']),
          'ano_cursado' => trim($_POST['ano_cursado']),
          'hs_semanales' => trim($_POST['hs_semanales']),
          'tipo_cursado' => trim($_POST['tipo_cursado']),
          'electiva' => trim($_POST['electiva']),
          'titulacion' => trim($_POST['titulacion']),
          'area_id' => trim($_POST['area_id']),
        ];

        if ($this->catedraModelo->agregarCatedra($datos)) {

          $catedras = $this->catedraModelo->obtenerCatedras();
          $datos = [
            'catedras' => $catedras,            
          ];

            $this->vista('paginas/catedra/listar', $datos);
        } else {
          die ('No se pudo agregar el Área');
        }          
      } else {
        
        $datos = [
          'nombre' => '',  
          'descrip' => '',
          'plan' => '',
          'ano_cursado' => '',
          'hs_semanales' => '',
          'tipo_cursado' => '',
          'electiva' => '',
          'titulacion' => '',
          'area_id' => '',
        ];

        $this->vista('paginas/catedra/agregar', $datos);
      }
    }

    public function editarCatedra($id) {

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $datos = [
          'id' => $id,
          'nombre' => trim($_POST['nombre']),  
          'descrip' => trim($_POST['descrip']),
          'plan' => trim($_POST['plan']),
          'ano_cursado' => trim($_POST['ano_cursado']),
          'hs_semanales' => trim($_POST['hs_semanales']),
          'tipo_cursado' => trim($_POST['tipo_cursado']),
          'electiva' => trim($_POST['electiva']),
          'titulacion' => trim($_POST['titulacion']),
          'area_id' => trim($_POST['area_id']),    
        ];

        if ($this->catedraModelo->actualizarCatedra($datos)) {  

          $catedras = $this->catedraModelo->obtenerCatedras();
          $datos = [
            'catedras' => $catedras
          ];

          $this->vista('paginas/catedra/listar', $datos);

        } else {
          die('Algo salio mal');        
        }

      } else {
        $catedra = $this->catedraModelo->obtenerCatedraId($id);
        $datos = [
          'id' => $catedra->id,
          'nombre' => $catedra->nombre,          
          'descrip' => $catedra->descrip,
          'plan' => $catedra->plan,
          'ano_cursado' => $catedra->ano_cursado,
          'hs_semanales' => $catedra->hs_semanales,
          'tipo_cursado' => $catedra->tipo_cursado,
          'ano_cursado' => $catedra->ano_cursado,
          'electiva' => $catedra->electiva,
          'titulacion' => $catedra->titulacion,
          'area_id' => $catedra->area_id,
        ];

         $this->vista('paginas/catedra/editar', $datos);
      }
    }

     public function borrarCatedra($id) {

      if($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        $id = $_POST['id'];

        if($this->catedraModelo->borrarCatedra($id)) {
          redireccionar('/paginas/catedra/listar');
        } else {
          die('Algo salio mal');
        }
      }
    }
  }
?>