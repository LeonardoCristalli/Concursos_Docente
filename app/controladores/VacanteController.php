<?php 

class VacanteController extends Controlador {
  private $vacanteModelo; 
  private $catedraModelo; 

  public function __construct() {
    $this->vacanteModelo = $this->modelo('Vacante');
    $this->catedraModelo = $this->modelo('Catedra');
  }

  public function agregarVacante() {
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {   

      $fecha_ini = trim($_POST['fecha_ini']);
      $hoy = date('Y-m-d');
      
      $estado_id = ($fecha_ini == $hoy) ? 2 : 1002; // 2 = Abierta, 1002 = Nueva

      $datos = [
        'descrip' => trim($_POST['descrip']),  
        'fecha_ini' => trim($_POST['fecha_ini']),
        'fecha_fin' => trim($_POST['fecha_fin']),
        'req' => trim($_POST['req']),
        'tiempo' => trim($_POST['tiempo']),
        'exp' => trim($_POST['exp']),
        'catedra_id' => trim($_POST['catedra_id']),
        'estado_id' => $estado_id, 
        'fecha_desde' => trim($_POST['fecha_desde']),
        'observacion' => trim($_POST['observacion']),          
      ];

      if ($this->vacanteModelo->agregarVacante($datos)) {
        $_SESSION['vacantesDetalles'] = $this->vacanteModelo->obtenerDetalleVacantes();
        redireccionar('/vacantecontroller/listarvacantes');
      } else {
        die ('No se pudo crear la Vacante');
      }          
    } else {
      
      $tipoUsuario = $_SESSION['tipo_usu'];
      $usuarioId = $_SESSION['usuario_id'];

      if ($tipoUsuario === 'Admin' || $tipoUsuario === 'RA') {
        $catedras = $this->catedraModelo->obtenerCatedras();
      } elseif ($tipoUsuario === 'JC') {
        $catedras = $this->catedraModelo->obtenerCatedrasPorUsuarioId($usuarioId);
      } else {
        redireccionar('/paginas/index'); 
      }

        $datos = [
          'descrip' => '', 
          'fecha_ini' => '',
          'fecha_fin' => '',
          'req' => '',
          'tiempo' => '',
          'exp' => '',  
          'estado_id' => '',
          'catedra_id' => '',
          'catedras' => $catedras 
        ];

        $this->vista('paginas/vacante/agregar', $datos);
      }
  }

  public function editarVacante($id) {
    session_start();

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
        redireccionar('/vacantecontroller/listarvacantes');
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
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      
      $id = $_POST['id'];

      if($this->vacanteModelo->borrarVacante($id)) {
        redireccionar('/vacantecontroller/listarvacantes');
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

  public function listarVacantes() {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $registrosPorPagina = 2;
    $totalRegistros = $this->vacanteModelo->contarVacantes();
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

    $vacantes = $this->vacanteModelo->obtenerVacantesPaginados($pagina, $registrosPorPagina);

    $datos = [
      'vacantes' => $vacantes,
      'totalPaginas' => $totalPaginas,
      'paginaActual' => $pagina
    ];

    $this->vista('paginas/vacante/listar', $datos);
  }

  public function actualizarVacantesCerradasYNotificar() {
    $vacantesCerradas = $this->vacanteModelo->actualizarVacantesCerradas();

    foreach ($vacantesCerradas as $vacante) {
      $jefeEmail = $this->vacanteModelo->obtenerEmailJefeCatedra($vacante->catedra_id);
      
      if ($jefeEmail) {
        $this->enviarNotificacionCierreVacante($jefeEmail, $vacante->descrip);
      }
    }

    return true;
  }

  public function enviarNotificacionCierreVacante($email, $vacanteDescripcion) {
    $asunto = "Notificación de Cierre de Vacante";
    $mensaje = "Hola,\n\nQueremos informarte que la vacante con la descripción '{$vacanteDescripcion}' ha sido cerrada.\n\n";
    $mensaje .= "Si tienes alguna pregunta, por favor contáctanos.\n\nGracias.";

    $cabeceras = "From: no-reply@tusitio.com\r\n" .
                  "Reply-To: no-reply@tusitio.com\r\n" .
                  "X-Mailer: PHP/" . phpversion();

    mail($email, $asunto, $mensaje, $cabeceras);
  }

}