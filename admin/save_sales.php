<?php

include("../conex.php");

if (isset($_GET['save'])) {
	$fecha = $_GET['fecha'];
	$sucursal = $_GET['sucursal'];
   $cantidad = $_GET['cantidad'];
   $producto = $_GET['producto'];
	 $precio = $_GET['precio'];
   $cedula_clientes = $_GET['cedula_clientes'];

	$query = "INSERT INTO sales(fecha,sucursal,cantidad,producto,cedula_clientes,precio) VALUES ('$fecha','$sucursal','$cantidad','$producto','$cedula_clientes','$precio')";
	$result = mysqli_query($conn, $query);

	if (!$result) {
		die("Query failed");
	}


	$_SESSION['message'] = 'Venta creada satisfactoriamente';
	$_SESSION['message_type'] = 'primary';



	header("Location: registre_sales.php");
}
