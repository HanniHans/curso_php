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
            echo strlen($codigo_de_barras);
            require_once root.'models/productos_model.php';
            $productos_por_codigo_de_barras = get_producto_by_codigo_de_barras($codigo_de_barras);
            if (empty($productos_por_codigo_de_barras)) {
                echo "El producto no existe";
            }else {
                print_r($productos_por_codigo_de_barras);
                echo "<br>"."<br>";
                echo $productos_por_codigo_de_barras['tipo_de_venta_de_producto_id'];
                
                if ($productos_por_codigo_de_barras['tipo_de_venta_de_producto_id']==2) {
                    echo "producto a granel";
                    //echo '<script>alert("Hello! I am an alert box!!");</script>';
                    $_SESSION['productos_granel']=$productos_por_codigo_de_barras;
                    require_once root.'views/granel_view.php';

                }else {
                    $_SESSION['carrito'][]=$productos_por_codigo_de_barras;
                }

                if (isset($_SESSION['carrito'])) {
                    # code...
                    print_r($_SESSION['carrito']);
                    echo "<br>";
                    

                    


                    if (!isset($_SESSION['lista_de_muestra']) || empty($_SESSION['lista_de_muestra'])) {
                        echo "la variables no esta seteada";
                        echo "<br>";
                        $_SESSION['lista_de_muestra']= array();
                        print_r($_SESSION['lista_de_muestra']);
                        echo "<br>";
                        echo "ya esta seteada";
                        echo "<br>";
                        echo "vacio";
                        $_SESSION['lista_de_muestra'][]=$productos_por_codigo_de_barras;
                        echo "<br>"."ya no esa vacio"."<br>";
                        print_r($_SESSION['lista_de_muestra']);

                        
                    }else {
                        echo "<br>";
                        echo "ya esta seteada";
                        echo "<br>";
                        echo "<br>";
                        echo "<br>";
                        // foreach ($_SESSION['carrito'] as $lista_m) {
                            // echo "lista_m";
                            // echo $lista_m['codigo_de_barras'];
                            // echo "<br>";

                            // foreach ($_SESSION['lista_de_muestra'] as $lista_muestra) {
                            //     # code...
                            //     // echo "<br>lista_muestra";
                                 
                            //     echo $lista_muestra['codigo_de_barras'];
                            //     echo "<br>";
                            //     echo $productos_por_codigo_de_barras['codigo_de_barras'];
                            //     // echo "<br>";
                            //     if($lista_muestra['codigo_de_barras']!==$productos_por_codigo_de_barras['codigo_de_barras']){
                            //         echo "es diferente"; 
                            //         //$_SESSION['lista_de_muestra'][]=$productos_por_codigo_de_barras;
                                    
                            //     }else {
                            //         echo "el producto ya esta agregado";
                            //         // $_SESSION['lista_de_muestra'][]=$productos_por_codigo_de_barras;
                                    
                                    
                            //     }
                            // }

                            for ($i=0; $i < count($_SESSION['lista_de_muestra']); $i++) { 
                                // print_r($_SESSION['carrito'][$i]['producto']);
                                // echo "<br>";
                                if ($_SESSION['lista_de_muestra'][$i]['codigo_de_barras']==$productos_por_codigo_de_barras['codigo_de_barras']) {
                                    # code...
                                    echo "existe";
                                    // print_r($_SESSION['carrito'][$i]['cantidad']);
                                    // echo "<br>";
                                }else {
                                    echo "es diferente";
                                    $_SESSION['lista_de_muestra'][]=$productos_por_codigo_de_barras;
                                    break;
                                }
                                
                            }
                        // }
                        echo "<br>";
                        

                        
                        
                    }

                    echo "<br><br>final<br>";
                    print_r($_SESSION['lista_de_muestra']);

                    // if (isset($_SESSION['lista_de_muestra']) || empty($_SESSION['lista_de_muestra'])) {
                        
                    //     echo "<br>"."lista de compras1: ";
                    //     $_SESSION['lista_de_muestra'][]=$productos_por_codigo_de_barras;
                    //     print_r($_SESSION['lista_de_muestra']);
                    //     foreach ($_SESSION['lista_de_muestra'] as $lista_de_muestra) {
                    //         echo $lista_de_muestra['codigo_de_barras'];
                    //     }
                    // }else {
                    //     foreach ($_SESSION['lista_de_muestra'] as $lista_de_muestra) {
                    //         if ($_SESSION['lista_de_muestra']['codigo_de_barras']!=$productos_por_codigo_de_barras['codigo_de_barras']) {
                    //             $_SESSION['li'][]=$productos_por_codigo_de_barras;
                    //         }
                    //     }
                    //     echo "<br>"."lista de compras";
                    //     print_r($_SESSION['lista_de_muestra']);
                    // }
                    
                    
                }

                

                echo "<br><br><br>";
                // for ($i=0; $i < count($_SESSION['carrito']); $i++) { 
                //     if ($_SESSION['carrito']['codigo_de_barras']!=$productos_por_codigo_de_barras) {
                //         # code...
                //     }
                // }
                
                echo "<br>"."<br>";
                print_r($_SESSION['carrito']);
                // foreach ($_SESSION['carrito'] as $productos) {
                //     # code...
                //     //echo $productos['producto'];
                // $codigo = array_column($_SESSION['carrito'], 'codigo_de_barras');
                    
                // }
                echo "cuenta".count($_SESSION['carrito'])."<br>";
                //con esto se arregla un problema no lo borres
                for ($i=0; $i < count($_SESSION['carrito']); $i++) { 
                    // print_r($_SESSION['carrito'][$i]['producto']);
                    // echo "<br>";
                    if ($_SESSION['carrito'][$i]['tipo_de_venta_de_producto_id']==1) {
                        # code...
                        $_SESSION['carrito'][$i]['cantidad']= 1;
                        // print_r($_SESSION['carrito'][$i]['cantidad']);
                        // echo "<br>";
                    }
                    
                }
                echo "<br>"."averee";
                print_r($_SESSION['carrito']);
                $codigo = array_column($_SESSION['carrito'], 'codigo_de_barras');
                // echo "<br>"."codigos de barras:";
                // print_r($codigo);
                if (array_count_values($codigo)) {
                    echo "<br>"."conteo de valores:";
                    print_r(array_count_values($codigo));
                    echo "<br>";
                    
                }
                
                $cantidad=array_values(array_count_values($codigo));
                echo "<br>"."cantidad";
                print_r($cantidad);
                $prueba = array_column($_SESSION['carrito'],'producto');
                echo "<br>";
                echo "<br>"."productos column:";
                print_r($prueba);
                $productos_unique = array_values(array_unique($prueba));
                echo "<br>";
                echo "<br>"."productos:";
                print_r($productos_unique);
                $codigo_unique=array_values(array_unique($codigo));
                $precio_menudeo = array_column($_SESSION['carrito'],'precio_menudeo');
                
                $precio_menudeo_unique=array_values(array_unique($precio_menudeo));
                print_r($precio_menudeo_unique);

                $precio_menudeo = array_column($_SESSION['carrito'],'precio_menudeo');
                $precio_menudeo_unique=array_values(array_unique($precio_menudeo));
                print_r($precio_menudeo_unique);
                //$productos_unique = array_unique($_SESSION['carrito']);
                //print_r(array_unique($_SESSION['carrito']));
                $cantidad_privote= array_column($_SESSION['carrito'],'cantidad');
                echo "<br>";
                echo "<br>"."cantidad:";
                print_r($cantidad_privote);
                // foreach ($_SESSION['carrito'] as $idontknow) {
                    
                // }



                $pruba2 ='codigo_debarras';
                $_SESSION['pivote']=array();
                echo "<br>";
                echo "<br>".count($productos_unique);
                for ($i=0; $i < count($productos_unique); $i++) { 
                    
                    //print_r($_SESSION['pivote']['producto']);
                        # code...
                    $_SESSION['pivote'][$i][$pruba2]=$codigo_unique[$i];
                    $_SESSION['pivote'][$i]['producto']=$productos_unique[$i];
                    $_SESSION['pivote'][$i]['cantidad']=$cantidad[$i];
                    $_SESSION['pivote'][$i]['precio_menudeo']=$precio_menudeo_unique[$i];
                    $_SESSION['pivote'][$i]['total']=$cantidad[$i]*$precio_menudeo_unique[$i];
                    
                }

                print_r($_SESSION['pivote']);
                //header("Location: ../controllers/capturar_productos_controller.php");
                //unset($_SESSION['pivote']);

                // foreach ($_SESSION['carrito'] as $value) {
                //     $value['producto'];
                // }
                // echo "<br>"."<br>";
                // echo "prueba";
                // echo "<br>";
                // // print_r(array_keys($_SESSION['carrito']));
                // //print_r(array_column($_SESSION['carrito']));
                // for ($i=0; $i < count($_SESSION['carrito']); $i++) { 
                //     $filas= $_SESSION['carrito'][$i];
                //     // print_r($filas);
                //     // echo "<br>";
                //     // echo "columnas:";
                //     $columnas=array_keys($filas);
                //     // print_r($columnas);
                //     // echo "<br>";

                //     for ($j=0; $j < count($columnas); $j++) { 
                //         # code...
                //         echo "columnas";
                //         print_r($columnas[$j]);
                //         echo "<br>";
                //         print_r($_SESSION['carrito'][$i][$columnas[$j]]);
                //         echo "<br>";
                        
                //     }
                //     // $precio_menudeo = array_column($_SESSION['carrito'],'precio_menudeo');
                
                //     // $precio_menudeo_unique=array_values(array_unique($precio_menudeo));
                //     // echo "<br>";
                //     // print_r(count($filas));
                //     // echo "<br>";
                //     // for ($j=0; $j < count($filas); $j++) { 
                //     //     # code...
                //     //     print_r($_SESSION['carrito'][$i][$j]);
                //     //     echo "<br>";
                //     // }
                    
                // }
                // echo "<br>";
                // $columnas=array_keys($filas);
                //     // print_r($columnas);
                //     // echo "<br>";
                //     array_push($columnas, "cantidad");

                //     for ($j=0; $j < count($columnas); $j++) { 
                //         # code...
                //         echo "columnas";
                //         print_r($columnas[$j]);
                //         echo "<br>";
                //         // print_r($_SESSION['carrito'][$i][$columnas[$j]]);
                //         // echo "<br>";
                        
                //     }
                // echo "<br>"."<br>";
                // echo "columnas:";
                // print_r(array_keys($filas));

                // function lista_de_carrito_de_muestra($productos){
                //     $_SESSION['prueba']=array();
                    
                // }
                
            }
            
        }
        
    }
}

