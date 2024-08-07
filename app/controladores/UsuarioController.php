<?php 
class UsuarioController extends Controlador {
  private $usuarioModelo;

  public function __construct() {
    $this->usuarioModelo = $this->modelo('Usuario');
  }

  public function agregarUsuario() {
    session_start();

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
        'cv' => ''
      ];

      $datosValidados = $this->validarDatosUsuario($datos);

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
                $fileDestination = 'C:/xampp/htdocs/Concursos_Docente/uploads/' . $fileNewName;

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
            redireccionar('/paginas/login');
          } else {
            $usuarios = $this->usuarioModelo->obtenerUsuarios();
            $datos = [
              'usuarios' => $usuarios
            ];

            $this->vista('paginas/usuario/listar', $datos);
          }                      
        } else {
          if (file_exists($fileDestination)) {
            unlink($fileDestination);
          }
          echo "No se pudo agregar el usuario.";
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
        'cv' => '',
      ];

      $this->vista('paginas/usuario/agregar', $datos);
    }
  }

  public function editarUsuario($id) {
    session_start();

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
        'cv' => trim($_POST['cv']),
      ];
      
      $datosValidados = $this->validarDatosUsuario($datos);

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
                $fileDestination = 'C:/xampp/htdocs/Concursos_Docente/public/uploads/' . $fileNewName;

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

        if ($this->usuarioModelo->actualizarUsuario($datos)) {   
          $usuarios = $this->usuarioModelo->obtenerUsuarios();
          $datos = [
            'usuarios' => $usuarios
          ];

          $this->vista('paginas/usuario/listar', $datos);

        } else {
          if (file_exists($fileDestination)) {
            unlink($fileDestination);
          }
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
        'cv' => $usuario->cv,
      ];

        $this->vista('paginas/usuario/editar', $datos);
    }

  }

  public function borrarUsuario($id) {

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      
      $id = $_POST['id'];

      if($this->usuarioModelo->borrarUsuario($id)) {
        $usuarios = $this->usuarioModelo->obtenerUsuarios();
        $datos = [
          'usuarios' => $usuarios
        ];

        $this->vista('paginas/usuario/listar', $datos);
      } else {
        die('Algo salio mal');
      }
    }
  }

  public function listarUsuarios() {
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $registrosPorPagina = 3;
    $totalRegistros = $this->usuarioModelo->contarUsuarios();
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

    $usuarios = $this->usuarioModelo->obtenerUsuariosPaginados($pagina, $registrosPorPagina);

    $datos = [
      'usuarios' => $usuarios,
      'totalPaginas' => $totalPaginas,
      'paginaActual' => $pagina
    ];

    $this->vista('paginas/usuario/listar', $datos);
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
    } else {
      if (strlen($datos['password']) < 8) {
        $errores[] = 'La contraseña debe tener al menos 8 caracteres';
      } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]+$/', $datos['password'])) {
        $errores[] = 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula y un número';
      }
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

  public function descargarCV($cv) { 
    session_start();

    $file_path = 'C:\xampp\htdocs\Concursos_Docente\public\uploads\\' . $cv;
     echo $file_path;

     $rta1 = !empty($cv);
     
     $rta2 = file_exists($file_path);
     var_dump($rta1);
     var_dump($rta2);

    if(!empty($cv) && file_exists($file_path)) {
      
      header('Cache-Control: public');
      header('Content-Description: File Transfer');
      header('Content-Type: application/pdf');
      header('Content-Disposition: attachment; filename="' . $cv . '"');
      header('Content-Length: ' . filesize($file_path));
      header('Content-Transfer-Encoding: binary');

      readfile($file_path);
      exit;
      

    } else {
      echo "El archivo no existe.";
      redireccionar('/paginas/RAPanel');
    }
  }
}