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

cabeza("Prospectos - Udimex","");

?>



<body>

    <header class="barra">
        <div class="contenedor">
            <h1>Prospectos</h1>
        </div>
    </header>

    <div >
        <a href='nupros.php'><button class="botons">Nuevo prospecto</button></a>
        <a href='busca.php'><button class="botons">Buscar prospecto</button></a>
        <a href='mis_prospectos.php'><button class="botons">Ver mis prospectos</button></a>
        <a href='../menu.php'><button class="botons">Regresar</button></a>
    </div>


    </body>
</html>