<?php
session_start();
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');

if (!isset($_SESSION['usuario_id'])) {
    echo "no estas logueado";
}else {
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
                    echo "el codigo esta vacio";
                }else {
                    $codigo_de_barras = $_GET['codigo'];
                    require_once root.'models/productos_model.php';
                    $llaves_de_producto_por_codigo = get_keys_productos_by_codigo($codigo_de_barras);
                    // print_r($llaves_de_producto_por_codigo);
                    if (count($llaves_de_producto_por_codigo)==1) {
                        // echo "<br>";
                        for ($i=0; $i <count($llaves_de_producto_por_codigo); $i++) { 
                            unset($_SESSION['carrito'][$llaves_de_producto_por_codigo[$i]]);
                        }
                        echo '<h1>Se ha eliminado el producto</h1>';
                        echo '<a href="../index.php">Capturar productos</a>';
                    }else {
                        $tipos_de_venta=array();
                        foreach($_SESSION['carrito'] as $producto){
                            if ($producto['codigo_de_barras']==$codigo_de_barras) {
                                // echo $producto['tipo_de_venta_de_producto_id'];
                                $tipos_de_venta[] = $producto['tipo_de_venta_de_producto_id'];
                            }
                        }
                        $tipo_de_venta = array_pop($tipos_de_venta);
                        if ($tipo_de_venta==2) {
                            // echo "venta a granel";
                            for ($i=0; $i <count($llaves_de_producto_por_codigo); $i++) { 
                                unset($_SESSION['carrito'][$llaves_de_producto_por_codigo[$i]]);
                            }
                            echo '<h1>Se ha eliminado el producto</h1>';
                            echo '<a href="../index.php">Capturar productos</a>';

                        }else {
                            $_SESSION['productos_paquete']=$codigo_de_barras;
                            require_once root.'views/eliminar_productos_view.php';
                            
                        }  
                    }
                    
                    $recargar_lista_de_productos = reset_lista_de_productos_de_muestra();
                    $_SESSION['carrito_de_muestra'] = get_productos_and_total_por_producto_venta();
                    $_SESSION['total']= get_suma_de_total_por_producto_venta($_SESSION['carrito_de_muestra']);

                }
            }
        }
    }
}

