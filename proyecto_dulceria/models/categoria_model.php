<?php
require_once root.'db/query_fns.php';
function get_all_categorias(){
    $sql="SELECT categorias.id, categorias.categoria, categorias.`status`, categorias.created_at FROM categorias WHERE categorias.`status` = 1";
    return get_items($sql);
}

