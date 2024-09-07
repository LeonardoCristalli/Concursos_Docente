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

  public function borrarInscripcion($vacante_id, $usuario_id) {
    $this->db->query('DELETE FROM inscripciones WHERE vacante_id = :vacante_id AND usuario_id = :usuario_id');
    
    $this->db->bind(':vacante_id', $vacante_id);
    $this->db->bind(':usuario_id', $usuario_id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
    
  }

  public function estaInscripto($usuario_id, $vacante_id) {
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

  public function obtenerDetallesInscripPorVacanteId($vacante_id) {
    $this->db->query('SELECT i.*,  u.nombre, u.apellido, u.usuario, u.cv
                      FROM inscripciones i 
                      INNER JOIN usuarios u 
                        ON i.usuario_id = u.id 
                      WHERE i.vacante_id = :vacante_id');

    $this->db->bind(':vacante_id', $vacante_id);

    $resultados = $this->db->registros();
    return $resultados;
  }

  public function asignarPuntaje($vacanteId, $usuarioId, $puntaje) {
   
    $this->db->query('UPDATE inscripciones SET puntaje = :puntaje WHERE vacante_id = :vacante_id AND usuario_id = :usuario_id');
    $this->db->bind(':puntaje', $puntaje);
    $this->db->bind(':vacante_id', $vacanteId);
    $this->db->bind(':usuario_id', $usuarioId);

    $resultado = $this->db->execute();

    if ($resultado) {
      // Verificar si todos los puntajes han sido asignados para la vacante
      $this->db->query('SELECT COUNT(*) as count FROM inscripciones WHERE vacante_id = :vacante_id AND puntaje IS NULL');
      $this->db->bind(':vacante_id', $vacanteId);
      $this->db->execute();
      $resultado = $this->db->single();

      // Si no hay puntajes pendientes, actualizar el estado de la vacante a 'Evaluada'
      if ($resultado->count == 0) {
          
        $this->db->query('MERGE INTO vacantes_estados AS target
                          USING (VALUES (:vacante_id, :estado_id, GETDATE())) AS source (vacante_id, estado_id, fecha_desde)
                            ON target.vacante_id = source.vacante_id AND target.estado_id = source.estado_id
                          WHEN MATCHED THEN
                            UPDATE SET estado_id = source.estado_id, fecha_desde = source.fecha_desde
                          WHEN NOT MATCHED THEN
                            INSERT (vacante_id, estado_id, fecha_desde)
                            VALUES (source.vacante_id, source.estado_id, source.fecha_desde);');
        $this->db->bind(':vacante_id', $vacanteId);
        $this->db->bind(':estado_id', 1003); // Estado 'Evaluada'
        $this->db->execute();
      }
    }

    return $resultado;
  }
}