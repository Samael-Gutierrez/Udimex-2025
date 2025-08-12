<?php
	include("../consultas.php");
	include("funciones.php");
	$id=$_POST['id'];
	$cant=$_POST['cantidad'];
	$tipo=$_POST['tipo'];
	$fp=$_POST['fp'];
	$fc=$_POST['fc'];
	$ref=$_POST['ref'];

	if ($tipo==1){
		$fc=m_dias($fp,9);
		//act_pag($id,$fp,$fc,$ref,$cant,$tipo);
		
		$datos=t_sem(149,1);
		$ya="";
		$falta="";
		while($fila=mysqli_fetch_assoc($datos)){
			$datos2=b_semana($fila['id_tema']);
			$fila2=mysqli_fetch_assoc($datos2);
			if ($fila2['total']>0){
				$ya=$ya.$fila['titulo']."<br>";
			}
			else{
				$falta=$falta.$fila['titulo']."<br>";
			}
		}
	}

	if ($tipo==2){
		act_pag($id,$fp,$fc,$ref,$cant,$tipo);
		$datos=b_mat_pag($id);
		while($fila=mysqli_fetch_assoc($datos)){
			$datos2=b_raiz($fila['id_materia'],$fila['id_profesor'],0);
			if ($fila2=mysqli_fetch_assoc($datos2)){
				g_raiz($fila2['id_material'],$id);
			}
		}
	}

	echo $tipo."Por activar<br>" .$falta."<br><br>Ya activados".$ya;

?>
