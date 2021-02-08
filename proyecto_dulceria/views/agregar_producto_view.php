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
            <form action="../controllers/agregar_producto_controller.php" method="post">
                <table>
                    <thead>
                        <tr>
                            <th>Codigoo de Barras</th>
                            <th>Producto</th>
                            <th>Categorias</th>
                            <th>Marca</th>
                            <th>Tipo de Venta</th>
                            <th>Precio Menudeo</th>
                            <th>Precio Mayoreo</th>
                            <th>Cantidad Mayoreo</th>
                            <th>Referencia_por unidad</th>
                            <th>Descripcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="codigo_barras"></td>
                            <td><input type="text" name="producto" id=""></td>
                            <td>
                                <select name="categoria">
                                    <?php
                                        foreach ($todas_las_categorias as $categoria) {
                                    ?>
                                            <option value="<?php echo $categoria['id']?>"><?php echo $categoria['categoria']?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="marca">
                                    <?php
                                        foreach ($todas_las_marcas as $marca) {
                                    ?>
                                            <option value="<?php echo $marca['id']?>"><?php echo $marca['marca']?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="tipo_venta">
                                    <?php
                                        foreach ($todas_los_tipos_venta as $tipo_venta) {
                                    ?>
                                            <option value="<?php echo $tipo_venta['id']?>"><?php echo $tipo_venta['tipo']?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </td>
                            <td><input type="text" name="precio_menudeo" id=""></td>
                            <td><input type="text" name="precio_mayoreo" id=""></td>
                            <td><input type="text" name="cantidad_mayoreo" id=""></td>
                            <td><input type="text" name="referencia_por_unidad" id=""></td>
                            <td><input type="text" name="descripcion" ></td>

                        </tr>
                    </tbody>
                </table>
                <button>Agregar</button>
            </form>
    <?php 
        }?>
    
</body>
</html>