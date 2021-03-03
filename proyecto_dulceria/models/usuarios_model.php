<?php
require_once root.'db/query_fns.php';

function get_usuario_by_correo($correo){
    $sql= "SELECT usuarios.id, usuarios.tipo_de_usuario_id, usuarios.nombre, usuarios.apellido_paterno, usuarios.apellido_materno, usuarios.correo, usuarios.contrasena FROM usuarios INNER JOIN tipos_de_usuario ON tipos_de_usuario.id = usuarios.tipo_de_usuario_id  WHERE usuarios.`status` = 1 AND usuarios.correo = '$correo'";
    return get_item($sql);
}