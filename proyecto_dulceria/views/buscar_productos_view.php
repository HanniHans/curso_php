<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Productos</title>
</head>

<body>
    <nav>
        <?php
        if (isset($_SESSION['usuario_id'])) {
        ?>
            <a href="../index.php">Capturar Productos</a> |
            <a href="../controllers/buscar_productos_controller.php">Buscar Productos</a> |
            <a href="../controllers/ventas_controller.php">Ventas</a> |
            <a href="../controllers/logout_controller.php">Cerrar Sesión</a>
        <?php
        }
        ?>
    </nav>

    <?php
    if (!isset($_SESSION['usuario_id'])) {
        echo "no estas conectado";
    } else {
    ?>
        <h1>Buscar productos</h1>
        <?php if (isset($_SESSION['administrador'])) { ?>
            <button>
                <a href="../controllers/buscar_productos_controllers/agregar_producto_controller.php">Agregar Producto</a>
            </button>
        <?php } ?>
        <form action="../controllers/buscar_productos_controllers/buscar_producto_por_codigo_de_barras.php" method="post">
            <label for="codigo_de_barras">Codigo de barras: </label>
            <input type="text" name="codigo_de_barras">
            <button type="submit">Buscar</button>
        </form>
        <form action="../controllers/buscar_productos_controllers/buscar_producto_por_categoria_controller.php" method="post">
            <?php
            if (!empty($todas_las_categorias)) { ?>
                <label for="categoria">Categoria: </label>
                <select name="categoria">
                    <?php foreach ($todas_las_categorias as $categoria) { ?>
                        <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></option>
                    <?php } ?>
                </select>
                <button type="submit">Buscar</button>

            <?php
            } ?>

        </form>
        <form action="../controllers/buscar_productos_controllers/obtener_todos_los_productos.php" method="post">
            <button type="submit">Todos los productos</button>
        </form>

        <br>
        <?php if (isset($_SESSION['productos_buscados']) && !empty($_SESSION['productos_buscados'])) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Codigo de barras</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Precio Mayoreo</th>
                        <th>Unidad de Medida</th>
                        <th>Categoria</th>
                        <th>Descripcion</th>
                        <?php if (isset($_SESSION['administrador'])) { ?>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['productos_buscados'] as $producto_buscado) { ?>
                        <tr>
                            <td><?php echo $producto_buscado['codigo_de_barras']; ?></td>
                            <td><?php echo $producto_buscado['producto']; ?></td>
                            <td><?php echo $producto_buscado['precio_menudeo']; ?></td>
                            <td><?php echo $producto_buscado['precio_mayoreo']; ?></td>
                            <td><?php echo $producto_buscado['unidad_de_medida']; ?></td>
                            <td><?php echo $producto_buscado['categoria']; ?></td>
                            <td><?php echo $producto_buscado['descripcion']; ?></td>
                            <?php if (isset($_SESSION['administrador'])) { ?>
                                <td><a href="../controllers/buscar_productos_controllers/modificar_producto_controller.php?producto_id=<?php echo $producto_buscado['id']; ?>">Modificar<?php?></a></td>
                                <td><a href="../controllers/buscar_productos_controllers/eliminar_producto_controller.php?producto_id=<?php echo $producto_buscado['id']; ?>">Eliminar<?php?></a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
    <?php
        } else {
            echo "no hay productos";
        }
    }
    ?>



</body>

</html>