<?php
session_start();
require_once 'In/db_connection.php'; // Asegúrate de que la ruta sea correcta

if(isset($_GET['id_producto'])) {
    $id_producto = $_GET['id_producto'];

    // Consulta SQL para obtener la información del producto específico
    $sql = "SELECT id_producto, nombre, descripcion, precio, stock, imagen, talla, color, marca FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
    } else {
        echo "Producto no encontrado.";
        exit();
    }
} else {
    echo "ID de producto no proporcionado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto['nombre']; ?> - Sneaker Store</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap">
    <style>
        :root {
            --primario: #9C27B0;
            --primarioOscuro: #89119D;
            --secundario: #FFCE00;
            --secundarioOscuro: rgb(233, 187, 2);
            --blanco: #FFF;
            --negro: #000;
            --fuente: 'Staatliches', cursive;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--fuente);
            background-color: var(--primarioOscuro);
            color: var(--negro);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding: 20px;
        }

        h1 {
            text-align: center;
            background-color: var(--primario);
            color: var(--blanco);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .producto-detalle {
            background-color: var(--blanco);
            border: 2px solid var(--primarioOscuro);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: calc(100% - 40px);
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            padding: 20px;
            gap: 10px;
        }

        .producto-detalle img {
            max-width: 100%;
            height: auto;
            border-bottom: 2px solid var(--secundarioOscuro);
        }

        .producto-detalle h1 {
            color: var(--primarioOscuro);
            font-size: 2em;
        }

        .producto-detalle p {
            margin: 5px 0;
        }

        .producto-detalle .precio {
            color: var(--secundarioOscuro);
            font-weight: bold;
            font-size: 1.2em;
        }

        .producto-detalle .stock {
            font-size: 0.9em;
            color: var(--primarioOscuro);
        }

        .producto-detalle .talla select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--primarioOscuro);
            border-radius: 5px;
            font-size: 1em;
            background-color: var(--blanco);
            color: var(--negro);
        }

        .producto-detalle .color {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .producto-detalle .color .circulo {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: var(--negro);
            border: 1px solid var(--primarioOscuro);
        }

        .boton-volver {
            text-align: center;
            margin-top: 20px;
        }

        .boton-volver button {
            background-color: var(--secundario);
            color: var(--blanco);
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .boton-volver button:hover {
            background-color: var(--secundarioOscuro);
        }

        /* Estilo navegacion */
        .navegacion {
            background-color: var(--primarioOscuro);
            padding: 1rem 0;
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .navegacion__enlace {
            font-family: var(--fuente);
            color: var(--blanco);
            font-size: 2rem;
            padding: 1rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .navegacion__enlace--carrito {
            margin-right: 20px;
            background-color: var(--primarioOscuro); /* Color de fondo del contenedor */
            padding: 8px; /* Ajustar el espacio interno alrededor del ícono */
            border-radius: 50%; /* Hacer el contenedor circular */
            width: 50px; /* Ancho del contenedor igual al tamaño de la imagen */
            height: 50px; /* Altura del contenedor igual al tamaño de la imagen */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navegacion__enlace--carrito img {
            width: 30px; /* Ajustar el tamaño del ícono del carrito */
            height: auto;
        }

        .navegacion__enlace--activo,
        .navegacion__enlace:hover {
            color: var(--secundario);
        }

        .navegacion__enlace--carrito:hover {
            background-color: var(--primario); /* Cambiar el color de fondo al pasar el mouse */
            transition: background-color 0.3s ease; /* Agregar una transición suave */
        }

        /* Estilos para el botón "Añadir al carrito" */
        .boton-anadir-carrito {
            background-color: var(--secundario);
            color: var(--blanco);
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .boton-anadir-carrito:hover {
            background-color: var(--secundarioOscuro);
        }

        
        /* Estilo Grid */
        .grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        }

        /* Estilo header */
        .header {
        display: flex;
        justify-content: center;
        margin-top: 1rem;
        margin-bottom: 1rem;
        }

        .header__logo {
        margin: 0;
        }
    </style>
</head>
<body>
    <!-- Encabezado -->
    <header class="header">
        <a href="../index.php">
            <img class="header__logo" src="../img/Logo/Marca.png" alt="Logotipo">
        </a>
    </header>
    <nav class="navegacion">
        <a class="navegacion__enlace navegacion__enlace--carrito" href="#">
            <img src="../img/Iconos/carrito.png" alt="Carrito de compras">
            <span id="contador-carrito">0</span> <!-- Contador del carrito -->
        </a>
    </nav>

    <div class="producto-detalle" id="productos">
        <img src="../img/Potafolio/<?php echo $producto['imagen']; ?>" alt="imagen <?php echo $producto['nombre']; ?>">
        <h1><?php echo $producto['nombre']; ?></h1>
        <p><?php echo $producto['descripcion']; ?></p>
        <p class="precio">Precio: $<?php echo number_format($producto['precio'], 3); ?></p>
        <p class="stock">Stock x Pares: <?php echo $producto['stock']; ?> Unidades Disponibles</p>
        <div class="talla">
            <label for="talla">Talla:</label>
            <select id="talla">
                <option disabled selected>Seleccione su talla</option>
                <?php
                $tallas = explode(',', $producto['talla']);
                foreach ($tallas as $talla) {
                    echo '<option value="' . trim($talla) . '">' . trim($talla) . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="color">
            <span>Color:</span>
            <div class="circulo" style="background-color: <?php echo $producto['color']; ?>;"></div>
        </div>
        <p>Marca: <?php echo $producto['marca']; ?></p>
        <?php if ($producto['stock'] > 0): ?>
            <button class="boton-anadir-carrito" data-producto-id="<?php echo $producto['id_producto']; ?>" data-cantidad="1">Añadir al carrito</button>
        <?php else: ?>
            <button class="boton-anadir-carrito" disabled>No disponible</button>
        <?php endif; ?>
    </div>
    <div class="boton-volver">
        <button onclick="window.location.href='../index.php'">Volver</button>
    </div>
    <script src="../Js/add_carrito.js"></script>
</body>
</html>
