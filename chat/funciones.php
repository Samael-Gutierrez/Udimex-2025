<?php
//session_start();
//include('consultas/basic.php');
//include('consultas/chat.php');


function ejecuta_funcion($id,$id_pregunta){
	if($id==1){
		iniciar_chat();
	}
	if($id==2){
		termina_chat();
	}
	if($id==4){
		generales_alumno($id_pregunta);
	}
}


function iniciar_chat(){
	$chat=bot_gchat();
	$_SESSION['chat']=$chat;
}

function termina_chat(){
	$chat=$_SESSION['chat'];
	bot_achat($chat);

	$archivo=fopen("msg/control".$_SESSION['chat'].".alf", "w+");
	$mensaje=$_SESSION['mensajes'];
	fwrite($archivo, "$mensaje"); 
	fclose($archivo);

	$_SESSION['mensajes']="";
	session_destroy();
}

function generales_alumno($id_pregunta){
$_SESSION['opciones']="<iframe src='inscripcion.php' id='ins'>
</iframe>";
}

function busca_campaña($id){
	$dato=bot_camp($camp);
	if($fila=mysqli_fetch_assoc($dato)){
		return $fila['principal'];
	}
	else{
		return 1;
	}
}




?>
