<?php
session_start();
include('general/db/conecta.php');
include('general/db/usuario.php');
include('general/db/materia.php');


    // Archivo procesar_login.php
    if ($_POST) {
        $correo = $_POST['correo'];
        $clave = $_POST['clave'];
		
		echo password_hash("alftom2125", PASSWORD_DEFAULT);

		$datos=busca_usuario($correo, $clave);
		
		if($fila=mysqli_fetch_assoc($datos)){
			if(password_verify($clave, $fila['clave'])){
				//Variables de seison para el usaurio
				$_SESSION['id']=$fila['id_usuario'];
				$_SESSION['nombre']=$fila['nombre'];
				$_SESSION['ap']=$fila['ap'];
				$_SESSION['am']=$fila['am'];
				
				//Variable de sesion para periodo
				$datos=busca_periodo();
				if($fila=mysqli_fetch_assoc($datos)){
					$periodo=$fila['anio']." ".$fila['nombre'];
					$_SESSION['periodo']=$fila['id_pa'];
				}
				
				//Variable de sesion para materia
				$_SESSION['materia']=0;
				header("location:inicio");
			}
			else{
				header("location:index.php?error=2&c=$correo");
			}
        }
		else{
			header("location:index.php?error=1&c=$correo");
		}



    }
    ?>