<?php
session_start();

$codigo_de_barras = $_POST['codigo_de_barras'];
echo $codigo_de_barras;




//header("Location: ../controllers/capturar_productos_controller.php");
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');

if(!isset($_SESSION['usuario_id'])){
    echo "No has iniciado sesión";
}else {
    if(!isset($codigo_de_barras)){
        echo "la varibale no esta seteada";
    }else {
        if (strlen($codigo_de_barras)!=13) {
            echo "hubo un error con el codigo de barras :c";
        }else {
            require_once root.'models/productos_model.php';
            $productos_por_codigo_de_barras = get_producto_by_codigo_de_barras($codigo_de_barras);
            if (empty($productos_por_codigo_de_barras)) {
                echo "El producto no existe";
            }else {
                //print_r($productos_por_codigo_de_barras);
                //echo $productos_por_codigo_de_barras['tipo_de_venta_de_producto_id'];
                if ($productos_por_codigo_de_barras['tipo_de_venta_de_producto_id']==2) {
                    echo "producto a granel";
                    $_SESSION['productos_granel']=$productos_por_codigo_de_barras;
                    require_once root.'views/granel_view.php';
                }else {
                    $productos_por_codigo_de_barras['cantidad']=1;
                    //echo count($_SESSION['carrito']);
                    $_SESSION['carrito'][]=$productos_por_codigo_de_barras;
                
                    if (!isset($_SESSION['carrito'])) {
                        echo "no esta seteada";                 
                    }else {
                        echo "variable seteada";
                        //print_r($_SESSION['carrito']);
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
                        //header("Location: ../index.php");

                        // print_r($_SESSION['pivote']);
                        // echo "<br><br><br>";
                        // print_r($_SESSION['carrito']);
                        header("Location: ../index.php");
                    }
                }    
                
            }
            
        }
        
    }
}

