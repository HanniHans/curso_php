<?php
require_once root.'db/query_fns.php';
function get_producto_by_codigo_de_barras($codigo_de_barras){
    $sql= "SELECT
    productos.id,
    productos.marca_id,
    productos.unidades_de_medida_id,
    productos.tipo_de_venta_de_producto_id,
    productos.producto,
    unidades_de_medida.unidad_de_medida,
    tipos_de_venta_de_producto.tipo,
    productos.precio_menudeo,
    productos.cantidad_mayoreo,
    productos.codigo_de_barras
    FROM
    productos
    INNER JOIN unidades_de_medida ON unidades_de_medida.id = productos.unidades_de_medida_id
    INNER JOIN tipos_de_venta_de_producto ON tipos_de_venta_de_producto.id = productos.tipo_de_venta_de_producto_id
    WHERE
    productos.`status` = 1 AND
    unidades_de_medida.`status` = 1 AND
    unidades_de_medida.`status` = 1 AND
    productos.codigo_de_barras = $codigo_de_barras";
    return get_item($sql);
}

function get_suma_cantidad_de_producto_by_codigo_de_barras($codigo_de_barras){
    $cantidades= array();
    $suma_cantidad= 0;
    foreach($_SESSION['carrito'] as $producto){
        if ($producto['codigo_de_barras']==$codigo_de_barras) {
            $cantidades[] = $producto['cantidad']; 
        }
    }
    $suma_cantidad = array_sum($cantidades);

    return $suma_cantidad;
}

function get_keys_productos_by_codigo($codigo_de_barras){
    $keys = array();
    $keys_carrito=array_keys($_SESSION['carrito']);
    $num_de_productos = array_pop($keys_carrito);
    for ($i=0; $i <= $num_de_productos; $i++) { 
        if (isset($_SESSION['carrito'][$i]['codigo_de_barras'])) {
            if ($_SESSION['carrito'][$i]['codigo_de_barras']==$codigo_de_barras) {
                $keys[]=$i;
            }
        }
    }
    return $keys;
}

// function get_tipo_de_venta_producto_by_codigo($codigo_de_barras){
    
// }


// function delete_producto_de_carrito($i){
//     unset($_SESSION['carrito'][$i]);
// }