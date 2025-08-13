<?php
//SELECCIONAR USUARIO
function busca_empleado(){
    $consulta = "SELECT DISTINCT(a.id_usuario), u.* FROM acceso as a, usuario as u WHERE a.id_usuario = u.id_usuario;";
    return ejecuta($consulta, [], 0);
}

function busca_id_empleado($id){
    $consulta = "SELECT * FROM usuario AS u, area AS a WHERE u.id_area=a.id_area AND u.id_usuario = ?;";
    return ejecuta($consulta, [$id], 0);
}

function busca_nomina($usuario, $periodo, $anio){
    $consulta = "SELECT COUNT(id_nominas) AS total FROM nominas WHERE id_usuario = ? AND periodo = ? AND anio = ?;";
    return ejecuta($consulta, [$usuario, $periodo, $anio], 0);
}

function crear_nomina($usuario, $periodo, $anio){
    $consulta = "INSERT INTO nominas VALUES(NULL, ?, ?, ?, ?)";
    ejecuta($consulta, [$usuario, $periodo, $anio, 0], 0);
}

function cambia_estado($usuario, $periodo, $anio){
    $consulta = "UPDATE nominas SET estado = 1 WHERE id_usuario = ? AND periodo = ? AND anio = ?;";
    return ejecuta($consulta, [$usuario, $periodo, $anio], 0);
}

function estado_nomina($usuario, $periodo, $anio){
    $consulta = "SELECT COUNT(id_nominas) AS todas FROM nominas WHERE id_usuario = ? AND periodo = ? AND anio = ? AND estado = 1;";
    return ejecuta($consulta, [$usuario, $periodo, $anio], 0);
}

//PERCEPCIONES
function buscar_percepcion(){
    $consulta = "SELECT * FROM percepcion;";
    return ejecuta($consulta, [], 0);
}
//buscar concepto
function buscar_percepcion2($concepto){
    $consulta = "SELECT * FROM percepcion WHERE concepto = ?;";
    return ejecuta($consulta, [$concepto], 0);
}
//Obtener los datos  y registrar en la tabla 
function busca_percepcion_usuario($id, $idp){
    $consulta = "SELECT horas, periodo, concepto, cantidad, id_percepcion_us
                FROM percepcion_usuario AS pu, percepcion AS p
                WHERE pu.id_percepcion = p.id_percepcion
                AND pu.id_usuario = ?
                AND pu.periodo = ?;";
    return ejecuta($consulta, [$id, $idp], 0);
}
//eliminar percepcion
function elimina_percepcion($id){
    $consulta = "DELETE FROM percepcion_usuario WHERE id_percepcion_us = ?;";
    ejecuta($consulta, [$id], 0);
}
function guarda_percepcion($concepto){
    $consulta = "INSERT INTO percepcion VALUES(NULL, ?);";
    return ejecuta($consulta, [$concepto], 1);
}
function guarda_percepcion_usuario($id_us, $concepto, $horas, $idp, $cantidad){
    $consulta = "INSERT INTO percepcion_usuario VALUES(NULL, ?, ?, ?, ?, ?);";
    return ejecuta($consulta, [$id_us, $concepto, $horas, $idp, $cantidad], 0);
}

//AGREGAR A LA BD EGRESO
function guarda_egreso($concepto, $cantidad, $fecha, $estado){
    $consulta = "INSERT INTO conta_egreso  VALUES(NULL, ?, ?, ?, ?);";
    ejecuta($consulta, [$concepto, $cantidad, $fecha, $estado], 0);
}

//DEDUCCION
function buscar_deduccion(){
    $consulta = "SELECT * FROM deduccion;";
    return ejecuta($consulta, [], 0);
}

//Buscar concepto
function buscar_deduccion2($concepto){
    $consulta = "SELECT * FROM deduccion WHERE concepto = ?;";
    return ejecuta($consulta, [$concepto], 0);
}

//Obtener los datos y registrar  en la tabla
function busca_deduccion_usuario($id, $idp){
    $consulta = "SELECT id_deduccion_us,concepto,cantidad
                FROM deduccion_usuario AS du, deduccion AS d
                WHERE du.id_deduccion = d.id_deduccion
                AND du.id_usuario = ?
                AND du.periodo = ?;";
    return ejecuta($consulta, [$id, $idp], 0);
}

//Elimina deduccion
function elimina_deduccion($id){
    $consulta = "DELETE FROM deduccion_usuario WHERE id_deduccion_us = ?;";
    ejecuta($consulta, [$id], 0);
}

function guarda_deduccion($concepto){
    $consulta = "INSERT INTO deduccion (concepto) VALUES(?);";
    return ejecuta($consulta, [$concepto], 1);
}

function guarda_deduccion_usuario($id_us, $concepto, $idp, $cantidad){
    $consulta = "INSERT INTO deduccion_usuario VALUES(NULL, ?, ?, ?, ?);";
    return ejecuta($consulta, [$id_us, $idp, $concepto, $cantidad], 0);
}
