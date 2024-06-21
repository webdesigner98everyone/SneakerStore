<?php
session_start();
require_once 'db_connection.php';

// Recibir datos del cuerpo de la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);

// Generar número de factura al azar (puedes ajustar la longitud según tus necesidades)
$numeroFactura = generarNumeroFactura();

// Obtener la fecha actual
$fechaGeneracion = date('Y-m-d'); // Formato YYYY-MM-DD

// Preparar consulta para insertar la factura
$stmt = $conn->prepare("INSERT INTO factura (cliente_nombre, cliente_contacto, total, estado, numero_factura, fecha) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssdsss", $data['cliente_nombre'], $data['cliente_contacto'], $data['total'], $data['estado'], $numeroFactura, $fechaGeneracion);

// Ejecutar consulta y verificar el resultado
$response = array();
if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['numero_factura'] = $numeroFactura; // Pasar el número de factura generado como parte de la respuesta
} else {
    $response['status'] = 'error';
}

// Cerrar declaración y conexión
$stmt->close();
$conn->close();

// Enviar respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);

// Función para generar un número de factura al azar
function generarNumeroFactura() {
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $longitud = 8; // Longitud del número de factura

    $numeroFactura = '';
    for ($i = 0; $i < $longitud; $i++) {
        $numeroFactura .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    return $numeroFactura;
}
?>
