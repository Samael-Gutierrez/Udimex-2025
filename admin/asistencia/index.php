<?php
session_start();
include ('funciones.php');
include("../funciones.php");
include("../../general/consultas/usuario.php");
include('../../general/consultas/admin.php');


	

$id = 1;

$t_grupos = o_grupo($id);
$grupos_l = "";
$grupos_t = "";
 while($fila = mysqli_fetch_assoc($t_grupos)){
  $s_alumnos = s_alumnos($fila['id_grupo']);
  while ($fila2 =  mysqli_fetch_assoc($s_alumnos)){
    $alumnos = $fila2['alumnos'];
  }
   $v_calificacion = revisa_c($fila['id_grupo'], $fila['id_materia']);
 $fila3 = mysqli_fetch_assoc($v_calificacion);
 if ($fila3) { 
     $valor = $fila3['valor'];
     if ($valor == 0) {
         $redireccion = 'parcial_1.php';
     } else {
       $redireccion = 'e_parcial1.php';
     }
 }
 $v_calificacion2=revisa_c2($fila['id_grupo'], $fila['id_materia']);
 $fila4 = mysqli_fetch_assoc($v_calificacion2);
 if ($fila4) { 
    $valor2 = $fila4['valor2'];
   if ($valor2 == 0) {
        $redireccion2 = 'parcial_2.php';
   } else {
      $redireccion2 = 'e_parcial2.php';
     } 
   }

 if($fila['dias']=="En línea"){
   $direccion= 'informe_l.php';
 }else{
   $direccion= 'pase.php';
 }
  if ($alumnos >=1) {
    $grupos_t = $grupos_t ."
    <div class= 'info' id='info'>
    <div class= 'encabezado'>
    <h3>Grupo ".$fila['id_grupo']."</h3>
    <h3>".$fila['nombre']."</h3>
    </div>
    <div class= 'intermedio'>
    <h4>Dias:</h4>      
    <h3>".$fila['dias']."</h3>
    <h4>Horario:</h4>
    <h3>".$fila['horario']."</h3>
        </div>
    <div class='re-direcciones'>
    <form action='alumnosG.php' method='post'>
        <input type='text' name='id_grupo' class='igrupo' value='$fila[id_grupo]' hidden>
        <input type='text' name='id_materia' class='igrupo' value='$fila[id_materia]' hidden>
       <button type='submit' class='pase'><i class='bi bi-people-fill'></i></button>   
     </form>

  <div class='desplegable'>
  <button class='pase'><i class='bi bi-list-ol'></i></button>
  <div class='links'>
        <form action='calificacion_f.php' method='post'>
       <input type='text' name='id_grupo' class='igrupo' value='$fila[id_grupo]'  hidden>
       <input type='text' name='id_materia' class='igrupo' value='$fila[id_materia]' hidden>
       <button type='submit'><i class='bi bi-3-circle-fill parciales'></i></button>   
    </form>
          <form action='$redireccion2' method='post'>
       <input type='text' name='id_grupo' class='igrupo' value='$fila[id_grupo]'  hidden>
       <input type='text' name='id_materia' class='igrupo' value='$fila[id_materia]' hidden>
       <button type='submit'><i class='bi bi-2-circle-fill parciales'></i></button>   
    </form>
          <form action='$redireccion' method='post'>
       <input type='text' name='id_grupo' class='igrupo' value='$fila[id_grupo]'  hidden>
       <input type='text' name='id_materia' class='igrupo' value='$fila[id_materia]' hidden>
       <button type='submit'><i class='bi bi-1-circle-fill parciales'></i></button>   
    </form>
    </div>
  </div>


      <a href='pase.php?id_grupo=$fila[id_grupo]&id_materia=$fila[id_materia]&dias=$fila[dias]'><button type='submit' class='pase'><i class='bi bi-person-fill-check'></i></button></a>   

      </div>
     </div>";
     
         /*<form action='$direccion' method='post'>
      <input type='text' name='id_grupo' class='igrupo' value='$fila[id_grupo]' hidden>
      <input type='text' name='id_materia' class='igrupo' value='$fila[id_materia]' hidden>
      <input type='text' name='dias' class='igrupo' value='$fila[dias]'hidden>
      <button type='submit' class='pase'><i class='bi bi-person-fill-check'></i></button>   
  </form>*/
  
  
  }
}

cabeza("Agenda - Udimex","  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css'>  <link rel='stylesheet' href='css/inicio.css'>  ");
?>

<body>
    
    <?php 
        usuario('../../../','index.php');
	    menu_i2();
	 ?>   
	
	
    <h1>Lista de grupos</h1>
    <div class="busca_b">
      <div>
      <form action="inicio.php">
            <button><i class="bi bi-arrow-left-circle-fill volver"></i></button>
            </form>
      </div>
    <div class="buscadores"> 
      <form action="" method="post" class="buscador">
        <input type="text" name="campo" id="campo" class="busca" placeholder="Buscar" oninput="filtrado();">
      </form>
  </div>
  <div>
            <form action="grupo.php" method="post">
              <button type="submit" class="agrega"><i class="bi bi-plus-circle-fill"></i></button>
            </form>
          </div>
    </div>
  <div class="container">
  <span id="filtro"> </span>
          <?php echo $grupos_t;?>
          <?php echo $grupos_l; ?>
  </div>
    
</body>

<script>
 function filtrado() {
      var campo = document.getElementById('campo').value.toUpperCase(); 
      var info = document.getElementsByClassName('info'); 
      var filtro = document.getElementById('filtro');

   
        campo=campo.replace("Á","A");
        campo=campo.replace("É","E");
        campo=campo.replace("Í","I");
        campo=campo.replace("Ó","O");
        campo=campo.replace("Ú","U");

      var count = 0; 

      for (var i = 0; i < info.length; i++) {
        var texto = info[i].innerText;
        newtexto=texto.toUpperCase();
        newtexto=newtexto.replace("Á","A");
        newtexto=newtexto.replace("É","E");
        newtexto=newtexto.replace("Í","I");
        newtexto=newtexto.replace("Ó","O");
        newtexto=newtexto.replace("Ú","U");

        if (newtexto.includes(campo)) { 
          info[i].style.display = 'block';
          count++;
        } else {
          info[i].style.display = 'none';
        }
      }

      if (count === 0) {
        filtro.innerHTML = "No hay grupos para mostrar";
      } else {
        filtro.innerHTML = ""; 
      }
    }
</script>
</html>