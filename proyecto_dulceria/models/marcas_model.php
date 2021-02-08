<?php
require_once root.'db/query_fns.php';


function get_all_marcas(){
    $sql= 'SELECT marcas.id, marcas.`status`, marcas.marca FROM marcas WHERE marcas.`status` = 1';
    return get_items($sql);
    
}

function get_marca_by_id($marca_id){
    $sql="SELECT marcas.id, marcas.marca, marcas.`status` FROM marcas WHERE marcas.`status` = 1 AND marcas.id = $marca_id";
    return get_item($sql);
}
