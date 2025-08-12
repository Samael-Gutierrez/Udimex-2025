<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        $contactos = [
            [
                "ap_pat" =>     "BERNAL",
                "ap_mat" =>     "SOTO",
                "nombre" =>     "PAZ MARIA DEL ROSAL", 
                "telefono" =>   "3333199077",
                "curp" =>       "BESP710124MMNRTZ06",
                "fn" =>         "1971-01-24"
            ],
            [
                "ap_pat" =>     "SANCHEZ",
                "ap_mat" =>     "MARTINEZ",
                "nombre" =>     "ANA PATRICIA", 
                "telefono" =>   "3316982422",
                "curp" =>       "SAMA840310MJCNRN02",
                "fn" =>         "1984-03-10"
            ],
            [
                "ap_pat" =>     "VENEGAS",
                "ap_mat" =>     "PADILLA",
                "nombre" =>     "MARTHA", 
                "telefono" =>   "3315716504",
                "curp" =>       "VEPM850707MJCNDR01",
                "fn" =>         "1985-07-07"
            ],
            [
                "ap_pat" =>     "GALLO",
                "ap_mat" =>     "PEREZ",
                "nombre" =>     "BELEN DEL REFUGIO", 
                "telefono" =>   "3337237798",
                "curp" =>       "GAPB780412MJCLRL06",
                "fn" =>         "1978-04-12"
            ],[
                "ap_pat" =>     "PORTUGAL",
                "ap_mat" =>     "DURAN",
                "nombre" =>     "SILVIA", 
                "telefono" =>   "7421090163",
                "curp" =>       "PODS870228MJCRRL01",
                "fn" =>         "1987-02-28"
            ],
            [
                "ap_pat" =>     "AGUILAR",
                "ap_mat" =>     "CAZARES",
                "nombre" =>     "MARTHA LOURDES", 
                "telefono" =>   "3320291561",
                "curp" =>       "AUCM881015MJCGZR09",
                "fn" =>         "1988-10-15"
            ],[
                "ap_pat" =>     "PEREZ",
                "ap_mat" =>     "ALONSO",
                "nombre" =>     "MARISELA", 
                "telefono" =>   "3317416398",
                "curp" =>       "PEAM831122MJCRLR03",
                "fn" =>         "1983-11-22"
            ],
            [
                "ap_pat" =>     "VERDEJA",
                "ap_mat" =>     "ORTIZ",
                "nombre" =>     "JOSE DE JESUS", 
                "telefono" =>   "3331170128",
                "curp" =>       "VEOJ940318HJCRRS08",
                "fn" =>         "1994-03-18"
            ],[
                "ap_pat" =>     "VAZQUEZ",
                "ap_mat" =>     "ZAVALA",
                "nombre" =>     "DULCE ESMERALDA", 
                "telefono" =>   "3310060040",
                "curp" =>       "VAZD990129MJCZVL06",
                "fn" =>         "1999-01-29"
            ],
            [
                "ap_pat" =>     "MONTES DE OCA",
                "ap_mat" =>     "GUZMAN",
                "nombre" =>     "MARIA", 
                "telefono" =>   "3317452419",
                "curp" =>       "MOGJ780730MJCNZS02",
                "fn" =>         "1978-07-30"
            ],[
                "ap_pat" =>     "LEYVA",
                "ap_mat" =>     "ZARATE",
                "nombre" =>     "ANA PATRICIA", 
                "telefono" =>   "3332553382",
                "curp" =>       "LEZA990305MJCYRN00",
                "fn" =>         "1999-03-05"
            ],
            [
                "ap_pat" =>     "CARRILLO",
                "ap_mat" =>     "BAJINEZ",
                "nombre" =>     "VERONICA YANET", 
                "telefono" =>   "3322035169",
                "curp" =>       "CABV930303MJCRJR02",
                "fn" =>         "1993-03-03"
            ],[
                "ap_pat" =>     "PEREZ",
                "ap_mat" =>     "VALTIERRA",
                "nombre" =>     "LESLI CAROLINA", 
                "telefono" =>   "3329245519",
                "curp" =>       "PEVL901120MJCRLS06",
                "fn" =>         "1990-11-20"
            ],
            [
                "ap_pat" =>     "RAMIREZ",
                "ap_mat" =>     "OLAYO",
                "nombre" =>     "BRENDA JUDITH", 
                "telefono" =>   "3337865091",
                "curp" =>       "RAOB040330MJCMLRA7",
                "fn" =>         "2004-03-30"
            ],[
                "ap_pat" =>     "PEREZ",
                "ap_mat" =>     "VALTIERRA",
                "nombre" =>     "JOSE HUMBERTO", 
                "telefono" =>   "6692655867",
                "curp" =>       "PEVH930403HJCRLM00",
                "fn" =>         "1993-04-03"
            ],
            [
                "ap_pat" =>     "NAJERA",
                "ap_mat" =>     "TRINIDAD",
                "nombre" =>     "DANIELA ROXANA", 
                "telefono" =>   "3317553057",
                "curp" =>       "NATD941227MJCJRN09",
                "fn" =>         "1994-12-27"
            ],[
                "ap_pat" =>     "VELAZQUEZ",
                "ap_mat" =>     "ROBLES",
                "nombre" =>     "RICARDO DANIEL", 
                "telefono" =>   "3310143595",
                "curp" =>       "VERR910421HJCLBC00",
                "fn" =>         "1991-04-21"
            ],
        ];

        $ct = 751;
        $usuarios = "";
        $alumnos = "";
        $curps = "";
        $cel = "";
        $pagos = "";
        $claves = "";
        $grupo = 196;

        foreach ($contactos as  $contacto) {
            $nombre = $contacto["nombre"];
            $ap = $contacto["ap_pat"];
            $am = $contacto["ap_mat"];
            $fn = $contacto["fn"];
            $curp = $contacto["curp"];
            $tel = $contacto["telefono"];
            $fullName = $ap . " " . $am . " " . $nombre;

            $us1 = str_split($nombre, 2);
            $us2 = str_split($ap, 2);
            $us3 = str_split($am, 2);

            $usuario = $us1[0].$us2[0].$us3[0].$ct;
            $clave = "Udim$ct";

            $usuarios = $usuarios . "<br>" . "INSERT INTO 
                usuario VALUES($ct, '$usuario', '$clave', '$nombre', '$ap', '$am', '$fn', 'default.png', 'NA', 0, 1, 4);
            ";

            $alumnos = $alumnos . "<br>" . "INSERT INTO
                alumno(id_alumno, inscripcion ,colegiatura ,certificado ,estado ,f_ingreso ,f_pago, modalidad ,id_usuario ,id_grupo, id_carrera, id_promotor, id_comision)
                VALUES($ct, 1, 1, 7000, 1, '2025-07-10', '2026-01-31', 1, $ct, $grupo, 18, 0, 0);
            ";

            $curps = $curps . "<br>" . "INSERT INTO
             curp(id_alumno, curp)
             VALUES($ct, '$curp');
            ";

            $cel = $cel . "<br>" . "INSERT INTO
                telefono(numero, id_usuario, estado)
                VALUES('$tel', $ct, 1);
            ";

            $pagos = $pagos . "<br>" . "INSERT INTO
                    pago(cantidad, f_pago, f_caducidad, concepto, id_usuario)
                    VALUES(1,'2025-07-10', '2026-01-31', 'Colegiatura', $ct);
            ";

            $claves = $claves . "<br>" . "$tel - $fullName - $usuario - $clave";

            $ct ++;
        }

        echo "  
            <h2>Usuarios</h2><br>
            $usuarios
            <hr>
            <h2>Alumnos</h2><br>
            $alumnos
            <hr>
            <h2>Telefonos</h2><br>
            $cel
            <hr>
            <h2>Curp</h2><br>
            $curps
            <hr>
            <h2>Pagos</h2><br>
            $pagos
            <hr>
            <h2>claves</h2><br>
            $claves
            <hr>
        ";
    ?>
</body>
</html>