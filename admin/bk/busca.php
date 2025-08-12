<?php
include('../consultas.php');
	if ($_GET){
		$datos=b_usuario($_GET["nom"],$_GET["ap"],$_GET["am"],$_GET["esc"]);
		echo "<table border='1' align='center'>
				<tr>
					<th>Nombre</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>E-mail</th>
					<th>Pago</th>
				</tr>";
		while($fila=mysqli_fetch_assoc($datos)){
			echo "
					<tr>
						<td>".$fila['nombre']."</td>
						<td>".$fila['ap_pat']."</td>
						<td>".$fila['ap_mat']."</td>
						<td>".$fila['correo']."</td>
						<td><form method='POST' action='ver_pago.php'>
							<input type='hidden' value='".$fila['id_usuario']."' name='id'>
							<input type='submit' value='ver'>
							</form>
						</td>
						<td><form method='POST' action='../login.php'>
							<input type='hidden' value='".$fila['correo']."' name='us'>
							<input type='hidden' value='".$fila['clave']."' name='pas'>
							<input type='submit' value='Inicia Sesión'>
							</form>
						</td>
					</tr>
				
				";
		}
		mysqli_free_result($datos);
		echo "</table>";
	}	
?>
