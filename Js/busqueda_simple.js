function buscarProductos(event) {
    event.preventDefault(); // Evita que el formulario se envíe de forma tradicional
    const query = document.getElementById('search-query').value;
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'Modulos/buscar.php?query=' + query, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('productos-grid').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
    return false;
}