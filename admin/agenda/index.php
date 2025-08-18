<?php
session_start();

$dir = "../../general/";
include($dir."php/admin.php");
include($dir."db/admin.php");
include($dir."db/basica.php");
include($dir."db/calendario.php");
include($dir."db/usuario.php");

r_evento();

cabeza("Agenda - Udimex","", "");
?>

	<style>

		.linea{
			margin:5px 20px;
			display:inline-table;
			text-align:left;
		}

		.linea2{
			margin:0px 20px 0px 0px;
			display:inline-table;
			text-align:left;
		}



	</style>


	<script>

		function cancelar(){
			
			muestra(1);
			document.getElementById('evento').value='';
			document.getElementById('control').value=1;
			document.getElementById('boton_e').value="Guardar";
			document.getElementById('cancela').style.display="none";
			
		}



		function actualiza(id,ag,cons,hi,hf,asunto,desc){
			if(ag==1){
				muestra(1);
				document.getElementById('evento').value=id;
				document.getElementById('tp_g').checked = true;
				document.getElementById('hi').value=hi;
				document.getElementById('hf').value=hf;
				document.getElementById('asunto').value=asunto;
				document.getElementById('desc').value=desc;
			}
			
			if(ag==0){
				muestra(0);
				document.getElementById('evento').value=id;
				document.getElementById('tp_p').checked = true;
				document.getElementById('hi').focus();
				document.getElementById('hi').value=hi;
				document.getElementById('hf').value=hf;
				document.getElementById('asunto').value=asunto;
				document.getElementById('desc').value=desc;
			}

			document.getElementById('control').value=2;
			document.getElementById('boton_e').value="Actualizar";
			document.getElementById('cancela').style.display="inline";
			
		}


		

		function muestra(val){
			
			
			if(val==0){

				document.getElementById('e_colab').style.display='none';
				document.getElementById('colab').style.display='none';
			}
			else{

				document.getElementById('e_colab').style.display='block';
				document.getElementById('colab').style.display='block';
			}
		}

		function fecha(a,m,d,nd){
			document.getElementById('dia'+d).style.color='#ff0000';
			cancelar();

			document.getElementById('formulario').reset();
			dia=["","Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"];
			mes=["","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
		
			ev=document.getElementById('completo'+d).innerHTML;

			document.getElementById('subtitulo1').innerHTML=dia[nd] + " " + d + " de " + mes[m] + " de " + a;
			document.getElementById('fecha').value=a + '-' + m + '-' + d;
			document.getElementById('ev').innerHTML= ev;
			
			document.getElementById('nuevo_ev').style.display='inline-table';
			document.getElementById('final').scrollTop = '9999';

			var f1 = new Date();
			var f2 = new Date(a,m-1,d,20);


			if(f2 >= f1){
				document.getElementById('form1').style.display='inline';
			}
			else{
				document.getElementById('form1').style.display='none';
			}


		}

		function cambia(){
			document.getElementById('cal2').style.display='none';
			an=document.getElementById('anio').value;

			liga="index.php";
			if (an>0){
				liga=liga + "?anio=" + an;
				c=1;
			}
			else{
				c=0;
			}

			m=document.getElementById('mes').value;
			if (m>0){
				if (c==1){
					ad="&";
				}
				else{
					ad="?";
				}
				liga=liga + ad + "mes=" + m;
			}


			location.href=liga;
		}

	</script>



		<body>




<?php
$id=$_SESSION["ad_id"];
$nom=$_SESSION["ad_nom"];
usuario("../../",'index.php');
menu_i();


		
function calendario(){

	$mes=["","ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE"];

	$an=date('Y');
	
	if(isset($_GET['anio'])){
		$an=$_GET['anio'];
	}

	$c_mes=intval(date('m'));
	if(isset($_GET['mes'])){
		$c_mes=$_GET['mes'];
	}
	
	$l_an="";	
	for($i=date('Y')+3;$i>=2021;$i--){
		if($i==$an){
			$ad='selected';
		}
		else{
			$ad='';
		}
		$l_an=$l_an."<option value='$i' $ad>$i</option>";
	}

	$l_mes="";	
	for($i=1;$i<=12;$i++){
		if($i==$c_mes){
			$ad='selected';
		}
		else{
			$ad='';
		}
		$l_mes=$l_mes."<option value='$i' $ad>".$mes[$i]."</option>";
	}


	echo "<div class='linea'><form method='GET'>
		<select name='anio' id='anio' onchange='cambia();' class='bt_campo'> $l_an </select>
		<select name='mes' id='mes' onchange='cambia();' class='bt_campo'> $l_mes </select>
	</form>
	<br>
	<table border='0' bgcolor='#aaaaaa' id='cal2'>
	<tr class='tab_tit'><th>Dom</th><th>Lun</th><th>Mar</th><th>Mié</th><th>Jue</th><th>Vie</th><th>Sáb</th></tr>
	<tr bgcolor='#ffffff'>";




	//primera línea
	$inc=date("N", strtotime($an."-".$c_mes."-01"));
	for($i=0;$i<$inc;$i++){
		echo "<td></td>";
	}


	$num=1;
	$columna=$i+1;
	
	for($fila=1;$fila<7;$fila++){
		for($columna;$columna<=7;$columna++){
			if ($num<=date("t", strtotime("$an-$c_mes-01"))){
				
				//obtiene eventos para el día
				$comp="<div id='completo$num' hidden><center>
						<table border='0' width='90%' bgcolor='#aaaaaa'>
							<tr class='tab_tit' align='left'>
								<th></th>
								<th>Hora</th>
								<th>Colaborador</th>
								<th>Titulo</th>
								<th>Descripción</th>
							</tr>";

				$cumplido="";
				$ev="";
				$i=0;
				$datos=b_ev("$an-$c_mes-$num",0);
				while($fil=mysqli_fetch_assoc($datos)){

					$datos2=b_us($fil['id_usuario'], "");
					
					
					$emp=" ------- ";
					if ($fila2=mysqli_fetch_assoc($datos2)){
						$emp=$fila2['nombre']." ".$fila2['ap_pat'];
					}

					

					$herr="";
					$fc=strtotime($an."-".$c_mes."-".$num);
					$fa=strtotime(date('Y-m-d'));
					
					if ($fc>=$fa){
						$el="";
						if ($fil['id_us']==$_SESSION["ad_id"] or $_SESSION["ad_id"]==1){
							$el="<a href='agenda_el.php?id=".$fil['id_evento']."'>
								<img src='../../general/imagen/salir.png' width='18px' id='el'>
							</a>";
						}
						$herr="<img src='../../general/imagen/edita.png' width='18px' onclick='actualiza(".$fil['id_evento'].",1,\""."\",\"".$fil['hi']."\",\"".$fil['hf']."\",\"".$fil['nombre']."\",\"".$fil['descripcion']."\");'> &nbsp; &nbsp;
							$el <a href='agenda_act.php?ev=".$fil['id_evento']."&es=2'><img src='../../general/imagen/bien.png' height='20px'></a>";

						
					}

					


					if ($fil['estado']==2){
						$cumplido=$cumplido."<tr bgcolor='#00ff00'>
							<td align='center'>
							</td>
							<td>De ".$fil['hi']." a ".$fil['hf']."</td>
							<td>$emp</td>
							<td>".$fil['nombre']."</td>
							<td>".$fil['descripcion']."</td>
						</tr>";
					}
					else{
						$comp=$comp."<tr bgcolor='#ffffff'>
							<td align='center'>
								$herr
							</td>
							<td>De ".$fil['hi']." a ".$fil['hf']."</td>
							<td>$emp</td>
							<td>".$fil['nombre']."</td>
							<td>".$fil['descripcion']."</td>
						</tr>";
					}
					$i=$i+1;
				}
				$comp=$comp."$cumplido</table>";

				//Para agenda personal
				$comp=$comp."<br><br><br>Agenda Personal
				<table border='0' width='90%' bgcolor='#aaaaaa'>
					<tr class='tab_tit'><th></th><th>Hora</th><th>Título</th><th>Descripción</th></tr>";
				$ev="";
				$datos=b_ev("$an-$c_mes-$num",1);
				while($fil=mysqli_fetch_assoc($datos)){

					$datos2=b_us($_SESSION['ad_id'], "");
					$fila2=mysqli_fetch_assoc($datos2);


					$herr="";
					$fc=strtotime($an."-".$c_mes."-".$num);
					$fa=strtotime(date('Y-m-d'));
					if ($fc>=$fa){
						$el="";
						if ($fil['id_us']==$_SESSION["ad_id"]){
							$el="<a href='agenda_el.php?id=".$fil['id_evento']."'>
								<img src='../../general/imagen/salir.png' width='18px' id='el'>
							</a>";
						}
						$herr="<img src='../../general/imagen/edita.png' width='18px' onclick='actualiza(".$fil['id_evento'].",0,\""."\",\"".$fil['hi']."\",\"".$fil['hf']."\",\"".$fil['nombre']."\",\"".$fil['descripcion']."\");'> &nbsp; &nbsp;
							$el";
					}

					$comp=$comp."
					<tr bgcolor='#ffffff'>
						<td align='center'>$herr</td>
						<td align='center'>De ".$fil['hi']." a ".$fil['hf']."</td>
						<td align='center'>".$fil['nombre']."</td>
						<td align='center'>".$fil['descripcion']."</td>
					</tr>";
					$i=$i+1;
				}
				$comp=$comp."</table>";
			


				$comp=$comp."</div>";
				



				$c="";
				if(date("N", strtotime($an."-".$c_mes."-".$num))>5){
					$c="bgcolor='#cccccc'";
				}

				
				$fc=strtotime($an."-".$c_mes."-".$num);
				$fa=strtotime(date('Y-m-d'));
				if ($fc==$fa){
					$c="bgcolor='#bcd3df'";
				}
				
				
				echo "<td id='dia$num' onclick='fecha($an,$c_mes,$num,$columna); f_ant($an,$c_mes,$num,$columna);' valign='top' $c>";
				if($i>0){
					echo "<div id='dia$num' align='center' class='dia'>$num</div>$comp";
					
				}
				else{
					echo "<div id='dia$num' align='center'>$num</div><div id='evento$num' class='evento'></div>$comp";
				}
				echo "</td>";
				$num=$num+1;
				
				
			}
			else{
				echo "<td><br></td>";
				$fila=10;
			}
		}
		$columna=1;
		echo "</tr><tr bgcolor='#ffffff'>";
	}
	echo "</tr></table></div>";

$op_us="";
$datos=b_admin();
while($fila=mysqli_fetch_assoc($datos)){
	$op_us=$op_us."<option value='".$fila['id_usuario']."'>".$fila['nombre']." ".$fila['ap_pat']."</option>";
}


	
	// DIV oculto
	echo "<div id='nuevo_ev' hidden><center><div id='subtitulo1' class='color_prim'></div><center>
	<hr><div id='resp'></div>


	<form method='POST' action='../agenda/agenda_act.php' autocomplete='off' id='formulario'>
		<input type='hidden' id='evento' value='0' name='evento'>
		<input type='hidden' id='control' value='1' name='control'>
		<input type='hidden' id='fecha' name='fecha' value=''>
		<input type='hidden' name='reg' value='".$_SESSION['ad_id']."'>
		
		<div class='linea'>
			<div class='linea2'>Agenda:</div>
			<div class='linea2'>
				<input type='radio' name='tipo' checked onclick='muestra(1);' value='0' id='tp_g'> General<br> 
				<input type='radio' name='tipo' onclick='muestra(0);' value='1' id='tp_p'> Personal
			</div>
		<div class='linea'>
			<div id='e_colab'>Atiende:</div><br>
			<select name='colab' id='colab' class='c_ag'>$op_us</select>
		</div>
		<div class='linea'>
			<div class='linea2'>
				Inicio:<br>Fin:
			</div>
			<div class='linea2'>
				<input type='time' id='hi' name='hi' value='00:00 a. m.'><br>
				<input type='time' id='hf' name='hf' value='00:00 a. m.'>
			</div>
		</div>
		<div class='linea'>
			<div clsss='linea2'>
				<input type='text' id='asunto' name='asunto' placeholder='Asunto'><br>
				<input type='text' id='desc' name='desc' placeholder='Descripción'>
				<p align='right'>
					<input type='reset' value='Cancelar' id='cancela' onclick='cancelar();' style='display:none;'>&nbsp; &nbsp; 
					<input type='submit' value='Guardar' id='boton_e'>
			</div>
		</div>
	</form></div></div><hr>
	<div id='ev'></div>
	";
	
}

calendario();



if (isset($_SESSION['fecha_anterior'])){
	$fecha=explode("@",$_SESSION['fecha_anterior']);
	echo "<script> fecha(".$fecha[0].",".$fecha[1].",".$fecha[2].",".$fecha[3]."); </script>";
}


if (isset($_GET['dia'])){
	$nd = date("w", strtotime($_GET['anio']."-".$_GET['mes']."-".$_GET['dia'])) + 1;
	echo "<script>fecha(".$_GET['anio'].",".$_GET['mes'].",".$_GET['dia'].",$nd);</script>";
}

if (!isset($_GET['dia'])){

	$nd = date('w')+1;
	echo "<script>fecha(".date('Y').",".date('m').",".date('d').",$nd);</script>";
}
?>











<a href='agenda_cumple.php'>Verifica el cumplimiento</a>

<br><br><br><br>


</div>
<div id='final'></div>

</div></div>















	</body>





</html>
