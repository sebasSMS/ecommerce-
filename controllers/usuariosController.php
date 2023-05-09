<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



 class ControladorUsuarios{

    /*=============================================
    REGISTRO DE USUARIO
    =============================================*/

    public function crtRegistroUsuarios(){

        if(isset($_POST["regUsuario"])){

            if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["regUsuario"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["reEmail"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["regPassword"])){

                    $encriptar = crypt($_POST["regPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $encriptarEmail = md5($_POST["reEmail"]);

                    $datos = array("nombre"=> $_POST["regUsuario"],
                                   "password"=> $encriptar,
                                   "email"=> $_POST["reEmail"],
                                    "foto"=>"",
                                   "modo" => "directo",
                                   "verificacion" => 1,
                                   "emailEncriptado" => $encriptarEmail);

                    $tabla = "usuarios";

                    $respuesta = ModelUsuarios::mdlRegistroUsuario($tabla, $datos);

                    if($respuesta == "ok"){

                        
                        /*=============================================
                        VERIFICACIÓN CORREO ELECTRÓNICO
                        =============================================*/

                        
                        //Import PHPMailer classes into the global namespace
                        //These must be at the top of your script, not inside a function

                        
                        //Create an instance; passing `true` enables exceptions
                        $mail = new PHPMailer(true);
                        
                        try {
                            //Server settings
                            
                            date_default_timezone_set("America/Bogota");

                            $url = Ruta::ctrRuta();	
                            
                            $mail->CharSet = 'UTF-8';

                            $mail->isMail();
        
                            $mail->setFrom('cursos@tutorialesatualcance.com', 'Tutoriales a tu Alcance');
        
                            $mail->addReplyTo('cursos@tutorialesatualcance.com', 'Tutoriales a tu Alcance');
        
                            $mail->Subject = "Por favor verifique su dirección de correo electrónico";
        
                            $mail->addAddress($_POST["reEmail"]);
        
                            $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
                                
                                <center>
                                    
                                    <img style="padding:20px; width:10%" src="http://tutorialesatualcance.com/tienda/logo.png">
        
                                </center>
        
                                <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                                
                                    <center>
                                    
                                    <img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-email.png">
        
                                    <h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>
        
                                    <hr style="border:1px solid #ccc; width:80%">
        
                                    <h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta de Tienda Virtual, debe confirmar su dirección de correo electrónico</h4>
        
                                    <a href="'.$url.'verificar/'.$encriptarEmail.'" target="_blank" style="text-decoration:none">
        
                                    <div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su dirección de correo electrónico</div>
        
                                    </a>
        
                                    <br>
        
                                    <hr style="border:1px solid #ccc; width:80%">
        
                                    <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>
        
                                    </center>
        
                                </div>
        
                            </div>');
        
                                    
                            $envio = $mail->Send();

                            if(!$envio){

                                echo '<script> 

                                    Swal.fire({
                                        title: "¡ERROR!",
                                        text: "¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["reEmail"].$mail->ErrorInfo.'!",
                                        icon: "error",
                                        timerProgressBar:true,
                                        timer:9000,
                                        showCancelButton: false,
                                        confirmButtonText: "Ok!"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            history.back()
                                        }
                                    })

                                </script>';

                            }else{

                                echo '<script> 
                                Swal.fire({

                                    title: "ok!",
                                    text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["reEmail"].' para verificar la cuenta!",
                                    icon: "success",
                                    timerProgressBar:true,
                                    timer:9000,
                                    showCancelButton: false,
                                    confirmButtonText: "Ok!"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        history.back()
                                    }
                                })

                                </script>';

                            }

                            
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }

                    }


                }else{

                echo'<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡ERROR!",
                        text: "¡Error al registrar el usuario, no se permiten caracteres especiales!",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        },
                    
                        function(isConfirm){
                            
                            if(isConfirm){
                                history.back();
                            }
                        
                    })
                    </script>';
                   
            }

        }

    }

    /*=============================================
    VERIFICACIÓN CORREO ELECTRÓNICO
    =============================================*/

    static public function ctrMostrarUsuarios($item, $valor){

        $tabla = "usuarios";

        $respuesta = ModelUsuarios::mdlMostrarUsuarios($tabla, $item, $valor); 
        
        return $respuesta;

    }
    /*=============================================
    ACTUALIZAR USUARIO 
    =============================================*/

    static public function ctrActualizarUsuarios($id, $item, $valor){

        $tabla = "usuarios";

        $respuesta = ModelUsuarios::mdlActualizarUsuarios($tabla, $id, $item, $valor); 
        
        return $respuesta;

    }

    /*=============================================
    INGRESO USUARIO
    =============================================*/

    public function crtIngresoUsuarios(){

        if(isset($_POST["ingEmail"])){


            if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingEmail"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){


                    $encriptar = crypt($_POST["ingPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $tabla = "usuarios";
                    $item = "email";
                    $valor = $_POST["ingEmail"];
        
                    $respuesta = ModelUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
                    var_dump( $respuesta["verificacion"]);

                    if($respuesta["email"] == $_POST["ingEmail"] && $respuesta["password"] == $encriptar){


                        if($respuesta["verificacion"] == 1){

                            
                            echo'<script>

                                Swal.fire({
                                    title: "NO HA VERIFICADO SU CORREO ELETRÓNICO!",
                                    text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo para verificar la direccion de correo electrónico '.$respuesta["email"].'!",
                                    icon: "error",
                                    showCancelButton: false,
                                    confirmButtonText: "Ok!"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = localStorage.getItem("rutaActual")
                                    }
                                })
                        
                                </script>';

                        }else{

                            $_SESSION["validarSesion"] = "ok";
                            $_SESSION["id"] = $respuesta["id"];
                            $_SESSION["nombre"] = $respuesta["nombre"];
                            $_SESSION["foto"] = $respuesta["foto"];
                            $_SESSION["email"] = $respuesta["email"];
                            $_SESSION["password"] = $respuesta["password"];
                            $_SESSION["modo"] = $respuesta["modo"];

                            echo' <script>

                                window.location = localStorage.getItem("rutaActual")

                            </script>';
                        }


                    }else{

                        echo '<script> 

                        Swal.fire({
                            title: "¡ERROR!",
                            text: "¡Por favor revise que el email exista o la contraseña coincida con la registrada!",
                            icon: "error",
                            showCancelButton: false,
                            confirmButtonText: "Ok"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = localStorage.getItem("rutaActual")
                            }
                        })

                    </script>';
                    }


                }else{

                    echo'<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡ERROR!",
                        text: "¡Error al ingresar al sistema, no se permiten caracteres especiales!",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        },
                    
                        function(isConfirm){
                            
                            if(isConfirm){
                                history.back();
                            }
                        
                    })
                    </script>';
                }


        }
    }

    /*=============================================
    OLVIDO DE CONTRASEÑA
    =============================================*/

    public function crtOlvidoPassword(){

        if(isset($_POST["passEmail"])){

            if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["passEmail"])){
                    /*=============================================
                    GENERAR CONTRASEÑA ALEATORIA
                    =============================================*/

                function generarPassword($longitud){ 

                    $key = '';
                    $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLM'; 
                    $max = strlen($pattern)-1; 
                    
                    for($i=0;$i < $longitud;$i++) {

                        $key .= $pattern [mt_rand(0,$max)];

                    }
                    return $key;
                
                }; 

                $nuevaPassword = generarPassword(11);
                
                $encriptar = crypt($nuevaPassword,'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                
                $tabla = "usuarios";

                $item1 = "email";
                $valor1 = $_POST["passEmail"];

                $respuesta1 = ModelUsuarios::mdlMostrarUsuarios($tabla, $item1, $valor1); 
                var_dump($respuesta1);
                if($respuesta1){

                    $id = $respuesta1["id"];
                    $item2 = "password";
                    $valor2 = $encriptar;

                    $respuesta2 = ModelUsuarios::mdlActualizarUsuarios($tabla, $id, $item2, $valor2);  

                    if($respuesta2 == "ok"){

                        $mail = new PHPMailer(true);

                        try {
                            /*=============================================
                            CAMBIO DE CONTRASEÑA
                            =============================================*/
                            
                            date_default_timezone_set("America/Bogota");

                            $url = Ruta::ctrRuta();	
                            
                            $mail->CharSet = 'UTF-8';

                            $mail->isMail();
        
                            $mail->setFrom('cursos@tutorialesatualcance.com', 'Tutoriales a tu Alcance');
        
                            $mail->addReplyTo('cursos@tutorialesatualcance.com', 'Tutoriales a tu Alcance');
        
                            $mail->Subject = "Solicitud de nueva contraseña";
        
                            $mail->addAddress($_POST["passEmail"]);
        
                            $mail->msgHTML('
                            
                                <div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
            
                                    <center>
                                        
                                        <img style="padding:20px; width:10%" src="http://tutorialesatualcance.com/tienda/logo.png">

                                    </center>

                                    <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                                    
                                        <center>
                                        
                                        <img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-pass.png">

                                        <h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>

                                        <hr style="border:1px solid #ccc; width:80%">

                                        <h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva contraseña: </strong>'.$nuevaPassword.'</h4>

                                        <a href="'.$url.'" target="_blank" style="text-decoration:none">

                                        <div style="line-height:60px; background:#0aa; width:60%; color:white">Ingrese nuevamente al sitio</div>

                                        </a>

                                        <br>

                                        <hr style="border:1px solid #ccc; width:80%">

                                        <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

                                        </center>

                                    </div>

                                </div>
	
                            ');
        
                                    
                            $envio = $mail->Send();

                            if(!$envio){

                                echo '<script> 

                                    Swal.fire({
                                        title: "¡ERROR!",
                                        text: "¡Ha ocurrido un problema enviando de contraseña a '.$_POST["passEmail"].$mail->ErrorInfo.'!",
                                        icon: "error",
                                        timerProgressBar:true,
                                        timer:9000,
                                        showCancelButton: false,
                                        confirmButtonText: "Ok!"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            history.back()
                                        }
                                    })

                                </script>';

                            }else{

                                echo '<script> 
                                Swal.fire({

                                    title: "ok!",
                                    text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["passEmail"].' para su cambio de contraseña!",
                                    icon: "success",
                                    timerProgressBar:true,
                                    timer:9000,
                                    showCancelButton: false,
                                    confirmButtonText: "Ok!"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            history.back()
                                        }
                                    })

                                </script>';

                            }

                            
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }

                    }
                }else{

                    echo '<script> 
                    Swal.fire({
    
                        title: "error!",
                        text: "¡El correo electronico no existe en el sistema!",
                        icon: "error",
                        timerProgressBar:true,
                        timer:9000,
                        showCancelButton: false,
                        confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                history.back()
                            }
                        })
    
                    </script>';
    

                }
                    
            }else{

                echo '<script> 
                Swal.fire({

                    title: "ok!",
                    text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico  para su cambio de contraseña!",
                    icon: "success",
                    timerProgressBar:true,
                    timer:9000,
                    showCancelButton: false,
                    confirmButtonText: "Ok!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            history.back()
                        }
                    })

                </script>';

            }

            

        }
    }

    /*=============================================
    REGISTRO CON REDES SOCIALES
    =============================================*/

    static public function crtRegistroRedesSociales($datos){

       

        $tabla = "usuarios";

        $item = "email";
        $valor = $datos["email"];
        $emailRepetido = false;

        $respuesta0 = ModelUsuarios::mdlMostrarUsuarios($tabla, $item, $valor); 
        
        if ($respuesta0) {

            if ($respuesta0["modo"] != $datos["modo"]){

                echo '<script> 
                Swal.fire({

                    title: "ERROR!",
                    text: "¡El correo electrónico '.$datos["email"].', ya está registrado en el sistema con un método diferente a Google!",
                    icon: "error",
                    showCancelButton: false,
                    confirmButtonText: "Ok!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            history.back()
                        }
                    })

                </script>';
                $emailRepetido = false;
            }
            $emailRepetido = true;
        }else{

            $respuesta1 = ModelUsuarios::mdlRegistroUsuario($tabla, $datos);

        }



        if ($emailRepetido || $respuesta1 == "ok") {

            $respuesta2 = ModelUsuarios::mdlMostrarUsuarios($tabla, $item, $valor); 
            
            if($respuesta2["modo"] == "facebook"){

                session_start();

                $_SESSION["validarSesion"] = "ok";
                $_SESSION["id"] = $respuesta2["id"];
                $_SESSION["nombre"] = $respuesta2["nombre"];
                $_SESSION["foto"] = $respuesta2["foto"];
                $_SESSION["email"] = $respuesta2["email"];
                $_SESSION["password"] = $respuesta2["password"];
                $_SESSION["modo"] = $respuesta2["modo"];

                return "ok";

            }else if($respuesta2["modo"] == "google"){

                $_SESSION["validarSesion"] = "ok";
                $_SESSION["id"] = $respuesta2["id"];
                $_SESSION["nombre"] = $respuesta2["nombre"];
                $_SESSION["foto"] = $respuesta2["foto"];
                $_SESSION["email"] = $respuesta2["email"];
                $_SESSION["password"] = $respuesta2["password"];
                $_SESSION["modo"] = $respuesta2["modo"];

                return "ok";
            }
            else{
                return "";
            }

        }
        
    }
    
    

 }
?>