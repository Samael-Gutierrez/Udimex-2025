<?php
include ('basic.php');
include ('cuestionario.php');

if ($_GET){
    $tema=$_GET['tema'];
    $datos=cues($tema,'order by rand()');
    $texto='let questions = [';
    $i=1;
    while ($fila=mysqli_fetch_assoc($datos)){
        $pregunta=$fila['pregunta'];
        $id=$fila['id_pregunta'];
        $respuestas='';
        $correcta='';
        $datos2=res($id,'order by rand()');
        while ($fila2=mysqli_fetch_assoc($datos2)){
            $respuestas=$respuestas.'"'.$fila2['respuesta'].'",';
            if ($fila2['tipo']==1){
                $correcta=$fila2['respuesta'];
            }
        }
            $texto=$texto.'
                {
                numb: '.$i.',
                question: "'.$pregunta.'",
                answer: "'.$correcta.'",
                options: [
            '.$respuestas.'
                ]
            },';
        $i=$i+1;
    }
    $texto=$texto."]";

        
            $archivo=fopen("questions.js", 'w+');
            fwrite($archivo, $texto) or die("No se pudo escribir en el archivo");
            fclose($archivo);
}
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen en Línea | UDIMEX</title>
    <link rel="stylesheet" href="style.css">
    <!-- FontAweome CDN Link for Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="./logo.png">
</head>
<body><div class="cuerpo">
    <!-- start Quiz button -->
    <div class="start_btn"><button> Iniciar Examen</button></div>

    <!-- Info Box -->
    <div class="info_box">
        <div class="info-title"><span>Reglas de tu Examen en Línea</span></div>
        <div class="info-list">
            <div class="info">1. Una vez que seleccionas tu respuesta, no se puede deshacer.</div>
            <div class="info">2. No puedes salir del examen,una vez empesado.</div>
            <div class="info">3. Obtendrás puntos con base en tus respuestas correctas.</div>
        </div>
        <div class="buttons">
            <button class="quit">Salir</button>
            <button class="restart">Continuar</button>
               

        </div>
    </div>

    <!-- Quiz Box -->
    <div class="quiz_box">
        <header>
            <div class="title">Examen en línea</div>
           <!-- <div class="timer">
                <div class="time_left_txt">Tiempo Restante</div>
                <div class="timer_sec">15</div>
            </div>-->
            <div class="time_line"></div>
        </header>
        <section>
            <div class="que_text">
                <!-- Here I've inserted question from JavaScript -->
            </div>
            <div class="option_list">
                <!-- Here I've inserted options from JavaScript -->
            </div>
        </section>

        <!-- footer of Quiz Box -->
        <footer>
            <div class="total_que">
                <!-- Here I've inserted Question Count Number from JavaScript -->
            </div>
            <button class="next_btn">Siguiente Pregunta</button>
        </footer>
    </div>

    <!-- Result Box -->
    <div class="result_box">
        <div class="icon">
            <i class="fas fa-crown"></i>
        </div>
        <div class="complete_text">Has finalizado tu examen!</div>
        <div class="score_text">
            <!-- Here I've inserted Score Result from JavaScript -->
        </div>
        <div class="buttons">
            
            
            <button class="quit">Salir</button>

        </div>
    </div>

    </div>

    <!-- Inside this JavaScript file I've inserted Questions and Options only -->
    <script src="questions.js"></script>

    <!-- Inside this JavaScript file I've coded all Quiz Codes -->
    <script src="js/script.js"></script>
   
        

</body>
</html>