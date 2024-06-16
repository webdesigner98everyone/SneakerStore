<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = $_POST['producto_id'];
    $cantidad = intval($_POST['cantidad']);

    $sql = "SELECT * FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $producto = $resultado->fetch_assoc();

    if (!$producto) {
        die("Producto no encontrado.");
    }

    $nuevo_stock = $producto['stock'] - $cantidad;
    $update_sql = "UPDATE productos SET stock = ? WHERE id_producto = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ii", $nuevo_stock, $id_producto);
    $update_stmt->execute();

    echo $nuevo_stock;
}
?>
