<?php

  require_once "Conexion.php";

  class Gestor extends Conectar{
    public function agregaRegistroArchivo($datos){
      $conexion = Conectar::conexion();
      $sql = "INSERT INTO tabla_archivos (id_usuario,id_categoria,nombre_archivo,tipo_archivo,ruta_archivo) 
                          VALUES (?,?,?,?,?)";

      $query = $conexion->prepare($sql);
      $query->bind_param("iisss",$datos['idUsuario'],
                                $datos['idCategoria'],
                                $datos['nombreArchivo'],
                                $datos['tipo'],
                                $datos['ruta']);
      $respuesta = $query->execute();
      $query->close();
      return $respuesta;
    }

    public function obtenNombreArchivo($idArchivo){
      $conexion = Conectar::conexion();
      $sql = "SELECT nombre_archivo FROM tabla_archivos WHERE id_archivo = '$idArchivo'";
      $result = mysqli_query($conexion, $sql);
      return mysqli_fetch_array($result)['nombre_archivo'];
    }

    public function eliminarRegistroArchivo($idArchivo){
      $conexion = Conectar::conexion();
      $sql = "DELETE FROM tabla_archivos WHERE id_archivo = ?";
      $query = $conexion -> prepare($sql);
      $query -> bind_param('i', $idArchivo);
      $respuesta = $query->execute();
      $query->close();
      return $respuesta;
    }

    public function obtenerRutaArchivo($idArchivo){
      $conexion = Conectar::conexion();

      $sql = "SELECT nombre_archivo,tipo_archivo FROM tabla_archivos WHERE id_archivo = '$idArchivo'";
      $result = mysqli_query($conexion, $sql);

      $datos = mysqli_fetch_array($result);
      $nombreArchivo = $datos['nombre_archivo'];
      $extension = $datos['tipo_archivo'];
      return self::tipoArchivo($nombreArchivo, $extension);
    }
    public function tipoArchivo($nombre, $extension){
      $NomUsuario = $_SESSION['usuario'];
      $ruta = "../archivos/".$NomUsuario."/".$nombre;
      /* SWITCH PARA MOSTRAR EL TIPO DE DATOS */
      switch ($extension) {
        case 'png':
          return '<img src = "'.$ruta.'" width = "100%">';
          break;
        case 'jpg':
          return '<img src = "'.$ruta.'" width = "100%">';
          break;
        case 'pdf':
          return '<embed src="'.$ruta.'#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="450px" />';
          break;  
        case 'gif':
          return '<img src = "'.$ruta.'" width = "100%">';
          break;
        case 'mp3':
          return '<audio src="'.$ruta.'" controls width = "100%"></audio>';
          break;
        case 'mp4':
          return '<video src="'.$ruta.'" controls width="100%" height="450px" ></video>';
          break;

        default:
          
          break;
      }

    }
  }
?>