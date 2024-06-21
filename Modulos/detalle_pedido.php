<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Pedido</title>
    <style>
        /* Estilos personalizados */
        :root {
            --primario: #9C27B0;
            --primarioOscuro: #89119D;
            --gris: #808080;
            --secundario: #FFCE00;
            --secundarioOscuro: rgb(233, 187, 2);
            --blanco: #FFF;
            --negro: #000;
            --fuente: 'Staatliches', cursive;
        }

        body {
            font-family: var(--fuente);
            line-height: 1.6;
            background-color: var(--primario);
            color: var(--negro);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid var(--gris);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: var(--blanco);
        }

        h1 {
            font-size: 2.5rem;
            color: var(--primario);
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--gris);
        }

        th {
            background-color: var(--primarioOscuro);
            color: var(--blanco);
        }

        td {
            vertical-align: middle;
        }

        .total {
            margin-top: 20px;
            text-align: right;
            font-size: 1.2rem;
        }

        .boton-pagar {
            background-color: var(--secundario);
            color: var(--negro);
            border: none;
            padding: 12px 24px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 1.2rem;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .boton-pagar:hover {
            background-color: var(--secundarioOscuro);
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 200px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="../img/Logo/Marca.png" alt="Logo de la Tienda">
        </div>
        <h1>Detalle del Pedido</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Talla</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody id="tabla-detalle-pedido">
                <!-- Los productos del carrito se agregarán aquí dinámicamente -->
            </tbody>
        </table>
        <div class="total">
            <strong>Total a pagar: $<span id="total-pagar"></span></strong>
        </div>
        <button class="boton-pagar" id="btn-pagar">Continuar al Pago</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const carrito = JSON.parse(sessionStorage.getItem('carrito')) || {};
            const tablaDetalle = document.getElementById('tabla-detalle-pedido');
            const totalPagar = document.getElementById('total-pagar');

            let total = 0;

            Object.values(carrito).forEach(producto => {
                const precioUnitario = parseFloat(producto.precio);
                const subtotal = precioUnitario * producto.cantidad;
                total += subtotal;

                const fila = document.createElement('tr');
                fila.innerHTML = `
                    <td>${producto.id}</td>
                    <td>${producto.nombre}</td>
                    <td>${producto.cantidad}</td>
                    <td>${producto.talla}</td>
                    <td>$${precioUnitario.toFixed(3)}</td>
                    <td>$${subtotal.toFixed(3)}</td>
                `;
                tablaDetalle.appendChild(fila);
            });

            totalPagar.textContent = total.toFixed(3);

            const btnPagar = document.getElementById('btn-pagar');
            btnPagar.addEventListener('click', () => {
                const data = {
                    carrito: carrito,
                    total: total.toFixed(3)
                };

                fetch('In/guardar_detalle_pedido.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.status === 'success') {
                            alert('Pedido guardado correctamente');
                            // Redirigir a la página de pago si es necesario
                            window.location.href = 'Form_Pago.php';
                        } else {
                            alert('Error al guardar el pedido: ' + result.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al procesar la solicitud.');
                    });
            });
        });
    </script>
</body>

</html>