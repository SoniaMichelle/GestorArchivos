<?php

  require_once "../../../clases/Usuario.php";
  
  $password = sha1($_POST['password']);
  $datos = array(
                  "nombre" =>$_POST['nombres'], 
                  "paterno" => $_POST['apellido_paterno'],
                  "materno" => $_POST['apellido_materno'],
                  "usuario" => $_POST['nombre_usuario'],
                  "email" => $_POST['email'],
                  "password" => $password
            );

  $usuario = new Usuario();
  echo $usuario -> agregarUsuario($datos);
?>