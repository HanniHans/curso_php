<?php
session_start();

define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');
if (!isset($_SESSION['usuario_id'])) {
    echo "no estas logueado";
}else {
    if(!isset($_POST['granel'])){
        echo "la variable no esta seteada";
    }else {
        if (empty($_POST['granel'])) {
            echo "no ingresaste ninguna cantidad :c <br>";
        }else {
            if (!isset($_SESSION['producto_granel'])) {
                echo "no esta seteada la variable <br>";
            }else {
                if (!isset($_SESSION['carrito'])) {
                    $_SESSION['carrito']=array();
                }
                $cantidad=$_POST['granel'];
                $_SESSION['producto_granel']['cantidad']=$cantidad;
                $_SESSION['carrito'][]=$_SESSION['producto_granel'];
                unset($_SESSION['producto_granel']);
                
                require_once root.'models/productos_model.php';
                //$recargar_lista_de_productos = reset_lista_de_productos_de_muestra();
                $_SESSION['carrito_de_muestra'] = get_productos_and_total_por_producto_venta();
                $_SESSION['total']= get_suma_de_total_por_producto_venta($_SESSION['carrito_de_muestra']);
                header("Location: ../index.php");
            }      
        }
    }
}