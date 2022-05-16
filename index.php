<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
	<title>Perfil rol de usuario</title>

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="js/jquery-1.12.4-jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<?php
	require_once 'DBconect.php';
	session_start();
	if (isset($_SESSION["admin_login"]))	//Condicion admin
	{
		header("location: admin/admin_portada.php");
	}
	if (isset($_SESSION["vendedor_login"]))	//Condicion vendedor
	{
		header("location: vendedor/personal_portada.php");
	}
	if (isset($_SESSION["logistica_login"]))	//Condicion logistica
	{
		header("location: logistica/usuarios_portada.php");
	}

	if (isset($_REQUEST['btn_login'])) {
		$email		= $_REQUEST["txt_email"];	//textbox nombre "txt_email"
		$password	= $_REQUEST["txt_password"];	//textbox nombre "txt_password"
		$role		= $_REQUEST["txt_role"];		//select opcion nombre "txt_role"

		if (empty($email)) {
			$errorMsg[] = "Por favor ingrese Email";	//Revisar email
		} else if (empty($password)) {
			$errorMsg[] = "Por favor ingrese Password";	//Revisar password vacio
		} else if (empty($role)) {
			$errorMsg[] = "Por favor seleccione rol ";	//Revisar rol vacio
		} else if ($email and $password and $role) {
			try {
				$select_stmt = $db->prepare("SELECT email,password,role FROM mainlogin
										WHERE
										email=:uemail AND password=:upassword AND role=:urole");
				$select_stmt->bindParam(":uemail", $email);
				$select_stmt->bindParam(":upassword", $password);
				$select_stmt->bindParam(":urole", $role);
				$select_stmt->execute();	//execute query

				while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
					$dbemail	= $row["email"];
					$dbpassword	= $row["password"];
					$dbrole		= $row["role"];
				}
				if ($email != null and $password != null and $role != null) {
					if ($select_stmt->rowCount() > 0) {
						if ($email == $dbemail and $password == $dbpassword and $role == $dbrole) {
							switch ($dbrole) {
								case "admin":
									$_SESSION["admin_login"] = $email;
									$loginMsg = "Admin: Inicio sesión con éxito";
									header("refresh:3;admin/admin_portada.php");
									break;

								case "vendedor";
									$_SESSION["vendedor_login"] = $email;
									$loginMsg = "vendedor: Inicio sesión con éxito";
									header("refresh:3;vendedor/personal_portada.php");
									break;

								case "logistica":
									$_SESSION["logistica_login"] = $email;
									$loginMsg = "logistica: Inicio sesión con éxito";
									header("refresh:3;logistica/usuarios_portada.php");
									break;

								default:
									$errorMsg[] = "correo electrónico o contraseña o rol incorrectos";
							}
						} else {
							$errorMsg[] = "correo electrónico o contraseña o rol incorrectos";
						}
					} else {
						$errorMsg[] = "correo electrónico o contraseña o rol incorrectos";
					}
				} else {
					$errorMsg[] = "correo electrónico o contraseña o rol incorrectos";
				}
			} catch (PDOException $e) {
				$e->getMessage();
			}
		} else {
			$errorMsg[] = "correo electrónico o contraseña o rol incorrectos";
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
							<strong><?php echo $error; ?></strong>
						</div>
					<?php
					}
				}
				if (isset($loginMsg)) {
					?>
					<div class="alert alert-success">
						<strong>ÉXITO ! <?php echo $loginMsg; ?></strong>
					</div>
				<?php
				}
				?>


				<div class="login-form">
					<center>
						<h2>Iniciar sesión</h2>
					</center>
					<form method="post" class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-6 text-left">Email</label>
							<div class="col-sm-12">
								<input type="text" name="txt_email" class="form-control" placeholder="Ingrese email" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-6 text-left">Password</label>
							<div class="col-sm-12">
								<input type="password" name="txt_password" class="form-control" placeholder="Ingrese passowrd" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-6 text-left">Seleccionar rol</label>
							<div class="col-sm-12">
								<select class="form-control" name="txt_role">
									<option value="" selected="selected"> - selecccionar rol - </option>
									<option value="admin">Administrador</option>
									<option value="vendedor">Vendedor</option>
									<option value="logistica">Logistica</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<input type="submit" name="btn_login" class="btn btn-success btn-block" value="Iniciar Sesion">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								¿No tienes una cuenta? <a href="registro.php">
									<p class="text-info">Registrar Cuenta</p>
								</a>
							</div>
						</div>

					</form>

				</div>

				<!--Cierra div login-->
			</div>

		</div>

	</div>
	<div id="map"></div>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7fPq_CwGmYLnPzCI5V3ZFrcN1hrl9HY4&callback=iniciarMap"></script>
</body>

</html>