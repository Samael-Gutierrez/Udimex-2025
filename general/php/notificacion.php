<?php
	function crear_notificacion($us,$mensaje,$app){
		$datos=b_mensaje($mensaje);
		if($fila=mysqli_fetch_assoc($datos)){
			$id_notificacion= $fila['id_notificacion'];
		}
		else{
			$id_notificacion=g_notificacion($us,$mensaje);
		}
		
		//Busca todos los usuarios que tengan habilitada la app recibida
		$datos=usuario_app($app);
		while($fila=mysqli_fetch_assoc($datos)){
			$id=$fila['id_usuario'];
		
			$datos2=b_notificacion_usuario($id,$id_notificacion);
			
			if($fila2=mysqli_fetch_assoc($datos2)){
				a_destinatario($id,$id_notificacion);
			}
			else{
				g_destinatario($id,$id_notificacion);
			}
		}
	}
?>
