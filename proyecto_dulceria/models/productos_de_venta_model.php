<?php
require_once root.'db/query_fns.php';

function agregar_productos_a_venta($producto_id, $venta_id, $precio_venta, $cantidad, $created_at){
    $sql = "INSERT INTO productos_de_la_venta (producto_id, venta_id, precio_venta, cantidad, status, created_at) VALUES ($producto_id, $venta_id, $precio_venta, $cantidad, 1,'$created_at')";
    return insert_item($sql);

}

