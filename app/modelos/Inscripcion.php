<?php 

class Inscripcion {
  private $db;

  public function __construct() {
    $this->db = new Base; 
  }

  public function obtenerInscripciones() {

    $this->db->query('SELECT * FROM inscripciones');
    $resultados = $this->db->registros();
    return $resultados;
  }

  public function crearInscripcion($datos) {
    $this->db->query('INSERT INTO inscripciones (vacante_id, usuario_id, fecha) 
                      VALUES (:vacante_id, :usuario_id, :fecha)');

    $this->db->bind(':vacante_id', $datos['vacante_id']);
    $this->db->bind(':usuario_id', $datos['usuario_id']);
    $this->db->bind(':fecha', $datos['fecha']);
    
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function obtenerInscripcionId($id) {
    $this->db->query('SELECT * FROM inscripciones WHERE id = :id');
    $this->db->bind(':id', $id);

    $fila = $this->db->registro();

    return $fila; 
  }

  public function actualizarInscripcion($datos) {

    $this->db->query('UPDATE inscripciones SET vacante_id = :vacante_id, usuario_id = :usuario_id, fecha = :fecha, puntaje = :puntaje 
                      WHERE id = :id');

    $this->db->bind(':vacante_id', $datos['vacante_id']);
    $this->db->bind(':usuario_id', $datos['usuario_id']);
    $this->db->bind(':fecha', $datos['fecha']);
    $this->db->bind(':puntaje', $datos['puntaje']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function borrarInscripcion($id) {
    $this->db->query('DELETE FROM inscripciones WHERE id = :id');
    
    $this->db->bind(':id', $id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
    
  }

  public function estaInscrito($usuario_id, $vacante_id) {
    $this->db->query('SELECT * FROM inscripciones WHERE usuario_id = :usuario_id AND vacante_id = :vacante_id');
    $this->db->bind(':usuario_id', $usuario_id);
    $this->db->bind(':vacante_id', $vacante_id);

    $fila = $this->db->registro();

    if ($fila) {
        return true;
    } else {
        return false;
    }
  }

}

?>