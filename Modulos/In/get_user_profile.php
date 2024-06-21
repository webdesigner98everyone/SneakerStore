<?php
session_start();
require_once 'db_connection.php'; // Asegúrate de que la ruta sea correcta

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $usuario = $_SESSION['usuario'];

    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        echo json_encode(array(
            'status' => 'success',
            'data' => array(
                'nombre' => $row['nombre'],
                'contacto' => $row['contacto'],
                'direccion' => $row['direccion'],
                'ciudad' => $row['ciudad'],
                'codigo_postal' => $row['codpostal'],
                'correo' => $row['correo'],
            )
        ));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Usuario no encontrado'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'No autorizado'));
}

$conn->close();
?>
