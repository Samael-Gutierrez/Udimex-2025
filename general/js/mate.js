<script>
	function retornarLienzo(x){
		var canvas = document.getElementById(x);
		if (canvas.getContext){
			var lienzo = canvas.getContext('2d');   
			return lienzo;
		}
		else{
			return false;
		}
	}

	function fraccion(num,den,lienzo){			//parametros numerador, denominador, identidicador de lienzo
		
		l1=num.length*11;				//longitud del texto
		l2=den.length*11;
		c1=7;						//posicion default
		c2=7;

		if (l1>l2){
			m=l1;					//maxima anchura
		}
		else{
			m=l2;
		}

		c1=(m-l1)/2;					//ajusta la mínima anchura
		c2=(m-l2)/2;
		
		document.getElementById(lienzo).width=m;	//ajusta la anchura del canvas

		var lienzo=retornarLienzo(lienzo);

		if (lienzo){ 
			lienzo.strokeStyle = 'rgb(2,98,157)';
			lienzo.lineWidth=2;
			lienzo.beginPath();
			lienzo.moveTo(0,20);
			lienzo.lineTo(m,20);
			lienzo.stroke();
	 
			lienzo.fillStyle = 'rgb(255,99,1)';
			lienzo.font = "20px Arial";
			lienzo.fillText(num,c1,16);

			lienzo.fillText(den,c2,38);
		}
	}


function raiz(num,lienzo){
	l1=(num.length*10)+28;
	document.getElementById(lienzo).width=l1;
	var lienzo=retornarLienzo(lienzo);
	if (lienzo){ 
		lienzo.strokeStyle = 'rgb(2,98,157)';
		lienzo.lineWidth=2;
		lienzo.beginPath();
		lienzo.moveTo(5,5);
		lienzo.lineTo(10,20);
		lienzo.lineTo(10,2);
		lienzo.lineTo(10000,2);
		lienzo.stroke();

		lienzo.fillStyle = 'rgb(255,99,1)';
		lienzo.font = "20px Arial";
		lienzo.fillText(num,16,20);
	}
}
</script>
