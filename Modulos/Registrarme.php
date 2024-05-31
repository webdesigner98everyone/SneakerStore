<?php
require_once 'In/db_connection.php';
?>

<h2>Registrarse</h2>
<form id="registro-form" action="Modulos/In/registro_process.php" method="POST" class="login-content">
    <div class="input-group">
        <label for="reg-name">Nombre:</label>
        <input type="text" id="reg-name" name="nombre" placeholder="Nombre" required>
    </div>

    <div class="input-group">
        <label for="reg-email">Correo Electrónico:</label>
        <input type="email" id="reg-email" name="correo" placeholder="Correo Electrónico" required>
    </div>

    <div class="input-group">
        <label for="reg-ciudad">Ciudad:</label>
        <input type="text" id="reg-ciudad" name="ciudad" placeholder="Ciudad" required>
    </div>

    <div class="input-group">
        <label for="reg-direccion">Dirección:</label>
        <input type="text" id="reg-direccion" name="direccion" placeholder="Dirección de Residencia" required>
    </div>

    <div class="input-group">
        <label for="reg-codpostal">Código Postal:</label>
        <input type="text" id="reg-codpostal" name="codpostal" placeholder="Código Postal" required>
    </div>

    <div class="input-group">
        <label for="reg-contacto">Teléfono y/o Celular:</label>
        <input type="text" id="reg-contacto" name="contacto" placeholder="Teléfono y/o Celular" required>
    </div>
    
    <div class="input-group">
        <label for="reg-username">Usuario:</label>
        <input type="text" id="reg-username" name="usuario" placeholder="Usuario" required>
    </div>
    
    <div class="input-group">
        <label for="reg-password">Contraseña:</label>
        <input type="password" id="reg-password" name="contrasena" placeholder="Contraseña" required>
    </div>
    
    <button type="submit" class="btn">Registrarse</button>
</form>

