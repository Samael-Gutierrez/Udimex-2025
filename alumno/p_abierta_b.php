<div id='mensaje1'><b>PREPA ABIERTA</b></div><br><br>

<form method='GET' action='bachillerato.php'>
	<table border='0'>
		<tr><th colspan='2'><img src='imagen/pa.jpg'></th></tr>		
		<tr><th>Semestre</th><th>Tipo</th></tr>
		<tr>
			<td>
				<select name='sem'>
					<option value='0'>Todos</option>
					<?php
						for($i=1;$i<=6;$i++){
							echo "<option value='$i'>$i</option>";
						}
					?>
				</select>
			</td>
			<td>
				<select name='tipo'>
					<option value='td'>Todos</option>
					<option value='id'>Idiomas</option>
					<option value='ma'>Matemáticas</option>
					<option value='le'>Lectura/Escritura</option>
					<option value='hi'>Historia</option>
					<option value='cs'>C. Sociales</option>
					<option value='cn'>C. Naturales</option>
				</select>
			</td></tr>
		<tr><th colspan='2'><br><input type='submit' value='Buscar'></th></tr>
	</table><br>		
</form>
