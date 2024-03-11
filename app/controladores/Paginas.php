<?php

  class Paginas extends Controlador {

    public function __construct() {            
      $this->usuarioModelo = $this->modelo('Usuario');
      $this->dptoModelo = $this->modelo('Dpto');
      $this->areaModelo = $this->modelo('Area');
    } 

    public function index() {
      $this->vista('paginas/inicio');
    } 

    public function irAlCRUD() {
      if(isset($_GET['entidad'])) {
        $entidad = $_GET['entidad'];
        switch($entidad) {

          case 'usuarios':
            $usuarios = $this->usuarioModelo->obtenerUsuarios();
            $datos = [
              'usuarios' => $usuarios
            ];

            $this->vista('paginas/usuario/listar', $datos);
          break;

          case 'dptos':
            $dptos = $this->dptoModelo->obtenerDptos();
            $datos = [
              'dptos' => $dptos
            ];

            $this->vista('paginas/dpto/listar', $datos);
          break;

          case 'areas':
            $areas = $this->areaModelo->obtenerAreas();
            $datos = [
              'areas' => $areas
            ];

            $this->vista('paginas/area/listar', $datos);
          break;

          default:
            redireccionar('/paginas');
          break;
        }
      } else {
        redireccionar('/paginas');
      }
    }    
    
  }

?>