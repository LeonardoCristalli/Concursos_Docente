<?php 

class LoginController extends Controlador {

  private $usuarioModelo;

  public function __construct() {
    $this->usuarioModelo = $this->modelo('Usuario');
  }

  public function login() {
    session_start();

    if (!isset($_SESSION['actualizacion_vacantes_realizada'])) {
      $this->actualizarEstadosVacantes();
      $_SESSION['actualizacion_vacantes_realizada'] = true;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];       
        $usuario = $this->usuarioModelo->obtenerUsuarioPorNombre($username);
        if ($usuario) {
          if (password_verify($password, $usuario->password)) {        
            $_SESSION['usuario_id'] = $usuario->id;
            $_SESSION['tipo_usu'] = $usuario->tipo_usu;
            switch ($usuario->tipo_usu) {                
              case 'Usuario':
                redireccionar('/vacanteController/vacanteUsuario');
                break;                
              case 'Admin':
                redireccionar('/paginas/adminPanel');
                break;                
              case 'RA':
                redireccionar('/paginas/RAPanel');
              break;
              case 'JC':
                redireccionar('/paginas/RAPanel');
              break;
              default:
                redireccionar('/paginas/index');
                break;
            }
          } else {
            $_SESSION["mensaje_error"] = "Nombre de usuario o contraseña incorrectos";
            redireccionar('/paginas/login');
          }
        } else {
          $_SESSION["mensaje_error"] = "Nombre de usuario o contraseña incorrectos";
          redireccionar('/paginas/login');
        } 
      }
    } else {
      $_SESSION["mensaje_error"] = "El método de solicitud no es POST";
      redireccionar('/paginas/login');
    }
  } 

  public function forgotPW() {
    session_start();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST["email"])) {
        $email = $_POST["email"];
        
        $usuario = $this->usuarioModelo->obtenerUsuarioPorEmail($email);
        if ($usuario) {

          $token = bin2hex(random_bytes(8));
          $this->usuarioModelo->guardarTokenDeRecuperacion($usuario->id, $token);

          $resetLink = RUTA_URL . "/logincontroller/resetPW?token=" . $token;

          $this->enviarMailRecuperacion($usuario->email, $resetLink);

          $_SESSION["mensaje_exito"] = "Te hemos enviado un correo electrónico con las instrucciones para restablecer tu contraseña.";
          redireccionar('/paginas/login');
        } else {
          $_SESSION["mensaje_error"] = "Si existe una cuenta con este correo, te enviaremos las instrucciones para restablecer tu contraseña.";
          redireccionar('/paginas/forgotpw');
        }
      }
    } else {
      $_SESSION["mensaje_error"] = "El método de solicitud no es POST";
      redireccionar('/paginas/forgotpw');
    }
  }

  public function resetPW() {
    session_start();
    
    if (isset($_GET['token'])) {

      $token = $_GET['token'];
      $usuario = $this->usuarioModelo->obtenerUsuarioPorToken($token);

      if ($usuario) {
        $this->vista('paginas/resetpw', ['token' => $token]);
      } else {
        $_SESSION["mensaje_error"] = "El enlace de restablecimiento no es válido o ha expirado.";
        redireccionar('/paginas/login');
      }
      
    } else {
      redireccionar('/paginas/login');
    }
  }

  public function actualizarPW() {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $token = $_POST['token'];
      $password = $_POST['password'];
      $confirm_password = $_POST['confirm_password'];

      if ($password === $confirm_password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if ($this->usuarioModelo->actualizarPW($token, $hashedPassword)) {
          $_SESSION["mensaje_exito"] = "Tu contraseña ha sido actualizada.";
          redireccionar('/paginas/login');
        } else {
          $_SESSION["mensaje_error"] = "No se pudo actualizar la contraseña. Por favor, inténtalo de nuevo.";
          redireccionar('/logincontroller/resetpw?token=' . $token);
        }
      } else {
        $_SESSION["mensaje_error"] = "Las contraseñas no coinciden.";
        redireccionar('/logincontroller/resetpw?token=' . $token);
      }
    } else {
      redireccionar('/paginas/login');
    }
  }

  public function enviarMailRecuperacion($email, $resetLink) {
    $asunto = "Restablecimiento de contraseña";
    $mensaje = "Hola,\n\nHemos recibido una solicitud para restablecer tu contraseña. Por favor, haz clic en el siguiente enlace para restablecerla:\n\n";
    $mensaje .= $resetLink . "\n\nSi no solicitaste este cambio, ignora este mensaje.\n\nGracias.";

    $cabeceras = "From: no-reply@tusitio.com\r\n" .
                  "Reply-To: no-reply@tusitio.com\r\n" .
                  "X-Mailer: PHP/" . phpversion();

    mail($email, $asunto, $mensaje, $cabeceras);
  }

  public function actualizarEstadosVacantes() {
    require_once '../app/modelos/Vacante.php';
    require_once '../app/controladores/VacanteController.php';

    $vacanteModelo = new Vacante();
    $vacanteController = new VacanteController();

    $vacanteModelo->actualizarVacantesAbiertas();
    $vacanteController->actualizarVacantesCerradasYNotificar();
  }
}