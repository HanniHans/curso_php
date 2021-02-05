<?php
session_start();
echo "hola";
$codigo_de_barras =$_GET['codigo'];
print_r($_SESSION['carrito']);
echo $codigo_de_barras;
echo "<br><br>";
// $p= array_column($_SESSION['carrito'], 'codigo_de_barras');
// print_r($p);
// echo "<br><br>";
// $prueba = array_unique(array_column($_SESSION['carrito'], 'codigo_de_barras'));
// print_r($prueba);
// echo "<br><br>";
// $key = array_search($codigo_de_barras, $prueba);
// print_r($key);
// echo "<br><br>";
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');
$keys=array_keys($_SESSION['carrito']);
print_r($keys);
$llave = 0;

foreach ($_SESSION['carrito'] as $values) {
    echo $values['codigo_de_barras'];
    echo "<br>";
    // if ($values['codigo_de_barras']==$codigo_de_barras) {
    //     echo
    // }
}
$num_de_arreglo = array_pop($keys);
echo $num_de_arreglo;
echo "<br><br>";
$nose=array();
echo count($_SESSION['carrito']);
for ($i=0; $i <= $num_de_arreglo; $i++) { 
    # code...
    
    echo "<br>";
    if (isset($_SESSION['carrito'][$i]['codigo_de_barras'])) {
        # code...
        echo "todos: ".$i." ";
        echo $_SESSION['carrito'][$i]['codigo_de_barras'];
    
        if ($_SESSION['carrito'][$i]['codigo_de_barras']==$codigo_de_barras) {
            // print_r($_SESSION['carrito'][$i]);
            echo "<br>";
            echo "pasa el if: ".$i." ";
            echo $_SESSION['carrito'][$i]['codigo_de_barras'];
            
            $nose[]=$i;
        }
    }
}
echo "<br><br>nose: ";
print_r($nose);
echo "<br>";
for ($i=0; $i <count($nose) ; $i++) { 
    echo "<br>";
    echo $nose[$i];
    unset($_SESSION['carrito'][$nose[$i]]);
}
echo "<br>";
print_r($_SESSION['carrito']);


echo "<br><br>";
echo "<br><br>";
for ($i=count($_SESSION['carrito']); $i >=0 ; $i--) { 
    echo $i;
    echo "<br>";
    
    if (isset($prueba[$i])) {
        echo $i;
        echo " ";
        echo $prueba[$i];
        echo "<br>";
        if ($prueba[$i]==$codigo_de_barras) {
            echo "son iguales";
            $llave = $i;
        }
    }
    
}

echo "<br><br> Llave: ";
echo $llave;
echo "<br><br> Prueba:";
//unset($_SESSION['carrito'][$llave]);
print_r($_SESSION['carrito']);








require_once root.'models/productos_model.php';

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
// array_splice($_SESSION['carrito'], $llave);
// print_r($_SESSION['carrito']);


// function get_suma_cantidad_de_producto_by_codigo_de_barras($codigo_de_barras){
//     $cantidades= array();
//     $suma_cantidad= 0;
//     foreach($_SESSION['carrito'] as $producto){
//         if ($producto['codigo_de_barras']==$codigo_de_barras) {
//             $cantidades[] = $producto['cantidad']; 
//         }
//     }
//     $suma_cantidad = array_sum($cantidades);

//     return $suma_cantidad;
// }