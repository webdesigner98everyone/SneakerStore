// Función para abrir el formulario de login
function abrirLogin() {
    document.getElementById('login-container').style.display = 'block';
}

// Función para cerrar el formulario de login
function cerrarLogin() {
    document.getElementById('login-container').style.display = 'none';
}

// Función para abrir el formulario de registro
function abrirRegistro() {
    cerrarLogin();
    document.getElementById('registro-container').style.display = 'block';
}

// Función para cerrar el formulario de registro
function cerrarRegistro() {
    document.getElementById('registro-container').style.display = 'none';
}

// Función para abrir el formulario de "Olvidé mi contraseña"
function abrirOlvide() {
    cerrarLogin();
    document.getElementById('olvide-container').style.display = 'block';
}

// Función para cerrar el formulario de "Olvidé mi contraseña"
function cerrarOlvide() {
    document.getElementById('olvide-container').style.display = 'none';
}