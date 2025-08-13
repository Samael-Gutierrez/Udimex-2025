<?php
session_start();

$dir = "../../general/";
include($dir."db/basica.php");
include($dir."db/nominas.php");
include($dir."db/admin.php");
include($dir."php/admin.php");

$_SESSION['control']=1;

$adicional="
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='css/nominas.css'>
    <script src='https://kit.fontawesome.com/4405b53c68.js' crossorigin='anonymous'></script>
    <link rel='stylesheet' href='css/style.css'>
";
    
cabeza("Nóminas - Udimex", $adicional, "");

$id=$_SESSION["id_us"];

if($_POST){
    $idp = $_POST["periodo"];
    $_SESSION["idp"]=$idp;
}else{ 
    $idp=$_SESSION["idp"];
}

$anio = date("Y");
$verificar = busca_nomina($id, $idp, $anio);
while($ver = mysqli_fetch_assoc($verificar)){
    $total = $ver['total'];
}

if($total == 0){
    crear_nomina($id, $idp, $anio);
}

//SELECCIONA USUARIO
$sql = busca_id_empleado($id);
if($fila=mysqli_fetch_assoc($sql)){
    $usuario="<h1 class='text-center p-3'>Nominas de ".$fila['nombre']."</h1>";  
}
//PERCEPCIONES
//lista de conceptos de percepciones
$percepcion="<datalist id='percepcion'>";
$sql = buscar_percepcion();
while($fila=mysqli_fetch_assoc($sql)){
    $percepcion=$percepcion."<option value='".$fila['concepto']."'></option>";
}
$percepcion=$percepcion."</datalist>";

//Obtiene percepciones del empleado
$datos="";
$totalp=0;
$sql = busca_percepcion_usuario($id,$idp);
while($fila=mysqli_fetch_assoc($sql)){
    $datos=$datos."
        <tr>
            <td>".$fila['concepto']."</td><td>".$fila['horas']."</td>
            <td>".$fila['cantidad']."</td>
            <td><a href='elimina_percepcion.php?id=".$fila['id_percepcion_us']."' class='btn btn-small btn-danger' onclick='return confirmarEliminacion()'><i class='fa-solid fa-trash'></i></a></td>
        </tr>";

    //TOTAL PERCEPCION
    $totalp=$totalp+$fila["cantidad"];
}

//DEDUCCIONES
//lista de conceptos de deducciones
$deduccion="<datalist id='deduccion'>";
$sql = buscar_deduccion();
while($fila=mysqli_fetch_assoc($sql)){
    $deduccion=$deduccion."<option value='".$fila['concepto']."'></option>";
}

$deduccion=$deduccion."</datalist>";

//Obtener deducciones del empleado
$registro="";
$totald=0;
$sql = busca_deduccion_usuario($id,$idp);
while($fila=mysqli_fetch_assoc($sql)){
    $registro=$registro."
        <tr>
            <td>".$fila['concepto']."</td><td>".$fila['cantidad']."</td>
            <td><a href='elimina_deduccion.php?id=".$fila['id_deduccion_us']."' class='btn btn-small btn-danger' onclick='return confirmarEliminacion()'><i class='fa-solid fa-trash'></i></a></td>
        </tr>
    ";
    //TOTAL DEDUCCION
    $totald=$totald+$fila["cantidad"];
}
?>
<body>
    
<?php
usuario("../../",1);
menu_i();
?>
<nav>
    <a href="index.php">Nóminas</a>
    <a href="buscador.php">Buscador</a>
</nav>

<?php 
    echo $usuario; 
    echo "<h2 class='text-center p-3'>Periodo: $idp</h2>";
?>
<br>

 <!-- Tabla de Percepciones y Deducciones-->
<div class="container">
  <div class="row">
    <!-- -----------------------------Inicio de percepciones----------------------------- -->

    <!-- PERCEPCIONES-->
     <div class="col-6">
        <form class="p-3 mx-auto" method="POST" action="guarda_percepcion.php" onsubmit="return validarFormularioPercepcion()">
            <h3 class="text-center" style="color: black;">Percepciones</h3>
            <input type="hidden" name="usuario" value="<?= $id ?>">
            <input type="hidden" name="periodo" value="<?= $idp ?>">

            <!-- Listado de conceptos -->
            <div class="mb-3">
                <label for="concepto" class="form-label">Concepto</label>
                <input list="percepcion" name="concepto" id="concepto" class="col-12" autocomplete="off">
                    <?php echo $percepcion; ?>
            </div>

            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="col-12" name="cantidad" id="cantidad">
            </div>
            <!-- input de horas -->
            <div class="mb-3">
                <label for="horas" class="form-label">Horas</label>
                <input type="number" class="col-12" name="horas" id="horas">
            </div>

            <!-- Boton de enviar -->
            <button type="submit" class="btn btn-primary" name="btnregistrarp" value="ok"
             style="background-color: #0e3b83; color: white; border: none;">Añadir
        </button>

            <!-- Tabla de percepciones -->
            <h3 class="text-center p-3">Percepciones registradas</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Concepto</th>
                        <th scope="col">Horas</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $datos; ?>
                    <!-- Total de Percepciones-->
                    <tr class="text-center">
                        <td class="fw-bold">Total</td>
                        <td colspan="3" class="text-success">$<?= $totalp ?>.00</td>
                    </tr>
                </tbody>
            </table>
         </form>
     </div>

    <!-- --------------------------------Inicio de deducciones-------------------------------------- -->
    
    <!-- DEDUCCIONES-->
     <div class="col-6"> 
        <form class="p-3 mx-auto" method="POST" action="guarda_deduccion.php" onsubmit="return validarFormularioDeduccion()">
            <h3 class="text-center" style="color: black;">Deducciones</h3>
            <input type="hidden" name="usuario" value="<?= $id ?>">
            <input type="hidden" name="periodo" value="<?= $idp ?>">

            <!-- Listado de conceptos -->
            <div class="mb-3">
                <label for="concepto_deduccion" class="form-label">Concepto</label>
                <input list="deduccion" name="concepto" id="concepto_deduccion" class="col-12"> <?php echo $deduccion; ?>
            </div>

            <div class="mb-3">
                <label for="cantidad_deduccion" class="form-label">Cantidad</label>
                <input type="number" class="col-12" name="cantidad" id="cantidad_deduccion">
            </div>

            <!-- Boton de enviar -->
            <button type="submit" class="btn btn-primary" name="btnregistrard" value="ok"
             style="background-color: #0e3b83; color: white; border: none;">Añadir
            </button>

            <!-- Tabla de deducciones -->
            <h3 class="text-center p-3">Deducciones registradas</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Concepto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $registro; ?>
                   <!-- Total de Deducciones-->
                    <tr class="text-center">
                        <td class="fw-bold">Total</td>
                        <td colspan="2" class="text-danger">-$<?= $totald ?>.00</td>
                    </tr>
                </tbody>
            </table>
         </form>
     </div>
  </div>
</div><br>
<div class="text-center">
    <h3>Total de Ingresos y Egresos</h3>
    <?php
    $resultado = $totalp - $totald;
    if ($resultado >= 0) {
        echo "<h2 class='text-center text-success'>$ $resultado .00</h2>";
    } else {
        echo "<h2 class='text-center text-danger'>$ $resultado .00</h2>";
    }
    ?>
    <br> 
    <!-- Boton para Imprimir PDF-->
    <form action="fpdf/pdf.php" method="post" target="_blank">
        <button type="submit" style="background-color: #0e3b83; color: white; border: none; padding: 10px 20px; border-radius: 5px; font-size: 16px;">
            <i class="fas fa-file-alt"></i> Imprimir PDF
        </button>
    </form><br>
</div>
<script>
    // Confirmar eliminación
    function confirmarEliminacion() {
        return confirm("¿Estás seguro de que deseas eliminar este registro?");
    }

    // Validar campos vacíos y mostrar mensajes de error
    function validarFormularioPercepcion() {
        var concepto = document.getElementById('concepto').value;
        var cantidad = document.getElementById('cantidad').value;
        var horas = document.getElementById('horas').value;
        var mensajeError = "";

        if (concepto == "") {
            mensajeError += "El campo de concepto es obligatorio.\n";
            document.getElementById('concepto').style.borderColor = "red";
        } else {
            document.getElementById('concepto').style.borderColor = "";
        }

        if (cantidad == "") {
            mensajeError += "El campo de cantidad es obligatorio.\n";
            document.getElementById('cantidad').style.borderColor = "red";
        } else {
            document.getElementById('cantidad').style.borderColor = "";
        }

        if (horas == "") {
            mensajeError += "El campo de horas es obligatorio.\n";
            document.getElementById('horas').style.borderColor = "red";
        } else {
            document.getElementById('horas').style.borderColor = "";
        }

        if (mensajeError != "") {
            alert(mensajeError);
            return false;
        }
        alert("Se agregaron los datos correctamente.");
        return true;
    }

    function validarFormularioDeduccion() {
        var concepto = document.getElementById('concepto_deduccion').value;
        var cantidad = document.getElementById('cantidad_deduccion').value;
        var mensajeError = "";

        if (concepto == "") {
            mensajeError += "El campo de concepto es obligatorio.\n";
            document.getElementById('concepto_deduccion').style.borderColor = "red";
        } else {
            document.getElementById('concepto_deduccion').style.borderColor = "";
        }

        if (cantidad == "") {
            mensajeError += "El campo de cantidad es obligatorio.\n";
            document.getElementById('cantidad_deduccion').style.borderColor = "red";
        } else {
            document.getElementById('cantidad_deduccion').style.borderColor = "";
        }

        if (mensajeError != "") {
            alert(mensajeError);
            return false;
        }
        alert("Se agregaron los datos correctamente.");
        return true;
    }
</script>
</body>
</html>
