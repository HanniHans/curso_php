<?php
session_start();
$cantidad=$_POST['granel'];
echo $cantidad;
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');
if(!isset($cantidad)){
    echo "la variable no esta seteada";
}else {
    if (empty($cantidad)) {
        echo "no ingresaste ninguna cantidad :c";
        
    }else {
        if (!isset($_SESSION['productos_granel'])) {
            echo "no esta seteada la variable";
        }else {
            $_SESSION['productos_granel']['cantidad']=$cantidad;
            //print_r($_SESSION['productos_granel']);
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito']=array();
            }
            //print_r($_SESSION['carrito']);
            $_SESSION['carrito'][]=$_SESSION['productos_granel'];
            unset($_SESSION['productos_granel']);

            $codigos_barras_muestra = array_values(array_unique(array_column($_SESSION['carrito'], 'codigo_de_barras')));
            //print_r($codigos_barras_muestra);
            $productos_muestra = array_values(array_unique(array_column($_SESSION['carrito'],'producto')));
            //print_r($productos_muestra);
            $precio_menudeo_muestra = array_values(array_unique(array_column($_SESSION['carrito'],'precio_menudeo')));
            //print_r($precio_menudeo_muestra);
            $unidad_muestra = array_values(array_unique(array_column($_SESSION['carrito'],'unidad_de_medida')));
            
            
            if (!isset($_SESSION['pivote'])) {
                # code...
                $_SESSION['pivote']=array();
            }
            
            $_SESSION['total_venta']=0;
            $total_venta = array();
            require_once root.'models/productos_model.php';
            for ($i=0; $i < count($productos_muestra); $i++) { 
                $cantidad_por_producto = get_suma_cantidad_de_producto_by_codigo_de_barras($codigos_barras_muestra[$i]);
                $_SESSION['pivote'][$i]['codigo_de_barras']=$codigos_barras_muestra[$i];
                $_SESSION['pivote'][$i]['producto']=$productos_muestra[$i];
                //$_SESSION['pivote'][$i]['unidad_de_medida']=$unidad_muestra[$i];
                $_SESSION['pivote'][$i]['cantidad']=$cantidad_por_producto;
                $_SESSION['pivote'][$i]['precio_menudeo']=$precio_menudeo_muestra[$i];
                $_SESSION['pivote'][$i]['total']=$cantidad_por_producto*$precio_menudeo_muestra[$i]; 
                $total_venta[]= $cantidad_por_producto*$precio_menudeo_muestra[$i];
            }
            //print_r($_SESSION['pivote']);
            $_SESSION['total_venta']= array_sum($total_venta);
            echo "<br> Total: ";
            print_r($_SESSION['total_venta']);
            header("Location: ../index.php");
        }      
    }
}