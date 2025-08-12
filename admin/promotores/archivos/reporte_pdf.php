<?php

require_once ('../fpdf/fpdf.php');
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    //$this->image('../img/logo.png', 150, 1, 60); // X, Y, Tamaño
    $this->Ln(20);
    // Arial bold 15
    $this->SetFont('Arial','B',20);
  
    // Movernos a la derecha
    $this->Cell(60);

    // Título
    $this->Cell(70,10,'Prospectos ',0,0,'C');
    // Salto de línea
   
    $this->Ln(30);
    $this->SetFont('Arial','B',10);
    $this->SetX(8);
    $this->Cell(25,10,'ID',1,0,'C',0);
    $this->Cell(40,10,'Nombre',1,0,'C',0,);
    $this->Cell(27,10,'A. Paterno',1,0,'C',0);
    $this->Cell(27,10,'A. Materno',1,0,'C',0);
    $this->Cell(27,10,'Teléfono',1,0,'C',0);
    $this->Cell(27,10,'Med. Contacto',1,0,'C',0);
    $this->Cell(27,10,'Inscripción',1,0,'C',0);
    $this->Cell(27,10,'Mensualidad',1,0,'C',0);
    $this->Cell(27,10,'Certificado',1,0,'C',0);
    $this->Cell(27,10,'Modalidad',1,0,'C',0);
    $this->Cell(27,10,'Servicio',1,0,'C',0);
    $this->Cell(27,10,'Estatus',1,0,'C',0);
    $this->Cell(40,10,'Fecha',1,0,'C',0);


  
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
  
    $this->Cell(0,10,utf8_decode('Página') .$this->PageNo().'/{nb}',0,0,'C');
   //$this->SetFillColor(223, 229,235);
    //$this->SetDrawColor(181, 14,246);
    //$this->Ln(0.5);
}
}

$conexion=mysqli_connect("localhost","root","","r_user");
$consulta = "SELECT user.id, user.nombre, user.correo, user.password, user.telefono,
user.fecha, permisos.rol FROM user
LEFT JOIN permisos ON user.rol = permisos.id";
$resultado = mysqli_query($conexion, $consulta);

$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
//$pdf->SetWidths(array(10, 30, 27, 27, 20, 20, 20, 20, 22));
while ($row=$resultado->fetch_assoc()) {

    $pdf->SetX(8);

    $pdf->Cell(25,10,$row['ID'],1,0,'C',0);
    $pdf->Cell(40,10,$row['Nombre'],1,0,'C',0);
	$pdf->Cell(27,10,$row['A. Paterno '],1,0,'C',0);
    $pdf->Cell(27,10,$row['A. Materno'],1,0,'C',0);
    $pdf->Cell(27,10,$row['Teléfono'],1,0,'C',0);
    $pdf->Cell(27,10,$row['Med. Contacto'],1,0,'C',0);
    $pdf->Cell(27,10,$row['Inscripción'],1,0,'C',0);
    $pdf->Cell(27,10,$row['Mensualidad'],1,0,'C',0);
    $pdf->Cell(40,10,$row['Certificado'],1,0,'C',0);
    $pdf->Cell(40,10,$row['Modalidad'],1,0,'C',0);
    $pdf->Cell(40,10,$row['Serivicio'],1,0,'C',0);
    $pdf->Cell(40,10,$row['Estatus'],1,0,'C',0);
    $pdf->Cell(40,10,$row['fecha'],1,0,'C',0);
    
	


} 


	$pdf->Output();
?>