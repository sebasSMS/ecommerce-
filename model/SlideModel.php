<?php
 require_once "conexion.php";

 class ModelSlide{

    static public function mdlMotrarSlide($tabla){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt =null;
    }
 }
?>