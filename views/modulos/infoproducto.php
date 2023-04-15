
<?php

$servidor = Ruta::ctrRutaServidor();
$url = Ruta::ctrRuta();

?>
<!--=====================================
BREADCRUMB INFOPRODUCTOS
======================================-->
<div class="container-fluid well well-sm">

    <div class="container">
        <div class="row ">
            <ul class="breadcrumb fondoBreadcrumb text-uppercase">

            <li><a href="<?php echo $url;  ?>">INICIO</a></li>
			<li class="active pagActiva"><?php echo $rutas[0] ?></li>

            </ul>
        </div>
    </div>
    
</div>
<!--=====================================
INFOPRODUCTOS
======================================-->
<div class="container-fluid infoproducto">

    <div class="container">
        <div class="row">

            <?php

                $item = "ruta";
                $valor = $rutas[0];
                $infoproducto = ControladorProductos::crtMostrarInfoProductos($item, $valor);
                
                $multimedia= json_decode($infoproducto["multimedia"],true);

                /*=====================================
                VISOR DE IMAGENES
                ====================================== */
                if($infoproducto["tipo"] == "fisico"){
                    echo '
                        
                        <div class="col-md-5 col-sm-6 col-xs-12 visorImg">

                        <figure class="visor">';

                        if ($multimedia != null) {
                            # code...
                        

                            for ($i=0; $i < count($multimedia) ; $i++) { 
                                
                                echo'<img id="lupa'.($i+1).'" class="img-thumbnail" src="'.$servidor.$multimedia[$i]["foto"].'">';

                            }
                            
                            echo'</figure>

                            <div class="flexslider">

                                <ul class="slides">';


                                    for ($i=0; $i < count($multimedia) ; $i++) { 
                                            
                                            echo'<li>
                                                <img value="'.($i+1).'" class="img-thumbnail" src="'.$servidor.$multimedia[$i]["foto"].'" alt="'.$infoproducto["titulo"].'">
                                            </li>';
                                    }
                        }
                            echo'</ul>
                            </div>
                    </div>';
                    
                }else{

                    /*=====================================
                    VISOR DE VIDEO
                    ====================================== */
                    echo'
                        <div class="col-sm-6 col-xs-12">
                            
                            <iframe class="videoPresentacion" width="100%"src="https://www.youtube.com/embed/'.$infoproducto["multimedia"].'?rel=0&autoplay=0" title="YouTube video player" frameborder="0" allow="accelerometer;
                                autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
                            </iframe>

                        </div>
                    ';
                }
            ?>
            
                <?php
                    if($infoproducto["id"] == "fisico"){

                        echo'<div class="col-md-7 col-sm-6 col-xs-12">';

                    }else{

                        echo'<div class="col-sm-6 col-xs-12">';
                    }
                
                ?>



                    <!--=====================================
                   REGRESAR A LA TIENDA
                    ======================================-->
                <div class="col-xs-6">
                    <h6>
                        <a href="javascript:history.back()" class="text-muted">
                            <i class="fa fa-reply" aria-hidden="true"></i> Continuar Comprando
                        </a>
                    </h6>
                </div>
                   <!--=====================================
                    COMPARTIR EN REDES SOCIALES
                    ======================================-->
                <div class="col-xs-6">
                    <h6>
                        <a href="" class="dropdown-togger pull-right text-muted" data-toggle="dropdown">
                             <i class=" fa fa-plus" aria-hidden="true"></i> Compartir
                        </a>
                        <ul class="dropdown-menu pull-right compartirRedes">
                            <li>
                                <p class="btnFacebook">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                    Facebook
                                </p>

                            </li>
                            <li>
                                <p class="btnGoogle">
                                    <i class=" fa fa-google" aria-hidden="true"></i>
                                    Google
                                </p>
                            </li>

                        </ul>
                    </h6>
                </div>

                <div class="clearfix"></div>

                <!-- =============================================
                ESPACIO DEL PRODCUTO
                ============================================= -->
                    <?php
                        /* <!-- =============================================
                            TITULO
                        ============================================= --> */

                        if($infoproducto["oferta"] == 0) {

                            if ($infoproducto["nuevo"] == 0) {

                              echo' <h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'</h1>';

                            }else{
                                echo' <h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'
                                <br>
                                <small>
                                <span class="label label-warning">Nuevo</span>
                                </small>
                                </h1>';

                            }
   
                            
                        }else{
                            if ($infoproducto["nuevo"] == 0) {
                                echo' <h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'
                                <br>
                                <small>
                                   <span class="label label-warning">'.$infoproducto["descuentoOferta"].'% off</span>
                                </small>
                                </h1>';
                            }else{

                           
                            echo' <h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'
                             <br>
                                <small>
                                    <span class="label label-warning">Nuevo</span>
                                    <span class="label label-warning">'.$infoproducto["descuentoOferta"].'% off</span>
                                    
                                </small>
                             </h1>';
                            }

                        }
                         /* <!-- =============================================
                            TITULO
                        ============================================= --> */

                        if ($infoproducto["precio"] == 0) {
                            
                            echo '<h2 class="text-muted">GRATIS</h2>';
                        }else{

                            if($infoproducto["oferta"] == 0) {

                                echo '<h2 class="text-muted"> USD $'.$infoproducto["precio"].'</h2>';
                            }else{
                                echo '<h2 class="text-muted">
                                <span>
                                    <strong class="oferta"> USD $'.$infoproducto["precio"].'</strong>
                                </span>
                                <span>
                                $'.$infoproducto["precioOferta"].'
                                </span>
                                
                                </h2>';

                            }
                        }
                         /* <!-- =============================================
                            DESCRIPCION
                        ============================================= -->  */
                            echo'<p>'.$infoproducto["descripcion"].'</p>';
                    ?>
                    
                    
                    <!-- =============================================
                    CARÁCTERISTICAS DEL PRODUCTO
                    ============================================= -->
                    <hr>
                    <div class="form-grup row">
                        
                      <?php

                        if ($infoproducto["detalles"] != null) {

                            $detalles = json_decode($infoproducto["detalles"], true);

                            if($infoproducto["tipo"] == "fisico"){
 
                                if($detalles["Talla"] != null ){
                                    echo'<div class="col-md-3 col-xs-12">
                                        <select class="form-control seleccionarDetalle" id="seleccioinarTalla" >
                                        
                                            <option value="">Talla</option>';
                                            for($i = 0; $i <= count($detalles["Talla"]); $i++ ){
                                                
                                                echo'<option value="'.$detalles["Talla"][$i].'">'.$detalles["Talla"][$i].'</option>';
                                            }
                                    echo'</select>

                                    </div>';
                                }
                                if($detalles["Color"] != null ){
                                    echo'<div class="col-md-3 col-xs-12">
                                        <select class="form-control seleccionarDetalle" id="seleccioinarColor" >
                                        
                                            <option value="">Color</option>';
                                            for($i = 0; $i <= count($detalles["Color"]); $i++ ){
                                                
                                                echo'<option value="'.$detalles["Color"][$i].'">'.$detalles["Color"][$i].'</option>';
                                            }
                                    echo'</select>

                                    </div>';
                                }
                                if($detalles["Marca"] != null ){
                                    echo'<div class="col-md-3 col-xs-12">
                                        <select class="form-control seleccionarDetalle" id="seleccioinarMarca" >
                                        
                                            <option value="">Marca</option>';
                                            for($i = 0; $i <= count($detalles["Marca"]); $i++ ){
                                                
                                                echo'<option value="'.$detalles["Marca"][$i].'">'.$detalles["Marca"][$i].'</option>';
                                            }
                                    echo'</select>

                                    </div>';
                                }
                                

                            }else{
                                
                                echo'<div class="col-xs-12">
                                    <li>
                                    <i style="margin-right:10px" class="fa fa-play-circle" aria-hidden="true"></i> '.$detalles["Clases"].'
                                    </li>
                                    <li>
                                    <i style="margin-right:10px" class="fa fa-clock-o" aria-hidden="true"></i> '.$detalles["Tiempo"].'
                                    </li>
                                    <li>
                                    <i style="margin-right:10px" class="fa fa-check-circle" aria-hidden="true"></i> '.$detalles["Nivel"].'
                                    </li>
                                    <li>
                                    <i style="margin-right:10px" class="fa fa-info-circle" aria-hidden="true"></i> '.$detalles["Acceso"].'
                                    </li>
                                    <li>
                                    <i style="margin-right:10px" class="fa fa-desktop" aria-hidden="true"></i> '.$detalles["Dispositivo"].'
                                    </li>
                                    <li>
                                    <i style="margin-right:10px" class="fa fa-trophy" aria-hidden="true"></i> '.$detalles["Certificado"].'
                                    </li>
                                </div>';
                            }
                        }
                        
                        /* =============================================
                        ENTREGA
                        ============================================= */

                        if($infoproducto["entrega"] == 0){

                            if ($infoproducto["precio"] == 0) {
                                echo'
                                <h4 class="col-sm-0 col-md-12 col-xs-0">
                                    <hr>
                                    <span class="label label-default" style="font-weight:100">

                                        <i class="fa fa-clock-o" aria-hidden="true" style="margin-right:5px" ></i>
                                        Entrega inmedita | 
                                        <i class="fa fa-shopping-cart" aria-hidden="true" style="margin:0px 5px" ></i>
                                        '.$infoproducto["ventasGratis"].' inscritos |
                                        <i class="fa fa-eye" aria-hidden="true" style="margin:0px 5px" ></i>
                                    Visto por '.$infoproducto["vistasGratis"].' personas
                                    </span>
                                </h4>

                                <h4 class=" col-lg-0 col-md-0 col-xs-12">
                                    <hr>
                                    <small>

                                        <i class="fa fa-clock-o" aria-hidden="true" style="margin-right:5px" ></i>
                                        Entrega inmedita <br> 
                                        <i class="fa fa-shopping-cart" aria-hidden="true" style="margin:0px 5px" ></i>
                                        '.$infoproducto["ventasGratis"].' inscritos <br>
                                        <i class="fa fa-eye" aria-hidden="true" style="margin:0px 5px" ></i>
                                    Visto por '.$infoproducto["vistasGratis"].' personas
                                    </small>
                                </h4>
                                ';
                            }else{
                                echo'
                                <h4 class="col-sm-0 col-md-12 col-xs-0">
                                    <hr>
                                    <span class="label label-default" style="font-weight:100">

                                        <i class="fa fa-clock-o" aria-hidden="true" style="margin-right:5px" ></i>
                                        Entrega inmedita |
                                        <i class="fa fa-shopping-cart" aria-hidden="true" style="margin:0px 5px" ></i>
                                        '.$infoproducto["ventas"].' ventas |
                                        <i class="fa fa-eye" aria-hidden="true" style="margin:0px 5px" ></i>
                                    Visto por '.$infoproducto["vistas"].' personas
                                    </span>

                                </h4>

                                <h4 class=" col-lg-0 col-md-0 col-xs-12">
                                    <hr>
                                    <small>

                                        <i class="fa fa-clock-o" aria-hidden="true" style="margin-right:5px" ></i>
                                        Entrega inmedita <br/> 
                                        <i class="fa fa-shopping-cart" aria-hidden="true" style="margin:0px 5px" ></i>
                                        '.$infoproducto["ventas"].' ventas <br/>
                                        <i class="fa fa-eye" aria-hidden="true" style="margin:0px 5px" ></i>
                                    Visto por '.$infoproducto["vistas"].' personas
                                    </small>

                                </h4>
                                ';
                            }



                        }else{
                            if ($infoproducto["precio"] == 0) {
                                echo'
                                <h4 class="col-sm-0 col-md-12 col-xs-0">
                                    <hr>
                                    <span class="label label-default" style="font-weight:100">
                                        <i class="fa fa-clock-o" aria-hidden="true" style="margin-right:5px" ></i> 
                                        '.$infoproducto["entrega"].' dias hábiles para la entrega |
                                        <i class="fa fa-shopping-cart" aria-hidden="true" style="margin:0px 5px" ></i>
                                        '.$infoproducto["ventasGratis"].' solucitudes |
                                        <i class="fa fa-eye" aria-hidden="true" style="margin:0px 5px" ></i>
                                    Visto por '.$infoproducto["vistasGratis"].' personas
                                    </span>
                                </h4>
                                
                                <h4 class=" col-lg-0 col-md-0 col-xs-12">
                                    <hr>
                                    <small>
                                        <i class="fa fa-clock-o" aria-hidden="true" style="margin-right:5px" ></i> 
                                        '.$infoproducto["entrega"].' dias hábiles para la entrega <br>
                                        <i class="fa fa-shopping-cart" aria-hidden="true" style="margin:0px 5px" ></i>
                                        '.$infoproducto["ventasGratis"].' solucitudes <br>
                                        <i class="fa fa-eye" aria-hidden="true" style="margin:0px 5px" ></i>
                                    Visto por '.$infoproducto["vistasGratis"].' personas
                                    </small>
                                </h4>';
                            }else{
                                echo'
                                <h4 class="col-sm-0 col-md-12 col-xs-0">
                                    <hr>
                                    <span class="label label-default" style="font-weight:100">
                                        <i class="fa fa-clock-o" aria-hidden="true" style="margin-right:5px" ></i> 
                                        '.$infoproducto["entrega"].' dias hábiles para la entrega |
                                        <i class="fa fa-shopping-cart" aria-hidden="true" style="margin:0px 5px" ></i>
                                        '.$infoproducto["ventas"].' ventas |
                                        <i class="fa fa-eye" aria-hidden="true" style="margin:0px 5px" ></i>
                                    Visto por '.$infoproducto["vistas"].' personas
                                    </span>
                                </h4>
                                
                                <h4 class=" col-lg-0 col-md-0 col-xs-12">
                                    <hr>
                                    <small>
                                        <i class="fa fa-clock-o" aria-hidden="true" style="margin-right:5px" ></i> 
                                        '.$infoproducto["entrega"].' dias hábiles para la entrega <br>
                                        <i class="fa fa-shopping-cart" aria-hidden="true" style="margin:0px 5px" ></i>
                                        '.$infoproducto["ventas"].' ventas <br>
                                        <i class="fa fa-eye" aria-hidden="true" style="margin:0px 5px" ></i>
                                        Visto por '.$infoproducto["vistas"].' personas
                                    </small>
                                </h4>';
                            }


                        
                            

                        }
                      ?>  

                    </div>
                    <br>
                       <!-- =============================================
                        BOTONES DE COMPRA
                        ============================================= -->
                        <div class="row botonesCompra">

                            <?php
                                if($infoproducto["precio"] == 0){
                                    echo'
                                    <div class="col-md-6 col-xs-12">';

                                    if($infoproducto["precio"] == 0){
                                        echo'<button class="btn btn-default btn-block btn-lg backColor">ACCEDER AHORA AHORA</button>';
                                    }else{
                                        echo'<button class="btn btn-default btn-block btn-lg backColor">SOLICITAR AHORA</button>';

                                    }
                                    echo'</div
                                    ';
                                }else{
                                    if($infoproducto["tipo"] == "virtual"){
                                        echo'
                                        <div class="col-md-6  col-xs-12">

                                            <button class="btn btn-default btn-block btn-lg">

                                            <small>COMPRAR AHORA</small>

                                            </button>

                                        </div>
                                    
                                        <div class="col-md-6 col-xs-12">
    
                                            <button class="btn btn-default btn-block btn-lg backColor">
    
                                                <small>ADICIONAR AL CARRITO</small>
    
                                                <i class=" col-md-0 fa fa-shopping-cart" aria-hidden="true" ></i>
    
                                            </button>
                                        </div>
                                        ';
    
                                    }else{
                                        
                                        echo'
                                        <div class="col-lg-6 col-md-8 col-xs-12">
    
                                            <button class="btn btn-default btn-block btn-lg backColor">

                                                ADICIONAR AL CARRITO

                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>

                                            </button>
                                        </div>
                                        ';
                                    }

                                }
                            ?>

                        </div>
                    <figure class="lupa">
                        <!-- =============================================
                        ZONA DE LUPA
                        ============================================= -->
                        <img src="" alt="">
                    </figure>

            </div>
        </div>
        
        <div class="row">

            <ul class="nav nav-tabs">

                 <li class="active"><a href="#">COMENTARIO 22</a></li>
                 <li><a href="#">Ver mas </a></li>
                 <li class="pull-right"><a href="" class="text-muted">PROMEDIO DE CALIFICACION 3.5 |
                    <i class="fa fa-star text-success"  aria-hidden="true"></i>
                    <i class="fa fa-star text-success"  aria-hidden="true"></i>
                    <i class="fa fa-star text-success"  aria-hidden="true"></i>
                    <i class="fa fa-star-half-o text-success"  aria-hidden="true"></i>
                    <i class="fa fa-star-o text-success"  aria-hidden="true"></i>
                 </a></li>
                                

            </ul>
            <br>

            <div class="row comentarios">

                <div class="panel-group col-md-3 col-sm-6 col-xs-12">

                    <div class="panel panel-default">

                        <div class="panel-heading text-uppercase">
                            Andres Felipe
                            <span class="text-rigth">

                                <img class="img-circle" src="<?php $url ?> views/img/usuarios/40/944.jpg" width="20%">    

                            </span>
                        </div>
                        <div class="panel-body"><small> Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                            Optio id, saepe sit cupiditate fuga
                            qui quibusdam vel iste dignissimos ducimus autem illum atque. 
                            Maiores id aliquam repellat ad inventore vel!</small>
                        </div>

                        <div class="panel-footer"> Panel Content

                        <i class="fa fa-star text-success"  aria-hidden="true"></i>
                        <i class="fa fa-star text-success"  aria-hidden="true"></i>
                        <i class="fa fa-star text-success"  aria-hidden="true"></i>
                        <i class="fa fa-star-half-o text-success"  aria-hidden="true"></i>
                        <i class="fa fa-star-o text-success"  aria-hidden="true"></i>

                        </div>


                    </div>
          
                </div>
                <div class="panel-group col-md-3 col-sm-6 col-xs-12">

                    <div class="panel panel-default">

                        <div class="panel-heading text-uppercase">
                            Andres Felipe
                            <span class="text-rigth">

                                <img class="img-circle" src="<?php $url ?> views/img/usuarios/40/944.jpg" width="20%">    

                            </span>
                        </div>
                        <div class="panel-body"><small> Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                            Optio id, saepe sit cupiditate fuga
                            qui quibusdam vel iste dignissimos ducimus autem illum atque. 
                            Maiores id aliquam repellat ad inventore vel!</small>
                        </div>

                        <div class="panel-footer"> Panel Content

                        <i class="fa fa-star text-success"  aria-hidden="true"></i>
                        <i class="fa fa-star text-success"  aria-hidden="true"></i>
                        <i class="fa fa-star text-success"  aria-hidden="true"></i>
                        <i class="fa fa-star-half-o text-success"  aria-hidden="true"></i>
                        <i class="fa fa-star-o text-success"  aria-hidden="true"></i>

                        </div>


                    </div>
          
                </div>
                <div class="panel-group col-md-3 col-sm-6 col-xs-12">

                    <div class="panel panel-default">

                        <div class="panel-heading text-uppercase">
                            Andres Felipe
                            <span class="text-rigth">

                                <img class="img-circle" src="<?php $url ?> views/img/usuarios/40/944.jpg" width="20%">    

                            </span>
                        </div>
                        <div class="panel-body"><small> Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                            Optio id, saepe sit cupiditate fuga
                            qui quibusdam vel iste dignissimos ducimus autem illum atque. 
                            Maiores id aliquam repellat ad inventore vel!</small>
                        </div>

                        <div class="panel-footer"> Panel Content

                        <i class="fa fa-star text-success"  aria-hidden="true"></i>
                        <i class="fa fa-star text-success"  aria-hidden="true"></i>
                        <i class="fa fa-star text-success"  aria-hidden="true"></i>
                        <i class="fa fa-star-half-o text-success"  aria-hidden="true"></i>
                        <i class="fa fa-star-o text-success"  aria-hidden="true"></i>

                        </div>


                    </div>
          
                </div>
                <div class="panel-group col-md-3 col-sm-6 col-xs-12">

                    <div class="panel panel-default">

                        <div class="panel-heading text-uppercase">
                            Andres Felipe
                            <span class="text-rigth">

                                <img class="img-circle" src="<?php $url ?> views/img/usuarios/40/944.jpg" width="20%">    

                            </span>
                        </div>
                        <div class="panel-body"><small> Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                            Optio id, saepe sit cupiditate fuga
                            qui quibusdam vel iste dignissimos ducimus autem illum atque. 
                            Maiores id aliquam repellat ad inventore vel!</small>
                        </div>

                        <div class="panel-footer"> Panel Content

                        <i class="fa fa-star text-success"  aria-hidden="true"></i>
                        <i class="fa fa-star text-success"  aria-hidden="true"></i>
                        <i class="fa fa-star text-success"  aria-hidden="true"></i>
                        <i class="fa fa-star-half-o text-success"  aria-hidden="true"></i>
                        <i class="fa fa-star-o text-success"  aria-hidden="true"></i>

                        </div>


                    </div>
          
                </div>

            </div>                    

        </div>

        <hr>    

    </div>

</div>

<!--=====================================
	ARTICULOS RELACIONADOS
======================================-->

<div class="container-fluid productos">


    <div class="container">

        <div class="row">

            <div class="col-xs-12 tituloDestacado">

                <div class="col-sm-6 col-xs-12">
            
                    <h1><small>PRODUCTOS RELACIONADOS</small></h1>

                </div>

                <div class="col-sm-6 col-xs-12">

                    <?php
                        $item = "id";
                        $valor = $infoproducto["id_subcategoria"];

                        $rutaArticuloDestacados = ControladorProductos::ctrMostrarSubcategorias($item, $valor);
                        
                     echo'<a href="'.$url.$rutaArticuloDestacados[0]["ruta"].' ">
                        
                            <button class="btn btn-default backColor pull-right">
                                
                                VER MÁS <span class="fa fa-chevron-right"></span>

                            </button>

                        </a>'
                    ?>
            


                </div>

            </div>

            <div class="clearfix"></div>

            <hr>

        </div>

        <?php
            $ordenar = "";
            $item = "id_subcategoria";
            $valor = $infoproducto["id_subcategoria"];
            $base = 0;
            $tope = 4;
            $modo = "Rand()";

            $relacionados = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor,$base, $tope, $modo);

            if(!$relacionados){
                echo' 
                div class="col-xs-12 error404">
                    <h1><small>¡Oops!</small></h1>
                    <h2>No hay productos relacionados</h2>
                </div> ';
            }else{
                echo'<ul class="grid0">';
                foreach ($relacionados as $key => $value) {
                
                    echo '<li class="col-md-3 col-sm-6 col-xs-12">
    
                            <figure>
                                
                                <a href="'.$url.$value["ruta"].'" class="pixelProducto">
                                    
                                    <img src="'.$servidor.$value["portada"].'" class="img-responsive">
    
                                </a>
    
                            </figure>
    
                            <h4>
                    
                                <small>
                                    
                                    <a href="'.$url.$value["ruta"].'" class="pixelProducto">
                                        
                                        '.$value["titulo"].'<br>
    
                                        <span style="color:rgba(0,0,0,0)">-</span>';
    
                                        if($value["nuevo"] != 0){
    
                                            echo '<span class="label label-warning fontSize">Nuevo</span> ';
    
                                        }
    
                                        if($value["oferta"] != 0){
    
                                            echo '<span class="label label-warning fontSize">'.$value["descuentoOferta"].'% off</span>';
    
                                        }
    
                                    echo '</a>	
    
                                </small>			
    
                            </h4>
    
                            <div class="col-xs-6 precio">';
    
                            if($value["precio"] == 0){
    
                                echo '<h2><small>GRATIS</small></h2>';
    
                            }else{
    
                                if($value["oferta"] != 0){
    
                                    echo '<h2>
    
                                            <small>
                        
                                                <strong class="oferta">USD $'.$value["precio"].'</strong>
    
                                            </small>
    
                                            <small>$'.$value["precioOferta"].'</small>
                                        
                                        </h2>';
    
                                }else{
    
                                    echo '<h2><small>USD $'.$value["precio"].'</small></h2>';
    
                                }
                                
                            }
                                            
                            echo '</div>
    
                            <div class="col-xs-6 enlaces">
                                
                                <div class="btn-group pull-right">
                                    
                                    <button type="button" class="btn btn-default btn-xs deseos" idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a mi lista de deseos">
                                        
                                        <i class="fa fa-heart" aria-hidden="true"></i>
    
                                    </button>';
    
                                    if($value["tipo"] == "virtual" && $value["precio"] != 0){
    
                                        if($value["oferta"] != 0){
    
                                            echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precioOferta"].'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">
    
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
    
                                            </button>';
    
                                        }else{
    
                                            echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precio"].'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">
    
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
    
                                            </button>';
    
                                        }
    
                                    }
    
                                    echo '<a href="'.$url.$value["ruta"].'" class="pixelProducto">
                                    
                                        <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">
                                            
                                            <i class="fa fa-eye" aria-hidden="true"></i>
    
                                        </button>	
                                    
                                    </a>
    
                                </div>
    
                            </div>
    
                        </li>';
                }
    
                echo '</ul> ';
            }
        



        ?>
    </div>
</div>        
