<?php
session_start();
echo "hola";



echo "<br><br>";
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');

$llave = 0;
if (!isset($_SESSION['usuario_id'])) {
    echo "no estas logueado";
}else {
    echo "Estas logueado";
    if (!isset($_SESSION['carrito'])) {
        echo "no hay productos";
    }else {
        if (empty($_SESSION['carrito'])) {
            echo "el carrito esta vacio";
        }else {
            if (!isset($_GET['codigo'])) {
                echo "no esta seteada la variable codigo :c";
            }else {
                if (empty($_GET['codigo'])){
                    echo "esta vacio";
                }else {
                    $codigo_de_barras =$_GET['codigo'];
                    echo $codigo_de_barras;
                    print_r($_SESSION['carrito']);
                    require_once root.'models/productos_model.php';
                    $llaves_de_producto_por_codigo = get_keys_productos_by_codigo($codigo_de_barras);

                    echo "<br><br>llave_por_codigo: ";
                    print_r($llaves_de_producto_por_codigo);
                    if (count($llaves_de_producto_por_codigo)==1) {
                        // echo "<br>";
                        for ($i=0; $i <count($llaves_de_producto_por_codigo); $i++) { 
                            echo "<br>";
                            echo $llaves_de_producto_por_codigo[$i];
                            unset($_SESSION['carrito'][$llaves_de_producto_por_codigo[$i]]);
                        }
                        
                    }else {
                        
                        $tipos_de_venta=array();
                        foreach($_SESSION['carrito'] as $producto){
                            if ($producto['codigo_de_barras']==$codigo_de_barras) {
                                echo $producto['tipo_de_venta_de_producto_id'];
                                $tipos_de_venta[] = $producto['tipo_de_venta_de_producto_id'];
                            }
                        }
                        print_r($tipos_de_venta);
                        $tipo_de_venta = array_pop($tipos_de_venta);
                        echo "<br>".$tipo_de_venta;

                        if ($tipo_de_venta==2) {
                            echo "venta a granel";
                            for ($i=0; $i <count($llaves_de_producto_por_codigo); $i++) { 
                                echo "<br>";
                                echo $llaves_de_producto_por_codigo[$i];
                                unset($_SESSION['carrito'][$llaves_de_producto_por_codigo[$i]]);
                            }
                        }else {
                            echo "venta por paquete";
                            $_SESSION['productos_paquete']=$codigo_de_barras;
                            require_once root.'views/eliminar_productos_view.php';
                            
                        }
                        
                    }




                    



                    









                }
            
            }
        }
    }
}






// echo "<br>";
// for ($i=0; $i <count($nose) ; $i++) { 
//     echo "<br>";
//     echo $nose[$i];
//     unset($_SESSION['carrito'][$nose[$i]]);
// }
// echo "<br>";
// print_r($_SESSION['carrito']);


// echo "<br><br>";
// echo "<br><br>";
// for ($i=count($_SESSION['carrito']); $i >=0 ; $i--) { 
//     echo $i;
//     echo "<br>";
    
//     if (isset($prueba[$i])) {
//         echo $i;
//         echo " ";
//         echo $prueba[$i];
//         echo "<br>";
//         if ($prueba[$i]==$codigo_de_barras) {
//             echo "son iguales";
//             $llave = $i;
//         }
//     }
    
// }

// echo "<br><br> Llave: ";
// echo $llave;
// echo "<br><br> Prueba:";
// //unset($_SESSION['carrito'][$llave]);
// print_r($_SESSION['carrito']);








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