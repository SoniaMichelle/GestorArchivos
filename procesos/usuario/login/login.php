<?php
  
  session_start();
  require_once "../../../clases/Usuario.php";

  $usuario = $_POST['login'];
  $password = sha1($_POST['password']);

  $usuarioObj = new Usuario();
  /* SE INICIA LE SECION SI EL USUARIO SE LOGUEA EXITOSAMENTE */
  echo $usuarioObj->login($usuario,$password);

?>