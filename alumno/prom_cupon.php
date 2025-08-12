<?php
	if (isset($_SESSION["g_id"])){
		if ($_POST){
			$cup=$_POST['cup'];
			$datos=b_cup_al($_SESSION["g_id"],$cup);
			$fila=mysqli_fetch_assoc($datos);
			if ($fila['ex']==0){
				$datos2=u_cupon($cup);
				$fila=mysqli_fetch_assoc($datos2);
				$fp=date("Y-m-d");
				$fc=m_dias(date("Y-m-d"),$fila['n_dias']);
				$pago=r_p_cupon($_SESSION["g_id"],$fila['n_dias'],$fc,$cup);
				g_materia($pago,$fila['id_materia'],$fila['id_profesor'],1);

				$datos2=b_raiz($fila['id_materia'],$fila['id_profesor'],0);
				if ($fila2=mysqli_fetch_assoc($datos2)){
					g_raiz($fila2['id_material'],$pago);
				}

				d_cupon($fila['n_alumnos']-1,$cup);
				el_cupon();
				echo "<script type='text/javascript'> top.window.location='horario_muestra.php'; </script>";
			}
			else{
				echo "<div id='mensaje'>Ya has usado este cupón</div>";
			}
			
		}
		r_cup();
	}
	else{
		echo "<div id='mensaje'>Debes iniciar sesión para ver ésta sección</div>";
	}




function r_cup(){
	echo "
		<br>
		<div id='subtitulo'>Resgitro de cupones</div><br><br>
		<div id='mensaje'>Si cuentas con algún cupón, puedes utilizarlo escribiendo el número de serie aquí</div><br><br>

		<form method='POST'>
			<table border=0 align='center'>
				<tr><td>Cupón:</td><td><input type='text' name='cup' maxlength='5'></td></tr>
				<tr><th colspan='2'><input type='submit' size='5' value='Utilizar'></th></tr>
			</table>
		</form>
	";
}

?>


