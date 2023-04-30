<?php

require_once "../controllers/usuariosController.php";
require_once "../model/usuarioModel.php";

class AjaxUsuarios{

    /*=============================================
    VALIDAR EMAIL EXISTENTE
    =============================================*/

    public $validarEmail;

    public function ajaxValidarEmail(){

        $datos = $this->validarEmail;

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios("email", $datos);

        echo json_encode($respuesta);

    }
}
    /*=============================================
    VALIDAR EMAIL EXISTENTE
    =============================================*/

    if(isset($_POST["validarEmail"])){
        $valEmail = new AjaxUsuarios();
        $valEmail -> validarEmail = $_POST["validarEmail"];
        $valEmail -> ajaxValidarEmail();
    }
?>
