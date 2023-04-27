<?php
/* COTROLADORES */
 require_once "controllers/plantillaController.php";
 require_once "controllers/productosController.php";
 require_once "controllers/SlideController.php";
 require_once "controllers/usuariosController.php";

 /* MODELOS */
 require_once "model/plantilla.model.php";
 require_once "model/productosModel.php";
 require_once "model/rutas.php";
 require_once "model/SlideModel.php";
 require_once "model/usuarioModel.php";

 /* PhpMailer */
    require_once 'extensiones/PHPMailer/Exception.php';
    require_once 'extensiones/PHPMailer/PHPMailer.php';
    require_once 'extensiones/PHPMailer/SMTP.php';

    $plantilla = new ControladorPlantilla();
    $plantilla -> plantilla();


?> 