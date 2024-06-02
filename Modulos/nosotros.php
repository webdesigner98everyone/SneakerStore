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
        <!-- navegacion__enlace--activo modificador esto lo que hace es cuando entremos al sitio tienda
        el titulo quede activo en amarillo -->
        <a class="navegacion__enlace" href="../index.php">Portafolio</a>
        <a class="navegacion__enlace navegacion__enlace--activo" href="nosotros.php">Quiénes Somos</a>
        <a class="navegacion__enlace navegacion__enlace--activo" href="Contactanos.php">Contactanos</a>
        <a class="navegacion__enlace navegacion__enlace--activo" href="#" onclick="abrirLogin()">Iniciar Sesión</a>
        <a class="navegacion__enlace navegacion__enlace--carrito" href="#"> <!-- Nuevo enlace para el carrito -->
            <img src="../img/Iconos/carrito.png" alt="Carrito de compras"> <!-- Ícono de carrito -->
        </a>
    </nav>

     <!-- Formulario de Login -->
     <div class="login-container" id="login-container">
        <div class="modal-content">
            <span class="close-login" onclick="cerrarLogin()">&times;</span>
            <?php include 'Sesion.php'; ?>
        </div>
    </div>

    <!-- Formulario de Registro -->
    <div class="login-container" id="registro-container">
        <div class="modal-content">
            <span class="close-login" onclick="cerrarRegistro()">&times;</span>
            <?php include 'Registrarme.php'; ?>
        </div>
    </div>

    <!-- Formulario de Recuperación de Contraseña -->
    <div class="login-container" id="olvide-container">
        <div class="modal-content">
            <span class="close-login" onclick="cerrarOlvide()">&times;</span>
            <?php include 'Reset_Contrasena.html'; ?>
        </div>
    </div>

    <!-- Botones flotantes -->
    <div class="botones-flotantes">
        <button class="boton-flotante whatsapp"></button>
        <button class="boton-flotante instagram"></button>
        <button class="boton-flotante facebook"></button>
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
    <!-- pie -->
    <footer class="footer">
        <p class="footer__texto">SneakerStore - Todos los derechos reservados 2024 </p>
    </footer>
    <!-- Enlaza tu archivo JavaScript aquí -->
    <script src="../Js/script.js"></script>
    <script src="../Js/Sesion.js"></script>
</body>
</html>