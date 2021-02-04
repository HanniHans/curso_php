<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="../controllers/granel_controller.php" method="post">
        <label for="granel">¿Cuanto vas a querer?</label>
        <input type="number" name="granel" id="">
        <?php echo $productos_por_codigo_de_barras['unidad_de_medida'];?>
        <button type="submit">Agregar</button>
    </form>
</body>
</html>