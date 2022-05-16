<?php
include("../conex.php");

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = "DELETE FROM mainlogin WHERE id = $id";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query failed");
	}

	$_SESSION['message'] = 'Usuario Eliminado correctamente';
	$_SESSION['message_type'] = 'danger';
	header("Location: admin_portada.php");
}
