<?php
session_start();
//print_r($_SESSION['administrador']);
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');


if (!isset($_SESSION['usuario_id'])) {
    echo "no estas logueado";
}else {
    require_once root.'models/categoria_model.php';
    $todas_las_categorias = get_all_categorias();
    if (empty($todas_las_categorias)) {
        echo "no hay categorias";
    }else {
        require_once root.'views/buscar_productos_view.php';

    }
    
}



