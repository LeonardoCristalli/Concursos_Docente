<?php 
class Base {
  private $host = DB_HOST;
  private $usuario = DB_USUARIO;
  private $password = DB_PASSWORD;
  private $nombre_base = DB_NOMBRE; 

  private $dbh;
  private $stmt;
  private $error;

  public function __construct() {
    $dsn = 'sqlsrv:Server=' .$this->host. ';Database=' .$this->nombre_base;

    try {
      $this->dbh = new PDO($dsn, $this->usuario,  $this->password);
    } catch (PDOException $e) {  
      $this->error = $e->getMessage();
      echo 'Error al conectar con la base de datos: ' . $e->getMessage();
      var_dump($e->getMessage());
    }
  }

  public function query($sql) {
    $this->stmt = $this->dbh->prepare($sql);
  }

  public function bind($parametro, $valor, $tipo = null) {
    if (is_null($tipo)) {
      switch (true) {
        case is_int($valor):
          $tipo = PDO::PARAM_INT;
        break;
        case is_bool($valor):
          $tipo = PDO::PARAM_BOOL;
        break;
        case is_null($valor):
          $tipo = PDO::PARAM_NULL;
        break;
        default: 
          $tipo = PDO::PARAM_STR;
        break;
      }
    }
    $this->stmt->bindValue($parametro, $valor, $tipo);  
  }

  public function execute() {
    try {
      return $this->stmt->execute();
    }
    
    catch (PDOException $e) {
      echo "Error PDO: " . $e->getMessage();
      throw $e;
      }
  }
  
  public function registros() {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function registro() {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
  }

  public function rowCount() {
    return $this->stmt->rowCount();
  }

  public function obtenerConexionPDO() {
      return $this->dbh;
  }

  public function single() {
      $this->execute();
      return $this->stmt->fetch(PDO::FETCH_OBJ); 
  }

}