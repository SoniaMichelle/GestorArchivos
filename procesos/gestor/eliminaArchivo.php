<?php

  session_start();
  require_once "../../clases/Gestor.php";
  $Gestor = new Gestor();
  $idArchivo = $_POST['idArchivo'];
  $nombreArchivo = $Gestor->obtenNombreArchivo($idArchivo);
  $NomUsuario = $_SESSION['usuario'];

  $rutaEliminar = "../../archivos/".$NomUsuario."/".$nombreArchivo;

  if(unlink($rutaEliminar)){
      echo $Gestor-> eliminarRegistroArchivo($idArchivo);
  }else{
    echo 0;
  }
?>