<?php

require_once "conexion.php";

class ModelUsuarios{

    static public function mdlRegistroUsuario($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (`nombre`, `password`, `email`, `modo`, `verificacion`,`emailEncriptado`) 
        VALUES (:nombre, :password, :email, :modo, :verificacion, :emailEncriptado) ");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":modo", $datos["modo"], PDO::PARAM_STR);
        $stmt->bindParam(":verificacion", $datos["verificacion"], PDO::PARAM_INT);
        $stmt->bindParam(":emailEncriptado", $datos["emailEncriptado"], PDO::PARAM_STR);
        
        if ($stmt-> execute()){
            
            return "ok";

        }else{
            return "error";
        }
        $stmt = null;
    }
    static public function mdlMostrarUsuarios($tabla, $item, $valor){
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE  $item = :$item");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();

        $stmt = null;


    }
    static public function mdlActualizarUsuarios($tabla, $id, $item, $valor){
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  $item = :$item WHERE id =:id");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> bindParam(":id", $id, PDO::PARAM_STR);

        if($stmt -> execute()){

            return "ok";
        }else{
            return "error";
        };

        return $stmt -> fetch();

        $stmt = null;


    }
}