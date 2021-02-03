<?php
//Iniciar una nueva sesión o reanudar la existente
session_start();
$calificacion=$_GET['calificacion'];
$titulo =$_GET['titulo'];
$resena = $_GET['resena'];
$producto_id=$_GET['producto_id'];
//$_SERVER es un array que contiene información, tales como cabeceras, rutas y ubicaciones de script
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/05_db/');

if (isset($_SESSION['usuario_id'])) {
    # code...
    $usuario_id = $_SESSION['usuario_id'];
    if (isset($calificacion) && isset($titulo) && isset($resena) && isset($producto_id)) {
        # code...
        if (empty($calificacion) || empty($titulo) || empty($resena) || empty($producto_id)) {
            # code...
            echo "esta vacio :c";
        }else {
            /* 
                echo $calificacion."<br>";
                echo $titulo."<br>";
                echo $resena."<br>";
                echo $producto_id."<br>"; 
            */
            date_default_timezone_set('America/Mexico_City');
            $fecha_resena = date('y-m-d');
            $fecha_hora = date("y-m-d H:i:s");
            require_once root.'models/resenas_model.php';
            $resena_por_usuario= get_resenas_by_usuario_and_producto((int)$producto_id, (int)$_SESSION['usuario_id']);
            if (empty($resena_por_usuario)) {
                $insertar_resena = insert_resena($producto_id, $usuario_id, $fecha_resena, $calificacion, $titulo, $resena, $fecha_hora);
                //echo "reseña agregada";
                if ($insertar_resena===TRUE) {
                    # code...
                    header("Location: ../controller/producto_controller.php?codigo=".$producto_id);
                }else{
                    echo "no se pudo insertar la reseña :c";
                }
                
            }else {
                $actualizar_resena= update_resena($fecha_resena, $calificacion, $titulo, $resena, $fecha_hora, $producto_id, $usuario_id);
                //echo "modificar";
                //require_once root.'producto.php?codigo='.$producto_id;
                if ($actualizar_resena === TRUE) {
                    # code...
                    header("Location: ../controller/producto_controller.php?codigo=".$producto_id);
                }else{
                    echo "no se puede modificar tu reseña :c";
                }
                
            }

        }
    }else {
        echo "no se recibio algun parametro";
    }

}else {
    echo "no estas logeado";
}