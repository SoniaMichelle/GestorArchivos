<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
   <title>Login</title>
   <link rel="stylesheet" href="css/estilos.css">
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="librerias/fontawesome/css/all.css">
   <link rel="stylesheet" href="librerias/bootstrap4/bootstrap.min.css">
</head>

<body >
<section class="contenedor">
        <!--Pagina Principal, donde se encuentra la imagen de fondo---------->
        <div class="pagina-principal">
            <!--Titulo------------->
            <div class="titulo">
                <h1>Gestor de Archivos</h1>
                <p>Guarda todos tus archivos de una manera segura</p>
            </div>
            <!--btns---------------------->
            <div class="form-btns">
                <button class="s-btn">Ir</button>
            </div>
            <!--cancel-btn------------>
            <div class="cancelar">
                <a href="#"><i class="fas fa-times"></i></a>
            </div>
        </div>
        <!--Segunda pagina, donde se encuentra el formulario--------------->
        <!--onsubmit: Ejecute un JavaScript cuando se envíe un formulario: -->
        <div class="segunda-pagina">
            <form autocomplete="off" method="post" id="frmLogin" onsubmit="return logear()">
                <div class="container mt-5">
                    <div class="row mt-5 justify-content-center">
                        <div class="col-md-6 mt-5">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h5>Inisiar Secion</h5>
                                        </div>
                                    </div>
                                    <hr class="divisor_horizontal">
                                    <div class="row">
                                        <div class="col">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="login"><i class="far fa-user-circle mr-2"></i>Usuario</label>
                                                            <input type="text" class="form-control form-control-sm rounded-pill" id="login" name="login" placeholder="Ingresar usuario">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="password"><i class="fas fa-key mr-2"></i>Password</label>
                                                            <input type="password" class="form-control form-control-sm rounded-pill" id="password" name="password" placeholder="password">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 text-center">
                                        <i class="fas fa-sign-in-alt mr-2"></i><input type="submit"class="btn btn-sm rounded-pill botones" value="Ingresar">
                                            <!-- <span type="submit" class="btn btn-sm rounded-pill botones"><i class="fas fa-sign-in-alt mr-2"></i></span> -->
                                        </div>
                                        <div class="col-md-12 text-center mt-3">
                                            <p>No tienes cuenta?
                                                <a href="registro.php" class="links"><strong>Registrar</strong></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
   <script src="librerias/jquery_3.4.1/jquery.js"></script>
   <script src="librerias/sweetalert.min.js"></script>
   <script src="js/funciones.js"></script>
   <script src="js/manager_entrada.js"></script>

   <script type="text/javascript">
      function logear() {
         $.ajax({
            type: "POST",
            /* serialize: crea una cadena de texto con los valores del formulario */
            data: $('#frmLogin').serialize(),
            url: "procesos/usuario/login/login.php",
            success: function(respuesta) {
               respuesta = respuesta.trim();
               if (respuesta == 1) {
                  swal(":)", "Ingreso correctamente", "succes");
                  /* redirigir el navegador a una nueva página, en este caso nos dirigimos a inicio */
                  window.location = "vistas/inicio.php";
               } else {
                  swal("Error!!!", "Regitrate o vuelve a intentarlo", "error");
               }
            }
         });
         return false;
      }
   </script>

</body>

</html>