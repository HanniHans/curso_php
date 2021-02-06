<?php
require_once root.'db/query_fns.php';

function create_venta_and_get_id($usuario_id, $created_at){
    $sql = "INSERT INTO ventas (usuario_id, ventas.status, created_at) VALUES ($usuario_id, 1,'$created_at')";
    return insert_item_id($sql);
}

function get_all_ventas(){
    $sql='SELECT ventas.id, ventas.usuario_id, ventas.`status`, ventas.created_at, CONCAT(usuarios.nombre, " ", usuarios.apellido_paterno, " ", usuarios.apellido_materno) FROM
    ventas INNER JOIN usuarios ON usuarios.id = ventas.usuario_id WHERE ventas.`status` = 1';
    return get_items($sql);
}

function get_last_5_ventas(){
    //$sql ='SELECT ventas.id, ventas.usuario_id, ventas.`status`, ventas.created_at, CONCAT(usuarios.nombre, " ", usuarios.apellido_paterno, " ", usuarios.apellido_materno) AS vendedor FROM ventas INNER JOIN usuarios ON usuarios.id = ventas.usuario_id WHERE ventas.`status` = 1 ORDER BY ventas.created_at ASC LIMIT 5';
    $sql='SELECT
    productos_de_la_venta.venta_id,
    CONCAT(usuarios.nombre, " ", usuarios.apellido_paterno, " ", usuarios.apellido_materno) AS vendedor,
    Sum(productos_de_la_venta.precio_venta) AS total_venta,
    ventas.created_at
    FROM
    ventas
    INNER JOIN usuarios ON usuarios.id = ventas.usuario_id
    INNER JOIN productos_de_la_venta ON ventas.id = productos_de_la_venta.venta_id
    GROUP BY
    productos_de_la_venta.venta_id
    LIMIT 5';
    return get_items($sql);
}

function get_ventas_by_fecha($fecha_venta){
    $sql="SELECT productos_de_la_venta.venta_id, ventas.created_at, CONCAT(usuarios.nombre, ' ', usuarios.apellido_paterno, ' ', usuarios.apellido_materno) AS vendedor, Sum(productos_de_la_venta.precio_venta) AS total_venta
    FROM ventas INNER JOIN usuarios ON usuarios.id = ventas.usuario_id INNER JOIN productos_de_la_venta ON ventas.id = productos_de_la_venta.venta_id
    WHERE DATE(ventas.created_at) = '$fecha_venta' GROUP BY productos_de_la_venta.venta_id";
    return get_items($sql);
}