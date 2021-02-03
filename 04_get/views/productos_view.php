<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <th>nombre</th>
            <th>precio</th>

    </thead>
    <tbody>
        <?php foreach($productos as $producto):?>
        <tr>
            <td>
                <!--
                    href= es una refencia que cuando le hago click me a va decir a donde ir
                    Query String empieza a partir del question mark 
                    key value
                    llaver y valor y van separados por un igual
                    &&

                -->
                
                <a href="producto.php?codigo=<?php echo $producto['id'];?>">
                <?php echo $producto['nombre'];?>
                </a>
            </td>
            <td><?php echo $producto['precio'];?></td>
        </tr>
        <?php endforeach?>
    </tbody>
    </table>
</body>
</html>