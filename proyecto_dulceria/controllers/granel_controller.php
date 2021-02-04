<?php
session_start();
$cantidad=$_POST['granel'];
echo $cantidad;
if(!isset($cantidad)){
    echo "la variable no esta seteada";
}else {
    if (empty($cantidad)) {
        echo "no ingresaste ninguna cantidad :c";
        
    }else {
        //print_r($_SESSION['carrito']);
        // $_SESSION['productos_granel']['cantidad']=$cantidad;
        // echo "<br><br>";
        // print_r($_SESSION['productos_granel']);
        // // if (!isset($_SESSION['carrito'])) {
        // //     $_SESSION['carrito']=array();
        // // }
        // echo "<br><br>";
        // print_r($_SESSION['carrito']);
        // // array_push(end($_SESSION['carrito']), "cantidad");
        
        // array_push($_SESSION['carrito'],$_SESSION['productos_granel']);
        // unset($_SESSION['productos_granel']);
        // echo "<br><br>";
        // print_r($_SESSION['carrito']);
        if (!isset($_SESSION['productos_granel'])) {
            echo "no esta seteada la variable";
        }else {
            $_SESSION['productos_granel']['cantidad']=$cantidad;
            echo "<br><br>";
            print_r($_SESSION['productos_granel']);
            
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito']=array();
            }
            echo "<br><br>";
            print_r($_SESSION['carrito']);
            // array_push($_SESSION['carrito'],$_SESSION['productos_granel']);
            $_SESSION['carrito'][]=$_SESSION['productos_granel'];
            echo "<br><br>";
            print_r($_SESSION['carrito']);
            unset($_SESSION['productos_granel']);
            echo "<br><br>";
            print_r($_SESSION['productos_granel']);
        }
        
    }
}