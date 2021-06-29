  <?php
  session_start();
  require_once "../../clases/Conexion.php";
  $idUsuario = $_SESSION['idUsuario'];
  $conexion = new Conectar();
  $conexion = $conexion->conexion();
  
  ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <table class="table table-hover" id="tablaCategorias1">
          <thead class="thead-dark">
            <tr>
              <th>Id</th>
              <th>Nombre Categoria</th>
              <th>Editar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT id_categoria,nombre_categoria FROM tabla_categoria WHERE id_usuario = '$idUsuario'";
            $result = mysqli_query($conexion, $sql);

            while ($mostrar = mysqli_fetch_array($result)) {
              $idCategoria = $mostrar['id_categoria'];
            ?>
              <tr>
                <td><?php echo $idCategoria ?></td>
                <td><?php echo $mostrar['nombre_categoria'] ?></td>
                <td>
                  <span onclick="obtenerDatosCategoria('<?php echo $idCategoria ?>')" data-toggle="modal" data-target="#modal_update">
                  <i class="fas fa-edit"></i></span>
                </td>
                <td>
                  <span onclick="eliminarCategoria('<?php echo $idCategoria ?>')">
                  <i class="fas fa-trash"></i></span>
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
      $('#tablaCategorias1').DataTable();
    });
  </script>