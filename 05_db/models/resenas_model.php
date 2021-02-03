<?php
require_once root.'db/query_fns.php';

function get_resenas_by_producto($codigo){
    $sql= "SELECT productos.producto_nombre, usuarios.nombre, resenas.fecha_resena, resenas.calificacion, resenas.titulo, resenas.resena FROM productos LEFT JOIN resenas ON resenas.producto_id = productos.id LEFT JOIN usuarios ON usuarios.id = resenas.usuario_id WHERE productos.`status` = 1 AND resenas.`status` = 1 AND usuarios.`status` = 1 AND productos.id = $codigo";

    return get_items($sql);
}

function get_resenas_by_usuario_and_producto(int $producto_id, int $usuario_id){
    $sql = "SELECT resenas.producto_id, resenas.usuario_id, resenas.fecha_resena, resenas.calificacion, resenas.titulo, resenas.resena, usuarios.nombre, usuarios.correo FROM resenas INNER JOIN usuarios ON usuarios.id = resenas.usuario_id AND usuarios.`status` = 1 WHERE resenas.`status` = 1 AND resenas.producto_id = $producto_id AND usuarios.id = $usuario_id";
    return get_item($sql);
}

function insert_resena($producto_id, $usuario_id, $fecha_resena, $calificacion, $titulo, $resena, $created_at){
    $sql = "INSERT INTO resenas (producto_id, usuario_id, fecha_resena, calificacion, titulo, resena, resenas.status, created_at) VALUES ($producto_id, $usuario_id, '$fecha_resena', '$calificacion', '$titulo', '$resena', 1,'$created_at')";
    return insert_item($sql);
}

function update_resena($fecha_resena, $calificacion, $titulo, $resena, $updated_at, $producto_id, $usuario_id){
    $sql ="UPDATE resenas SET fecha_resena='$fecha_resena', calificacion='$calificacion', titulo='$titulo', resena='$resena', updated_at='$updated_at' WHERE resenas.producto_id = $producto_id AND resenas.usuario_id = $usuario_id";
    return update_item($sql);
}