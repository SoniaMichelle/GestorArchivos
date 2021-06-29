<?php

  session_start();
  require_once "../../clases/Gestor.php";
  $Gestor = new Gestor();
  $idCategoria = $_POST['categoriasArchivos'];
  $idUsuario = $_SESSION['idUsuario'];
  $NomUsuario = $_SESSION['usuario'];

  if ($_FILES['archivos']['size'] > 0) {
      /* SE IRA A LA CARPTEA DEL USUARIO */
    $carpetaUsuario = '../../archivos/'.$NomUsuario;

    if (!file_exists($carpetaUsuario)) {
      mkdir($carpetaUsuario, 0777, true);
    }
    $totalArchivos = count($_FILES['archivos']['name']);
    for ($i=0; $i < $totalArchivos; $i++) { 
        $nombreArchivo = $_FILES['archivos']['name'][$i];
        $explode = explode('.', $nombreArchivo);
        $tipoArchivo = array_pop($explode);
        $rutaAlmacenamiento = $_FILES['archivos']['tmp_name'][$i];
        $rutaFinal = $carpetaUsuario. "/" .$nombreArchivo;

        $datosRegistroArchivos = array(
                                  "idUsuario" => $idUsuario ,
                                  "idCategoria" => $idCategoria ,
                                  "nombreArchivo" => $nombreArchivo,
                                  "tipo" => $tipoArchivo,
                                  "ruta" => $rutaFinal
                                  );

        if (move_uploaded_file($rutaAlmacenamiento,$rutaFinal)) {
          $respuesta = $Gestor->agregaRegistroArchivo($datosRegistroArchivos);
        }
        
    }
    echo $respuesta;
  }else{
    echo 0;
  }

?>