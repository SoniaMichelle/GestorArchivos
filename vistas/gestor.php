<?php
session_start();
if (isset($_SESSION['usuario'])) {
  include('header.php');
?>
  <div class="container mt-5">
    <div class="row mt-5">
      <div class="col">
        <div class="jumbotron jumbotron-fluid">
          <div class="container">
            <h1 class="display-4 text-center">Gestor archivos</h1>
            <div class="row text-center">
              <div class="col">
                <span class="btn btn-outline-primary btn-lg mr-2" data-toggle="modal" data-target="#modal_agregar">
                  <!-- Se agrega informacion del trigger propio del modal_insert -->
                  <i class="fas fa-folder-plus mr-2"></i>
                  Agregar Archivos
                </span><!--  -->
              </div>
            </div>
            <div id="datos_de_tabla"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal_agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar archivos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- construccion del formulario de datos para agregar un nuevo estudiante -->
          <form id="frmArchivos" enctype="multipart/form-data" method="post">
            <input type="text" id="idCategoria" name="idCategoria" hidden="true" class="form-control">
            <label>Nombre de la Categoría</label>
            <div id="categoriasLoad"></div>
            <label>Selecciona Archivos</label>
            <!-- VECTOR PARA GUARDAR VARIOS ARCHIVOS -->
            <input type="file" name="archivos[]" id="archivos[]" class="form-control" multiple="">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-outline-primary" id="btnGuardarArchivos" onclick="guardarArchivos()">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="visualizarArchivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Visor de Archivos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- construccion del formulario de datos para agregar una nuevo archivo -->
          <div id="archivoObtenido"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <?php include('footer.php'); ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#datos_de_tabla').load("gestor/tabla_archivos.php");
      $('#categoriasLoad').load("gestor/selectCategorias.php");

    });
  </script>
<?php
} else {
  header("location:../index.php");
}
?>