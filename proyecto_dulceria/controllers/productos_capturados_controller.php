<?php
session_start();
//header("Location: ../controllers/capturar_productos_controller.php");
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');

if(!isset($_SESSION['usuario_id'])){
    echo "No has iniciado sesión <br>";
}else {
    if(!isset($_POST['codigo_de_barras'])){
        echo "la varibale no esta seteada <br>";
    }else {
        if (strlen($_POST['codigo_de_barras'])!=13) {
            echo "hubo un error con el codigo de barras :c <br>";
        }else {
            $codigo_de_barras = $_POST['codigo_de_barras'];
            require_once root.'models/productos_model.php';
            $productos_por_codigo_de_barras = get_producto_by_codigo_de_barras($codigo_de_barras);
            if (empty($productos_por_codigo_de_barras)) {
                echo "El producto no existe <br>";
            }else {
                if ($productos_por_codigo_de_barras['tipo_de_venta_de_producto_id']==2) {
                    $_SESSION['producto_granel']=$productos_por_codigo_de_barras;
                    require_once root.'views/granel_view.php';
                }else {
                    $productos_por_codigo_de_barras['cantidad']=1;
                    $_SESSION['carrito'][]=$productos_por_codigo_de_barras;
                
                    if (!isset($_SESSION['carrito'])) {
                        echo "no esta seteada";                 
                    }else {
                        //$recargar_lista_de_productos = reset_lista_de_productos_de_muestra();
                        $_SESSION['carrito_de_muestra'] = get_productos_and_total_por_producto_venta();
                        $_SESSION['total']= get_suma_de_total_por_producto_venta($_SESSION['carrito_de_muestra']);
                        header("Location: ../index.php");

                        /*
                            //print_r($_SESSION['carrito']);
                            $codigos_barras_muestra = array_values(array_unique(array_column($_SESSION['carrito'], 'codigo_de_barras')));
                            //print_r($codigos_barras_muestra);
                            $productos_muestra = array_values(array_unique(array_column($_SESSION['carrito'],'producto')));
                            //print_r($productos_muestra);
                            $precio_menudeo_muestra = array_values(array_unique(array_column($_SESSION['carrito'],'precio_menudeo')));
                            //$unidad_muestra = array_values(array_unique(array_column($_SESSION['carrito'],'unidad_de_medida')));
                            //print_r($precio_menudeo_muestra);
                        
                            $mayoreo_muestra = array_values(array_unique(array_column($_SESSION['carrito'], 'cantidad_mayoreo')));
                            print_r($mayoreo_muestra);
                            
                        
                            $_SESSION['pivote']=array();
                            // echo "<br>";
                            // echo "<br>".count($productos_muestra);

                            //cantidad_mayoreo
                            $_SESSION['total_venta']=0;

                            $total_venta = array();

                            
                            for ($i=0; $i < count($productos_muestra); $i++) { 
                                $cantidad_por_producto = get_suma_cantidad_de_producto_by_codigo_de_barras($codigos_barras_muestra[$i]);
                                $total_por_producto = $cantidad_por_producto*$precio_menudeo_muestra[$i]; 
                                $_SESSION['pivote'][$i]['codigo_de_barras']=$codigos_barras_muestra[$i];
                                $_SESSION['pivote'][$i]['producto']=$productos_muestra[$i];
                                //$_SESSION['pivote'][$i]['unidad_de_medida']=$unidad_muestra[$i];
                                $_SESSION['pivote'][$i]['cantidad']=$cantidad_por_producto;

                                $_SESSION['pivote'][$i]['precio_menudeo']=$precio_menudeo_muestra[$i];
                                $_SESSION['pivote'][$i]['total']=$total_por_producto;
                                $total_venta[]= $cantidad_por_producto*$precio_menudeo_muestra[$i];
                                if ($mayoreo_muestra[$i] < $cantidad_por_producto) {
                                    $descuento = $total_por_producto * .10;
                                    $_SESSION['pivote'][$i]['descuento']= "APLICA";
                                    $_SESSION['pivote'][$i]['total']=$total_por_producto - $descuento;
                                    
                                }else {
                                    $_SESSION['pivote'][$i]['descuento']= "NO APLICA";
                                    $_SESSION['pivote'][$i]['total']=$total_por_producto;
                                    
                                }    
                                
                            }
                            $_SESSION['total_venta']= array_sum($total_venta);*/
                        
                        
                        /*    
                            // foreach($ids_lista as $id){
                            //     $temp=[];
                            //     foreach($_SESSION['carrito'] as $producto){
                            //         echo $producto["id"]."  ";
                            //         $id_p = $producto["id"];
                            //         if ($id_p===$id) {
                            //             $temp[] = $producto;
                            //         }
                                
                            //     }
                            //     $ventas = $temp[0];
                                    
                            // }
                            

                            // function get_total_venta($array_ventas){
                            //     //ids de las ventas
                            //     $ids_ventas = array_unique(array_column($array_ventas, 'id'));
                            //     $result = [];
                            //     foreach ($ids_ventas as $unique_id) {
                            //         $temp = [];
                            //         //$quantity = 0;
                            //         foreach ($array_ventas as $arr_venta) {
                            //             $id = $arr_venta["id"];
                            
                            //             if ($id === $unique_id) {
                            //                 $temp[] = $arr_venta;
                            //             }
                            //         }
                            //         $ventas = $temp[0];
                            //         $ventas["cantidad"] = 0;
                            //         $ventas["total"] = 0;
                            //         foreach ($temp as $ventas_temp) {
                            //             $ventas["cantidad"] = $ventas["cantidad"] + $ventas_temp["cantidad"];
                            //             echo "<br>";
                            //         }
                                    
                            //         $result[] = $ventas;
                            //     }
                            //     return $result;
                            // }*/
                        
                        
                    }
                }     
            }
        }
    }
}

//crear archivos

