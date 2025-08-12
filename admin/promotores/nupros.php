<?php
session_start();
include('../../general/consultas/basic.php');
include('../../general/consultas/promotor.php');
include('../../general/consultas/carreras.php');
include('../../general/consultas/usuario.php');
include('../../general/consultas/prospecto.php');
include('../funciones.php');


$id=$_SESSION["ad_id"];
$prom="";

//datos promotor
$datos=b_promotor();
while($fila=mysqli_fetch_assoc ($datos)){
$seleccion="";

    if($fila['id_usuario']==$id){$seleccion="selected";}
 $prom=$prom."<option value='".$fila['id_usuario']."' $seleccion>".$fila['nombre']." ".$fila['ap_pat']." ".$fila['ap_mat']."</option>";
}

//fecha actual guarda
date_default_timezone_set('America/Mexico_City');
$fecha = date('d-m-Y');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Prospecto</title>
    
    
<script>
    function valida(){
        let form=document.getElementById("formulario");
        tel=document.getElementById("telef").value;
        med=document.getElementById("liga").value;
        if(tel.length>0){
           
            form.submit()
        } else{
            if(med.length>0){
                form.submit()
            }else{
                alert("campos vacios");

            }            
        } 
    }
</script>
   
</head>
<body>

    <header class="barra">
        <div class="contenedor">
            <h2>Nuevo Prospecto</h2>
        </div>
    </header>


<form method="POST" action="registro.php" onsubmit="valida(); return false;" id="formulario">


                <legend>Llena todos los campos</legend>

                <?php echo $fecha?>
<div class="form">

                <div class="lleno">
                    <label>Servicio:</label><br>
                       <select name="carrera">
                            
                            <option type="text" value="Primaria"  id="p">Primaria</option>
                            <option type="text" value="Secundaria"  id="s">Secundaria</option>
                            <option type="text" value="Prepa abierta"  id="pa">Prepa abierta</option>
                            <option type="text" value="Prepa semiescolarizada" id="ps">Prepa semiescolarizada</option>
                            <option type="text" value="Lic Admin" id="lc">Lic Administración</option>
                            <option type="text" value="Lic Der" id="ld">Lic Derecho</option>
                            <option type="text" value="Lic Sis"  id="ls">Lic Sistemas Computacionales</option>
                            <option type="text" value="Ing"  id="li">Ingeniería Industrial </option>
                            <option type="text" value="Lic Cie"  id="ls">Lic Ciencias de la edicación</option>
                            <option type="text" value="Lic Ges"  id="lg">Lic Gestión y Administración Pública</option>
                            <option type="text" value="Lic ped"  id="ld">Lic Pedagogía</option>
                            <option type="text" value="Est"  id="es">Estilismo</option>
                    </select>
                </div>
<br>
                <div class="">
                    <label>Modalidad:</label><br>
                        <input type="radio" value="Presencial" name="mo" id="m" checked> Presencial
                        <input type="radio" value="Linea" name="mo" id="g"> Linea
                        <input type="radio" value="Mixto" name="mo" id="x"> Mixto<br>
                </div>
<br>
                <div class="lleno">
                    <label>Nombre(s):</label>
                    <input type="text" placeholder="Nombre(s)" name="nombre" id="nombre">
               

                    <label>Apellido Paterno:</label>
                    <input type="text" placeholder="Apellido Paterno" name="ap" id="ap">
                
                
                    <label>Apellido Materno:</label>
                    <input type="text" placeholder="Apellido Materno" name="am" id="am">
                    
               
                    <br><br>
                          
                
                    <label>Teléfono:</label>
                    <input type="number"  placeholder="Telefono" name="telef" id="telef"  >
               
                    <label>Medio de contacto:</label>
                    <input type="text" placeholder="URL" name="liga" id="liga">
               
                    <label>Inscripción:</lable>
                    <input  type="text" placeholder="Inscripción" name="ins" id="ins">
                </div>
               
                    <div class="lleno"><br><br><label>Mensualidad:</label>
                    <input  type="text" placeholder="Mensualidad" name="cm" id="cm">
                    
               
                    <label>Certificado:</label>
                    <input type="text" placeholder="Certificado" name="cert" id="cert">
              
                    <label>Estatus:</label>
                    <select name="est">
                            
                            <option type="text" value="Primer contacto"  id="pc">Primer contacto</option>
                            <option type="text" value="Seguimiento"  id="s">Seguimiento</option>
                            <option type="text" value="No contesta mensajes"  id="nm">No contesta mensajes</option>
                            <option type="text" value="No contesta llamada" id="nl">No contesta llamada</option>
                            <option type="text" value="Cita" id="c">Cita</option>
                            <option type="text" value="Cancelo cita" id="cc">Cancelo cita</option>
                            <option type="text" value="Inscrito"  id="i">Inscrito</option>
                    </select>

                   <br><br><label>Asesor:</label>
                    <select name="prom" id="prom" >
                            <?php  echo $prom ?>
                        </select>

                </div><br>

                <div class="lleno">
                    <label>Observaciones:</label><br>
                    <textarea rows="4" cols="20" name="obs" id="obs" placeholder="Observaciones"></textarea>
                </div>

                <div class="">
                        <input type="submit" class="botons" value="Agregar Prospecto">
                        <a href='inpros.php'><input type ="button" class="botons" value="Regresar"></a>
                </div>
               
            </form>
  
            
</body>
</html>

