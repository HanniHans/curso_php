<?php
session_start();
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');

if (isset($_SESSION['usuario_id'])) {
    # code...
    require_once root.'views/capturar_productos_view.php';
}else {
    # code...
    require_once root.'views/login_view.php';
}


