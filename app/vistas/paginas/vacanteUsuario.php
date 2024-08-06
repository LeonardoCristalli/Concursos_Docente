<?php 
    $titulo = "Vacantes Disponibles";
    require RUTA_APP . '/vistas/inc/header.php'; 
?>

<main class="main-container w-100 m-auto">

    <div class="row">
        <div class="col-md-4">
            <h2>Vacantes Disponibles</h2>
            <?php if (empty($datos['vacantes'])): ?>
                <div class="alert alert-info text-center">
                    No hay vacantes disponibles en este momento. Por favor, vuelva a intentarlo más tarde.
                </div>
            <?php else: ?>
                <ul class="list-group">
                    <?php foreach($datos['vacantes'] as $vacante): ?>
                        <li class="list-group-item">
                            <a href="?vacante_id=<?php echo $vacante->id; ?>">
                                <?php echo $vacante->nombre_catedra; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
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
                    <button type="button" id="btn-inscribirse" class="btn btn-primary btn-sm float-right">Inscribirse</button>
                </div>
            </div>

            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="display: none;">
                    <div class="toast-content">
                        <span class="close-toast">&times;</span>
                        <p id="toast-message"></p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>    
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var detallesVacante = document.getElementById("detalles-vacante");
        var vacanteId = <?php echo isset($_GET['vacante_id']) ? $_GET['vacante_id'] : 'null'; ?>;
        
        if (detallesVacante && !vacanteId) {
            detallesVacante.style.display = "none";
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var btnInscribirse = document.getElementById('btn-inscribirse');

        btnInscribirse.addEventListener('click', function () {
            <?php if (!isset($_SESSION['usuario_id'])): ?>
                window.location.href = '/Concursos_Docente/paginas/login';
            <?php else: ?>
                var vacante_id = <?php echo isset($_GET['vacante_id']) ? $_GET['vacante_id'] : 'null'; ?>;
                window.location.href = '/Concursos_Docente/paginas/inscripcion?vacante_id=' + vacante_id;
            <?php endif; ?>
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toast = document.getElementById('toast');
        var toastMessage = document.getElementById('toast-message');
        var closeToast = document.querySelector('.close-toast');

        // Función para mostrar el toast
        function showToast(message) {
            toastMessage.textContent = message;
            toast.style.display = 'block';
            setTimeout(function () {
                toast.style.display = 'none';
            }, 3000); // El toast se ocultará después de 3 segundos
        }

        // Evento para cerrar el toast
        closeToast.addEventListener('click', function () {
            toast.style.display = 'none';
        });

        <?php if(isset($datos)): ?>
            if(<?php echo json_encode($datos['toast']); ?> === 'error') {
                showToast('¡Error! Necesitas cargar un CV.');
            } else if (<?php echo json_encode($datos['toast']); ?> === 'exito') {
                showToast('¡Inscripción exitosa!');
            } else if (<?php echo json_encode($datos['toast']); ?> === 'yaInscripto') {
                showToast('Ya se encuentra inscripto en esta vacante.');
            }
        <?php endif; ?>

    });

</script>

<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>