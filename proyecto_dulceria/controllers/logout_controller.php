<?php
//Iniciar una nueva sesión o reanudar la existente
session_start();
//Libera todas las variables de sesión
session_unset();
//destruye toda la información asociada con la sesión actual
session_destroy();

header("Location: ../index.php");