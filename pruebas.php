<?php
function get_total_venta($array_ventas){
    //obtine los ids de la venta
    $ids_ventas = array_unique(array_column($array_ventas, 'id'));

    $resultado = [];
    foreach ($ids_ventas as $unique_id) {
        $temp     = [];
        foreach ($array_ventas as $arr_venta) {
            $id = $arr_venta["id"];
            if ($arr_venta["id"] === $unique_id) {
                $temp[] = $arr_venta;
            }
        }
        //$ventas = $temp[0];
        $ventas["total_venta"] = 0;
        foreach ($temp as $ventas_temp) {
            $ventas["total_venta"] = $ventas["total_venta"] + $ventas_temp["total_venta"];
        }
        $result[] = $ventas;
    }
    return $resultado;
}


