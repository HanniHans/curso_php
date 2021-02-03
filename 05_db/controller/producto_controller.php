<?php
//crea una sesión o reanuda la actual basada en un identificador de sesión pasado mediante una petición GET o POST
session_start();
//$_SERVER es un array que contiene información, tales como cabeceras, rutas y ubicaciones de script
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/05_db/');


    if(isset($_GET['codigo'])){ 
        $codigo = $_GET['codigo'];
        //echo $codigo;
        require_once root.'models/productos_model.php';
        $producto = get_producto_by_id((int)$codigo);
    
        if($producto != NULL){
            //print_r($producto);
            require_once root.'models/resenas_model.php';
            $resenas_del_producto = get_resenas_by_producto((int)$codigo);
            
            if (empty($resenas_del_producto)) {
                $empty_resena= "No hay reseñas todavía :c";
            }else {
                $suma_calificación = 0;
                foreach($resenas_del_producto as $resena_del_producto){
                    $suma_calificación = $resena_del_producto['calificacion'] + $suma_calificación;   
                }
                $cantidad_resenas = count($resenas_del_producto);
                $avg_resenas = $suma_calificación/$cantidad_resenas;
                
            }

            if(isset($_SESSION['usuario_id'])){
                $resena_por_usuario= get_resenas_by_usuario_and_producto((int)$codigo, (int)$_SESSION['usuario_id']);
                //print_r($resena_por_usuario);
                //monstrar textos en las vistas y aqui una variable para saber si si se puede mostrar.
                if (empty($resena_por_usuario)) {
                    $mensaje= "¿Quieres reseñar este producto?";
                }else{
                    $mensaje_modificar = "¿Quieres modificar tu reseña?";
                }
            }else{
                echo "no logeado :c";
            }

            require_once root.'views/producto_view.php';

        }else{
            echo "no existe";
        }

    }else{
        echo 'no se recibio el codigo';
    }
    

    //PROYECTO
    //inicio con una pantalla vacia
    //no voy a manejar inventario
    //formulario de inicio, ingreso el codigo de barra
    //venden en 3 condiciones
    //suelto o granale 
    //si es producto a granel, cuanto se va llevar
    //ingreso el codigo del producto y peso
    //vendo por bolsa
    //vendo por menudeo y precio por mayoreo

    //se podria imprimir en un pdf el ticket
    //sin diseño, no js, no css
    //ventas 