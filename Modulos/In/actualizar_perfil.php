<?php
session_start();
require_once 'db_connection.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_usuario = $_POST['id_usuario']; // Obtener el ID de usuario del campo oculto

        // Recibir y sanitizar los datos del formulario
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $correo = mysqli_real_escape_string($conn, $_POST['correo']);
        $ciudad = mysqli_real_escape_string($conn, $_POST['ciudad']);
        $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
        $codpostal = mysqli_real_escape_string($conn, $_POST['codpostal']);
        $contacto = mysqli_real_escape_string($conn, $_POST['contacto']);

        // Preparar la consulta SQL para actualizar los datos del perfil
        $sql = "UPDATE usuarios SET nombre=?, correo=?, ciudad=?, direccion=?, codpostal=?, contacto=? WHERE id_usuario=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $nombre, $correo, $ciudad, $direccion, $codpostal, $contacto, $id_usuario);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $_SESSION['success_msg'] = "Perfil actualizado correctamente.";
            header("Location: ../perfil.php");
            exit();
        } else {
            $_SESSION['error_msg'] = "Error al actualizar el perfil: " . $stmt->error;
            header("Location: ../perfil.php");
            exit();
        }

        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        $_SESSION['error_msg'] = "Acceso no permitido.";
        header("Location: ../perfil.php");
        exit();
    }
} else {
    header("Location: ../../index.php");
    exit();
}
