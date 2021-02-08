<?php
session_start();
echo "hola";
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');
if (!isset($_SESSION['usuario_id'])) {
    echo "no has iniciado sesion";
}else{
    require_once root.'models/productos_model.php';
    $todos_los_productos_eliminados = get_all_productos_eliminados();
    print_r($todos_los_productos_eliminados);
    if (empty($todos_los_productos_eliminados)) {
        echo "no hay productos :c";
    }else {
        $_SESSION['productos_buscados']=$todos_los_productos_eliminados;
        header("Location: ../buscar_productos_controller.php");
    }

}