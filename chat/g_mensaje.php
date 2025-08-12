<?php
session_start();
//session_destroy();

include("../db/basica.php");
include("../db/chat.php");
include("analizatexto.php");
include("funciones.php");


function guarda_mensaje($id_pregunta,$tp,$sig){


	$imprime=1;
	$_SESSION['opciones']="";
	if(!isset($_SESSION['chat'])){
		$chat=rand(11111,99999);
		$_SESSION['chat']=$chat;
		$_SESSION['mensajes']="";
	}

	//para texto libre
	if($tp==3){
		$tp=2;
		$r=respuesta($id_pregunta);
	}

	//mensaje de prospecto
	if ($tp==2){
		$_SESSION['mensajes']=$_SESSION['mensajes']."<div align='right'><div class='prospecto'>
				$id_pregunta
		</div>
		<div class='avt_pros'><img src='".$imagen."../imagen/usuario.png' width='60px'></div></div><br>";
		if($sig>0){
			$id_pregunta=$sig;
			$tp=1;
		}
	}

	if($tp==1){
		$dato2=bot_funcion($id_pregunta);
		if ($fila2=mysqli_fetch_assoc($dato2)){
			ejecuta_funcion($fila2['id_funcion'],$id_pregunta);
		}


		$dato=bot_pregunta($id_pregunta);
		if($fila=mysqli_fetch_assoc($dato)){
			$_SESSION['mensajes']=$_SESSION['mensajes']."<div class='avt_prom'><img src='../imagen/udibot.png' width='60px'></div>
			<div class='promotor'>".$fila['pregunta']."</div><br>";



			$tipo=$fila['tipo'];

			if($tipo==1){
				$dato=bot_respuesta($id_pregunta);
				$_SESSION['opciones']=$_SESSION['opciones']."<center>";
				while($fila=mysqli_fetch_assoc($dato)){
					$texto=$fila['respuesta'];
					$id_respuesta=$fila['id_respuesta'];

					$_SESSION['opciones']=$_SESSION['opciones']."<button class='op' onclick='siguiente(\"$texto\",2,".$fila['siguiente'].");'>$texto</button>";
					if($texto=="Si"){
						$_SESSION['si']=$fila['siguiente'];
					}
					if($texto=="No"){
						$_SESSION['no']=$fila['siguiente'];
					}
				}
				$_SESSION['opciones']=$_SESSION['opciones']."</center>";
			}

			if ($tipo==2){
				$datos2=bot_pr_sig($id_pregunta);
				if ($fila2=mysqli_fetch_assoc($datos2)){
					guarda_mensaje($fila2['siguiente'],1,$sig);
					$imprime=0;
				}
				
			}

		}

	}

	if ($imprime==1){
		if (isset($_SESSION['mensajes'])){
			echo $_SESSION['mensajes'].$_SESSION['opciones']."";
		}
	}
}

if($_POST){
	guarda_mensaje($_POST['id_pregunta'],$_POST['tipo'],$_POST['sig']);
}

if($_GET){
	guarda_mensaje($_GET['pr'],$_GET['tp']);
}



?>
