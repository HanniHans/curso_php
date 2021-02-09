<?php
session_start();

define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');
if(!isset($_SESSION['usuario_id'])){
    echo "no haz iniciado sesión";
}else {
    if (!isset($_POST['codigo_de_barras']) || empty($_POST['codigo_de_barras'])) {
        echo "no se recibio el codigo de barras";
    }else {
        $codigo_de_barras= $_POST['codigo_de_barras'];
        require_once root.'models/productos_model.php';
        $productos_por_codigo_de_barras = get_producto_by_codigo_de_barras($codigo_de_barras);
        if (empty($productos_por_codigo_de_barras)) {
            echo "no se encontro el producto";
        }else {
            unset($_SESSION['productos_buscados']);
            $_SESSION['productos_buscados'][] = $productos_por_codigo_de_barras;
            header("Location: ../buscar_productos_controller.php");
            
        }
    }

}