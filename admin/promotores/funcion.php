<?php
include('../funciones.php');
include('../../general/consultas/usuario.php');
include('../../general/consultas/admin.php');
include('../../general/consultas/basic.php');
include('../../general/consultas/carreras.php');
include('../../general/consultas/prospecto.php');
   
abrir();

if (isset($_POST['accion'])){ 
    switch ($_POST['accion']){
        //casos de registros
        case 'editar_registro':
            editar_registro();
            break; 

		}

	}

    function editar_registro() {
     
		
		extract($_POST);
		$id= mod($id,$est,$obs);
        

}
header('Location: mis_prospectos.php');
?>