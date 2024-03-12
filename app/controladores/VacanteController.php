<?php 

  class VacanteController extends Controlador {

    public function __construct() {
      $this->vacanteModelo = $this->modelo('Vacante');
    }

    public function agregarVacante() {

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {        

        $datos = [
          'descrip' => trim($_POST['descrip']),  
          'fecha_ini' => trim($_POST['fecha_ini']),
          'fecha_fin' => trim($_POST['fecha_fin']),
          'req' => trim($_POST['req']),
          'tiempo' => trim($_POST['tiempo']),
          'exp' => trim($_POST['exp']),
          'motivo_id' => trim($_POST['motivo_id']),
          'estado_id' => trim($_POST['estado_id']),
          'catedra_id' => trim($_POST['catedra_id']),
        ];

        if ($this->vacanteModelo->agregarVacante($datos)) {

          $vacantes = $this->vacanteModelo->obtenerVacantes();
          $datos = [
            'vacantes' => $vacantes,            
          ];

            $this->vista('paginas/vacante/listar', $datos);
        } else {
          die ('No se pudo agregar el Área');
        }          
      } else {
        
        $datos = [
          'descrip' => '', 
          'fecha_ini' => '',
          'fecha_fin' => '',
          'req' => '',
          'tiempo' => '',
          'exp' => '',
          'motivo_id' => '',
          'estado_id' => '',
          'catedra_id' => '',
        ];

        $this->vista('paginas/vacante/agregar', $datos);
      }
    }

    public function editarVacante($id) {

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $datos = [
          'id' => $id,
          'descrip' => trim($_POST['descrip']),  
          'fecha_ini' => trim($_POST['fecha_ini']),
          'fecha_fin' => trim($_POST['fecha_fin']),
          'req' => trim($_POST['req']),
          'tiempo' => trim($_POST['tiempo']),
          'exp' => trim($_POST['exp']),
          'motivo_id' => trim($_POST['motivo_id']),
          'estado_id' => trim($_POST['estado_id']),
          'catedra_id' => trim($_POST['catedra_id']),   
        ];

        if ($this->vacanteModelo->actualizarVacante($datos)) {  

          $vacantes = $this->vacanteModelo->obtenerVacantes();
          $datos = [
            'vacantes' => $vacantes
          ];

          $this->vista('paginas/vacantes/listar', $datos);

        } else {
          die('Algo salio mal');        
        }

      } else {
        $vacantes = $this->vacanteModelo->obtenerVacanteId($id);
        $datos = [
          'id' => $vacante->id,
          'descrip' => $vacante->descrip,          
          'fecha_ini' => $vacante->fecha_ini,
          'fecha_fin' => $vacante->fecha_fin,
          'req' => $vacante->req,
          'tiempo' => $vacante->tiempo,
          'exp' => $vacante->exp,
          'motivo_id' => $vacante->motivo_id,
          'estado_id' => $vacante->estado_id,
          'catedra_id' => $vacante->catedra_id,
        ];

         $this->vista('paginas/catedra/editar', $datos);
      }
    }

     public function borrarVacante($id) {

      if($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        $id = $_POST['id'];

        if($this->vacanteModelo->borrarVacante($id)) {
          redireccionar('/paginas/vacante/listar');
        } else {
          die('Algo salio mal');
        }
      }
    }
  }
?>