<?php 
session_start();

define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');

if (!isset($_SESSION['usuario_id'])) {
    echo "no haz inciado sesion";
}else {
    if (!isset($_SESSION['productos_paquete'])) {
        echo "no se recibio el codigo_de_barras";
    }else {
        if (!$_POST['cantidad_de_prodcutos_eliminados'] || empty($_POST['cantidad_de_prodcutos_eliminados'])) {
            echo "hubo un problema con la cantidad :c";
        }else {
            // echo "todo bien";
            $codigo_de_barras = $_SESSION['productos_paquete'];
            //echo $codigo_de_barras;
            $cantidad_eliminados = $_POST['cantidad_de_prodcutos_eliminados'];
            //echo $cantidad_eliminados;
            require_once root.'models/productos_model.php';
            $llaves_de_producto_por_codigo = get_keys_productos_by_codigo($codigo_de_barras);
            $cantidad_total = count($llaves_de_producto_por_codigo);
            if ($cantidad_eliminados>$cantidad_total) {
                echo '<h1>La cantidad es mayor a la que tenias</h1>';
                echo '<a href="../index.php">Capturar productos</a>';
            }else {
                if ($cantidad_total==$cantidad_eliminados) {
                    echo '<h1>Se han eliminado todos los productos</h1>';
                    echo '<a href="../index.php">Capturar productos</a>';
                    for ($i=0; $i <count($llaves_de_producto_por_codigo); $i++) { 
                        // echo "<br>";
                        // echo $llaves_de_producto_por_codigo[$i];
                        unset($_SESSION['carrito'][$llaves_de_producto_por_codigo[$i]]);
                    }
                }else {
                    echo '<h1>Se han eliminado '.$cantidad_eliminados.' productos</h1>';
                    echo '<a href="../index.php">Capturar productos</a>';
                    for ($i=0; $i < intval($cantidad_eliminados); $i++) { 
                        // echo "<br>";
                        // echo $llaves_de_producto_por_codigo[$i];
                        unset($_SESSION['carrito'][$llaves_de_producto_por_codigo[$i]]);
                    }
                }
            }
            $recargar_lista_de_productos = reset_lista_de_productos_de_muestra();         
        /*
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
        */
        }
    }
}














