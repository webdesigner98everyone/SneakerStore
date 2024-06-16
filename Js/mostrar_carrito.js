document.addEventListener('DOMContentLoaded', () => {
    const carritoLink = document.getElementById('carrito-link');
    const modal = document.getElementById('carrito-modal');
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
                <td>${producto.cantidad}</td>
                <td>$${precio.toFixed(3)}</td>
                <td>$${subtotal.toFixed(3)}</td>
                <td><button class="btn-eliminar" data-id="${producto.id}">Eliminar</button></td>
            `;
            tablaCarrito.appendChild(fila);
        });

        totalPagar.textContent = total.toFixed(3);
        agregarEventosEliminar();
    }

    function agregarEventosEliminar() {
        const botonesEliminar = document.querySelectorAll('.btn-eliminar');
        botonesEliminar.forEach(boton => {
            boton.addEventListener('click', () => {
                const idProducto = boton.getAttribute('data-id');
                eliminarProducto(idProducto);
            });
        });
    }

    function eliminarProducto(idProducto) {
        if (carrito.hasOwnProperty(idProducto)) {
            delete carrito[idProducto];
            sessionStorage.setItem('carrito', JSON.stringify(carrito));
            actualizarContadorCarrito();
            mostrarCarrito();
        }
    }

    function actualizarContadorCarrito() {
        const contadorCarrito = document.getElementById('contador-carrito');
        const cantidadProductos = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0);
        contadorCarrito.textContent = cantidadProductos.toString();
    }

    actualizarContadorCarrito();
});
