<?php 

class Vacante {

  private $db;

  public function __construct() {
    $this->db = new Base;   
  }

  public function obtenerDetalleVacantes () {
    $this->db->query('SELECT v.*, c.nombre AS nombre_catedra, e.descrip AS estado_descrip
                        FROM vacantes v 
                        INNER JOIN catedras c
                          ON v.catedra_id = c.id
                        INNER JOIN vacantes_estados ve 
                          ON v.id = ve.vacante_id
                        INNER JOIN estados e 
                          ON ve.estado_id = e.id
                        INNER JOIN (
                          SELECT vacante_id, MAX(fecha_desde) AS max_fecha_desde
                          FROM vacantes_estados
                          GROUP BY vacante_id
                        ) ve_max
                          ON ve.vacante_id = ve_max.vacante_id 
                          AND ve.fecha_desde = ve_max.max_fecha_desde');

    $resultados = $this->db->registros();
    return $resultados;                                 
  }
  
  public function obtenerVacantes() {
    $this->db->query('SELECT vacantes.*, catedras.nombre AS nombre_catedra 
                      FROM vacantes
                      INNER JOIN catedras ON vacantes.catedra_id = catedras.id');

    $resultados = $this->db->registros();
    return $resultados;
  }

  public function obtenerVacantesAbiertas() {
    $this->db->query('SELECT v.*, c.nombre AS nombre_catedra
                      FROM vacantes v
                      INNER JOIN catedras c 
                        ON v.catedra_id = c.id
                      INNER JOIN vacantes_estados ve
                        ON v.id = ve.vacante_id
                      INNER JOIN (
                        SELECT vacante_id, MAX(fecha_desde) AS max_fecha_desde
                        FROM vacantes_estados
                        GROUP BY vacante_id
                      ) ve_max
                        ON ve.vacante_id = ve_max.vacante_id 
                        AND ve.fecha_desde = ve_max.max_fecha_desde
                      WHERE ve.estado_id = 2');
                      
    return $this->db->registros();
  }

  public function agregarVacante($datos) {
    $this->db->query('INSERT INTO vacantes (descrip, fecha_ini, fecha_fin, req, tiempo, exp, catedra_id) 
                      VALUES (:descrip, :fecha_ini, :fecha_fin, :req, :tiempo, :exp, :catedra_id)');

    $this->db->bind(':descrip', $datos['descrip']);
    $this->db->bind(':fecha_ini', $datos['fecha_ini']);
    $this->db->bind(':fecha_fin', !empty(trim($datos['fecha_fin'])) ? $datos['fecha_fin'] : null);
    $this->db->bind(':req', $datos['req']);
    $this->db->bind(':tiempo', $datos['tiempo']);
    $this->db->bind(':exp', $datos['exp']);
    $this->db->bind(':catedra_id', $datos['catedra_id']); 

    if ($this->db->execute()) {

      $pdo = $this->db->obtenerConexionPDO();
      $vacante_id = $pdo->lastInsertId();

      $this->db->query('INSERT INTO vacantes_estados (vacante_id, estado_id, fecha_desde, observacion) 
                        VALUES (:vacante_id, :estado_id, :fecha_desde, :observacion)');
      
      $this->db->bind(':vacante_id', $vacante_id);
      $this->db->bind(':estado_id', $datos['estado_id']);
      $this->db->bind(':fecha_desde', $datos['fecha_desde']);
      $this->db->bind(':observacion', $datos['observacion']);

      if($this->db->execute()) {
        return true;
      } else {
        return false;
      }  
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

    $this->db->query('UPDATE vacantes SET descrip = :descrip, fecha_ini = :fecha_ini, fecha_fin = :fecha_fin, 
                      req = :req, tiempo = :tiempo, exp = :exp, catedra_id = :catedra_id 
                      WHERE id = :id');

    $this->db->bind(':id', $datos['id']);
    $this->db->bind(':descrip', $datos['descrip']);
    $this->db->bind(':fecha_ini', $datos['fecha_ini']);
    $this->db->bind(':fecha_fin', isset($datos['fecha_fin']) ? $datos['fecha_fin'] : null, PDO::PARAM_NULL);
    $this->db->bind(':req', $datos['req']);
    $this->db->bind(':tiempo', $datos['tiempo']);
    $this->db->bind(':exp', $datos['exp']);
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

  public function contarVacantes() {
    $this->db->query("SELECT COUNT(*) AS total FROM vacantes");
    return $this->db->registro()->total;
  }

  public function obtenerVacantesPaginados($pagina, $registrosPorPagina) {
    $inicio = ($pagina - 1) * $registrosPorPagina;
    $this->db->query("SELECT * FROM vacantes ORDER BY id OFFSET :inicio ROWS FETCH NEXT :registrosPorPagina ROWS ONLY");    
    $this->db->bind(':inicio', $inicio, PDO::PARAM_INT);
    $this->db->bind(':registrosPorPagina', $registrosPorPagina, PDO::PARAM_INT);

    return $this->db->registros();
  }

  public function obtenerVacantesPorUsuarioId($usuarioId) {
    $this->db->query("SELECT v.*, c.nombre AS nombre_catedra, e.descrip AS estado_descrip
                      FROM vacantes v
                      INNER JOIN catedras c 
                        ON v.catedra_id = c.id
                      INNER JOIN jefes_catedras jc 
                        ON c.id = jc.catedra_id
                      INNER JOIN vacantes_estados ve 
                        ON v.id = ve.vacante_id
                      INNER JOIN estados e 
                        ON ve.estado_id = e.id
                      INNER JOIN (
                        SELECT vacante_id, MAX(fecha_desde) AS max_fecha_desde
                        FROM vacantes_estados
                        GROUP BY vacante_id
                      ) ve_max 
                        ON ve.vacante_id = ve_max.vacante_id 
                        AND ve.fecha_desde = ve_max.max_fecha_desde
                      WHERE jc.usuario_id = :usuario_id");

    $this->db->bind(':usuario_id', $usuarioId);
    $resultados = $this->db->registros();
    
    return $resultados;
  }

  public function obtenerVacantesCerradasPorUsuarioId($usuarioId) {
    $this->db->query("SELECT v.*, c.nombre AS nombre_catedra 
                      FROM vacantes v 
                      INNER JOIN catedras c 
                        ON v.catedra_id = c.id
                      INNER JOIN jefes_catedras jc 
                        ON c.id = jc.catedra_id
                      INNER JOIN vacantes_estados ve 
                        ON v.id = ve.vacante_id
                      INNER JOIN (
                        SELECT vacante_id, MAX(fecha_desde) AS max_fecha_desde
                        FROM vacantes_estados
                        GROUP BY vacante_id
                      ) ve_max 
                        ON ve.vacante_id = ve_max.vacante_id AND ve.fecha_desde = ve_max.max_fecha_desde
                      WHERE jc.usuario_id = :usuario_id AND ve.estado_id = 3");
    $this->db->bind(':usuario_id', $usuarioId);
    return $this->db->registros();
  }
}