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
   $datos=b_publicaciones($_SESSION["ad_id"],1);
   while($fila=mysqli_fetch_assoc($datos)){
   	$publicaciones=$publicaciones."
   		<tr>
                    <td class='td-nombre-y-boton'>".$fila['nombre']."</td>
                    <td class='scroll td-contenido'>".$fila['contenido']."</td>
                    <td class='td-nombre-y-boton'>
                        <a href='publicidad_edita.php?id=".$fila['id_publicidad']."' class='botonEditar button'>
                        <i class='bi bi-pencil-square tamaño-icons2'></i>
                        </a>
                        <a onclick='return eliminar()' href='publicidad_borra.php?id=".$fila['id_publicidad']."' class='botonBorrar'>
                        <i  class='bi bi-trash3 tamaño-icons2'></i>
                        </a>
                    </td>
                </tr>";
   }
  




    ?>
</head>
<body>

    <section class="s1" id="s1">
        <div class="text-s1 candal">
            <h1000>Nuestras Publicaciones</h1000>
        </div>
    </section>

    <section class="s2 centrado" id="Activadas">
    <div class="s2-contenedor centrado">
    <table  id="table-container" width="100%" class="table-container">
        <thead>
            <tr>
                <th class="th-color">Nombre</th>
                <th class="th-color">Contenido</th>
                <th class="th-color">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $publicaciones; ?>
        </tbody>
    </table>
    <div class="container-botones">

        <a href="publicidad_agrega.php"class="boton-add"><i class="bi bi-plus-square tamaño-icons"></i></a>
        <a href="Desactivadas.php" name="Activa-Desactiva" id="Activa-Desactiva" class='candal boton-desac'>Desactivadas</a>
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
