<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Usuario</title>
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

        body {
            font-family: var(--fuente);
            background-color: var(--blanco);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: var(--blanco);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            color: var(--negro);
            margin-bottom: 20px;
        }

        form {
            display: grid;
            gap: 10px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            padding: 8px;
            border: 1px solid var(--primario);
            border-radius: 5px;
        }

        button[type="submit"] {
            background-color: var(--primarioOscuro);
            color: var(--blanco);
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: var(--secundarioOscuro);
        }

        button[type="button"] {
            background-color: var(--primarioOscuro);
            color: var(--blanco);
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="button"]:hover {
            background-color: var(--secundarioOscuro);
        }

        .success {
            background-color: var(--primarioOscuro);
            color: var(--blanco);
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .error {
            background-color: var(--f44336);
            color: var(--blanco);
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    require_once 'In/db_connection.php'; // Asegúrate de que la ruta sea correcta
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        // Obtener el nombre de usuario de la sesión
        $usuario = $_SESSION['usuario'];

        // Consultar la información del perfil del usuario desde la base de datos
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $result = $conn->query($sql);

        // Verificar si se encontró el usuario en la base de datos
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Recibir y sanitizar los datos del formulario
                $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
                $correo = mysqli_real_escape_string($conn, $_POST['correo']);
                $ciudad = mysqli_real_escape_string($conn, $_POST['ciudad']);
                $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
                $codpostal = mysqli_real_escape_string($conn, $_POST['codpostal']);
                $contacto = mysqli_real_escape_string($conn, $_POST['contacto']);

                // Verificar que todos los campos estén completos
                if (!empty($nombre) && !empty($correo) && !empty($ciudad) && !empty($direccion) && !empty($codpostal) && !empty($contacto)) {
                    // Preparar la consulta SQL para actualizar los datos del perfil
                    $sql_update = "UPDATE usuarios SET nombre=?, correo=?, ciudad=?, direccion=?, codpostal=?, contacto=? WHERE id_usuario=?";
                    $stmt = $conn->prepare($sql_update);
                    $stmt->bind_param("sssssii", $nombre, $correo, $ciudad, $direccion, $codpostal, $contacto, $row['id_usuario']);

                    // Ejecutar la consulta
                    if ($stmt->execute()) {
                        echo '<div class="success">El perfil se actualizó correctamente.</div>';
                    } else {
                        echo '<div class="error">Error al actualizar el perfil. Por favor, intenta de nuevo.</div>';
                    }

                    $stmt->close();
                } else {
                    echo '<div class="error">Todos los campos son requeridos.</div>';
                }
            }
    ?>
            <div class="container">
            <h1>Perfil del Usuario: <?php echo $usuario; ?></h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <label for="id_usuario">ID de Usuario:</label>
                    <input type="text" id="id_usuario" name="id_usuario" value="<?php echo $row['id_usuario']; ?>" readonly required>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>
                    <label for="correo">Correo:</label>
                    <input type="text" id="correo" name="correo" value="<?php echo $row['correo']; ?>" required>
                    <label for="ciudad">Ciudad:</label>
                    <input type="text" id="ciudad" name="ciudad" value="<?php echo $row['ciudad']; ?>" required>
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" value="<?php echo $row['direccion']; ?>" required>
                    <label for="codpostal">Código Postal:</label>
                    <input type="text" id="codpostal" name="codpostal" value="<?php echo $row['codpostal']; ?>" required>
                    <label for="contacto">Contacto:</label>
                    <input type="text" id="contacto" name="contacto" value="<?php echo $row['contacto']; ?>" required>
                    <button type="submit">Actualizar</button>
                    <button type="button" onclick="window.location.href='../index.php'">Cancelar</button>
                </form>
            </div>
    <?php
        } else {
            // Manejar el caso en que no se encuentre el usuario
            echo '<div class="error">Usuario no encontrado</div>';
        }
    } else {
        // Redireccionar si la sesión no está iniciada
        header("Location: ../../index.php");
        exit();
    }
    ?>
</body>

</html>
