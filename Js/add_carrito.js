// Objeto para almacenar los productos en el carrito
let carrito = {};

// Cargar el carrito desde la sesión al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    if (sessionStorage.getItem('carrito')) {
        carrito = JSON.parse(sessionStorage.getItem('carrito'));
        actualizarContadorCarrito();
        actualizarTablaCarrito();
    }
});

// Función para manejar el evento de clic en los botones "Añadir al carrito"
const botonesAgregarCarrito = document.querySelectorAll('.boton-anadir-carrito');
botonesAgregarCarrito.forEach(boton => {
    boton.addEventListener('click', () => {
        if (boton.disabled) return; // Si el botón está deshabilitado, no hacer nada

        const productoId = boton.getAttribute('data-producto-id');
        const cantidad = parseInt(boton.getAttribute('data-cantidad'));

        // Realizar la solicitud AJAX para actualizar el stock y el carrito
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'In/actualizar_stock.php', true); // Asegúrate de que la ruta sea correcta
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const nuevoStock = xhr.responseText;
                const stockElemento = boton.parentNode.querySelector('.stock');
                stockElemento.textContent = 'Stock x Pares: ' + nuevoStock + ' Unidades Disponibles';

                if (parseInt(nuevoStock) === 0) {
                    boton.disabled = true;
                    boton.textContent = 'No disponible';
                }

                if (carrito.hasOwnProperty(productoId)) {
                    carrito[productoId].cantidad++;
                } else {
                    carrito[productoId] = {
                        nombre: boton.parentNode.querySelector('h1').textContent,
                        precio: parseFloat(boton.parentNode.querySelector('.precio').textContent.replace('$', '').trim()),
                        cantidad: 1
                    };
                }

                // Actualizar el contador del carrito, guardar el carrito en la sesión y actualizar la tabla del carrito
                actualizarContadorCarrito();
                sessionStorage.setItem('carrito', JSON.stringify(carrito));
                actualizarTablaCarrito();
            }
        };
        xhr.send('producto_id=' + encodeURIComponent(productoId) + '&cantidad=' + encodeURIComponent(cantidad));
    });
});

// Función para actualizar el contador del carrito
function actualizarContadorCarrito() {
    const contadorCarrito = document.getElementById('contador-carrito');
    const cantidadProductos = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0);
    contadorCarrito.textContent = cantidadProductos.toString();
}

// Función para actualizar el contenido de la tabla del carrito
function actualizarTablaCarrito() {
    var totalCarrito = 0;
    const contenidoTabla = document.getElementById('contenido-carrito');

    // Limpiar el contenido actual de la tabla
    contenidoTabla.innerHTML = '';

    // Recorrer el carrito y agregar cada producto a la tabla
    for (const productoId in carrito) {
        if (carrito.hasOwnProperty(productoId)) {
            const producto = carrito[productoId];

            // Crear una nueva fila para el producto
            const fila = document.createElement('tr');

            // Crear las celdas para el producto
            const nombreCelda = document.createElement('td');
            const cantidadCelda = document.createElement('td');
            const precioUnitarioCelda = document.createElement('td');
            const eliminarCelda = document.createElement('td');

            // Agregar contenido a las celdas
            nombreCelda.textContent = producto.nombre;
            cantidadCelda.textContent = producto.cantidad;
            precioUnitarioCelda.textContent = '$' + (producto.precio ? producto.precio.toFixed(2) : '0.00');

            // Crear el botón de eliminar
            const botonEliminar = document.createElement('button');
            botonEliminar.textContent = 'Eliminar';
            botonEliminar.onclick = () => eliminarProducto(productoId);

            // Agregar el botón de eliminar a su celda
            eliminarCelda.appendChild(botonEliminar);

            // Agregar las celdas a la fila
            fila.appendChild(nombreCelda);
            fila.appendChild(cantidadCelda);
            fila.appendChild(precioUnitarioCelda);
            fila.appendChild(eliminarCelda);

            // Agregar la fila a la tabla
            contenidoTabla.appendChild(fila);

            // Calcular el total del carrito
            totalCarrito += producto.cantidad * producto.precio;
        }
    }

    // Actualizar el total del carrito
    const totalCarritoElement = document.getElementById('total-carrito');
    totalCarritoElement.textContent = 'Total: $' + totalCarrito.toFixed(2);
}

// Función para eliminar un producto del carrito
function eliminarProducto(productoId) {
    delete carrito[productoId];
    sessionStorage.setItem('carrito', JSON.stringify(carrito));
    actualizarContadorCarrito();
    actualizarTablaCarrito();
}

// Función para cerrar el pop-up del carrito
function cerrarCarrito() {
    const popup = document.getElementById('carrito-popup');
    popup.style.display = 'none';
}

// Función para avanzar al siguiente paso del proceso de compra
function siguientePaso() {
    // Aquí puedes implementar la lógica para avanzar al siguiente paso
    // Por ahora, simplemente cerraremos el pop-up del carrito
    cerrarCarrito();
}

// Evento de clic para abrir el pop-up del carrito
document.getElementById('carrito-link').addEventListener('click', function(event) {
    event.preventDefault(); // Evitar que el enlace se siga al hacer clic
    mostrarCarrito(); // Llamar a la función mostrarCarrito para abrir el pop-up del carrito
});

// Función para mostrar el pop-up del carrito
function mostrarCarrito() {
    const popup = document.getElementById('carrito-popup');
    popup.style.display = 'block';
}


