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
          'estado_id' => trim($_POST['estado_id']),
          'catedra_id' => trim($_POST['catedra_id']),
          'fecha_desde' => trim($_POST['fecha_desde']),
          'observacion' => trim($_POST['observacion']),
        ];

        if ($this->vacanteModelo->agregarVacante($datos)) {

          $vacantes = $this->vacanteModelo->obtenerVacantes();
          $datos = [
            'vacantes' => $vacantes,            
          ];

            $this->vista('paginas/vacante/listar', $datos);
        } else {
          die ('No se pudo crear la Vacante');
        }          
      } else {
        
        $datos = [
          'descrip' => '', 
          'fecha_ini' => '',
          'fecha_fin' => '',
          'req' => '',
          'tiempo' => '',
          'exp' => '',  
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
          'estado_id' => trim($_POST['estado_id']),
          'catedra_id' => trim($_POST['catedra_id']),   
        ];

        if ($this->vacanteModelo->actualizarVacante($datos)) {  

          $vacantes = $this->vacanteModelo->obtenerVacantes();
          $datos = [
            'vacantes' => $vacantes
          ];

          $this->vista('paginas/vacante/listar', $datos);

        } else {
          die('Algo salio mal');        
        }

      } else {
        $vacante = $this->vacanteModelo->obtenerVacanteId($id);
        $datos = [
          'id' => $vacante->id,
          'descrip' => $vacante->descrip,          
          'fecha_ini' => $vacante->fecha_ini,
          'fecha_fin' => $vacante->fecha_fin,
          'req' => $vacante->req,
          'tiempo' => $vacante->tiempo,
          'exp' => $vacante->exp,
          'estado_id' => $vacante->estado_id,
          'catedra_id' => $vacante->catedra_id,
        ];

         $this->vista('paginas/vacante/editar', $datos);
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

    public function vacanteUsuario() {
      $vacantes = $this->vacanteModelo->obtenerVacantesAbiertas();
      $datos = [
        'vacantes' => $vacantes,
      ];

      $this->vista('paginas/vacante/vacanteUsuario', $datos);
    }

  }
?>