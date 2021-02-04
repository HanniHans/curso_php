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
            <a href="../controllers/logout_controller.php">Cerrar Sesión</a> |
            <a href="../controllers/capturar_productos_controller.php">Capturar Productos</a>
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
            print_r($_SESSION['carrito']);
    ?>

            <form action="../controllers/productos_capturados_controller.php" method="post">
                <label for="codigo_de_barras">Código de barras</label>
                <input type="text" name="codigo_de_barras" id="">
                <button>Agregar</button>
            </form>

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
                    $contar=array();
                    $suma = 0;

                    // print_r(array_column($_SESSION['carrito'], 'producto'));
                    // $prueba = array_column($_SESSION['carrito'], 'codigo_de_barras');
                    // echo "<br>";
                    // print_r(array_count_values($prueba));
                    //print_r(array_unique($_SESSION['carrito']));
                    foreach ($_SESSION['carrito'] as $productos) {
                        //print_r(count($productos['producto']));
                        //print_r(array_column($productos, 'producto'));
                        //echo count($productos['codigo_de_barras']);
                        
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
                    <th>Total</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <?php
                    //print_r($_SESSION['pivote']);
                    foreach ($_SESSION['pivote'] as $values) {
                        //print_r(count($productos['producto']));
                        //print_r(array_column($productos, 'producto'));
                        //echo count($productos['codigo_de_barras']);
                ?>
                    <tr>
                    <td><?php echo $values['codigo_debarras'];?></td>
                    <td><?php echo $values['producto'];?></td>
                    <td>$<?php echo $values['precio_menudeo'];?></td>
                    <td><?php echo $values['cantidad'];?></td>
                    <td><?php echo $values['total'];?></td>
                    </tr>
                <?php
                    }
                ?>
                
                <tbody>
                </tbody>
            </table>





    <?php        
        }else {
            echo "no estas conectado";
        }
    
    ?>

    


    
</body>
</html>