<?php
session_start();
require_once 'db_connection.php';

// Obtener los datos del carrito y el total desde la solicitud AJAX
$data = json_decode(file_get_contents('php://input'), true);
$carrito = $data['carrito'];
$total = $data['total'];

$conn->autocommit(FALSE); // Desactivar autocommit para manejar transacciones

try {
    // Preparar y ejecutar las consultas para insertar en detalle_pedido
    foreach ($carrito as $producto) {
        $id_producto = $producto['id'];
        $nombre = $producto['nombre']; // Asegurarse de que el campo 'nombre' exista en el carrito
        $cantidad = $producto['cantidad'];
        $precio_unitario = $producto['precio'];
        $subtotal = $producto['cantidad'] * $producto['precio'];
        $talla = $producto['talla'];

        // Verificar si el producto ya existe en detalle_pedido
        $stmt = $conn->prepare("SELECT id_detalle, cantidad, subtotal FROM detalle_pedido WHERE id_producto = ? AND talla = ?");
        $stmt->bind_param("is", $id_producto, $talla);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // El producto ya existe, actualizar la cantidad y el subtotal
            $row = $result->fetch_assoc();
            $new_cantidad = $row['cantidad'] + $cantidad;
            $new_subtotal = $row['subtotal'] + $subtotal;

            $update_stmt = $conn->prepare("UPDATE detalle_pedido SET cantidad = ?, subtotal = ? WHERE id_detalle = ?");
            $update_stmt->bind_param("idi", $new_cantidad, $new_subtotal, $row['id_detalle']);
            $update_stmt->execute();
            $update_stmt->close();
        } else {
            // El producto no existe, insertar un nuevo registro
            $insert_stmt = $conn->prepare("INSERT INTO detalle_pedido (id_producto, nombre, cantidad, talla, precio_unitario, subtotal) VALUES (?, ?, ?, ?, ?, ?)");
            $insert_stmt->bind_param("isissd", $id_producto, $nombre, $cantidad, $talla, $precio_unitario, $subtotal);
            $insert_stmt->execute();
            $insert_stmt->close();
        }
        $stmt->close();
    }
    $conn->commit(); // Commit de la transacción
    echo json_encode(array('status' => 'success'));
} catch (Exception $e) {
    $conn->rollback(); // Rollback de la transacción en caso de error
    echo json_encode(array('status' => 'error', 'message' => 'Error al guardar detalle de pedido: ' . $e->getMessage()));
}

$conn->close();
