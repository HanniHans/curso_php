<?php
session_start();

define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');
if (!isset($_SESSION['usuario_id'])) {
    echo "no estas logueado";
}else {
    if (!isset($_POST['categoria']) || empty($_POST['categoria'])) {
        echo "no esta seteada la varibale categoria";
    }else {
        $categoria = $_POST['categoria'];
        require_once root.'models/categoria_model.php';
        $categoria_id = get_categoria_by_id($categoria);
        if (empty($categoria_id)) {
            echo "no existe la categoria";
        }else {
            require_once root.'models/productos_model.php';
            $productos_por_categoria = get_productos_by_categoria($categoria);
            if (!empty($productos_por_categoria)){
                unset($_SESSION['productos_buscados']);
                $_SESSION['productos_buscados'] = $productos_por_categoria;
            }else {
                unset($_SESSION['productos_buscados']);
            }
            header("Location: ../buscar_productos_controller.php");
        }


    }
}
