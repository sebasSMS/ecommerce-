<!-- /*=============================================
 VERIFICACIÓN CORREO ELECTRÓNICO
 =============================================*/ -->
<?php

    $usuarioVerificado = false;
    $item = "EmailEncriptado";
    $valor = $rutas[1];
    $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
        if(is_array($respuesta)){

            if($valor == $respuesta["emailEncriptado"]){
            
                $id = $respuesta["id"];
                $item2 = "verificacion";
                $valor2 = 0;
            
                $respuesta2 = ControladorUsuarios::ctrActualizarUsuarios($id, $item2, $valor2);
         
                    if ($respuesta2 == "ok") {
            
                        $usuarioVerificado = true;
                    }
        
            }
        

        }

    



?>
 <div class="container">
    <div class="row">
        <div class="col-xs-12 text-center verifical">

        <?php
            if($usuarioVerificado){

                echo'
                    <h3>Gracias</h3>
                    <h2><small> ¡Hemos verificado su correo electronico, ya puede ingresar al sistema! </small></h2>

                    <br>
                    <a href="#modalIgreso" data-toggle="modal"><button class="btn btn-defaulf backColor btn-lg">
                    INGRESAR</button></a>';

            }else{

                echo'
                <h3>Error</h3>
                <h2><small> ¡No se ha podido verificar el correo electronico, vuelva a registrarse! </small></h2>

                <br>

                <a href="'.$url.'#modalRegistro" data-toggle="modal"><button class="btn btn-defaulf backColor btn-lg">
                REGISTRO</button></a>';

            }
        ?>
            
        </div>
    </div>
 </div>


