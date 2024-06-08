<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['producto_id']) && isset($_POST['cantidad'])) {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    // Actualizar el stock en la base de datos
    $sql = "UPDATE productos SET stock = stock - ? WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cantidad, $producto_id);
    $stmt->execute();
    $stmt->close();

    // Obtener el nuevo valor de stock
    $sql = "SELECT stock FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $nuevo_stock = 0;
    if ($row = $result->fetch_assoc()) {
        $nuevo_stock = $row['stock'];
    }
    $stmt->close();

    // Devolver el nuevo valor de stock como respuesta
    echo $nuevo_stock;
} else {
    // Si no se reciben los datos correctamente, devolver un error
    echo "Error: No se recibieron los datos correctamente.";
}

$conn->close();
?>
