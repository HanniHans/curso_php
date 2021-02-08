<?php
session_start();
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');

if (!isset($_SESSION['administrador']) && !isset($_SESSION['administrador'])) {
    echo "No estas logueado";
}else {
    //require_once root.'views/agregar_producto_view.php';
    
    echo $_POST['codigo_barras'];
    $codigo_de_barras = $_POST['codigo_barras'];


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
                    require_once root.'models/productos_model.php';
                    $productos_por_codigo_de_barras = get_producto_by_codigo_de_barras($_POST['codigo_barras']);
                    if (!empty($productos_por_codigo_de_barras)) {
                        echo "El producto  existe";
                    }else {
                        require_once root.'models/categoria_model.php';
                        $categoria_por_id = get_categoria_by_id($_POST['categoria']);
                        require_once root.'models/marcas_model.php';
                        $marca_por_id = get_marca_by_id($_POST['marca']);
                        require_once root.'models/tipos_de_venta_model.php';
                        $tipo_venta_por_id = get_tipo_venta_by_id($_POST['tipo_venta']);
                        require_once root.'models/unidades_de_medida_model.php';
                        $unidad_de_medidad_por_id =get_unidad_de_medidad_by_id($_POST['unidad_de_medida']);

                        if (empty($categoria_por_id) || empty($marca_por_id) || empty($tipo_venta_por_id) || empty($unidad_de_medidad_por_id)) {
                            echo '<script>alert("Hubo un problema al agregar :c")</script>';
                        }else {
                            date_default_timezone_set('America/Mexico_City');
                            $created_at = date("y-m-d H:i:s");
                            $insertar_nuevo_producto = insert_producto($_POST['marca'], $_POST['unidad_de_medida'], $_POST['categoria'], $_POST['tipo_venta'], $_POST['producto'], $_POST['codigo_barras'], $_POST['precio_menudeo'], $_POST['precio_mayoreo'], $_POST['cantidad_mayoreo'], $_POST['referencia_por_unidad'], $_POST['descripcion'], $created_at);
                            if ($insertar_nuevo_producto==FALSE) {
                                echo "Hubo un error al insertar le producto :c";
                            }else {
                                echo '<h1>Tu Producto se ha insertado Correctamente</h1>';
                            }
                            
                        }
                    }
                }
                
                
            }
        }
    }
    

}