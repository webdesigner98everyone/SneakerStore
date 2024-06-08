<?php
session_start();
require_once 'In/db_connection.php'; // Asegúrate de que la ruta sea correcta

// Consulta SQL para obtener los productos
$sql = "SELECT id_producto, nombre, descripcion, precio, stock, imagen, talla, color, marca FROM productos";
$result = $conn->query($sql);

// Verificar si la sesión está iniciada
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $usuario = $_SESSION['usuario'];
    $nombre_usuario = '<a class="navegacion__enlace navegacion__enlace--activo" href="#">' . $usuario . '</a>'; // Nombre de usuario con los mismos estilos que las otras opciones del menú
    $cerrar_sesion = '<a class="navegacion__enlace" href="In/logout.php">Cerrar Sesión</a>'; // Enlace para cerrar sesión
} else {
    $nombre_usuario = '<a class="navegacion__enlace navegacion__enlace--activo" href="#" onclick="abrirLogin()">Iniciar Sesión</a>'; // Enlace para iniciar sesión
    $cerrar_sesion = ''; // No mostrar enlace para cerrar sesión si no hay sesión iniciada
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneaker Store</title>
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

        #productos {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
        }

        .producto {
            background-color: var(--blanco);
            border: 2px solid var(--primarioOscuro);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: calc(50.33% - 20px);
            max-width: 400px;
            min-width: 250px;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .producto:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .producto img {
            max-width: 100%;
            height: auto;
            border-bottom: 2px solid var(--secundarioOscuro);
        }

        .producto .contenido {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .producto h2 {
            color: var(--primarioOscuro);
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .producto p {
            margin: 5px 0;
        }

        .producto .precio {
            color: var(--secundarioOscuro);
            font-weight: bold;
            font-size: 1.2em;
        }

        .producto .stock {
            font-size: 0.9em;
            color: var(--primarioOscuro);
        }

        .producto .talla select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--primarioOscuro);
            border-radius: 5px;
            font-size: 1em;
            background-color: var(--blanco);
            color: var(--negro);
        }

        .producto .color {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .producto .color .circulo {
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

        /* Estilo Carrito */

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
    </style>
</head>
<body>
    <!-- Encabezado -->
    <header class="header">
        <a href="../index.html">
            <img class="header__logo" src="../img/Logo/Marca.png" alt="Logotipo">
        </a>
    </header>
    <nav class="navegacion">
    <a class="navegacion__enlace navegacion__enlace--carrito" href="#">
        <img src="../img/Iconos/carrito.png" alt="Carrito de compras">
        <span id="contador-carrito">0</span> <!-- Contador del carrito -->
    </a>
</nav>

    <h1>Productos</h1>
    <div id="productos">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $tallas = explode(',', $row["talla"]);
                echo '<div class="producto">';
                echo '<img src="' . $row["imagen"] . '" alt="' . $row["nombre"] . '">';
                echo '<div class="contenido">';
                echo '<h2>' . $row["nombre"] . '</h2>';
                echo '<p>' . $row["descripcion"] . '</p>';
                echo '<p class="precio">Precio: $' . $row["precio"] . '</p>';
                echo '<p class="stock">Stock x Pares: ' . $row["stock"] . ' Unidades Disponibles</p>';
                echo '<div class="talla">';
                echo '<select>';
                echo '<option disabled selected>Seleccione su talla</option>';
                foreach ($tallas as $talla) {
                    echo '<option value="' . trim($talla) . '">' . trim($talla) . '</option>';
                }
                echo '</select>';
                echo '</div>';
                echo '<div class="color">';
                echo '<span>Color:</span>';
                echo '<div class="circulo" style="background-color: ' . $row["color"] . ';"></div>';
                echo '</div>';
                echo '<p>Marca: ' . $row["marca"] . '</p>';
                echo '<button class="boton-anadir-carrito" data-producto-id="' . $row["id_producto"] . '" data-cantidad="1">Añadir al carrito</button>';
                echo '</div>'; // Cerramos el div con clase "contenido"
                echo '</div>'; // Cerramos el div con clase "producto"
            }
            
        } else {
            echo '<p>No hay productos disponibles.</p>';
        }
        $conn->close();
        ?>
    </div>
    <div class="boton-volver">
        <button onclick="window.location.href='../index.php'">Volver</button>
    </div>
    <script src="../Js/add_carrito.js"></script>
</body>
</html>
