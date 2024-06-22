<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pago</title>
    <style>
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

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 200px;
            height: auto;
        }

        h1 {
            font-size: 2.5rem;
            color: var(--primario);
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            font-weight: bold;
        }

        input,
        select {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid var(--gris);
            border-radius: 4px;
            font-size: 1rem;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button-container button,
        .btn-facturacion {
            background-color: var(--secundario);
            color: var(--negro);
            border: none;
            padding: 12px 24px;
            text-align: center;
            text-decoration: none;
            font-size: 1.2rem;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .button-container button:hover,
        .btn-facturacion:hover {
            background-color: var(--secundarioOscuro);
        }

        .btn-facturacion {
            display: none;
            margin-top: 20px;
            width: 100%;
            text-align: center;
        }

        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: var(--blanco);
            margin: 15% auto;
            padding: 20px;
            border: 1px solid var(--gris);
            width: 80%;
            max-width: 500px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .close {
            color: var(--negro);
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: var(--primario);
            text-decoration: none;
            cursor: pointer;
        }

        .modal h2 {
            margin: 0;
            color: var(--primarioOscuro);
        }

        .modal p {
            margin: 10px 0;
        }

        .modal button {
            background-color: var(--primarioOscuro);
            color: var(--blanco);
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .modal button:hover {
            background-color: var(--primario);
        }

        .factura-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .modal-button {
            background-color: #9C27B0;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .modal-button:hover {
            background-color: #89119D;
        }

        .modal-content-fac {
            background-color: rgba(255, 255, 255, 0.9);
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
        }

        .modal-content-fac .close {
            color: #333;
            position: absolute;
            right: 10px;
            top: 10px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s;
        }

        .modal-content-fac .close:hover,
        .modal-content-fac .close:focus {
            color: #9C27B0;
            text-decoration: none;
        }

        .btn-volver {
            display: none;
            margin-top: 20px;
            background-color: var(--secundario);
            color: var(--negro);
            border: none;
            padding: 12px 24px;
            text-align: center;
            text-decoration: none;
            font-size: 1.2rem;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .btn-volver:hover {
            background-color: var(--secundarioOscuro);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="../img/Logo/Marca.png" alt="Logo de la Tienda">
        </div>
        <h1>Formulario de Pago</h1>
        <form id="form-pago">
            <h2>Información de Entrega</h2>
            <label for="nombre">Nombre Completo</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="contacto">Contacto</label>
            <input type="text" id="contacto" name="contacto" required>

            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion" required>

            <label for="ciudad">Ciudad</label>
            <input type="text" id="ciudad" name="ciudad" required>

            <label for="codigo-postal">Código Postal</label>
            <input type="text" id="codigo-postal" name="codigo-postal" required>

            <label for="tipo-identificacion">Tipo de Identificación</label>
            <select id="tipo-identificacion" name="tipo-identificacion" required>
                <option value="cedula">Cédula</option>
                <option value="tarjeta_identidad">Tarjeta de Identidad</option>
                <option value="pasaporte">Pasaporte</option>
                <option value="otro">Otro</option>
            </select>

            <label for="numero-identificacion">Número de Identificación</label>
            <input type="text" id="numero-identificacion" name="numero-identificacion" required>

            <h2>Información de Pago</h2>
            <label for="metodo-pago">Método de Pago</label>
            <select id="metodo-pago" name="metodo-pago" required>
                <option value="contado">Contado</option>
                <option value="credito">Crédito</option>
            </select>

            <div class="button-container">
                <button type="submit">Pagar</button>
            </div>
        </form>
        <button id="btn-facturacion" class="btn-facturacion">Generar Facturación</button>
        <button id="btn-volver" class="btn-volver">Volver</button>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Pago Procesado</h2>
            <p>El pago se ha procesado exitosamente.</p>
            <p>Su pedido está en despacho. En breve lo recibirá.</p>
            <button id="close-modal">Aceptar</button>
        </div>
    </div>

    <!-- Modal factura-->
    <div id="myModal-fac" class="modal">
        <div class="modal-content-fac">
            <span class="close">&times;</span>
            <div id="factura-electronica">
                <!-- Aquí se mostrará la factura electrónica -->
            </div>
            <button id="close-modal-fact">Aceptar</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Realizar una solicitud AJAX para obtener los datos del perfil del usuario
            fetch('In/get_user_profile.php')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const userData = data.data;
                        document.getElementById('nombre').value = userData.nombre;
                        document.getElementById('contacto').value = userData.contacto;
                        document.getElementById('direccion').value = userData.direccion;
                        document.getElementById('ciudad').value = userData.ciudad;
                        document.getElementById('codigo-postal').value = userData.codigo_postal;
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        document.getElementById('form-pago').addEventListener('submit', function(event) {
            event.preventDefault();

            // Obtener los datos del formulario
            const formData = new FormData(event.target);
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            // Aquí puedes realizar la lógica de pago
            console.log('Procesando el pago con los siguientes datos:', data);

            // Simular un procesamiento de pago y mostrar el botón de generar facturación
            setTimeout(() => {
                showModal();
                document.getElementById('btn-facturacion').style.display = 'block';
            }, 1000);
        });

        document.getElementById('btn-facturacion').addEventListener('click', function() {
            // Obtener los datos necesarios para la factura
            const formData = new FormData(document.getElementById('form-pago'));
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            // Obtener la fecha actual y formatearla
            const fecha = new Date().toLocaleDateString('es-ES');

            // Generar un número de factura al azar
            const numeroFactura = generarNumeroFactura();

            // Aquí puedes calcular el total del pedido si es necesario
            const total = calcularTotalPedido(); // Implementa tu lógica para calcular el total

            // Guardar la factura en la base de datos usando una solicitud fetch
            const facturaData = {
                cliente_nombre: data.nombre,
                cliente_contacto: data.contacto,
                total: total,
                estado: 'En despacho', // Estado por defecto al generar la factura
                fecha_generacion: fecha, // Asignar la fecha de generación
                numero_factura: numeroFactura // Asignar el número de factura generado
            };

            fetch('In/guardar_factura.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(facturaData),
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        // Mostrar la factura electrónica
                        fetch('In/info_facturta.php')
                            .then(response => response.text())
                            .then(facturaHTML => {
                                // Mostrar la factura en un modal o en una sección específica
                                mostrarFacturaElectronica(facturaHTML);
                            })
                            .catch(error => {
                                console.error('Error al generar la factura electrónica:', error);
                                alert('Error al generar la factura electrónica');
                            });
                    } else {
                        alert('Error al generar la factura');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al conectar con el servidor');
                });
        });

        // Función para generar un número de factura al azar
        function generarNumeroFactura() {
            const caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let numeroFactura = '';

            for (let i = 0; i < 8; i++) { // Genera un número de 8 caracteres de longitud
                numeroFactura += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
            }

            return numeroFactura;
        }

        function mostrarFacturaElectronica(facturaHTML, numeroFactura) {
            const modal = document.getElementById('myModal-fac');
            const modalContent = modal.getElementsByClassName('modal-content-fac')[0];
            const facturaContainer = modalContent.querySelector('#factura-electronica');

            facturaContainer.innerHTML = facturaHTML;
            modal.style.display = 'block';

            const span = modalContent.getElementsByClassName('close')[0];
            span.onclick = function() {
                modal.style.display = 'none';
                document.getElementById('btn-volver').style.display = 'block'; // Mostrar botón "Volver" al cerrar el modal
            };

            const closeModalButton = document.getElementById('close-modal-fact');
            closeModalButton.onclick = function() {
                modal.style.display = 'none';
                document.getElementById('btn-volver').style.display = 'block'; // Mostrar botón "Volver" al cerrar el modal
            };

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                    document.getElementById('btn-volver').style.display = 'block'; // Mostrar botón "Volver" al cerrar el modal
                }

            };
        }
        // Asignar evento al botón "Volver"
        document.getElementById('btn-volver').addEventListener('click', function() {
            window.location.href = '../index.php'; // Redirigir a la página de inicio
        });

        function showModal() {
            const modal = document.getElementById('myModal');
            modal.style.display = 'block';

            const span = document.getElementsByClassName('close')[0];
            span.onclick = function() {
                modal.style.display = 'none';
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }
        }

        // Función para calcular el total del pedido (puedes adaptarla según tu lógica de precios)
        function calcularTotalPedido() {
            // Implementa la lógica para calcular el total según los productos seleccionados, etc.
            return 100; // Ejemplo de retorno de un total fijo
        }

        function showModal() {
            const modal = document.getElementById('myModal');
            const span = document.getElementsByClassName('close')[0];
            const closeModalButton = document.getElementById('close-modal');

            modal.style.display = 'block';

            span.onclick = function() {
                modal.style.display = 'none';
            }

            closeModalButton.onclick = function() {
                modal.style.display = 'none';
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }
        }
    </script>
</body>

</html>