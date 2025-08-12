<script src='https://code.jquery.com/jquery-2.1.1.min.js' crossorigin='anonymous'></script>

<?php
session_start();
$dir="../../general/";
include($dir."db/basica.php");
include($dir."db/notificacion.php");

$id=$_SESSION['ad_id'];
$datos=b_mensaje($id);

$response = '';

// Imprimir las notificaciones de admin, bot y alumno y les asigna un color derpendiendo de donde venga el mensaje .

while ($fila = mysqli_fetch_assoc ($datos)) {

    $estilo="";

    $datos2=busca_admin($fila['autor']);

    $fila2 = mysqli_fetch_assoc($datos2);

    $link = "";


    if($fila['autor']){
        $estilo="bg-info";
    }
    if($fila2['r']>0){
        $estilo="bg-secondary";
    }
    if($fila['autor'] == 483){ 
        $estilo="bg-warning";
        $link = "
            <a href='../calificaciones/' class='link'>Ver calificaciones</a><br>
        ";
    }
    
    $id=$fila['id_destinatario'];

    $response .= "
        <div class='notification-item $estilo'>
            <div class='notification-comment'><font size='3'>{$fila['mensaje']}</font></div><br>
            <div class='notification-comment'>{$fila['nombre']}</div>
            $link
            <div class='notification-comment'>{$fila['fecha']}</div>
            <input type='button' onclick= 'cambia($id)' value='visto'>
        </div>
    ";
    
}

echo $response;   
?>

<script>
    function cambia(id){
        $.ajax({
            url: 'https://udimex.net/admin/Notificaciones/php/actualiza_estado.php',
            type: 'GET', // Puedes especificar el tipo de solicitud
            data: { id: id }, // Pasar los datos como un objeto
            success: function (data) {
            },
            error: function (xhr, status, error) {
                // Manejar errores
                console.error('Error en la solicitud AJAX:', status, error);
            }
        });
    }
</script>

<style>
    .bg-info{
        background-color:rgba(var(--bs-secondary-rgb), var(--bs-bg-opacity)) !important;
    }
    
    .bg-secondary{
        background-color:rgba(var(--bs-secondary-rgb), var(--bs-bg-opacity)) !important;
    }
    
    .bg-warning{
        background-color:rgba(var(--bs-secondary-rgb), var(--bs-bg-opacity)) !important;
    }

    .link {
        color: black;
        cursor: pointer;
        font-size: 12px;
    }
</style>
