<?php
session_start();
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');

if (!isset($_SESSION['administrador'])) {
    echo "No estas logueado";
}else {
    require_once root.'models/categoria_model.php';
    $todas_las_categorias = get_all_categorias();
    require_once root.'models/marcas_model.php';
    $todas_las_marcas = get_all_marcas();
    require_once root.'models/tipos_de_venta_model.php';
    $todas_los_tipos_venta = get_all_tipos_venta();
    require_once root.'models/unidades_de_medida_model.php';
    $todas_las_unidades_de_medida = get_all_unidades_de_medidad();
    
    require_once root.'views/agregar_producto_view.php';
    
/*
    if(!isset($_POST['codigo_barras']) && !isset($_POST['producto']) && !isset($_POST['categoria']) && !isset($_POST['marca']) && !isset($_POST['tipo_venta']) && !isset($_POST['precio_menudeo']) && !isset($_POST['precio_mayoreo']) && !isset($_POST['cantidad_mayoreo']) && !isset($_POST['referencia_por_unidad']) && !isset($_POST['descripcion']) && !isset($_POST['unidad_de_medida'])){
        echo '<script>alert("Alguna variables no esta seteada")</script>';    
    }else {
        if(empty($_POST['codigo_barras']) || empty($_POST['producto']) || empty($_POST['categoria']) || empty($_POST['marca']) || empty($_POST['tipo_venta']) || empty($_POST['precio_menudeo']) || empty($_POST['precio_mayoreo']) || empty($_POST['cantidad_mayoreo']) || empty($_POST['referencia_por_unidad']) || empty($_POST['descripcion']) || empty($_POST['unidad_de_medida'])){
            echo '<script>alert("Alguna variable esta vacia :c")</script>';  
        }else {
            if(strlen($_POST['codigo_barras'])!=13){
                echo '<script>alert("Tu codigo de barras esta mal :c")</script>';
            }else {
                if (!is_numeric($_POST['categoria']) || !is_numeric($_POST['marca']) || !is_numeric($_POST['tipo_venta']) || !is_numeric($_POST['precio_menudeo']) || !is_numeric($_POST['precio_mayoreo']) || !is_numeric($_POST['cantidad_mayoreo']) || !is_numeric($_POST['referencia_por_unidad'])) {
                    echo '<script>alert("NO Es númerico")</script>';
                }else {
                    $categoria_por_id = get_categoria_by_id($_POST['categoria']);
                    $marca_por_id = get_marca_by_id($_POST['marca']);
                    $tipo_venta_por_id = get_tipo_venta_by_id($_POST['tipo_venta']);
                    $unidad_de_medidad_por_id =get_unidad_de_medidad_by_id($_POST['unidad_de_medida']);
                    if (empty($categoria_por_id) || empty($marca_por_id) || empty($tipo_venta_por_id) || empty($unidad_de_medidad_por_id)) {
                        echo '<script>alert("Hubo un problema al agregar :c")</script>';
                    }else {
                        require_once root.'models/productos_model.php';
                        $producto_por_codigo_de_barras = get_producto_by_codigo_de_barras($_POST['codigo_barras']);
                        echo $producto_por_codigo_de_barras;
                        // if (!empty($producto_por_codigo_de_barras)) {
                        //     echo '<script>alert("El productos ya existe")</script>';
                        // }else {
                        //     echo '<script>alert("todo bie :")</script>';
                        // }
                    }
                }
                
                
            }
        }
    }
*/
    

}