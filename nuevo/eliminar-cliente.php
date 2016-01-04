<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");

$c = $_POST["c"];if($c == ''){$c = $_REQUEST["c"];};
$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};
$id_categ = $_POST["id_categ"];if($id_categ == ''){$id_categ = $_REQUEST["id_categ"];};
//$id_categ = $_REQUEST["id_categ"];


	$sql1 = "SELECT * FROM cliente WHERE id='".$id."' ";
	$result1 = mysql_query($sql1, $conn1);
	$row = mysql_fetch_array($result1);
	$bandera = 'ok';

	
/*if($_SESSION["city_habilita"]	!= '1' && $_SESSION["tipo"] != 'admin'){ 	
if($_SESSION["ciudad"] < 6){$c = '1';};
if($_SESSION["ciudad"] > 5){$c = '2';};
};*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="log-out">
  <div class="lo-logo"><img src="aologo.png" width="204" height="48" /></div>
  <div class="lo-logout"><a href="salir.php">Cerrar sesión</a></div>
</div>


    <div class="menubar" style="background-color:#000">
      <a href="programacion.php" class="op lop">Programacíon</a>
    <?php if($_SESSION["tipo"] == 'admin' || $_SESSION["estadisticas"] == '1'){?>   <a href="estadisticas.php" class="op mop">Estadisticas</a><?php };?>
    <?php if($_SESSION["tipo"] == 'admin' || $_SESSION["usuarios"] == '1'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php };?>
    </div>
    
    
    
<form method="post" action="panel/b_doc.php?id=<?php echo $id;?>&tipo=<?php echo $tipo;?>" name="frmRegistro">
<div class="onecol"><span class="titlecol-ad">Eliminar Cliente </span>
  

<div class="campitem">

    <div class="campe dosporx2">
    <input type="hidden" name="id" value="<?php echo $id?>"/>
	<strong>Contacto: </strong> <?php echo $row["contacto"];?> 
    </div>
    <div class="campe dosporx2">  <strong>Nombre: </strong><?php echo $row["nombre_empresa"];?> 
    
    </div>
  </div>
  
  <div class="campitem dospor">    
    <?php if($_SESSION["city_habilita"]== '1' || $_SESSION["tipo"] == 'admin'){?>
    <div class="campb"> <strong>Colonia:</strong>
<?php echo $row["colonia"];?>
   
    </div>
    <?php };		?>
    
    <div class="campb dospor"><strong>Telefono:</strong><?php	echo $row9["telefono"]?>
    </div>
  </div>
  <div class="cf"></div>
  
  <div class="campitem">
    <div class="campb"><strong>Correo:</strong> <?php echo $row["email"];?> </div>
  </div>
  
  

  
  
  
  <div class="cf"></div>

  
  
  <div class="campitem dospor">
    <div class="campc">
      <input type="submit" name="add"  value="Eliminar" class="rax"/> 		
<!-- <a href="javascript:document.forma.submit();" class="ra">Guardar</a> -->
</div>
  </div>
  
  
  
  
  
  
  
  <div class="cf"></div>
</div>
</form>
</body>


</html>

<?php

	mysql_close($conn1);
	}
else{
	header("location: login.php");
	};		
	?>