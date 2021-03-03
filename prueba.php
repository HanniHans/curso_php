<?php

echo "prueba<br>";
$var = 3;

$vector = [1,2,3];
for ($i=0; $i < $var; $i++) { 
    echo $i;
}

echo "<br>";

for ($j=1; $j < count($vector); $j++) { 
    //echo $j."<br>"; //1 2
    for ($b=count($vector)-1; $b >=$j; $b--) { 
        echo $b."<br>"; //212
        if ($vector[$b-1]>$vector[$j]) {
            echo "hola";
        }
    }
    
}