<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
	<title>Multiusuarios : Niveles de administrador</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<script src="../js/jquery-1.12.4-jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="../style.css">
	<style type="text/css">
		.login-form {
			width: 340px;
			margin: 20px auto;
		}

		.login-form form {
			margin-bottom: 15px;
			background: #f7f7f7;
			box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			padding: 30px;
		}

		.login-form h2 {
			margin: 0 0 15px;
		}

		.form-control,
		.btn {
			min-height: 38px;
			border-radius: 2px;
		}

		.btn {
			font-size: 15px;
			font-weight: bold;
		}

		h1 {
			color: #f7f7f7;
		}

		h3 {
			color: #f7f7f7;
		}

		h4 {
			color: #f7f7f7;
		}

		a {
			color: #f7f7f7;
			text-decoration: none;
		}
	</style>
</head>

<body>

	<? php // include("../header.php");
	?>
	<div class="collapse" id="navbarToggleExternalContent">
		<div class="bg-dark p-4">
			<h5 class="text-white h4">Perfil de administrador</h5>
			<ul>
				<li><span class="text-muted"><a href="#">Reporte Power BI</a></span></li>
				<li> <span class="text-muted"><a href="consultastock.php">Consultas stock</a></span></li>
				<li> <span class="text-muted"><a href="registre_sales.php">Registro de venta</a></span></li>
				<li> <span class="text-muted"><a href="admin_portada.php">cambiar perfil usuarios</a></span></li>
				<br>
				<li><a href="../cerrar_sesion.php"><button class="btn btn-danger text-left"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cerrar Sesion</button></a></li>
			</ul>

		</div>
	</div>
	<nav class="navbar navbar-dark bg-dark">
		<div class="container-fluid">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>
	</nav>

	<div class="wrapper">

		<div class="container">

			<div class="col-lg-12">

				<center>
					<h1>Pagina Administrativa</h1>

					<h3>
						<?php
						session_start();

						if (!isset($_SESSION['admin_login'])) {
							header("location: ../index.php");
						}

						if (isset($_SESSION['vendedor_login'])) {
							header("location: ../vendedor/personal_portada.php");
						}

						if (isset($_SESSION['logistica_login'])) {
							header("location: ../logistica/usuarios_portada.php");
						}

						if (isset($_SESSION['admin_login'])) {
						?>
							Bienvenido,
						<?php
							echo $_SESSION['admin_login'];
						}
						?>
					</h3>

				</center>

			</div>


			<br><br><br>
			<div class="row">

				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<center>
								<h4>Panel de usuarios</h4>
							</center>
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-dark table-striped">
									<thead>
										<tr>
											<th width="4%">ID</th>
											<th width="18%">Usuario</th>
											<th width="24%">Email</th>
											<th width="19%">Rol</th>
											<th width="24%">Password</th>
											<th colspan="2">Opciones</th>
										</tr>
									</thead>
									<tbody>
										<?php
										require_once '../DBconect.php';
										$select_stmt = $db->prepare("SELECT id,username,email,role FROM mainlogin");
										$select_stmt->execute();

										while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
										?>
											<tr>
												<td><?php echo $row["id"]; ?></td>
												<td><?php echo $row["username"]; ?></td>
												<td><?php echo $row["email"]; ?></td>
												<td><?php echo $row["role"]; ?></td>
												<td>*******</td>
												<td width="4%">
													<a href="edit.php? id=<?php echo $row['id'] ?>" class="btn btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
																<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
																<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
															</svg></span></a>
												</td>
												<td width="7%">
													<a href="delete.php? id=<?php echo $row['id'] ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
																<path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
															</svg></span></a>
												</td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>

							</div>
							<!-- /.table-responsive -->
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
				</div>

			</div>

		</div>

</body>

</html>