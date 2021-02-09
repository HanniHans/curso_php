<?php
require_once root.'db/query_fns.php';

function create_venta_and_get_id($usuario_id, $created_at){
    $sql = "INSERT INTO ventas (usuario_id, ventas.status, created_at) VALUES ($usuario_id, 1,'$created_at')";
    return insert_item_id($sql);
}

function get_all_ventas(){
    $sql='SELECT ventas.id, ventas.usuario_id, ventas.`status`, ventas.created_at, CONCAT(usuarios.nombre, " ", usuarios.apellido_paterno, " ", usuarios.apellido_materno) FROM ventas INNER JOIN usuarios ON usuarios.id = ventas.usuario_id WHERE ventas.`status` = 1';
    return get_items($sql);
}

function get_last_5_ventas(){
    //$sql ='SELECT ventas.id, ventas.usuario_id, ventas.`status`, ventas.created_at, CONCAT(usuarios.nombre, " ", usuarios.apellido_paterno, " ", usuarios.apellido_materno) AS vendedor FROM ventas INNER JOIN usuarios ON usuarios.id = ventas.usuario_id WHERE ventas.`status` = 1 ORDER BY ventas.created_at ASC LIMIT 5';
    $sql='SELECT productos_de_la_venta.venta_id, CONCAT(usuarios.nombre, " ", usuarios.apellido_paterno, " ", usuarios.apellido_materno) AS vendedor, Sum(productos_de_la_venta.precio_venta) AS total_venta, ventas.created_at FROM ventas INNER JOIN usuarios ON usuarios.id = ventas.usuario_id INNER JOIN productos_de_la_venta ON ventas.id = productos_de_la_venta.venta_id GROUP BY productos_de_la_venta.venta_id LIMIT 5';
    return get_items($sql);
}

function get_ventas_by_fecha($fecha_venta){
    //$sql="SELECT ventas.id, ventas.usuario_id, ventas.`status`, ventas.created_at, CONCAT(usuarios.nombre, ' ', usuarios.apellido_paterno, ' ', usuarios.apellido_materno) AS vendedor, Sum(productos_de_la_venta.precio_venta) AS total_venta FROM ventas INNER JOIN usuarios ON usuarios.id = ventas.usuario_id LEFT JOIN productos_de_la_venta ON productos_de_la_venta.venta_id = ventas.id AND productos_de_la_venta.`status` = 1 WHERE DATE(ventas.created_at) = '$fecha_venta' AND ventas.`status` = 1 GROUP BY ventas.id";
    $sql="SELECT ventas.id, ventas.`status`, ventas.created_at, CONCAT(usuarios.nombre, ' ', usuarios.apellido_paterno, ' ', usuarios.apellido_materno) AS vendedor, SUM(productos_de_la_venta.cantidad)* productos_de_la_venta.precio_venta / productos_de_la_venta.referencia_por_unidad AS total_venta  FROM ventas INNER JOIN usuarios ON usuarios.id = ventas.usuario_id LEFT JOIN productos_de_la_venta ON productos_de_la_venta.venta_id = ventas.id AND productos_de_la_venta.`status` = 1 WHERE DATE(ventas.created_at) = '$fecha_venta' AND ventas.`status` = 1 GROUP BY ventas.id, productos_de_la_venta.producto_id";
    $array_ventas = get_items($sql);
    $ventas_y_suma = get_total_venta($array_ventas);
    return $ventas_y_suma;
}

function updated_venta_by_id($fecha_y_hora,$venta_id){
    $sql ="UPDATE ventas SET ventas.status = -1, ventas.updated_at = '$fecha_y_hora' WHERE id = $venta_id";
    return update_item($sql);
}

function get_total_venta($array_ventas){
    //ids de las ventas
    $ids_ventas = array_unique(array_column($array_ventas, 'id'));
    $result = [];
    foreach ($ids_ventas as $unique_id) {
        $temp = [];
        //$quantity = 0;
        foreach ($array_ventas as $arr_venta) {
            $id = $arr_venta["id"];

            if ($id === $unique_id) {
                $temp[] = $arr_venta;
            }
        }
        $ventas = $temp[0];
        $ventas["total_venta"] = 0;
        foreach ($temp as $ventas_temp) {
            $ventas["total_venta"] = $ventas["total_venta"] + $ventas_temp["total_venta"];
        }
        $result[] = $ventas;
    }
    return $result;
}


