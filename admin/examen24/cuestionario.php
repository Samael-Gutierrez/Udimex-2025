<?php
session_start();

include("../general/funcion/basica.php");
//include("../general/consultas/general.php");
include("../general/consultas/materias.php");
include("../general/consultas/cuestionario.php");
include("../general/consultas/basic.php");




	
	carga_estilo('../');
?>



<!DOCTYPE>
<html>
<head>

    <title>Resultado de examen</title>
    <link rel='stylesheet' href='estilos_vista.css'>


	<script type='text/javascript' src='../general/js/jquery-1.6.4.js'></script> 
	<script>
    
		function visible(p,v){
			n=p+v;
			document.getElementById('preg'+p).style.display='none';
			document.getElementById('preg'+n).style.display='block';
		}


		function revisa(){
			var url = 'evalua.php';
        		$.ajax({                        
		   		type: 'POST',                 
				url: url,                     
				data: $('#busca').serialize(), 
				success: function(data)             
				{
					$('#resp').html(data); 
					             
				}
			});
		}

		function g_respuesta(preg,res,mat){

			$.ajax({  
            			url: 'guarda_respuesta.php?preg='+preg+'&res='+res+'&mat='+mat,   
            			success: function(data) {  
           	  			$('#resultado').html(data);
				}  
        		});
		}

	</script>

<style>
.page{
	width: 21cm;
        min-height: 15cm;
        padding: 2cm;
        margin: 1cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        display: flex;}


.estilo-esquina {
    position: static;
    top: 270px;
    right: 320px;
    text-shadow: 1px 1px 1px #fff;
    font-family: 'Righteous';
}
.contenedoresquina {
    position: absolute;
    top: 180px;
    right: 320px;
}

.logo {
    width: 40%;
    display: flex;
}

.logo img {
    display: block;
    width: 100%;
    height: auto;
}

.contenedordelogo {
    width: 190px;
    position: absolute;
    top: 180px;
}

.contenedor2{
	margin-top: 4%;
  display:block;
}


@import url(https://fonts.googleapis.com/css?family=Varela+Round);



.estilo {
  color: hsla(0, 0%, 100%, .9);
  font: normal 25px Varela Round, sans-serif;
 
  margin: -80px 0 0 0;
  animation: move linear 3500ms infinite;  
}

@keyframes move {
  0% {
    text-shadow:
      4px -4px 0 #1A2D9A,
      3px -3px 0 #1A2D9A,
      2px -2px 0 #1A2D9A,
      1px -1px 0 #1A2D9A,
      -4px 4px 0 #CD2D20,
      -3px 3px 0 #CD2D20,
      -2px 2px 0 #CD2D20,
      -1px 1px 0 #CD2D20
    ;
  }
  25% {    
    text-shadow:      
      -4px -4px 0 #1A2D9A,
      -3px -3px 0 #CD2D20,
      -2px -2px 0 #CD2D20,
      -1px -1px 0 #CD2D20,
      4px 4px 0 #1A2D9A,
      3px 3px 0 #1A2D9A,
      2px 2px 0 #1A2D9A,
      1px 1px 0 #1A2D9A
    ;
  }
  50% {
    text-shadow:
      -4px 4px 0 #CD2D20,
      -3px 3px 0 #1A2D9A,
      -2px 2px 0 #1A2D9A,
      -1px 1px 0 #1A2D9A,
      4px -4px 0 #CD2D20,
      3px -3px 0 #CD2D20,
      2px -2px 0 #CD2D20,
      1px -1px 0 #CD2D20
    ;
  }
  75% {
    text-shadow:
      4px 4px 0 #1A2D9A,
      3px 3px 0 #CD2D20,
      2px 2px 0 #CD2D20,
      1px 1px 0 #CD2D20,
      -4px -4px 0 #1A2D9A,
      -3px -3px 0 #1A2D9A,
      -2px -2px 0 #1A2D9A,
      -1px -1px 0 #1A2D9A
    ;
  }
  100% {
    text-shadow:
      4px -4px 0 #CD2D20,
      3px -3px 0 #1A2D9A,
      2px -2px 0 #1A2D9A,
      1px -1px 0 #1A2D9A,
      -4px 4px 0 #CD2D20,
      -3px 3px 0 #CD2D20,
      -2px 2px 0 #CD2D20,
      -1px 1px 0 #CD2D20
    ;
  }  
}



.btn {
  cursor: pointer;
  height: 12%;
  width: 30%;
  color: #fff;
  position: relative;
  padding: 5px 5px;
  background: black;
  font-size: 28px;
  border-top-right-radius: 0px;
  border-bottom-left-radius: 10px;
  transition: all 1s;
  align-items: center;
  
}

.btn::after,
.btn::before {
  content: " ";
  width: 10px;
  height: 10px;
  position: absolute;
  border: 0px solid #fff;
  transition: all 1s;
}

.btn::after {
  top: -1px;
  left: -1px;
  border-top: 5px solid red;
  border-left: 5px solid red;
}

.btn::before {
  bottom: -1px;
  right: -1px;
  border-bottom: 5px solid blue;
  border-right: 5px solid blue;
}

.btn:hover {
  border-top-right-radius: 0px;
  border-bottom-left-radius: 0px;
}

.btn:hover::before,
.btn:hover::after {
  width: 100%;
  height: 100%;
}

.data-container {
  background: #ffebee;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}







</style>

	

	</head>
	<body>
	
<?php
//	permiso();
	menu('../');






$orden="order by rand()";


$mat=$_SESSION['mat'];
$tema=$_SESSION['tema'];
$sub=$_SESSION['sub'];
$us=$_SESSION['g_id'];


$datos = b_calificacion($us, $mat, $sub, $tema);
	$num_registros=mysqli_fetch_assoc($datos);


	if ($num_registros["r"] <2) {





//$datos=tema_sig($mat,$tema,$sub);

/*if($fila=mysqli_fetch_assoc($datos)){
	$ant=$fila['id']-2;

	echo "<center><table border='0' width='800px' id='barra' rules='rows'>
			<tr bordercolor='#bcd35f'>
				<td rowspan='2' align='center' id='materia'><h3>".$fila['nombre']."</h3></td>
				<td align='right'><h6>".$fila['titulo']."&nbsp; &nbsp; </h6></td>
			</tr>
			<tr>
				<td align='right'><h6>Módulo ".$fila['modulo']."&nbsp; &nbsp; </h6></td>
			</tr>
		</table></center>

<br><br><center><div class='w3-card w3-padding-large' style='width:95%;'><h3 class='rojo_oficial'><br>".$fila['titulo']."</h3><br>
	<div align='left'>";*/
echo "<div  id='resultado'></div>";
	$datos=cues_tot($tema);
	if($fila=mysqli_fetch_assoc($datos)){
		$tot=$fila['r'];
	}

	$d1=cues($tema,"order by id_pregunta");
	$p=1;
	echo "<form method='POST' action='evalua.php'>";
	echo "<div class='page'><div class='contenedordelogo'>
	<div class='logo'>    <img src='logo.png' alt='Logo'></div></div>
	";
	
	while($f1=mysqli_fetch_assoc($d1)){
		$ad="hidden";
		$ant="<div  onclick='visible($p,-1);' class='btn'>Anterior</div>";
		$sig="<div onclick='visible($p,1);' class=' btn'>Siguiente</div>";
		if ($p==1){
			$ad="";
			$ant="";
		}
		echo " <div id='preg$p' $ad><div class='contenedoresquina'>
    <div class='estilo-esquina'></div>
							<div class='estilo'>$p de $tot<br><br></div></div><br> 
							<div class='contenedor2'>	$p.- ".$f1 ['pregunta']."<br><br>";
		
					echo "<ol  type='A'>";
					$d2=res($f1['id_pregunta'],"$orden");
					$r=1;
				while($f2=mysqli_fetch_assoc($d2)){
				echo " <li>
				<input class='' type='radio' id='r$p' name='p$p' value='".$f2['id_respuesta']."' onclick='g_respuesta(".$f1['id_pregunta'].",".$f2['id_respuesta'].",$mat);'> &nbsp; ".trim($f2['respuesta']).
				"</li>";
				$r=$r+1;
				}
				mysqli_free_result($d2);
				echo "</ol><br><center>$ant &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $sig</center></div></div>";
				$p=$p+1;
	}
	mysqli_free_result($d1);

echo "
<center><div id='preg$p' hidden>
<input type='submit' value='Calificar' name='calificar' style='width:70px;'>
<br><br><br><br><input type='hidden' value='$p' name='tope'><input type='hidden'  value='Calificar'></div></center></div></form><br><br>
</div>";


//} 

mysqli_free_result($datos);



}
else{
    echo"<meta http-equiv='refresh' content='0;url=index.php'>";
}
?>
    <div id='resultado'></div>


	


	</body>
</html>
