<?php

   require_once "Conexion.php";

   class Usuario extends Conectar{
      /* Funcion que agregara usuarios a la base de dtos y resibira como parametro el dato, que es donde
      se encuentran los datos del usuario por medio de su id */
      public function agregarUsuario($datos) {
         $conexion = Conectar::conexion();
         /* SELF: identificador de metodos estaticos*/
         if (self::buscarUsuarioRepetido($datos['usuario'])) {
            return 2;
         } else {
            /* Insertamos los datos en nuestra tabla en los campos de la base de datos */
            $sql = "INSERT INTO registro_usuario (nombre,apellido_paterno,apellido_materno,usuario,email,password)
            /*El VALUEScomando especifica los valores de una instrucción INSERT INTO.*/
            values (?,?,?,?,?,?)";
            /*  se crea y se envía a la base de datos. Algunos valores se dejan 
            sin especificar, llamados parámetros y representados por un interrogante "?" */
            $query = $conexion->prepare($sql);
            /* Agrega variables a una sentencia preparada como parámetros */
            $query->bind_param(
               'ssssss',
               $datos['nombre'],
               $datos['paterno'],
               $datos['materno'],
               $datos['usuario'],
               $datos['email'],
               $datos['password']
            );
            $exito = $query->execute();
            $query->close();
            return $exito;
         }  
      }
      /* ESTE ES UN METODO NO ESTATICO, POR MAS QUE QUIERAS MODIFICARLO NO SE VA A PODER */
      public function buscarUsuarioRepetido($usuario) {
         $conexion = Conectar::conexion();

         $sql = "SELECT usuario FROM registro_usuario WHERE usuario = '$usuario'";
         $result = mysqli_query($conexion, $sql);
         /* Se entrega por medio de un array todos los resultados */
         $datos = mysqli_fetch_array($result);

         if ($datos['usuario'] != "" || $datos['usuario'] == $usuario) {
            return 1;
         } else {
            return 0;
         }
      }
      /* BUSCA SI EL USUARIO EXISTE DENTRO DE LA BD */
      public function login($usuario, $password){
         $conexion = Conectar::conexion();
         /* Count: lee arrays 
         as: alias */
         $sql = "SELECT count(*) as existeUsuario FROM registro_usuario  
                           WHERE usuario = '$usuario' AND password = '$password'";

         $result = mysqli_query($conexion,$sql);

         $respuesta = mysqli_fetch_array($result)['existeUsuario'];

         if($respuesta > 0 ){
            $_SESSION['usuario'] = $usuario;

            $sql = "SELECT id_usuario FROM registro_usuario
                                       WHERE usuario = '$usuario' AND password = '$password'";

            $result = mysqli_query($conexion,$sql);
            $idUsuario = mysqli_fetch_row($result)[0];

            $_SESSION['idUsuario'] = $idUsuario;

            return 1;
         }else{
            return 0;
         }

      }
   }
?>