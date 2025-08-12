<?php
	session_start();
	include("funciones.php");
	permiso();

	echo "
		<html>
			<head>
				<title>Pagos - Intituto Kambes</title>
				<link rel='stylesheet' href='estilo/estilo.css'>
				<meta charset='utf-8'>
				<script type='text/javascript' src='estilo/jquery-1.6.4.js'></script> 

		<script>
			$(document).ready(function(){  	
				$('#alumno').keyup(function() {  
        				$.ajax({  
            					url: 'busca.php?alumno='+$('#alumno').val(),  
            					success: function(data) {  
           	  					$('#resultado').html(data);
						}  
        				});  
    				});  
			}); 


function imprSelec(resultado){
	var ficha=document.getElementById(resultado);
	var ventimp=window.open(' ','popimpr');
	ventimp.document.write(ficha.innerHTML);
	ventimp.document.close();
	ventimp.print();
	ventimp.close();
}
</script>





			</head>
			<body>
				<div id='cuerpo'>
					<form method='POST'>
						<input type='text' name='alumno' id='alumno' placeholder='Matricula'>
					</form>
				</div>
				<div id='resultado'></div>

";
?>
				<input class="boton" type="button" value="Imprimir Tabla" onclick="javascript:imprSelec('resultado');function imprSelec(resultado){var ficha=document.getElementById(resultado);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();};" />
			</body>
		</html>


