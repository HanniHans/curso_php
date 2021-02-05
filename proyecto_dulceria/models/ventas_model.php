<?php
require_once root.'db/query_fns.php';

function create_venta($usuario_id, $created_at){
    $sql = "INSERT INTO ventas (usuario_id, ventas.status, created_at) VALUES ($usuario_id, 1,'$created_at')";
    return insert_item_id($sql);
}

// function insert_resena($producto_id, $usuario_id, $fecha_resena, $calificacion, $titulo, $resena, $created_at){
//     $sql = "INSERT INTO resenas (producto_id, usuario_id, fecha_resena, calificacion, titulo, resena, resenas.status, created_at) VALUES ($producto_id, $usuario_id, '$fecha_resena', '$calificacion', '$titulo', '$resena', 1,'$created_at')";
//     return insert_item($sql);
// }