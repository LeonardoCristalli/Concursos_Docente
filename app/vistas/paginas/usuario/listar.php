<?php 
  $titulo = 'Listar Usuarios';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto"> 

  <div class="row mb-4 g-0">

    <div class="col-md-1">
      <a href="<?php echo RUTA_URL;?>/paginas/adminPanel" class="btn btn-secondary btn-sm">Volver</a>
    </div>
    
    <div class="col-md-11">
      <h2>Usuarios</h2>
      <div class="table-responsive mb-4">
        <table class="table table-striped">
          <thead class="thead-dark">
            <tr>
              <th class="text-center">Nombre</th>
              <th class="text-center">Apellido</th>
              <th class="text-center">Fecha de Nacimiento</th>
              <th class="text-center">Sexo</th>
              <th class="text-center">Dirección</th>
              <th class="text-center">Teléfono</th>
              <th class="text-center">Email</th>
              <th class="text-center">Dni</th>
              <th class="text-center">Cuil</th>
              <th class="text-center">Rol</th>
              <th class="text-center">Legajo</th>
              <th class="text-center">Usuario</th>
              <th class="text-center">Contraseña</th>
              <th class="text-center">CV</th>           
              <th class="text-center sticky-col" colspan="2">Acciones</th>
            </tr>              
          </thead>  
          <tbody>
            <?php foreach($datos['usuarios'] as $usuario) : ?>
            <tr>
              <td class="text-center"><?php echo $usuario->nombre; ?></td>
              <td class="text-center"><?php echo $usuario->apellido; ?></td>
              <td class="text-center"><?php echo $usuario->fecha_nac; ?></td>
              <td class="text-center"><?php echo $usuario->sexo; ?></td>
              <td class="text-center"><?php echo $usuario->direccion; ?></td>
              <td class="text-center"><?php echo $usuario->telefono; ?></td>
              <td class="text-center"><?php echo $usuario->email; ?></td>
              <td class="text-center"><?php echo $usuario->nro_dni; ?></td>
              <td class="text-center"><?php echo $usuario->cuil; ?></td>
              <td class="text-center"><?php echo $usuario->tipo_usu; ?></td>
              <td class="text-center"><?php echo $usuario->nro_legajo; ?></td>
              <td class="text-center"><?php echo $usuario->usuario; ?></td>
              <td class="text-center"><?php echo $usuario->password; ?></td>
              <td class="text-center"><?php echo $usuario->cv; ?></td>
              
              <td class="sticky-col actions-cell">
                <a href="<?php echo RUTA_URL; ?>/usuariocontroller/editarUsuario/<?php echo $usuario->id; ?>" class="btn btn-warning">Editar</a>
                <form action="<?php echo RUTA_URL;?>/usuariocontroller/borrarUsuario/<?php echo $usuario->id; ?>" method="POST">
                  <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                  <input type="submit" class="btn btn-danger" value="Borrar">
                </form>
              </td>          
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-auto">
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <?php if ($datos['totalPaginas'] > 1): ?>
            <?php for($i = 1; $i <= $datos['totalPaginas']; $i++): ?>
              <li class="page-item <?php echo ($i == $datos['paginaActual']) ? 'active' : ''; ?>">
                <a class="page-link" href="<?php echo RUTA_URL; ?>/usuariocontroller/listarUsuarios?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
              </li>
            <?php endfor; ?>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </div>

  <div class="row">
    <div class="col-2 offset-10">
      <div>
        <a href="<?php echo RUTA_URL; ?>/usuariocontroller/agregarUsuario" class="btn btn-primary w-100">Agregar Usuario</a>
      </div>
    </div>
  </div>
  
</main> 

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>
