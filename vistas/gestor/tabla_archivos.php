<?php
/*  Mantiene una sesion viva de existir alguna 
(esto solo pasa en los documentos que visitas despues de que ya iniciaste la sesion) */
session_start();
/* Mandamos a llamar a nuestra conexion a la bd una sola vez */
require_once "../../clases/Conexion.php";
/* Manda a llamar al contructor conexion, que es donde se aloja la conexion de la bd */
$c = new Conectar();
$conexion = $c->conexion();
/**
   * - isset -> es el metodo que evalua
   * - $_SESSION -> objeto arreglo global de php exclusiva pasa sesiones de usuario en el navegador/sistema
   * - 'idUsuario', 'usuario' -> es la llave que buscamos para el valor especifico dentro de session
   */
$idUsuario = $_SESSION['idUsuario'];
$NomUsuario = $_SESSION['usuario'];

/* Se selecciona los campos */
$sql = "SELECT 
    archivos.id_archivo as idArchivo,
    usuario.nombre as nombreUsuario,
    categorias.nombre_categoria as nombreCategoria,
    archivos.nombre_archivo as nombreArchivo,
    archivos.tipo_archivo as tipoArchivo,
    archivos.ruta_archivo as rutaArchivo
FROM
    tabla_archivos AS archivos
        INNER JOIN
    registro_usuario AS usuario ON archivos.id_usuario = usuario.id_usuario
        INNER JOIN
    tabla_categoria AS categorias ON archivos.id_categoria = categorias.id_categoria
        AND archivos.id_usuario = '$idUsuario';";
$result = mysqli_query($conexion, $sql);
?>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <table class="table table-hover" id="tablaArchivos">
        <thead class="thead-dark " >
          <tr>
            <th>Id</th>
            <th>Nombre Categoria</th>
            <th>Nombre de Archivo</th>
            <th>Extension de Archivo</th>
            <th>Descargar</th>
            <th>Visualizar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Arreglo de extensione validas
          $extensionesValidas = array('png', 'jpg', 'pdf', 'gif', 'mp3', 'mp4');
          /* Retorna un array que corresponde a la fila obtenida o null si es que 
						no hay más filas en el resultset representado por el parámetro result. */
          while ($mostrar = mysqli_fetch_array($result)) {
          /* CREACION DE VARIABLES PARA LA FUNCION DE LOS BOTONES */
            $rutaDescarga = "../archivos/" . $NomUsuario . "/" . $mostrar['nombreArchivo'];
            $nombreArchivo = $mostrar['nombreArchivo'];
            $idArchivo = $mostrar['idArchivo'];
          ?>
            <tr>
            <!-- Se muestra en la tabla los datos traidos de la bd -->
              <td><?php echo $mostrar['idArchivo']; ?></td>
              <td><?php echo $mostrar['nombreCategoria']; ?></td>
              <td><?php echo $mostrar['nombreArchivo']; ?></td>
              <td><?php echo $mostrar['tipoArchivo']; ?></td>
              <td>
                <a style="color:black" href="<?php echo $rutaDescarga; ?>" download="<?php echo $nombreArchivo; ?>">
                  <span><i class="fas fa-download"></i></span></a>
              </td>
              <td>
                <?php
                /* Recorre los tipos de extenciones y verifica que esten correctos o que exitan en la variabla
                si se encuentra en las extenciones selañadas se mostara el tipo de archivo  */
                for ($i = 0; $i < count($extensionesValidas); $i++) {
                  if ($extensionesValidas[$i] == $mostrar['tipoArchivo']) {
                ?>
                <!-- Con este boton se guardaran los archivos tanto en la bd y en la tabla -->
                    <span data-toggle="modal" data-target="#visualizarArchivo" onclick="obtenerArchivoPorId(<?php echo $idArchivo ?>)">
                      <i class="fas fa-eye"></i></span>
                <?php
                  }
                }
                ?>
              </td>
              <td>
              <!-- Boton que limina el archivo de la bd y la tabla de la interfaz -->
                <span onclick="eliminarArchivo('<?php echo $idArchivo ?>')">
                  <i class="fa fa-trash"></i></span>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Complemento de la tabla -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#tablaArchivos').DataTable();
  });
</script>