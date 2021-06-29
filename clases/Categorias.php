<?php

  require_once "Conexion.php";
  class Categorias extends Conectar{
      public function agregarCategoria($datos){
        $conexion = Conectar::conexion();

        $sql = "INSERT INTO tabla_categoria (id_usuario,nombre_categoria) 
                            VALUES (?,?)";
        $query = $conexion -> prepare($sql);
        $query -> bind_param('is',$datos['idUsuario'],$datos['categoria']);

        $respuesta = $query -> execute();

        $query -> close();

        return $respuesta;

      }

      public function eliminarCategoria($idCategoria){
          $conexion = Conectar::conexion();

          $sql = "DELETE FROM tabla_categoria WHERE id_categoria = ?";
          $query = $conexion -> prepare($sql);
          $query->bind_param('i',$idCategoria);
          $respuesta = $query->execute();
          $query -> close();
          return $respuesta;
      }

      public function obtenerCategoria($idCategoria){
        $conexion = Conectar::conexion();
        $sql = "SELECT id_categoria, nombre_categoria FROM tabla_categoria WHERE id_categoria = '$idCategoria'";
        $result = mysqli_query($conexion,$sql);

        $categoria = mysqli_fetch_array($result);

        $datos = array(
                  "idCategoria" => $categoria['id_categoria'],
                  "nombreCategoria" => $categoria['nombre_categoria']
                  );
        return $datos;
      }

      public function actualizarCategoria($datos){
        $conexion = Conectar::conexion();
        $sql = "UPDATE tabla_categoria SET nombre_categoria = ? WHERE id_categoria = ?";
        $query = $conexion -> prepare($sql);
          $query->bind_param('si',$datos['categoria'],$datos['idCategoria']);
          $respuesta = $query->execute();
          $query -> close();
          return $respuesta;
      }
  }

?>