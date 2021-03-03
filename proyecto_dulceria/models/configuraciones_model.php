<?php
require_once root.'db/query_fns.php';
function get_configuracion(){
    $sql= "SELECT configuraciones.id, configuraciones.nombre_tienda, configuraciones.telefono, configuraciones.`status`, configuraciones.created_at FROM configuraciones WHERE configuraciones.`status` = 1";
    return get_item($sql);
}