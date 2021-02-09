<?php
require_once root.'db/query_fns.php';

function get_producto_by_codigo_de_barras($codigo_de_barras){
    $sql = "SELECT productos.id, productos.marca_id, productos.unidades_de_medida_id, productos.tipo_de_venta_de_producto_id, productos.producto, unidades_de_medida.unidad_de_medida, tipos_de_venta_de_producto.tipo, productos.precio_menudeo, productos.cantidad_mayoreo, productos.codigo_de_barras, categorias.categoria, productos.descripcion, productos.precio_mayoreo, productos.referencia_por_unidad FROM productos INNER JOIN unidades_de_medida ON unidades_de_medida.id = productos.unidades_de_medida_id INNER JOIN tipos_de_venta_de_producto ON tipos_de_venta_de_producto.id = productos.tipo_de_venta_de_producto_id INNER JOIN categorias ON categorias.id = productos.categoria_id WHERE productos.`status` = 1 AND unidades_de_medida.`status` = 1 AND unidades_de_medida.`status` = 1 AND categorias.`status` = 1 AND productos.codigo_de_barras = $codigo_de_barras";
    return get_item($sql);
}

function get_productos_unicos($array_carrito){
    $ids_productos = array_unique(array_column($array_carrito, 'id'));
    $lista_muestra = [];
    foreach ($ids_productos as $id_producto) {
        $temp = [];
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
        }
        
        $lista_muestra[] = $producto;
    }
    return $lista_muestra;
}

function get_productos_and_total_por_producto_venta(){
    $productos_unicos = get_productos_unicos($_SESSION['carrito']);
    $productos_y_suma=[];
    foreach ($productos_unicos as $producto) {
        /*
            echo "array1 ".$key['cantidad']. " <br>";
            echo $key['referencia_por_unidad']. " ";
            echo $key['precio_mayoreo']. " ";
            echo $key['precio_menudeo']. " ";
            echo $key['cantidad_mayoreo']. " ";
            echo $key['total']. " ";
            echo "<br><br>";*/
        if ($producto['cantidad']>$producto['cantidad_mayoreo']) {
            $total_por_producto = ($producto["cantidad"]*$producto['precio_mayoreo'])/$producto['referencia_por_unidad'];
            $producto['total']=$total_por_producto;
            $producto['descuento']="APLICA";
        }else {
            $total_por_producto = ($producto["cantidad"]*$producto['precio_menudeo'])/$producto['referencia_por_unidad'];
            $producto['total']=$total_por_producto;
            $producto['descuento']="NO APLICA";
        }
        $productos_y_suma[]=$producto;
    }
    return $productos_y_suma;
}

function get_suma_de_total_por_producto_venta($total){
    $suma=[];
    foreach ($total as $t){
        $suma[]=$t['total'];
    }
    return array_sum($suma);
}


function get_all_productos_eliminados(){
    $sql= "SELECT productos.id, productos.codigo_de_barras, productos.producto, productos.precio_menudeo, productos.precio_mayoreo, productos.cantidad_mayoreo, productos.referencia_por_unidad, productos.descripcion, productos.`status`, categorias.categoria, unidades_de_medida.unidad_de_medida FROM productos INNER JOIN categorias ON categorias.id = productos.categoria_id INNER JOIN unidades_de_medida ON unidades_de_medida.id = productos.categoria_id WHERE productos.`status` = -1";
    return get_items($sql);
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
// 1 (323) 3 (222) 4 (323)
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

function eliminar_productos_by_id($fecha_y_hora,$producto_id){
    $sql ="UPDATE productos SET productos.status = -1, productos.updated_at = '$fecha_y_hora' WHERE id = $producto_id";
    return update_item($sql);
}

function get_producto_by_id($producto_id){
    $sql= "SELECT
    productos.marca_id,
    productos.id,
    productos.unidades_de_medida_id,
    productos.categoria_id,
    productos.tipo_de_venta_de_producto_id,
    productos.producto,
    productos.precio_menudeo,
    productos.codigo_de_barras,
    productos.precio_mayoreo,
    productos.cantidad_mayoreo,
    productos.referencia_por_unidad,
    productos.descripcion,
    productos.`status`
    FROM
    productos
    WHERE
    productos.`status` = 1 AND
    productos.id = $producto_id";
    return get_item($sql);
}

function modificar_productos_by_id($marca_id, $unidades_de_medida_id, $categoria_id, $tipo_de_venta_de_producto_id, $producto, $codigo_de_barras, $precio_menudeo, $precio_mayoreo, $cantidad_mayoreo, $referencia_por_unidad, $descripcion, $updated_at,$producto_id){
    $sql ="UPDATE productos SET marca_id = $marca_id, unidades_de_medida_id= $unidades_de_medida_id, categoria_id=$categoria_id, tipo_de_venta_de_producto_id=$tipo_de_venta_de_producto_id, producto='$producto', codigo_de_barras=$codigo_de_barras, precio_menudeo=$precio_menudeo, precio_mayoreo=$precio_mayoreo, cantidad_mayoreo=$cantidad_mayoreo, referencia_por_unidad=$referencia_por_unidad, descripcion= '$descripcion', status = 1, productos.updated_at = '$updated_at' WHERE id = $producto_id";
    return update_item($sql);
}

function reset_lista_de_productos_de_muestra(){
    //obtener valores unicos del array
    $codigos_barras_muestra = array_values(array_unique(array_column($_SESSION['carrito'], 'codigo_de_barras')));
    $productos_muestra = array_values(array_unique(array_column($_SESSION['carrito'],'producto')));
    //$precio_menudeo_muestra = array_values(array_unique(array_column($_SESSION['carrito'],'precio_menudeo')));
    //$precio_mayoreo_muestra = array_values(array_unique(array_column($_SESSION['carrito'], 'precio_mayoreo')));
    //$mayoreo_muestra = array_values(array_unique(array_column($_SESSION['carrito'], 'cantidad_mayoreo')));
    /* 
        //$referencia_muestra = array_values(array_unique(array_column($_SESSION['carrito'], 'referencia_por_unidad')));
    
        // print_r($referencia_muestra);
        //$referencia_muestra = get_referencia_producto_by_codigo(3234567890123);
        //print_r($referencia_muestra); */
    $_SESSION['lista_de_muestra']=array();
    $_SESSION['total_venta']=0;
    $total_venta = array();

    for ($i=0; $i < count($productos_muestra); $i++) { 
        $cantidad_por_producto = get_suma_cantidad_de_producto_by_codigo_de_barras($codigos_barras_muestra[$i]);
        $unidad_de_medida_muestra = get_unidad_de_medidad_producto_by_codigo($codigos_barras_muestra[$i]);
        $referencia_muestra = get_referencia_producto_by_codigo($codigos_barras_muestra[$i]);
        $precio_mayoreo_muestra =get_precio_mayoreo_producto_by_codigo($codigos_barras_muestra[$i]);
        $precio_menudeo_muestra =get_precio_menudeo_producto_by_codigo($codigos_barras_muestra[$i]);
        $mayoreo_muestra = get_cantidad_mayoreo_producto_by_codigo($codigos_barras_muestra[$i]);
        // print_r($referencia_muestra);
        // echo "<br>pf: ".intval(implode($referencia_muestra))."<br>";
        $_SESSION['lista_de_muestra'][$i]['codigo_de_barras']=$codigos_barras_muestra[$i];
        $_SESSION['lista_de_muestra'][$i]['producto']=$productos_muestra[$i];
        $_SESSION['lista_de_muestra'][$i]['unidad_de_medida']=implode($unidad_de_medida_muestra);
        $_SESSION['lista_de_muestra'][$i]['cantidad']=$cantidad_por_producto;
        $_SESSION['lista_de_muestra'][$i]['precio_menudeo']=implode($precio_menudeo_muestra);
        $_SESSION['lista_de_muestra'][$i]['precio_mayoreo']=implode($precio_mayoreo_muestra);
        $_SESSION['lista_de_muestra'][$i]['ref']=implode($referencia_muestra);
        // echo intval($referencia_muestra)." ";
        if (implode($mayoreo_muestra) < intval($cantidad_por_producto)) {
            //$total_por_producto = ($referencia_muestra[$i]*$precio_mayoreo_muestra[$i])/$cantidad_por_producto;
            $total_por_producto = ($cantidad_por_producto*implode($precio_mayoreo_muestra))/implode($referencia_muestra);  
            $_SESSION['lista_de_muestra'][$i]['descuento']= "APLICA";
            $_SESSION['lista_de_muestra'][$i]['total']=$total_por_producto;
        }else {
            $total_por_producto = ($cantidad_por_producto*implode($precio_menudeo_muestra))/implode($referencia_muestra);
            $_SESSION['lista_de_muestra'][$i]['descuento']= "NO APLICA";
            $_SESSION['lista_de_muestra'][$i]['total']=$total_por_producto;
             
        } 
        $total_venta[]= $total_por_producto;     
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

function get_referencia_producto_by_codigo($codigo_de_barras){
    $referencia = array();
    foreach($_SESSION['carrito'] as $producto){
        if ($producto['codigo_de_barras']==$codigo_de_barras) {
            $referencia[] = $producto['referencia_por_unidad']; 
        }
    }
    return array_unique($referencia);
}

function get_cantidad_mayoreo_producto_by_codigo($codigo_de_barras){
    $cantidad_mayoreo = array();
    foreach($_SESSION['carrito'] as $producto){
        if ($producto['codigo_de_barras']==$codigo_de_barras) {
            $cantidad_mayoreo[] = $producto['cantidad_mayoreo']; 
        }
    }
    return array_unique($cantidad_mayoreo);

}

function get_precio_mayoreo_producto_by_codigo($codigo_de_barras){
    $precio_mayoreo = array();
    foreach($_SESSION['carrito'] as $producto){
        if ($producto['codigo_de_barras']==$codigo_de_barras) {
            $precio_mayoreo[] = $producto['precio_mayoreo']; 
        }
    }
    return array_unique($precio_mayoreo);

}

function get_precio_menudeo_producto_by_codigo($codigo_de_barras){
    $precio_menudeo = array();
    foreach($_SESSION['carrito'] as $producto){
        if ($producto['codigo_de_barras']==$codigo_de_barras) {
            $precio_menudeo[] = $producto['precio_menudeo']; 
        }
    }
    return array_unique($precio_menudeo);

}

function get_productos_by_categoria($categoria){
    $sql = "SELECT productos.id, productos.codigo_de_barras, productos.producto, productos.precio_menudeo, unidades_de_medida.unidad_de_medida, productos.categoria_id, categorias.categoria, productos.cantidad_mayoreo, productos.descripcion FROM productos INNER JOIN unidades_de_medida ON unidades_de_medida.id = productos.unidades_de_medida_id INNER JOIN categorias ON categorias.id = productos.categoria_id WHERE productos.`status` = 1 AND unidades_de_medida.`status` = 1 AND productos.categoria_id = $categoria AND categorias.`status` = 1";
    return get_items($sql);
}

function get_all_productos(){
    $sql = "SELECT productos.id, productos.codigo_de_barras, productos.producto, productos.precio_menudeo, unidades_de_medida.unidad_de_medida, productos.categoria_id, categorias.categoria, productos.cantidad_mayoreo, productos.descripcion FROM productos INNER JOIN unidades_de_medida ON unidades_de_medida.id = productos.unidades_de_medida_id INNER JOIN categorias ON categorias.id = productos.categoria_id WHERE productos.`status` = 1 AND unidades_de_medida.`status` = 1 AND categorias.`status` = 1 ORDER BY productos.producto ASC";
    return get_items($sql);
}

function insert_producto($marca_id, $unidades_de_medida_id, $categoria_id, $tipo_de_venta_de_producto_id, $producto, $codigo_de_barras, $precio_menudeo, $precio_mayoreo, $cantidad_mayoreo, $referencia_por_unidad, $descripcion, $created_at){
    $sql = "INSERT INTO productos (marca_id, unidades_de_medida_id, categoria_id, tipo_de_venta_de_producto_id, producto, codigo_de_barras, precio_menudeo, precio_mayoreo, cantidad_mayoreo, referencia_por_unidad, descripcion, status, created_at)  VALUES ($marca_id, $unidades_de_medida_id, $categoria_id, $tipo_de_venta_de_producto_id, '$producto', $codigo_de_barras, $precio_menudeo, $precio_mayoreo, $cantidad_mayoreo, $referencia_por_unidad, '$descripcion', 1, '$created_at')";
    return insert_item($sql);
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


