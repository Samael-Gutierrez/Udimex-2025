<!DOCTYPE HTML>
<?php
session_start();
$dir="../../general/";
include($dir."php/admin.php");
include($dir."db/basica.php");
include($dir."db/admin.php");
include($dir."db/grupos.php");
include($dir."db/pagos.php");
include($dir."db/alumno.php");
include($dir."db/usuario.php");

//permiso();
$adicional="<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>";
cabeza("Administrar Pagos - Udimex", $adicional);


//Catalogo de estado de alumnos
$ales = "";
$datos = b_ales();
while ($fila = mysqli_fetch_assoc($datos)) {
	$ales = $ales . "<option value='" . $fila['id_estado'] . "'>" . $fila['descripcion'] . "</option>";
}



?>

<style>
	.modal {
		display: none;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0, 0, 0, 0.8);
		z-index: 9999;
		opacity: 0;
		transition: opacity 0.5s ease;
	}

	.modal-content {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		background-color: white;
		padding: 20px;
		border-radius: 8px;
		width: 80%;
		max-width: 600px;
		text-align: center;
		color: #333;
		opacity: 0;
		transition: opacity 0.5s ease, transform 0.5s ease;
	}

	.modal.show {
		opacity: 1;
	}

	.modal.show .modal-content {
		opacity: 1;
		transform: translate(-50%, -50%) scale(1.05);
	}

	.close {
		position: absolute;
		top: 10px;
		right: 20px;
		font-size: 30px;
		color: #aaa;
		cursor: pointer;
	}

	.close:hover {
		color: black;
	}

	.separacion {
		width: 80%;
		height: 2px;
		background-color: #b00c3b;
		margin: auto;
		margin-bottom: 10px;
	}
	
	
	.btn-modal{
		padding: 5px 10px;
		background-color:rgb(12, 64, 176);
		color: white;
		border-radius: 5px;
		box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.4);
		transition: all ease 1s;
		cursor: pointer;
	}
</style>

<body>
	<div id="modal-for" class="modal">
		<div class="modal-content">
			<a onclick='closeModal()' class="close dfrc">x</a>
			<div id="content-popup"></div>
		</div>
	</div>

	<?php
	if ($_POST) {
		//Control de grupo para asignar a grupo
		if ($_POST['ct'] == 1) {
			act_gru($_POST['alumno'], $_POST['grupo'], $_POST['fi'], $_POST['ins'], $_POST['col']);
			if ($_POST['grupo'] == 0) {
				act_es($_POST['alumno'], 0, "alumno");
			} else {
				act_es($_POST['alumno'], 1, "alumno");
				act_es($_POST['alumno'], 1, "usuario");
			}
		}
	}




	usuario("../../", 1);
	echo "<center>";
	menu_i();
	echo "<br><br><br><br>
		<fieldset id='subtitulo'>CONTROL DE PAGOS</fieldset>";

	$gr = "";
	$datos = b_grupos();
	while ($fila = mysqli_fetch_assoc($datos)) {
		$gr = $gr . "<option value='" . $fila['id_grupo'] . "'>" . $fila['nombre'] . " | " . $fila['dias'] . "</option>";
	}

	$fact = date('Y-m-d');

	/*Buscar todos los grupos*/


	$grupo = "";
	$cg = "<tr>
			<th>Matricula</th>
			<th>Telefono</th>
			<th>Alumno</th>
			<th>Grupo</th>
			<th>Fecha de pago</th>
			<th>Colegiatura</th>
			<th>Estado</th>
		</tr>";
	$cg2 = $cg;
	$sg = "";
	$datos = b_alumno('a.f_pago asc');
	while ($fila = mysqli_fetch_assoc($datos)) {
		// Días de sobrecargo
		$nombre = $fila['nombre'];
		$sobreCargo = 0;
		$sobreType = 0;
		$estiloSC = "";
		$disable = "disabled";
		$fechaPago = $fila['f_pago'];
		$cole = $fila['colegiatura'];
		$fechaPago = new DateTime($fechaPago);
		$hoy = new DateTime();
		$diferencia = $fechaPago->diff($hoy);
		if ($diferencia->days > 5 && $hoy > $fechaPago) {
			$sobrecargo = $cole * 0.1;
			$sobreType = 10;
		}

		if ($diferencia->days > 10 && $hoy > $fechaPago) {
			$sobreCargo = $cole * 0.2;
			$sobreType = 20;
		}

		if ($sobreCargo > 0) {
			$estiloSC = "background:red; color:white;";
			$disable = "";
		}

		if ($fila['id_grupo'] > 0) {
			$grupo = $fila['id_grupo'];
			$id_alumno = $fila['id_alumno'];


			$telefono = "";
			$datos3 = busca_tel2($id_alumno);
			if ($fila3 = mysqli_fetch_assoc($datos3)) {
				$telefono = $fila3['numero'];
				$telefono = str_replace(" ", "", $telefono);
			}

			$ac_fp = $fila['f_pago'];
			$nfp = date("Y-m-d", strtotime($ac_fp . "+ 1 month"));
			if ($fila['f_pago'] == '' or $fila['f_pago'] == '0000-00-00') {
				$dato2 = b_up($fila['id_alumno']);
				if ($fila2 = mysqli_fetch_assoc($dato2)) {
					$ufp = $fila2['r'];
				}
				$ac_fp = "<form method='POST' action='g_fecha.php'><input type='date' value='$ufp' name='fpag'><input type='hidden' value='" . $fila['id_alumno'] . "' name='alumno'><input type='submit' value='a'></form>";
				$nfp = 0;
			}
			$fpag = "<form method='POST' action='pago_guarda.php'>
					<input type='text' value='" . $fila['colegiatura'] . "' name='apagar' size='5' style='$estiloSC'>
					<input type='hidden' value='" . $fila['colegiatura'] . "' name='total_apagar' size='5'>
					<select name='concepto'>
						<option value='Colegiatura' selected>Colegiatura</option>
						<option value='Inscripción'>Inscripción</option>
						<option value='Certificado'>Certificado</option>
						<option value='Certificado'>Anticipo para Titulación de Licenciatura</option>
						<option value='Certificado'>Liquidación para Titulación de Licenciatura</option>
					</select>
					<input type='hidden' value='" . $nfp . "' name='nfp'>
					<input type='hidden' value='" . $fila['id_alumno'] . "' name='alumno'>
					<input type='submit' value='Guardar'>
					<input type='button' onclick='openModal(" . $fila['id_alumno'] . ",$sobreCargo, $sobreType)' value='+' $disable>
				</form>";

			$edo = "<form method='POST' action='estado_guarda.php'>
					<select name='estado'>
						$ales
					</select>
					<input type='hidden' value='" . $fila['id_alumno'] . "' name='alumno'>
					<input type='submit' value='Guardar'>
				</form>";


			if ($fila['colegiatura'] > 10) {
				$cg = $cg . "<tr>
    			<td>$id_alumno</td>
    			<td> <font color='#0000FF'><a href='http://wa.me/$telefono' target='_blank'>$telefono</a></font></td>
    				<td>
						" . $fila['nombre'] . " " . $fila['ap_pat'] . " " . $fila['ap_mat'] . "
						<input type='hidden' value='" . $fila['nombre'] . "' id='nombre-" . $fila['id_alumno'] . "'>
						</td>
    				<td align='center'><a href='../grupos/materia_ver.php?id=$grupo'>$grupo</a></td>
    				<td align='center'>$ac_fp</td>
    				<td align='center'>$fpag</td>
    				<td align='center'></td>
    				<!--<td align='center'>$edo</td>-->
    			</tr>";
			} else {
				$cg2 = $cg2 . "<tr>
    			<td>$id_alumno</td>
    			<td> <font color='#0000FF'><a href='http://wa.me/$telefono' target='_blank'>$telefono</a></font></td>
    				<td>" . $fila['nombre'] . " " . $fila['ap_pat'] . " " . $fila['ap_mat'] . "</td>
    				<td align='center'><a href='../grupos/materia_ver.php?id=$grupo'>$grupo</a></td>
    				<td align='center'>$ac_fp</td>
    				<td align='center'>$fpag</td>
    				<td align='center'></td>
    				<!--<td align='center'>$edo</td>-->
    			</tr>";
			}
		} else {
			$sg = $sg . "<form method='POST'>
				<tr>
					<td>" . $fila['ap_pat'] . " " . $fila['ap_mat'] . " " . $fila['nombre'] . "</td>
					<td><select name='grupo'>$gr<option value='0'>Baja</option></select></td>
					<td><input type='date' name='fi' value='$fact'></td>
					<td><input type='text' name='ins' value='0' size='5'></td>
					<td><input type='text' name='col' value='0' size='5'></td>
					<td><input type='submit' class='bt_enviar' value='Guardar'></td>
				</tr>
			<input type='hidden' value='1' name='ct'>
			<input type='hidden' value='" . $fila['id_alumno'] . "' name='alumno'>
			</form>";
		}
	}

	echo "<table border='1'>" . $cg . $cg2 . "</table><br>SIN GRUPO<table border='1'><tr><th>Alumno</th><th>Grupo</th><th>Fecha de Ingreso</th><th>Inscripción</th><th>Colegiatura semanal</th></tr>" . $sg . "</table>";


	?>

	<script>
		const closeModalButton = document.getElementById('closeModal');
		const modal = document.getElementById('modal-for');
		let content = document.getElementById("content-popup");

		function openModal(id, sobreCargo, tipo) {
			const nombre = document.getElementById('nombre-' + id).value;

			content.innerHTML += `
				<h2 class='modal-title'>Añadir sobrecargo de ${nombre}</h2>
				<div class='separacion'></div>
				<p>Sobrecargo sobre el ${tipo}% de tu colegiatura por atraso en su pago.</p>
				<form id='form-${id}'>
					<input type='hidden' value='${id}' name='id'>
					<input type='number' value='${sobreCargo}' name='cantidad'>
					<a onclick='sendForm(${id})'>Añadir</a>
				</form>
			`;

			modal.style.display = 'block';
			setTimeout(() => modal.classList.add('show'), 10);
		}

		function sendForm(id) {
			var formData = $('#form-'+id).serialize();

			$.ajax({
				url: 'enviarSobreCargo.php',
				type: 'POST',
				data: formData,
				success: function(response) {
					console.log(response);
					alert('Cargo añadido exitosamente');
					closeModal();
				},
				error: function(xhr, status, error) {
					console.error('Error en la solicitud AJAX: ', status, error);
					alert('Error al enviar');
				}
			});
		}

		function closeModal() {
			modal.classList.remove('show');
			setTimeout(() => {
				modal.style.display = 'none';
			}, 500);

			setTimeout(() => {
				vaciar();
			}, 1000);
		}

		function vaciar() {
			content.innerHTML = "";
		}

		window.onclick = function(event) {
			if (event.target == modal) {
				modal.classList.remove('show');
				setTimeout(() => {
					modal.style.display = 'none';
				}, 300);
				setTimeout(() => {
					vaciar();
				}, 100);
			}
		}
	</script>
</body>

</html>
