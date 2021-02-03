<?php
require_once root.'db/query_fns.php';

function get_all_usuarios(){
    $sql = "SELECT usuarios.nombre, usuarios.id FROM usuarios WHERE usuarios.`status` = 1";
    return get_items($sql);
}

function get_usuario_by_correo($correo){
    $sql = "SELECT usuarios.id, usuarios.nombre, usuarios.correo, usuarios.contrasena FROM usuarios WHERE usuarios.`status` = 1 AND usuarios.correo = '$correo'";
    return get_item($sql);
}

function get_usuario_by_id($id_usuario){
    $sql = "SELECT usuarios.id, usuarios.nombre, usuarios.apellido, usuarios.correo FROM usuarios WHERE usuarios.`status` = 1 AND usuarios.id = $id_usuario";
    return get_item($sql);
}