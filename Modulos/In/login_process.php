<?php
session_start();
require_once 'db_connection.php'; // Asegúrate de que la ruta sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta SQL para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($contrasena, $row['contrasena'])) {
            // Credenciales correctas, redirigir a la página de bienvenida
            header("Location: ../Bienvenido.html");
            exit();
        } else {
            // Contraseña incorrecta, redirigir a la página de error de usuario
            header("Location: ../Error_usuario.html");
            exit();
        }
    } else {
        // Usuario no encontrado, redirigir a la página de no existe
        header("Location: ../Noexiste.html");
        exit();
    }
}
?>
