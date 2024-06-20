let carrito = {};

document.addEventListener('DOMContentLoaded', () => {
    if (sessionStorage.getItem('carrito')) {
        carrito = JSON.parse(sessionStorage.getItem('carrito'));
        actualizarContadorCarrito();
    }
});

// Función para manejar el evento de clic en los botones "Añadir al carrito"
const botonesAgregarCarrito = document.querySelectorAll('.boton-anadir-carrito');
botonesAgregarCarrito.forEach(boton => {
    boton.addEventListener('click', () => {
        if (boton.disabled) return; // Si el botón está deshabilitado, no hacer nada

        const productoId = boton.getAttribute('data-producto-id');
        const cantidad = parseInt(boton.getAttribute('data-cantidad'));

        // Obtener la talla seleccionada por el usuario
        const selectTalla = boton.parentNode.querySelector('#talla');
        const tallaSeleccionada = selectTalla.value;

        // Utilizar expresión regular para extraer el número del texto del precio
        const precioTexto = boton.parentNode.querySelector('.precio').textContent;
        const precioMatch = precioTexto.match(/(\d+(\.\d+)?)/);
        const precioProducto = precioMatch ? parseFloat(precioMatch[0]) : NaN;

        // Verificar si el precio es válido
        if (isNaN(precioProducto)) {
            console.error(`Precio inválido para el producto ID ${productoId}: ${precioTexto}`);
            return; // No agregar al carrito si el precio es inválido
        }

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
                        id: productoId,
                        nombre: boton.parentNode.querySelector('h1').textContent,
                        precio: precioProducto,
                        cantidad: 1,
                        stock: parseInt(nuevoStock), // Asegúrate de convertir el stock a entero
                        talla: tallaSeleccionada  // Agregar la talla seleccionada al objeto del producto

                    };
                }

                console.log('Producto añadido al carrito:', carrito[productoId]); // Depuración

                // Mostrar la alerta
                alert(`Producto añadido al carrito: ${carrito[productoId].nombre}`);
                // Actualizar el contador del carrito, guardar el carrito en la sesión y actualizar la tabla del carrito
                actualizarContadorCarrito();
                sessionStorage.setItem('carrito', JSON.stringify(carrito));

                // Almacenamiento a Tabla Carrito
                const xhrCarrito = new XMLHttpRequest();
                xhrCarrito.open('POST', '../Modulos/info_producto.php', true);
                xhrCarrito.setRequestHeader('Content-Type', 'application/json');
                xhrCarrito.onreadystatechange = function () {
                    if (xhrCarrito.readyState === 4) {
                        if (xhrCarrito.status === 200) {
                            const response = JSON.parse(xhrCarrito.responseText);
                            if (response.status !== 'success') {
                                alert(`Error: ${response.message}`);
                            }
                        } else {
                            console.error('Error en la solicitud AJAX:', xhrCarrito.status);
                        }
                    }
                };

                const data = {
                    id_producto: productoId,
                    cantidad: cantidad,
                    precio: precioProducto,
                    id_usuario: idUsuario, // Aquí se usa idUsuario definido previamente
                    talla: tallaSeleccionada  // También enviar la talla al servidor

                };
                xhrCarrito.send(JSON.stringify(data));
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

