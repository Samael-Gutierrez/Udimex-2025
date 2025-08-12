<?php
session_start();
$_SESSION['gu']=1;
?>
<!DOCTYPE>
<html>
<head>





	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
	<title>Pizarrón Online</title>
	<link rel='stylesheet' href='estilo/estilo.css'>


	<style>
		body {
		    touch-action: none;
		    overflow: hidden;
		    margin: 0;
		    padding: 0;
		}
	</style>


	<script>
		function subindice(){
			tam='20px';
			document.getElementById("es").focus();
		}
	</script>
</head>
<body onload="lapiz();">



	


	<form method='POST' id='h_prof'>
		<table border='0'>
			<tr>
				<th>Marcador</th><th>Herramientas</th><th>Texto</th><th></th><th>Imagen</th>
			</tr>
			<tr>
				<td>		
					<input type='button' onclick="colores('#000000');" style='background:#000000;'>
					<input type='button' onclick="colores('#FF0000');" style='background:#FF0000;'>
					<input type='button' onclick="colores('#00FF00');" style='background:#00FF00;'>
					<input type='button' onclick="colores('#0000FF');" style='background:#0000FF;'>
				</td>
				<td> &nbsp; &nbsp; &nbsp; &nbsp; 
					<a href=# onclick="lapiz();"><img src='imagen/lapiz.png'></a>
					<a href=# onclick="figura(0);" value='linea'><img src='imagen/gom.png'></a>
					<a href=# onclick="figura(1);" value='linea'><img src='imagen/linea.png'></a>
					<a href=# onclick="figura(2);" value='triangulo'><img src='imagen/tr.png'></a>
					<a href=# onclick="figura(3);" value='triangulo'><img src='imagen/te.png'></a>
					<a href=# onclick="figura(4);" value='triangulo'><img src='imagen/tl.png'></a>
					<a href=# onclick="figura(5);" value='circulo'><img src='imagen/cr.png'></a>
					<a href=# onclick="figura(6);" value='llave'><img src='imagen/ll.png'></a>
					<a href=# onclick="subindice();" value='llave'><img src='imagen/sub.png'></a> &nbsp; &nbsp; &nbsp; &nbsp; 
					
				</td>
				<td><input type='text' id='es' maxlength='60'> &nbsp; &nbsp; &nbsp; &nbsp; </td>
				<td><div id="bt" onclick='borra();'>Borrar todo</div> &nbsp; &nbsp; &nbsp; &nbsp; </td>
				<td><input type='texto' name='img' id='img' onkeyup='carga_imagen();' onfocusout='carga_imagen();' onfocusin='carga_imagen();' placeholder='Pega aquí la URL'></td>
			</tr>
		</table>
		<input type='hidden' id='x1'>
		<input type='hidden' id='y1'>
		<input type='hidden' id='x2'>
		<input type='hidden' id='y2'>
		<textarea id='resul' cols='50' rows='5' hidden></textarea>
	</form>

<canvas id="dibujo" width="1330" height="550" 
        onmousedown="abajo(event);" onmousemove="mueve(event);" onmouseup="termina();"
        ontouchstart="toque_inicio(event);" ontouchmove="toque_mueve(event);" ontouchend="toque_fin(event);">
	Tu navegador no soporta esta aplicación.
	</canvas>
 
<img src="" id="laimagen"/>

     <script>




function imagen(){
	var dato = dibujo.toDataURL("image/png");
	document.location.href = dato;
	dato = dato.replace("image/png", "image/octet-stream");
	document.location.href = dato;
}

	var a_fig=0;
	var activa=0;
	var x,y,fig;
	var col="#000000";
	var c=document.getElementById("dibujo");
	var ctx=c.getContext("2d");
	var activa=0;
	var tam='40px';

	function carga_imagen(){
		activa=2;
	}

	//obtiene la posición del mouse
	function mouse(event){
		x=event.clientX-5;
 		y=event.clientY-77;
	}

	//Guarda el codigo de canavas en los archivos
        function guarda(){
		var dato=document.getElementById("resul").value;
            	var url="guarda.php";
            	$.ajax({
                	type: "POST",
                	url:url,
                	data:{dato:dato},
            	});
        }

	//borra el canavas completo
        function borra(){
		document.getElementById("resul").value="5--0--0::";
		guarda();
		ctx.clearRect(0,0,1330,550);
		activa=0;
        }


        function lapiz(){
		limp_ca();
		activa=0;
		tam='40px';
		document.getElementById("figuras").style.display='none';

        }

	//Habilita los triangulos
        function h_tr(){
		document.getElementById("tr").style.display='block';
        }

        function figura(f){
		fig=f;
		activa=4;
        }

	//borra en rectangulo
        function goma(){
		mouse();
		var c1=document.getElementById("x1").value;
		if (c1==""){
			document.getElementById("x1").value=x;
			document.getElementById("y1").value=y;
		}
		else{
			x1=document.getElementById("x1").value;
			y1=document.getElementById("y1").value;

			ctx.clearRect(x1,y1,x-x1,y-y1);
			
			document.getElementById("resul").value="7--"+x1+"--"+y1+"--"+(x-x1)+"--"+(y-y1)+"::";

			document.getElementById("x1").value="";
			document.getElementById("y1").value="";
		}
        }

	//Dibuja una línea recta
        function linea(){
		mouse();
		var c1=document.getElementById("x1").value;
		if (c1==""){
			document.getElementById("x1").value=x;
			document.getElementById("y1").value=y;
		}
		else{
			x1=document.getElementById("x1").value;
			y1=document.getElementById("y1").value;

			ctx.beginPath();
			ctx.moveTo(x1,y1);
			ctx.lineTo(x,y);
			ctx.stroke();

			
			document.getElementById("resul").value="0::";
			document.getElementById("resul").value=document.getElementById("resul").value+"4--"+col+"::";
			document.getElementById("resul").value=document.getElementById("resul").value+"1--"+x1+"--"+y1+"::";
			document.getElementById("resul").value=document.getElementById("resul").value+"2--"+x+"--"+y+"::";

			document.getElementById("x1").value="";
			document.getElementById("y1").value="";
		}
        }


	//Dibuja un triangulo rectángulo
        function tr_r(){
		mouse();
		var c1=document.getElementById("x1").value;
		if (c1==""){
			document.getElementById("x1").value=x;
			document.getElementById("y1").value=y;
		}
		else{
			x1=document.getElementById("x1").value;
			y1=document.getElementById("y1").value;

			ctx.beginPath();
			ctx.moveTo(x1,y1);
			ctx.lineTo(x1,y);
			ctx.lineTo(x,y);
			ctx.lineTo(x1,y1);
			ctx.stroke();
		
			document.getElementById("resul").value="0::";
			document.getElementById("resul").value=document.getElementById("resul").value+"4--"+col+"::";
			document.getElementById("resul").value=document.getElementById("resul").value+"1--"+x1+"--"+y1+"::";
			document.getElementById("resul").value=document.getElementById("resul").value+"2--"+x1+"--"+y+"::";
			document.getElementById("resul").value=document.getElementById("resul").value+"2--"+x+"--"+y+"::";
			document.getElementById("resul").value=document.getElementById("resul").value+"2--"+x1+"--"+y1+"::";

			limp_ca();	
		}
        }

	//Dibuja un triangulo equilatero
        function tr_e(){
		mouse();
		var c1=document.getElementById("x1").value;
		if (c1==""){
			document.getElementById("x1").value=x;
			document.getElementById("y1").value=y;
		}
		else{
			x1=document.getElementById("x1").value;
			y1=document.getElementById("y1").value;
			a=x-x1;
			a=Math.floor(a/2);
			a=parseInt(a)+parseInt(x1);

			ctx.beginPath();
			ctx.moveTo(x1,y);
			ctx.lineTo(a,y1);
			ctx.lineTo(x,y);
			ctx.lineTo(x1,y);
			ctx.stroke();
		
			document.getElementById("resul").value="0::";
			document.getElementById("resul").value=document.getElementById("resul").value+"4--"+col+"::";
			document.getElementById("resul").value=document.getElementById("resul").value+"1--"+x1+"--"+y+"::";
			document.getElementById("resul").value=document.getElementById("resul").value+"2--"+a+"--"+y1+"::";
			document.getElementById("resul").value=document.getElementById("resul").value+"2--"+x+"--"+y+"::";
			document.getElementById("resul").value=document.getElementById("resul").value+"2--"+x1+"--"+y+"::";

			limp_ca();			
		}
        }



	//Dibuja un triangulo libre
        function tr_l(){
		mouse();
		var c1=document.getElementById("x1").value;
		if (c1==""){
			document.getElementById("x1").value=x;
			document.getElementById("y1").value=y;
		}
		else{
			var c2=document.getElementById("x2").value;
			if (c2==""){
				document.getElementById("x2").value=x;
				document.getElementById("y2").value=y;
			}
			else{
				x1=document.getElementById("x1").value;
				y1=document.getElementById("y1").value;
				x2=document.getElementById("x2").value;
				y2=document.getElementById("y2").value;
			
				ctx.beginPath();
				ctx.moveTo(x1,y1);
				ctx.lineTo(x2,y2);
				ctx.lineTo(x,y);
				ctx.lineTo(x1,y1);
				ctx.stroke();
		
				document.getElementById("resul").value="0::";
				document.getElementById("resul").value=document.getElementById("resul").value+"4--"+col+"::";
				document.getElementById("resul").value=document.getElementById("resul").value+"1--"+x1+"--"+y1+"::";
				document.getElementById("resul").value=document.getElementById("resul").value+"2--"+x2+"--"+y2+"::";
				document.getElementById("resul").value=document.getElementById("resul").value+"2--"+x+"--"+y+"::";
				document.getElementById("resul").value=document.getElementById("resul").value+"2--"+x1+"--"+y1+"::";

				limp_ca();		
			}
		}
        }


	//Dibuja un circulo
        function circ(){
		mouse();
		var c1=document.getElementById("x1").value;
		if (c1==""){
			document.getElementById("x1").value=x;
			document.getElementById("y1").value=y;
		}
		else{
			x1=document.getElementById("x1").value;
			y1=document.getElementById("y1").value;
			
			centro= Math.sqrt((Math.pow(x1-x,2))+(Math.pow(y1-y,2)));

			ctx.beginPath();
			ctx.arc(x1, y1 ,centro ,0, Math.PI*2);
			ctx.stroke();
		
			x2=parseInt(x1)+parseInt(centro);
			document.getElementById("resul").value="0::";
			document.getElementById("resul").value=document.getElementById("resul").value+"4--"+col+"::";
			document.getElementById("resul").value=document.getElementById("resul").value+"8--"+x1+"--"+y1+"--"+centro+"--"+0+"--"+Math.PI*2+"::";
			limp_ca();		
			
		}
        }

	//Dibuja una llave
        function llave(){
		mouse();
		var c1=document.getElementById("x1").value;
		if (c1==""){
			document.getElementById("x1").value=x;
			document.getElementById("y1").value=y;
		}
		else{
			x1=document.getElementById("x1").value;
			y1=document.getElementById("y1").value;
			centro=y-y1;
			centro=Math.floor(centro/2);

			ctx.beginPath();
			document.getElementById("resul").value="0::";
			document.getElementById("resul").value=document.getElementById("resul").value+"4--"+col+"::";

			aux1=parseInt(y)-parseInt(centro);
			aux2=Math.PI/2;
			ctx.arc(x, aux1 ,centro , 0,aux2, false);
			document.getElementById("resul").value=document.getElementById("resul").value+"8--"+x+"--"+aux1+"--"+centro+"--"+0+"--"+aux2+"::";

			aux1=parseInt(x)+parseInt(centro);
			aux2=parseInt(y)-parseInt(centro);
			ctx.moveTo(aux1,aux2);
			document.getElementById("resul").value=document.getElementById("resul").value+"1--"+aux1+"--"+aux2+"::";

			
			aux1=parseInt(x)+parseInt(2*centro);
			aux3=Math.PI*3/2;
			ctx.arc(aux1, aux2 ,centro ,Math.PI, aux3,false);
			document.getElementById("resul").value=document.getElementById("resul").value+"8--"+aux1+"--"+aux2+"--"+centro+"--"+Math.PI+"--"+aux3+"::";

			ctx.moveTo(x,y);
			document.getElementById("resul").value=document.getElementById("resul").value+"1--"+x+"--"+y+"::";

			aux1=parseInt(y)+parseInt(centro);
			ctx.arc(x, aux1 ,centro,aux3,0,false);
			document.getElementById("resul").value=document.getElementById("resul").value+"8--"+x+"--"+aux1+"--"+centro+"--"+aux3+"--"+0+"::";

			aux1=parseInt(x)+parseInt(2*centro);
			aux2=parseInt(y)+parseInt(2*centro);
			ctx.moveTo(aux1,aux2);
			document.getElementById("resul").value=document.getElementById("resul").value+"1--"+aux1+"--"+aux2+"::";

			aux2=parseInt(y)+parseInt(centro);
			aux3=Math.PI/2;
			ctx.arc(aux1, aux2 ,centro ,aux3, Math.PI,false);
			document.getElementById("resul").value=document.getElementById("resul").value+"8--"+aux1+"--"+aux2+"--"+centro+"--"+aux3+"--"+Math.PI+"::";


			ctx.stroke();


			
			
		
			limp_ca();			
		}


        }

	//limpia campos auxiliares
	function limp_ca(){
		document.getElementById("x1").value="";
		document.getElementById("y1").value="";	
		document.getElementById("x2").value="";
		document.getElementById("y2").value="";	
	}

	//cambia el color de una línea
	function colores(color){
		col=color;
		ctx.strokeStyle=col;
		ctx.fillStyle = col;
		if (activa!=4){
			activa=3;
		}
		accion=2;
		document.getElementById("es").focus();
	}








	//ejecuta acciones al presionar clic abajo
	function abajo(){
		if(activa==2){
			mouse();
			src=document.getElementById('img').value;
			var img = new Image();
			img.src = document.getElementById('img').value;


			ancho=img.width;
			alto=img.height;

			

			//coloca al centro la imagen
			ancho=ancho/2;
			alto=alto/2;


			ancho2=ancho;
			alto2=alto;

			if(x+ancho>1330){
				ancho2=1330-x;
				alto2=alto*2*ancho2/(ancho*2);	
			}

			if(x-ancho<0){
				ancho2=x;
				alto2=alto*2*ancho2/(ancho*2);	
			}
			
			ancho3=ancho2;
			alto3=alto2;

			if(y+alto2>550){
				alto3=550-y;
				ancho3=ancho2*2*alto3/(alto2*2);	
			}

			if(y-alto2<0){
				alto3=y;
				ancho3=ancho2*2*alto3/(alto2*2);	
			}			

			x2=x-ancho3;
			y2=y-alto3;
			

			//dibuja la imagen
			ctx.drawImage(img, x2, y2, ancho3*2, alto3*2);
			activa=4;

			document.getElementById("resul").value="0::";
			document.getElementById("resul").value=document.getElementById("resul").value+"9--"+src+"--"+x2+"--"+y2+"--" + (ancho3*2) + "--" + (alto3*2) +"::";
			
		}
		if (activa!=4){
			mouse();
			ctx.beginPath();
			ctx.moveTo(x,y);
			ctx.stroke();
			document.getElementById("resul").value="0::";
			document.getElementById("resul").value=document.getElementById("resul").value+"1--"+x+"--"+y+"::";
			//if (activa==3){
				document.getElementById("resul").value=document.getElementById("resul").value+"4--"+col+"::";
			//}
			activa=1;
		}
	}

	function mueve(event){
		if (activa==1){
			mouse(event);
			document.getElementById("resul").value=document.getElementById("resul").value+"2--"+x+"--"+y+"::";
			ctx.lineTo(x,y);
			ctx.stroke();
		}
	}

	function termina(){
		if (activa==1){
			txt=document.getElementById("es").value;
			if (txt!=""){
				document.getElementById("resul").value=document.getElementById("resul").value+"6--"+txt+"--"+x+"--"+y+"--"+tam+"::";
				ctx.font = tam + " Comic Sans MS";
				
				ctx.lineWidth = 1;
				ctx.fillText(txt,x,y);
				document.getElementById("es").value=""
			}
			activa=0;
			document.getElementById("es").focus();
		}





		if (activa==4){
			if (fig==0){
				goma();
			}
			if (fig==1){
				linea();
			}
			if (fig==2){
				tr_r();
			}
			if (fig==3){
				tr_e();
			}
			if (fig==4){
				tr_l();
			}
			if (fig==5){
				circ();
			}
			if (fig==6){
				llave();
			}
		}
		
		ctx.closePath();
		document.getElementById("resul").value=document.getElementById("resul").value+"3::";
		guarda()
	}
	
	function toque_inicio(event) {
    event.preventDefault();
    var touch = event.touches[0];
    var fakeEvent = {
        clientX: touch.clientX,
        clientY: touch.clientY
    };
    abajo(fakeEvent);
}

function toque_mueve(event) {
    event.preventDefault();
    var touch = event.touches[0];
    var fakeEvent = {
        clientX: touch.clientX,
        clientY: touch.clientY
    };
    mueve(fakeEvent);
}

function toque_fin(event) {
    event.preventDefault();
    termina();
}

</script>








<div id="jaas-container"></div>

  



