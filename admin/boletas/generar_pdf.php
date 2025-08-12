<?php
require('fpdf186/fpdf.php'); // Incluye la biblioteca FPDF
include('../../general/consultas/basic.php');
include('../../general/consultas/boletas.php');
include('../../general/consultas/carreras.php');
include('../../general/consultas/usuario.php');
include('../funciones.php');
/*
$id = $_GET['id'];
$nom = $_GET['nom'];
$apepa = $_GET['apepa'];
$apema = $_GET['apema'];
$mat = $_GET['mat'];
$f_pago = $_GET['f_pago'];
$cole = $_GET['cole'];
*/



class PDF extends FPDF {
    function Header() {
        // Encabezado
        $this->Image('img/fondo.png', 10, 10, 90); // Ruta de la imagen de fondo
    }

    function Footer() {
        // Pie de página
        // Puedes agregar información adicional en el pie de página si lo deseas
    }
    function TablaBasica($header)
   {
    //Cabecera
    foreach($header as $col)
    $this->Cell(40,7,$col,1);
    $this->Ln();
    $this->Cell(40,5,'hola',1);
    $this->Cell(40,5,'hola',1);
    $this->Cell(40,5,'hola',1);
    $this->Cell(40,5,'hola',1);
    $this->Ln();
    $this->Cell(40,5,'hola',1);
    $this->Cell(40,5,'hola',1);
    $this->Cell(40,5,'hola',1);
    $this->Cell(40,5,'hola',1);
   }
}



// Crear una instancia de la clase PDF
$pdf = new PDF();
$pdf->AddPage();

// Contenido del PDF
$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln(30);
$pdf->Cell(0, 10, 'BOLETA DE PAGO DE SERVICIOS', 0, 1, 'C');
$pdf->Ln(10);

// ... Resto de tu código HTML
// Inserta variables de PHP en el PDF

$pdf->Multicell(120, 5, ("Nombre:\nMatricula:"), 0, 'l', false);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x+100, $y-10);
$pdf->Multicell(120, 5, ("Mensualidad\nMes:"), 0, 'l', false);

/*$pdf->Cell(0, 10, 'ID del usuario: ' . $mat, 0, 1);
$pdf->Cell(0, 10, 'Nombre: ' . $nom, 0, 1);
$pdf->Cell(0, 10, 'Apellido Paterno: ' . $apepa, 0, 1);
$pdf->Cell(0, 10, 'Apellido Materno: ' . $apema, 0, 1);
$pdf->Cell(0, 10, 'Fecha de pago: ' . $f_pago, 0, 1);
$pdf->Cell(0, 10, 'Colegiatura: ' . $cole, 0, 1);*/

//Creación del objeto de la clase heredada
$pdf=new PDF();
//Títulos de las columnas
$header=array('Columna 1','Columna 2','Columna 3','Columna 4');
$pdf->AliasNbPages();
//Primera página
$pdf->AddPage();
$pdf->SetY(65);
//$pdf->AddPage();
$pdf->Tabla Basica($header);

function TablaColores($header)
{
//Colores, ancho de línea y fuente en negrita
$this->SetFillColor(255,0,0);
$this->SetTextColor(255);
$this->SetDrawColor(128,0,0);
$this->SetLineWidth(.3);
$this->SetFont(»,’B’);
//Cabecera
for($i=0;$i<count($header);$i++)
$this->Cell(40,7,$header[$i],1,0,’C’,1);
$this->Ln();
//Restauración de colores y fuentes
$this->SetFillColor(224,235,255);
$this->SetTextColor(0);
$this->SetFont(»);
//Datos
$fill=false;
$this->Cell(40,6,»hola»,’LR’,0,’L’,$fill);
$this->Cell(40,6,»hola2″,’LR’,0,’L’,$fill);
$this->Cell(40,6,»hola3″,’LR’,0,’R’,$fill);
$this->Cell(40,6,»hola4″,’LR’,0,’R’,$fill);
$this->Ln();
$fill=true;
$this->Cell(40,6,»col»,’LR’,0,’L’,$fill);
$this->Cell(40,6,»col2″,’LR’,0,’L’,$fill);
$this->Cell(40,6,»col3″,’LR’,0,’R’,$fill);
$this->Cell(40,6,»col4″,’LR’,0,’R’,$fill);
$fill=!$fill;
$this->Ln();
$this->Cell(160,0,»,’T’);
}



// Generar el PDF
$pdf->Output('boleta_pago.pdf', 'I');


?>
