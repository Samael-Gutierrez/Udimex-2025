<?php

function bot_camp($camp){
	$consulta="SELECT * from bot_pregunta where id_pregunta=$id_pregunta";
	return completa($consulta);
}

function bot_pregunta($id_pregunta){
	$consulta="SELECT * from bot_pregunta where id_pregunta=$id_pregunta";
	echo $consulta;
	return completa($consulta);
}

function b_falta_res(){
	$consulta="SELECT * from bot_pr_res";
	return completa($consulta);
}

function bot_respuesta($id_pregunta){
	$consulta="select * from bot_pr_res as rel, bot_respuesta as res where rel.id_pregunta=$id_pregunta and rel.id_respuesta=res.id_respuesta";
	return completa($consulta);
}

function bot_pr_sig($id_pregunta){
	$consulta="SELECT siguiente FROM `bot_pr_res` WHERE id_pregunta=$id_pregunta limit 1";
	return completa($consulta);
}

function b_respuestas($id_respuesta){
	$consulta="SELECT * from bot_respuesta where id_respuesta=$id_respuesta";
	return completa($consulta);
}

function b_respuestas2(){
	$consulta="SELECT * from bot_respuesta order by respuesta asc";
	return completa($consulta);
}

function b_respuestas3($respuesta){
	$consulta="SELECT * from bot_respuesta where respuesta like '$respuesta'";
	return completa($consulta);
}

function bot_gchat(){
	$fecha=date("Y-m-d");
	$hi=date("H:i:s");
	$consulta="insert into bot_chat values('','$fecha','$hi','',0)";
	return completa2($consulta);
}

function bot_achat($chat){
	$hf=date("H:i:s");
	$consulta="update bot_chat set hf='$hf'";
	completa($consulta);
}

function bot_bchat($promotor){
	$consulta="select * from bot_chat where id_promotor=$promotor";
	return completa($consulta);
}

function bot_palabras($palabra){
	$consulta="select * from bot_palabras where palabra like '$palabra'";
	return completa($consulta);
}

function bot_funcion($id_pregunta){
	$consulta="select * from bot_funcion where id_pregunta=$id_pregunta";
	echo $consulta;
	return completa($consulta);
}

function bot_variable($id_pregunta){
	$consulta="select * from bot_variables where id_pregunta=$id_pregunta";
	return completa($consulta);
}

function busca_correo($info){
	$consulta="select id_usuario, count(id_usuario) as r from bot_usuario where correo='$info'";
	return completa($consulta);
}

function g_correo($info){
	$consulta="insert into usuario(id_usuario,correo) values('','$info')";
	return completa2($consulta);
}

function b_pregunta(){
	$consulta="SELECT * FROM bot_pr_res as rp, bot_pregunta as p, bot_respuesta as r 
	WHERE rp.siguiente=0 
	and rp.id_pregunta=p.id_pregunta
	and rp.id_respuesta=r.id_respuesta
	limit 1";
	return completa($consulta);
}

function b_pregunta2(){
	$consulta="SELECT * FROM bot_pregunta";
	return completa($consulta);
}

function b_pregunta3(){
	$consulta="SELECT * FROM bot_pr_res as rp, bot_pregunta as p where rp.siguiente=0 and rp.id_respuesta=0 and rp.id_pregunta=p.id_pregunta";
	return completa($consulta);
}

function g_pregunta($pregunta,$tipo){
	$consulta="insert into bot_pregunta values('','$pregunta',$tipo)";
	return completa2($consulta);
}

function g_respuesta($idp,$idr,$sig){
	$consulta="insert into bot_pr_res values('',$idp,$idr,$sig)";
	completa($consulta);
}

function g_respuesta2($resp){
	$consulta="insert into bot_respuesta values('','$resp')";
	return completa2($consulta);
}

function a_respuesta($pro,$ro,$id){
	$consulta="update bot_pr_res set siguiente=$id where id_pregunta=$pro and id_respuesta=$ro";
	completa($consulta);
}

function g_funcion($func,$preg,$nom){
	$consulta="insert into bot_funcion values($func,$preg,'$nom')";
	completa($consulta);
}


?>
