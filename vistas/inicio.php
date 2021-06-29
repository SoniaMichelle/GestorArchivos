<?php
session_start();

if (isset($_SESSION['usuario'])) {
  include('header.php');
?>
  <div class="container mt-5">
    <div class="row">
      <div class="col text-center">
        <div class="jumbotron jumbotron-fluid">
          <div class="container">
            <h1 class="display-4">Bienvenido al Gestor de archvivos</h1>
            <div class="col mt-5">
              <button class="btn btn-dark"><a class="nav-link" style="color:aliceblue" href="categorias.php" class="btn" id="cuenta"><i class="fas fa-file-alt mr-2"></i>Categorias</a></button>
              <button class="btn btn-dark"><a class="nav-link" style="color:aliceblue" href="gestor.php" id="producto"><i class="fas fa-folder-open mr-2"></i>Administrar</a></button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
<?php
  include('footer.php');
} else {
  header("location:../index.php");
}
?>