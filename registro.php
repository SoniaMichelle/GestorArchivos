<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Registro</title>
  <link rel="shortcut icon" href="img/usuario.jpg" type="image/x-icon">
  <link rel="stylesheet" href="librerias/jquery-ui-1.12.1/jquery-ui.css">
  <link rel="stylesheet" href="librerias/jquery-ui-1.12.1/jquery-ui.theme.css">
  <link rel="stylesheet" href="librerias/bootstrap4/bootstrap.min.css">
  <link rel="stylesheet" href="librerias/fontawesome/css/all.css">
  <link rel="stylesheet" href="css/estilo_registo.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <!--onsubmit: para que se pueda uasar el require_one de html5  -->
        <!--onsubmit: Ejecute un JavaScript cuando se envíe un formulario: -->
        <form class="shadow p-4 rounded-bottom fondo_formularios" id="frmRegistro" method="POST" onsubmit="return agregarUsuarioNuevo()">
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center">
                <h5>Registro</h5>
              </div>
            </div>
            <hr class="divisor_horizontal">
            <div class="row">
              <div class="col-md-6">
                <div class="container">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="nombres"><i class="fas fa-user mr-2"></i>Nombres(s)</label>
                        <!-- El required se le coloca a todos los campos para validar que no este vacios -->
                        <input type="text" class="form-control form-control-sm rounded-pill" id="nombres" name="nombres" placeholder="Ingresar nombres" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="apellido_paterno"><i class="far fa-user mr-2"></i>Apellido Paterno</label>
                        <input type="text" class="form-control form-control-sm rounded-pill" id="apellido_paterno" name="apellido_paterno" placeholder="Ingresar apellido paterno" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="apellido_materno"><i class="far fa-user mr-2"></i>Apellido Materno</label>
                        <input type="text" class="form-control form-control-sm rounded-pill" id="apellido_materno" name="apellido_materno" placeholder="Ingresar apellido materno" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="container">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="email"><i class="fas fa-user mr-2"></i>Usuario</label>
                        <input type="text" class="form-control form-control-sm rounded-pill" id="nombre_usuario" name="nombre_usuario" placeholder="Ingresar nombre usuario" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="email"><i class="far fa-envelope mr-2"></i>Email:</label>
                        <input type="text" class="form-control form-control-sm rounded-pill" id="email" name="email" placeholder="Ingresar email" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="contrasenia"><i class="fas fa-lock mr-2"></i>Contraseña:</label>
                        <input type="password" class="form-control form-control-sm rounded-pill" id="password" name="password" placeholder="Ingresar contraseña" required>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12 text-center">
                <button class="btn btn-sm rounded-pill botones" id="btn_registrar"><i class="far fa-check-circle mr-2"></i>Registrar</button>
              </div>
              <div class="col-md-12 text-center mt-3">
                <p>Ya tengo una cuenta
                  <a href="index.php" class="links"><strong>Iniciar Secion</strong></a>
                </p>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="librerias/jquery_3.4.1/jquery.js"></script>
  <script src="librerias/jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <script src="librerias/sweetalert.min.js"></script>
  <script type="text/javascript">
    function agregarUsuarioNuevo() {
      $.ajax({
        method: "POST",
        data: $('#frmRegistro').serialize(),
        url: "procesos/usuario/registro/agregarUsuario.php",
        success: function(respuesta) {
          respuesta = respuesta.trim();
          if (respuesta == 1) {
            swal("Exito!!!", "Se agrego nuevo usuario", "success");
          } else if (respuesta == 2) {
            swal("Alerta!!!", "Este usuario ya exite, agrega otro", "warning");
          } else {
            swal("Error!!!", "No se pudo agregar nuevo usuario", "error");
          }
        }
      });
      return false;
    }
  </script>
</body>

</html>