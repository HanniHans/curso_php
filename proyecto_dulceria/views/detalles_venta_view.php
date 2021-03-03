<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Venta <?php echo $venta_id; ?></title>
</head>

<body>
    <?php
    if (!isset($_SESSION['usuario_id'])) {
        echo "no estas logueado";
    } else { ?>
        <h1>Venta <?php echo $venta_id; ?></h1>
        <table>
            <thead>
                <tr>
                    <th>Codigo de Barras</th>
                    <th>Productos</th>
                    <th>Precio Venta</th>
                    <th>Total Por producto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos_de_venta as $producto_de_venta) { ?>
                    <tr>
                        <td><?php echo $producto_de_venta['codigo_de_barras']; ?></td>
                        <td><?php echo $producto_de_venta['producto']; ?></td>
                        <td><?php echo $producto_de_venta['precio_venta']; ?></td>
                        <td><?php echo $producto_de_venta['total_por_producto']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="../controllers/ventas_controller.php">Regresar</a>
    <?php
    } ?>
</body>

</html>