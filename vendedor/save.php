<?php

include("../conex.php");

if (isset($_GET['save'])) {
	$fecha = $_GET['fecha'];
	$sucursal = $_GET['sucursal'];
   $cantidad = $_GET['cantidad'];
   $producto = $_GET['producto'];
   $cedula_clientes = $_GET['cedula_clientes'];
   $nombre_vendedor = $_GET['nombre_vendedor'];

   $query = "SELECT * FROM logistica where id = $producto LIMIT 1";
   $result_Product = mysqli_query($conn, $query);

 

   while ($row = mysqli_fetch_array($result_Product)){
	   $precio = $row['precio'];
	   $nombre_Producto = $row['producto'];
   }
    
   $valor_total = $precio * $cantidad;

	$query = "INSERT INTO sales(fecha,sucursal,cantidad,producto,cedula_clientes,precio,nombre_vendedor, valor_total) VALUES ('$fecha','$sucursal','$cantidad','$nombre_Producto','$cedula_clientes','$precio','$nombre_vendedor','$valor_total')";
	$result = mysqli_query($conn, $query);


	if (!$result) {
		die("Query failed");
	}


	$_SESSION['message'] = 'Venta creada satisfactoriamente';
	$_SESSION['message_type'] = 'primary';



	header("Location: personal_portada.php");
}
