<?php
echo "detalles de la venta";
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
        $detalles_venta=get_productos_de_la_venta_by_venta_id($venta_id);
        print_r($detalles_venta);
        if (empty($detalles_venta)) {
            echo "no hay detalles";
        }
    }
}