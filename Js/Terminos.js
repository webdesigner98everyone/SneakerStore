function aceptarTerminos() {
    // Ocultar completamente el modal de términos y condiciones
    var modal = document.getElementById('modal-terminos');
    modal.style.display = 'none';
    modal.classList.remove('show'); // Eliminar la clase 'show' del modal
    modal.style.height = 'auto'; // Restablecer la altura a auto
}

function rechazarTerminos() {
    // Cerrar el modal de términos y condiciones
    // document.getElementById("modal-terminos").style.display = "none";
    alert("Debe aceptar los términos y condiciones para continuar utilizando el sitio.");
}

window.onload = function() {
    document.getElementById('modal-terminos').style.display = 'block'; // Mostrar el modal de términos
};
