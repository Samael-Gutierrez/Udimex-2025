<?php

function carga_estilo($ub){
	echo "
	<link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
	<link rel='preconnect' href='https://fonts.googleapis.com'>
	<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
	<link href='https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap' rel='stylesheet'>
	<link rel='stylesheet' href='".$ub."general/estilo/estilo2.css'>
	<link rel='icon' href='$ub/general/imagen/icono.png' type='image/png' sizes='16x16'>
	<meta charset='utf-8'>";
}




function menu($ub){
	if (isset($_SESSION['g_id'])){
		$cabeza="<div id='usuario' class='linea2' align='right'><h3 style='margin:0'>".$_SESSION['g_nom']."</h3><h4 style='margin:0'>".$_SESSION['g_ap']."</h4></div>
		<a href='../general/funcion/salir.php' style='position:relative; top:-15;'>
			<img src='".$ub."general/imagen/mal.png' height='45px' class='w3-margin'>
		</a>";
		

		$ligas1="
		<a href='".$ub."alumno/' class='w3-bar-item w3-button'>Mis materias</a>
		<a href='".$ub."alumno/pagos_muestra.php' class='w3-bar-item w3-button'>Mis Pagos</a>
		<a href='".$ub."alumno/calificaciones.php' class='w3-bar-item w3-button'>Mi calificaciones</a>";

		$ligas2="
		<div id='usuario' class='linea2' align='right'>
			<h3 style='margin:0'>".$_SESSION['g_nom']."</h3>
			<h4 style='margin:0'>".$_SESSION['g_ap']."</h4>
		</div>
		<a href='../general/funcion/salir.php' onclick=\"document.getElementById('id01').style.display='block'\" class='w3-bar-item w3-button'>Cerrar Sesión</a>
		<hr>
		<a href='#planes' src='".$ub."general/imagen/oferta.png' class='w3-bar-item w3-button'>
			<img src='".$ub."general/imagen/oferta.png' height='17px'  ALIGN=center> Dudas
		</a>
		<a href='#alumnos' class='w3-bar-item w3-button'>
			<img src='".$ub."general/imagen/alumno.png' height='17px'  ALIGN=center> Mis Materias
		</a>
		<a href='#' class='w3-bar-item w3-button'>
			<img src='".$ub."general/imagen/becas.png' height='17px'  ALIGN=center> Mi Agenda
		</a>
		<a href='#' class='w3-bar-item w3-button'>
			<img src='".$ub."general/imagen/otros.png' height='17px'  ALIGN=center> Mis Pagos
		</a>
		<a href='#pie' class='w3-bar-item w3-button'>
			<img src='".$ub."general/imagen/wp_negro.png' height='17px'  ALIGN=center> Mis Documentos
		</a>";
	}
	else{
		$cabeza="
		<a href='https://web.whatsapp.com/send?phone=+527202874706' target='_blank'>
			<img src='".$ub."general/imagen/wp_color.png' height='50px' class='w3-margin'>
		</a>
		<img src='".$ub."general/imagen/chat.png' height='45px' class='w3-margin' onclick='ver_chat();'>
		<a href='#' onclick=\"document.getElementById('id01').style.display='block'\">
			<img src='".$ub."general/imagen/acceso.png' height='45px' class='w3-margin'>
		</a>";

		$ligas1="
		<a href='#planes' class='w3-bar-item w3-button'>Oferta Educativa</a>
		<a href='#alumnos' class='w3-bar-item w3-button'>Nuestros Alumnos</a>
		<a href='becas.php' class='w3-bar-item w3-button'>Becas</a>
		<a href='#pie' class='w3-bar-item w3-button'>Contacto</a>";

		$ligas2="
		
		  <a href='#' onclick=\"document.getElementById('id01').style.display='block'\"  class='w3-bar-item w3-button'><img src='".$ub."general/imagen/entrar1.png' height='30px'  ALIGN=center> Iniciar Sesión   </a> 
		  
		<hr>
		<a href='#planes' src='".$ub."general/imagen/oferta.png' class='w3-bar-item w3-button'>
			<img src='".$ub."general/imagen/oferta.png' height='17px'  ALIGN=center> Oferta Educativa
		</a>
		<a href='#alumnos' class='w3-bar-item w3-button'>
			<img src='".$ub."general/imagen/alumno.png' height='17px'  ALIGN=center> Nuestros Alumnos
		</a>
		<a href='#' class='w3-bar-item w3-button'>
			<img src='".$ub."general/imagen/becas.png' height='17px'  ALIGN=center> Becas
		</a>
		<a href='#' class='w3-bar-item w3-button'>
			<img src='".$ub."general/imagen/otros.png' height='17px'  ALIGN=center> Otros Servicios
		</a>
		<a href='#pie' class='w3-bar-item w3-button'>
			<img src='".$ub."general/imagen/wp_negro.png' height='17px'  ALIGN=center> Contácto
		</a>";
	}


	echo "<header class='w3-container w3-serif w3-wide w3-padding  w3-animate-opacity' >
	<span id='m1' class='linea' onclick=\"w3_open()\">
		<h1 class='linea'>&#9776;</h1>
	</span>

	<div id='logo' class='linea'>
		<div class='linea w3-sans-serif'><img src='".$ub."general/imagen/logo.png' height='60px' id='imagen_logo'></div>
	</div>
	</header>

	<div align='right' id='m2'>
		$cabeza
	</div>



	<div class='w3-bar fondo_azul_oficial' align='center' id='m3'>
		$ligas1
	</div>

	<div align='right' id='chat' onclick='ver_chat();'>
		<img src='".$ub."general/imagen/chat.png' height='60px' class='w3-margin'>
	</div>


<div class='w3-sidebar w3-bar-block w3-border-right' style='display:none; top:0px' id='mySidebar'>
	<button onclick=\"w3_close()\" class='w3-bar-item w3-large' align='right'> <img src='".$ub."general/imagen/cerrarmenumovil.png' height='17px'  ALIGN=rigth>  </button>
	$ligas2
</div>


<script>
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
	
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
	document.getElementById('m3').style.position='fixed';
	document.getElementById('m3').style.top='0';

	document.getElementById('chat').style.display='block';
  } else {
        document.getElementById('m3').style.position='relative';
	document.getElementById('m3').style.top='0';

	document.getElementById('chat').style.display='none';
  }
}

function w3_open() {
  document.getElementById(\"mySidebar\").style.display = 'block';
}

function w3_close() {
  document.getElementById(\"mySidebar\").style.display = 'none';
}


</script>




<iframe src='chat/index.php?c=2' id='frame_chat' hidden></iframe>
<div id='oc' onclick='oculta_chat();' hidden><img src='chat/imagen/cerrar.png' width='25px'></div>

<script>
	function ver_chat(){
		document.getElementById('frame_chat').style.display='block';
		document.getElementById('oc').style.display='block';
	}
	
	
	function oculta_chat(){
		document.getElementById('frame_chat').style.display='none';
		document.getElementById('oc').style.display='none';
	}
</script>

<style>
#frame_chat{
   	z-index: 99999;
	position:fixed;
	bottom:0px;
	right:0px;
    	width: 352px;
	height: 452px;
	box-shadow: 0px 0px 50px rgba(0, 0, 250, 0.5);
	border-radius: 15px;
}
#oc{
   	z-index: 999999;
	position:fixed;
	bottom:410px;
	right:20px;
}
</style>";


}


function pie($ub){
	echo "
<div class='footer' id='pie'>
	

<iframe align='left' src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470.7400942351544!2d-99.7354941338464!3d19.285812099999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cd87e86d287465%3A0x5d7de8a4f1805100!2sAv.%2016%20de%20Septiembre%20303%2C%20San%20Miguel%2C%2051354%20San%20Miguel%20Zinacantepec%2C%20M%C3%A9x.!5e0!3m2!1ses-419!2smx!4v1690910508303!5m2!1ses-419!2smx' width='600' height='450' style='border:0;' allowfullscreen='' loading='lazy'></iframe>
           
		<div class='container'>
			<div align='right' class='elementor-text-editor elementor-clearfix'>
				<br><br>
				<p>Teléfono: <a href='tel:+720 287 4706'>720 287 4706</a> &nbsp; &nbsp; &nbsp; <br>
				E-mail: <a href='direccion@udimex.net'>direccion@udimex.net</a> &nbsp; &nbsp; &nbsp; <br><br>
				Dirección: &nbsp; &nbsp; &nbsp; <br>
				Av. 16 de Septiembre 303, San Miguel, 51354 San Miguel Zinacantepec, Méx.&nbsp; &nbsp; &nbsp; <br><br>
				Horario de atención: &nbsp; &nbsp; &nbsp; <br>
				Lunes a Sábado de 9:00 a.m. a 5:00 p.m. &nbsp; &nbsp; &nbsp; <br>
				Domingo de 9:00 a.m. a 1:00 p.m. &nbsp; &nbsp; &nbsp; <br></p>
			</div>

                	<ul class='social' align='right'>
                		<a href='https://www.facebook.com/udimex21' target='_blank'>
					<img src='".$ub."general/imagen/social-facebook-button-blue-icon.png' alt='FACEBBOK'>
				</a> &nbsp; &nbsp; &nbsp; 
                		<a href='https://web.whatsapp.com/send?phone=+527202874706' target='_blank'>
					<img src='".$ub."general/imagen/Whatsapp-icon.png' alt='Whatsapp'>
				</a> &nbsp; &nbsp; &nbsp; 
				<a href='https://www.instagram.com/udim_mex/?hl=es'target='_blank'>
					<img src='".$ub."general/imagen/insta.png' alt='Facebook'/>
				</a> &nbsp; &nbsp; &nbsp; 
				<a href='https://www.tiktok.com/@udimesc?' target='_blank'>
					<img src='".$ub."general/imagen/tiktok.png' width=48 alt='FACEBBOK'></a> 
			</ul> 
	</div>
</div>";
}

function login(){
echo " <main id='id01' class='w3-modal' style='top:-100px;'>

            <div class='contenedor__todo w3-modal-content w3-card-4 w3-animate-zoom'>


                <div class='caja__trasera'>
			<span onclick=\"document.getElementById('id01').style.display='none'\" class='w3-button w3-xlarge w3-transparent w3-display-topright' title='Close Modal'>×</span>
                    <div class='caja__trasera-login'>
                        <h3>¿Ya tienes una cuenta?</h3>
                        <p>Inicia sesión para entrar en la página</p>
                        <button id='btn__iniciar-sesion'>Iniciar Sesión</button>
                    </div>
                    <div class='caja__trasera-register'>
                        <h3>¿Aún no te inscribes?</h3>
                        <p>Inscribete ahora totalmente en línea</p>
                        <button id='btn__registrarse'>Inscríbete</button>
                    </div>
                </div>

                <!--Formulario de Login y registro-->
                <div class='contenedor__login-register'>
                    <!--Login-->
                    <form class='formulario__login' method='POST' action='alumno/login.php'>
                        <h2>Iniciar Sesión</h2>
                        <input type='text' placeholder='Correo Electronico' name='us'>
                        <input type='password' placeholder='Contraseña' name='pas'>
                        <input type='submit' value='Entrar'>
                    </form>

                    <!--Register-->
                    <form action='' class='formulario__register'>
                        <h2>Regístrarse</h2>
                        <input type='text' placeholder='Nombre completo'>
                        <input type='text' placeholder='Correo Electronico'>
                        <input type='text' placeholder='Usuario'>
                        <input type='password' placeholder='Contraseña'>
                        <button>Regístrarse</button>
                    </form>
                </div>
            </div>

        </main>

        <script src='general/assets/js/script.js'></script>
";

}


function permiso(){
 	if (!isset($_SESSION["g_id"])){
		echo "
		<script type='text/javascript'> top.window.location='..'; </script>";
 		die();
 	}
}

function fecha_texto($fecha){
	$fe=explode ("-",$fecha);

	$dia=$fe[2];
	$anio=$fe[0];

	$mes=$fe[1];
	if ($mes=='01'){
		$mes='enero';
	}
	if ($mes=='02'){
		$mes='febrero';
	}
	if ($mes=='03'){
		$mes='marzo';
	}
	if ($mes=='04'){
		$mes='abril';
	}
	if ($mes=='05'){
		$mes='mayo';
	}
	if ($mes=='06'){
		$mes='junio';
	}
	if ($mes=='07'){
		$mes='julio';
	}
	if ($mes=='08'){
		$mes='agosto';
	}
	if ($mes=='09'){
		$mes='septiembre';
	}
	if ($mes=='10'){
		$mes='octubre';
	}
	if ($mes=='11'){
		$mes='noviembre';
	}
	if ($mes=='12'){
		$mes='diciembre';
	}

	return $dia." de ".$mes." de ".$anio;
}

function menu_flota(){
echo "
<div id='m_fon' align='center'>
	<div class='w3-row' style='width:500px'>
		<div class='w3-third w3-center m_op' style:'top:100px;'>
			<a href='pagos_muestra.php'><img src='../general/imagen/pago.png' class='m_op' height='64'>
			<h6>Mis pagos</h6></a>
		</div>
		<div class='w3-third w3-center m_op' style:'top:100px;'>
			<a href='index.php'><img src='../general/imagen/mat.png' class='m_op' height='64'>
			<h6>Mis materias</h6></a>
		</div>
		<div class='w3-third w3-center m_op' style:'top:100px;'>
			<a href='calificaciones.php'><img src='../general/imagen/exp.png' class='m_op' height='64'>
			<h6>Mis calificaciones</h6></a>
		</div>
	</div>
</div>";
}

function menu_navega($ant,$ad,$mat){
echo "<br><br><br><br><br><br><br><br>
<div id='m_fon' align='center'>
	<div class='w3-row' style='width:500px'>
		<div class='w3-third w3-center m_op' style:'top:100px;'>
			$ant
			<h6>&nbsp;</h6>
		</div>
		<div class='w3-third w3-center m_op' style:'top:100px;'>
			<a href='materia_indice.php?mat=".$mat."'><img src='../general/imagen/indice.png' width='50'>
			<h6>&nbsp;</h6>
		</div>
		<div class='w3-third w3-center m_op' style:'top:100px;'>
			$ad
			<h6>&nbsp;</h6>
		</div>
	</div>
</div>";
}




function ciclo1($antes1, $antes2, $despues, $datos, $c1, $c2){
	$res="";
	while($fila=mysqli_fetch_assoc($datos)){
		$res=$res.$antes1.$fila[$c1].$antes2.$fila[$c2].$despues;
	}
	return $res;
}

function fecha_suma($fecha,$dias){
	$fechaObj = new DateTime($fecha);
    $fechaObj->modify("+$dias days");
    return $fechaObj->format('d-m-Y');
}


?>



