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
                "ap_pat" =>     "MENDOZA",
                "ap_mat" =>     "MONTOYA",
                "nombre" =>     "ABEL", 
                "telefono" =>   "3322323563",
                "curp" =>       "MEMA701209HJCNNB00",
                "fn" =>         "1970-12-09"
            ],
            [
                "ap_pat" =>     "ORTIZ",
                "ap_mat" =>     "REYES",
                "nombre" =>     "AMALIA", 
                "telefono" =>   "4741424423",
                "curp" =>       "OIRA841229MJCRYM00",
                "fn" =>         "1984-12-29"
            ],
            [
                "ap_pat" =>     "TAVAREZ",
                "ap_mat" =>     "VEGA",
                "nombre" =>     "LEONARDO", 
                "telefono" =>   "4741095315",
                "curp" =>       "TAVL810108HJCVGN01",
                "fn" =>         "1981-01-08"
            ],
            [
                "ap_pat" =>     "TABARES",
                "ap_mat" =>     "GARCIA",
                "nombre" =>     "JOSE DE JESUS", 
                "telefono" =>   "4741098855",
                "curp" =>       "TAGJ841127HJCBRS04",
                "fn" =>         "1984-11-27"
            ],
            [
                "ap_pat" =>     "TABARES",
                "ap_mat" =>     "GARCIA",
                "nombre" =>     "JOSE GUADALUPE", 
                "telefono" =>   "4741065017",
                "curp" =>       "TAGG790204HJCBRD04",
                "fn" =>         "1979-02-04"
            ],

            [
                "ap_pat" =>     "ROMO",
                "ap_mat" =>     "LUCIO",
                "nombre" =>     "FERNANDO", 
                "telefono" =>   "4741491774",
                "curp" =>       "ROLF831004HJCMCR08",
                "fn" =>         "1983-10-04"
            ],
            [
                "ap_pat" =>     "LOPEZ",
                "ap_mat" =>     "ARAGON",
                "nombre" =>     "CECILIA ESPERANZA", 
                "telefono" =>   "4741596740",
                "curp" =>       "LOAC841102MJCPRC03",
                "fn" =>         "1984-11-02"
            ],
            [
                "ap_pat" =>     "RAMIREZ",
                "ap_mat" =>     "ESPINOZA",
                "nombre" =>     "MAYRA ISABEL", 
                "telefono" =>   "4741310657",
                "curp" =>       "RAEM891117MJCMSY05",
                "fn" =>         "1989-11-17"
            ],
            [
                "ap_pat" =>     "AGUILA",
                "ap_mat" =>     "MASCORRO",
                "nombre" =>     "JOSE MAURICIO", 
                "telefono" =>   "4741011725",
                "curp" =>       "AUMM891021HJCGSR00",
                "fn" =>         "1989-10-21"
            ],
            [
                "ap_pat" =>     "VEGA",
                "ap_mat" =>     "DE SANTIAGO",
                "nombre" =>     "ISMAEL", 
                "telefono" =>   "4741139398",
                "curp" =>       "VESI920113HJCGNS02",
                "fn" =>         "1992-01-13"
            ],
            [
                "ap_pat" =>     "MUÑOZ",
                "ap_mat" =>     "REYES",
                "nombre" =>     "BEATRIZ ALEJANDRA", 
                "telefono" =>   "4741052576",
                "curp" =>       "MURB930818MJCXYT08",
                "fn" =>         "1993-08-18"
            ],
            [
                "ap_pat" =>     "MEJIA",
                "ap_mat" =>     "PEREZ",
                "nombre" =>     "JESUS ALBERTO", 
                "telefono" =>   "4741901403",
                "curp" =>       "MEPJ900330HJCJRS01",
                "fn" =>         "1990-03-30"
            ],
            [
                "ap_pat" =>     "ZAPATA",
                "ap_mat" =>     "ESPINOZA",
                "nombre" =>     "JUAN CRISTOBAL", 
                "telefono" =>   "4741492997",
                "curp" =>       "ZAEJ930722HJCPSN07",
                "fn" =>         "1993-07-22"
            ],
            [
                "ap_pat" =>     "ROSALES",
                "ap_mat" =>     "VALADEZ",
                "nombre" =>     "DANIELA", 
                "telefono" =>   "4741401136",
                "curp" =>       "ROVD970910MJCSLN09",
                "fn" =>         "1997-09-10"
            ],
            [
                "ap_pat" =>     "LUNA",
                "ap_mat" =>     "REYES",
                "nombre" =>     "JOSE MARIA", 
                "telefono" =>   "4741492834",
                "curp" =>       "LURM940129HJCNYR07",
                "fn" =>         "1994-01-29"
            ],
            [
                "ap_pat" =>     "CELEDON",
                "ap_mat" =>     "DIAZ",
                "nombre" =>     "GABRIEL", 
                "telefono" =>   "4741765262",
                "curp" =>       "CEDG900227HJCLZB04",
                "fn" =>         "1990-02-27"
            ],
            [
                "ap_pat" =>     "GOMEZ",
                "ap_mat" =>     "MORENO",
                "nombre" =>     "JUAN DE DIOS", 
                "telefono" =>   "4741273919",
                "curp" =>       "GOMJ010623HJCMRNA2",
                "fn" =>         "2001-06-23"
            ],
            [
                "ap_pat" =>     "SANTOYO",
                "ap_mat" =>     "DIAZ",
                "nombre" =>     "DENISSE PATRICIA", 
                "telefono" =>   "4741528399",
                "curp" =>       "SADD940317MJCNZN02",
                "fn" =>         "1994-03-17"
            ],
            [
                "ap_pat" =>     "SUAREZ",
                "ap_mat" =>     "IBARRA",
                "nombre" =>     "CLAUDIA ISELA", 
                "telefono" =>   "4741068616",
                "curp" =>       "SUIC810412MJCRBL08",
                "fn" =>         "1981-04-12"
            ],
            [
                "ap_pat" =>     "GUTIERREZ",
                "ap_mat" =>     "ORNELAS",
                "nombre" =>     "JOSE MANUEL", 
                "telefono" =>   "4742085565",
                "curp" =>       "GUOM980622HJCTRN09",
                "fn" =>         "1998-06-22"
            ],
            [
                "ap_pat" =>     "TORRES",
                "ap_mat" =>     "MENA",
                "nombre" =>     "BRENDA PATRICIA", 
                "telefono" =>   "4745697561",
                "curp" =>       "TOMB000812MJCRNRA5",
                "fn" =>         "2000-08-12"
            ],
            [
                "ap_pat" =>     "RAMIREZ",
                "ap_mat" =>     "HERNANDEZ",
                "nombre" =>     "MARIA FERNANDA", 
                "telefono" =>   "4741086177",
                "curp" =>       "RAHF920723MJCMRR06",
                "fn" =>         "1992-07-23"
            ],
            [
                "ap_pat" =>     "HERNANDEZ",
                "ap_mat" =>     "LOPEZ",
                "nombre" =>     "PEDRO", 
                "telefono" =>   "4747471258",
                "curp" =>       "HELP880629HJCRPD03",
                "fn" =>         "1988-06-29"
            ],
            [
                "ap_pat" =>     "MUÑOZ",
                "ap_mat" =>     "MARTINEZ",
                "nombre" =>     "EFREN", 
                "telefono" =>   "4741283835",
                "curp" =>       "MUME960919HJCXRF03",
                "fn" =>         "1996-09-19"
            ],
            [
                "ap_pat" =>     "MONTES",
                "ap_mat" =>     "ESPINOSA",
                "nombre" =>     "MARIA JOSE", 
                "telefono" =>   "4741128238",
                "curp" =>       "MOEJ021203MJCNSSA4",
                "fn" =>         "2002-12-03"
            ],
            [
                "ap_pat" =>     "PEREZ",
                "ap_mat" =>     "RIOS",
                "nombre" =>     "JUAN ANTONIO", 
                "telefono" =>   "4742718652",
                "curp" =>       "PERJ001227HJCRSNA8",
                "fn" =>         "2000-12-27"
            ],
            [
                "ap_pat" =>     "ALMAGUER",
                "ap_mat" =>     "LOPEZ",
                "nombre" =>     "FELIX", 
                "telefono" =>   "4747385202",
                "curp" =>       "AALF880301HJCLPL08",
                "fn" =>         "1988-03-01"
            ],
            [
                "ap_pat" =>     "CRUZ",
                "ap_mat" =>     "FLORES",
                "nombre" =>     "HECTOR GUSTAVO", 
                "telefono" =>   "4741341690",
                "curp" =>       "CUFH950318HJCRLC05",
                "fn" =>         "1995-03-18"
            ],
            [
                "ap_pat" =>     "AYAS",
                "ap_mat" =>     "RAMIREZ",
                "nombre" =>     "NUVIA JANETH", 
                "telefono" =>   "4747472818",
                "curp" =>       "AARN001003MCMYMVA7",
                "fn" =>         "2000-10-03"
            ],
            [
                "ap_pat" =>     "LOPEZ",
                "ap_mat" =>     "GARCIA",
                "nombre" =>     "JOSE AARON", 
                "telefono" =>   "4741760329",
                "curp" =>       "LOGA871027HJCPRR06",
                "fn" =>         "1987-10-27"
            ],
            [
                "ap_pat" =>     "RAMIREZ",
                "ap_mat" =>     "BARBOSA",
                "nombre" =>     "MAYRA GUADALUPE", 
                "telefono" =>   "4741597521",
                "curp" =>       "RABM891221MJCMRY00",
                "fn" =>         "1989-12-21"
            ],
            [
                "ap_pat" =>     "HERNANDEZ",
                "ap_mat" =>     "PEDROZA",
                "nombre" =>     "OSWALDO DE JESUS", 
                "telefono" =>   "4741411241",
                "curp" =>       "HEPO050604HJCRDSA8",
                "fn" =>         "2005-06-04"
            ],
            [
                "ap_pat" =>     "HERNANDEZ",
                "ap_mat" =>     "JUAREZ",
                "nombre" =>     "MAYRA ARELY", 
                "telefono" =>   "4741122655",
                "curp" =>       "HEJM880727MJCRRY08",
                "fn" =>         "1988-07-27"
            ]
        ];

        $ct = 715;
        $usuarios = "";
        $alumnos = "";
        $curps = "";
        $cel = "";
        $pagos = "";
        $claves = "";

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
                VALUES($ct, 1, 1, 7000, 1, '2025-06-13', '2025-12-31', 1, $ct, 195, 18, 0, 0);
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
                    VALUES(1,'2025-06-13', '2025-12-31', 'Colegiatura', $ct);
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