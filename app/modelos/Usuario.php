<?php 

class Usuario {
  private $db;

  public function __construct() {
    $this->db = new Base;   
  }

  public function obtenerUsuarios() {
    $this->db->query('SELECT * FROM usuarios');
    $resultados = $this->db->registros();      
    return $resultados;
  }

  public function agregarUsuario($datos) {
    $this->db->query('INSERT INTO usuarios (nombre, apellido, fecha_nac, sexo, direccion, telefono, nro_dni, email, 
                                  cuil, tipo_usu, nro_legajo, usuario, password, cv) 
                      VALUES (:nombre, :apellido, :fecha_nac, :sexo, :direccion, :telefono, :nro_dni, :email, :cuil, 
                              :tipo_usu, :nro_legajo, :usuario, :password, :cv)');
    
    $this->db->bind(':nombre', $datos['nombre']);
    $this->db->bind(':apellido', $datos['apellido']);
    $this->db->bind(':fecha_nac', $datos['fecha_nac']);
    $this->db->bind(':sexo', $datos['sexo']);
    $this->db->bind(':direccion', $datos['direccion']);
    $this->db->bind(':telefono', $datos['telefono']);
    $this->db->bind(':nro_dni', $datos['nro_dni']);
    $this->db->bind(':email', $datos['email']);
    $this->db->bind(':cuil', $datos['cuil']);
    $this->db->bind(':tipo_usu', $datos['tipo_usu']);
    $this->db->bind(':nro_legajo', $datos['nro_legajo']);
    $this->db->bind(':usuario', $datos['usuario']);
    $this->db->bind(':password', $datos['password']);
    $this->db->bind(':cv', $datos['cv']);

    if ($this->db->execute()) {

      $pdo = $this->db->obtenerConexionPDO();
      $usuario_id = $pdo->lastInsertId();

      if ($datos['tipo_usu'] === 'JC') {
        $catedra_id = $datos['catedra_id'];
        $fecha_desde = date('Y-m-d');  

        $this->db->query('INSERT INTO jefes_catedras (catedra_id, usuario_id, fecha_desde) 
                          VALUES (:catedra_id, :usuario_id, :fecha_desde)');

        $this->db->bind(':catedra_id', $catedra_id);
        $this->db->bind(':usuario_id', $usuario_id);
        $this->db->bind(':fecha_desde', $fecha_desde);

        if (!$this->db->execute()) {
          return false;  
        }        
      }
      
      return true;  
    } else {
      return false;  
    }
  }

  public function obtenerUsuarioId($id) {
    $this->db->query('SELECT * FROM usuarios WHERE id = :id');
    $this->db->bind(':id', $id);

    $fila = $this->db->registro();

    return $fila;
  }

  public function actualizarUsuario($datos) {

    $this->db->query('UPDATE usuarios SET nombre = :nombre, apellido = :apellido, fecha_nac = :fecha_nac, sexo = :sexo,
                      direccion = :direccion, telefono = :telefono, nro_dni = :nro_dni, email = :email, cuil = :cuil,  
                      tipo_usu = :tipo_usu, nro_legajo = :nro_legajo, usuario = :usuario, password = :password, cv = :cv
                      WHERE id = :id');

    $this->db->bind(':id', $datos['id']);
    $this->db->bind(':nombre', $datos['nombre']);
    $this->db->bind(':apellido', $datos['apellido']);
    $this->db->bind(':fecha_nac', $datos['fecha_nac']);
    $this->db->bind(':sexo', $datos['sexo']);
    $this->db->bind(':direccion', $datos['direccion']);
    $this->db->bind(':telefono', $datos['telefono']);
    $this->db->bind(':nro_dni', $datos['nro_dni']);     
    $this->db->bind(':email', $datos['email']);
    $this->db->bind(':cuil', $datos['cuil']);      
    $this->db->bind(':tipo_usu', $datos['tipo_usu']);
    $this->db->bind(':nro_legajo', $datos['nro_legajo']);
    $this->db->bind(':usuario', $datos['usuario']);
    $this->db->bind(':password', $datos['password']);
    $this->db->bind(':cv', $datos['cv']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function borrarUsuario($id) {
    $this->db->query('DELETE FROM usuarios WHERE id = :id');
    
    $this->db->bind(':id', $id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function obtenerUsuarioPorNombre($nombreUsuario) {
    try {
      $this->db->query('SELECT * FROM usuarios WHERE usuario = :usuario');
      $this->db->bind(':usuario', $nombreUsuario);
      $this->db->execute();
      return $this->db->registro();
    } catch (PDOException $e) {
      error_log('Error al obtener usuario por nombre: ' . $e->getMessage());
      return null;
    }      
  }

  public function contarUsuarios() {
    $this->db->query("SELECT COUNT(*) AS total FROM usuarios");
    return $this->db->registro()->total;
  }

  public function obtenerUsuariosPaginados($pagina, $registrosPorPagina) {
    $inicio = ($pagina - 1) * $registrosPorPagina;
    $this->db->query("SELECT * FROM usuarios ORDER BY id OFFSET :inicio ROWS FETCH NEXT :registrosPorPagina ROWS ONLY");    
    $this->db->bind(':inicio', $inicio, PDO::PARAM_INT);
    $this->db->bind(':registrosPorPagina', $registrosPorPagina, PDO::PARAM_INT);

    return $this->db->registros();
  }

  public function obtenerUsuarioPorEmail($email) {
    try {
      $this->db->query('SELECT * FROM usuarios WHERE email = :email');
      $this->db->bind(':email', $email);
      $this->db->execute();
      
      return $this->db->registro();
    } catch (PDOException $e) {
        error_log('Error al obtener usuario por email: ' . $e->getMessage());
      return null;
    }
  }

  public function guardarTokenDeRecuperacion($idUsuario, $token) {
    $fechaExp = date('Y-m-d H:i:s', strtotime('+1 hour'));

    $this->db->query("SELECT COUNT(*) as count FROM tokens_recuperacion WHERE id_usuario = :id_usuario");
    $this->db->bind(':id_usuario', $idUsuario);
    $row = $this->db->single();

    if ($row->count > 0) {
      $this->db->query("UPDATE tokens_recuperacion 
                        SET token = :token, fecha_creacion = GETDATE(), fecha_exp = :fecha_exp 
                        WHERE id_usuario = :id_usuario");
    } else {
        $this->db->query("INSERT INTO tokens_recuperacion (id_usuario, token, fecha_creacion, fecha_exp) 
                          VALUES (:id_usuario, :token, GETDATE(), :fecha_exp)");
    }

    $this->db->bind(':id_usuario', $idUsuario);
    $this->db->bind(':token', $token);
    $this->db->bind(':fecha_exp', $fechaExp);


    return $this->db->execute();
  }

  public function obtenerUsuarioPorToken($token) {
    try {
      $this->db->query('SELECT id_usuario FROM tokens_recuperacion WHERE token = :token AND fecha_exp > GETDATE()');

      $this->db->bind(':token', $token);
      $tokenData = $this->db->registro();

      if (!$tokenData) {
        return null;
      }

      $idUsuario = $tokenData->id_usuario;

      $this->db->query('SELECT * FROM usuarios WHERE id = :id');
      $this->db->bind(':id', $idUsuario);

      $usuario = $this->db->registro();

      return $usuario;

    } catch (PDOException $e) {
      error_log('Error al obtener usuario por token: ' . $e->getMessage());
      return null;
    }
  }

  public function actualizarPW($token, $nuevaPassword) {
    try {
      $this->db->query('SELECT id_usuario FROM tokens_recuperacion WHERE token = :token AND fecha_exp > GETDATE()');
      $this->db->bind(':token', $token);
      $tokenData = $this->db->registro();

      if (!$tokenData) {
        return false;
      }

      $idUsuario = $tokenData->id_usuario;

      $this->db->query('UPDATE usuarios SET password = :password WHERE id = :id');
      $this->db->bind(':id', $idUsuario);
      $this->db->bind(':password', $nuevaPassword);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      error_log('Error al actualizar la contraseña: ' . $e->getMessage());
      return false;
    }
  }

}