<?php
require_once root.'db/query_fns.php';


function get_all_marcas(){
    $sql= 'SELECT
    marcas.id,
    marcas.`status`,
    marcas.marca
    FROM
    marcas
    WHERE
    marcas.`status` = 1';
    return get_items($sql);
    
}