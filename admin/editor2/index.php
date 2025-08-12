<?php 
session_start();
$dir="../../general/";
include($dir."php/admin.php");
include($dir."db/materias.php");
include($dir."db/basica.php");
include($dir."db/admin.php");
include($dir."db/tarea.php");

//permiso();
$adicional="
	<link rel='stylesheet' href='css/estilo.css'>
	    <script src='https://cdnjs.cloudflare.com/ajax/libs/docx/7.7.0/docx.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js'></script>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
	<script type='text/javascript' src='".$dir."js/jquery-2.1.1.js'></script>";
cabeza("Editor - Udimex",$adicional,$dir);
//include("../../general/js/mate.js");

if ($_GET){
	$id=$_GET['cont'];
	$res=b_contenido($id,"orden");
	$fila=mysqli_fetch_assoc($res);
	mysqli_free_result($res);

	$navega=$fila['modulo'].".- <a href='ordena.php?mat=".$fila['id_materia']."'>".$fila['nombre']."</a> / ".$fila['titulo']."<br>";

	$sub=$fila['subtitulo'];
	$tema=$fila['id_tema'];
	

	$archivo="../../alumno/apuntes/".$id.".alf";	
	$apunte = file_get_contents($archivo);
	//form($sub,$cont,$tema,$id);
}

?>


<body>
    <div class="container">
        <div class="header">
        	<div id='navega'><?php echo $navega; ?></div>
            <div class="logo">
                <span id='sub' contenteditable="true"><?php echo $sub; ?></span>
            </div>
            <div class="header-buttons">
                <button class="tool-btn" id="saveBtn" title="Guardar" onclick="guarda(1);"><i class="fas fa-save"></i></button>
                <button class="tool-btn" id="printBtn" title="Imprimir"><i class="fas fa-print"></i></button>
                <button class="tool-btn" id="shareBtn" title="Compartir"><i class="fas fa-share-alt"></i></button>
            </div>
        </div>
        
        <div class="menu-bar" id="pestañas">
		<div class="menu-item" id="menu-archivo" onclick='muestra("archivo", this); guarda(0);'>Archivo</div>
            <div class="menu-item active" id="menu-inicio" onclick='muestra("inicio", this); guarda(0);'>Inicio</div>
            <div class="menu-item" id="menu-insertar" onclick='muestra("insertar", this); guarda(0);'>Insertar</div>
            <div class="menu-item" id="menu-herramientas" onclick='muestra("herramientas", this); guarda(0);'>Herramientas</div>
            <!--<div class="menu-item">Diseño</div>
            <div class="menu-item">Referencias</div>
            <div class="menu-item">Correspondencia</div>
            <div class="menu-item">Revisar</div>
            <div class="menu-item">Vista</div>
            <div class="menu-item">Ayuda</div>-->
        </div>
        
        <div class="toolbar">
    	<?php 
            include 'herramientas/h_archivo.php';              
            include 'herramientas/h_inicio.php';  
            include 'herramientas/h_insertar.php';  
            include 'herramientas/h_herramientas.php';  
	?>
        </div>
        
        <div class="editor-container">
            <div id="editor" contenteditable="true">
                <?php echo $apunte; ?>
            </div>
        </div>
        
        <div class="status-bar">
            <div>Página 1 | Sección 1 | 1/1</div>
            <div class="word-count">
                <span>Palabras: <span id="wordCount">0</span></span>
                <span>Caracteres: <span id="charCount">0</span></span>
            </div>
            <div>Español</div>
        </div>
    </div>
	<input type='hidden' value='<?php echo $tema; ?>' name='tema' id='tema'>
	<input type='hidden' value='<?php echo $id; ?>' name='id' id='id'>
    <script src="js/general.js"></script>
    <script src="js/inicio.js"></script>
    <script src="js/insertar.js"></script>
    <script src="js/archivo.js"></script>
</body>
</html>

<script>
	function guarda(actualiza) {  
		v_sub=document.getElementById('sub').innerHTML;
		v_cont = document.getElementById("editor").innerHTML;
		v_tema = document.getElementById('tema').value;
		v_id = document.getElementById('id').value;
		$.ajax({
			url: 'apunte_guarda.php',
			type: 'POST',
			async: true,
			data: {
				sub: v_sub,
				cont: v_cont,
				tema: v_tema,
				id: v_id
	    		},
			success: function(data){
				if (actualiza==1){
					location.reload();
				}
	      		},
			error: function(){
				alert(data);
	      		}
		});
	}
</script>
