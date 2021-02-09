<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta Finalizada</title>
</head>
<body>
    <?php
        if (!isset($_SESSION['usuario_id'])) {
            echo "no estas logueado";
        }else {?>
            <h1>Tu venta ha sido Concluida :D</h1>
            <a href="../controllers/crear_ticket_controller.php">Crear Ticket en PDF</a>
    <?php        
        }
    ?>
    
    
</body>
</html>