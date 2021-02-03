<?php
if(isset($_GET['codigo'])){ //quiere decir que el navegador
    $codigo = $_GET['codigo'];
    require_once './models/productos_model.php';
    //require_once './models/resena_model.php';
    $producto = get_producto_by_codigo((int)$codigo);
    //$res = get_all_resenas();
    //$avg_resena = get_avg_calificacion((int)$codigo);
    if($producto != NULL){
        
        require_once './models/resena_model.php';
        $resenas_del_producto = get_resenas_by_codigo((int)$codigo);
        if (empty($resenas_del_producto)) {
            # code...
            $empty_resena= "No hay reseñas todavía :c";
        }else {
            # code...
            $suma_calificación = 0;
            foreach($resenas_del_producto as $resena_del_producto){
                $suma_calificación = $resena_del_producto['calificacion'] + $suma_calificación;
                
            }
            $cantidad_resenas = count($resenas_del_producto);
            $avg_resenas = $suma_calificación/$cantidad_resenas;
        }
        
        require_once('./views/producto_view.php');
    }else{
        echo "no existe";

    }
}else{
    echo 'no se recibio el codigo';
}



//crear una carpeta de las imagenes y se carga dependiendo del id
//agregar recomendaciones de los usuarios