<?php 

  class Estado {
    private $db;

    public function __construct() {
      $this->db = new Base;   
    }

    public function obtenerEstados() {

      $this->db->query('SELECT * FROM estados');
      $resultados = $this->db->registros();
      return $resultados;
    }

    public function agregarEstado($datos) {
      $this->db->query('INSERT INTO estados (descrip) VALUES (:descrip)');

      $this->db->bind(':descrip', $datos['descrip']);
      
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function obtenerEstadoId($id) {
      $this->db->query('SELECT * FROM estados WHERE id = :id');
      $this->db->bind(':id', $id);

      $fila = $this->db->registro();

      return $fila;
    }

    public function actualizarEstado($datos) {
  
      $this->db->query('UPDATE estados SET descrip = :descrip WHERE id = :id');

      $this->db->bind(':id', $datos['id']);
      $this->db->bind(':descrip', $datos['descrip']);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function borrarEstado($id) {
      $this->db->query('DELETE FROM estados WHERE id = :id');
      
      $this->db->bind(':id', $id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
      
    }

  }
?>