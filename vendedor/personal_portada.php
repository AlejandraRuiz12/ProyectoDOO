<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
  <title>Multiusuarios : Niveles de Ventas</title>

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
  <div class="collapse" id="navbarToggleExternalContent">
    <div class="bg-dark p-4">
      <h5 class="text-white h4">Perfil de Vendedor</h5>
      <ul>
        <li> <span class="text-muted"><a href="personal_portada.php">Registrar Venta</a></span></li>
       
        <li> <span class="text-muted"><a href="consulta_stock.php">Consultar Stock</a></span></li>
        <br>
        <li><a href="../cerrar_sesion.php"><button class="btn btn-danger text-left"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cerrar Sesión</button></a></li>
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

        <hr>
      </div>

    </div>

  </div>
  <?php include("../conex.php") ?>

  <div class="container p-4">
    <div class="row">
      <div class="col-md-3">

        <?php if (isset($_SESSION['message'])) { ?>
          <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php session_unset();
        } ?>

        <div class="Ccontainer">
          <div class="alert alert- alert-dismissible fade show" role="alert">

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

          <div class="card card-body ">
            <form action="save.php" method="GET">
             

              <div class="from-group">
                <input type="date" name="fecha" class="form-control" placeholder="0000- 00 -00" value="<?php echo date("Y-m-d");?>" autofocus>
              </div>

              <?php
              $query = "SELECT * FROM sucursal";
              $result_Dictionary = mysqlI_query($conn, $query);
              ?>

              <div class="from-group mt-3">
                <select name="sucursal" class="form-select" aria-label="Default select example">
                  <option selected> Seleccionar Sucursal </option>
                  <?php foreach ($result_Dictionary as $options) : ?>
                    <option value="<?php echo $options['Descripcion'] ?>"><?php echo $options['Descripcion'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="from-group mt-3">
              <input type="text" name="nombre_vendedor" class="form-control" placeholder="Nombre del vendedor" autofocus>
              </div>
              <div class="from-group mt-3">
                <input type="number" name="cantidad" class="form-control" placeholder="Cantidad de Productos" autofocus>
              </div>

              <?php
              $query = "SELECT * FROM logistica";
              $result_Product = mysqlI_query($conn, $query);
              ?>

              <div class="from-group mt-3">
                <select name="producto" class="form-select" aria-label="Default select example">
                  <option selected>Seleccionar Productos </option>
                  <?php foreach ($result_Product as $options) : ?>
                    <option value="<?php echo $options['id'] ?>"><?php echo $options['producto'] ?></option>
                  <?php endforeach ?>

                </select>
              </div>

              <div class="from-group mt-3">
                <input type="number" name="cedula_clientes" class="form-control" placeholder="Cedula del Cliente" autofocus>
              </div>
              
              
            
              <input type="submit" class="btn btn-success btn-block mt-3" name="save" value="Guardar">
            </form>
          </div>
        </div>

      </div>
      <div class="col-md-9 ">
        <table class="table table-dark table-striped">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Sucursal</th>
              <th>Nombre Vendedor</th>
              <th>C. productos</th>
              <th>Productos</th>
              <th>Precio unitario</th>
              <th>CC Cliente</th>
              <th>Valor Total</th>
              <th>Peticion</th>
              <th>Comentario</th>
              <th>Acciones</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM sales";
            $result_ventas = mysqlI_query($conn, $query);
            while ($row = mysqli_fetch_array($result_ventas)) { ?>
              <tr>
                <td><?php echo $row["fecha"]; ?></td>
                <td><?php echo $row["sucursal"]; ?></td>
                <td><?php echo $row["nombre_vendedor"]; ?></td>
                <td align="center"><?php echo $row["cantidad"]; ?></td>
                <td><?php echo $row["producto"]; ?></td>
                <td><?php echo '$' . number_format($row["precio"]); ?></td>
                <td><?php echo $row["cedula_clientes"]; ?></td>
                <td> <?php echo '$' . number_format($row['cantidad'] * $row['precio']); ?></td>
                <td><?php echo $row["peticion"]; ?></td>
                <td><?php echo $row["motivo"]; ?></td>

                <td>
                  <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                      <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                    </svg></a>
                </td>
              </tr>

            <?php
            }
            ?>
          </tbody>
        </table>

      </div>
    </div>
</body>

</html>