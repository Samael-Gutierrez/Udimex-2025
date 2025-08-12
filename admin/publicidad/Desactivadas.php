<?php
session_start();
include("../funciones.php");
include("../../general/consultas/admin.php");
include("../../general/consultas/basic.php");
echo "hola";
include("funciones/paginationDes.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"  content="width=device-width, user-escalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
    <link rel="stylesheet" href="css/newEstilos.css">
    <title>Publicaciones</title>

    <?php
        usuario("../../",'index.php');
        menu_i("../");
    ?>
    
</head>
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
            <?php
                if($totalregistros>=1):
                    foreach($registros as $reg):
                ?>
                <tr>
                    <td class="td-nombre-y-boton2"><?php echo $reg['nombre'] ?></td>
                    <td  id="td-contenido2" class="scroll td-contenido2"><?php echo $reg['contenido'] ?></td>
                    <td class="td-nombre-y-boton2">
                        <a href="funciones/editarPublicacion.php?id=<?php echo $reg['id_publicidad'] ?>" class="botonEditar button">
                        <i class="bi bi-pencil-square tamaño-icons2"></i>
                        </a>
                        <a onclick="return eliminar()" href="funciones/borrar.php?id=<?php echo $reg['id_publicidad'] ?>" class="botonBorrar">
                        <i class="bi bi-trash3 tamaño-icons2"></i>
                        </a>
                    </td>
                </tr>
            <?php 
                    endforeach;
                else:
                 ?>
                 <tr>
                    <td colspan="3">No hay registros</td>
                 </tr>
                 <?php endif;
                 ?>
        </tbody>
    </table>

    <div class="container-botones">
        <div class="paginationZ">
        <section class="col-md-12 text-center">
    <?php if($totalregistros>=1): ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg pager" id="developer_page">
            <?php if($pagina==1): ?>
            <li class="page-item disabled tamano-pagination">
                <a class="page-link tamano-pagination" href="#" aria-label="Anterior">
                <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php else:?>
                <li class="page-item">
                <a class="page-link tamano-pagination" href="Desactivadas.php?pagina2=<?php  echo $pagina-1?>" aria-label="Anterior">
                <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
                endif; 
                for($i=1; $i<=$numeropaginas; $i++){  
                    if($pagina==$i){
                        echo '<li class="active page-item active tamano-pagination"><a class="page-link tamano-pagination" href="Desactivadas.php?pagina='.$i.'">'.$i.'</a></li>';
                    }else{
                        echo '<li page-item active"><a class="page-link tamano-pagination" href="Desactivadas.php?pagina='.$i.'">'.$i.'</a></li>';
                    } 
                }

                if($pagina==$numeropaginas):
            ?>
                <li class="page-item disabled tamano-pagination"><a class="page-link tamano-pagination" href="#" aria-label="Siguiente">
                <span aria-hidden="true">&raquo;</span></a>
            <?php else:?>
                <li class="page-item tamano-pagination"><a class="page-link tamano-pagination" href="Desactivadas.php?pagina=<?php echo $pagina+1?>" aria-label="Siguiente">
                <span aria-hidden="true">&raquo;</span></a>
            </li>
                <?php endif;?>
        </ul>
    </nav>
    <?php endif; ?>
    </section>
    </div>
    
        <a href="funciones/addPublicacion.php"class="boton-add "><i class="bi bi-plus-square tamaño-icons"></i></a>
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