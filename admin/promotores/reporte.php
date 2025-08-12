<?php
session_start();
include("../../general/consultas/admin.php");
include('../../general/consultas/basic.php');
include('../../general/consultas/promotor.php');
include('../../general/consultas/carreras.php');
include('../../general/consultas/usuario.php');
include('../../general/consultas/prospecto.php');
include('../funciones.php');


/*usuario("../../",1);*/
menu_i();

cabeza();
abrir();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Reporte</title>
   
</head>
<body>
<header class="barra">
        <div class="contenedor">
		<h1>Mis Promotores</h1>
        </div>
    
    


<div class="">
  <form class="">
      <input class="formu light-table-filter" data-table="table_id" type="text" placeholder="Buscar" >
      <br><br>
    </form>
  </div>

  <br>
  
 
  <table class="lleno   table-dark table_id ">

                   
<thead>    
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Apellido Paterno</th>
<th>Apellido Paterno</th>
<th>Detalles</th>

</tr>
</thead>
<tbody>
<?php

            
$datos=num_pr();
if($datos){
    while($fila=mysqli_fetch_array($datos)){
        
        echo "
					<tr>
            <td>".$fila['id_usuario']."</td>
						<td>".$fila['nombre']."</td>
						<td>".$fila['ap_pat']."</td>
						<td>".$fila['ap_mat']."</td>
						
            <td><a href='reporte_ver.php?ver=".$fila['id_usuario']."'><button class='ver'>Ver</button></a></td>           
          </tr>
						
				";}
                
		echo "</table>";
    }
    
?>

  </table>


  <script src="../../general/js/buscador.js"></script>
   
  <a href='../menu.php'><button class="botons">Regresar</button></a>

</body>
</html>