<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title><?php echo $producto['producto_nombre'];?></title>
</head>
<body>

    <nav>
        <ul> 
            <li> <a href="./index.php">Inicio</a></li>
            <?php if(isset($_SESSION['usuario_id'])){?>
            <li>Bienvenido</li>
            <li>
                <button>
                <a href="../controller/logout_controller.php">Cerrar Sesion</a>
                </button>
            </li>
            <?php }else{?>
            <li> <a href="../views/login_view.php">Login</a></li>
            <?php } ?>
        </ul>
    </nav>

    <h1><?php echo $producto['producto_nombre'];?></h1>
    <img src="../imagenes/<?php echo $producto['id'];?>.jpg" alt="producto_<?php echo $producto['producto_nombre'];?>" width="300px">
    <p><b>Precio: </b>$<?php echo $producto['precio'];?></p> 
    <p><b>codigo </b><?php echo $producto['codigo'];?></p> 
    <!--Agregar la cantidad de estrellas y reseñas--->

    <br>
    <h3>Reseñas</h3>
    <?php
        if(isset($_SESSION['usuario_id'])){
            if (empty($resena_por_usuario)) { ?>
                
                <button type="submit">
                    <a href="../controller/resena_controller.php?codigo=<?php echo $producto['id'];?>"> <?php echo $mensaje; ?> </a>
                </button>

    <?php   }else { ?>
                <button type="submit">
                    <a href="../controller/resena_controller.php?codigo=<?php echo $producto['id'];?>"><?php echo $mensaje_modificar; ?></a>
                </button>            
    <?php        
            }
        }
        
    ?>

    <?php
        
        if(empty($resenas_del_producto)){ ?>
        <h3><?php echo $empty_resena; ?></h3>
            
    <?php
        }else{?>
            <h3>Promedio de calificación: <?php echo number_format($avg_resenas,1,'.',',')?></h3>
            <br>
            
    <?php   foreach($resenas_del_producto as $resena_del_producto){ ?>
                <div>
                    <p><b>Nombre usuario: </b><?php echo $resena_del_producto['nombre']; ?></p>
                    <p><b>Calificación: </b><?php echo $resena_del_producto['calificacion']; ?></p>
                    <p><b>Fecha: </b><?php echo $resena_del_producto['fecha_resena']; ?></p>
                    <p><b>Reseña: </b><?php echo $resena_del_producto['resena']; ?></p>
                </div>
                <br>
    <?php
            }
        }
    ?>
    
</body>
</html>