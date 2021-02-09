<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modficar</title>
</head>
<body>
    <?php
        if (!isset($_SESSION['administrador'])) {
            echo "no eres Administrador";  
        }else {?>
            <h1>Modificar Producto <?php echo $producto_by_id['producto']?></h1>
            <form action="../buscar_productos_controllers/cambiar_producto_controller.php" method="post">
                <input type="hidden" name="id" value="<?php echo $producto_by_id['id'];?>"><br>
                <label for="codigo_barras" >Codigo de Barras</label>
                <input type="text" name="codigo_barras" value="<?php echo $producto_by_id['codigo_de_barras'];?>"><br>
                <label for="">Producto</label>
                <input type="text" name="producto" value="<?php echo $producto_by_id['producto'];?>"><br>
                <label for="categoria">Categorias</label>
                <select name="categoria">
                    <?php
                        foreach ($todas_las_categorias as $categoria) {
                    ?>
                            <option value="<?php echo $categoria['id']?>"><?php echo $categoria['categoria']?></option>
                    <?php
                        }
                    ?>
                </select> <br>
                <label for="marca">Marcas</label>
                <select name="marca">
                    <?php
                        foreach ($todas_las_marcas as $marca) {
                    ?>
                            <option value="<?php echo $marca['id']?>"><?php echo $marca['marca']?></option>
                    <?php
                        }
                    ?>
                </select> <br>
                <label for="tipo_venta">Tipo de venta</label>
                <select name="tipo_venta">
                    <?php
                        foreach ($todas_los_tipos_venta as $tipo_venta) {
                    ?>
                            <option value="<?php echo $tipo_venta['id']?>"><?php echo $tipo_venta['tipo']?></option>
                    <?php
                        }
                    ?>
                </select> <br>
                <label for="unidad_de_medida">Unidad de Medida</label>
                
                <select name="unidad_de_medida">
                    <?php
                        foreach ($todas_las_unidades_de_medida as $unidad_medida) {
                    ?>
                            <option value="<?php echo $unidad_medida['id']?>"><?php echo $unidad_medida['unidad_de_medida']?></option>
                    <?php
                        }
                    ?>
                </select> <br>
                <label for="precio_menudeo">Precio Menudeo</label>
                <input type="text" name="precio_menudeo" value="<?php echo $producto_by_id['precio_menudeo'];?>"><br>
                <label for="precio_mayoreo">Precio Mayoreo</label>
                <input type="text" name="precio_mayoreo" value="<?php echo $producto_by_id['precio_mayoreo'];?>"><br>
                <label for="cantidad_mayoreo">Cantidad Mayoreo</label>
                <input type="text" name="cantidad_mayoreo" value="<?php echo $producto_by_id['cantidad_mayoreo'];?>"><br>
                <label for="referencia_por_unidad">Referencia precio unidad</label>
                <input type="text" name="referencia_por_unidad" value="<?php echo $producto_by_id['referencia_por_unidad'];?>"><br>
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" value="<?php echo $producto_by_id['descripcion'];?>"><br>
                <button>Agregar</button>
            </form>
    <?php 
        }?>
    
</body>
</html>