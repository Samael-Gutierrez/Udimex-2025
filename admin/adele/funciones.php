<?php
function barra_lateral(){
	if($_SESSION['id']){
		$id=$_SESSION['id'];
		$datos=busca_id($id);
		if($fila=mysqli_fetch_assoc($datos)){
			$datos=busca_acceso($id);
			echo "
			<div class='barra-lateral'>
				<h2 style='text-align: center;'>Dashboard</h2>";
				
			$_SESSION['menu']="";
			while($fila=mysqli_fetch_assoc($datos)){
				echo "<a href='../".$fila['url']."'>".$fila['nombre']."</a>";
				$_SESSION['menu']=$_SESSION['menu']."
				<div class='opcion' id='perfil'>
					<h3>".$fila['nombre']."</h3>
					<a href='../".$fila['url']."'>Ver ".$fila['nombre']."</a>
				</div>";
			}
			echo "
			</div>";
		}
		else{
			header('location:../index.php');
		}
	}
	else{
		header('location:../index.php');
	}
}

function verifica_cuenta(){
	$datos=busca_id($_SESSION['id']);
	$fila=mysqli_fetch_assoc($datos);
	$verifica="";
	if ($fila['estado']==1){
		$verifica="
		<center>
			<div class='advertencia'>
				<i class='fas fa-exclamation-triangle'></i>
				Tu cuenta aún no está verificada, puedes enviar un mensaje al administrador.
			</div>
		</center>";
	}
	return $verifica;
}

?>