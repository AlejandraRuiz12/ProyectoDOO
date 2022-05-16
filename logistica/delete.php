<?php
include("../conex.php");

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = "DELETE FROM logistica WHERE id = $id";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query failed");
	}

	$_SESSION['message'] = 'Producto removida satisfactoriamente';
	$_SESSION['message_type'] = 'danger';
	header("Location: usuarios_portada.php");
}
