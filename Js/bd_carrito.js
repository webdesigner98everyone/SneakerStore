document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.boton-anadir-carrito');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const idProducto = this.getAttribute('data-producto-id');
            const cantidad = this.getAttribute('data-cantidad');
            
            fetch('../Modulos/info_producto.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id_producto: idProducto,
                    cantidad: cantidad,
                    precio: precioProducto
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    // Aquí puedes actualizar el contador del carrito si es necesario
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
