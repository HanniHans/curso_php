<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- poner el if -->
    <?php
    if (!isset($_SESSION['usuario_id'])) {
        echo "No te haz logueado <br>";
    } else { ?>
        <form action="../controllers/granel_controller.php" method="post">
            <label for="granel">¿Cuanto vas a querer?</label>
            <input type="number" name="granel" step="0.01">
            <?php echo $productos_por_codigo_de_barras['unidad_de_medida']; ?>
            <button type="submit">Agregar</button>
        </form>
    <?php
    }
    ?>

</body>

</html>