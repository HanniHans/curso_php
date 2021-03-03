<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
</head>

<body>
    <h1>Ticket</h1>
    <?php
    if (!isset($_SESSION['usuario_id'])) {
        echo "No haz iniciado Sesión";
    } else {
        if (!isset($_SESSION['ticket']) || empty($_SESSION['ticket'])) {
            echo '<h1>Hubo un problema al crear el ticket</h1>';
        } else { ?>
            <h2> <?php echo $configuracion['nombre_tienda']?></h2>
            <h4>Número Telefonico: <?php echo $configuracion['telefono']?></h4>
            
            <table>
                <thead>
                    <tr>
                        <th>Codigo de barras</th>
                        <th>Producto</th>
                        <th>Precio menudeo</th>
                        <th>Precio mayoreo</th>
                        <th>Cantidad Referencia</th>
                        <th>Unidad de Medida</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Descuento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['ticket'] as $value) { ?>
                        <tr>
                            <td><?php echo $value['codigo_de_barras']; ?> </td>
                            <td><?php echo $value['producto']; ?></td>
                            <td>$<?php echo $value['precio_menudeo']; ?></td>
                            <td>$<?php echo $value['precio_mayoreo']; ?></td>>
                            <td><?php echo $value['referencia_por_unidad']; ?></td>
                            <td><?php echo $value['unidad_de_medida']; ?></td>
                            <td><?php echo $value['cantidad']; ?></td>
                            <td><?php echo $value['total']; ?></td>
                            <td><?php echo $value['descuento']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <h2>Total de Venta: $<?php echo $_SESSION['total']; ?></h2>
    <?php
        }
    }
    ?>

</body>

</html>