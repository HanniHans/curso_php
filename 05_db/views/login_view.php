<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Login</title>
</head>
<body>
    <nav>
        <ul> 
            <li> <a href="../index.php">Inicio</a></li>

            <?php if(isset($_SESSION['usuario_id'])){?>
            <li>Bienvenido</li>
            <li>
                <button>
                <a href="../controller/logout_controller.php">Cerrar Sesion</a>
                </button>
            </li>
            <?php }else{?>
            <li> <a href="./login_view.php">Login</a></li>
            <?php } ?>
        </ul>
    </nav>

    
<?php 
    if(isset($_SESSION['usuario_id'])){?>    
        <h3>Ya iniciaste Sesion</h3> 
<?php 
    }else{?>
        <form action="../controller/login_controller.php" method="post">
            <label for="email">Correo:</label>
            <input type="email" name="email" id="">
            <br>
            <label for="password">Contraseña: </label>
            <input type="password" name="password" id="">
            <br>
            <button type="submit">Enviar</button>
        </form>
<?php 
    } ?>
    
</body>
</html>