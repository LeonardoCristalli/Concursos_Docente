<?php 

  class Vacante {

    private $db;

    public function __construct() {
      $this->db = new Base;   
    }

    public function obtenerVacantes() {

      $this->db->query('SELECT * FROM vacantes');
      $resultados = $this->db->registros();
      return $resultados;
    }

    public function agregarVacante($datos) {
      $this->db->query('INSERT INTO vacantes (descrip, fecha_ini, fecha_fin, req, tiempo, exp,
                      motivo_id, estado_id, catedra_id) VALUES (:descrip, :fecha_ini, :fecha_fin,
                      :req, :tiempo, :exp, :motivo_id, :estado_id, :catedra_id)');

      $this->db->bind(':descrip', $datos['descrip']);
      $this->db->bind(':fecha_ini', $datos['fecha_ini']);
      $this->db->bind(':fecha_fin', $datos['fecha_fin']);
      $this->db->bind(':req', $datos['req']);
      $this->db->bind(':tiempo', $datos['tiempo']);
      $this->db->bind(':exp', $datos['exp']);
      $this->db->bind(':motivo_id', $datos['motivo_id']);
      $this->db->bind(':estado_id', $datos['estado_id']);
      $this->db->bind(':catedra_id', $datos['catedra_id']);
      
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function obtenerVacanteId($id) {
      $this->db->query('SELECT * FROM vacantes WHERE id = :id');
      $this->db->bind(':id', $id);

      $fila = $this->db->registro();

      return $fila;
    }

    public function actualizarVacante($datos) {
  
      $this->db->query('UPDATE vacantes SET descrip = :descrip, fecha_ini = :fecha_ini,
                      fecha_fin = :fecha_fin, req = :req, tiempo = :tiempo, exp = :exp, 
                      motivo_id = :motivo_id, estado_id = :estado_id, catedra_id = :catedra_id 
                      WHERE id = :id');

      $this->db->bind(':id', $datos['id']);
      $this->db->bind(':descrip', $datos['descrip']);
      $this->db->bind(':fecha_ini', $datos['fecha_ini']);
      $this->db->bind(':fecha_fin', $datos['fecha_fin']);
      $this->db->bind(':req', $datos['req']);
      $this->db->bind(':tiempo', $datos['tiempo']);
      $this->db->bind(':exp', $datos['exp']);
      $this->db->bind(':motivo_id', $datos['motivo_id']);
      $this->db->bind(':estado_id', $datos['estado_id']);
      $this->db->bind(':catedra_id', $datos['catedra_id']);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function borrarVacante($id) {
      $this->db->query('DELETE FROM vacantes WHERE id = :id');
      
      $this->db->bind(':id', $id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
      
    }

  }
?>