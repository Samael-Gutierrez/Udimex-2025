
<?php
session_start();
include('../../general/consultas/basic.php');
include('../../general/consultas/boletas.php');
include('../../general/consultas/carreras.php');
include('../../general/consultas/usuario.php');
include('../funciones.php');



$id=$_GET['ver'];

//variables de aumento
$dias=5;
$veces=2;
$aumento = 0.10; // 10%


if($_GET){
	$id=$_GET['ver'];
	$datos=b_usu($id);
    $datos2=b_pago($id);
    $datos3=b_cole($id);
	if ($fila=mysqli_fetch_assoc($datos)){
        
        $mat=$fila["id_usuario"];
		$nom=$fila["nombre"];
        $apepa=$fila["ap_pat"];
		$apema=$fila["ap_mat"];		
     	}
         if ($fila=mysqli_fetch_assoc($datos2)){
            $f_pago=$fila["f_caducidad"];
            }
            if ($fila=mysqli_fetch_assoc($datos3)){
                $cole=$fila["colegiatura"];
              
            }
         
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="estilo.css">
    <title>Boleta</title>
   
</head>

<body>
    
    <header>
      <img src="img/fondo.png" >
    </header>

    
    <div id="texto1">
        <p> <b>BOLETA DE PAGO DE SERVICIOS</b> &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
        &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<b>CONCEPTO DE COBRO</b></p>
    </div>

    <div class="principal">
        <p>NOMBRE: <b><?php echo $nom," ",$apepa," ",$apema ?></b>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; 
        &nbsp; &nbsp; &nbsp; &nbsp; 
        &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;  
        MENSUALIDAD<br><br>      
        MATRICULA: <b><?php echo $mat ?>/<?php echo date("y") ?></b>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; 
        &nbsp; &nbsp; &nbsp; &nbsp; 
        &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; 
        &nbsp; &nbsp; &nbsp; &nbsp; 
        &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        MES: <b> <?php echo date("n") ?>/<?php echo date("y") ?></p></b>      

    </div>


    <div class="tabla-container">  
		<table class="banco" border="1"> 
            <tr>
                <th scope="row">BANCO/ESTABLECIMIENTO</th>
			    <th>N° DE CUENTA</th>
            </tr>
            <tr>
                <th><img src="img/bazteca.png" width="70" height="40"></th>
                <td><b>4027 6658 1431 5579</b></td>    
            </tr>
            <tr>
                <th><img src="img/bcoppel2.png" width="70" height="50"></th>
                <td><b>4169 1614 0028 9426</b></td>    
            </tr>
            <tr>
                <th><img src="img/bbva.png" width="100" height="50"></th>
                <td><b>4152 3141 7476 2128</b></td>    
            </tr>
            <tr>
                <th><img src="img/oxxo.png" width="100" height="50"></th>
                <td><b>4169 1614 0028 9426</b></td>    
            </tr>
		</table><br>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; 
        
        &nbsp; &nbsp; &nbsp; &nbsp; 
        &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

<?php
echo '<table border="1" class="pago">
<tr>
    <th scope="row">N°</th>
	<th>FECHA LIMITE</th>
    <th>TOTAL A PAGAR</th>
    
</tr>';

// fecha de pago original
echo "
<tr>
    <th><b>1</b></th>
    <td>$f_pago</td>
    <td>$$cole</td>
   
</tr>

";
// aumento 
for($i=1; $i<=$veces; $i++){
    $f_pago=date('Y-m-d', strtotime($f_pago . " +$dias days"));
    $cole=$cole+($cole*$aumento);
    echo "<tr><td><b>".($i+1)."</b></td>";
    echo "<td>$f_pago";
    echo "<td>$$cole</td>";
    echo "</tr>";
}

// Cierra tabla
echo '</table> <br><br>';
?>
    
</div>

<div class="sello">
  <img src="img/copia.png" width="260px" align="right" >
</div>

<br><br><br><br><br>
<br><br><br><br><br><br><a href='index.php'><button class="ocultar-al-imprimir">Regresar</button></a>

    
</body>
</html>