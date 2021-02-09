<?php
session_start();
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');

if (!isset($_SESSION['administrador'])) {
    echo "No eres administrador";
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
            echo '<h1>El Producto se ha eliminado</h1>';
        }

    }
}