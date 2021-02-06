<?php
session_start();

define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');
if (!isset($_SESSION['usuario_id'])) {
    echo "no estas logueado";
}else {
    if (!isset($_POST['categoria'])) {
        echo "no esta seteada la varibale categoria";
    }else {
        $categoria = $_POST['categoria'];
        require_once root.'models/productos_model.php';
        $productos_por_categoria = get_productos_by_categoria($categoria);
        print_r($productos_por_categoria);
        $_SESSION['productos_buscados'] = $productos_por_categoria;
        echo "<br><br>";
        print_r($_SESSION['productos_buscados']);
        header("Location: ../controllers/buscar_productos_controller.php");
    }
}
