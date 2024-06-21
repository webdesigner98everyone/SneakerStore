document.addEventListener('DOMContentLoaded', () => {
    const carritoLink = document.getElementById('carrito-link');
    const modal = document.getElementById('carrito-modal');
    const botonDatelle = modal.querySelector('#boton-detalle');
    const cerrarModal = document.querySelector('.cerrar');
    const tablaCarrito = document.getElementById('tabla-carrito').getElementsByTagName('tbody')[0];
    const totalPagar = document.getElementById('total-pagar');

    let carrito = JSON.parse(sessionStorage.getItem('carrito')) || {};

    carritoLink.addEventListener('click', (e) => {
        e.preventDefault();
        mostrarCarrito();
        modal.style.display = 'block';
    });

    cerrarModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    botonDatelle.addEventListener('click', () => {
        // Aquí puedes redirigir al usuario a la página de pago
        window.location.href = 'Modulos/detalle_pedido.php'; // Reemplaza con tu URL de pago
    });

    function mostrarCarrito() {
        tablaCarrito.innerHTML = '';
        let total = 0;

        Object.values(carrito).forEach(producto => {
            console.log(producto); // Añade esto para verificar los datos del producto

            const precio = producto.precio !== null && !isNaN(producto.precio) ? parseFloat(producto.precio) : 0;
            const subtotal = producto.precio * producto.cantidad;
            total += subtotal;

            const fila = document.createElement('tr');
            fila.innerHTML = `
                <td>${producto.id}</td> <!-- Agrega un valor por defecto o mensaje -->
                <td>${producto.nombre}</td>
                <td>
                    <button class="btn-cantidad" data-id="${producto.id}" data-operacion="restar">-</button>
                    <span class="cantidad">${producto.cantidad}</span>
                    <button class="btn-cantidad" data-id="${producto.id}" data-operacion="sumar">+</button>
                </td>
                <td>${producto.talla}</td> <!-- Mostrar la talla -->
                <td>$${precio.toFixed(3)}</td>
                <td>$${subtotal.toFixed(3)}</td>
            `;
            tablaCarrito.appendChild(fila);
        });

        totalPagar.textContent = total.toFixed(3);
        agregarEventosModificarCantidad();
    }

    function agregarEventosModificarCantidad() {
        const botonesCantidad = document.querySelectorAll('.btn-cantidad');
        botonesCantidad.forEach(boton => {
            boton.addEventListener('click', () => {
                const idProducto = boton.getAttribute('data-id');
                const operacion = boton.getAttribute('data-operacion');
                modificarCantidad(idProducto, operacion);
            });
        });
    }

    function modificarCantidad(idProducto, operacion) {
        if (carrito.hasOwnProperty(idProducto)) {
            const producto = carrito[idProducto];
            console.log(producto); // Agrega este console.log para depurar

            // Verifica si producto y producto.stock están definidos correctamente
            if (producto && typeof producto.stock !== 'undefined') {
                if (operacion === 'sumar') {
                    // Verificar si hay suficiente stock para agregar más productos
                    if (producto.cantidad < producto.stock) {
                        producto.cantidad++;
                    } else {
                        alert(`No hay suficiente stock disponible para ${producto.nombre}`);
                    }
                } else if (operacion === 'restar') {
                    // Decrementar la cantidad siempre que sea mayor que 1
                    if (producto.cantidad > 1) {
                        producto.cantidad--;
                    } else {
                        delete carrito[idProducto];
                    }
                }

                sessionStorage.setItem('carrito', JSON.stringify(carrito));
                mostrarCarrito();
                actualizarContadorCarrito();
            } else {
                console.error(`No se puede acceder al stock del producto con ID ${idProducto}`);
            }
        } else {
            console.error(`El producto con ID ${idProducto} no está en el carrito.`);
        }
    }



    function actualizarContadorCarrito() {
        const contadorCarrito = document.getElementById('contador-carrito');
        const cantidadProductos = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0);
        contadorCarrito.textContent = cantidadProductos.toString();
    }

    actualizarContadorCarrito();
});
