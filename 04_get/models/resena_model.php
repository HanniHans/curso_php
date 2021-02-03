<?php

function get_all_resenas(){
    $lista_resena = array(
        array("id"=>1, "producto_id"=>28, "fecha"=>"12/03/20", "resena"=>"10 de 10", "calificacion"=>5),
        array("id"=>2, "producto_id"=>28, "fecha"=>"24/04/19", "resena"=>"me gusto", "calificacion"=>4),
        array("id"=>3, "producto_id"=>28, "fecha"=>"14/02/19", "resena"=>"me llego maltratado", "calificacion"=>3),
        array("id"=>4, "producto_id"=>28, "fecha"=>"13/03/19", "resena"=>"llego roto", "calificacion"=>1),
        array("id"=>5, "producto_id"=>23, "fecha"=>"13/03/19", "resena"=>"no era lo que esperaba", "calificacion"=>3),
        array("id"=>6, "producto_id"=>23, "fecha"=>"13/03/19", "resena"=>"muy bonita", "calificacion"=>5)
    );

    return $lista_resena;
}


/* Otra forma de hacerlo, que no era la mejor
function get_avg_calificacion($codigo){
    $resenas = get_all_resenas();
    $sum_calif=0;
    $total_resenas = 0;
    foreach($resenas as $resena){
        if($resena['producto_id']===$codigo){
            //print_r($resena);
            $califi= $resena['calificacion'];
            $total_resenas= $total_resenas+1;
            $sum_calif = ((float)$califi + (float)$sum_calif);
            
        }
    }

    if($total_resenas===0){
        $no_resenas = "No hay reseñas todavia :(";
        return $no_resenas;
    }else{
        $avg = "<h4>Calificacion Total: ".$sum_calif/$total_resenas."</h4>";
        return $avg;
    }
} */

function get_resenas_by_codigo($codigo){
    $resenas = get_all_resenas();
    $resenas_filtrados= array();
    foreach($resenas as $resena){
        if ($resena['producto_id']===$codigo) {
            $resenas_filtrados[] = $resena; 
        }
    }

    return $resenas_filtrados;
}
