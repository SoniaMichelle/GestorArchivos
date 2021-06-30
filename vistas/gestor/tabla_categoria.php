  <?php
  /*  Mantiene una sesion viva de existir alguna 
(esto solo pasa en los documentos que visitas despues de que ya iniciaste la sesion) */
  session_start();
  require_once "../../clases/Conexion.php";
  /**
   * - isset -> es el metodo que evalua
   * - $_SESSION -> objeto arreglo global de php exclusiva pasa sesiones de usuario en el navegador/sistema
   * - 'idUsuario' -> es la llave que buscamos para el valor especifico dentro de session
   */
  $idUsuario = $_SESSION['idUsuario'];
  /* Manda a llamar al contructor conexion, que es donde se aloja la conexion de la bd */
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
            /* Se selecciona los campos de la tabla_categoria con respecto al id_usuario  */
            $sql = "SELECT id_categoria,nombre_categoria FROM tabla_categoria WHERE id_usuario = '$idUsuario'";
            /* Realiza una consulta dada por query a la base de datos. */
            $result = mysqli_query($conexion, $sql);
            /* Retorna un array que corresponde a la fila obtenida o null si es que 
							no hay más filas en el resultset representado por el parámetro result. */
            while ($mostrar = mysqli_fetch_array($result)) { 
              $idCategoria = $mostrar['id_categoria'];
            ?>
              <tr>
              <!-- echo:Muestra todos los parámetros -->
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