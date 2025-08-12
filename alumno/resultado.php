<?php
	session_start();
	include("../general/funcion/basica.php");
	include("../general/consultas/basic.php");
	include("../general/consultas/pagos.php");
	include("../general/consultas/materias.php");
	
	carga_estilo('../');
?>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets-resultado/css/normalize.css">
	<link rel="stylesheet" href="assets-resultado/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
	permiso();
	menu('../');
?>
    <div class="container">

        <div class="sidebar">
            <div class="sidebar-logo">
                <img src="assets-resultado/img/u.jpeg">
                <p>Universidad Digital de México</p>
            </div>
            <div class="sidebar-contacto">
                <div class="sidebar-info">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="44"
                        height="44" viewBox="0 0 24 24" stroke-width="1" stroke="#ffffff" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                    </svg>
                    <p>+52 722 112 2248</p><br>
                </div>
                <div class="sidebar-info">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="44"
                        height="44" viewBox="0 0 24 24" stroke-width="1" stroke="#ffffff" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                        <path d="M3 7l9 6l9 -6" />
                    </svg>
                    <p>direccion@udimex.net</p><br>
                </div>
            </div>
        </div>

        <div class="resultados">
            <div class="logo">
                <img src="assets-resultado/img/logo.png" alt="">
                <p>Los resultados de tu evaluación escrita de bachillerato.</p>
            </div>
			
			<div class="tabla">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Campo disciplinar</th>
                            <th scope="col">Calificación</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
					<tbody>

<?php
	$al=$_SESSION["g_id"];
	
	$datos=b_cal2($al);
	$control=0;
	$suma=0;
	$cuenta=0;
	while($fila=mysqli_fetch_assoc($datos)){
		$color="#2eb031";
		$res="Acreditado";
		if ($fila['valor']<7){
			$color='#aa0000';
			$res="No acreditado"; 
			$control=0;
        } 
		if(($cuenta%2)==0){
			$color2="#fff";
		}
		else{
			$color2="#fff";
		}
		echo "<tr bgcolor='$color2'><td>".ucwords(mb_strtolower($fila['titulo']))."</td>
		<th><font color='$color'>".number_format($fila['valor'],1)."</font></th>
		<th><font color='$color'>$res</font></th></tr>";
		$suma=$suma+$fila['valor'];
		$cuenta=$cuenta+1;
	}

	$promedio=number_format($suma/$cuenta,1);

echo "      <tbody/>
        </table>";

        ?>
        <center>
            <div class="separacion"></div>
        </center>

        <?php
if($control==1){
	echo "      <div class='informacion-reprobado'>
                    <p>Para los módulos disciplinarios <b>No Acreditados</b>, tendrá una nueva oportunidad de aplicarlos en el próximo periodo de evaluaciones.</p>
                    <h3>Tu resultado de la aplicación de examen es: <span>$promedio</span></h3>
                    <p class='animo'>No hay meta que no puedas superar, ánimo, esto aún no termina :D</p>
                </div>";
}
else{
	echo "  <p class='d-inline-flex gap-1'>
                <a class='boton2' data-bs-toggle='collapse' href='#collapseExample,#card' role='button' aria-expanded='false' aria-controls='collapseExample'>
                <svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-info-small' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='#ffffff' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                    <path stroke='none' d='M0 0h24v24H0z' fill='none' />
                    <path d='M12 9h.01' />
                    <path d='M11 12h1v4h1' />
                </svg>
                </a>
            </p>
            
            <center>
            <div class='collapse collapseclass' id='collapseExample'>
                <div class='card card-body' id='card'>
                    <span class='fecha'>
                    </span>
                    La Universidad Digital de México iniciará el proceso para solicitar el certificado de bachillerato ante la Secretaría de Educación Pública, este proceso tiene una duración aproximada de 4 a 5 meses a partir de la fecha de publicación de resultados y entrega de expediente completo.
                </div>
            </div>
            </center>

            <div class='informacion'>
                <h1>¡Felicidades, lo lograste!</h1>
                <h2>Tu promedio general: <span>$promedio</span></h2>
                <h3>El estado de tu promedio es: <span>Acreditado</span></h3>
            </div>";
}	

echo "  </div>
    </div>
</div>";

// menu_flota();

?>
	</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>