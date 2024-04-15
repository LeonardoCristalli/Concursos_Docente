
<?php 
    $titulo = "Vacantes Disponibles";
    require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">
    <div class="row">
        <div class="col-md-4">
            <h2>Vacantes Disponibles</h2>
            <ul class="list-group">
                <?php foreach($datos['vacantes'] as $vacante): ?>
                    <li class="list-group-item">
                        <a href="?vacante_id=<?php echo $vacante->id; ?>">
                            <?php echo $vacante->nombre_catedra; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="col-md-8">

            <?php 

                if (isset($_GET['vacante_id'])) {

                    $vacante_id = $_GET['vacante_id'];
                    
                    $vacanteSeleccionada = null;

                    foreach($datos['vacantes'] as $vacante) {
                        if($vacante->id == $vacante_id) {
                            $vacanteSeleccionada = $vacante;
                            break;
                        }
                    }
                } 
            ?>
            
            <div class="card" id="detalles-vacante">
                <div class="card-body">
                    <h5 class="card-title">Detalles de la Vacante</h5>
                    <p class="card-text">Cátedra: <?php echo isset($vacanteSeleccionada) ? $vacanteSeleccionada->nombre_catedra : 'N/A'; ?></p>
                    <p class="card-text">Descripción: <?php echo isset($vacanteSeleccionada) ? $vacanteSeleccionada->descrip : 'N/A'; ?></p>
                    <p class="card-text">Requerimientos: <?php echo isset($vacanteSeleccionada) ? $vacanteSeleccionada->req : 'N/A'; ?></p>
                    <p class="card-text">Tiempo: <?php echo isset($vacanteSeleccionada) ? $vacanteSeleccionada->tiempo : 'N/A';; ?></p> 
                    <p class="card-text">Experiencia: <?php echo isset($vacanteSeleccionada) ? $vacanteSeleccionada->exp : 'N/A';; ?></p>  
                    <button id="btn-inscribirse" class="btn btn-primary btn-sm float-right">Inscribirse</button>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var detallesVacante = document.getElementById("detalles-vacante");
        var vacanteId = <?php echo isset($_GET['vacante_id']) ? $_GET['vacante_id'] : 'null'; ?>;
        
        if (!vacanteId) {
            detallesVacante.style.display = "none";
        }
    });
</script>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>