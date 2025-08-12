<?php 
session_start();

$dir = "../../general/";
include($dir."php/admin.php");
include($dir."db/admin.php");
include($dir."db/basica.php");
include($dir."db/conta.php");

$referencias = "
	<link rel='stylesheet' href='estilo.css'>
	<script type='text/javascript' src='../../general/js/jquery-1.6.4.js'></script> 
";

cabeza("Contabilidad - Udimex", $referencias, "");
?>
<body>
<?php
usuario("../../", 0);
menu_i();

$d=date('d');
$m=date('m');
$a=date('Y');


$d1=date('d');
$m1=date('m');
$a1=date('Y');

$fi=$a."-".$m."-01";
$ff=$a."-".$m."-31";

$fi1=$a."-".$m."-01";
$ff1=$a."-".$m."-31";

$ing=0;
$eg_es=0;
$eg_per=0;

$consulta=b_ing($fi,$ff);
if($fila=mysqli_fetch_assoc($consulta)){
	$ing=$fila['res'];
}

$sobre = b_sobrecargos($fi,$ff);
if($fila=mysqli_fetch_assoc($sobre)){
	$ing = $ing + $fila['total'];
}

$consulta=b_eg($fi,$ff,1);
if($fila=mysqli_fetch_assoc($consulta)){
	$eg_es=$fila['res'];
}

$consulta=b_eg($fi,$ff,2);
if($fila=mysqli_fetch_assoc($consulta)){
	$eg_per=$fila['res'];
}

$eg=$eg_es+$eg_per;
$neto=$ing-$eg;

$ing=number_format($ing, 2, '.', ',');
$eg_es=number_format($eg_es, 2, '.', ',');
$eg_per=number_format($eg_per, 2, '.', ',');
$eg=number_format($eg, 2, '.', ',');
$neto=number_format($neto, 2, '.', ',');


echo " <div class='fondo'>
<div class='tabla hover-pointer tod ' style='width:30%; display:inline-block; margin:20px;'>
	<div class='bordes border'>
		<div class='w3-padding-large w3-center barra'>
			Ingresos
		</div>
	</div>
	<p class=''>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp $$ing</p>
	
</div>

<div class='tabla hover-pointer tod' style='width:30%; display:inline-block; margin:20px;'>
	<div class='bordes border'>
		<div class='w3-padding-large w3-center barra'>
			Egresos
		</div>
	</div>
	<p class='w3-center'>Udimex: $ $eg_es</p>
	<p class='w3-center'>Personales: $ $eg_per</p>
	<p class='w3-center'>Total: $ $eg</p>

</div>

<div class='tabla hover-pointer tod' style='width:30%; display:inline-block; margin:20px;'>
	<div class='bordes border'>
		<div class='w3-padding-large w3-center barra'>
			Ganancia Neta
		</div>
	</div>
	<p class='w3-center'>$ $neto</p>

</div></div><div class='fondo'>
";
?>
<div>
<div class='fondo'>

<div class="alinear"><!--animation-->
<div class='color_egresos hover-pointer tod' style='width:30%; margin:20px;'>
    <div class='w3-padding-large w3-center bordes barra'>
        Agregar ingresos
    </div>
	<form method='POST' action='g_ing.php'>
        <div class='w3-col w3-container' style='width:30%'></div>
        <div class='w3-col w3-container' style='width:70%'><input type='number' name='cant1' class='c_input' placeholder='Cantidad'></div>
        <div class='w3-col w3-container' style='width:30%'></div>
        <div class='w3-col w3-container' style='width:70%'><input type='text' name='descu' class='c_input' placeholder='Concepto'></div>
        <div class='w3-col w3-container' style='width:30%'></div>
        <div class='w3-col w3-container' style='width:70%'>
            <?php 
                $fe1=date('Y-m-d');
                echo "<input  type='date' name='fecha' value='$fe1'>"; 
            ?>
        </div>
        <div class='w3-col w3-container' style='width:30%'></div>
        <div class='w3-col w3-container' style='width:70%'><input type='submit' value='Guardar'></div>
        <br>
    </form>
</div>
<div class='color_egresos hover-pointer tod ' style='width:30%; margin:20px;'>
    <div class='w3-padding-large w3-center bordes barra'>
        Agregar gastos
    </div>
	<form method='POST' action='g_gas.php'>
        <div class='w3-col w3-container' style='width:30%'></div>
        <div class='w3-col w3-container' style='width:70%'><input type='number' name='cant' class="c_input" placeholder="Cantidad"></div>
        <div class='w3-col w3-container' style='width:30%'></div>
        <div class='w3-col w3-container' style='width:70%'><input type='text' name='desc'  class="c_input" placeholder="Concepto"></div>
        <div class='w3-col w3-container' style='width:30%'></div>
        <div class='w3-col w3-container' style='width:70%'>
            <?php 
                $fe=date('Y-m-d');
                echo "<input type='date' name='fecha' value='$fe'>"; 
            ?>
        </div>
        <div class='w3-col w3-container' style='width:30%'></div>
        <div class='w3-col w3-container' style='width:70%'><input type='submit' value='Guardar'></div>
        <br>
    </form>
</div><!--hasta aqui animation-->
</div>
</div>
</div>
</div>
<div>
<br><center>
	<form id='reporte'>
		<div class="l_blanca">
		Año <select class="hover-pointer1 tod" name='anio' id='anio' onchange='busca_gasto(); busca_ingresos();'>
			<option selected value='<?php echo $a; ?>'><?php echo $a; ?></option>
			<option value='<?php echo $a-1; ?>'><?php echo $a-1; ?></option>
		</select>&nbsp; &nbsp; &nbsp; &nbsp;

		Mes <select class="hover-pointer1 tod"  name='mes' id='mes' onchange='busca_gasto(); busca_ingresos();'>
			<?php 
				for($i=1;$i<=12;$i++){
					$sel="";
					if($i==$m){
						$sel='selected';
					}
					echo "<option value='$i' $sel>$i</option>"; 
				}
			?>
			</center>
		</select>
	<center><script> busca_gasto(); 
	
	
	busca_ingresos(); </script>
	</center>
	<!--TABLAS-->
	<div>
		<div class="contain1">
			<p class="left1 borde hover-pointer tod ">INGRESOS</p>
			<p class="right1 borde hover-pointer tod ">EGRESOS</p><br><br>
		</div>
		<div  id='ingreso' class="left"></div>
	</div>

	<div id='egreso' class="right"></div><br> 
</div>
</div>

<script>
	function busca_gasto(){
		var url = 'b_gas.php';
			$.ajax({                        
			type: 'POST',                 
			url: url,                     
			data: $('#reporte').serialize(), 
			success: function(data)             
			{
				$('#egreso').html(data); 
								
			}
		});
	}

	function busca_ingresos(){
		var url = 'b_ing.php';
			$.ajax({                        
			type: 'POST',                 
			url: url,                     
			data: $('#reporte').serialize(), 
			success: function(data)             
			{
				$('#ingreso').html(data); 
								
			}
		});
	}

</script>
</body>
</html>
