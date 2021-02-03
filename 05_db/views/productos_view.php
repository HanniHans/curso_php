<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Productos</title>
</head>
<body>

    <nav>
        <ul> 
            <li> <a href="./index.php">Inicio</a></li>

            <?php if(isset($_SESSION['usuario_id'])){?>
            <li>Hola <?php echo $usuario['nombre'];?></li>
            <li>
                <button>
                <a href="./controller/logout_controller.php">Cerrar Sesion</a>
                </button>
            </li>
            <?php }else{?>
            <li> <a href="./views/login_view.php">Login</a></li>
            <?php } ?>
        </ul>
    </nav>


    <table>
        <thead>
            <th>Producto</th>
            <th>Precio</th>
            <th>Estrellas</th>
        </thead>
        <?php foreach($productos as $producto):?>
            <tr>
                <td>
                    <a href="./controller/producto_controller.php?codigo=<?php echo $producto['id'];?>">
                        <?php echo $producto['producto_nombre']; ?>
                    </a>
                </td>
                <td><?php echo $producto['precio']; ?></td>
                <?php if($producto['promedio']==null):?>
                    <td><?php echo "0";?></td>
                <?php else: ?>
                    <td><?php echo number_format($producto['promedio'],1,'.',','); ?></td>
            </tr>
        <?php 
                    endif;
            endforeach?>
        
    </table>
</body>
</html>