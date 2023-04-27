<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



 class ControladorUsuarios{

    /*=============================================
    REGISTRO DE USUARIO
    =============================================*/

    public function crtRegsitroUsuarios(){

        if(isset($_POST["regUsuario"])){

            if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["regUsuario"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["reEmail"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["rePassword"])){

                    $encriptar = crypt($_POST["rePassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $encriptarEmail = md5($_POST["reEmail"]);
                    var_dump($encriptarEmail);

                    $datos = array("nombre"=> $_POST["regUsuario"],
                                   "password"=> $encriptar,
                                   "email"=> $_POST["reEmail"],
                                   "modo" => "Directory",
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

                                    swal.fire({
                                        icon:"error",
                                        title: "¡ERROR!",
                                        text: "¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["reEmail"].$mail->ErrorInfo.'!",
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false
                                        },

                                        function(isConfirm){

                                            if(isConfirm){
                                                history.back();
                                            }
                                    });

                                </script>';

                            }else{

                                echo '<script> 

                                    swal.fire({
                                        icon:"success",
                                        title: "¡OK!",
                                        text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["reEmail"].' para verificar la cuenta!",

                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false
                                        },

                                        function(isConfirm){

                                            if(isConfirm){
                                                history.back();
                                            }
                                    });

                                </script>';

                            }

                            
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
                        var_dump($envio);

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
 }
?>