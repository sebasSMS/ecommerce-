<?php
    
    class ControladorProductos{

        /* ========================================
        MOSTRAR CATEGORIAS
        ===========================================*/

        static public function ctrMostrarCategorias($item, $valor){

            $tabla = "categorias";

            $respuesta = ModeloProductos::mdlMostrarCategorias($tabla, $item, $valor);

            return $respuesta;
        }

      /* ========================================
        MOSTRAR SUBCATEGORIAS
        ===========================================*/
        
        static public function ctrMostrarSubcategorias($item, $valor){

            $tabla = "subcategoria";

            $respuesta = ModeloProductos::mdlMostrarSubCategorias( $tabla, $item, $valor);

            return $respuesta;
        }
        
        /* ========================================
        MOSTRAR PRODUCTOS
        ===========================================*/

        static public function ctrMostrarProductos($ordenar){

            $tabla = "productos";

            $respuesta = ModeloProductos::mdlMostrarProdcutos($tabla , $ordenar);
            
            return($respuesta);
            
        }

    }
?>