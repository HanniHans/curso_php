<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos a Eliminar</title>
</head>

<body>

    <?php
    if (!isset($_SESSION['usuario_id'])) {
        echo "No estas logueado";
    } else { ?>
        <form action="../controllers/eliminar_producto_paquete_controller.php" method="post">
            <label for="cantidad_de_prodcutos_eliminados">¿Cuantos productos vas a eliminar?</label>
            <input type="text" name="cantidad_de_prodcutos_eliminados" id="">
            <button type="submit">Eliminar</button>
        </form>
    <?php
    }
    ?>

</body>

</html>