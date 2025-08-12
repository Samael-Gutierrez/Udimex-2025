<?php
//include("../../general/consultas/conecta.php");
    $consulta = abrir();
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $regpagina = 3;
    $inicio=($pagina>1) ? (($pagina * $regpagina) - $regpagina):0;
    $estado = 0;
    $consulta_registros = $consulta->prepare("SELECT SQL_CALC_FOUND_ROWS nombre, contenido, id_publicidad FROM publicidad_publicidades WHERE estado = ? LIMIT $inicio,$regpagina");
    $consulta_registros->bind_param("i", $estado);
    $consulta_registros->execute();
    $resultado = $consulta_registros->get_result();
    // Obtener reg
    $registros = $resultado->fetch_all(MYSQLI_ASSOC);
    // Calcular total reg
    $totalregistros = $consulta->query("SELECT FOUND_ROWS() as total")->fetch_assoc()['total'];
    // Calcula num pag
    $numeropaginas = ceil($totalregistros / $regpagina);
    $resultado->free();
    $consulta_registros->close();
    $consulta->close();
?>