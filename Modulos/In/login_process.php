<?php
session_start();
require_once 'db_connection.php'; // Asegúrate de que la ruta sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta preparada para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($contrasena, $row['contrasena'])) {
            // Credenciales correctas, redirigir a la página de bienvenida
            $_SESSION['loggedin'] = true;
            $_SESSION['usuario'] = $usuario;
            header("Location: ../Bienvenido.html");
            exit();
        } else {
            // Contraseña incorrecta, redirigir a la página de error de usuario
            $_SESSION['error'] = "Nombre de usuario o contraseña incorrectos";
            header("Location: ../Error_usuario.html");
            exit();
        }
    } else {
        // Usuario no encontrado, redirigir a la página de no existe
        $_SESSION['error'] = "Nombre de usuario o contraseña incorrectos";
        header("Location: ../Noexiste.html");
        exit();
    }
}
?>
