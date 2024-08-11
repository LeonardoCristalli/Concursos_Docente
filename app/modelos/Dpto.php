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

  public function contarDptos() {
    $this->db->query("SELECT COUNT(*) AS total FROM dptos");
    return $this->db->registro()->total;
  }

  public function obtenerDptosPaginados($pagina, $registrosPorPagina) {
    $inicio = ($pagina - 1) * $registrosPorPagina;
    $this->db->query("SELECT * FROM dptos ORDER BY id OFFSET :inicio ROWS FETCH NEXT :registrosPorPagina ROWS ONLY");    
    $this->db->bind(':inicio', $inicio, PDO::PARAM_INT);
    $this->db->bind(':registrosPorPagina', $registrosPorPagina, PDO::PARAM_INT);

    return $this->db->registros();
  }
}