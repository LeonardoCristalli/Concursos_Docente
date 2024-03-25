<?php

function redireccionar($pagina) {
  header('Location: ' . RUTA_URL . $pagina);
}
