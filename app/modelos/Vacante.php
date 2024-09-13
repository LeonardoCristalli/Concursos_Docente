<?php 

class Vacante {

  private $db;

  public function __construct() {
    $this->db = new Base;   
  }

  public function obtenerDetalleVacantes() {

    $this->db->query("SELECT v.*, c.nombre AS nombre_catedra, e.descrip AS estado_descrip
                      FROM vacantes v
                      INNER JOIN catedras c
                        ON v.catedra_id = c.id
                      INNER JOIN (
                        SELECT ve.vacante_id, MAX(ve.fecha_desde) AS max_fecha_desde
                        FROM vacantes_estados ve
                        GROUP BY ve.vacante_id
                      ) ve_max
                        ON v.id = ve_max.vacante_id
                      INNER JOIN vacantes_estados ve
                        ON ve.vacante_id = ve_max.vacante_id AND ve.fecha_desde = ve_max.max_fecha_desde
                      INNER JOIN estados e
                        ON ve.estado_id = e.id
                      ORDER BY v.id;");

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
                      INNER JOIN (
                        SELECT vacante_id, MAX(fecha_desde) AS fecha_desde
                        FROM vacantes_estados
                        GROUP BY vacante_id
                      ) ve_max
                        ON v.id = ve_max.vacante_id
                      INNER JOIN vacantes_estados ve_actual
                        ON ve_max.vacante_id = ve_actual.vacante_id
                        AND ve_max.fecha_desde = ve_actual.fecha_desde
                      WHERE ve_actual.estado_id = 2
                      ORDER BY v.id DESC');

    return $this->db->registros();
  }

  public function agregarVacante($datos) {
    $hoy = date('Y-m-d H:i:s');

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

      $this->db->query('SELECT COUNT(*) as total FROM vacantes_estados WHERE vacante_id = :vacante_id AND estado_id = :estado_id');
      $this->db->bind(':vacante_id', $vacante_id);
      $this->db->bind(':estado_id', $datos['estado_id']);
      $existeEstado = $this->db->registro()->total;

      if ($existeEstado == 0) {
        $this->db->query('INSERT INTO vacantes_estados (vacante_id, estado_id, fecha_desde, observacion) 
                          VALUES (:vacante_id, :estado_id, GETDATE(), :observacion)');
        $this->db->bind(':vacante_id', $vacante_id);
        $this->db->bind(':estado_id', $datos['estado_id']);
        $this->db->bind(':observacion', $datos['observacion']);

        if ($this->db->execute()) {
          if (!empty($datos['fecha_fin']) && $datos['fecha_fin'] < date('Y-m-d')) {
            $fechaCerrada = date('Y-m-d H:i:s', strtotime('+10 seconds', strtotime($hoy)));
            $this->db->query('SELECT COUNT(*) as total FROM vacantes_estados WHERE vacante_id = :vacante_id AND estado_id = 3');
            $this->db->bind(':vacante_id', $vacante_id);
            $existeEstadoCerrada = $this->db->registro()->total;

            if ($existeEstadoCerrada == 0) {
              $this->db->query('INSERT INTO vacantes_estados (vacante_id, estado_id, fecha_desde) VALUES (:vacante_id, 3, :fecha_cerrada)');
              $this->db->bind(':vacante_id', $vacante_id);
              $this->db->bind(':fecha_cerrada', $fechaCerrada);
              $this->db->execute();
            }
          }
          return true;
        }
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function obtenerVacanteId($id) {
    $this->db->query('SELECT v.*, c.nombre AS nombre_catedra, ve.estado_id
                      FROM vacantes v
                      INNER JOIN catedras c 
                        ON v.catedra_id = c.id
                      LEFT JOIN (
                        SELECT vacante_id, estado_id
                        FROM vacantes_estados
                        WHERE fecha_desde = (
                          SELECT MAX(fecha_desde)
                          FROM vacantes_estados
                          WHERE vacante_id = vacantes_estados.vacante_id
                        )
                      ) ve 
                        ON v.id = ve.vacante_id
                      WHERE v.id = :id');

    $this->db->bind(':id', $id);

    return $this->db->registro();
  }

  public function actualizarVacante($datos) {

    $this->db->query('UPDATE vacantes SET descrip = :descrip, fecha_ini = :fecha_ini, fecha_fin = :fecha_fin, 
                      req = :req, tiempo = :tiempo, exp = :exp, catedra_id = :catedra_id 
                      WHERE id = :id');

    $this->db->bind(':id', $datos['id']);
    $this->db->bind(':descrip', $datos['descrip']);
    $this->db->bind(':fecha_ini', $datos['fecha_ini']);
    $this->db->bind(':fecha_fin', $datos['fecha_fin']);
    $this->db->bind(':req', $datos['req']);
    $this->db->bind(':tiempo', $datos['tiempo']);
    $this->db->bind(':exp', $datos['exp']);
    $this->db->bind(':catedra_id', $datos['catedra_id']);

    if ($this->db->execute()) {
      $hoy = date('Y-m-d');
      $fecha_ini = $datos['fecha_ini'];
      $fecha_fin = $datos['fecha_fin'];

      if ($fecha_ini <= $hoy && $fecha_fin >= $hoy) {
        $this->actualizarEstadoVacante($datos['id'], 2); 
      } else if ($fecha_fin < $hoy) {
        $this->actualizarEstadoVacante($datos['id'], 3);
      }
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
    $sql = "SELECT v.id, v.descrip, v.fecha_ini, v.fecha_fin, v.req, v.tiempo, v.exp, c.nombre as catedra_nombre
            FROM vacantes v
            INNER JOIN catedras c 
              ON v.catedra_id = c.id
            ORDER BY v.id
            OFFSET :inicio ROWS FETCH NEXT :registrosPorPagina ROWS ONLY";

    $this->db->query($sql);
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

    return $this->db->registros();
  }

  public function obtenerVacantesCerradasEvaluadasPublicadasPorJefeCatedraId($usuarioId) {
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
                      WHERE jc.usuario_id = :usuario_id AND (ve.estado_id = 3 OR ve.estado_id = 1003 OR ve.estado_id = 1004)");

    $this->db->bind(':usuario_id', $usuarioId);
    return $this->db->registros();
  }

  public function actualizarVacantesAbiertas() {

    $hoy = date('Y-m-d H:i:s');

    $this->db->query('SELECT v.id 
                      FROM vacantes v
                      INNER JOIN vacantes_estados ve 
                        ON v.id = ve.vacante_id
                      INNER JOIN (
                        SELECT vacante_id, MAX(fecha_desde) AS max_fecha_desde
                        FROM vacantes_estados
                        GROUP BY vacante_id
                      ) ve_max 
                        ON ve.vacante_id = ve_max.vacante_id 
                        AND ve.fecha_desde = ve_max.max_fecha_desde
                      WHERE v.fecha_ini <= :hoy AND ve.estado_id = 1002');

    $this->db->bind(':hoy', $hoy);
    $vacantesNuevas = $this->db->registros();

    foreach ($vacantesNuevas as $vacante) {

      $this->db->query('INSERT INTO vacantes_estados (vacante_id, estado_id, fecha_desde) VALUES (:vacante_id, 2, :hoy)');

      $this->db->bind(':vacante_id', $vacante->id);
      $this->db->bind(':hoy', $hoy);

      $this->db->execute();
    }

    return true;
  }

  public function actualizarVacantesCerradas() {
    $hoy = date('Y-m-d H:i:s');

    $this->db->query('SELECT v.id, v.catedra_id, v.descrip
                      FROM vacantes v
                      INNER JOIN vacantes_estados ve 
                        ON v.id = ve.vacante_id
                      INNER JOIN (
                        SELECT vacante_id, MAX(fecha_desde) AS max_fecha_desde
                        FROM vacantes_estados
                        GROUP BY vacante_id
                      ) ve_max 
                        ON ve.vacante_id = ve_max.vacante_id 
                        AND ve.fecha_desde = ve_max.max_fecha_desde
                      WHERE v.fecha_fin < :hoy AND ve.estado_id = 2');

    $this->db->bind(':hoy', $hoy);
    $vacantesAbiertas = $this->db->registros();

    foreach ($vacantesAbiertas as $vacante) {
        
      $this->db->query('SELECT COUNT(*) as total FROM vacantes_estados WHERE vacante_id = :vacante_id AND estado_id = 3');
      $this->db->bind(':vacante_id', $vacante->id);
      $existeEstadoCerrada = $this->db->registro()->total;

      if ($existeEstadoCerrada == 0) {
        $this->db->query('INSERT INTO vacantes_estados (vacante_id, estado_id, fecha_desde) VALUES (:vacante_id, 3, :hoy)');
        $this->db->bind(':vacante_id', $vacante->id);
        $this->db->bind(':hoy', $hoy);
        $this->db->execute();
      }
    }

    return $vacantesAbiertas;
  }
  
  public function obtenerEmailJefeCatedra($catedraId) {
    $this->db->query('SELECT u.email 
                      FROM jefes_catedras jc
                      INNER JOIN usuarios u 
                        ON jc.usuario_id = u.id 
                      WHERE jc.catedra_id = :catedra_id');
    $this->db->bind(':catedra_id', $catedraId);
    $result = $this->db->registro();
    return $result ? $result->email : null;
  }

  public function obtenerVacantesCerradasPorCatedraId($catedraId) {
    $this->db->query("SELECT v.*, c.nombre AS nombre_catedra 
                      FROM vacantes v 
                      INNER JOIN catedras c ON v.catedra_id = c.id
                      INNER JOIN vacantes_estados ve ON v.id = ve.vacante_id
                      INNER JOIN (
                        SELECT vacante_id, MAX(fecha_desde) AS max_fecha_desde
                        FROM vacantes_estados
                        GROUP BY vacante_id
                      ) ve_max 
                        ON ve.vacante_id = ve_max.vacante_id 
                        AND ve.fecha_desde = ve_max.max_fecha_desde
                      WHERE ve.estado_id = 3 AND v.catedra_id = :catedra_id");
    $this->db->bind(':catedra_id', $catedraId);
    return $this->db->registros();
  }

  public function esVacanteCerrada($vacante_id) {
    $this->db->query("SELECT COUNT(*) as total FROM vacantes_estados 
                      WHERE vacante_id = :vacante_id AND estado_id = 3");
    $this->db->bind(':vacante_id', $vacante_id);
    return $this->db->registro()->total > 0;
  }

  public function actualizarEstadoVacante($vacante_id, $nuevo_estado_id) {
    
    $this->db->query('INSERT INTO vacantes_estados (vacante_id, estado_id, fecha_desde) 
                      VALUES (:vacante_id, :estado_id, GETDATE())');
    $this->db->bind(':vacante_id', $vacante_id);
    $this->db->bind(':estado_id', $nuevo_estado_id);

    return $this->db->execute();
  }

  public function obtenerVacantesEvaluadasPorUsuarioId($usuarioId) {
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
                      WHERE jc.usuario_id = :usuario_id AND ve.estado_id = 1003");

    $this->db->bind(':usuario_id', $usuarioId);
    return $this->db->registros();
  }

  public function cambiarEstadoPublicado($vacanteId) {
    $this->db->query("INSERT INTO vacantes_estados (vacante_id, estado_id, fecha_desde) VALUES (:vacante_id, 1004, GETDATE())");
    $this->db->bind(':vacante_id', $vacanteId);
    return $this->db->execute();
  }

  public function obtenerVacantesPublicadas() {

    $sql = "SELECT v.*, c.nombre AS nombre_catedra, ve.estado_id, ve.fecha_desde
            FROM vacantes v
            INNER JOIN catedras c 
              ON v.catedra_id = c.id
            INNER JOIN vacantes_estados ve ON v.id = ve.vacante_id
            INNER JOIN (
              SELECT vacante_id, MAX(fecha_desde) AS max_fecha_desde
              FROM vacantes_estados
              GROUP BY vacante_id
            ) ve_max 
              ON ve.vacante_id = ve_max.vacante_id 
              AND ve.fecha_desde = ve_max.max_fecha_desde
            WHERE ve.estado_id = 1004
            ORDER BY ve.fecha_desde DESC";
    $this->db->query($sql);

    return $this->db->registros();
  }

  public function cambiarEstadoVacante($vacanteId, $nuevoEstadoId) {
  
    $this->db->query("INSERT INTO vacantes_estados (vacante_id, estado_id, fecha_desde) 
                      VALUES (:vacante_id, :estado_id, GETDATE())");
    
    $this->db->bind(':vacante_id', $vacanteId);
    $this->db->bind(':estado_id', $nuevoEstadoId);

    return $this->db->execute();
  }

}