<?php
session_start();
echo $_POST['fecha_venta'];

define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');
if (!isset($_SESSION['usuario_id'])) {
    echo "No estas logueado";
}else {
    if (!isset($_POST['fecha_venta'])) {
        echo "la variable no esta seteada";
    }else {
        if (empty($_POST['fecha_venta'])) {
            echo "no ingresaste la fecha :c";
        }else{
            unset($_SESSION['ventas']);

            $fecha_venta = $_POST['fecha_venta'];
            require_once root.'models/ventas_model.php';
            $ventas_por_fecha = get_ventas_by_fecha($fecha_venta);
            if (empty($ventas_por_fecha)) {
                echo "no hay ningúna venta en esta fecha: ". $fecha_venta;
            }else {
                
                // $ventas_y_total = get_total_venta($ventas_por_fecha);
                // print_r($ventas_y_total);
                $_SESSION['ventas']= $ventas_por_fecha;
                header("Location: ../controllers/ventas_controller.php");

            }
        }
    }
}
