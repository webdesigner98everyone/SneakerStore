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
            <?php include 'chat.html'; ?>
        </div>
    </div>


    <!-- Titulo de productos -->
    <main class="contenedor">
        <h1>Nosotros</h1>
        <div class="nosotros">
            <div class="nosotros__contenido">
                <p>En <b>SneakerStore</b>, somos más que una tienda de zapatos deportivos;
                    somos una comunidad apasionada por el estilo y el rendimiento.
                    Nos dedicamos a ofrecer una experiencia de compra excepcional
                    para todos los entusiastas del calzado deportivo, desde los atletas
                    más dedicados hasta los amantes de la moda urbana.</p>

                <p>La calidad es nuestra prioridad. Todos nuestros productos son
                    cuidadosamente seleccionados y probados para garantizar su durabilidad, confort y
                    rendimiento. Nos esforzamos por ofrecer solo productos de la más alta calidad que
                    cumplan con las expectativas de nuestros clientes más exigentes.</p>
            </div>
            <img class="nosotros__imagen" src="../img/Potafolio/nosotros.jpg" alt="imagen nosotros">
        </div>
    </main>
    <!-- Iconos -->
    <section class="contendor comprar">
        <h2 class="comprar__titulo">¿Porque Comprar con nosotros</h2>
        <div class="bloques">
            <div class="bloque">
                <img class="bloque__imagen" src="../img/Iconos/icono_1.png" alt="porque comprar">
                <h3 class="bloque__titulo">El mejor precio</h3>
                <p>Mejor precio garantizado en cada compra. Calidad y ahorro se unen en cada producto. </p>
            </div>
            <div class="bloque">
                <img class="bloque__imagen" src="../img/Iconos/icono_2.png" alt="porque comprar">
                <h3 class="bloque__titulo">Confianza</h3>
                <p>En SneakerStore, nos destacamos por nuestra pasión por la cultura del calzado deportivo </p>
            </div>
            <div class="bloque">
                <img class="bloque__imagen" src="../img/Iconos/icono_3.png" alt="porque comprar">
                <h3 class="bloque__titulo">Envio gratis</h3>
                <p>Disfruta de envío gratis en todos tus pedidos. Sin montos mínimos ni complicaciones.</p>
            </div>
            <div class="bloque">
                <img class="bloque__imagen" src="../img/Iconos/icono_4.png" alt="porque comprar">
                <h3 class="bloque__titulo">La mejor calidad</h3>
                <p>Ofrecemos el mejor precio garantizado en cada compra. Calidad y ahorro</p>
            </div>
        </div>
    </section>
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