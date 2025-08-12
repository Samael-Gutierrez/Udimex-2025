<?php
session_start();
include('../funciones.php');
include('../../general/consultas/usuario.php');
include('../../general/consultas/admin.php');
include('../../general/consultas/basic.php');
include('../../general/consultas/carreras.php');
include('../../general/consultas/prospecto.php');

cabeza();
menu_i();

// variable de envio
$id=$_GET['ver'];

// nombre del promotor
if($_GET){
	$id=$_GET['ver'];
	$datos=b_usu($id);
	if ($fila=mysqli_fetch_assoc($datos)){
        	
		$nom=$fila["nombre"];
        $apepa=$fila["ap_pat"];
		$apema=$fila["ap_mat"];	
			
     	}}
// Tabla de los prospectos del promotor
if(isset($id)){
	$datos=b_u_pros($id);
   	$est="";
    $prospectos="";
	while ($fila=mysqli_fetch_assoc($datos)){
		$datos2=ult_seg($fila['id_prospecto']);
		if($fila2=mysqli_fetch_assoc($datos2)){
			$est=$fila2['estatus'];
		}
        $prospectos=$prospectos."<tr><td>".$fila['id_prospecto']."</td><td>".$fila['nombre']."</td><td>".$fila['ap_pat']."</td><td>".$fila['ap_mat']."</td>
        <td>".$fila['numero']."</td><td>".$fila['m_contacto']."</td><td>".$fila['c_insc']."</td><td>".$fila['c_mens']."</td><td>".$fila['c_cert']."</td>
        <td>".$fila['modalidad']."</td><td>".$fila['carrera']."</td><td>".$est."</td><td>".$fila2['fecha']."</td>
		<td><a href='historial.php?ver=".$fila['id_prospecto']."'><button class='ver'>Ver</button></a></td></tr>";
      
	}
    
	 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Reporte</title>
   
</head>

<body>
    
    <header class="">
        <div class="">
		    <h1>Reporte de  <?php echo $nom," ",$apepa," ",$apema ?> </h1>
        </div>

        <a href="archivos/reporte_pdf.php" class=""><b>PDF</b> </a>

		<table class="" border=".5">
		    <th>ID</th>
			<th>Nombre</th>
			<th>A. Paterno</th>
            <th>A. Materno</th>
			<th>Teléfono</th>
            <th>Med. Contacto</th>
            <th>Inscripción</th>
            <th>Mensualidad</th>
            <th>Certificado</th>
            <th>Modalidad</th>
            <th>Servicio</th>
            <th>Estatus</th>
            <th>Fecha</th>
            <th>Observaciones </th>
           
					
				
                <?php
				echo $prospectos;
                
               ?>
				
			</table>
    


    
    <a href='reporte.php'><button class="">Regresar</button></a>
</body>
</html>
