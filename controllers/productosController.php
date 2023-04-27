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

        static public function ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo){

            $tabla = "productos";

            $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $ordenar, $item, $valor,$base, $tope, $modo);
            
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
       /* ========================================
        MOSTRAR INFOPRODUCTOS
        ===========================================*/

        static public function ctrListarProductos($ordenar, $item, $valor){

            $tabla = "productos";

            $respuesta = ModeloProductos::mdlListarProductos($tabla, $ordenar, $item, $valor);
            
            return $respuesta;
        }
         /* ========================================
        MOSTRAR BANNER
        ===========================================*/

        static public function ctrMostrarBanner($ruta){

            $tabla = "banner";

            $respuesta = ModeloProductos::mdlMostrarbanner($tabla, $ruta);

            return $respuesta;
        }
            /*=============================================
	        BUSCADOR
	        =============================================*/

        static public function ctrBuscarProductos( $busqueda, $ordenar, $modo, $base, $tope){

            $tabla = "productos";

            $respuesta = ModeloProductos::mdlBuscarProductos($tabla, $busqueda, $ordenar, $modo, $base, $tope);

            return $respuesta;

        }
        /*=============================================
	    LISTAR PRODUCTOS BUSCADOR
	    =============================================*/
        static public function ctrListarProductosBusqueda($busqueda){

            $tabla = "productos";

            $respuesta = ModeloProductos::mdlListarProductosBusqueda($tabla, $busqueda);
            
            return $respuesta;
        }
        /*=============================================
	    ACTUALIZAR VISTA PRODUCTO
	    =============================================*/

        static public function ctrActualizarVistaProducto($datos, $item){

            $tabla = "productos";

            $respuesta = ModeloProductos::mdlActualizarVistaProducto($tabla, $datos, $item);

            return $respuesta;
        }

    
    }

?>