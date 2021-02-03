

<?php
    require_once './models/productos_model.php';
    $productos = get_all_productos();

    require_once './views/productos_view.php';
?>