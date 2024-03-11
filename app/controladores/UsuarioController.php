<?php 

  class UsuarioController extends Controlador {

    public function __construct() {
      $this->usuarioModelo = $this->modelo('Usuario');
    }

    public function agregarUsuario() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {        
        $datos = [
          'nombre' => trim($_POST['nombre']),
          'apellido' => trim($_POST['apellido']),
          'fecha_nac' => trim($_POST['fecha_nac']),
          'sexo' => trim($_POST['sexo']),
          'direccion' => trim($_POST['direccion']),
          'telefono' => trim($_POST['telefono']),  
          'email' => trim($_POST['email']),  
          'nro_dni' => trim($_POST['nro_dni']),      
          'cuil' => trim($_POST['cuil']),                    
          'tipo_usu' => trim($_POST['tipo_usu']),
          'nro_legajo' => trim($_POST['nro_legajo']),
          'usuario' => trim($_POST['usuario']),
          'password' => trim($_POST['password']),          
        ];

        $datosValidados = $this->validarDatosUsuario($datos);

        if (is_array($datosValidados)) {
          foreach ($datosValidados as $error) {
            echo $error . "<br/>";
          }
        } elseif ($datosValidados === true) {
          if ($this->usuarioModelo->agregarUsuario($datos)) {
            $usuarios = $this->usuarioModelo->obtenerUsuarios();
            $datos = [
              'usuarios' => $usuarios
            ];

            $this->vista('paginas/usuario/listar', $datos);
          } else {
            die ('No se pudo agregar el usuario');
          }          
        } else {
          die('Datos de usuario no válidos');
        }
      } else {
        $datos = [
          'nombre' => '',
          'apellido' => '',
          'fecha_nac' => '',
          'sexo' => '',
          'direccion' => '',
          'telefono' => '',
          'email' => '',
          'nro_dni' => '',
          'cuil' => '',
          'tipo_usu' => '',
          'nro_legajo' => '',
          'usuario' => '',
          'password' => '',          
        ];

        $this->vista('paginas/usuario/agregar', $datos);
      }
    }

    public function editarUsuario($id) {

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $datos = [
          'id' => $id,
          'nombre' => trim($_POST['nombre']),
          'apellido' => trim($_POST['apellido']),
          'fecha_nac' => trim($_POST['fecha_nac']),
          'sexo' => trim($_POST['sexo']),
          'direccion' => trim($_POST['direccion']),
          'telefono' => trim($_POST['telefono']),  
          'email' => trim($_POST['email']), 
          'nro_dni' => trim($_POST['nro_dni']),    
          'cuil' => trim($_POST['cuil']),                    
          'tipo_usu' => trim($_POST['tipo_usu']),
          'nro_legajo' => trim($_POST['nro_legajo']),
          'usuario' => trim($_POST['usuario']),
          'password' => trim($_POST['password']),          
        ];

        $datosValidados = $this->validarDatosUsuario($datos);

        if (is_array($datosValidados)) {

          foreach ($datosValidados as $error) {
            echo $error . "<br/>";
          }

        } elseif ($datosValidados === true) {

          if($this->usuarioModelo->actualizarUsuario($datos)) {            
            $usuarios = $this->usuarioModelo->obtenerUsuarios();
            $datos = [
              'usuarios' => $usuarios
            ];

            $this->vista('paginas/usuario/listar', $datos);

          } else {
            die('Algo salio mal');        
          }

        } else {
          die('Datos de usuario no válidos');
        }

      } else {
         $usuario = $this->usuarioModelo->obtenerUsuarioId($id);
         $datos = [
          'id' => $usuario->id,
          'nombre' => $usuario->nombre,
          'apellido' => $usuario->apellido,
          'fecha_nac' => $usuario->fecha_nac,
          'sexo' => $usuario->sexo,
          'direccion' => $usuario->direccion,
          'telefono' => $usuario->telefono,
          'email' => $usuario->email,
          'nro_dni' => $usuario->nro_dni,
          'cuil' => $usuario->cuil,                  
          'tipo_usu' => $usuario->tipo_usu,
          'nro_legajo' => $usuario->nro_legajo,
          'usuario' => $usuario->usuario,
          'password' => $usuario->password,          
        ];

         $this->vista('paginas/usuario/editar', $datos);
      }

    }

    public function borrarUsuario($id) {

      if($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        $id = $_POST['id'];

        if($this->usuarioModelo->borrarUsuario($id)) {
          redireccionar('/paginas/usuario/listar');
        } else {
          die('Algo salio mal');
        }
      }
    }

    private function validarDatosUsuario($datos) {

      $errores = [];

      if (empty($datos['nombre'])) {
        $errores[] = 'El nombre es obligatorio';
      }

      if (empty($datos['apellido'])) {
        $errores[] = 'El apellido es obligatorio';
      }

      if (empty($datos['sexo'])) {
        $errores[] = 'El sexo es obligatorio';
      }

      if (empty($datos['direccion'])) {
        $errores[] = 'La direccion es obligatoria';
      }

      if (empty($datos['telefono'])) {
        $errores[] = 'El telefono es obligatorio';
      }

      if (empty($datos['cuil'])) {
        $errores[] = 'El cuil es obligatorio';
      } elseif (strlen($datos['cuil']) !== 11) {
        $errores[] = 'El número de cuil debe tener exactamente 11 dígitos';
      }

      if (empty($datos['email'])) {
        $errores[] = 'El email es obligatorio';
      } elseif (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El correo electrónico no tiene un formato válido';
      }

      if (empty($datos['fecha_nac'])) {
        $errores[] = 'La fecha de nacimiento es obligatoria';
      }

      if (empty($datos['usuario'])) {
        $errores[] = 'El nombre de usuario es obligatorio';
      } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $datos['usuario'])) {
        $errores[] = 'El nombre de usuario solo puede contener letras, números y guiones bajos';
      }

      if (empty($datos['password'])) {
        $errores[] = 'La contraseña es obligatoria';
      } elseif (strlen($datos['password']) < 8) {
        $errores[] = 'La contraseña debe tener al menos 8 caracteres';
      } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]+$/', $datos['password'])) {
        $errores[] = 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula y un número';
      }

      if (empty($datos['nro_dni'])) {
        $errores[] = 'El número de DNI es obligatorio';
      } elseif (!ctype_digit($datos['nro_dni'])) {
        $errores[] = 'El número de DNI debe contener solo dígitos numéricos';
      } elseif (strlen($datos['nro_dni']) !== 8) {
        $errores[] = 'El número de DNI debe tener exactamente 8 dígitos';
      }

      if (!empty($errores)){
        return $errores;
      } else {
        return true;
      }
    }

  }
?>