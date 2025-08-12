<?php
// h_clases.php - Herramientas para gestión de clases
?>
<div id="herramientas" style='display:none;'>
    <div class="tool-group" id='g1'>
        <button class="tool-btn" id="tareas" title="Registrar tarea"><i class="fas fa-tasks"></i></button>
        <button class="tool-btn" id="examenes" title="Crear examen"><i class="fas fa-file-alt"></i></button>
    </div>
    
    <div class="tool-group" id='g2'>
    	<button class="tool-btn" onclick="html(1);" id="html" title="HTML"><i class="fas fa-code"></i></button>
    </div>
    
    <div class="tool-group" id='g3' style='display:none;'>
    	<button class="tool-btn" onclick="html(2);" id="texto" title="Texto"><i class="fas fa-text-height"></i></button>
    </div>
</div>


<script>

function html(c){
	if (c==1){
		cod=document.getElementById('editor').innerHTML;
		document.getElementById('editor').innerHTML = cod.replace(/</g, "&lt;");
		document.getElementById('pestañas').style.display='none';
		document.getElementById('g1').style.display='none';
		document.getElementById('g2').style.display='none';
		document.getElementById('g3').style.display='block';
	}
	else{
		cod=document.getElementById('editor').innerHTML;
		cod2 = cod.replace(/&lt;/g, "<");
		document.getElementById('editor').innerHTML = cod2.replace(/&gt;/g, ">");
		document.getElementById('pestañas').style.display='flex';
		document.getElementById('g1').style.display='flex';
		document.getElementById('g2').style.display='flex';
		document.getElementById('g3').style.display='none';
	}
}
</script>
