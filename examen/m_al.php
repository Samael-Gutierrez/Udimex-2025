<?php
session_start();
//include("../general/consultas/pagos.php");
include("../general/consultas/basic.php");
include("../general/consultas/cuestionario.php");




$datos=b_alu_ev();

while($fila=mysqli_fetch_assoc($datos)){
    echo "<a href='revisa.php?id=".$fila['id_alumno']."'>".$fila['ap_pat']." ".$fila['ap_mat']." ".$fila['nombre']."</a><br>";
}
?>



	</body>
</html>
