<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = $_POST['id_producto'];
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

    $producto_carrito = [
        'id' => $producto['id_producto'],
        'nombre' => $producto['nombre'],
        'precio' => floatval($producto['precio']),
        'cantidad' => $cantidad
    ];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    $producto_encontrado = false;
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['id'] == $id_producto) {
            $item['cantidad'] += $cantidad;
            $producto_encontrado = true;
            break;
        }
    }

    if (!$producto_encontrado) {
        $_SESSION['carrito'][] = $producto_carrito;
    }

    // Actualiza el carrito en sessionStorage
    echo "<script>
        let carrito = " . json_encode($_SESSION['carrito']) . ";
        sessionStorage.setItem('carrito', JSON.stringify(carrito));
    </script>";
    exit;
}
