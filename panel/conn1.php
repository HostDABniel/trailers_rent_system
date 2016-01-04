<?php

$conn1 = mysql_connect("localhost","em000596_remolma","42vakeVEba");

if (! $conn1){
	echo "Error al intentar conectarse con el servidor MySQL";
	exit();
	};

if (! mysql_select_db("em000596_remolma",$conn1)){
	echo "No se pudo conectar correctamente con la Base de datos";
	exit();
	};
?>