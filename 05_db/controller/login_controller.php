<?php
//Iniciar una nueva sesión o reanudar la existente
session_start();

$correo = $_POST['email'];
$contrasena = $_POST['password'];

//$_SERVER es un array que contiene información, tales como cabeceras, rutas y ubicaciones de script
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/05_db/');

    if(isset($_SESSION['usuario_id'])){
        echo "ya estas logueado";
    }else{
        if(empty($correo) || empty($contrasena)){
            echo "no se recibieron los datos";
        }else {
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                //echo "Esta dirección de correo ($correo) es válida.";     
                require_once root.'models/usuarios_model.php';
                $usuario = get_usuario_by_correo($correo);
                if (empty($usuario)) {
                    # code...
                    echo "el usuario no existe";
                }else{
                    // echo "usuario:"."<br>";
                    //print_r($usuario);
                    //echo "<br>".$usuario['contrasena'];
                    if(md5($contrasena)!==$usuario['contrasena']){
                        echo "La contraseña no coinside :c";
                    }else {
                        # code...
                        //echo "las contraseñas son iguales";
                        //$_SESSION es un array super-global, con los datos almacenados en dicho fichero de sesión.
                        $_SESSION['usuario_id']=$usuario['id'];
                        header("Location: ../index.php");
                    }
                }
            }else{
                echo "el correo no es valido";
            }    
        }

    }