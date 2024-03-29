<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
	<title>Perfiles de logistica</title>

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="js/jquery-1.12.4-jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<?php

	require_once "DBconect.php";

	if (isset($_REQUEST['btn_register'])) //compruebe el nombre del botón "btn_register" y configúrelo
	{
		$card		= $_REQUEST['txt_card'];	//input cedula "txt_card"
		$username	= $_REQUEST['txt_username'];	//input nombre "txt_username"
		$email		= $_REQUEST['txt_email'];	//input nombre "txt_email"
		$password	= $_REQUEST['txt_password'];	//input nombre "txt_password"
		$role		= $_REQUEST['txt_role'];	//seleccion nombre "txt_role"

		if (empty($card)) {
			$errorMsg[] = "Ingrese el numero de Cedula";	//Compruebe el input cedula que no este vacío
		} else if (empty($username)) {
			$errorMsg[] = "Ingrese nombre de usuario";	//Compruebe el input nombre de usuario no vacío
		} else if (empty($email)) {
			$errorMsg[] = "Ingrese email";	//Revisar email input no vacio
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errorMsg[] = "Ingrese email valido";	//Verificar formato de email
		} else if (empty($password)) {
			$errorMsg[] = "Ingrese password";	//Revisar password vacio o nulo
		} else if (strlen($password) < 6 ) {
			$errorMsg[] = "Password minimo 6 caracteres";	//Revisar password 6 caracteres
		} else if (empty($role)) {
			$errorMsg[] = "Seleccione rol";	//Revisar etiqueta select vacio
		} else {
			try {
				$select_stmt = $db->prepare("SELECT card, username, email FROM mainlogin 
										WHERE card=:ucard OR username=:uname OR email=:uemail"); // consulta sql
				$select_stmt->bindParam(":ucard", $card);
				$select_stmt->bindParam(":uname", $username);
				$select_stmt->bindParam(":uemail", $email);      //parámetros de enlace
				$select_stmt->execute();
				$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
				if ($row["card"] == $card) {
					$errorMsg[] = "El numero de Cedula ya existe";	//Verificar cedula existente
				} else if ($row["username"] == $username) {
					$errorMsg[] = "Usuario ya existe";	//Verificar usuario existente
				} else if ($row["email"] == $email) {
					$errorMsg[] = "Email ya existe";	//Verificar email existente
				} else if (!isset($errorMsg)) {
					$insert_stmt = $db->prepare("INSERT INTO mainlogin(card,username,email,password,role) VALUES(:ucard,:uname,:uemail,:upassword,:urole)"); //Consulta sql de insertar			
					$insert_stmt->bindParam(":ucard", $card);
					$insert_stmt->bindParam(":uname", $username);
					$insert_stmt->bindParam(":uemail", $email);	  		//parámetros de enlace 
					$insert_stmt->bindParam(":upassword", $password);
					$insert_stmt->bindParam(":urole", $role);

					if ($insert_stmt->execute()) {
						$registerMsg = "Registro exitoso: Esperar página de inicio de sesión"; //Ejecuta consultas 
						header("refresh:2;index.php"); //Actualizar despues de 2 segundo a la portada
					}
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
	include("header.php");
	?>
	<div class="wrapper">

		<div class="container">

			<div class="col-lg-12">

				<?php
				if (isset($errorMsg)) {
					foreach ($errorMsg as $error) {
				?>
						<div class="alert alert-danger">
							<strong>INCORRECTO ! <?php echo $error; ?></strong>
						</div>
					<?php
					}
				}
				if (isset($registerMsg)) {
					?>
					<div class="alert alert-success">
						<strong>EXITO ! <?php echo $registerMsg; ?></strong>
					</div>
				<?php
				}
				?>
				<div class="login-form">
					<center>
						<h2>Registrar</h2>
					</center>
					<form method="post" class="form-horizontal">

						<div class="form-group">
							<label class="col-sm-9 text-left">Cedula</label>
							<div class="col-sm-12">
								<input type="number" name="txt_card" class="form-control" placeholder="Ingrese Cedula" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-9 text-left">Usuario</label>
							<div class="col-sm-12">
								<input type="text" name="txt_username" class="form-control" placeholder="Ingrese usuario" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-9 text-left">Email</label>
							<div class="col-sm-12">
								<input type="text" name="txt_email" class="form-control" placeholder="Ingrese email" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-9 text-left">Password</label>
							<div class="col-sm-12">
								<input type="password" name="txt_password" class="form-control" placeholder="Ingrese password" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-9 text-left">Seleccione tipo</label>
							<div class="col-sm-12">
								<select class="form-control" name="txt_role">
									<option value="" selected="selected"> - seleccione rol - </option>
									<!--<option value="admin">Admin</option>-->
									<option value="vendedor">Vendedor</option>
									<option value="logistica">Logistica</option>

								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<input type="submit" name="btn_register" class="btn btn-primary btn-block" value="Registro">
								<!--<a href="index.php" class="btn btn-danger">Cancel</a>-->
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								¿Tienes una cuenta? <a href="index.php">
									<p class="text-info">Inicio de sesión</p>
								</a>
							</div>
						</div>

					</form>
				</div>
				<!--Cierra div login-->
			</div>

		</div>

	</div>

</body>

</html>