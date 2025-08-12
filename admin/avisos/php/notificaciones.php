<?php
session_start();

$id=$_SESSION['ad_id'];

include('conexion.php');

$datos=busca_mensajes($id);

$response = '';

// Imprimir las notificaciones de admin, bot y alumno y les asigna un color derpendiendo de donde venga el mensaje .

while ($fila = mysqli_fetch_assoc ($datos)) {

    $estilo="";

    $datos2=busca_admin($fila['autor']);

    $fila2 = mysqli_fetch_assoc($datos2);


    if($fila['autor']){
        $estilo="bg-info";
    }
    if($fila2['r']>0){
        $estilo="bg-secondary";
    }
    if($fila['autor']==483){ 
        $estilo="bg-warning";
    }
    
    $id=$fila['id_destinatario'];
    
    $response .= "

    <form>
    <div class='notification-item $estilo'>
        <div class='notification-subject'>{$fila['id']}</div>
        <div class='notification-comment'>{$fila['ap_mat']}</div>
        <div class='notification-comment'>{$fila['ap_pat']}</div>
        <div class='notification-comment'>{$fila['nombre']}</div>
        <div class='notification-comment'>{$fila['correo']}</div>
        <div class='notification-comment'>{$fila['fecha']}</div>
        <div class='notification-comment'>{$fila['autor']}</div>
        <div class='notification-comment'>{$fila['mensaje']}</div>
       <input type='button' onclick= 'cambia($id)' value='visto'>
    </form>   

    </div>";}

echo $response;   
?>

<script>
    function cambia($id){
        $.ajax({
			url: 'php/actualiza_estado.php?id='+id,
			success: function (data) {	
			};
		});
    };
</script>
