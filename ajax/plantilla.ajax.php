<?php

    require_once "../controllers//plantillaController.php";
    require_once "../model/plantilla.model.php";

    class AjaxPlantilla{
        public function ajaxEstiloPlantilla(){
            $respuesta = ControladorPlantilla::ctrEstiloPlantilla();

            echo json_encode($respuesta);

        }

    }
    $objeto = new AjaxPlantilla();
    $objeto -> ajaxEstiloPlantilla();
        

?>