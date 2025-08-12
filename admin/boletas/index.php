<?php
session_start();
include("../../general/consultas/admin.php");
include('../../general/consultas/basic.php');
include('../../general/consultas/boletas.php');
include('../../general/consultas/usuario.php');
include('../funciones.php');


abrir();
$where="";

menu_i();

//cabeza();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="">
    <title>Boleta de Pagos</title>
   
</head>
<body> 
<header class="barra">
        <div class="contenedor">
    <h1>Generar boleta de pago</h1><a href='../menu.php'><button class="botons">Regresar</button></a>
        </div>
    </header>
    
    <script src="../../general/js/buscador.js"></script>


<div class="">
  <form class="">
       <center>
        <table border='0'>
          <tr>
            <td colspan='3'><p id='mensaje'>Escribe el nombre de alumno</p></td>
          </tr>
          <tr>
            <td><input type='text'class=" light-table-filter" data-table="table_id" id='nom' name='nom' placeholder='Nombre(s)'></td>
            <td><input type='text' class=" light-table-filter" data-table="table_id" id='ap' name='ap' placeholder='Apellido Paterno'></td>
            <td><input type='text' class=" light-table-filter" data-table="table_id" id='am' name='am' placeholder='Apellido Materno'></td>
          </tr>
        </table>
      </center><br>
    </form>
  </div>

  <br>

 
    <table class="table-dark table_id ">
        <thead>    
          <tr>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Paterno</th>
            <th>Fecha de pago</th>
          </tr>
        </thead>


<?php
/*tabla alumnos*/
 $datos=b_usual($where);
 $id="";

 if($datos){
  while($fila=mysqli_fetch_array($datos)){
    $dato2=b_pago($fila['id_usuario']);
    if($fila2=mysqli_fetch_array($dato2)){
      $id=$fila2['f_caducidad'];     
    }
    

    echo "
					<tr>
						<td>".$fila['nombre']."</td>
						<td>".$fila['ap_pat']."</td>
						<td>".$fila['ap_mat']."</td>
            <td>".$fila2['f_caducidad']."</td>
            
              <td><a class='' href='boleta.php?ver=".$fila['id_usuario']."'><button class=''>Ver</button></a></td> 

					</tr>";}
          mysqli_free_result($datos);
 }

    
?>

  </table>


</body>
</html>