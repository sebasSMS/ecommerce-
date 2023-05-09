<?php
	$servidor = Ruta::ctrRutaServidor();
	$url = Ruta::ctrRuta();

	/* ===================================
     CREAR EL OBJETO DE LA API GOOGLE
	=======================================  */
	$cliente = new Google_Client();
	$cliente->setAuthConfig('model/client_secret.json');
	$cliente->setAccessType("offline");
	$cliente->setScopes(['profile','email']);
	
	/* ===================================
     RUTA PARA EL LIGIN DE GOOGLE
	=======================================  */

	$rutaGoogle = $cliente->createAuthUrl();
	/* ===================================
     RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA DE CODE
	=======================================  */

	if(isset($_GET['code'])){
		 
		
		$token = $cliente-> authenticate($_GET['code']);
		$_SESSION['id_token_google'] = $token;
		$cliente->setAccessToken($token);	
	}
	/* ===================================
     RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN EL ARRAY
	=======================================  */

	if($cliente->getAccessToken()){

		$item = $cliente->verifyIdToken();
		

		$datos = array("nombre"=> $item["name"],
						"email"=> $item["email"],
						"foto"=> $item["picture"],
						"password"=> "null",
						"modo"=>"google",
						"verificacion"=> 0,
						"emailEncriptado"=> "null"
					);

		$respuesta = ControladorUsuarios::crtRegistroRedesSociales($datos);

			echo '
			<script>
				setTimeout(function(){

					window.location = localStorage.getItem("rutaActual")
				
				},1000)
			</script>
			';
		

	}

	




?>
<!--===================================
     TOP
======================================= -->
<div class="container-fluid barraSuperior" id="top">
    <div class="container">
        <div class="row">
            <!--===================================
            REDES SOCIAL
            ======================================= -->
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 social" >
                <ul >
                    <?php

                        $social = ControladorPlantilla::ctrEstiloPlantilla();

                        $jsonRedesSociaales = json_decode($social ["redesSociales"],true);

                        foreach ($jsonRedesSociaales as $key => $value){
                            echo'
                            <li>
                                <a  href="'.$value["url"].'"target="_blank">
                                    <i class="fa '.$value["red"].' redSocial '.$value["estilo"].'" aria-hidden="true"></i>
                                </a>
                            
                            </li>';
                        }
                    ?>
                   
                </ul>
            </div>

            <!--===================================
                REGISTRO
            ======================================= -->
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 registro">
                <ul>

					<?php

						if(isset($_SESSION["validarSesion"])){

							if($_SESSION["modo"] == "directo") {

								if ($_SESSION["foto"] == "foto") {

									echo'
									<li>
										<img class="img-circle" src="'.$url.$_SESSION["foto"].'" width="70%" >
									</li>';
									
								}else{
									
									echo '<li> 
											<img class="img-circle" src="'.$servidor.'vistas/img/usuarios/default/anonymous.png" width="10%"" 
										</li>';
	
								}
								echo'
								<li>|</li>
								<li><a href="'.$url.'perfil">Ver Perfil</a></li>
								<li>|</li>
								<li><a  href="'.$url.'salir" class "salir" >Salir</a></li>
								';

								
							}
							
							if($_SESSION["modo"] == "facebook") {

								echo '
								<li>
									<img class="img-circle" src="'.$_SESSION["foto"].'" width="10%" >
								</li>

									
								<li>|</li>
								<li><a href="'.$url.'perfil">Ver Perfil</a></li>
								<li>|</li>
								<li><a  href="'.$url.'salir" class "salir" >Salir</a></li>
								';
							}

							if($_SESSION["modo"] == "google") {

								echo '
								<li>
									<img class="img-circle" src="'.$_SESSION["foto"].'" width="10%" >
								</li>

									
								<li>|</li>
								<li><a href="'.$url.'perfil">Ver Perfil</a></li>
								<li>|</li>
								<li><a  href="'.$url.'salir"  >Salir</a></li>
								';
							}

							
							
						}else{
							echo '
							<li><a href="#modalIngreso" data-toggle="modal">Ingresar</a></li>
							<li>|</li>
							<li><a href="#modalRegistro" id="" data-toggle="modal">Crear una cuenta</a></li>
							';
						}
					?>

                </ul>
            </div>

        </div>
    </div>
</div>
<!--===================================
     HEADER
======================================= -->
<header class="container-fluid">
	
	<div class="container">
		
		<div class="row" id="cabezote">

			<!--=====================================
			LOGOTIPO
			======================================-->
			
			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="logotipo">
				
				<a href="<?php echo $url; ?>">
						 
					<img src="<?php echo $servidor .$social["logo"];  ?>" class="img-responsive">

				</a>
				
			</div>

			<!--=====================================
			BLOQUE CATEGORÍAS Y BUSCADOR
			======================================-->

			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
					
				<!--=====================================
				BOTÓN CATEGORÍAS
				======================================-->

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 backColor" id="btnCategorias">
					
					<p>CATEGORÍAS
					
						<span class="pull-right">
							<i class="fa fa-bars" aria-hidden="true"></i>
						</span>
					
					</p>

				</div>

				<!--=====================================
				BUSCADOR
				======================================-->
				
				<div class="input-group col-lg-8 col-md-8 col-sm-8 col-xs-12" id="buscador">
					
					<input type="search" name="buscar" class="form-control" placeholder="Buscar...">	

					<span class="input-group-btn">
						
						<a href="<?php echo $url; ?>buscador/1/recientes">

							<button class="btn btn-default backColor" type="submit">
								
								<i class="fa fa-search"></i>

							</button>

						</a>

					</span>

				</div>
			
			</div>

			<!--=====================================
			CARRITO DE COMPRAS
			======================================-->

			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="carrito">
				
				<a href="#">

					<button class="btn btn-default pull-left backColor"> 
						
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					
					</button>
				
				</a>	

				<p>TU CESTA <span class="cantidadCesta">3</span> <br> USD $ <span class="sumaCesta">20</span></p>	

			</div>

		</div>

		<!--=====================================
		CATEGORÍAS
		======================================-->

		<div class="col-xs-12 backColor" id="categorias">
            <?php
                $item = null;
                $valor = null;
                $categorias = ControladorProductos::ctrMostrarCategorias($item, $valor);
                
                foreach ($categorias as $key => $value){

                    echo'
                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
                    <h4>
                        <a href="'.$url.$value["ruta"].'" class="pixelCategorias">'.$value["categoria"].'</a>
                    </h4>
                    <hr>
                        <ul>';
						$item = "id_categoria";
						$valor = $value["id"];

                        $subcategorias = ControladorProductos::ctrMostrarSubcategorias($item, $valor);
                        foreach ($subcategorias as $key => $value){
                            echo '<li><a href="'.$url.$value["ruta"].'" class="pixelSubCategorias">'.$value["subcategoria"].'</a></li>';
                        }
                        echo '
    
                        </ul>
                    </div>
                    ';

                }
            
            ?>

		</div>

	</div>

</header>
<!--=====================================
VENTANA DE REGISTRO
======================================-->
<!-- Button to Open the Modal -->


<!-- The Modal -->
<div class="modal modalFormulario" id="modalRegistro">

	<div class="modal-dialog modal-content">

		<!-- Modal body -->
		<div class="modal-body modalTitulo">
			
			<h3 class="backColor">REGISTRARSE</h3>

			<button type="button" class="close" data-dismiss="modal">&times;</button>

			<!--=====================================
			REGISTRO FACEBOOK
			======================================-->
			<div class="col-sm-6 col-xs-12 facebook">
				<p>
					<i class="fa fa-facebook" aria-hidden="true"></i>
					Registro con Facebook
				</p>
			</div>
			<!--=====================================
			REGISTRO GOOGLE
			======================================-->
			<a href="<?php echo $rutaGoogle; ?>">
				<div class="col-sm-6 col-xs-12 google" >
					<p>
						<i class="fa fa-google" aria-hidden="true"></i>
						Registro con Google
					</p>
				</div>
			</a>
			
			
			<!--=====================================
			REGISTRO DIRECTO
			======================================-->

			<form method="post" onsubmit=" return registroUsuario()">
				<hr>
					<div class="form-group">

						<div class="input-group">

							<span class="input-group-addon">
								
								<i class="glyphicon glyphicon-user" aria-hidden="true"></i>
								
							</span>
							<input type="text"  class="form-control text-uppercase " id="regUsuario" name="regUsuario" placeholder="Nombre Completo">
						</div>
						
					</div>

					<div class="form-group">

						<div class="input-group">

							<span class="input-group-addon">
								
								<i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>
								
							</span>
							<input type="email"  class="form-control validarEmail" id="reEmail" name="reEmail" placeholder="Correo Electrónico">
						</div>
					</div>
					<div class="form-group">

						<div class="input-group">

							<span class="input-group-addon">
								
								<i class="glyphicon glyphicon-lock" aria-hidden="true"></i>
								
							</span>
							<input type="password" class="form-control" id="regPassword" name="regPassword" placeholder="Contraseña">
						</div>
					</div>

					<!-- =====================================
					https://www.iubenda.com/es/ CONDICIONES DE USO Y POLITICAS DE PRIVACIDAD
					=========================================== -->
					<div class="checkBox">

						<label >
							<input id="regPoliticas" type="checkbox" name="">

								<small>

									Acepta nuestras codiciones de uso y polílicas
									<a  href="https://www.iubenda.com/privacy-policy/28923001" class="iubenda-white no-brand iubenda-noiframe 
									iubenda-embed iubenda-noiframe " title="Codiciones de uso y polílicas ">Leer más </a><script type="text/javascript">
									(function (w,d) {var loader = function () {var s = d.createElement("script"),tag = d.getElementsByTagName("script")
									[0];s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener)
									{w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload",
									loader);}else{w.onload = loader;}})(window, document);</script>

								</small>
						</label>
					</div>

					<?php
						$registro = new ControladorUsuarios();
						$registro -> crtRegistroUsuarios(); 
					?>

					<input type="submit" class="bnt btn-defaulf backColor btn-block" value="ENVIAR">					
			</form>

		</div>
		<!-- Modal footer -->
		<div class="modal-footer">
			¿Ya tienes una cuenta registrada? | <strong> <a href="#modalIngreso"
			data-dismiss="modal" data-toggle="modal">Ingresar</a></strong>
		</div>

	</div>
</div>

<!--=====================================
VENTANA MODAL PARA EL INGRESO
======================================-->
<!-- Button to Open the Modal -->


<!-- The Modal -->
<div class="modal modalFormulario" id="modalIngreso">

	<div class="modal-dialog modal-content">

		<!-- Modal body -->
		<div class="modal-body modalTitulo">
			
			<h3 class="backColor">INGRESAR</h3>

			<button type="button" class="close" data-dismiss="modal">&times;</button>

			<!--=====================================
			INGRESO FACEBOOK
			======================================-->
			<div class="col-sm-6 col-xs-12 facebook" >
				<p>
					<i class="fa fa-facebook" aria-hidden="true"></i>
					Ingreso con Facebook
				</p>
			</div>
			<!--=====================================
			INGRESO GOOGLE
			======================================-->
			<a href="<?php echo $rutaGoogle; ?>">
				<div class="col-sm-6 col-xs-12 google">
					<p>
						<i class="fa fa-google" aria-hidden="true"></i>
						Ingreso con Google
					</p>
				</div>
			</a>
			
			<!--=====================================
			INGRESO DIRECTO
			======================================-->

			<form method="post">
				<hr>
					<div class="form-group">

						<div class="input-group">

							<span class="input-group-addon">
								
								<i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>
								
							</span>
							<input type="email"  class="form-control validarEmail" id="ingEmail" name="ingEmail" placeholder="Correo Electrónico">
						</div>
					</div>
					<div class="form-group">

						<div class="input-group">

							<span class="input-group-addon">
								
								<i class="glyphicon glyphicon-lock" aria-hidden="true"></i>
								
							</span>
							<input type="password" class="form-control" id="ingPassword" name="ingPassword" placeholder="Contraseña">
						</div>
					</div>

					<?php
						$ingreso = new ControladorUsuarios();
						$ingreso -> crtIngresoUsuarios(); 
					?>

					<input type="submit" class="bnt btn-defaulf backColor btn-block btnIngreso"  value="ENVIAR">		
					
					<br>

					<center>
						<a href="#modalPassword" data-dismiss="modal" data-toggle="modal">¿Olvidaste tu contraseña?</a>
					</center>
			</form>
			

		</div>
		<!-- Modal footer -->
		<div class="modal-footer">
			¿No tienes una cuenta registrada? | <strong> <a href="#modalRegistro"
			data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>
		</div>

	</div>
</div>

<!--=====================================
VENTANA MODAL PARA OLVODO DE CONTRASEÑA
======================================-->
<!-- Button to Open the Modal -->


<!-- The Modal -->
<div class="modal modalFormulario" id="modalPassword">

	<div class="modal-dialog modal-content">

		<!-- Modal body -->
		<div class="modal-body modalTitulo">
			
			<h3 class="backColor">SOLICITUD DE NUEVA CONTRASEÑA</h3>

			<button type="button" class="close" data-dismiss="modal">&times;</button>


			<!--=====================================
			OLVIDO CONTRASEÑA
			======================================-->

			<form method="post">
			<label class=" text-muted">
				<br>
				Escribe el correo electronico con el que estas registrado y allì te enviaremos 
				una nueva contraseña:</label>

					<div class="form-group">

						<div class="input-group">

							<span class="input-group-addon">
								
								<i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>
								
							</span>

							<input type="email"  class="form-control validarEmail" id="passEmail" name="passEmail" placeholder="Correo Electrónico">
						</div>
					</div>

					<?php
						$password = new ControladorUsuarios();
						$password -> crtOlvidoPassword();  
					?>

					<input type="submit" class="bnt btn-defaulf backColor btn-block "  value="ENVIAR">		
					
					<br>

					<center>
						<a href="#modalPassword" data-dismiss="modal" data-toggle="modal">¿Olvidaste tu contraseña?</a>
					</center>
			</form>
			

		</div>
		<!-- Modal footer -->
		<div class="modal-footer">
			¿No tienes una cuenta registrada? | <strong> <a href="#modalRegistro"
			data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>
		</div>

	</div>
</div>