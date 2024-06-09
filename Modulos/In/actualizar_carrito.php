<?php
session_start();

// Obtener los datos del carrito desde la solicitud POST
$data = file_get_contents("php://input");
$carrito = json_decode($data, true);

// Almacenar el carrito en la sesión
$_SESSION['carrito'] = $carrito;

// Responder con éxito
echo json_encode(['success' => true]);
