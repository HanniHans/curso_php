<?php //session_start();?>
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
            <a href="./index.php">Capturar Productos</a>
            <a href="./controllers/logout_controller.php">Cerrar Sesión</a> |
            
        <?php
            }
        ?>
    </nav>

    <?php
        if(isset($_SESSION['usuario_id'])){
    ?>      
            <h2>Ya estas logueado :D</h2>       
    <?php
        }else {
    ?>
            <form action="./controllers/login_controller.php" method="post">
            <label for="email">Correo:</label>
            <input type="text" name="email">
            <br>
            <label for="password">Contraseña: </label>
            <input type="password" name="password">
            <br>
            <button type="submit">Enviar</button>
            </form>
        
    <?php
        }

    ?>
    

</body>
</html>