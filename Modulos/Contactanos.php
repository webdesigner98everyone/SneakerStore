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
</body>
</html>