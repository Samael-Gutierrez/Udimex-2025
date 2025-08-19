<?php
    session_start();
    $dir="../../general/";
    include($dir."php/admin.php");
    include($dir."db/admin.php");
    include($dir."db/basica.php");
    include($dir."db/publicidad.php");

 $adicional="<link rel='stylesheet' href='".$dir."css/publicidad.css'><link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css'>";
   cabeza("Publicidad - Udimex",$adicional,0);
   
    usuario("../../",'index.php');
    menu_i($dir);
    
   
   //Busca las publicaciones de un usuario
   $publicaciones="";
   $datos=b_publicaciones($_SESSION["ad_id"],0);
   while($fila=mysqli_fetch_assoc($datos)){
   	$publicaciones=$publicaciones."
   	<tr>
   		<td class='td-nombre-y-boton2'>".$fila['nombre']."</td>
		<td  id='td-contenido2' class='scroll td-contenido2'>".$fila['contenido']."</td>
		<td class='td-nombre-y-boton2'>
			<a href='publicidad_edita.php?id=".$fila['id_publicidad']."' class='botonEditar button'>
				<i class='bi bi-pencil-square tamaño-icons2'></i>
			</a>
			<a onclick='return eliminar()' href='publicidad_borra.php?id=".$fila['id_publicidad']."' class='botonBorrar'>
				<i class='bi bi-trash3 tamaño-icons2'></i>
			</a>
		</td>
	</tr>";
}

?>

<body>

<section class="desactivadas-s1" id="titulo-desac">
    <div class="text-s1 candal">
        <h1000>Publicaciones Desactivadas</h1000>
    </div>
</section>

<section class="s2 centrado" id="Desactivadas">
<div class="s2-contenedor centrado">
<table width="100%" class="table-container2" id='table-container'>
        <thead>
            <tr>
                <th class="th-color2">Nombre</th>
                <th class="th-color2">Contenido</th>
                <th class="th-color2">Opciones</th> 
            </tr>
        </thead>
        <tbody>
            <?php echo $publicaciones; ?>
              
        </tbody>
    </table>

    <div class="container-botones">   
        <a href="publicidad_agrega.php"class="boton-add "><i class="bi bi-plus-square tamaño-icons"></i></a>
        <a href="index.php" name="Activa-Desactiva" id="Activa-Desactiva" class='candal boton-desac'>Activadas</a>
    </div>
</div>
</section>

    <script>
        function eliminar() {
            var respuesta = confirm("¿Estás seguro que deseas eliminar?");
            return respuesta;
        }
    </script>
</body>
</html>
