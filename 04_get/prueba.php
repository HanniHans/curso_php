<?php
    $lista_resena = array(
        array("id"=>1, "producto_id"=>28, "fecha"=>"12/03/20", "resena"=>"10 de 10", "calificacion"=>3.5),
        array("id"=>2, "producto_id"=>28, "fecha"=>"24/04/19", "resena"=>"me gusto", "calificacion"=>3),
        array("id"=>3, "producto_id"=>28, "fecha"=>"14/02/19", "resena"=>"me llego maltratado", "calificacion"=>3),
        array("id"=>4, "producto_id"=>28, "fecha"=>"13/03/19", "resena"=>"no pinta bien", "calificacion"=>3),
        array("id"=>5, "producto_id"=>23, "fecha"=>"13/03/19", "resena"=>"no pinta bien :(", "calificacion"=>3),
        array("id"=>5, "producto_id"=>23, "fecha"=>"13/03/19", "resena"=>"no pinta bien :(", "calificacion"=>3)
    );




     $resenas = $lista_resena;
     $sum_calif=0;
     $total_resenas = 0;
        foreach($resenas as $resena){
            if($resena['producto_id']===28){
                    $califi= $resena['calificacion'];
                    $total_resenas= $total_resenas+1;
                    echo $califi;
                    //print_r ($resena);
                    echo "<br>";
                    echo $resena['resena'];
                    $sum_calif = ((float)$califi + (float)$sum_calif);
                    
                    
            }
            
        }
        //echo "<br>";
        //echo $total_resenas. "<br>";

        //echo $sum_calif;
        //echo "<br>";
        // $avg = $sum_calif/$total_resenas;
        // echo $avg;

        if($total_resenas===0){
            $no_resenas = "no hay reseñas";
            echo $no_resenas;
        }else{
            $avg = $sum_calif/$total_resenas;
            echo $avg;
        }

        
        

// foreach($resenas as $resena){
//     if(in_array()){
        
//             //print_r ($resena);
//             echo "<br>";
//             echo $resena['resena'];
//     }else{
        
//         echo "no hay";
//         break;
//     }
// }
        

// if (in_array("mac", $os)) {
//     echo "Existe mac";
// }
    

// function saludo($nombre){
// 	echo "Bienvenido, ". $nombre. "<br/>";
// 	for ($i = 0; $i < strlen($nombre); $i++){
// 		$cadena[$i] = substr($nombre, $i, 1);
// 	}
// 	return $cadena;
// }
 
// $nombre = "Carlos";
// $auxiliar = saludo($nombre);
 
// for($i2=0;$i2 < strlen($nombre); $i2++){
// 	echo $auxiliar[$i2];
// 	echo "<br/>";
// }