// Obtener referencia al botón flotante del chat
const botonChat = document.getElementById('boton-chat');

// Agregar evento de clic al botón flotante del chat para abrir el chat
botonChat.addEventListener('click', abrirChat);

// Función para abrir el chat
function abrirChat() {
    // Obtener referencia al contenedor del chat
    const chatContainer = document.getElementById('chat-container');

    // Mostrar el contenedor del chat
    chatContainer.style.display = 'block';
}

// Función para cerrar el chat
function cerrarChat() {
    // Obtener referencia al contenedor del chat
    const chatContainer = document.getElementById('chat-container');

    // Ocultar el contenedor del chat
    chatContainer.style.display = 'none';
}
