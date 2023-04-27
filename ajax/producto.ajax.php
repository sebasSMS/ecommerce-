<?php

    require_once "../controllers/productosController.php";
    require_once "../model/productosModel.php";

    class AjaxProducto{

        public $valor;
        public $item;
        public $ruta;
        public function ajaxVistaProducto(){

            $datos = array("valor" => $this->valor,
                            "ruta" => $this->ruta);

            $item = $this->item;
            
            $respuesta = ControladorProductos::ctrActualizarVistaProducto($datos, $item);

            echo($respuesta);

        }

    }

    if(isset($_POST["valor"])){
        $vista = new AjaxProducto();
        $vista -> valor = $_POST["valor"];
        $vista -> item = $_POST["item"];
        $vista -> ruta = $_POST["ruta"];
        $vista -> ajaxVistaProducto();
            
    }


?>