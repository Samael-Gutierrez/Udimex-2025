<?php

function simbolos($s,$x,$v){
	echo "ctx.setLineDash([]);";
	//Derecho, aéreo, Sin enmascarar, Con Umbral 	
	if ($s==1){
		$simbolo="ctx.beginPath();
		ctx.arc($x, $v, 4, 0, 2 * Math.PI);
		ctx.stroke();";
	}

	//Derecho, aéreo, Sin enmascarar, Sin Umbral 	
	if ($s==2){
		$simbolo="ctx.beginPath();
		ctx.arc($x, $v, 4, 0, 2 * Math.PI);
		ctx.stroke();

		ctx.beginPath();
		ctx.moveTo($x-10,$v+4);
		ctx.lineTo($x-4,$v+10);
		ctx.lineTo($x-11,$v+11);
		ctx.closePath();
		ctx.fill();

		ctx.beginPath();
		ctx.moveTo($x-4,$v+4);
		ctx.lineTo($x-11,$v+11);
		ctx.closePath();
		ctx.stroke();";
	}
	if($s==3){
		$simbolo="
		ctx.beginPath();
		ctx.moveTo($x-7,$v);
		ctx.lineTo($x+7,$v);
		ctx.lineTo($x,$v-11);
		ctx.closePath();
		ctx.stroke();";
	}

	if($s==4){
		$simbolo="ctx.beginPath();
		ctx.moveTo($x-7,$v);
		ctx.lineTo($x+7,$v);
		ctx.lineTo($x,$v-11);
		ctx.closePath();
		ctx.stroke();

		ctx.beginPath();
		ctx.moveTo($x-14,$v+1);
		ctx.lineTo($x-8,$v+7);
		ctx.lineTo($x-15,$v+8);
		ctx.closePath();
		ctx.fill();

		ctx.beginPath();
		ctx.moveTo($x-7,$v+1);
		ctx.lineTo($x-15,$v+8);
		ctx.closePath();
		ctx.stroke();";
	}

	if($s==5){
		$simbolo="ctx.beginPath();
		ctx.font='18px arial';
		ctx.fillText('<',$x-1, $v+4);
		ctx.stroke();";
	}


	if($s==6){
		$simbolo="ctx.beginPath();
		ctx.font='18px arial';
		ctx.fillText('<',$x-1, $v+4);
		ctx.stroke();

		ctx.beginPath();
		ctx.moveTo($x-7,$v-2);
		ctx.lineTo($x-1,$v+4);
		ctx.lineTo($x-8,$v+5);
		ctx.closePath();
		ctx.fill();

		ctx.beginPath();
		ctx.moveTo($x-1,$v-2);
		ctx.lineTo($x-8,$v+5);
		ctx.closePath();
		ctx.stroke();";
	}


	if($s==7){
		$simbolo="ctx.beginPath();
		ctx.font='15px arial';
		ctx.fillText('[',$x-1, $v+4);
		ctx.stroke();";
	}

	if($s==8){
		$simbolo="ctx.beginPath();
		ctx.font='15px arial';
		ctx.fillText('[',$x-1, $v+4);
		ctx.stroke();

		ctx.beginPath();
		ctx.moveTo($x-8,$v+4);
		ctx.lineTo($x-2,$v+10);
		ctx.lineTo($x-9,$v+11);
		ctx.closePath();
		ctx.fill();

		ctx.beginPath();
		ctx.moveTo($x-2,$v+4);
		ctx.lineTo($x-9,$v+11);
		ctx.closePath();
		ctx.stroke();";
	}

	if($s==9){
		$simbolo="
		ctx.beginPath();
		ctx.moveTo($x-8,$v);
		ctx.lineTo($x+4,$v);
		ctx.lineTo($x+4,$v-13);
		ctx.closePath();
		ctx.stroke();";
	}

	if($s==10){
		$simbolo="
		ctx.beginPath();
		ctx.moveTo($x-8,$v);
		ctx.lineTo($x+4,$v);
		ctx.lineTo($x+4,$v-13);
		ctx.closePath();
		ctx.stroke();

		ctx.beginPath();
		ctx.moveTo($x-12,$v);
		ctx.lineTo($x-6,$v+6);
		ctx.lineTo($x-13,$v+7);
		ctx.closePath();
		ctx.fill();

		ctx.beginPath();
		ctx.moveTo($x-6,$v);
		ctx.lineTo($x-13,$v+7);
		ctx.closePath();
		ctx.stroke();";
	}



	if ($s==11){
		$simbolo="ctx.beginPath();
			ctx.moveTo($x-7, $v-7);
			ctx.lineTo($x+7, $v+7);
			ctx.moveTo($x-7, $v+7);
			ctx.lineTo($x+7, $v-7);
			ctx.stroke();";
	}
	
	if ($s==12){
		$simbolo="ctx.beginPath();
			ctx.moveTo($x-7, $v-7);

			ctx.lineTo($x+7, $v+7);
			ctx.moveTo($x-7, $v+7);
			ctx.lineTo($x+7, $v-7);
			ctx.stroke();

		ctx.beginPath();
		ctx.moveTo($x+10,$v+4);
		ctx.lineTo($x+4,$v+10);
		ctx.lineTo($x+11,$v+11);
		ctx.closePath();
		ctx.fill();

		ctx.beginPath();
		ctx.moveTo($x+4,$v+4);
		ctx.lineTo($x+11,$v+11);
		ctx.closePath();
		ctx.stroke();";
	}
	if($s==13){
		$simbolo="
		ctx.beginPath();
		ctx.moveTo($x-7,$v);
		ctx.lineTo($x+7,$v);
		ctx.lineTo($x+7,$v-11);
		ctx.lineTo($x-7,$v-11);
		ctx.closePath();
		ctx.stroke();";
	}

	if($s==14){
		$simbolo="ctx.beginPath();
		ctx.moveTo($x-7,$v);
		ctx.lineTo($x+7,$v);
		ctx.lineTo($x+7,$v-11);
		ctx.lineTo($x-7,$v-11);
		ctx.closePath();
		ctx.stroke();

		ctx.beginPath();
		ctx.moveTo($x+14,$v+1);
		ctx.lineTo($x+8,$v+7);
		ctx.lineTo($x+15,$v+8);
		ctx.closePath();
		ctx.fill();

		ctx.beginPath();
		ctx.moveTo($x+7,$v+1);
		ctx.lineTo($x+15,$v+8);
		ctx.closePath();
		ctx.stroke();";
	}

	if($s==15){
		$simbolo="ctx.beginPath();
		ctx.font='18px arial';
		ctx.fillText('>',$x-1, $v+4);
		ctx.stroke();";
	}


	if($s==16){
		$simbolo="ctx.beginPath();
		ctx.font='18px arial';
		ctx.fillText('>',$x-1, $v+4);
		ctx.stroke();

		ctx.beginPath();
		ctx.moveTo($x+15,$v-2);
		ctx.lineTo($x+9,$v+4);
		ctx.lineTo($x+17,$v+5);
		ctx.closePath();
		ctx.fill();

		ctx.beginPath();
		ctx.moveTo($x+9,$v-2);
		ctx.lineTo($x+17,$v+5);
		ctx.closePath();
		ctx.stroke();";
	}


	if($s==17){
		$simbolo="ctx.beginPath();
		ctx.font='18px arial';
		ctx.fillText(']',$x-1, $v+4);
		ctx.stroke();";
	}

	if($s==18){
		$simbolo="ctx.beginPath();
		ctx.font='18px arial';
		ctx.fillText(']',$x-1, $v+4);
		ctx.stroke();

		ctx.beginPath();
		ctx.moveTo($x+8,$v+4);
		ctx.lineTo($x+2,$v+10);
		ctx.lineTo($x+9,$v+11);
		ctx.closePath();
		ctx.fill();

		ctx.beginPath();
		ctx.moveTo($x+2,$v+4);
		ctx.lineTo($x+9,$v+11);
		ctx.closePath();
		ctx.stroke();";
	}

	if($s==19){
		$simbolo="
		ctx.beginPath();
		ctx.moveTo($x-8,$v);
		ctx.lineTo($x+4,$v);
		ctx.lineTo($x-8,$v-13);
		ctx.closePath();
		ctx.stroke();";
	}

	if($s==20){
		$simbolo="
		ctx.beginPath();
		ctx.moveTo($x-8,$v);
		ctx.lineTo($x+4,$v);
		ctx.lineTo($x-8,$v-13);
		ctx.closePath();
		ctx.stroke();

		ctx.beginPath();
		ctx.moveTo($x+12,$v);
		ctx.lineTo($x+6,$v+6);
		ctx.lineTo($x+13,$v+7);
		ctx.closePath();
		ctx.fill();

		ctx.beginPath();
		ctx.moveTo($x+6,$v);
		ctx.lineTo($x+13,$v+7);
		ctx.closePath();
		ctx.stroke();";
	}

	return $simbolo;
}



function lineas($cont){
	echo "<script>
	var c = document.getElementById('$cont');
	var ctx = c.getContext('2d');
	ctx.strokeStyle= '#cccccc';
	ctx.beginPath();
	";

	$esc=125;
	$inc=40;
	$i=0;
	$texto=125;
	for ($x=25; $x<=280; $x=$x+$inc){
		if ($x>70){
			$inc=20;
		}

		echo "ctx.moveTo($x, 270);
		ctx.lineTo($x, 15);";

		if ($esc==0){
			$esc="  0";
		}

		if ($esc>0){
			$esc=" ".$esc;
		}

		if($i==1){
			$texto=$texto+125;
		}
		if($i>1){
			$texto=$texto+250;
		}
		if($i>4){
			$texto=$texto+250;
		}

		if($i>6){
			$texto=$texto+500;
		}

		if($i>8){
			$texto=$texto+1000;
		}

		echo "
		ctx.font='bold italic 8px arial';
		ctx.fillText('$texto',$x-10, 10);
		ctx.stroke();";
		$esc=$esc+10;
	
		$i=$i+1;
	}

	$esc=-20;
	for ($y=20; $y<=280; $y=$y+20){
		echo "ctx.moveTo(270, $y);
		ctx.lineTo(19, $y);";

		if ($esc==0){
			$esc="  0";
		}

		if ($esc>0){
			$esc=" ".$esc;
		}


		echo "
		ctx.fillText('$esc',0, $y+2);
		ctx.stroke();";
		$esc=$esc+10;
	}



	echo "ctx.stroke();
	</script>";
}


function linea($xi,$yi,$x,$v,$tp){
	if ($tp==0){
	}
	else{
		if ($tp==1){
			echo "ctx.setLineDash([]);";			// línea recta //
		}
		if ($tp==2){
			echo "ctx.setLineDash([5, 5]);";		// línea punteada //
		}
		echo "
			ctx.beginPath();
			ctx.moveTo($xi, $yi);
			ctx.lineTo($x, $v);
			ctx.stroke();";
	}
}

?>
