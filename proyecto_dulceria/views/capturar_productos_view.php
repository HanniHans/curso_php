<?php //ssession_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capturar Productos</title>
</head>

<body>
    <nav>
        <?php if (isset($_SESSION['usuario_id'])) { ?>
            <a href="./index.php">Capturar Productos</a> |
            <a href="./controllers/buscar_productos_controller.php">Buscar Productos</a> |
            <a href="./controllers/ventas_controller.php">Ventas</a> |
            <a href="./controllers/logout_controller.php">Cerrar Sesión</a>
        <?php } ?>
    </nav>


    <!-- Codigo bonito -->
    <?php
    if (!isset($_SESSION['usuario_id'])) {
        echo "no Estas logueado";
    } else { ?>
        <h1>Captura de Productos</h1>
        <form action="./controllers/productos_capturados_controller.php" method="post">
            <label for="codigo_de_barras">Código de barras</label>
            <input type="text" name="codigo_de_barras">
            <button>Agregar</button>
        </form>

        <?php
        if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
            echo "Todavia no haz agregado nigún producto";
        } else { ?>
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
                        <td><?php echo $productos['codigo_de_barras']; ?></td>
                        <td><?php echo $productos['producto']; ?></td>
                        <td>$<?php echo $productos['precio_menudeo']; ?></td>
                        <td><?php echo $productos['cantidad']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    
                    <tbody>
                    </tbody>
                </table> -->
            <!-- <table>
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
                            
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($_SESSION['lista_de_muestra'] as $values) {
                    ?>
                            <tr>
                                <td><?php echo $values['codigo_de_barras']; ?> </td>
                                <td><?php echo $values['producto']; ?></td>
                                <td>$<?php echo $values['precio_menudeo']; ?></td>
                                <td>$<?php echo $values['precio_mayoreo']; ?></td>
                                <td><?php echo $values['ref'] ?></td>
                                <td><?php echo $values['unidad_de_medida']; ?></td>
                                <td><?php echo $values['cantidad']; ?></td>
                                <td><?php echo $values['total']; ?></td>
                                <td><?php echo $values['descuento']; ?></td>
                                
                                <td>
                                    <a href="./controllers/eliminar_producto_venta.php?codigo=<?php echo $values['codigo_de_barras']; ?>">Elimninar</a>
                                </td>
                            </tr>
                    <?php
                    }
                    ?>
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
                        <th>Cantidad Mayoreo</th>
                        <th>Unidad de Medida</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Descuento</th>

                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['carrito_de_muestra'] as $product) { ?>
                        <tr>
                            <td><?php echo $product['codigo_de_barras']; ?> </td>
                            <td><?php echo $product['producto']; ?></td>
                            <td>$<?php echo $product['precio_menudeo']; ?></td>
                            <td>$<?php echo $product['precio_mayoreo']; ?></td>
                            <td><?php echo $product['referencia_por_unidad'] ?></td>
                            <td><?php echo $product['cantidad_mayoreo'] ?></td>
                            <td><?php echo $product['unidad_de_medida']; ?></td>
                            <td><?php echo $product['cantidad']; ?></td>
                            <td><?php echo $product['total']; ?></td>
                            <td><?php echo $product['descuento']; ?></td>
                            <td><a href="./controllers/eliminar_producto_venta.php?codigo=<?php echo $product['codigo_de_barras']; ?>">Elimninar</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <h2>Total de Venta: $<?php echo $_SESSION['total']; ?></h2>
            <button type="submit">
                <a href="./controllers/finalizar_venta_controller.php">Finalizar venta</a>
            </button>
            <button type="submit">
                <a href="./controllers/cancelar_venta_controller.php">Cancelar venta</a>
            </button>

    <?php
        }
    }
    ?>
</body>

</html>