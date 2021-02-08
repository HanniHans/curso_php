<?php
require_once root.'db/query_fns.php';

function get_all_unidades_de_medidad(){
    $sql= "SELECT unidades_de_medida.unidad_de_medida, unidades_de_medida.`status`, unidades_de_medida.id FROM unidades_de_medida WHERE unidades_de_medida.`status` = 1";
    return get_items($sql);
}

function get_unidad_de_medidad_by_id($unidad_de_medidad_id){
    $sql= "SELECT unidades_de_medida.id, unidades_de_medida.unidad_de_medida, unidades_de_medida.`status` FROM unidades_de_medida WHERE unidades_de_medida.`status` = 1 AND unidades_de_medida.id = $unidad_de_medidad_id";
    return get_item($sql);
}