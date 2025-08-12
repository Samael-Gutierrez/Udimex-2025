<?php
session_start();

require('./fpdf.php');

// Incluir el archivo de conexión y funciones
include '../modelo/conexion.php';
include '../phpqrcode/qrlib.php';

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo y título
        $this->Image('logo.png', 75, 5, 65); //moverDerecha,moverAbajo,tamañoIMG
        $this->SetFont('Arial', 'B', 19);
        $this->SetTextColor(0, 0, 0);
        $this->Ln(15);

        // Dirección y contacto
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(10);
        $this->Cell(96, 10, utf8_decode("AV. 16 DE SEPTIEMBRE,303,Col.SAN MIGUEL, "), 0, 0, '', 0);
        $this->Ln(5);
        $this->Cell(10);
        $this->Cell(96, 10, utf8_decode("SAN MIGUEL ZINACANTEPEC,ESTADO DE MÉXICO, "), 0, 0, '', 0);
        $this->Ln(5);
        $this->Cell(10);
        $this->Cell(96, 10, utf8_decode("MÉXICO,CP. 51354 "), 0, 0, '', 0);
        $this->Ln(5);
        $this->Cell(10);
        $this->Cell(96, 10, utf8_decode( "Teléfono: 7202874706 "), 0, 0, '', 0);
        $this->Ln(6);

        $this->SetFillColor(15,57,133); // Color de la tabla 
        $this->SetTextColor(255, 255, 255);//Color de texto
        $this->SetFont('Arial', 'B', 17);
        $this->SetY(26.5);// Ajustar Y para posicionar firma
        $this->SetX(17); // Ajustar X para posicionar firma
        $this->Cell(105); // Mueve el título 80 unidades hacia la derecha
        $this->Cell(70, 18, utf8_decode("RECIBO DE NOMINA"), 0, 0, 'C',1);
        $this->Ln(21);

        // Información del usuario
        $this->SetFont('Arial', 'B', 9);
        // Obtener el nombre y el periodo desde la sesión
        $id = $_SESSION["id_us"];
        $periodo = $_SESSION["idp"];

        // Consultar el nombre del usuario
        $sql = busca_id_empleado($id);
        if ($fila = mysqli_fetch_assoc($sql)) {
            // Añadir caracteres especiales
            $nombre = utf8_decode(" ") .utf8_decode($fila['nombre'])."  ".  utf8_decode($fila['ap_pat'])."  ".  utf8_decode($fila['ap_mat']). utf8_decode(" ") ;
                $_SESSION["nombre"]=$nombre;
        } 

        // Consultar el número de nómina correspondiente al periodo
        $numero_nomina = '';
        if (strpos($periodo, '14') === 0) {
            $numero_nomina = utf8_decode("Segunda quincena");
        } elseif (strpos($periodo, '29') === 0) {
            $numero_nomina = utf8_decode("Primer quincena");
        }

        // Mostrar datos
        $this->SetTextColor(0); //color
        $this->Cell(110);
        $this->Cell(96, 10, utf8_decode("Nombre: ") . $nombre, 0, 0, '', 0);
        $this->Ln(4);
        $this->Cell(110);
        $this->Cell(96, 10, utf8_decode("Periodo: ") . $periodo, 0, 0, '', 0);
        $this->Ln(4);
        $this->Cell(110);
        $this->Cell(96, 10, utf8_decode("No. Nómina: ") . $numero_nomina, 0, 0, '', 0);
        $this->Ln(11.5);
    }

    // Pie de página
    function Footer()
    {
       /* $this->SetY(-15); // Ajustar la posición de Y para el pie de página
        $this->SetX(10); // Ajustar X para centrar el total y la firma
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
        */  

        $this->SetY(-15);
        $this->SetX(180); // Ajustar X para centrar el total y la firma
        $this->SetFont('Arial', 'I', 9);
        $hoy = date('d/m/Y');
        $this->Cell(0, 10, utf8_decode($hoy), 0, 0, 'L');

        // Posicionar firma a la derecha del total
        $this->SetY(-241.);
        $this->SetX(20); // Ajustar X para posicionar firma
        $this->SetFont('Arial', 'B', 13);
        $this->Cell(0, 10, utf8_decode('Firma: ____________________________'), 0, 0, 'L');

    }
}

// Crear el objeto PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();

// Configurar la fuente y el color de la tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetDrawColor(15,57,133); // Color azul/borde de la tabla 

// Calcula el ancho total de la tabla
$ancho_concepto = 95;
$ancho_horas = 35;
$ancho_cantidad = 40;
$ancho_total = $ancho_concepto + $ancho_horas + $ancho_cantidad ; // Añadir bordes de 1 mm a cada lado de las celdas

// Calcula la posición X para centrar la tabla
$pagina_ancho = 210; // Ancho de la página en mm (A4)
$pos_x = ($pagina_ancho - $ancho_total) / 2;

// Encabezado de la tabla
$pdf->SetFillColor(15,57,133); // Color de la tabla 
$pdf->SetTextColor(255, 255, 255);
$pdf->SetX($pos_x);
$pdf->Cell($ancho_concepto, 6, utf8_decode('CONCEPTO'),1, 0, 'L', 1); // Ancho 38 mm, Altura 5 mm
$pdf->Cell($ancho_horas, 6, utf8_decode('HORAS'), 1, 0, 'L', 1);    // Ancho 45 mm, Altura 5 mm
$pdf->Cell($ancho_cantidad, 6, utf8_decode('CANTIDAD'),1, 1, 'L', 1); // Ancho 60 mm, Altura 5 mm
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);

// Obtener los datos para la tabla y total de percepciones
$id = $_SESSION["id_us"];
$periodo = $_SESSION["idp"];
$sql = busca_percepcion_usuario($id, $periodo);
$sql2 =busca_deduccion_usuario($id,$periodo);
$totalp = 0;

$pdf->SetFont('Arial', '', 9);

while ($fila = mysqli_fetch_assoc($sql)) {
    $pdf->SetX($pos_x);
    $pdf->Cell($ancho_concepto, 5, utf8_decode($fila['concepto']), 0, 0, 'L'); //  Altura 10 mm, Posición
    $pdf->Cell($ancho_horas, 5, utf8_decode($fila['horas']), 0, 0, 'L');    
    $pdf->Cell($ancho_cantidad, 5, utf8_decode($fila['cantidad']), 0, 1, 'L'); 
    $totalp += $fila['cantidad'];
}

// Encabezado de la tabla
$pdf->SetFillColor(15,57,133); // Color de la tabla 
$pdf->SetTextColor(255, 255, 255);
$pdf->SetX($pos_x);
$pdf->Cell($ancho_concepto, 6, utf8_decode('DEDUCCIONES'),1, 0, 'L', 1); // Ancho 38 mm, Altura 5 mm
$pdf->Cell($ancho_cantidad, 6, utf8_decode('CANTIDAD'),1, 1, 'L', 1); // Ancho 60 mm, Altura 5 mm
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);

while ($fila = mysqli_fetch_assoc($sql2)) {
    $pdf->SetX($pos_x);
    $pdf->Cell($ancho_concepto, 5, utf8_decode($fila['concepto']), 0, 0, 'L'); //  Altura 10 mm, Posición
    $pdf->Cell($ancho_cantidad, 5, utf8_decode($fila['cantidad']), 0, 1, 'L'); 
    $totalp -= $fila['cantidad'];
}

// Insertar en la tabla `conta_egreso` antes de generar el PDF
$concepto = 'Nómina de '.utf8_encode($_SESSION["nombre"]);
$cantidad = $totalp;  //  total de percepciones 
$fecha = date('Y-m-d');
$estado = 1;  //estado activo
$anio = date("Y");

$estados = estado_nomina($id, $periodo, $anio);
while($estado=mysqli_fetch_assoc($estados)){
    $status = $estado['todas'];
}

if($status == 0){
    guarda_egreso($concepto, $cantidad, $fecha, 1);
    cambia_estado($id, $periodo, $anio);
}

//completa2($consulta);


// Mostrar total de percepciones
$pdf->Ln(13);
$pdf->SetFont('Arial', 'I', 19);
$pdf->Cell(10); // Aliner celda
$pdf->Cell(85, 10, utf8_decode('TOTAL ='), 0, 0, 'L'); // Ancho 85 mm, Altura 20 mm
$pdf->SetX( $ancho_concepto/4); // Ajustar X para mostrar 'Total:' alineado con la tabla
$pdf->SetFont('Arial', 'I', 16);
$pdf->Cell(119); // Aliner celda
$pdf->Cell(47, 9, utf8_decode('$' . number_format($totalp, 2)), 1, 1, 'C'); // Ancho, Altura

// Generar el código QR
$comprobanteDir = 'comprobante';
if (!file_exists($comprobanteDir)) {
    mkdir($comprobanteDir);
}
$filename = $comprobanteDir . 'qrcode.png';

//Almacena los datos del usuario
$nominaData = "ID: $id, Periodo: $periodo, Total: $" . number_format($totalp, 2);

//Usa la biblioteca para generar el codigo qr
QRcode::png($nominaData, $filename, QR_ECLEVEL_L, 4);

// Agregar el código QR al PDF
$pdf->Image($filename, 17, 246,43,43);
// Agregar texto al lado del QR
$pdf->SetY(255);
$pdf->SetX(60);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(0, 10, utf8_decode('Este no es un comprobante fiscal.'), 0, 0, 'L');

//Pagina oficial de UDIMEX
$pdf->SetY(262);
$pdf->SetX(60);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, utf8_decode('https://www.udimex.net/'), 0, 0, 'L');

$pdf->SetY(266);
$pdf->SetX(60);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, utf8_decode('E-mail: direccion@udimex.net'), 0, 0, 'L');


// Salida del PDF
$pdf->Output('Nomina.pdf', 'I');

// Eliminar el archivo temporal del código QR
unlink($filename);
?>
