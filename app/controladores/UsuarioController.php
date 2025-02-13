<?php 
class UsuarioController extends Controlador {
  private $usuarioModelo;
  private $catedraModelo;
  private $uploadPath;

  public function __construct() {
    $this->usuarioModelo = $this->modelo('Usuario');
    $this->catedraModelo = $this->modelo('Catedra');
    $this->uploadPath = RUTA_APP . '/uploads/';
  }

  public function agregarUsuario() {
    $catedras = $this->catedraModelo->obtenerCatedras();

    $puedeAsignarRoles = isset($_SESSION['usuario_id']) && $_SESSION['tipo_usu'] === 'Admin';

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
      'cv' => '',
      'catedras' => $catedras,
      'mostrar_tipo_usu' => $puedeAsignarRoles
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $tipo_usu = isset($_SESSION['tipo_usu']) && $_SESSION['tipo_usu'] === 'Admin' && isset($_POST['tipo_usu']) ? trim($_POST['tipo_usu']) : 'Usuario';

      $datos = [
        'nombre' => trim($_POST['nombre']),
        'apellido' => trim($_POST['apellido']),
        'fecha_nac' => trim($_POST['fecha_nac']),
        'sexo' => isset($_POST['sexo']) ? trim($_POST['sexo']) : '',
        'direccion' => trim($_POST['direccion']),
        'telefono' => trim($_POST['telefono']),  
        'email' => trim($_POST['email']),  
        'nro_dni' => trim($_POST['nro_dni']),      
        'cuil' => trim($_POST['cuil']),                    
        'tipo_usu' => $puedeAsignarRoles && isset($_POST['tipo_usu']) && $_POST['tipo_usu'] !== null 
                      ? trim($_POST['tipo_usu']) : 'Usuario',
        'usuario' => trim($_POST['usuario']),
        'password' => trim($_POST['password']),
        'cv' => '',
        'catedra_id' => $tipo_usu === 'JC' ? $_POST['catedra_id'] : null 
      ];

      $datosValidados = $this->validarDatosUsuario($datos);

      $errores = [];

      if ($datos['tipo_usu'] === 'JC' && empty($datos['catedra_id'])) {
        $errores[] = "El campo catedra_id es obligatorio para Jefe de Cátedra.";
      }

      if (is_array($datosValidados)) {
        $errores = array_merge($errores, $datosValidados);
        if (!empty($errores)) {
          $datos = ['errores' => $errores];
          $this->vista('paginas/usuario/agregar', $datos);
        }
      } else {

        if (!empty($_FILES['cv']['tmp_name']) && file_exists($_FILES['cv']['tmp_name'])) {
          $fileName = $_FILES['cv']['name'];
          $fileTmpName = $_FILES['cv']['tmp_name'];
          $fileSize = $_FILES['cv']['size'];
          $fileError = $_FILES['cv']['error'];
          $fileExt = explode('.', $fileName);

          $fileActualExt = strtolower(end($fileExt));
          $allow = array('pdf');

          if (in_array($fileActualExt, $allow)) {
            if ($fileError === 0) {
              if ($fileSize < 1000000) {

                $fileNewName = uniqid('', true).".".$fileActualExt;                
                $fileDestination = $this->uploadPath . $fileNewName;

                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                  $datos['cv'] = $fileNewName;
                } else {
                  echo "Error al subir el archivo.";
                }
              } else {
                echo "Tu archivo es muy grande!";
              }
            } else {
              echo "Ocurrió un error al cargar el archivo!";
            }
          } else {
            echo "No puede subir archivos de ese tipo!";
          }
        } 

        $passwordHash = password_hash($datos['password'], PASSWORD_DEFAULT);
        $datos['password'] = $passwordHash;

        if ($this->usuarioModelo->agregarUsuario($datos)) {
          if (!isset($_SESSION['usuario_id'])) {
            $_SESSION['mensaje_exito'] = 'Usuario creado exitosamente. Por favor, inicie sesión.';
            redireccionar('/paginas/login');
          } else {
            redireccionar('/usuariocontroller/listarUsuarios?toast=usuarioCreado');
          }
        } else {
          if (file_exists($fileDestination)) {
            unlink($fileDestination);
          }
          die('Algo salió mal');
        }
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
        'usuario' => '',
        'password' => '',                  
        'cv' => '',
        'catedras' => $catedras
      ];

      $this->vista('paginas/usuario/agregar', $datos);
    }
  }

  public function editarUsuario($id) {
    if (!isset($_SESSION['usuario_id'])) {
      redireccionar('/');
    }

    // Solo permitir editar su propio perfil o ser Admin
    if ($_SESSION['usuario_id'] != $id && 
      $_SESSION['tipo_usu'] !== 'Admin') {
      redireccionar('/');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $usuario = $this->usuarioModelo->obtenerUsuarioId($id);

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
        'tipo_usu' => $_SESSION['tipo_usu'] === 'Admin' ? 
                      trim($_POST['tipo_usu']) : $usuario->tipo_usu,
        'usuario' => trim($_POST['usuario']),
        'password' => !empty(trim($_POST['password'])) ? trim($_POST['password']) : $usuario->password, 
        'cv' => isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK ? $_FILES['cv']['name'] : $usuario->cv, 
      ];

      if (!empty($_POST['password'])) {
        $datosValidados = $this->validarDatosUsuario($datos);
      } else {
        $datosValidados = $this->validarDatosUsuarioSinPassword($datos);
      }

      if (is_array($datosValidados)) {
        foreach ($datosValidados as $error) {
          echo $error . "<br/>";
        }
      } elseif ($datosValidados === true) {

        if (!empty($_FILES['cv']['tmp_name']) && file_exists($_FILES['cv']['tmp_name'])) {
          $fileName = $_FILES['cv']['name'];
          $fileTmpName = $_FILES['cv']['tmp_name'];
          $fileSize = $_FILES['cv']['size'];
          $fileError = $_FILES['cv']['error'];
          $fileExt = explode('.', $fileName);

          $fileActualExt = strtolower(end($fileExt));
          $allow = array('pdf');

          if (in_array($fileActualExt, $allow)) {
            if ($fileError === 0) {
              if ($fileSize < 1000000) {

                $fileNewName = uniqid('', true).".".$fileActualExt;                
                $fileDestination = $this->uploadPath . $fileNewName;

                if (move_uploaded_file($fileTmpName, $fileDestination)) {

                  $oldFilePath = $this->uploadPath . $usuario->cv;
                  if (!empty($usuario->cv) && file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                  }

                  $datos['cv'] = $fileNewName;

                } else {
                  echo "Error al subir el archivo.";
                }
              } else {
                echo "Tu archivo es muy grande!";
              }
            } else {
              echo "Ocurrió un error al cargar el archivo!";
            }
          } else {
            echo "No puede subir archivos de ese tipo!";
          }
        }

        if (!empty($_POST['password'])) {
          $passwordHash = password_hash($datos['password'], PASSWORD_DEFAULT);
          $datos['password'] = $passwordHash;
        }

        if ($this->usuarioModelo->actualizarUsuario($datos)) {   
          if ($_SESSION['tipo_usu'] == 'Usuario') {
            $_SESSION['mensaje'] = 'Datos actualizados correctamente';
            redireccionar('/');
          }
          redireccionar('/usuariocontroller/listarusuarios');
        } else {
          if (!empty($fileDestination) && file_exists($fileDestination)) {
            unlink($fileDestination);
          }
          die('Algo salió mal al actualizar el usuario');        
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
        'usuario' => $usuario->usuario,
        'password' => $usuario->password,
        'cv' => $usuario->cv,
        'mostrar_tipo_usu' => in_array($_SESSION['tipo_usu'], ['Admin', 'RA'])
      ];

        $this->vista('paginas/usuario/editar', $datos);
    }

  }

  public function borrarUsuario($id) {

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      
      $id = $_POST['id'];

      if($this->usuarioModelo->borrarUsuario($id)) {
        redireccionar('/usuariocontroller/listarUsuarios');
      } else {
        die('Algo salio mal');
      }
    }
  }

  public function listarUsuarios() {
    if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usu'] !== 'Admin') {
      redireccionar('/');
    }

    $usuarios = $this->usuarioModelo->obtenerUsuarios();
    $datos = ['usuarios' => $usuarios];
    $this->vista('paginas/usuario/listar', $datos);
  }

  private function validarDatosUsuario($datos) {
    $errores = [];
    if (empty($datos['nombre'])) {
      $errores['nombre'] = 'El nombre es obligatorio';
    }

    if (empty($datos['apellido'])) {
      $errores['apellido'] = 'El apellido es obligatorio';
    }

    if (empty($datos['sexo'])) {
      $errores['sexo'] = 'El sexo es obligatorio';
    }

    if (empty($datos['direccion'])) {
      $errores['direccion'] = 'La direccion es obligatoria';
    }

    if (empty($datos['telefono'])) {
      $errores['telefono'] = 'El telefono es obligatorio';
    }

    if (empty($datos['cuil'])) {
      $errores['cuil'] = 'El cuil es obligatorio';
    } elseif (strlen($datos['cuil']) !== 11) {
      $errores['cuil'] = 'El número de cuil debe tener exactamente 11 dígitos';
    }

    if (empty($datos['email'])) {
      $errores['email'] = 'El email es obligatorio';
    } elseif (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
      $errores['email'] = 'El correo electrónico no tiene un formato válido';
    }

    if (empty($datos['fecha_nac'])) {
      $errores['fecha_nac'] = 'La fecha de nacimiento es obligatoria';
    }

    if (empty($datos['usuario'])) {
      $errores['usuario'] = 'El nombre de usuario es obligatorio';
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $datos['usuario'])) {
      $errores['usuario'] = 'El nombre de usuario solo puede contener letras, números y guiones bajos';
    }

    if (empty($datos['password'])) {
      $errores['password'] = 'La contraseña es obligatoria';
    } else {
      if (strlen($datos['password']) < 8) {
        $errores['password'] = 'La contraseña debe tener al menos 8 caracteres';
      } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]+$/', $datos['password'])) {
        $errores['password'] = 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula y un número';
      }
    }

    if (empty($datos['nro_dni'])) {
      $errores['nro_dni'] = 'El número de DNI es obligatorio';
    } elseif (!ctype_digit($datos['nro_dni'])) {
      $errores['nro_dni'] = 'El número de DNI debe contener solo dígitos numéricos';
    } elseif (strlen($datos['nro_dni']) !== 8) {
      $errores['nro_dni'] = 'El número de DNI debe tener exactamente 8 dígitos';
    }

    if (!empty($errores)){
      return $errores;
    } else {
      return true;
    }
  }

  private function validarDatosUsuarioSinPassword($datos) {
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

  public function descargarCV($id) {
    if (!isset($_SESSION['usuario_id']) || !in_array($_SESSION['tipo_usu'], ['Admin', 'RA', 'JC'])) {
      redireccionar('/');
    }

    $usuario = $this->usuarioModelo->obtenerUsuarioId($id);
    if ($usuario) {
      $cvPath = RUTA_APP . '/uploads/' . $usuario->cv;
      
      if (file_exists($cvPath)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="CV_' . $usuario->apellido . '_' . $usuario->nombre . '.pdf"');
        header('Content-Length: ' . filesize($cvPath));
        readfile($cvPath);
        exit;
      }
    }
    
    $_SESSION['mensaje_error'] = 'No se pudo descargar el CV';
    redireccionar('/');
  }
}