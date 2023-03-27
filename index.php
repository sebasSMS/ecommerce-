<?php
/* COTROLADORES */
 require_once "controllers/plantillaController.php";
 require_once "controllers/productosController.php";
 require_once "controllers/SlideController.php";

 /* MODELOS */
 require_once "model/plantilla.model.php";
 require_once "model/productosModel.php";
 require_once "model/rutas.php";
 require_once "model/SlideModel.php";

    $plantilla = new ControladorPlantilla();
    $plantilla -> plantilla();


?> 