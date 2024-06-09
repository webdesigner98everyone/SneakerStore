<?php
session_start();
require_once 'In/db_connection.php'; // Asegúrate de que la ruta sea correcta

// Consulta SQL
$sql = "SELECT * FROM productos"; // Reemplaza esto con tu consulta real
$result = $conn->query($sql);

// Verificar si la consulta se ejecutó correctamente
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

// Calcular el total de productos en el carrito
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
$total_productos_carrito = array_reduce($carrito, function ($total, $producto) {
    return $total + $producto['cantidad'];
}, 0);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <title>SneakerStore</title>
</head>

<body>
    <!-- Encabezado -->
    <header class="header">
        <a href="index.html">
            <img class="header__logo" src="../img/Logo/Marca.png" alt="Logotipo">
        </a>
        <!-- Botón hamburguesa -->
        <button class="menu-toggle" aria-label="Toggle Menu" aria-expanded="false">
            <span class="menu-icon"></span>
        </button>
    </header>
    <!-- navegacion -->
    <nav class="navegacion">
        <a class="navegacion__enlace" href="../index.php">Portafolio</a>
        <a class="navegacion__enlace navegacion__enlace--activo" href="nosotros.php">Quiénes Somos</a>
        <a class="navegacion__enlace navegacion__enlace--activo" href="Contactanos.php">Contactanos</a>
        <a class="navegacion__enlace navegacion__enlace--carrito" href="#">
            <img src="../img/Iconos/carrito.png" alt="Carrito de compras">
            <span id="contador-carrito"><?php echo $total_productos_carrito; ?></span>
        </a>
    </nav>

    <!-- Botones flotantes -->
    <div class="botones-flotantes">
        <button class="boton-flotante whatsapp"></button>
        <button class="boton-flotante instagram"></button>
        <button class="boton-flotante facebook"></button>
    </div>

    <!-- Botón flotante chat-->
    <div class="boton-flotantechad" id="boton-chat">
        <img src="../img/Iconos/chat.png" alt="Chat Icon">
    </div>

    <!-- Contenedor para el chat -->
    <div id="chat-container" style="display: none;">
        <div class="modal-content-chad">
            <span class="close-chad" onclick="cerrarChat()">&times;</span>
            <?php include 'Modulos/chat.html'; ?>
        </div>
    </div>

    <div class="contacto-container">
        <div class="contacto-info">
            <h2>Información de Contacto</h2>
            <ul class="contact-info">
                <li>
                    <img src="../img/Iconos/Contacto.png" alt="Ícono de teléfono">
                    <p>+1234567890</p>
                </li>
                <li>
                    <img src="../img/Iconos/Correo.png" alt="Ícono de correo electrónico">
                    <p>info@miempresa.com</p>
                </li>
            </ul>
        </div>
        <div class="contacto-form">
            <form action="#" method="post">
                <div class="form-group">
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre Completo" required>
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Correo Electrónico" required>
                </div>
                <div class="form-group">
                    <textarea id="mensaje" name="mensaje" rows="10" placeholder="Mensaje" required></textarea>
                </div>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>
    <footer class="footer">
        <div class="footer__info">
            <div class="footer__info-item">
                <h3>Contacto</h3>
                <p><strong>Correo:</strong> info@sneakerstore.com</p>
                <p><strong>Teléfono:</strong> +1 (123) 456-7890</p>
                <p><strong>Dirección:</strong> Av. Principal #123, Ciudad, País</p>
            </div>
            <div class="footer__info-item">
                <h3>Métodos de Pago</h3>
                <div class="footer__payment-methods">
                    <img src="../img/MetodosPago/medios_de_pago.png" alt="Métodos de Pago">
                </div>
            </div>
        </div>
        <p class="footer__texto">SneakerStore - Todos los derechos reservados 2024</p>
    </footer>
    <!-- Enlaza tu archivo JavaScript aquí -->
    <script src="../Js/script.js"></script>
    <script src="../Js/chat.js"></script>
    <script src="../Js/add_carrito.js"></script>
</body>

</html>