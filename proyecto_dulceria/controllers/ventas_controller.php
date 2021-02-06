<?php
session_start();

define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');
if (!isset($_SESSION['usuario_id'])) {
    echo "no has iniciado sesion";
}else {
    require_once root.'models/ventas_model.php';
    $todas_las_ventas = get_all_ventas();
    if (empty($todas_las_ventas)) {
        echo "no hay ventas todavia...";
    }else {
        $get_last_5_ventas = get_last_5_ventas();
        if (!empty($get_last_5_ventas)) {
            $_SESSION['ventas']=$get_last_5_ventas;
            //print_r($_SESSION['ventas']);
            require_once root.'views/ventas_view.php';
        }
    }
    
    
    
    
}