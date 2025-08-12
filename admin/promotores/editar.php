<?php

include('../funciones.php');
include('../../general/consultas/usuario.php');
include('../../general/consultas/admin.php');
include('../../general/consultas/basic.php');
include('../../general/consultas/carreras.php');
include('../../general/consultas/prospecto.php');


if($_GET){
	$id=$_GET['edit'];
	$datos=b_usu($id);
	if ($fila=mysqli_fetch_assoc($datos)){
        	// Datos usuario
		$nom=$fila["nombre"];
		$apepa=$fila["ap_pat"];
		$apema=$fila["ap_mat"];	
     	}
 
	$datos=b_dat_pros($id);
	if ($fila=mysqli_fetch_assoc($datos)){
			// Datos prospecto
		$liga=$fila["m_contacto"];
		$ins=$fila["c_insc"];
		$cm=$fila["c_mens"];
		$ccer=$fila["c_cert"];
		$mo=$fila["modalidad"];
		$carrera=$fila["carrera"];
		$prom=$fila["id_promotor"];
	
	}
	
	$datos=b_dat_segpros($id);
	if ($fila=mysqli_fetch_assoc($datos)){

			// Datos prospecto_seguimiento
		$fecha=$fila["fecha"];
		$est=$fila["estatus"];
		$obs=$fila["observaciones"];
    	}
		

	$datos=busca_tel2($id);
		if ($fila=mysqli_fetch_assoc($datos)){
			//datos telefono
			$telefonoa=$fila["numero"];
			
		}

	//devuelve
		
	$dato=b_prom($prom);
	if ($fila=mysqli_fetch_assoc($dato)){

	   $prom=$fila['nombre']." ".$fila['ap_pat']." ".$fila['ap_mat'];
}
}

//fecha actual guarda
date_default_timezone_set('America/Mexico_City');
$fecha = date('d-m-Y');

?>


<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>


    <link rel="" href="">

</head>

<body id="page-top">


<form  action="funcion.php" method="POST">
<div id="" >
                           
<br><br>
            <h3 class="">Editar prospecto</h3>
                <div class="">
                    <label for="" class="">Nombre</label>
                        <input type="text"  id="nombre" name="nombre" class="f" value="<?php echo $nom," ", $apepa," ", $apepa;?>"disabled>
                </div><br>

                <div class="">
                    <label for="">Modalidad:</label>
                        <input type="text" name="mo" id="mo" class="" placeholder="" value="<?php echo $mo;?>"disabled>
                </div><br>

                <div class="" class="">
                    <label for="">Servicio:</label>
                        <input type="text" name="carrera" id="carrera" class="" placeholder="" value="<?php echo $mo;?>"disabled>
                </div><br>

                <div class="" class="">
                    <label for="" class="">Telefono *</label>
                        <input type="tel"  id="telef" name="telef" class="" value="<?php echo $telefonoa;?>" disabled>
                </div><br>

                <div class="">
                    <label for="" class="form-label">Estatus *</label>
                        <select name="est" required>
                            <option type="text" value="Primer contacto"  id="pc">Primer contacto</option>
                            <option type="text" value="Seguimiento"  id="s">Seguimiento</option>
                            <option type="text" value="No contesta mensajes"  id="nm">No contesta mensajes</option>
                            <option type="text" value="No contesta llamada" id="nl">No contesta llamada</option>
                            <option type="text" value="Cita" id="c">Cita</option>
                            <option type="text" value="Cancelo cita" id="cc">Cancelo cita</option>
                            <option type="text" value="Inscrito"  id="i">Inscrito</option>
                        </select>

                </div><br>

                <div class="">
                    <label for="" class="">Observaciones*</label><br>
                        <textarea rows="4" cols="20" name="obs" id="obs" placeholder="Observaciones"></textarea required>
              
                    <input type="hidden" name="accion" value="editar_registro">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                </div>

                <div class="">
                    <button type="submit" class="" >Editar</button>
                    <button><a href="mis_prospectos.php">Cancelar</button></a>
                </div>

</div>
</form>
                    
                
</body>
</html>