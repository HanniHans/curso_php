<?php
session_start();

define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');
if(!isset($_POST['granel'])){
    echo "la variable no esta seteada";
}else {
    if (empty($_POST['granel'])) {
        echo "no ingresaste ninguna cantidad :c";
        
    }else {
        if (!isset($_SESSION['producto_granel'])) {
            echo "no esta seteada la variable";
        }else {
            print_r($_SESSION['producto_granel']);
            $cantidad=$_POST['granel'];

            $_SESSION['producto_granel']['cantidad']=$cantidad;
            //print_r($_SESSION['producto_granel']);
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito']=array();
            }
            //print_r($_SESSION['carrito']);
            $_SESSION['carrito'][]=$_SESSION['producto_granel'];
            unset($_SESSION['producto_granel']);
            require_once root.'models/productos_model.php';
            $recargar_lista_de_productos = reset_lista_de_productos_de_muestra();
            header("Location: ../index.php");
        }      
    }
}