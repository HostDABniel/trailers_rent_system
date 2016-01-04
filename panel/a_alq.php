<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){

include ("conn1.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};

$cliente = $_POST["cliente"];
$vendedor = $_POST["vendedor"];
//$remolque = $_POST["remolque"];
$valor_dia = $_POST["valor_dia"];
$valor_semana = $_POST["valor_semana"];

if($id == ''){
	$fecha_captura = date("Y/m/d H:i:s");
	$fecha_captura = strtotime ( '-4 hour' , strtotime ( $fecha_captura ) ) ;
	$fecha_captura = date ( 'Y/m/d H:i:s' , $fecha_captura );
}else{
	$fecha_captura = $_POST["fecha_captura"];
};

$fecha_renta = $_POST["fecha_renta"];
$fecha_alquilada = $_POST["fecha_alquilada"];
$fecha_devolucion = $_POST["fecha_devolucion"];
$cambio = $_POST["cambio"];
$fecha_cambio = $_POST["fecha_cambio"];
$precio_antes_cambio = $_POST["precio_antes_cambio"];
$precio_total = $_POST["precio_total"];
$tiempo = $_POST["tiempo"];
$cantidad = $_POST["cantidad"];

$danos = $_POST["danos"];
$observaciones = $_POST["observaciones"];

if($tiempo == 'dias'){$remolque = $valor_dia;}else{$remolque = $valor_semana;};

if($_SESSION["tipo"] == 'admin') {
	 $vendedor = $_POST["vendedor"];
}else{
	 $vendedor = $_SESSION["vendedor"];
};

	if ($id == ''){ $aqui = '0';
$sql11 = "INSERT INTO alquiler(cliente, vendedor, remolque, fecha_captura, fecha_renta, fecha_alquilada, cantidad, tiempo, 
	precio_total, danos, observaciones) 
VALUES('".$cliente."', '".$vendedor."', '".$remolque."', '".$fecha_captura."', '".$fecha_renta."', '".$fecha_alquilada."', 
	'".$cantidad."', '".$tiempo."', '".$precio_total."', '".$danos."', '".$observaciones."')";
$result = mysql_query($sql11);
								
	}else{
		$sql1 = "UPDATE alquiler SET cliente='".$cliente."', vendedor='".$vendedor."', remolque='".$remolque."',  
		fecha_captura='".$fecha_captura."',  fecha_renta='".$fecha_renta."',  fecha_alquilada='".$fecha_alquilada."',  
		fecha_devolucion='".$fecha_devolucion."',  cambio='".$cambio."', fecha_cambio='".$fecha_cambio."', 
		precio_antes_cambio='".$precio_antes_cambio."',  precio_total='".$precio_total."', tiempo='".$tiempo."',
		cantidad='".$cantidad."', danos='".$danos."', observaciones='".$observaciones."' WHERE id=".$id;			
		$result = mysql_query($sql1);
	};
		
	if($vi == ''){			header("location: ../gracias.php?tipo=alq&alq=".$aqui);		}
	else{			header("location: ../alquiler.php");		};
	
				mysql_close($conn1);
				$llego = 'ok';
};
?>