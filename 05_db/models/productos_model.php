<?php
require_once root.'db/query_fns.php';

function get_all_productos(){ 
    //$sql = "SELECT productos.id, productos.producto_nombre, productos.precio, productos.codigo FROM productos WHERE productos.`status` = 1";
    $sql = "SELECT productos.id, productos.producto_nombre, productos.precio, Avg(resenas.calificacion) AS promedio FROM productos LEFT JOIN resenas ON resenas.producto_id = productos.id and resenas.status =1 WHERE productos.`status` = 1 GROUP BY productos.producto_nombre ORDER BY productos.id ASC";
    return get_items($sql);

}

// function get_all_resenas_by_producto(){
//     $sql = "SELECT... FROM....";
//     return($sql)
// }

function get_producto_by_id($codigo){
    $sql = "SELECT productos.id, productos.producto_nombre, productos.precio, productos.codigo FROM productos WHERE productos.`status` = 1 AND productos.id = $codigo";
    return get_item($sql);
}


//no cargar el modelo si no lo vas a ocupar

//variables de decision, 
//primero le tengo que decir es voy a ocupar variables de sesion por medio del metodo init_sesion
//peticion: cuando ingreso a ver los detalles de un producto es una peticion
//cuando ingreso una url es una peticion

//formulario
//pido correo y contraseña
//voy a la base para coincidir datos
//si no coincide le digo al usuario esta mal
//si coincide, entonces voy a tomar el id y lo voy a guardar en el arreglo de sesion
//de tal forma que en cualquier momento, en cualquier pagina voy a autenticado el usuario


//crear dentro del sistema una pagina para autentificarse
//ingresar usuario y contraseña
//tabla de usuario: correo y la contraseña cifrar en md5 char32
//cuando reciba el usuario y la contraseña 
//lo voy a recibir en la variable post
//convertir contraseña en md5 y comparar con el de la base