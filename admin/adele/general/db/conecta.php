<?php

function ejecuta($consulta, $parametros = [], $tipo) {
    $base = mysqli_connect('localhost', 'root', '', 'utzin') or die("Error al conectar la base de datos");
    $stmt = mysqli_prepare($base, $consulta);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . mysqli_error($base));
    }

    if (!empty($parametros)) {
        $tipos = '';
		foreach ($parametros as $param) {
			if (is_int($param)) {
				$tipos .= 'i';
			} elseif (is_float($param)) {
				$tipos .= 'd';
			} elseif (is_string($param)) {
				$tipos .= 's';
			} else {
				throw new Exception("Tipo de dato no soportado");
			}
		}
        mysqli_stmt_bind_param($stmt, $tipos, ...$parametros);
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
	
	if($tipo==1){
		$result = mysqli_insert_id($base);
	}
	
    mysqli_close($base);

    return $result;
}

?>