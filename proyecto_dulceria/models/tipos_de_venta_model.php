<?php
require_once root.'db/query_fns.php';

function get_all_tipos_venta(){
    $sql='SELECT
    tipos_de_venta_de_producto.id,
    tipos_de_venta_de_producto.tipo,
    tipos_de_venta_de_producto.`status`
    FROM
    tipos_de_venta_de_producto
    WHERE
    tipos_de_venta_de_producto.`status` = 1';
    return get_items($sql);
}