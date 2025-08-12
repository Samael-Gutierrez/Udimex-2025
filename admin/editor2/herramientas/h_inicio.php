<?php
// h_inicio.php - Herramientas de inicio del editor
?>
<div id="inicio">
	<div class="tool-group">
	    <select class="font-selector" id="fontSelector">
		<option value="Arial">Arial</option>
		<option value="Times New Roman">Times New Roman</option>
		<option value="Courier New">Courier New</option>
		<option value="Georgia">Georgia</option>
		<option value="Verdana">Verdana</option>
	    </select>
	    
	    <select class="size-selector" id="sizeSelector">
	    	<option value="">--</option> <!-- Opción vacía para múltiples tamaños -->
		<option value="1" selected>8</option>
		<option value="2">10</option>
		<option value="3">12</option>
		<option value="4">14</option>
		<option value="5">18</option>
		<option value="6">24</option>
		<option value="7">36</option>
	    </select>
	</div>

	<div class="tool-group">
	    <button class="tool-btn" id="bold" title="Negrita"><i class="fas fa-bold"></i></button>
	    <button class="tool-btn" id="italic" title="Cursiva"><i class="fas fa-italic"></i></button>
	    <button class="tool-btn" id="underline" title="Subrayado"><i class="fas fa-underline"></i></button>
	    <button class="tool-btn" id="strike" title="Tachado"><i class="fas fa-strikethrough"></i></button>
	</div>

	<div class="tool-group">
	    <button class="tool-btn" id="alignLeft" title="Alinear izquierda"><i class="fas fa-align-left"></i></button>
	    <button class="tool-btn" id="alignCenter" title="Centrar"><i class="fas fa-align-center"></i></button>
	    <button class="tool-btn" id="alignRight" title="Alinear derecha"><i class="fas fa-align-right"></i></button>
	    <button class="tool-btn" id="alignJustify" title="Justificar"><i class="fas fa-align-justify"></i></button>
	</div>

	<div class="tool-group">
	    <div class="dropdown">
		<button class="tool-btn" title="Color de texto"><i class="fas fa-font"></i></button>
		<div class="dropdown-content">
		    <div class="color-palette">
		        <!-- Colores de texto - 20 opciones -->
		       	<button class="color-option" style="background-color: #000000;" onclick='texto_color("#000000");'></button>
			<button class="color-option" style="background-color: #FF0000;" onclick='texto_color("#FF0000");'></button>
			<button class="color-option" style="background-color: #0000FF;" onclick='texto_color("#0000FF");'></button>
			<button class="color-option" style="background-color: #008000;" onclick='texto_color("#008000");'></button>
			<button class="color-option" style="background-color: #800080;" onclick='texto_color("#800080");'></button>
			<button class="color-option" style="background-color: #FFA500;" onclick='texto_color("#FFA500");'></button>
			<button class="color-option" style="background-color: #00FFFF;" onclick='texto_color("#00FFFF");'></button>
			<button class="color-option" style="background-color: #FF00FF;" onclick='texto_color("#FF00FF");'></button>
			<button class="color-option" style="background-color: #FFFF00;" onclick='texto_color("#FFFF00");'></button>
			<button class="color-option" style="background-color: #808080;" onclick='texto_color("#808080");'></button>
			<button class="color-option" style="background-color: #A52A2A;" onclick='texto_color("#A52A2A");'></button>
			<button class="color-option" style="background-color: #008080;" onclick='texto_color("#008080");'></button>
			<button class="color-option" style="background-color: #FF4500;" onclick='texto_color("#FF4500");'></button>
			<button class="color-option" style="background-color: #4B0082;" onclick='texto_color("#4B0082");'></button>
			<button class="color-option" style="background-color: #00FF00;" onclick='texto_color("#00FF00");'></button>
			<button class="color-option" style="background-color: #FF1493;" onclick='texto_color("#FF1493");'></button>
			<button class="color-option" style="background-color: #1E90FF;" onclick='texto_color("#1E90FF");'></button>
			<button class="color-option" style="background-color: #8B4513;" onclick='texto_color("#8B4513");'></button>
			<button class="color-option" style="background-color: #2E8B57;" onclick='texto_color("#2E8B57");'></button>
			<button class="color-option" style="background-color: #6A5ACD;" onclick='texto_color("#6A5ACD");'></button>
		    </div>
		</div>
	    </div>
	    
	    <div class="dropdown">
		<button class="tool-btn" title="Color de fondo"><i class="fas fa-paint-brush"></i></button>
		<div class="dropdown-content">
		    <div class="color-palette">
		        <!-- Colores de fondo - 20 opciones -->
		        <button class="color-option" style="background-color: #FFFFFF;" onclick='texto_fondo("#FFFFFF");'></button>
			<button class="color-option" style="background-color: #FFFACD;" onclick='texto_fondo("#FFFACD");'></button>
			<button class="color-option" style="background-color: #E0FFFF;" onclick='texto_fondo("#E0FFFF");'></button>
			<button class="color-option" style="background-color: #FFE4E1;" onclick='texto_fondo("#FFE4E1");'></button>
			<button class="color-option" style="background-color: #F0FFF0;" onclick='texto_fondo("#F0FFF0");'></button>
			<button class="color-option" style="background-color: #F5F5F5;" onclick='texto_fondo("#F5F5F5");'></button>
			<button class="color-option" style="background-color: #E6E6FA;" onclick='texto_fondo("#E6E6FA");'></button>
			<button class="color-option" style="background-color: #FFF0F5;" onclick='texto_fondo("#FFF0F5");'></button>
			<button class="color-option" style="background-color: #F0F8FF;" onclick='texto_fondo("#F0F8FF");'></button>
			<button class="color-option" style="background-color: #F5FFFA;" onclick='texto_fondo("#F5FFFA");'></button>
			<button class="color-option" style="background-color: #FFFAF0;" onclick='texto_fondo("#FFFAF0");'></button>
			<button class="color-option" style="background-color: #F8F8FF;" onclick='texto_fondo("#F8F8FF");'></button>
			<button class="color-option" style="background-color: #FFF8DC;" onclick='texto_fondo("#FFF8DC");'></button>
			<button class="color-option" style="background-color: #FAFAD2;" onclick='texto_fondo("#FAFAD2");'></button>
			<button class="color-option" style="background-color: #F5F5DC;" onclick='texto_fondo("#F5F5DC");'></button>
			<button class="color-option" style="background-color: #FFEFD5;" onclick='texto_fondo("#FFEFD5");'></button>
			<button class="color-option" style="background-color: #FDF5E6;" onclick='texto_fondo("#FDF5E6");'></button>
			<button class="color-option" style="background-color: #FAEBD7;" onclick='texto_fondo("#FAEBD7");'></button>
			<button class="color-option" style="background-color: #FFEBCD;" onclick='texto_fondo("#FFEBCD");'></button>
			<button class="color-option" style="background-color: #FFE4C4;" onclick='texto_fondo("#FFE4C4");'></button>
		    </div>
		</div>
	    </div>
	</div>

	<div class="tool-group">
	    <button class="tool-btn" id="listUl" title="Lista desordenada"><i class="fas fa-list-ul"></i></button>
	    <button class="tool-btn" id="listOl" title="Lista ordenada"><i class="fas fa-list-ol"></i></button>
	    <button class="tool-btn" id="indent" title="Aumentar sangría"><i class="fas fa-indent"></i></button>
	    <button class="tool-btn" id="outdent" title="Disminuir sangría"><i class="fas fa-outdent"></i></button>
	</div>

	<div class="tool-group">
	    <button class="tool-btn" id="undo" title="Deshacer"><i class="fas fa-undo"></i></button>
	    <button class="tool-btn" id="redo" title="Rehacer"><i class="fas fa-redo"></i></button>
	    <button class="tool-btn" id="clear" title="Limpiar formato"><i class="fas fa-eraser"></i></button>
	</div>
</div>



