document.addEventListener('DOMContentLoaded', function () {
  var btnInscribirse = document.getElementById('btn-inscribirse');

  btnInscribirse.addEventListener('click', function () {
    window.location.href = '/Concursos_Docente/paginas/login'; // Redireccionar al usuario al iniciar sesión
  });
});
