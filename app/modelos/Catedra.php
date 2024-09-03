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
    $this->db->query('INSERT INTO catedras (nombre, descrip, [plan], ano_cursado, hs_semanales,
                      tipo_cursado, electiva, area_id) VALUES (:nombre, :descrip, :plan, 
                      :ano_cursado, :hs_semanales, :tipo_cursado, :electiva, :area_id)');

    $this->db->bind(':nombre', $datos['nombre']);
    $this->db->bind(':descrip', $datos['descrip']);
    $this->db->bind(':plan', $datos['plan']);
    $this->db->bind(':ano_cursado', $datos['ano_cursado']);
    $this->db->bind(':hs_semanales', $datos['hs_semanales']);
    $this->db->bind(':tipo_cursado', $datos['tipo_cursado']);
    $this->db->bind(':electiva', $datos['electiva']);
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

    $this->db->query('UPDATE catedras SET nombre = :nombre, descrip = :descrip, [plan] = :plan,
                    ano_cursado = :ano_cursado, hs_semanales = :hs_semanales, 
                    tipo_cursado = :tipo_cursado, electiva = :electiva, area_id = :area_id 
                    WHERE id = :id');

    $this->db->bind(':id', $datos['id']);
    $this->db->bind(':nombre', $datos['nombre']);
    $this->db->bind(':descrip', $datos['descrip']);
    $this->db->bind(':plan', $datos['plan']);
    $this->db->bind(':ano_cursado', $datos['ano_cursado']);
    $this->db->bind(':hs_semanales', $datos['hs_semanales']);
    $this->db->bind(':tipo_cursado', $datos['tipo_cursado']);
    $this->db->bind(':electiva', $datos['electiva']);
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

  public function contarCatedras() {
    $this->db->query("SELECT COUNT(*) AS total FROM catedras");
    return $this->db->registro()->total;
  }

  public function obtenerCatedrasPaginados($pagina, $registrosPorPagina) {
    $inicio = ($pagina - 1) * $registrosPorPagina;
    $this->db->query("SELECT * FROM catedras ORDER BY id OFFSET :inicio ROWS FETCH NEXT :registrosPorPagina ROWS ONLY");    
    $this->db->bind(':inicio', $inicio, PDO::PARAM_INT);
    $this->db->bind(':registrosPorPagina', $registrosPorPagina, PDO::PARAM_INT);

    return $this->db->registros();
  }

  public function obtenerCatedrasPorUsuarioId($usuarioId) {
    $this->db->query('SELECT c.*
                      FROM catedras c
                      INNER JOIN jefes_catedras jc 
                        ON c.id = jc.catedra_id
                      WHERE jc.usuario_id = :usuario_id');

    $this->db->bind(':usuario_id', $usuarioId);
    
    $resultados = $this->db->registros();
    return $resultados;
  }
  
}