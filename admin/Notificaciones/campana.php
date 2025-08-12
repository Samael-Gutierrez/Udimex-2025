<?php
$dir="../../general/";
include($dir."db/basica.php");

//para probar
include($dir."db/notificacion.php");
campana();
//termina prueba

function campana(){
        //$id=$_SESSION['ad_id'];
        $id=1;
        $datos=b_destinatario($id);
        $fila=mysqli_fetch_assoc($datos);
        $count=$fila['r'];
    echo "

 
    <link href='https://udimex.net/admin/Notificaciones/css/estilos.css' rel='stylesheet'>

    <nav class='navbar navbar-expand-md navbar-dark '>
      <div class='collapse navbar-collapse' id='navbarsExampleDefault'>

                      

          <div class='demo-content'>
            <div id='notification-header'>
              <div style='position:relative'>
                <button id='notification-icon' name='button' onclick='myFunction()' class='dropbtn'><span id='notification-count'>";
                
                if($count>0) { 
                    echo $count; 
                }
                echo "
                </span><img src='https://udimex.net/admin/Notificaciones/img/icono.png' /></button>
                <div id='notification-latest' style='display:none'></div>
              </div>          
            </div>
          </div>";


          if(isset($message)) {
            echo "<div class='error'>$message </div>";
          }
          if(isset($success)) {
            echo "<div class='success'>$success</div>";
          } 

echo "
      </div>
    </nav>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src='https://code.jquery.com/jquery-2.1.1.min.js' crossorigin='anonymous'></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src='js/ie10-viewport-bug-workaround.js'></script>

    <script type='text/javascript'>
      function myFunction() {
        $.ajax({
          url: 'notificacion_busca.php',
          type: 'POST',
          processData:false,
          success: function(data){
            $('#notification-count');                  
            $('#notification-latest').show();$('#notification-latest').html(data);
          },
          error: function(){}           
        });
      }
                                 
      $(document).ready(function() {
        $('body').click(function(e){
          if ( e.target.id != 'notification-icon'){
            $('#notification-latest').hide();
          }
        });
      });                                     
    </script>";
}
?>
