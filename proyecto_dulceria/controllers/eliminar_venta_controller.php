<?php
session_start();

// echo $_GET['venta_id'];
// echo $_SESSION['usuario_id'];
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');

if (!isset($_SESSION['usuario_id'])) {
    echo "no haz iniciado sesion";
}else {
    if(!isset($_GET['venta_id']) || empty($_GET['venta_id'])){
        echo "no se recibio la venta que deseas eliminar :c";
    }else {
        $venta_id = $_GET['venta_id'];
        
        require_once root.'models/ventas_model.php';
        date_default_timezone_set('America/Mexico_City');
        $fecha_y_hora = date("y-m-d H:i:s");
        $actualizar_venta_por_id = updated_venta_by_id($fecha_y_hora, $venta_id);

        if ($actualizar_venta_por_id == FALSE) {
            echo "hubo un error al eliminar la venta";
        }else {
            echo "se elimino la venta correctamente <br>";
            require_once root.'models/productos_de_venta_model.php';
            $actualizar_productos_de_venta_por_id = updated_productos_de_venta_by_venta_id($fecha_y_hora, $venta_id);
            if ($actualizar_venta_por_id == FALSE) {
                echo "hubo un problema al eliminar los productos de la venta";
            }else {
                echo "se han Eliminado los productos de la venta correctamente";
            }
        }
    }
}
