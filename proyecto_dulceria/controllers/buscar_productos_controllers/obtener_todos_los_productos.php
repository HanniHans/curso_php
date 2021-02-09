<?php
session_start();
echo "hola";
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');
if (!isset($_SESSION['usuario_id'])) {
    echo "no has iniciado sesion";
}else{
    require_once root.'models/productos_model.php';
    $todos_los_productos = get_all_productos();
    // print_r($todos_los_productos);
    if (empty($todos_los_productos)) {
        echo "no hay productos :c";
    }else {
        unset($_SESSION['productos_buscados']);
        $_SESSION['productos_buscados']=$todos_los_productos;
        header("Location: ../buscar_productos_controller.php");
    }

}
