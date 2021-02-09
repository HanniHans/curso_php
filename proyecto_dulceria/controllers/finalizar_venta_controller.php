<?php
session_start();
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');
if (!isset($_SESSION['usuario_id'])) {
    echo "no estas logueado";
}else {
    if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
        echo "no hay nigún producto disponible";
    }else {
        date_default_timezone_set('America/Mexico_City');
        $created_at = date("y-m-d H:i:s");
        require_once root.'models/ventas_model.php';
        $id_venta = create_venta_and_get_id($_SESSION['usuario_id'], $created_at);
        if ($id_venta==FALSE) {
            echo "hubo un problema al crear la venta :C";
        }else {
            // echo $id_venta;
            // echo "<br>";
            require_once root.'models/productos_de_venta_model.php';
            require_once root.'models/productos_model.php';
            // agregar_productos_a_venta($producto_id, $usuario_id, $precio_venta, $cantidad, $created_at);
            foreach($_SESSION['carrito'] as $producto_venta){
                $cantidad_por_producto = get_suma_cantidad_de_producto_by_codigo_de_barras($producto_venta['codigo_de_barras']);
                // print_r($cantidad_por_producto);
                if ($producto_venta['cantidad_mayoreo']<=$cantidad_por_producto) {
                    $agregar_productos_a_venta=agregar_productos_a_venta($producto_venta['id'], $id_venta, $producto_venta['precio_mayoreo'], $producto_venta['referencia_por_unidad'], $producto_venta['cantidad'], $created_at);
                }else {
                    $agregar_productos_a_venta=agregar_productos_a_venta($producto_venta['id'], $id_venta, $producto_venta['precio_menudeo'], $producto_venta['referencia_por_unidad'], $producto_venta['cantidad'], $created_at);
                }
                if ($agregar_productos_a_venta==FALSE) {
                    echo "hubo un problema al agregar el producto ".$producto_venta['producto']." :c";
                }
            }
            $_SESSION['ticket']= $_SESSION['carrito_de_muestra'];
            unset($_SESSION['carrito']);
            //require_once root.'controllers/crear_pdf_controller.php';
            require_once root.'views/venta_finalizada_view.php';
            //header("Location: ../views/venta_finalizada_view.php");  
        }
    }
}