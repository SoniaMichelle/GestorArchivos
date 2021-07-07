<?php
/* Mandamos a llmar nuestra conexion de bd una sola vez */
  require_once "Conexion.php";

  /* Creamos la clase hija que va a heredar los atributos de la clase Padre */
  class Gestor extends Conectar{
    /* Creacion de la funcion donde se agregara el registro de archivo a la base de datos 
    y obtendra como parametro los datos*/
    public function agregaRegistroArchivo($datos){
      /* Mandamos a llamar a nuestra clase Conectar y le damos los parametros de la funcion conexion*/
      $conexion = Conectar::conexion();
      /* Creacion de variable donde se insertaran los nuevos registros en la tabla_archivos y se especifican
      los campos de la tabla */
      $sql = "INSERT INTO tabla_archivos (id_usuario,id_categoria,nombre_archivo,tipo_archivo,ruta_archivo) 
      /*El VALUEScomando especifica los valores de una instrucción INSERT INTO.*/
                          VALUES (?,?,?,?,?)";
      /* se crea y se envía a la base de datos. Algunos valores se dejan 
        sin especificar, llamados parámetros y representados por un interrogante "?" */
      $query = $conexion->prepare($sql);
      /* Agrega variables a una sentencia preparada como parámetros */
      /* Se le asignas las llaves a la variable datos */
      $query->bind_param("iisss",$datos['idUsuario'],
                                $datos['idCategoria'],
                                $datos['nombreArchivo'],
                                $datos['tipo'],
                                $datos['ruta']);
      $respuesta = $query->execute();
      $query->close();
      return $respuesta;
    }
    /* Funcion para obtener en nombre de archivo, se mandan a traer los datos de la base de datos*/
    public function obtenNombreArchivo($idArchivo){
      $conexion = Conectar::conexion();
      /* SELECT se utiliza para seleccionar datos de una o más tablas (nombre_archivo)
      from: de la tabla_archivos y solo va a extraer en campo id_archivo*/
      $sql = "SELECT nombre_archivo FROM tabla_archivos WHERE id_archivo = '$idArchivo'";
      $result = mysqli_query($conexion, $sql);
      /* Se entrega por medio de un array todos los resultados */
      return mysqli_fetch_array($result)['nombre_archivo'];
    }
    /* Se crea la funcion eliminar */
    public function eliminarRegistroArchivo($idArchivo){
      $conexion = Conectar::conexion();
      /* Se eliminar registros existentes de la tabla_archivo */
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
          case 'JPG':
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