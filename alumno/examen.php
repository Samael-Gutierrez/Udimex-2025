<?php
session_start();
include "funciones.php";

//Examen de comunicación del bloque 1
if($_GET){
    
    $_SESSION['sub']=$_GET['id'];
    $_SESSION['tiempo']=$_GET['tiempo'];

    $totales = compruebaRespuestas($_SESSION['sub'], $_SESSION['g_id']);
    while($total = mysqli_fetch_assoc($totales)){
        $totals = $total['totales'];
    }

    if($totals != 0){
        header('location: index.php?m=1');
    }else{
        header('location: ../examen/cuestionario.php');
    }
}
    
    
    /*
    if($_GET['id']==1){
        $_SESSION['mat']=1149;
        $_SESSION['tema']=506;
        $_SESSION['sub']=4554;
    }




    if($_GET['id']==2){
        $_SESSION['mat']=1148;
        $_SESSION['tema']=483;
        $_SESSION['sub']=4458;
    }
    
    //examen 286
    if($_GET['id']==3){
        $_SESSION['mat']=1144;
		$_SESSION['tema']=425;
		$_SESSION['sub']=4114;
    }
    
        //examen de algebra
    if($_GET['id']==4){
        $_SESSION['mat']=1148;
		$_SESSION['tema']=491;
		$_SESSION['sub']=4557;
    }
		
		
	if($_GET['id']==5){
        $_SESSION['mat']=1149;
        $_SESSION['tema']=520;
        $_SESSION['sub']=4559;
    }
    
    //Examen secundaria fraccciones diagnostico
    if($_GET['id']==6){
        $_SESSION['mat']=154;
        $_SESSION['tema']=204;
        $_SESSION['sub']=3576;
    }
    
    
    	if($_GET['id']==7){
        $_SESSION['mat']=1154;
        $_SESSION['tema']=558;
        $_SESSION['sub']=4562;
    	}
    	
    	
    	if($_GET['id']==8){
        $_SESSION['mat']=1150;
        $_SESSION['tema']=499;
        $_SESSION['sub']=4334;
    	}
    	
    		
    	if($_GET['id']==9){
        $_SESSION['mat']=1152;
        $_SESSION['tema']=560;
        $_SESSION['sub']=4570;
    	}
    	
    	 //Examen biologia
    	if($_GET['id']==10){
        $_SESSION['mat']=1164;
        $_SESSION['tema']=559;
        $_SESSION['sub']=4580;
    	}
    	
    	 //Examen trigonometria
    	if($_GET['id']==11){
        $_SESSION['mat']=1153;
        $_SESSION['tema']=505;
        $_SESSION['sub']=4581;
    	}
    	
    	//Examen trigonometria
    	if($_GET['id']==12){
        $_SESSION['mat']=1165;
        $_SESSION['tema']=564;
        $_SESSION['sub']=4583;
    	}
    	
    		//Examen filosofía y ética
    	if($_GET['id']==13){
        $_SESSION['mat']=1158;
        $_SESSION['tema']=565;
        $_SESSION['sub']=4585;
    	}


    		//Examen Gestion y Adm Publica
    	if($_GET['id']==14){
        $_SESSION['mat']=1194;
        $_SESSION['tema']=568;
        $_SESSION['sub']=4588;
    	}


    	//Examen Programación Entornos Virtuales
    	if($_GET['id']==15){
        $_SESSION['mat']=1196;
        $_SESSION['tema']=570;
        $_SESSION['sub']=4590;
    	}
    	
    	    	//Examen Programación Entornos Virtuales
    	if($_GET['id']==16){
        $_SESSION['mat']=1079;
        $_SESSION['tema']=583;
        $_SESSION['sub']=4612;
    	}
    	
    	if($_GET['id']==17){
        $_SESSION['mat']=1209;
        $_SESSION['tema']=586;
        $_SESSION['sub']=4617;
    }

*/
?>
