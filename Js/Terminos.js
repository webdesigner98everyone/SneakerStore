window.onload = function() {
    var modal = document.getElementById('modal-terminos');
    var aceptoTerminos = localStorage.getItem('aceptoTerminos');

    // Verificar si el usuario ya aceptó los términos previamente
    if (!aceptoTerminos) {
        modal.style.display = 'block'; // Mostrar el modal de términos
    }

    // Función para aceptar los términos
    function aceptarTerminos() {
        modal.style.display = 'none'; // Ocultar el modal de términos
        localStorage.setItem('aceptoTerminos', true); // Almacenar en el almacenamiento local que el usuario aceptó los términos
    }

    // Función para rechazar los términos
    function rechazarTerminos() {
        alert("Debe aceptar los términos y condiciones para continuar utilizando el sitio.");
    }

    // Asignar las funciones a los botones de aceptar y rechazar
    document.getElementById('btn-aceptar-terminos').addEventListener('click', aceptarTerminos);
    document.getElementById('btn-rechazar-terminos').addEventListener('click', rechazarTerminos);
};
