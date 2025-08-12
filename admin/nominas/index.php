<?php

include("modelo/conexion.php");
include("../funciones.php");
include("../../general/consultas/admin.php");

$adicional="<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link rel='stylesheet' href='css/estilos_index.css'>
    <script src='https://kit.fontawesome.com/4405b53c68.js' crossorigin='anonymous'></script>";
cabeza("Nóminas -Udimex",$adicional);

    $sql=busca_empleado();
    $empleados="";
    while ($usuarios = mysqli_fetch_assoc($sql)) { 
        $empleados=$empleados."
        <tr>
            <td>
                ".$usuarios['nombre']."
            </td>
            <td>
                <form method='POST' action='buscador.php'>
                    
                    <button class='btn btn-small btn-warning' type='submit' value='".$usuarios['id_usuario']."' name='id_empleado'>
                        <i class='fa-solid fa-pen-to-square'></i>
                    </button>

                </form>
            </td>
        </tr>";
    }   
?>




<body>
<?php
usuario("../../",1);
menu_i();
?>
    <h1 class="text-center p-3">Nóminas</h1>

    <div class="container col-6">
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th scope="col-6">Usuario</th>
                    <th scope="col-6">Buscar</th>
                </tr>
            </thead>
            <tbody>

                    <?php echo $empleados; ?>
            </tbody>
        </table>
    </div>

</body>

</html>
