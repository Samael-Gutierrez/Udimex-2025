<?php
session_start();
include("php/conexion.php");
include('../../general/consultas/usuario.php');
include("../funciones.php");
//usuario("../../",'index.php');
//menu_i();
//include('../../general/consultas/basic.php');

$usuarios='';
$datos=b_ad();
while($fila=mysqli_fetch_assoc($datos)){
    $usuarios=$usuarios."<input type='checkbox'  value=".$fila['id_usuario']." name='destinatario[]'><label> ".$fila['nombre']." </label> &nbsp; &nbsp;";

}

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">

    <title>Sistema de Notificaciones </title>

    <!-- Bootstrap core CSS -->
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">

    <link href="css/estilos.css" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">Mi Proyecto</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->
          </li>          
          <li class="nav-item dropdown">
            <!-- <a class="nav-link dropdown-toggle" href="http://collectivecloudperu.com/blogdevs/" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nosotros</a> -->
            <!-- <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Misión</a>
              <a class="dropdown-item" href="#">Prensa</a>
              <a class="dropdown-item" href="#">Visión</a>              
            </div> -->
          </li>
          
        </ul>

        <?php
            $datos=cuenta_mensajes($_SESSION['ad_id']);
            $fila=mysqli_fetch_assoc($datos);
            $count=$fila['r'];
        ?>                        

          <div class="demo-content">
            <div id="notification-header">
              <div style="position:relative">
                <button id="notification-icon" name="button" onclick="myFunction()" class="dropbtn"><span id="notification-count"><?php if($count>0) { echo $count; } ?></span><img src="img/icono.png" /></button>
                <div id="notification-latest"></div>
              </div>          
            </div>
          </div>


          <?php if(isset($message)) { ?> <div class="error"><?php echo $message; ?></div> <?php } ?>
          <?php if(isset($success)) { ?> <div class="success"><?php echo $success;?></div> <?php } ?>

      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
          <h1>Sistema de Notificaciones UDIMEX </h1>

          <p class="lead">

          <form name="frmNotification" id="frmNotification" action="php/agregarnotificacion.php" method="POST" >
                <div class="form-group">
                    <input type="hidden" class="form-control" name="autor" id="autor" placeholder="Ingresa Autor" required value="<?php echo $_SESSION['ad_nom']; ?>"> 
                </div> 
                <div class="form-group">
                  <label for="mensaje">Mensaje </label>
                  <textarea class="form-control" name="mensaje" id="mensaje" rows="5" placeholder="Mensaje" required></textarea>
                </div>
                <div class="form-group">
                  <input type="submit" name="add" id="btn-send" value="Enviar">
                </div>

                <div class="checador">
                    
                    <?php echo $usuarios; ?>
  
               
                </div>
                
              </form>             

          </p>

        </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" crossorigin="anonymous"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

    <script type="text/javascript">
      function myFunction() {
        $.ajax({
          url: "php/notificaciones.php",
          type: "POST",
          processData:false,
          success: function(data){
            $("#notification-count");                  
            $("#notification-latest").show();$("#notification-latest").html(data);
          },
          error: function(){}           
        });
      }
                                 
      $(document).ready(function() {
        $('body').click(function(e){
          if ( e.target.id != 'notification-icon'){
            $("#notification-latest").hide();
          }
        });
      });                                     
    </script>

  </body>
</html>
