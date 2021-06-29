<?php
session_start();
require_once "../../clases/Conexion.php";
$c = new Conectar();
$conexion = $c->conexion();
$idUsuario = $_SESSION['idUsuario'];
$NomUsuario = $_SESSION['usuario'];

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
          while ($mostrar = mysqli_fetch_array($result)) {
            $rutaDescarga = "../archivos/" . $NomUsuario . "/" . $mostrar['nombreArchivo'];
            $nombreArchivo = $mostrar['nombreArchivo'];
            $idArchivo = $mostrar['idArchivo'];
          ?>
            <tr>
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
                for ($i = 0; $i < count($extensionesValidas); $i++) {
                  if ($extensionesValidas[$i] == $mostrar['tipoArchivo']) {
                ?>
                    <span data-toggle="modal" data-target="#visualizarArchivo" onclick="obtenerArchivoPorId(<?php echo $idArchivo ?>)">
                      <i class="fas fa-eye"></i></span>
                <?php
                  }
                }
                ?>
              </td>
              <td>
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

<script type="text/javascript">
  $(document).ready(function() {
    $('#tablaArchivos').DataTable();
  });
</script>