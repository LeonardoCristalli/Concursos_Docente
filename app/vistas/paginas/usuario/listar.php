<?php 
  $titulo = 'Listar Usuarios';
  require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto"> 

  <div class="row mb-4">
    <div class="col">
      <a href="<?php echo RUTA_URL;?>/paginas/adminPanel" class="btn btn-secondary btn-sm">Volver</a>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-10">
      <h2>Usuarios</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
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
              <th> </th>
              <th> </th>
            </tr>              
          </thead>  
          <tbody>
            <?php foreach($datos['usuarios'] as $usuario) : ?>
            <tr>
              <td><?php echo $usuario->nombre; ?></td>
              <td><?php echo $usuario->apellido; ?></td>
              <td><?php echo $usuario->fecha_nac; ?></td>
              <td><?php echo $usuario->sexo; ?></td>
              <td><?php echo $usuario->direccion; ?></td>
              <td><?php echo $usuario->telefono; ?></td>
              <td><?php echo $usuario->email; ?></td>
              <td><?php echo $usuario->nro_dni; ?></td>
              <td><?php echo $usuario->cuil; ?></td>
              <td><?php echo $usuario->tipo_usu; ?></td>
              <td><?php echo $usuario->nro_legajo; ?></td>
              <td><?php echo $usuario->usuario; ?></td>
              <td><?php echo $usuario->password; ?></td>
              <td><?php echo $usuario->cv; ?></td>
              
              <td><a href="<?php echo RUTA_URL; ?>/usuariocontroller/editarUsuario/<?php echo $usuario->id; ?>" class="btn btn-warning">Editar</a></td>
              <td>
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
                <a class="page-link" href="?entidad=usuarios&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
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