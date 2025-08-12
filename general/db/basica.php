<?php
date_default_timezone_set('America/Mexico_City');
function abrir() { 
	//$base=mysqli_connect("localhost","u964553819_udimex","Sistemas_udimex24","u964553819_udimex") or die("No está lista la conexión 2024");
	$base=mysqli_connect("localhost","root","","udimex") or die("No está lista la conexión");
	return $base; 
} 

function bitacora($us,$ac){
	$fecha = date('Y-m-d H:i:s');
	$consulta="insert into bitacora values(NULL,?,?,?)";
	ejecuta($consulta,[$us,$ac,$fecha],0);
}


/* Completa las consultas*/
function completa($consulta,$retorno){
	$base=abrir();
	$r=mysqli_query($base,$consulta);
	if($retorno==1){
		$r=mysqli_insert_id($base);
	}
	mysqli_close($base);
	return $r;
}



// 26-07-2025 Se agrega la sonsulta segura ejecuta la cual pide la consulta, los argumentos y el tipo: 0 si regresa los datos, 1 si 
//regresa el último id insertado

function ejecuta($consulta, $parametros = [], $tipo) {
    //$base=mysqli_connect("localhost","u964553819_udimex","Sistemas_udimex24","u964553819_udimex") or die("No está lista la conexión 2024");
    $base = mysqli_connect('localhost', 'root', '', 'udimex') or die("Error al conectar la base de datos");
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
