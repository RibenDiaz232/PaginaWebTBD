<!DOCTYPE html>
<html lang="es">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
	<?php 
	include "loginconexion.php";
	?>
	<div class="section">
		<div class="container">
			<div class="row full-height justify-content-center">
				<div class="col-12 text-center align-self-center py-5">
				<div class="section pb-5 pt-5 pt-sm-2 text-center">
						<h6 class="mb-0 pb-3"><span>Inciar Sesión</span><span>Registrarse</span></h6>
			          	<input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
			          	<label for="reg-log"></label>
						<div class="card-3d-wrap mx-auto">
							<div class="card-3d-wrapper">
								<div class="card-front">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-4 pb-3">Ingrese sus datos para iniciar sesión</h4>
											<form method="post" action="validacion.php"> 
											<div class="form-group">
												<input type=7y"email" class="form-style" name="email" placeholder="Correo Electrónico">
												<i class="input-icon uil uil-at"></i>
											</div>	
											<div class="form-group mt-2">
												<input type="password" class="form-style" name="password" placeholder="Contraseña">
												<i class="input-icon uil uil-lock-alt"></i>
											</div>
											<input  type="submit" value="Login" name="login" class="btn mt-4">
											
											</form>
                      <p class="mb-0 mt-4 text-center"><a href="#" class="link">¿Olvidaste tu contraseña?</a></p>
					  <p class="mb-0 mt-4 text-center"><a href="index.php" class="link">Regresar al menú principal</a></p>
				      					</div>
			      					</div>
			      				</div>
								<div class="card-back">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-3 pb-3">Registrese para crear una cuenta</h4>
											<form method="post">
											<div class="form-group">
												<input type="text" class="form-style" name="nombre-completo" placeholder="Nombre completo">
												<i class="input-icon uil uil-user"></i>
											</div>	
											<div class="form-group mt-2">
												<input type="tel" class="form-style" name="numero-de-telefono" placeholder="Número telefónico">
												<i class="input-icon uil uil-phone"></i>
											</div>	
                      <div class="form-group mt-2">
												<input type="email" class="form-style" name="email" placeholder="Correo Electrónico">
												<i class="input-icon uil uil-at"></i>
											</div>
											<div class="form-group mt-2">
												<input type="password" class="form-style" name="password" placeholder="Contraseña">
												<i class="input-icon uil uil-lock-alt"></i>
											</div>
											<input  type="submit" value="Registrarse" name="register" class="btn mt-4">
											</form>
											<p class="mb-0 mt-4 text-center"><a href="index.php" class="link">Regresar al menú principal</a></p>
				      					</div>
			      					</div>
			      				</div>
			      			</div>
			      		</div>
			      	</div>
		      	</div>
	      	</div>
	    </div>
	</div>
</body>
</html>
