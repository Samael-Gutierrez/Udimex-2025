<?php
//**************************************
//******          Mensajes        ******
//**************************************

/*Selecciona un mensaje*/
function b_mensaje1($caja){
	$consulta="
		SELECT titulo, texto, caja
		from mensaje
		where caja=$caja
		and estado=1";
	return completa($consulta);
}

/*Selecciona todos los mensajes*/
function b_mensaje2(){
	$consulta="SELECT id_mensaje,titulo,texto,estado from mensaje";
	return completa($consulta);
}

/*Busca mensaje por id*/
function b_mensaje3($msg){
	$consulta="SELECT * from mensaje where id_mensaje=$msg";
	return completa($consulta);
}

/*Guarda un mensaje*/
function g_mensaje($titulo,$mensaje,$caja){
	$consulta="insert into mensaje values('','$titulo','$mensaje',$caja,1)";
	completa($consulta);
}

/*Actualizar Mensaje*/
function a_mensaje($id,$titulo,$texto,$caja,$estado){
	$consulta="update mensaje set titulo='$titulo', texto='$texto', caja=$caja, estado=$estado where id_mensaje=$id";
	completa($consulta);
}

/*elimina un mensaje*/
function e_mensaje($id){
	$consulta="delete from mensaje where id_mensaje='$id'";
	completa($consulta);
}

?>
