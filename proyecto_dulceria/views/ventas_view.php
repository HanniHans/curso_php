<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
</head>
<body>

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
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            foreach ($_SESSION['ventas'] as $venta) {
                        ?>
                                <tr>
                                    <td><?php echo $venta['venta_id'];?></td>
                                    <td><?php echo $venta['created_at'];?></td>
                                    <td><?php echo $venta['vendedor'];?></td>
                                    <td><?php echo $venta['total_venta'];?></td>
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