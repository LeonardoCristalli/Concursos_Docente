<?php 

class LoginController extends Controlador {

  private $usuarioModelo;

  public function __construct() {
    $this->usuarioModelo = $this->modelo('Usuario');
  }

  public function login() {
    session_start();
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
                redireccionar('/paginas/adminPanel');
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
  
}