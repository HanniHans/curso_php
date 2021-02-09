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
        //session_start();
            if (isset($_SESSION['carrito']) ) {
    ?>
                <!-- <table>
                    <thead>
                    <tr>
                        <th>Codigo de barras</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <?php
                        foreach ($_SESSION['carrito'] as $productos) {
                            
                    ?>
                        <tr>
                        <td><?php echo $productos['codigo_de_barras'];?></td>
                        <td><?php echo $productos['producto'];?></td>
                        <td>$<?php echo $productos['precio_menudeo'];?></td>
                        <td><?php echo $productos['cantidad'];?></td>
                        </tr>
                    <?php
                        }
                    ?>
                    
                    <tbody>
                    </tbody>
                </table> -->
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
                    <?php
                        foreach ($_SESSION['lista_de_muestra'] as $values) {
                    ?>
                            <tr>
                                <td><?php echo $values['codigo_de_barras'];?> </td>
                                <td><?php echo $values['producto'];?></td>
                                <td>$<?php echo $values['precio_menudeo'];?></td>
                                <td>$<?php echo $values['precio_mayoreo'];?></td>
                                <td><?php echo $values['ref']?></td>
                                <td><?php echo $values['unidad_de_medida'];?></td>
                                <td><?php echo $values['cantidad'];?></td>
                                <td><?php echo $values['total'];?></td>
                                <td><?php echo $values['descuento'];?></td>
                            </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>

                <h2>Total de Venta: $<?php echo $_SESSION['total_venta'];?></h2>
        <?php } ?>
    
</body>
</html>