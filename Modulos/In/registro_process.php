<?php
session_start();
require_once 'db_connection.php'; // Reemplaza "ruta/a" con la ruta correcta hacia tu archivo de conexión

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y sanitizar los datos del formulario
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $ciudad = mysqli_real_escape_string($conn, $_POST['ciudad']);
    $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
    $codpostal = mysqli_real_escape_string($conn, $_POST['codpostal']);
    $contacto = mysqli_real_escape_string($conn, $_POST['contacto']);
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $contrasena = mysqli_real_escape_string($conn, $_POST['contrasena']);

    // Hash de la contraseña
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    // Query para insertar los datos del usuario en la tabla usuario
    $sql = "INSERT INTO usuarios (nombre, correo, ciudad, direccion, codpostal, contacto, usuario, contrasena) 
            VALUES ('$nombre', '$correo', '$ciudad', '$direccion', '$codpostal', '$contacto', '$usuario', '$hashed_password')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Registro exitoso
        $_SESSION['mensaje'] = "Registro exitoso. ¡Inicia sesión ahora!";
        header("Location: ../../index.php"); // Redireccionar al usuario a la página de inicio de sesión
        exit(); // Detener la ejecución del script después de redireccionar
    } else {
        // Error en la consulta
        $_SESSION['error'] = "Error al registrar usuario: " . $conn->error;
        header("Location: ../../index.php"); // Redireccionar al usuario de vuelta al formulario de registro
        exit(); // Detener la ejecución del script después de redireccionar
    }

    // Si el formulario no se envió por el método POST, redirigir de vuelta al formulario de registro
    header("Location: ../index.php");
    exit(); // Detener la ejecución del script después de redireccionar
}
?>
