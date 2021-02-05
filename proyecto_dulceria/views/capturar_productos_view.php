<?php //ssession_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
        <?php
            if (isset($_SESSION['usuario_id'])) {
                # code...
        ?>
            <a href="./controllers/logout_controller.php">Cerrar Sesión</a> |
            <a href="./index.php">Capturar Productos</a>
        <?php
            }else {
        ?>
            <a href="">No </a>
        <?php
            }
        ?>
    </nav>

    <?php
        if (isset($_SESSION['usuario_id'])) {
    ?>

            <form action="./controllers/productos_capturados_controller.php" method="post">
                <label for="codigo_de_barras">Código de barras</label>
                <input type="text" name="codigo_de_barras" id="">
                <button>Agregar</button>
            </form>
    <?php
            if (isset($_SESSION['carrito'])) {
                //print_r($_SESSION['carrito']);
    ?>
                <table>
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
                </table>


                <table>
                    <thead>
                    <tr>
                        <th>Codigo de barras</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <!-- <th>Unidad de Medida</th> -->
                        <th>Total</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <?php
                        foreach ($_SESSION['pivote'] as $values) {
                    ?>
                        <tr>
                        <td><?php echo $values['codigo_de_barras'];?></td>
                        <td><?php echo $values['producto'];?></td>
                        <td>$<?php echo $values['precio_menudeo'];?></td>
                        <td><?php echo $values['cantidad'];?></td>
                        
                        <td><?php echo $values['total'];?></td>
                        <td>
                            <a href="./controllers/eliminar_producto_venta.php?codigo=<?php echo $values['codigo_de_barras'];?>">Elimninar</a>
                        </td>
                        </tr>
                    <?php
                        }
                    ?>
                    
                    <tbody>
                    </tbody>
                </table>

                <h2>Total de Venta: $<?php echo $_SESSION['total_venta'];?></h2>

    <?php
            //print_r($_SESSION['pivote']);
            }else {
                echo "Todavia no haz agregado ningún producto";
            }
    
    ?>





    <?php        
        }else {
            echo "no estas conectado";
        }
    
    ?>

    


    
</body>
</html>