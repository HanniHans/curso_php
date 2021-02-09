<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if (!isset($_SESSION['administrador']) && !isset($_SESSION['administrador'])) {
            echo "no estas logueado";  
        }else {?>
            <h1>Agregar Productos</h1>
            <form action="../controllers/insertar_producto_controller.php" method="post">
                <label for="codigo_barras">Codigo de Barras</label>
                <input type="text" name="codigo_barras"><br>
                <label for="">Producto</label>
                <input type="text" name="producto"><br>
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
                <input type="text" name="precio_menudeo"><br>
                <label for="precio_mayoreo">Precio Mayoreo</label>
                <input type="text" name="precio_mayoreo"><br>
                <label for="cantidad_mayoreo">Cantidad Mayoreo</label>
                <input type="text" name="cantidad_mayoreo"><br>
                <label for="referencia_por_unidad">Referencia precio unidad</label>
                <input type="text" name="referencia_por_unidad"><br>
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion"><br>
                <button>Agregar</button>
            </form>
    <?php 
        }?>
    
</body>
</html>