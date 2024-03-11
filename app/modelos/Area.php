<?php 

  class Area {
    private $db;

    public function __construct() {
      $this->db = new Base;   
    }

    public function obtenerAreas() {

      $this->db->query('SELECT * FROM areas');
      $resultados = $this->db->registros();
      return $resultados;
    }

    public function agregarArea($datos) {
      $this->db->query('INSERT INTO areas (nombre, dpto_id) VALUES (:nombre, :dpto_id)');

      $this->db->bind(':nombre', $datos['nombre']);
      $this->db->bind(':dpto_id', $datos['dpto_id']);
      
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function obtenerAreaId($id) {
      $this->db->query('SELECT * FROM areas WHERE id = :id');
      $this->db->bind(':id', $id);

      $fila = $this->db->registro();

      return $fila;
    }

    public function actualizarArea($datos) {
  
      $this->db->query('UPDATE areas SET nombre = :nombre, dpto_id = :dpto_id WHERE id = :id');

      $this->db->bind(':id', $datos['id']);
      $this->db->bind(':nombre', $datos['nombre']);
      $this->db->bind(':dpto_id', $datos['dpto_id']);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function borrarArea($id) {
      $this->db->query('DELETE FROM areas WHERE id = :id');
      
      $this->db->bind(':id', $id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
      
    }

  }
?>