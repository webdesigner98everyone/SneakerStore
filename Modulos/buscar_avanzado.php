<?php
require_once 'In/db_connection.php';

// Inicializar la variable para la consulta SQL
$sql = "SELECT * FROM productos WHERE 1";

// Verificar si se enviaron parámetros de búsqueda
if (!empty($_GET['precio_min'])) {
    $precio_min = str_replace(',', '', $_GET['precio_min']); // Eliminar comas
    $sql .= " AND precio >= " . $precio_min;
}
if (!empty($_GET['precio_max'])) {
    $precio_max = str_replace(',', '', $_GET['precio_max']); // Eliminar comas
    $sql .= " AND precio <= " . $precio_max;
}
if (!empty($_GET['talla'])) {
    $sql .= " AND talla = '" . $_GET['talla'] . "'";
}
if (!empty($_GET['marca'])) {
    $sql .= " AND marca = '" . $_GET['marca'] . "'";
}

// Ejecutar la consulta SQL
$result = $conn->query($sql);

// Comprobar si se encontraron resultados
if ($result->num_rows > 0) {
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
} else {
    // Si no se encontraron resultados, mostrar un mensaje
    echo '<p>No se encontraron productos que coincidan con los criterios de búsqueda.</p>';
}
?>
