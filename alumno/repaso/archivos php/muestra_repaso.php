<?php
include("../funciones/funciones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/muestra_repaso.css">
    <title>Repaso</title>
</head>
<body>
    <h1>Repaso</h1><br>
    <div>
        <table>
            <?php
            session_start();
                $id_repaso=$_SESSION['id_repaso'];

                $sql=chat($id_repaso);
                while($datos=$sql->fetch_object()){
                $resulado=$datos->preguntas;
                $text=str_replace("|","<br><br>", $resulado);
                echo"
                <tr class='tabla'>
                    <td id='repaso'>.$text.</td>
                </tr>";
                mysqli_close(conexion());
                }
            ?>
        </table><br>
    </div><br>
</body>
</html>