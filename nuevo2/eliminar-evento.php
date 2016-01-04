<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'user')){
	
include ("panelmed/conn1.php");
include ("panelmed/rempla_fech.php");

$c = $_POST["c"];if($c == ''){$c = $_REQUEST["c"];};
$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};
$id_categ = $_POST["id_categ"];if($id_categ == ''){$id_categ = $_REQUEST["id_categ"];};
//$id_categ = $_REQUEST["id_categ"];


	$sql1 = "SELECT * FROM pedidos WHERE id='".$id."' ORDER BY fecha_entrega ASC";
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
<title>Administrador</title>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" rel="stylesheet" href="jquery.datetimepicker.css"/>



<script type="text/javascript">
function surfto(form)
{
var myindex = form.categoria.selectedIndex;
window.open(form.categoria.options[myindex].value,"_top");
}
</script>




<!----------------------------------------      AUTOCOMPLETAR 	------------------------------------->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        
        <script type="text/javascript">
                $(document).ready(function(){
						$("#hospital").autocomplete({
							source:'getautocomplete.php',
							multiple: true,
							minLength:1
						});
                });
				
        </script>   
        
        <script type="text/javascript">
                $(document).ready(function(){
						$("#doctor").autocomplete({
							source:'getautocompletedoc.php',
							multiple: true,
							minLength:1
						});
                });
				
        </script>
        
        <script type="text/javascript">
                $(document).ready(function(){
						$("#producto").autocomplete({
							source:'getautocompleteprod.php',
							multiple: true,
							minLength:1
						});
                });
				
        </script> 
        
        <script type="text/javascript">
                $(document).ready(function(){
						$("#intrumentista").autocomplete({
							source:'getautocompleteintrumentista.php',
							multiple: true,
							minLength:1
						});
                });
				
        </script> 
        <!------------------------------------------------------------------------------------------>
</head>

<body>
<div class="menubar">
  <a href="programacion.php" class="op lop">INICIO</a>
  <a href="estadisticas.php" class="op mop">Estadisticas</a>
<?php if($_SESSION["tipo"] == 'admin' || $_SESSION["usuarios"] == '1'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php }else{	?>
  <div class="opb ropb"></div>
  <?php };?>
</div>
<div class="tp">
<div class="subpanel"><a href="datos.php"><img src="ic-sets.png" width="20" height="20" /></a><!--<a href="index.php"><img src="ic-home.png" width="20" height="20" style="margin-right:12px"/></a>--></div>
  <div class="cf"></div>
</div>
<form method="post" action="panelmed/b_ped.php?id=<?php echo $id;?>&tipo=<?php echo $tipo;?>" name="frmRegistro">
<div class="onecol"><span class="titlecol-ad">Eliminar pedido </span>
  

<div class="campitem">

    <div class="campe dosporx2">
    <input type="hidden" name="id" value="<?php echo $id?>"/>
<strong>Doctor: </strong>
 <?php	
	$id_doc = get_string_between("(", ")", $row["doctor"]);	// SACA EL ID QUE ESTA ENTRE PARENTESIS
	
	$sql9= "SELECT * FROM doctor WHERE id = '".$id_doc."' ORDER BY nombre";
	$result9 = mysql_query($sql9, $conn1);
	$row9 = mysql_fetch_array($result9);
	 echo $row9["nombre"]
	?>
 
    </div>
    <div class="campe dosporx2">  <strong>Intrumentista: </strong>
      <?php	//
	$id_ins = get_string_between("(", ")", $row["intrumentista"]);	// SACA EL ID QUE ESTA ENTRE PARENTESIS
//	echo '('.$id_ins.')';
	$id_ins0 = $id_ins;
	
	$sql9in= "SELECT * FROM intrumentista WHERE id='".$row["intrumentista"]."'";
	$result9in = mysql_query($sql9in, $conn1);
	$row9in = mysql_fetch_array($result9in);
	echo $row9in["nombre"];?>
    
    </div>
  </div>
  
  <div class="campitem dospor">    
    <?php if($_SESSION["city_habilita"]== '1' || $_SESSION["tipo"] == 'admin'){?>
    <div class="campb"> <strong>Ciudad:</strong>
<?php	//
	//  echo $row["ciudad"];
	$sql9h= "SELECT * FROM ciudad WHERE id = '".$row["ciudad"]."' ORDER BY estado, nombre ASC";
	$result9h = mysql_query($sql9h, $conn1);
	$row9h = mysql_fetch_array($result9h);
	echo $row9h["nombre"]?>
   
    </div>
    <?php }else{?><input type="hidden" name="ciudad" value="<?php echo $_SESSION["ciudad"]?>"/><?php		};		?>
    
    <div class="campb dospor"><strong>Hospital:</strong>
<?php	//
	$id_hosp = get_string_between("(", ")", $row["hospital"]);	// SACA EL ID QUE ESTA ENTRE PARENTESIS
	$sql9= "SELECT * FROM hospital WHERE id = '".$id_hosp."' ORDER BY nombre";
	$result9 = mysql_query($sql9, $conn1);
	$row9 = mysql_fetch_array($result9);
	echo $row9["nombre"]?>
    </div>
  </div>
  <div class="cf"></div>
  
  <div class="campitem">
    <div class="campb"><strong>Fecha de Entrega:</strong> <?php if($id != ''){echo substr($row["fecha_entrega"],0,4).'/'.substr($row["fecha_entrega"],5,2).'/'.substr($row["fecha_entrega"],8,2).' '.substr($row["fecha_entrega"],11,2).':'.substr($row["fecha_entrega"],14,2);	};?>
    </div>
  <div class="campb dospor"><strong>Cirugia:</strong> <?php echo $row["cirugia"];?></div>
  </div>
  
  

 <div class="campitem dospor">
    <div class="campc"><strong>Producto: </strong><?php echo $row["producto"];?>    </div>
  </div>
  
  
  <div class="campitem">
    <div class="campb"><strong>Nombre del Paciente:</strong> <?php echo $row["nombre_paciente"];?>    </div>
    <div class="campb dospor"><strong>Aseguradora:</strong>
<?php	//	
	$sql9h= "SELECT * FROM aseguradora ORDER BY nombre";
	$result9h = mysql_query($sql9h, $conn1);
	$row9h = mysql_fetch_array($result9h);
	echo $row9h["nombre"];
?> 

    </div>
  </div>
  
  
  <div class="campitem dospor">
    <div class="campb"><strong>Modo de Pago:</strong> <?php echo $row["modo_pago"];?></div>
    
    <div class="campb dospor"><strong>Monto: </strong><?php echo $row["monto_de_pago"];?></div>
  </div>
  <div class="campitem ">
  
  <div class="campb"><strong>Nº de Pedido:</strong> <?php echo $row["n_pedido"];?></div>
    
    <div class="campb dospor"><strong>Nº de Factura:</strong> <?php echo $row["n_factura_descr"];?>    </div>
    
  </div>
  
  <div class="campitem dospor">  
  <div class="campb">
      <label for="textfield2"></label>
<!--      <form id="form1" name="form1" method="post" action="">-->
        <input type="checkbox" name="entregado" id="checkbox"  value="1"<?php if($row["entregado"] == '1'){echo '  checked="checked"';};?>/>
        <label for="checkbox"></label>
      Entregado &nbsp;&nbsp;&nbsp;
      <input type="checkbox" name="pagado" id="checkbox2"  value="1"<?php if($row["pagado"] == '1'){echo '  checked="checked"';};?>/>
      <label for="checkbox2"></label>
      Pagado
<!--      </form>-->
    </div>
    
    <div class="campb dospor">
    
    </div>
  </div>
  
  <div class="cf"></div>

  
  <div class="campitem">
    <div class="campc"><?php echo $row["comentarios"];?>    </div>
    
  </div>
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

<?php    $created = date("Y-m-d H:i:s");	?>

<!--<script type="text/javascript" src="./jquery.js"></script>-->
<script type="text/javascript" src="./jquery.datetimepicker.js"></script>
<script type="text/javascript">
$('#datetimepicker').datetimepicker()
<!--	.datetimepicker({value:'<?php //echo $created;?>',step:10});-->

$('#datetimepicker_mask').datetimepicker({
	mask:'9999/19/39 29:59'
});

$('#datetimepicker1').datetimepicker({
	datepicker:false,
	format:'H:i',
	step:5
});
$('#datetimepicker2').datetimepicker({
	yearOffset:222,
	lang:'ch',
	timepicker:false,
	format:'d/m/Y',
	formatDate:'Y/m/d',
	minDate:'-1970/01/02', // yesterday is minimum date
	maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
$('#datetimepicker3').datetimepicker({
	inline:true
});
$('#datetimepicker4').datetimepicker();
$('#open').click(function(){
	$('#datetimepicker4').datetimepicker('show');
});
$('#close').click(function(){
	$('#datetimepicker4').datetimepicker('hide');
});
$('#reset').click(function(){
	$('#datetimepicker4').datetimepicker('reset');
});
$('#datetimepicker5').datetimepicker({
	datepicker:false,
	allowTimes:['12:00','13:00','15:00','17:00','17:05','17:20','19:00','20:00']
});
$('#datetimepicker6').datetimepicker();
$('#destroy').click(function(){
	if( $('#datetimepicker6').data('xdsoft_datetimepicker') ){
		$('#datetimepicker6').datetimepicker('destroy');
		this.value = 'create';
	}else{
		$('#datetimepicker6').datetimepicker();
		this.value = 'destroy';
	}
});
var logic = function( currentDateTime ){
	if( currentDateTime ){
		if( currentDateTime.getDay()==6 ){
			this.setOptions({
				minTime:'11:00'
			});
		}else
			this.setOptions({
				minTime:'8:00'
			});
	}
};
$('#datetimepicker7').datetimepicker({
	onChangeDateTime:logic,
	onShow:logic
});
$('#datetimepicker8').datetimepicker({
	onGenerate:function( ct ){
		$(this).find('.xdsoft_date')
			.toggleClass('xdsoft_disabled');
	},
	minDate:'-1970/01/2',
	maxDate:'+1970/01/2',
	timepicker:false
});
$('#datetimepicker9').datetimepicker({
	onGenerate:function( ct ){
		$(this).find('.xdsoft_date.xdsoft_weekend')
			.addClass('xdsoft_disabled');
	},
	weekends:['01.01.2014','02.01.2014','03.01.2014','04.01.2014','05.01.2014','06.01.2014'],
	timepicker:false
});


$('#datetimepicker10').datetimepicker({
	step:5,
	inline:true
});

$('#datetimepicker_start_time').datetimepicker({
	startDate:'+1970/05/01'
});

$('#datetimepicker_unixtime').datetimepicker({
	format:'unixtime'
});
$('#datetimepicker11').datetimepicker({
        hours12: false,
        format: 'Y-z H:i W',
        step: 1,
        opened: false,
        validateOnBlur: false,
        closeOnDateSelect: false,
        closeOnTimeSelect: false
});
</script>



</html>

<?php

	mysql_close($conn1);
	}
else{
	header("location: login.php");
	};		
	?>