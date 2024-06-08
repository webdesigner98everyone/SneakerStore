document.addEventListener('DOMContentLoaded', function() {
    const botonCarrito = document.querySelector('.navegacion__enlace--carrito');
    const contadorCarrito = document.createElement('span');
    contadorCarrito.textContent = '0';
    botonCarrito.appendChild(contadorCarrito);

    const carrito = {}; // Objeto para almacenar los productos agregados al carrito

    // Manejar el evento de clic en los botones "Añadir al carrito"
    const botonesAgregarCarrito = document.querySelectorAll('.btn-anadir-carrito');
    botonesAgregarCarrito.forEach(boton => {
        boton.addEventListener('click', () => {
            const productoId = boton.getAttribute('data-producto-id');
            const productoNombre = boton.parentNode.querySelector('.producto__nombre').textContent;
            const productoPrecio = boton.parentNode.querySelector('.producto__precio').textContent;
            
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
            let cantidadProductos = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0);
            contadorCarrito.textContent = cantidadProductos.toString();
        });
    });
});
