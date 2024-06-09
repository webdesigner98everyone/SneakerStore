<?php
session_start();
require_once 'Modulos/In/db_connection.php'; // Asegúrate de que la ruta sea correcta

// Verificar si la sesión está iniciada
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $usuario = $_SESSION['usuario'];
    $nombre_usuario = '<a class="navegacion__enlace navegacion__enlace--activo" href="#">' . $usuario . '</a>'; // Nombre de usuario con los mismos estilos que las otras opciones del menú
    $cerrar_sesion = '<a class="navegacion__enlace" href="Modulos/In/logout.php">Cerrar Sesión</a>'; // Enlace para cerrar sesión
} else {
    $nombre_usuario = '<a class="navegacion__enlace navegacion__enlace--activo" href="#" onclick="abrirLogin()">Iniciar Sesión</a>'; // Enlace para iniciar sesión
    $cerrar_sesion = ''; // No mostrar enlace para cerrar sesión si no hay sesión iniciada
}

// Consulta SQL
$sql = "SELECT * FROM productos"; // Reemplaza esto con tu consulta real
$result = $conn->query($sql);

// Verificar si la consulta se ejecutó correctamente
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <title>SneakerStore</title>
</head>
<body>
    <!-- Encabezado -->
    <header class="header">
        <a href="index.html">
            <img class="header__logo" src="img/Logo/Marca.png" alt="Logotipo">
        </a>
    <!-- Botón hamburguesa -->
        <button class="menu-toggle" aria-label="Toggle Menu" aria-expanded="false">
            <span class="menu-icon"></span>
        </button>
    </header>
    
    <!-- navegacion -->
    <nav class="navegacion">
        <a class="navegacion__enlace" href="index.php">Portafolio</a>
            <a class="navegacion__enlace navegacion__enlace--activo" href="Modulos/nosotros.php">Quiénes Somos</a>
            <a class="navegacion__enlace navegacion__enlace--activo" href="Modulos/Contactanos.php">Contactanos</a>
            <a class="navegacion__nombre-usuario"><?php echo $nombre_usuario; ?></a>
            <?php echo $cerrar_sesion; ?>
            <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { ?>
                <a class="navegacion__enlace" href="Modulos/perfil.php">Mi Perfil</a>
            <?php } ?>
            <a class="navegacion__enlace navegacion__enlace--carrito" href="#">
                <img src="img/Iconos/carrito.png" alt="Carrito de compras">
            </a>
    </nav>

     <!-- Formulario de Login -->
     <div class="login-container" id="login-container">
        <div class="modal-content">
            <span class="close-login" onclick="cerrarLogin()">&times;</span>
            <?php include 'Modulos/Sesion.php'; ?>
        </div>
    </div>

    <!-- Formulario de Registro -->
    <div class="login-container" id="registro-container">
        <div class="modal-content">
            <span class="close-login" onclick="cerrarRegistro()">&times;</span>
            <?php include 'Modulos/Registrarme.php'; ?>
        </div>
    </div>

    <!-- Formulario de Recuperación de Contraseña -->
    <div class="login-container" id="olvide-container">
        <div class="modal-content">
            <span class="close-login" onclick="cerrarOlvide()">&times;</span>
            <?php include 'Modulos/Reset_Contrasena.html'; ?>
        </div>
    </div>
    
    <!-- Botones flotantes -->
    <div class="botones-flotantes">
        <button class="boton-flotante whatsapp"></button>
        <button class="boton-flotante instagram"></button>
        <button class="boton-flotante facebook"></button>
    </div>

    <!-- Botón flotante chat-->
    <div class="boton-flotantechad" id="boton-chat">
        <img src="img/Iconos/chat.png" alt="Chat Icon">
    </div>

    <!-- Contenedor para el chat -->
    <div id="chat-container" style="display: none;">
        <div class="modal-content-chad">
            <span class="close-chad" onclick="cerrarChat()">&times;</span>
            <?php include 'Modulos/chat.html'; ?>
        </div>     
    </div> 

    <!-- Titulo de productos -->
    <main class="contenedor">
        <h1>Nuestros Productos</h1>
        <!-- productos -->
        <div class="grid">
            <?php while($row = $result->fetch_assoc()) { ?>
                <div class="producto">
                    <a href="Modulos/Info_Producto.php?id_producto=<?php echo $row['id_producto']; ?>">
                    <img class="producto__imagen" src="img/Potafolio/<?php echo $row['imagen']; ?>" alt="imagen <?php echo $row['nombre']; ?>">
                        <div class="producto__informacion">
                            <p class="producto__nombre"><?php echo $row['nombre']; ?></p>
                            <p class="producto__precio">$<?php echo number_format($row['precio'], 3); ?></p>
                            <p class="producto__nombre">Iva Incluído</p>
                            <button class="btn-anadir-carrito" data-producto-id="<?php echo $row['id_producto']; ?>">Añadir al carrito</button>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </main>
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
                    <img src="img/MetodosPago/medios_de_pago.png" alt="Métodos de Pago">
                </div>
            </div>
        </div>
        <p class="footer__texto">SneakerStore - Todos los derechos reservados 2024</p>
    </footer>
    <!-- Enlaza tu archivo JavaScript aquí -->
    <script src="Js/script.js"></script>
    <script src="Js/Terminos.js"></script>
    <script src="Js/Sesion.js"></script>
    <script src="Js/chat.js"></script>
    <script src="Js/carrito.js"></script>
</body>
<!-- Terminos y Condiciones -->
<div class="terminos-y-condiciones">
        <?php include('Modulos/TerminosCondiciones.html'); ?>
    </div>
</html>