<?php 
session_start();
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/05_db/');
    
    if(isset($_SESSION['usuario_id'])){
        
        if (isset($_GET['codigo'])) {
            $producto_id = $_GET['codigo'];
            require_once root.'models/productos_model.php';
            $producto = get_producto_by_id((int)$producto_id);
            if ($producto!=NULL) {
                # code...
                //print_r($producto);
                require_once root.'models/resenas_model.php';
                $resena_por_usuario= get_resenas_by_usuario_and_producto((int)$producto_id, (int)$_SESSION['usuario_id']);
                require_once root.'views/nueva_resena_view.php';

            }else {
                echo "no existe";
            }
        }else {
            echo "no se recibio codigo";
        }
        
        
    }else {
        
        echo "tienes que estar logeado";
    }


