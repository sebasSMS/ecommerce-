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

        static public function ctrMostrarProductos($ordenar,$item, $valor){

            $tabla = "productos";

            $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $ordenar, $item, $valor);
            
            return($respuesta);
            
            
        }
         /* ========================================
        MOSTRAR INFOPRODUCTOS
        ===========================================*/

        static public function crtMostrarInfoProductos($item, $ruta){

            $tabla = "productos";

            $respuesta = ModeloProductos::mdlMostrarInfoProductos($tabla, $item, $ruta);
            
            return($respuesta);
        }
    }
?>