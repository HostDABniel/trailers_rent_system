<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){

include ("conn1.php");
	
$id = $_REQUEST["id"];

	
	$sql1 = "DELETE FROM productos WHERE id=".$id;
	$result = mysql_query($sql1);
	header("location: ../productos.php");

	
	mysql_close($conn1);
	}
else{
	header("location: login.php");
	};
?>