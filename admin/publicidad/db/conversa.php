<?php

	function busca_conversacion($ad){
		$consulta="select * from chat_usuario where estado>0 $ad order by fecha asc, hora asc limit 1";
		return completa($consulta);
	}

	function busca_complemento($palabra){
		$consulta="select * from chat_complemento where palabra like '%$palabra%'";
		return completa($consulta);
	}

	function busca_patrones($patrones){
		$consulta="select * from chat_patron ".$patrones;
		return completa($consulta);
	}

	function busca_mensaje($id){
		$consulta="select * from chat_mensaje where id_mensaje=$id";
		return completa($consulta);
	}

	function guarda_texto($mens){
		$consulta="insert into chat_texto values('','$mens',0)";
		return completa2($consulta);
	}

	function actualiza_usuario($tel,$estado){
		$fecha=date('Y-m-d');
		$hora=date('H:i');
		$consulta="update chat_usuario set fecha='$fecha', hora='$hora', estado=$estado where destino='$tel'";
		completa($consulta);
	}

	function busca_texto(){
		$consulta="select * from chat_texto where estado=0 limit 1";
		return completa($consulta);
	}

	function guarda_mensaje2($mensaje,$funcion){
		$consulta="insert into chat_mensaje values('','$mensaje',$funcion)";
		return completa2($consulta);
	}

	function guarda_patron($patron,$contexto,$id){
		$consulta="insert into chat_patron values('','$patron',$contexto,$id)";
		completa($consulta);
	}

	function elimina_texto($mens){
		$consulta="delete from chat_texto where texto='$mens'";
		completa($consulta);
	}

	function b_chats(){
		$consulta="SELECT * FROM chat_usuario where estado>0 order by fecha asc, hora asc limit 1";
		return completa($consulta);
	}

	function elimina_tel(){
		$consulta="truncate table chat_usuario";
		completa($consulta);
	}

	function guarda_tel($tel,$destino,$fecha,$hora,$edo){
		$consulta="insert into chat_usuario values('','$tel','$destino','$fecha','$hora',$edo)";
		completa($consulta);
	}
?>
