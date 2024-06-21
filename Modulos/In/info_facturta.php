<?php
session_start();
require_once 'db_connection.php';

// Obtener el último ID de factura insertado
$result = $conn->query("SELECT * FROM factura ORDER BY id_factura DESC LIMIT 1");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id_factura = $row['id_factura'];
    $numero_factura = $row['numero_factura'];
    $fecha = $row['fecha'];
    $cliente_nombre = $row['cliente_nombre'];
    $cliente_contacto = $row['cliente_contacto'];
    $total = $row['total'];
    $estado = $row['estado'];
} else {
    die("No se encontraron datos de factura");
}

// Generar la factura electrónica (puedes formatear esto en HTML, PDF, etc.)
$facturaElectronica = "
    <h2>Factura Electrónica</h2>
    <p><strong>ID de Factura:</strong> $id_factura</p>
    <p><strong>Número de Factura:</strong> $numero_factura</p>
    <p><strong>Fecha:</strong> $fecha</p>
    <p><strong>Cliente:</strong> $cliente_nombre</p>
    <p><strong>Contacto:</strong> $cliente_contacto</p>
    <p><strong>Total:</strong> $total</p>
    <p><strong>Estado:</strong> $estado</p>
";

// Mostrar la factura electrónica (puedes adaptar esto según tus necesidades)
echo $facturaElectronica;

// Cerrar conexión
$conn->close();
?>
