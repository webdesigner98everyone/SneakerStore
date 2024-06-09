document.getElementById('advanced-search-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Evitar que se recargue la página al enviar el formulario

    // Obtener los datos del formulario
    const formData = new FormData(this);

    // Realizar la solicitud AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'Modulos/buscar_avanzado.php?' + new URLSearchParams(formData).toString(), true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Actualizar el contenido de la página con la respuesta
                document.getElementById('productos-grid').innerHTML = xhr.responseText;
            } else {
                // Manejar errores
                console.error('Error en la solicitud AJAX');
            }
        }
    };
    xhr.send();

    return false; // Evitar que se recargue la página
});
