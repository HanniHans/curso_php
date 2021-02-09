<?php
session_start();
$correo = $_POST['email'];
$contrasena = $_POST['password'];

echo $correo;
echo '<br>';
echo $contrasena;
define('root', $_SERVER['DOCUMENT_ROOT'] . '/curso_php/proyecto_dulceria/');
if(isset($_SESSION['usuario_id'])){
    echo "ya iniciaste sesion";
    echo '<br>';
}else {
    if(!isset($correo) && !isset($contrasena)){
        echo "variable no esta seteada";
        echo '<br>';  
    }else{
        echo "variable seteada";
        echo '<br>';
        if (empty($correo) || empty($contrasena)) {
            echo "esta vacio";
            echo '<br>';
        }else{
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                # code...
                echo "no ingresaste un correo";
                echo '<br>';
            }else{
                echo "se valido correo";
                echo '<br>';
                require_once root.'models/usuarios_model.php';
                $usuario_por_correo = get_usuario_by_correo($correo);
                print_r($usuario_por_correo);
                echo '<br>';
                if (empty($usuario_por_correo)) {
                    # code...
                    echo "el usuario no existe";
                    echo '<br>';
                }else{
                    echo "el usuario existe";
                    echo '<br>';
                    if (md5($contrasena) !== $usuario_por_correo['contrasena']) {
                        echo "la contraseña no coinciden :c";
                        echo '<br>';
                    }else {
                        echo "las contraseñas coinciden";
                        $_SESSION['usuario_id']=$usuario_por_correo['id'];
                        if ($usuario_por_correo['tipo_de_usuario_id']==1) {
                            $_SESSION['administrador']=$usuario_por_correo['id'];
                        }
                        header("Location: ../index.php");
                    }
                }
                
            }
        }
        
    }

}