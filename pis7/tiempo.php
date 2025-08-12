<?php
session_start();
$_SESSION['le']=1;
$_SESSION['fe']=0;
?>
<canvas id="dibujo" width="1330" height="550" style="border:1px solid #d3d3d3; top:0px;">
	Tu navegador no soporta esta aplicación.
</canvas>



<p id="demo2" hidden></p>


<iframe width="100" height="100" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">






var myVar=setInterval(function(){myTimer()},500);

function myTimer(){
        $("#demo2").load('s_alf.php');
	c=document.getElementById("demo2").innerHTML;
	divide(c);
}


function divide(c){
	var cad = c.split("::");
	var i=0;
	while(cad[i]){
		ins=cad[i].split("--");
		control=ins[0];
		control=control.replace("\n","");
		control=control.replace(" ","");

		if (control==0){
			inicio();
		}

		if (control==1){
			mover(ins[1],ins[2]);
		}
		if (control==2){
			linea(ins[1],ins[2]);
		}
		if (control==3){
			termina();
		}
		if (control==4){
			color(ins[1]);
		}
		if (control==5){
			borra();
		}
		if (control==6){
			escribe(ins[1],ins[2],ins[3],ins[4]);
		}
		if (control==7){
			borra2(ins[1],ins[2],ins[3],ins[4]);
		}
		if (control==8){
			circ(ins[1],ins[2],ins[3],ins[4],ins[5]);
		}

		//Coloca una imagen
		if (control==9){
			imagen(ins[1],ins[2],ins[3],ins[4],ins[5]);
		}
		i=i+1;
	}
}

var c=document.getElementById("dibujo");
var ctx=c.getContext("2d");

//inica el dibujo en canvas
function inicio(x,y){
	ctx.beginPath();
}

//Mueve ubicacion
function mover(x,y){
	ctx.moveTo(x,y);
}

//mover y dibujar linea
function linea(x,y){
	ctx.lineTo(x,y);
	ctx.stroke();
}

//termina un dibujo
function termina(){
	ctx.closePath();
}

//colorea una linea
function color(col){
	ctx.strokeStyle=col;
	ctx.fillStyle = col;
	ctx.stroke();
}

//dibuja un circulo
function circ(x,y,cen,ar1,ar2){
	ctx.arc(x,y,cen,ar1,ar2);
	ctx.stroke();
}

//borra canvas
function borra(){
	ctx.clearRect(0,0,1330,550);
}

//borra canvas
function borra2(x,y,w,h){
	ctx.clearRect(x,y,w,h);
}

//escribe texto
function escribe(texto,x,y,tam){
	ctx.font = tam + " Comic Sans MS";
	ctx.lineWidth = 1;
	ctx.fillText(texto,x,y);
}

function imagen(imagen,x,y,ancho,alto){
	var img = new Image();
	img.src = imagen;

	//dibuja la imagen
	ctx.drawImage(img, x, y, ancho, alto);
}







</script>



