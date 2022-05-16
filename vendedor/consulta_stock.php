<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <script src="../js/jquery-1.12.4-jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="../style.css">
  <title>Consulta stock</title>
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
  <div class="collapse" id="navbarToggleExternalContent">
    <div class="bg-dark p-4">
      <h5 class="text-white h4">Perfil de administrador</h5>
           <ul>
        <li> <span class="text-muted"><a href="personal_portada.php">Registro Venta</a></span></li>
		  <!-- <li> <span class="text-muted"><a href="usuarios_portada.php">Registro Devolucion</a></span></li>
		  <li> <span class="text-muted"><a href="usuarios_portada.php">Registro Cambio</a></span></li> -->
		  <li> <span class="text-muted"><a href="consulta_stock.php">Consulta stock</a></span></li>
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

  </div>

  </nav>
  <div class="wrapper">

    <div class="container">

      <div class="col-lg-12">

       			<center>
					<h1>Pagina vendedor</h1>

					<h3>
						<?php

						session_start();

						if (!isset($_SESSION['vendedor_login'])) {
							header("location: ../index.php");
						}

						if (isset($_SESSION['admin_login'])) {
							header("location: ../admin/admin_portada.php");
						}

						if (isset($_SESSION['logistica_login'])) {
							header("location: ../logistica/usuarios_portada.php");
						}

						if (isset($_SESSION['vendedor_login'])) {
						?>
							Bienvenido,
						<?php
							echo $_SESSION['vendedor_login'];
						}

    
						?>
					</h3>
				</center>


      </div>



    </div>
    <?php include("../conex.php") ?>
    <div class="container p-4">
      <div class="row">
        <div class="col-md-4">


          <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
              <?= $_SESSION['message'] ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

          <?php session_unset();
          } ?>
          <div class="card card-body ">
            <form class="d-flex">
              <input class="form-control me-3" type="search" name="busqueda" placeholder="Escribe..." aria-label="Search">
              <button class="btn btn-outline-success" name="enviar" type="submit">Buscar</button>
            </form>
          </div>

        </div>

        <div class="col-md-8 ">
          <table class="table table-dark table-striped">
            <thead>
              <tr>
                <th>ID producto</th>
                <th>Cantidad</th>
                <th>Producto</th>
              </tr>
            </thead>
            <tbody>
              <?php
             $query = "SELECT * FROM logistica";
                $result_logistic =  mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result_logistic)) { ?>
                <tr>
                   <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['cantidad'] ?></td>
                    <td><?php echo $row['producto'] ?></td>
                </tr>
              <?php } ?>

            </tbody>
          </table>
          <?php
          $busqueda;
          if (isset($_GET['enviar'])) {
            $busqueda = $_GET['busqueda'];
            $consulta = $conn->query("SELECT * FROM logistica WHERE id LIKE '%$busqueda%' OR cantidad LIKE '%$busqueda%' OR id LIKE '%$busqueda%' OR producto LIKE '%$busqueda%'");

            while ($row = $consulta->fetch_array()) { ?>

              <table class="table table-light table-striped">
                <thead>
                  <tr>
                    <th>ID producto</th>
                    <th>Cantidad</th>
                    <th>Producto</th>
                  </tr>
                </thead>
                <tbody>
                  <td><?php echo $row['id'] ?></td>
                  <td><?php echo $row['cantidad'] ?></td>
                  <td><?php echo $row['producto'] ?></td>
                </tbody>
              </table>
          <?php }
          }

          ?>
        </div>
      </div>
    </div>
  </div>
  </div>



  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>
</div>

</html>