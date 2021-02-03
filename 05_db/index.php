<?php
//Iniciar una nueva sesión o reanudar la existente
session_start();
//$_SERVER es un array que contiene información, tales como cabeceras, rutas y ubicaciones de script
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/05_db/');
require_once root.'models/productos_model.php';
$productos = get_all_productos();

if(isset($_SESSION['usuario_id'])){
    echo "logeado";
    require_once root.'models/usuarios_model.php';
    $usuario = get_usuario_by_id($_SESSION['usuario_id']);
}else{
    echo "no logeado :c";
}
require_once root.'views/productos_view.php';