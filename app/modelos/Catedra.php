<?php 

  class Catedra {

    private $db;

    public function __construct() {
      $this->db = new Base;   
    }

    public function obtenerCatedras() {

      $this->db->query('SELECT * FROM catedras');
      $resultados = $this->db->registros();
      return $resultados;
    }

    public function agregarCatedra($datos) {
      $this->db->query('INSERT INTO catedras (nombre, descrip, plan, ano_cursado, hs_semanales,
                        tipo_cursado, electiva, titulacion, area_id) VALUES (:nombre, :descrip, :plan, 
                        :ano_cursado, :hs_semanales, :tipo_cursado, :electiva, :titulacion, :area_id)');

      $this->db->bind(':nombre', $datos['nombre']);
      $this->db->bind(':descrip', $datos['descrip']);
      $this->db->bind(':plan', $datos['plan']);
      $this->db->bind(':ano_cursado', $datos['ano_cursado']);
      $this->db->bind(':hs_semanales', $datos['hs_semanales']);
      $this->db->bind(':tipo_cursado', $datos['tipo_cursado']);
      $this->db->bind(':electiva', $datos['electiva']);
      $this->db->bind(':titulacion', $datos['titulacion']);
      $this->db->bind(':area_id', $datos['area_id']);
      
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function obtenerCatedraId($id) {
      $this->db->query('SELECT * FROM catedras WHERE id = :id');
      $this->db->bind(':id', $id);

      $fila = $this->db->registro();

      return $fila;
    }

    public function actualizarCatedra($datos) {
  
      $this->db->query('UPDATE catedras SET nombre = :nombre, descrip = :descrip, plan = :plan,
                      ano_cursado = :ano_cursado, hs_semanales = :hs_semanales, 
                      tipo_cursado = :tipo_cursado, electiva = :electiva, 
                      titulacion = :titulacion, area_id = :area_id 
                      WHERE id = :id');

      $this->db->bind(':id', $datos['id']);
      $this->db->bind(':nombre', $datos['nombre']);
      $this->db->bind(':descrip', $datos['descrip']);
      $this->db->bind(':plan', $datos['plan']);
      $this->db->bind(':ano_cursado', $datos['ano_cursado']);
      $this->db->bind(':hs_semanales', $datos['hs_semanales']);
      $this->db->bind(':tipo_cursado', $datos['tipo_cursado']);
      $this->db->bind(':electiva', $datos['electiva']);
      $this->db->bind(':titulacion', $datos['titulacion']);
      $this->db->bind(':area_id', $datos['area_id']);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function borrarCatedra($id) {
      $this->db->query('DELETE FROM catedras WHERE id = :id');
      
      $this->db->bind(':id', $id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
      
    }

  }
?>