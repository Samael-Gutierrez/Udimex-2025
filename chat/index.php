<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

	function scroll(){
		document.getElementById('mensajes').scrollTop = '999999';
	}

	function guarda(variable,pregunta){

		dato=document.getElementById('msg').value;
		$.ajax({
		    type:'POST', 
		    url: 'g_dato.php',
		    data: {variable:variable,dato:dato,pregunta:pregunta},
		    success:function(data){
				if(data==1){
					alert('guardado');
				}
				if(data==0){
					siguiente(13,1,0);
				}
		   },
		   error:function(data){
		   }
		 });
	}

	function siguiente(id_pregunta,tipo,sig){
		$.ajax({
		    type:'POST', 
		    url: 'g_mensaje.php',
		    data: {id_pregunta:id_pregunta,tipo:tipo,sig:sig},
		    success:function(data){
				document.getElementById('mensajes').innerHTML = data;
				scroll();
		   },
		   error:function(data){
		   }
		 });
	}




</script>
<script>
$(document).ready(function(){
	$('#msg').keyup(function(e){
		if(e.keyCode==13){
			msg=document.getElementById('msg').value;
			siguiente(msg,3,0);
			document.getElementById('msg').value="";

		}
			
	});
});
</script>



<?php
session_start();
//session_destroy();

function ver_chat($msg){
	echo "	
		<link rel='stylesheet' href='estilo/venta.css'>
		<div id='chat'>
			<div id='atiende'><img src='../imagen/udibot.png' width='70px'><p>Udibot</p></div>
			<div id='mensajes'>
				$msg
			<br></div>
			<div id='mensaje'></div>
		</div>";
}



function inicia_chat($camp){

	$pr=100;
	$tp=1;
	$sig=0;


	if ($camp==2){
		$pr=200;
		$tp=1;
		$sig=0;
	}


	if (isset($_SESSION['mensajes'])){
		ver_chat($_SESSION['mensajes'].$_SESSION['opciones']);
	}
	else{
		ver_chat("<div id='espera'><img src='../imagen/carga.gif' width='100px'></div>");
		echo "<script>siguiente($pr,$tp,$sig);</script>";
	}
}

//Trata de obtener campaña, si no existe inicia en 1
$camp=1;
$estilo="
	--ancho:70%;
	--margen:8px;
	--margen_chat:0% 14%;
	--alto:95%;
	--letra:15px;
";
		
if ($_GET){
	$camp=$_GET['c'];
	if($camp==2){
		$estilo="
		--ancho:100%;
		--margen:0px;
		--margen_chat:0px;
		--alto:100%;
		--letra:12px;
		";
	}
}

//Crea el estilo personalizado por ventana
echo "<style>
	:root {
		".$estilo."
	}
</style>";	

inicia_chat($camp);



?>

<script>
	scroll();
</script>


