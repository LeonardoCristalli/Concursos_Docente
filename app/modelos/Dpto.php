<?php 

  class Dpto {
    private $db;

    public function __construct() {
      $this->db = new Base;   
    }

    public function obtenerDptos() {

      $this->db->query('SELECT * FROM dptos');
      $resultados = $this->db->registros();
      return $resultados;
    }

    public function agregarDpto($datos) {
      $this->db->query('INSERT INTO dptos (nombre) VALUES (:nombre)');

      $this->db->bind(':nombre', $datos['nombre']);
      
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function obtenerDptoId($id) {
      $this->db->query('SELECT * FROM dptos WHERE id = :id');
      $this->db->bind(':id', $id);

      $fila = $this->db->registro();

      return $fila;
    }

    public function actualizarDpto($datos) {
  
      $this->db->query('UPDATE dptos SET nombre = :nombre WHERE id = :id');

      $this->db->bind(':id', $datos['id']);
      $this->db->bind(':nombre', $datos['nombre']);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function borrarDpto($id) {
      $this->db->query('DELETE FROM dptos WHERE id = :id');
      
      $this->db->bind(':id', $id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
      
    }

  }
?>