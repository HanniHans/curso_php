<?php
session_start();
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');

if (!isset($_SESSION['administrador']) && !isset($_SESSION['administrador'])) {
    echo "No estas logueado";
}else {
    require_once root.'models/categoria_model.php';
    $todas_las_categorias = get_all_categorias();
    require_once root.'models/marcas_model.php';
    $todas_las_marcas = get_all_marcas();
    require_once root.'models/tipos_de_venta_model.php';
    $todas_los_tipos_venta = get_all_tipos_venta();
    require_once root.'views/agregar_producto_view.php';

    if(isset($_POST['codigo_barras']) && isset($_POST['producto']) && isset($_POST['categoria']) && isset($_POST['marca']) && isset($_POST['tipo_venta']) && isset($_POST['precio_menudeo']) && isset($_POST['precio_mayoreo']) && isset($_POST['cantidad_mayoreo']) && isset($_POST['referencia_por_unidad']) && isset($_POST['descripcion'])){
        echo '<script>alert("hola")</script>';
        
    }

}