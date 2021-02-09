<?php
// function get_total_venta($array_carrito){
//     //obtine los ids de la venta
//     $ids_productos = array_unique(array_column($array_carrito, 'id'));

//     $resultado = [];
//     foreach ($ids_productos as $id_producto) {
//         $temp     = [];
//         foreach ($array_carrito as $arr_carrito) {
//             $id = $arr_carrito["id"];
//             if ($arr_carrito["id"] === $id_producto) {
//                 $temp[] = $arr_carrito;
//             }
//         }
//         //$ventas = $temp[0];
//         $ventas["total_venta"] = 0;
//         foreach ($temp as $ventas_temp) {
//             $ventas["total_venta"] = $ventas["total_venta"] + $ventas_temp["total_venta"];
//         }
//         $result[] = $ventas;
//     }
//     return $resultado;
// }

function get_total_venta($array_carrito){
    //ids de las ventas
    $ids_productos = array_unique(array_column($array_carrito, 'id'));
    $lista_muestra = [];
    foreach ($ids_productos as $id_producto) {
        $temp = [];
        //$quantity = 0;
        foreach ($array_carrito as $arr_carrito) {
            $id = $arr_carrito["id"];

            if ($id === $id_producto) {
                $temp[] = $arr_carrito;
            }
        }
        $producto = $temp[0];
        $producto["cantidad"] = 0;
        $producto["total"] = 0;
        foreach ($temp as $producto_temp) {
            $producto["cantidad"] = $producto["cantidad"] + $producto_temp["cantidad"];
            echo "<br>";
        }
        
        $lista_muestra[] = $producto;
    }
    return $lista_muestra;
}
