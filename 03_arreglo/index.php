<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
        $arreglo = array('a', "cadena", 34, 2.3);
        print_r($arreglo);
        $arreglo[]= 'texto';
        echo '<pre>';
        print_r($arreglo);
        echo '</pre>';

    
        
        echo "<br>";

        for ($i=0; $i < count($arreglo); $i++) { 
            # code...
            echo $arreglo[$i].'<br>';
            // if($arreglo[$i]==34){
            //     echo "si";
            // }    
        
        }

        $bidimensional = array(
            array('2', "pablo", 45),
            array('4', "pedro", 23),
            array('5', "juan", 27),
            array('6', "jose", 18)
        );

        for ($i=0; $i < count($bidimensional); $i++) { 
            # code...
        }
        
    ?>

    <table>
        <tr>
            <th>id</th>
            <th>nombre</th>
            <th>edad</th>
        </tr>
        <?php foreach($bidimensional as $dato):?>
        <tr>   
            <td><?php echo $dato[0];?></td>
            <td><?php echo $dato[1];?></td>
            <td><?php echo $dato[2];?></td>       
        </tr>
        <?php endforeach?>
    </table>

    <?php
    foreach($bidimensional as $fila){
        echo $fila[1].'<br>';
    }
    ?>

    <table>
        <tr>
            <th>id</th>
            <th>nombre</th>
            <th>edad</th>
        </tr>
        <?php foreach($bidimensional as $dato):
            if($dato[2]>=27):
            ?>
        <tr>   
            <td><?php echo $dato[0];?></td>
            <td><?php echo $dato[1];?></td>
            <td><?php echo $dato[2];?></td>       
        </tr>
        <?php
            endif; 
        endforeach?>
    </table>


    <?php

    //7 de enero de 2021
        $asociativo = array(
            array("nombre" => "jose", "apellido" => "rojas", "puesto"=> "vendedor"),
            array("nombre" => "pedro", "apellido" => "lopez", "puesto"=> "cajero"),
            array("nombre" => "jose", "apellido" => "rojas", "puesto"=> "gerente")
            
        );

        foreach($asociativo as $empleado){
            echo '<br>';
            echo $empleado["puesto"];
            
        }
    ?>

    <table>
        <tr>
            <th>nombre</th>
            <th>apellido</th>
            <th>puesto</th>
        </tr>
        <?php foreach($asociativo as $valor):
            
            ?>
        <tr>   
            <td><?php echo $valor["nombre"];?></td>
            <td><?php echo $valor["apellido"];?></td>
            <td><?php echo $valor["puesto"];?></td>       
        </tr>
        <?php
             
        endforeach?>
    </table>

            

        
    
 <!--
     Investigar las estructuras de html
 -->


</body>
</html>