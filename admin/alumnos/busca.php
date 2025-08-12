<?php
	$dir="../../general/";
	include($dir.'db/alumno.php');
	include($dir.'db/basica.php');
	
	if ($_GET){
		$datos=b_usuario($_GET["nom"],$_GET["ap"],$_GET["am"],$_GET["esc"]);
		echo "<table align='center'>
				<tr class='encabezado'>
					<th class='br1'>Nombre</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>E-mail</th>
					<th>Documentos</th>
					<th class='br2'>
						<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-box-arrow-in-right' viewBox='0 0 16 16'>
							<path fill-rule='evenodd' d='M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z'/>
							<path fill-rule='evenodd' d='M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z'/>
						</svg>
					</th>
				</tr>";
		while($fila=mysqli_fetch_assoc($datos)){
			$correo = $fila['correo'] ?: "Sin correo";
			echo "
					<tr>
						<td class='cuerpo'>".$fila['nombre']."</td>
						<td class='cuerpo'>".$fila['ap_pat']."</td>
						<td class='cuerpo'>".$fila['ap_mat']."</td>
						<td class='cuerpo'>$correo</td>
						<td class='cuerpo'>
							<form method='POST' action='constancias/generarConstancia.php'>
								<input type='hidden' name='id_alumno' value='". $fila['id_alumno'] ."'>
								<input type='hidden' name='nombre' value='". $fila['nombre'] ."'>
								<input type='hidden' name='ap' value='". $fila['ap_pat'] ."'>
								<input type='hidden' name='am' value='". $fila['ap_mat'] ."'>
								<select name='tipo'>
									<option value='1'>Prepa (Espera)</option>
									<option value='2'>Prepa (Cursando)</option>
									<option value='5'>Prepa (Termino)</option>
									<option value='3'>Licenciatura (Espera)</option>
									<option value='4'>Licenciatura (Cursando)</option>
								</select>
								<input type='submit' value='Generar'>
							</form>
						</td>
						<td class='cuerpo'>
							<form method='POST' action='../../alumno/login.php'>
								<input type='hidden' value='".$fila['usuario']."' name='us'>
								<input type='hidden' value='".$fila['clave']."' name='pas'>
								<input type='hidden' value='alumno' name='carpeta'>
								<input type='submit' class='btn-submit' value='Inicia Sesión'>
							</form>
						</td>
					</tr>
				
				";
		}
		mysqli_free_result($datos);
		echo "</table>";
	}	
?>
