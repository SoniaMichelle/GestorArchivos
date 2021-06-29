function eliminarCategoria(idCategoria) {
   idCategoria = parseInt(idCategoria);
   if (idCategoria < 1) {
      swal("Error!!!", "Debes de seleccionar una categoria", "error");
   } else {
      swal({
         title: "¿Estas seguro de eliminar la Categoria?",
         text: "Cuando elimines la categoria no la podras recuperar!!!",
         icon: "warning",
         buttons: true,
         dangerMode: true,
      })
         .then((willDelete) => {
            if (willDelete) {
               $.ajax({
                  type: "POST",
                  data: "idCategoria=" + idCategoria,
                  url: "../procesos/categorias/eliminarCategoria.php",
                  success: function (respuesta) {
                     respues = respuesta.trim();
                     if (respuesta == 1) {
                        $('#tablaCategorias').load("gestor/tabla_categoria.php");
                        swal("Eliminado con exito!!!", {
                           icon: "success",
                        });
                     } else {
                        swal("Error!!!", "Fallo al eliminar", "error");
                     }
                  }
               });
            }
         });
   }
}

function obtenerDatosCategoria(idCategoria) {
   $.ajax({
      type: "POST",
      data: "idCategoria=" + idCategoria,
      url: "../procesos/categorias/obtenerCategoria.php",
      success: function (respuesta) {
         respuesta = jQuery.parseJSON(respuesta);
         $('#idCategoria').val(respuesta['idCategoria']);
         $('#categoriaU').val(respuesta['nombreCategoria']);
      }
   });
}

function actualizaCategoria() {
   if ($('#categoriaU').val() == "") {
      swal("Alerta!!!", "Debes de ingrsar el nombre", "warning");
      return false;
   } else {
      $.ajax({
         type: "POST",
         data: $('#frmActualizaCategoria').serialize(),
         url: "../procesos/categorias/actualizaCategoria.php",
         success: function (respuesta) {
            respuesta = respuesta.trim();

            if (respuesta == 1) {
               $('#tablaCategorias').load("gestor/tabla_categoria.php");
               swal("ok!!!", "Actualizado con exito", "success");
            } else {
               swal("upss!!!", "No se pudo actualizar", "error");
            }
         }
      });
   }
}

function guardarArchivos() {
   var fromData = new FormData(document.getElementById('frmArchivos'));

   $.ajax({
      url: "../procesos/gestor/guardarArchivos.php",
      type: "POST",
      datatype: "html",
      data: fromData,
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {
         console.log(respuesta);
         respuesta = respuesta.trim();
         if (respuesta >= 1) {
            
            $('#datos_de_tabla').load("gestor/tabla_archivos.php");
            swal("Lsito!!!", "Se agrego archivo...", "success");
         } else {
            swal("Error!!!", "Fallo al agregar...", "error");
         }
      }
   });
}

function eliminarArchivo(idArchivo){ 
   swal({
      title: "Estas Seguro?...",
      text: "Una vez eliminado no prodras recuperar el archivo...!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
   })
      .then((willDelete) => {
         if (willDelete) {
            $.ajax({
               type: "POST",
               data: "idArchivo=" + idArchivo,
               url: "../procesos/gestor/eliminaArchivo.php",
               success: function (respuesta) {
                  respuesta = respuesta.trim();
                  if (respuesta == 1) {
                     $('#datos_de_tabla').load("gestor/tabla_archivos.php");
                     swal("Poof! Eliminado con exito!", {
                        icon: "success",
                     });
                  }else{
                     swal("Error!!!", "Fallo al elimiar...", "error");
                  }
                  
               }

            });
         }
      });
}

function obtenerArchivoPorId(idArchivo){
   $.ajax({
      type: "POST",
      data: "idArchivo=" + idArchivo,
      url: "../procesos/gestor/obtenerArchivo.php",
      success: function (respuesta) {
         $('#archivoObtenido').html(respuesta);
      }
   });
}