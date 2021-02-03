<?php
function get_all_productos(){
    $lista_productos = array(
        array("id"=>23, "nombre"=>"pelota", "precio"=>12.34, "descripcion"=>"Antiquemaduras, fabricado con materiales gruesos y duraderos. Ponemos su seguridad como una prioridad máxima durante la fabricación. Clasificado hasta 2 000 libras"),
        array("id"=>28, "nombre"=>"libreta", "precio"=>31, "descripcion"=>"Cuaderno clásico grande con 240 páginas regladas (anverso y reverso) para notas, listas, reflexiones y más"),
        array("id"=>34, "nombre"=>"goma", "precio"=>3.45, "descripcion"=>"Goma de migajón tipo bloque"),
        array("id"=>57, "nombre"=>"boligrafo", "precio"=>6.78, "descripcion"=>"Tecnología de pluma de tinta de gel sin tapa. Escritor versátil acepta recargas cruzadas de gel y jumbo.")
    );

    return $lista_productos;
}

function get_producto_by_codigo($codigo){
    $productos = get_all_productos();
    foreach($productos as $producto){
        if($producto['id']===$codigo){
            return $producto;
        }
    }
    return NULL;
}
