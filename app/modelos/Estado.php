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

  public function borrarDpto($id) {
    $this->db->query('DELETE FROM dptos WHERE id = :id');
    
    $this->db->bind(':id', $id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
    
  }

  public function contarEstados() {
    $this->db->query("SELECT COUNT(*) AS total FROM estados");
    return $this->db->registro()->total;
  }

  public function obtenerEstadosPaginados($pagina, $registrosPorPagina) {
    $inicio = ($pagina - 1) * $registrosPorPagina;
    $this->db->query("SELECT * FROM estados ORDER BY id OFFSET :inicio ROWS FETCH NEXT :registrosPorPagina ROWS ONLY");    
    $this->db->bind(':inicio', $inicio, PDO::PARAM_INT);
    $this->db->bind(':registrosPorPagina', $registrosPorPagina, PDO::PARAM_INT);

    return $this->db->registros();
  }

}