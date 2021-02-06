<?php
require_once root.'db/query_fns.php';
function get_producto_by_codigo_de_barras($codigo_de_barras){
    // $sql= "SELECT
    // productos.id,
    // productos.marca_id,
    // productos.unidades_de_medida_id,
    // productos.tipo_de_venta_de_producto_id,
    // productos.producto,
    // unidades_de_medida.unidad_de_medida,
    // tipos_de_venta_de_producto.tipo,
    // productos.precio_menudeo,
    // productos.cantidad_mayoreo,
    // productos.codigo_de_barras
    // FROM
    // productos
    // INNER JOIN unidades_de_medida ON unidades_de_medida.id = productos.unidades_de_medida_id
    // INNER JOIN tipos_de_venta_de_producto ON tipos_de_venta_de_producto.id = productos.tipo_de_venta_de_producto_id
    // WHERE
    // productos.`status` = 1 AND
    // unidades_de_medida.`status` = 1 AND
    // unidades_de_medida.`status` = 1 AND
    // productos.codigo_de_barras = $codigo_de_barras";
    $sql = "SELECT
    productos.id,
    productos.marca_id,
    productos.unidades_de_medida_id,
    productos.tipo_de_venta_de_producto_id,
    productos.producto,
    unidades_de_medida.unidad_de_medida,
    tipos_de_venta_de_producto.tipo,
    productos.precio_menudeo,
    productos.cantidad_mayoreo,
    productos.codigo_de_barras,
    categorias.categoria,
    productos.descripcion,
    productos.precio_mayoreo
    FROM
    productos
    INNER JOIN unidades_de_medida ON unidades_de_medida.id = productos.unidades_de_medida_id
    INNER JOIN tipos_de_venta_de_producto ON tipos_de_venta_de_producto.id = productos.tipo_de_venta_de_producto_id
    INNER JOIN categorias ON categorias.id = productos.categoria_id
    WHERE
    productos.`status` = 1 AND
    unidades_de_medida.`status` = 1 AND
    unidades_de_medida.`status` = 1 AND
    categorias.`status` = 1 AND
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

function reset_lista_de_productos_de_muestra(){
     $codigos_barras_muestra = array_values(array_unique(array_column($_SESSION['carrito'], 'codigo_de_barras')));
     $productos_muestra = array_values(array_unique(array_column($_SESSION['carrito'],'producto')));
     $precio_menudeo_muestra = array_values(array_unique(array_column($_SESSION['carrito'],'precio_menudeo')));
     $precio_mayore_muestra = array_values(array_unique(array_column($_SESSION['carrito'], 'precio_mayoreo')));
     $mayoreo_muestra = array_values(array_unique(array_column($_SESSION['carrito'], 'cantidad_mayoreo')));
     
     $_SESSION['lista_de_muestra']=array();
     $_SESSION['total_venta']=0;
     $total_venta = array();
     for ($i=0; $i < count($productos_muestra); $i++) { 
         
         $cantidad_por_producto = get_suma_cantidad_de_producto_by_codigo_de_barras($codigos_barras_muestra[$i]);
         $unidad_de_medida_muestra = get_unidad_de_medidad_producto_by_codigo($codigos_barras_muestra[$i]);
         $total_por_producto = $cantidad_por_producto*$precio_menudeo_muestra[$i]; 

         $_SESSION['lista_de_muestra'][$i]['codigo_de_barras']=$codigos_barras_muestra[$i];
         $_SESSION['lista_de_muestra'][$i]['producto']=$productos_muestra[$i];
         $_SESSION['lista_de_muestra'][$i]['unidad_de_medida']=implode($unidad_de_medida_muestra);
         $_SESSION['lista_de_muestra'][$i]['cantidad']=$cantidad_por_producto;
         $_SESSION['lista_de_muestra'][$i]['precio_menudeo']=$precio_menudeo_muestra[$i];
        //  $_SESSION['lista_de_muestra'][$i]['total']=$total_por_producto;
         
         if ($mayoreo_muestra[$i] < $cantidad_por_producto) {
             $descuento = $total_por_producto * .10;
             $_SESSION['lista_de_muestra'][$i]['descuento']= "APLICA";
             $_SESSION['lista_de_muestra'][$i]['total']=$total_por_producto - $descuento;
             $total_venta[]= $total_por_producto - $descuento;
             
         }else {
             $_SESSION['lista_de_muestra'][$i]['descuento']= "NO APLICA";
             $_SESSION['lista_de_muestra'][$i]['total']=$total_por_producto;
             $total_venta[]= $total_por_producto;
             
         }      
     }
     $_SESSION['total_venta']= array_sum($total_venta);
}

function get_unidad_de_medidad_producto_by_codigo($codigo_de_barras){
    $unidad_de_medida = array();
    foreach($_SESSION['carrito'] as $producto){
        if ($producto['codigo_de_barras']==$codigo_de_barras) {
            $unidad_de_medida[] = $producto['unidad_de_medida']; 
        }
    }
    return array_unique($unidad_de_medida);
}

function get_productos_by_categoria($categoria){
    $sql = "SELECT productos.codigo_de_barras, productos.producto, productos.precio_menudeo, unidades_de_medida.unidad_de_medida, productos.categoria_id, categorias.categoria,
    productos.cantidad_mayoreo, productos.descripcion
    FROM productos INNER JOIN unidades_de_medida ON unidades_de_medida.id = productos.unidades_de_medida_id INNER JOIN categorias ON categorias.id = productos.categoria_id
    WHERE productos.`status` = 1 AND unidades_de_medida.`status` = 1 AND productos.categoria_id = $categoria AND categorias.`status` = 1";
    return get_items($sql);
}

function get_all_productos(){
    $sql = "SELECT productos.codigo_de_barras, productos.producto, productos.precio_menudeo, unidades_de_medida.unidad_de_medida, productos.categoria_id, categorias.categoria, productos.cantidad_mayoreo, productos.descripcion
    FROM productos INNER JOIN unidades_de_medida ON unidades_de_medida.id = productos.unidades_de_medida_id INNER JOIN categorias ON categorias.id = productos.categoria_id
    WHERE productos.`status` = 1 AND unidades_de_medida.`status` = 1 AND categorias.`status` = 1
    ORDER BY productos.producto ASC";
    return get_items($sql);
}

// function get_descuento_por_producto(){
//     if ($mayoreo_muestra > $cantidad_por_producto) {
//         $descuento = $total_por_producto * .10;
//         // $_SESSION['pivote'][$i]['descuento'] = ($cantidad_por_producto*$precio_menudeo_muestra[$i])-$descuento;
//         $_SESSION['pivote'][$i]['descuento']= "APLICA";
//     }else {
//         $_SESSION['pivote'][$i]['descuento']= "NO APLICA";
//     }
// }

// function get_tipo_de_venta_producto_by_codigo($codigo_de_barras){
    
// }


// function delete_producto_de_carrito($i){
//     unset($_SESSION['carrito'][$i]);
// }