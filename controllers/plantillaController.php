<?php

    class ControladorPlantilla{

        /*=============================================
        LLAMAMOS LA PLANTILLA
        =============================================*/

        public function plantilla(){

            include "views/plantilla.php";

        }

        /*=============================================
        TRAEMOS LOS ESTILOS DINÁMICOS DE LA PLANTILLA
        =============================================*/

        static public function ctrEstiloPlantilla(){

            $tabla = "plantilla";

            $respuesta = ModeloPlantilla::mdlEstiloPlantilla($tabla);

            return $respuesta;
        }

    }
?>