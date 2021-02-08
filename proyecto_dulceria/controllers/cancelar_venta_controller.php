<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    echo "No haz iniciado sesion";
}else {
    unset($_SESSION['carrito']);
    echo '<h1>Se ha cancelado la compra</h1>';
    echo '<a href="../index.php">Regresar</a>';
}