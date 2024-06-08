// Objeto para almacenar los productos en el carrito
let carrito = {};

// Función para manejar el evento de clic en los botones "Añadir al carrito"
const botonesAgregarCarrito = document.querySelectorAll('.boton-anadir-carrito');
botonesAgregarCarrito.forEach(boton => {
    boton.addEventListener('click', () => {
        if (boton.disabled) return; // Si el botón está deshabilitado, no hacer nada
        
        const productoId = boton.getAttribute('data-producto-id');
        const productoNombre = boton.parentNode.querySelector('.contenido h2').textContent;
        const productoPrecio = boton.parentNode.querySelector('.contenido .precio').textContent;

        // Si el producto ya está en el carrito, incrementar la cantidad, de lo contrario, agregarlo al carrito
        if (carrito.hasOwnProperty(productoId)) {
            carrito[productoId].cantidad++;
        } else {
            carrito[productoId] = {
                nombre: productoNombre,
                precio: productoPrecio,
                cantidad: 1
            };
        }

        // Actualizar el contador del carrito
        actualizarContadorCarrito();

        const cantidad = boton.getAttribute('data-cantidad');

        // Realizar la solicitud AJAX para actualizar el stock
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'In/actualizar_stock.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Actualizar el stock mostrado en la página
                const nuevoStock = xhr.responseText;
                const stockElemento = boton.parentNode.querySelector('.stock');
                stockElemento.textContent = 'Stock x Pares: ' + nuevoStock + ' Unidades Disponibles';

                // Si el nuevo stock es 0, deshabilitar el botón
                if (parseInt(nuevoStock) === 0) {
                    boton.disabled = true;
                    boton.textContent = 'No disponible';
                }
            }
        };
        xhr.send('producto_id=' + encodeURIComponent(productoId) + '&cantidad=' + encodeURIComponent(cantidad));
        
    });
});

// Función para actualizar el contador del carrito
function actualizarContadorCarrito() {
    let contadorCarrito = document.getElementById('contador-carrito');
    let cantidadProductos = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0);
    contadorCarrito.textContent = cantidadProductos.toString();
}
