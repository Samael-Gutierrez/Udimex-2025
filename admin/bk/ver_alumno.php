<?php
session_start();
include('funciones.php');
permiso();
cabeza();
?>

		<title>Alumno</title>

		<script type='text/javascript' src='../js/jquery-1.6.4.js'></script> 

		<script>
			$(document).ready(function(){  	
				$('#nom').keyup(function() {  
        				$.ajax({  
            			url: 'busca.php?nom='+$('#nom').val()+'&ap='+$('#ap').val()+'&am='+$('#am').val()+'&esc='+$('#esc').val(),  
            					success: function(data) {  
           	  					$('#resultado').html(data);
						}  
        				});  
    				}); 

				$('#ap').keypress(function() {  
        				$.ajax({  
            			url: 'busca.php?nom='+$('#nom').val()+'&ap='+$('#ap').val()+'&am='+$('#am').val()+'&esc='+$('#esc').val(), 
            					success: function(data) {  
           	  					$('#resultado').html(data);
						}  
        				});  
    				}); 

				$('#am').keypress(function() {  
        				$.ajax({  
            			url: 'busca.php?nom='+$('#nom').val()+'&ap='+$('#ap').val()+'&am='+$('#am').val()+'&esc='+$('#esc').val(),   
            					success: function(data) {  
           	  					$('#resultado').html(data);
						}  
        				});  
    				}); 

 
			}); 

		</script>

	</head>

	<body>
<?php
usuario();
menu_i();
?><br><br><br><br><br><br>
		<form>
			<?php
			$esc=$_SESSION["esc"];
			echo "<input type='hidden' id='esc' name='esc' value='$esc'>";
			?>
			<center>
				<table border='0'>
					<tr>
						<td colspan='3'><p id='mensaje'>Escribe el nombre de alumno</p></td>
					</tr>
					<tr>
						<td><input type='text' id='nom' name='nom' placeholder='Nombre(s)'></td>
						<td><input type='text' id='ap' name='ap' placeholder='Apellido Paterno'></td>
						<td><input type='text' id='am' name='am' placeholder='Apellido Materno'></td>
					</tr>
				</table>
			</center><br>
				
		</form>
		<div id='resultado'></div> 	
	</body>
</html>
