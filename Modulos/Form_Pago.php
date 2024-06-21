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

        input, select {
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

        .button-container button, .btn-facturacion {
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

        .button-container button:hover, .btn-facturacion:hover {
            background-color: var(--secundarioOscuro);
        }

        .btn-facturacion {
            display: none;
            margin-top: 20px;
            width: 100%;
            text-align: center;
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
                alert('Pago procesado exitosamente');
                document.getElementById('btn-facturacion').style.display = 'block';
            }, 1000);
        });

        document.getElementById('btn-facturacion').addEventListener('click', function() {
            // Lógica para generar la facturación
            alert('Generando la facturación');
            // Aquí podrías redirigir a una página de facturación o realizar otra acción
        });
    </script>
</body>
</html>
