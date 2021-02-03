<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto['nombre'];?></title>
</head>
<body>
    <h1><?php echo $producto['nombre'];?></h1>
    <img src="./imagenes/<?php echo $producto['id'];?>.jpg" alt="producto_<?php echo $producto['nombre'];?>" width="300px">
    <p><?php echo $producto['descripcion'];?></p>
    <p><b>Precio: </b>$<?php echo $producto['precio'];?></p>     

    <br>
    <h3>Reseñas</h3>

    <?php
        
        if(empty($resenas_del_producto)){ ?>
        <h3><?php echo $empty_resena; ?></h3>
            
    <?php
        }else{?>
            <h3>Promedio de calificación: <?php echo $avg_resenas; ?></h3>
            <br>
            
    <?php   foreach($resenas_del_producto as $resena_del_producto){ ?>
                <div>
                    <p><b>Calificación: </b><?php echo $resena_del_producto['calificacion']; ?></p>
                    <p><b>Fecha: </b><?php echo $resena_del_producto['fecha']; ?></p>
                    <p><b>Reseña: </b><?php echo $resena_del_producto['resena']; ?></p>
                </div>
                <br>
                
                
                
    <?php
            }
        }
    ?>

    
    

    <?php 
        // echo $avg_resena;
        // foreach($res as $resena):
        //     if($resena['producto_id']===$producto['id']):
    ?>
    <!-- <div>
        <p><b>Fecha: </b><?php //echo $resena['fecha'];?></p>
        <p><b>Calificacion: </b><?php //echo $resena['calificacion'];?></p>   
        <p><b>Reseña: </b><?php //echo $resena['resena'];?></p>
        
    </div> -->
    <br>
    
    <?php
        //     endif;
        // endforeach
        ?>



    

    
</body>
</html>