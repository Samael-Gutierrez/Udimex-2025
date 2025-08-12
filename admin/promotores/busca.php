<?php
session_start();
include('../../general/consultas/basic.php');
include('../../general/consultas/promotor.php');
include('../../general/consultas/carreras.php');
include('../../general/consultas/usuario.php');
include('../../general/consultas/prospecto.php');
include('../funciones.php');


abrir();
$where="";



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Prospecto</title>
   
</head>
<body>
<header class="barra">
        <div class="contenedor">
		<h1>Busca prospecto</h1>
        </div>
    </header>
    <script src="../../general/js/buscador.js"></script>


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
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Paterno</th>
						<th>Número</th>
                        <th>Promotor</th>
                        <th>Detalles</th>
				    </tr>
                        </thead>
                        <tbody>

<?php

            
$datos=b_nomb($where);
$cprom="";


if($datos){
    while($fila=mysqli_fetch_array($datos)){
        $dato2=c_prom($fila['id_promotor']);
        if($fila2=mysqli_fetch_array($dato2)){
            $cprom=$fila2['nombre'];
        }
        echo "
					<tr>
						<td>".$fila['nombre']."</td>
						<td>".$fila['ap_pat']."</td>
						<td>".$fila['ap_mat']."</td>
						<td>".$fila['numero']."</td>   
                        <td>".$fila2['nombre']."</td> 
                        <td><a class='btn btn-warning' href='detalles.php?id=".$fila['id_prospecto']."'><button class='ver'>Ver</button></a>

  
</td>                 
                       
                    </tr>
						
				";}
                mysqli_free_result($datos);
		echo "</table>";
    }
    
?>

  </table>

  <a href='inpros.php'><button class="botons">Regresar</button></a>
 


</body>
</html>