<?php
session_start();
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');

if (!isset($_SESSION['administrador'])) {
    echo "No estas logueado";
}else {
    if (!isset($_GET['producto_id'])) {
        echo "no esta seteada la variables";
    }else {
        $producto_id = $_GET['producto_id'];
        require_once root.'models/productos_model.php';
        $producto_by_id = get_producto_by_id($producto_id);
        if (empty($producto_by_id)) {
            echo "El producto que quieres modificar no existe";
        }else {
            $producto_id = $_GET['producto_id'];
            require_once root.'models/categoria_model.php';
            $todas_las_categorias = get_all_categorias();
            require_once root.'models/marcas_model.php';
            $todas_las_marcas = get_all_marcas();
            require_once root.'models/tipos_de_venta_model.php';
            $todas_los_tipos_venta = get_all_tipos_venta();
            require_once root.'models/unidades_de_medida_model.php';
            $todas_las_unidades_de_medida = get_all_unidades_de_medidad();
            require_once root.'views/modificar_producto_view.php';
        }
        

        
    }
    
}