<?php
session_start();
require_once 'In/db_connection.php'; // Asegúrate de que la ruta sea correcta

// Verificar si la sesión está iniciada
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Obtener el nombre de usuario de la sesión
    $usuario = $_SESSION['usuario'];

    // Consultar la información del perfil del usuario desde la base de datos
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $result = $conn->query($sql);

    // Verificar si se encontró el usuario en la base de datos
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Mostrar la información del perfil del usuario con estilos en línea
        echo "<div style='max-width: 800px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);'>";
        echo "<h2 style='color: #333; font-size: 24px; margin-bottom: 20px;'>Perfil de $usuario</h2>";
        echo "<form action='In/actualizar_perfil.php' method='POST'>";
        echo "<p style='color: #666; font-size: 16px; margin-bottom: 10px;'><strong>ID de Usuario:</strong> " . $row['id_usuario'] . "</p>";
        echo "<input type='hidden' name='id_usuario' value='" . $row['id_usuario'] . "'>"; // Campo oculto con el ID de usuario
        echo "<p style='color: #666; font-size: 16px; margin-bottom: 10px;'><strong>Nombre:</strong> <input type='text' name='nombre' value='" . $row['nombre'] . "'></p>";
        echo "<p style='color: #666; font-size: 16px; margin-bottom: 10px;'><strong>Correo:</strong> <input type='text' name='correo' value='" . $row['correo'] . "'></p>";
        echo "<p style='color: #666; font-size: 16px; margin-bottom: 10px;'><strong>Ciudad:</strong> <input type='text' name='ciudad' value='" . $row['ciudad'] . "'></p>";
        echo "<p style='color: #666; font-size: 16px; margin-bottom: 10px;'><strong>Dirección:</strong> <input type='text' name='direccion' value='" . $row['direccion'] . "'></p>";
        echo "<p style='color: #666; font-size: 16px; margin-bottom: 10px;'><strong>Código Postal:</strong> <input type='text' name='codpostal' value='" . $row['codpostal'] . "'></p>";
        echo "<p style='color: #666; font-size: 16px; margin-bottom: 10px;'><strong>Contacto:</strong> <input type='text' name='contacto' value='" . $row['contacto'] . "'></p>";
        echo "<button type='submit' style='background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;'>Actualizar</button>";
        echo "<a href='../index.php' style='text-decoration: none; color: white; background-color: #f44336; padding: 10px 20px; border-radius: 5px; margin-left: 10px;'>Cancelar</a>";
        echo "</form>";
        echo "</div>";
        // Puedes continuar mostrando otros campos del perfil aquí
    } else {
        // Manejar el caso en que no se encuentre el usuario
        echo "Usuario no encontrado";
    }
} else {
    // Redireccionar si la sesión no está iniciada
    header("Location: ../../index.php");
    exit();
}
?>
