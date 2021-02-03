<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Reseña</title>
</head>
<body>
    <nav>
        <ul> 
            <li> <a href="../index.php">Inicio</a></li>
            <?php if(isset($_SESSION['usuario_id'])){?>
            <li>Bienvenido</li>
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

    <h1>Reseña de <?php echo $producto['producto_nombre']; ?></h1>
    <h2><?php echo $producto['producto_nombre'];?></h2>
    <img src="../imagenes/<?php echo $producto['id'];?>.jpg" alt="producto_<?php echo $producto['producto_nombre'];?>" width="100px">
    
      
    <?php
    if(empty($resena_por_usuario)){
        // echo "todavía no hay reseña";
    ?>
        <h3>Agrega tu reseña</h3>
        <form action="./add_resena_controller.php" method="GET">
            <label for="calificacion">Calificación: </label>
            <select name="calificacion">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <br>
            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" id="">
            <br>
            <label for="resena">Reseña:</label>
            <input type="text" name="resena" id="">
            <br>
            <input type="hidden" name="producto_id" value="<?php echo $producto['id'];?>">
            <br>
            <button type="submit"> Enviar </button>

        </form>
    <?php
    }else {
        ?>
        <h3>Modifica tu reseña :)</h3>
        <form action="./add_resena_controller.php" method="GET">
        <label for="calificacion_actual"><b>Calificación Actual:</b> <?php echo $resena_por_usuario['calificacion']?></label>
        <br>
        <label for="calificacion"><b>Calificación:</b> </label>
        <select name="calificacion">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <br>
        <label for="titulo"><b>Titulo</b></label>
        <input type="text" name="titulo" value="<?php echo $resena_por_usuario['titulo']?>">
        <br>
        <label for="resena"><b>Reseña:</b></label>
        <input type="text" name="resena" value="<?php echo $resena_por_usuario['resena']?>">
        <br>
        <input type="hidden" name="producto_id" value="<?php echo $producto['id'];?>">
        <br>
        <button type="submit"> Enviar </button>

    </form>

    <?php    
    }
    ?>
</body>
</html>