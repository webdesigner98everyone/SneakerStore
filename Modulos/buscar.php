<?php
require_once 'In/db_connection.php';

$query = $_GET['query'];

$sql = "SELECT * FROM productos WHERE nombre LIKE ?";
$stmt = $conn->prepare($sql);
$param = "%" . $query . "%";
$stmt->bind_param("s", $param);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si no se encontraron productos
if ($result->num_rows === 0) {
    echo '<p class="no-products-message">Producto no existente</p>';
} else {
    // Mostrar los productos encontrados
    while ($row = $result->fetch_assoc()) {
        echo '<div class="producto">';
        echo '<a href="Modulos/info_producto.php?id_producto=' . $row['id_producto'] . '">';
        echo '<img class="producto__imagen" src="img/Potafolio/' . $row['imagen'] . '" alt="imagen ' . $row['nombre'] . '">';
        echo '<div class="producto__informacion">';
        echo '<p class="producto__nombre">' . $row['nombre'] . '</p>';
        echo '<p class="producto__precio">$' . number_format($row['precio'], 3) . '</p>';
        echo '<p class="producto__nombre">Iva Incluído</p>';
        echo '<button class="btn-anadir-carrito" data-producto-id="' . $row['id_producto'] . '">Añadir al carrito</button>';
        echo '</div>';
        echo '</a>';
        echo '</div>';
    }
}
