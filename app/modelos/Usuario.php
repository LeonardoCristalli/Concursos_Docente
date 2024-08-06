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

}