<?php
session_start();

define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');
if (!isset($_SESSION['usuario_id'])) {
    echo "no estas logueado";
}else {
    if (!isset($_GET['venta_id'])) {
        echo "no se recibio el producto";
    }else {
        $venta_id = $_GET['venta_id'];
        require_once root.'models/productos_de_venta_model.php';
        $productos_de_venta=get_productos_de_la_venta_by_venta_id($venta_id);
        
        if (empty($productos_de_venta)) {
            echo "no hay productos <br>";
            echo '<a href="../controllers/ventas_controller.php">Regresar</a>';
        }else {
            //print_r($productos_de_venta);
            require_once root.'views/detalles_venta_view.php';
        }
    }
}