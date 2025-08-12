<?php
session_start();
include("../../general/consultas/basic.php");
include("../../general/consultas/chat.php");

echo "<link rel='stylesheet' href='../estilo/chat.css'><center>";

$_SESSION['id_us']=1;


if($_POST){
	$msg=$_POST['msg'];
	$chat=$_POST['chat'];

	$mensaje="<div class='avt_prom'><img src='imagen/1.png' width='30px' title='Ing. Alfredo T. Dorado'></div>
		<div class='promotor'>
			$msg
		</div><br>";

	$archivo=fopen("../msg/chat".$chat, "a+");
	fwrite($archivo, "$mensaje \r\n"); 
	fclose($archivo);

	$archivo=fopen("../msg/control".$chat, "w+");
	$mensaje="1";
	fwrite($archivo, "$mensaje \r\n"); 
	fclose($archivo);
}


$dato=bot_bchat($_SESSION['id_us']);
$indice=0;
while ($fila=mysqli_fetch_assoc($dato)){
	$indice=$indice+1;
	
	$chats[$indice]=$fila['id_chat'];

	echo "<div class='adm_chat' id='".$fila['id_chat']."'><div class='adm_msg' id='msg".$fila['id_chat']."'>";
	$archivo="../msg/chat".$fila['id_chat'];
	$archivo=fopen($archivo,"r+");
	while(!feof($archivo)){
		$linea=fgets($archivo);
		$linea=str_replace("img","img hidden",$linea);
		$linea=str_replace("button","button hidden",$linea);
		echo $linea;
	}

	fclose($archivo);
	$chat=$fila['id_chat'];
	echo "</div><br><br><form method='POST'><a href='../g_mensaje.php?chat=$chat&pr=2&tp=1'>bot</a><input type='text' onclick='actualiza(\"$chat\");' name='msg'><input type='text' name='chat' value='".$fila['id_chat']."'><input type='submit'></form></div>";
			
	echo "<script> document.getElementById('msg".$fila['id_chat']."').scrollTop = '9999';</script>";

}

?>
<br><br><a href='index.php'><button>Actualizar</button></a>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<script>
	function actualiza(chat){

		$.ajax({
		    type:'POST', 
		    url: 'lee.php',
		    data: {chat:chat},
		    success:function(data){
			document.getElementById('msg'+chat).innerHTML=data;
			document.getElementById('msg'+chat).scrollTop = '9999';
		   },
		   error:function(data){
		   }
		 });
	    
	}
</script>
