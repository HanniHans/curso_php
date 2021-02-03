<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <?php
        // $variable = 3;
        // if($variable < 10){
        //     echo "texto";

        // }

        for($i = 1; $i <6; $i++){
            echo "<h".$i.">".$i."<h".$i."/>";
        }

        //Ejercicio: 
        //Generar 10 imagenes de una imagen 
        //que mida 10px y la segunda 100px

        for($i = 1; $i <6; $i++){
            echo $i."<br>";
            if($i==4)
                echo "Si";
                continue;
            
            
        }

        
    ?>

    <h2>Tarea</h2>
    <?php

        for ($i=10; $i <= 100; $i+=10){
            # code...
            //echo $i."<br>";
            echo '<img src="imagenes/'.$i.'.jpg" alt="" width="'.$i.'px" height="'.$i.'px">';
        }
    ?>
         
            
    



</body>
</html>