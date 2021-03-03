<?php
require_once root.'db/query_fns.php';

function agregar_productos_a_venta($producto_id, $venta_id, $precio_venta, $referencia_por_unidad, $cantidad, $created_at){
    $sql = "INSERT INTO productos_de_la_venta (producto_id, venta_id, precio_venta, referencia_por_unidad, cantidad, status, created_at) VALUES ($producto_id, $venta_id, $precio_venta, $referencia_por_unidad, $cantidad, 1,'$created_at')";
    return insert_item($sql);
}

function updated_productos_de_venta_by_venta_id($fecha_y_hora, $venta_id){
    $sql ="UPDATE productos_de_la_venta SET productos_de_la_venta.status = -1, productos_de_la_venta.updated_at = '$fecha_y_hora' WHERE venta_id = $venta_id";
    return update_item($sql);
}

function get_productos_de_la_venta_by_venta_id($venta_id){
    $sql= "SELECT ventas.id, productos.codigo_de_barras, productos.producto, SUM(productos_de_la_venta.cantidad)* productos_de_la_venta.precio_venta / productos_de_la_venta.referencia_por_unidad AS total_por_producto, productos_de_la_venta.precio_venta FROM ventas LEFT JOIN productos_de_la_venta ON productos_de_la_venta.venta_id = ventas.id AND productos_de_la_venta.`status` = 1 INNER JOIN productos ON productos.id = productos_de_la_venta.producto_id WHERE ventas.`status` = 1 AND ventas.id = $venta_id GROUP BY ventas.id, productos_de_la_venta.producto_id";
    return get_items($sql);
}