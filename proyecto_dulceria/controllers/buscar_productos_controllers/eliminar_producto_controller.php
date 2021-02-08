<?php
session_start();

// echo $_GET['venta_id'];
// echo $_SESSION['usuario_id'];
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');

if (!isset($_SESSION['usuario_id'])) {
    echo "no haz iniciado sesion";
}else {
    if(!isset($_GET['producto_id']) || empty($_GET['producto_id'])){
        echo "no se recibio la venta que deseas eliminar :c";
    }else {
        $producto_id = $_GET['producto_id'];
        require_once root.'models/productos_model.php';
        date_default_timezone_set('America/Mexico_City');
        $fecha_y_hora = date("y-m-d H:i:s");
        $eliminar_producto = eliminar_productos_by_id($fecha_y_hora,$producto_id);
        if ($eliminar_producto == FALSE) {
            echo "hubo un error al eliminar el producto";
        }else {
            echo "el producto se ha eliminado";
        }

    }
}