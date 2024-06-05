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
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/NikeForce.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Nike Air Force 1 '07</p>
                        <p class="producto__precio">$314.289</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>

                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/Frida Black.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Vans Frida Black</p>
                        <p class="producto__precio">$90.000</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/Adidas Tenis.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Adidas Tenis OwnTheGame</p>
                        <p class="producto__precio">$439.950</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/Converse.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Converse De plataforma alta</p>
                        <p class="producto__precio">$431.840</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/Diesel.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Zapatillas Para Hombre Diesel</p>
                        <p class="producto__precio">$180.900</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/Nivia.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">TENIS NEGRO ULTRA RUNNING NIVIA</p>
                        <p class="producto__precio">$119.900</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/Oliva.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Zapatillas arena Modelo M2530</p>
                        <p class="producto__precio">$132.822</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/Adidas.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">TENIS ADIDAS RESPONSE RUNNER</p>
                        <p class="producto__precio">$200.000</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/Puma.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Tenis VikkyV3 Negros | PUMA</p>
                        <p class="producto__precio">$389.900</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/AC.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">TENIS AC CASUAL CABALLERO</p>
                        <p class="producto__precio">$120.000</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/Lacoste.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Lacoste Clásica Hombre</p>
                        <p class="producto__precio">$170.000</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/Lacoste Origin.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Lacoste Chaymon 223 1 Cma</p>
                        <p class="producto__precio">$800.000</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/Jordan.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Air Jordan 1 Mid</p>
                        <p class="producto__precio">$584.194</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/Vergace.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">VERSACE TRIGECA</p>
                        <p class="producto__precio">$1.035.564</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/Balance.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Zapatillas New Balance</p>
                        <p class="producto__precio">$190.000</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/diesel-.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Tenis Diesel</p>
                        <p class="producto__precio">$150.000</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/Newbalance.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">NEW BALANCE 530 BLANCO AZUL GRIS</p>
                        <p class="producto__precio">$250.000</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/Nike AirZoom.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Nike Air Zoom ACG</p>
                        <p class="producto__precio">$190.000</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/PumaCarina.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Zapatillas Puma Carina 2.0</p>
                        <p class="producto__precio">$90.199</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="Modulos/producto.html">
                    <img class="producto__imagen" src="img/Potafolio/Dolce.jpg" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">DOLCE GABBANA NEGRO</p>
                        <p class="producto__precio">$225.000</p>
                        <p class="producto__nombre">Iva Incluído</p>
                        <button class="btn-anadir-carrito">Añadir al carrito</button>
                    </div>
                </a>
            </div>
        </div>
    </main>
    <!-- pie -->
    <footer class="footer">
        <p class="footer__texto">SneakerStore - Todos los derechos reservados 2024</p>
    </footer>
    <!-- Enlaza tu archivo JavaScript aquí -->
    <script src="Js/script.js"></script>
    <script src="Js/Terminos.js"></script>
    <script src="Js/Sesion.js"></script>
    <script src="Js/chat.js"></script>
</body>
<!-- Terminos y Condiciones -->
<div class="terminos-y-condiciones">
        <?php include('Modulos/TerminosCondiciones.html'); ?>
    </div>
</html>