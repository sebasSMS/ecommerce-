<?php
class ControladorSlide{

    static public function ctrMostrarSlide(){
        $tabla = "slide";
        $respuesta = ModelSlide::mdlMotrarSlide($tabla);

        return $respuesta;
    }


}
?>