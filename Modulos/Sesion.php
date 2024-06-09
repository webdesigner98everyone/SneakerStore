<h2>Iniciar Sesión</h2>
<form id="login-form" action="Modulos/In/login_process.php" method="POST" class="login-content"> <!-- Agregué una clase para el formulario -->

    <label for="login-username">Usuario:</label>
    <input type="text" id="login-username" name="usuario" class="input-field" placeholder="Usuario" required>

    <label for="login-password">Contraseña:</label>
    <input type="password" id="login-password" name="contrasena" class="input-field" placeholder="Contraseña" required>

    <button type="submit" class="btn-login">Iniciar Sesión</button>
</form>

<div class="modal-links">
    <a href="#" onclick="abrirRegistro()">Registrarse</a> |
    <a href="#" onclick="abrirOlvide()">Recuperar contraseña</a>
</div>