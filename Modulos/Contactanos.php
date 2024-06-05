<?php
session_start();
require_once 'In/db_connection.php'; // Asegúrate de que la ruta sea correcta

// Verificar si la sesión está iniciada
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $usuario = $_SESSION['usuario'];
    $nombre_usuario = '<a class="navegacion__enlace navegacion__enlace--activo" href="#">' . $usuario . '</a>'; // Nombre de usuario con los mismos estilos que las otras opciones del menú
    $cerrar_sesion = '<a class="navegacion__enlace" href="In/logout.php">Cerrar Sesión</a>'; // Enlace para cerrar sesión
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
    <!-- navegacion -->
    <nav class="navegacion">
        <a class="navegacion__enlace" href="../index.php">Portafolio</a>
            <a class="navegacion__enlace navegacion__enlace--activo" href="nosotros.php">Quiénes Somos</a>
            <a class="navegacion__enlace navegacion__enlace--activo" href="Contactanos.php">Contactanos</a>
            <a class="navegacion__nombre-usuario"><?php echo $nombre_usuario; ?></a>
            <?php echo $cerrar_sesion; ?>
            <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { ?>
                <a class="navegacion__enlace" href="perfil.php">Mi Perfil</a>
            <?php } ?>
            <a class="navegacion__enlace navegacion__enlace--carrito" href="#">
                <img src="../img/Iconos/carrito.png" alt="Carrito de compras">
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
      
      
      
    <!-- pie -->
    <footer class="footer">
        <p class="footer__texto">SneakerStore - Todos los derechos reservados 2024 </p>
    </footer>
     <!-- Enlaza tu archivo JavaScript aquí -->
    <script src="../Js/script.js"></script>
    <script src="../Js/Sesion.js"></script>
    <script src="../Js/chat.js"></script>
</body>
</html>