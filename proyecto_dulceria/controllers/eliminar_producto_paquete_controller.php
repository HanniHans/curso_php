<?php 
session_start();

define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');
echo $_SESSION['productos_paquete'];
echo "<br>";
$codigo_de_barras = $_SESSION['productos_paquete'];
echo $codigo_de_barras;
echo "<br>";


$cantidad_eliminados=$_POST['cantidad_de_prodcutos_eliminados'];
echo $cantidad_eliminados;
echo "<br>";


require_once root.'models/productos_model.php';
$llaves_de_producto_por_codigo = get_keys_productos_by_codigo($codigo_de_barras);
echo "<br>cantidad_total: ";
//print_r($llaves_de_producto_por_codigo);
echo "<br>".count($llaves_de_producto_por_codigo);
$cantidad_total = count($llaves_de_producto_por_codigo);

if ($cantidad_eliminados>$cantidad_total) {
    echo "la cantidad es mayor a la que tenias :c";
}else {
    
    if ($cantidad_total==$cantidad_eliminados) {
        echo "eliminar todo";
        for ($i=0; $i <count($llaves_de_producto_por_codigo); $i++) { 
            echo "<br>";
            echo $llaves_de_producto_por_codigo[$i];
            unset($_SESSION['carrito'][$llaves_de_producto_por_codigo[$i]]);
        }
    }else {
        echo "se van a eliminar ".$cantidad_eliminados. " productos";
        for ($i=0; $i < intval($cantidad_eliminados); $i++) { 
            echo "<br>";
            echo $llaves_de_producto_por_codigo[$i];
            unset($_SESSION['carrito'][$llaves_de_producto_por_codigo[$i]]);
        }

    }
}


$codigos_barras_muestra = array_values(array_unique(array_column($_SESSION['carrito'], 'codigo_de_barras')));
                        //print_r($codigos_barras_muestra);
$productos_muestra = array_values(array_unique(array_column($_SESSION['carrito'],'producto')));
//print_r($productos_muestra);
$precio_menudeo_muestra = array_values(array_unique(array_column($_SESSION['carrito'],'precio_menudeo')));
//$unidad_muestra = array_values(array_unique(array_column($_SESSION['carrito'],'unidad_de_medida')));
//print_r($precio_menudeo_muestra);
$_SESSION['pivote']=array();
// echo "<br>";
// echo "<br>".count($productos_muestra);
$_SESSION['total_venta']=0;

$total_venta = array();

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
// echo "<br>Total de la venta: ";
// print_r($total_venta);
$_SESSION['total_venta']= array_sum($total_venta);
