<?php
session_start();

if (isset($_SESSION['usuario'])) {
  include('header.php');
?>
  <div class="container mt-5">
    <div class="row mt-5">
      <div class="col mt-5">
        <div class="jumbotron jumbotron-fluid">
          <div class="container">
            <h1 class="display-4 text-center">Gestor archivos</h1>
            <div class="row text-center">
              <div class="col ">
                <span class="btn btn-outline-primary btn-lg mr-2" data-toggle="modal" data-target="#modal_insert">
                  <!-- Se agrega informacion del trigger propio del modal_insert -->
                  <i class="fas fa-plus"></i>
                  Nueva Categoria
                </span><!--  -->
              </div>
            </div>
            <div id="tablaCategorias"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nueva Categoría</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- construccion del formulario de datos para agregar un nuevo estudiante -->
          <form id="frmCategorias">
            <label>Nombre de la Categoría</label>
            <input type="text" class="form-control" id="nombreCategoria" name="nombreCategoria">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-outline-primary" id="btnGuardarCategoria">Crear Categoria</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Actualizar Categoría</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- construccion del formulario de datos para agregar un nuevo estudiante -->
          <form id="frmActualizaCategoria">
            <input type="text" id="idCategoria" name="idCategoria" hidden="true" class="form-control">
            <label>Nombre de la Categoría</label>
            <input type="text" class="form-control" id="categoriaU" name="categoriaU">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-outline-primary" id="btnActualizaCategoria" onclick="actualizaCategoria()">Actualizar</button>
        </div>
      </div>
    </div>
  </div>
  <?php
  include('footer.php');
  ?>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#tablaCategorias').load("gestor/tabla_categoria.php");
      $('#btnGuardarCategoria').click(function() {
        var categoria = $('#nombreCategoria').val();
        if (categoria == "") {
          swal("Alerta!!!", "Debes de ingresar el nombre", "warning");
          return false;
        } else {
          $.ajax({
            type: "POST",
            data: "categoria=" + categoria,
            url: "../procesos/categorias/agregarCategoria.php",
            success: function(respuesta) {
              respuesta = respuesta.trim();
              if (respuesta == 1) {
                $('#nombreCategoria').val("");
                $('#tablaCategorias').load("gestor/tabla_categoria.php");
                swal("Exito!!!", "Se agrego nueva categoria", "success");
              } else {
                swal("Error!!!", "Fallo al agregar...", "error");
              }
            }
          });
        }
      });
    });
  </script>
<?php

} else {
  header("location:../index.php");
}
?>