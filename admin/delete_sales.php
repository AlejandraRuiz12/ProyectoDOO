<?php
include("../conex.php");

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = "DELETE FROM sales WHERE id = $id";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query failed");
	}

	$_SESSION['message'] = 'Venta removida satisfactoriamente';
	$_SESSION['message_type'] = 'danger';
	header("Location: registre_sales.php");
}
