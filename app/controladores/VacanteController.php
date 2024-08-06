<?php 

class VacanteController extends Controlador {
  private $vacanteModelo; 

  public function __construct() {
    $this->vacanteModelo = $this->modelo('Vacante');
  }

  public function agregarVacante() {
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {        

      $datos = [
        'descrip' => trim($_POST['descrip']),  
        'fecha_ini' => trim($_POST['fecha_ini']),
        'fecha_fin' => trim($_POST['fecha_fin']),
        'req' => trim($_POST['req']),
        'tiempo' => trim($_POST['tiempo']),
        'exp' => trim($_POST['exp']),
        'catedra_id' => trim($_POST['catedra_id']),
        'estado_id' => 1002, // Nueva
        'fecha_desde' => trim($_POST['fecha_desde']),
        'observacion' => trim($_POST['observacion']),          
      ];

      if ($this->vacanteModelo->agregarVacante($datos)) {

        $vacantes = $this->vacanteModelo->obtenerDetalleVacantes();
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
        //'estado_id' => trim($_POST['estado_id']),
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
        //'estado_id' => $vacante->estado_id,
        'catedra_id' => $vacante->catedra_id,
      ];

        $this->vista('paginas/vacante/editar', $datos);
    }
  }

    public function borrarVacante($id) {

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      
      $id = $_POST['id'];

      if($this->vacanteModelo->borrarVacante($id)) {
        $vacantes = $this->vacanteModelo->obtenerVacantes();
        $datos = [
          'vacantes' => $vacantes,
        ];

        $this->vista('paginas/vacante/listar', $datos);
      } else {
        die('Algo salio mal');
      }
    }
  }

  public function vacanteUsuario() {
    session_start();
    $vacantes = $this->vacanteModelo->obtenerVacantesAbiertas();
    $datos = [
      'vacantes' => $vacantes,
    ];

    $this->vista('paginas/vacanteUsuario', $datos);
  }

  public function cambiarEstadoVacantes() {
    $vacantes = $this->vacanteModelo->obtenerVacantes();
    
    // Iterar sobre cada vacante
    foreach ($vacantes as $vacante) {
        // Verificar si la fecha de inicio ha sido alcanzada
        if (strtotime($vacante->fecha_ini) <= strtotime('now')) {
            // Cambiar el estado de la vacante a "Abierta"
            $datos = [
                'vacante_id' => $vacante->id,
                'estado_id' => 1003, // ID del estado "Abierta"
                'fecha_desde' => date('Y-m-d H:i:s'), // Fecha actual
                'observacion' => 'La vacante ha sido abierta.',
            ];
            
            // Agregar el nuevo estado a la tabla vacantes_estados
            $this->vacanteModelo->agregarEstadoVacante($datos);
        }
    }
  }

}