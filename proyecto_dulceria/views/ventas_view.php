<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
</head>
<body>
    <nav>
        <?php
            if (isset($_SESSION['usuario_id'])) {
        ?>
            <a href="../index.php">Capturar Productos</a> |
            <a href="../controllers/buscar_productos_controller.php">Buscar Productos</a> |
            <a href="../controllers/ventas_controller.php">Ventas</a> |
            <a href="../controllers/logout_controller.php">Cerrar Sesión</a> 
        <?php
            }
        ?>
    </nav>

    <?php
        if (!isset($_SESSION['usuario_id'])) {
            echo "no estas logueado";
        }else{
    ?>
            <h1>Ventas</h1>
            <form action="../controllers/buscar_venta_por_fecha_controller.php" method="post">
                <label for="fecha_venta">Buscar por fecha</label>
                <input type="date" name="fecha_venta">
                <button type="submit">Buscar</button>
            </form>
    <?php
            if (!isset($_SESSION['ventas']) || empty($_SESSION['ventas']) ) {
                echo "no has buscando ventas";
            }else{
    ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha y hora</th>
                            <th>Nombre de Vendedor</th>
                            <th>Total</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            foreach ($_SESSION['ventas'] as $venta) {
                        ?>
                                <tr>
                                    <td><?php echo $venta['id'];?></td>
                                    <td><?php echo $venta['created_at'];?></td>
                                    <td><?php echo $venta['vendedor'];?></td>
                                    <?php
                                        if($venta['total_venta']==NULL){
                                    ?>
                                            <td>0</td>
                                    <?php
                                        }else {
                                    ?>
                                            <td><?php echo $venta['total_venta'];?></td>
                                    <?php
                                        }
                                    ?>
                                    <td><a href="../controllers/eliminar_venta_controller.php?venta_id=<?php echo $venta['id'];?>">Eliminar<?php?></a></td>
                                </tr>
                        <?php
                            }
                        ?>
                    
                    </tbody>
                
                </table>
    <?php                                
            }
        }
    
    ?>
     
    
</body>
</html>