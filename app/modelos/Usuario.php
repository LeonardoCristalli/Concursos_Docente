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
      $this->db->query('INSERT INTO usuarios (nombre, apellido, sexo, direccion, telefono, 
                        cuil, email, fecha_nac, tipo_usu, nro_legajo, usuario, password, nro_dni) 
                        VALUES (:nombre, :apellido, :sexo, :direccion, :telefono, :cuil, :email, 
                        :fecha_nac, :tipo_usu, :nro_legajo, :usuario, :password, :nro_dni)');

      $this->db->bind(':nombre', $datos['nombre']);
      $this->db->bind(':apellido', $datos['apellido']);
      $this->db->bind(':sexo', $datos['sexo']);
      $this->db->bind(':direccion', $datos['direccion']);
      $this->db->bind(':telefono', $datos['telefono']);
      $this->db->bind(':cuil', $datos['cuil']);
      $this->db->bind(':email', $datos['email']);
      $this->db->bind(':fecha_nac', $datos['fecha_nac']);
      $this->db->bind(':tipo_usu', $datos['tipo_usu']);
      $this->db->bind(':nro_legajo', $datos['nro_legajo']);
      $this->db->bind(':usuario', $datos['usuario']);
      $this->db->bind(':password', $datos['password']);
      $this->db->bind(':nro_dni', $datos['nro_dni']);

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
  
      $this->db->query('UPDATE usuarios SET nombre = :nombre, apellido = :apellido, sexo = :sexo,
            direccion = :direccion, telefono = :telefono, cuil = :cuil, email = :email,
            fecha_nac = :fecha_nac, tipo_usu = :tipo_usu, nro_legajo = :nro_legajo,
            usuario = :usuario, password = :password, nro_dni = :nro_dni
            WHERE id = :id');

      $this->db->bind(':id', $datos['id']);
      $this->db->bind(':nombre', $datos['nombre']);
      $this->db->bind(':apellido', $datos['apellido']);
      $this->db->bind(':sexo', $datos['sexo']);
      $this->db->bind(':direccion', $datos['direccion']);
      $this->db->bind(':telefono', $datos['telefono']);
      $this->db->bind(':cuil', $datos['cuil']);
      $this->db->bind(':email', $datos['email']);
      $this->db->bind(':fecha_nac', $datos['fecha_nac']);
      $this->db->bind(':tipo_usu', $datos['tipo_usu']);
      $this->db->bind(':nro_legajo', $datos['nro_legajo']);
      $this->db->bind(':usuario', $datos['usuario']);
      $this->db->bind(':password', $datos['password']);
      $this->db->bind(':nro_dni', $datos['nro_dni']);

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

  }
?>