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
                          ON ve.estado_id = e.id');

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
                        req = :req, tiempo = :tiempo, exp = :exp, estado_id = :estado_id, catedra_id = :catedra_id 
                        WHERE id = :id');

      $this->db->bind(':id', $datos['id']);
      $this->db->bind(':descrip', $datos['descrip']);
      $this->db->bind(':fecha_ini', $datos['fecha_ini']);
      $this->db->bind(':fecha_fin', isset($datos['fecha_fin']) ? $datos['fecha_fin'] : null, PDO::PARAM_NULL);
      $this->db->bind(':req', $datos['req']);
      $this->db->bind(':tiempo', $datos['tiempo']);
      $this->db->bind(':exp', $datos['exp']);
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