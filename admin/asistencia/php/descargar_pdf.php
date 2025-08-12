<?php
session_start();
include('../fpdf186/fpdf.php');
include('funciones.php');


if(isset($_POST['id_grupo'])){
    $id_grupo = $_POST['id_grupo'];
    $id_materia = $_POST['id_materia'];
    $_SESSION['id_grupo']=$id_grupo;
    $_SESSION['id_materia']=$id_materia;
}
else{
    if(isset($_SESSION['id_grupo'])){
        $id_grupo = $_SESSION['id_grupo'];
        $id_materia = $_SESSION['id_materia'];
    }
    else{
        header("location:inicio.php");
    }
}

$i_alumnos = obtener_a_g($id_grupo);
class PDF extends FPDF
{

function Header()
{

    $this->Image('../img/logo_u.jpg',1,2,50);

    $this->SetDrawColor(12, 52, 145);
    $this->SetLineWidth(5);
    $this->Line(55,10,200,10);


    $this->SetDrawColor(219, 10, 70);
    $this->SetLineWidth(5);
    $this->Line(55,20,200,20);

    $this->Ln(17);
    $this->SetFont('Arial','B',15);

    $this->Cell(90);
    $this->Cell(50,10, utf8_decode('Universidad Digital de México'),0,1,'C');

    $this->Ln(5);
}

function Footer()
{
    $this->SetDrawColor(12, 52, 145);
    $this->SetLineWidth(5);
    $this->Line(10,270,200,270);


    $this->SetDrawColor(219, 10, 70);
    $this->SetLineWidth(5);
    $this->Line(10,280,200,280);
 
    $this->SetY(-15);

    $this->SetFont('Arial','I',8);

    $this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();

$pdf->SetX(53); 
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, utf8_decode('Calificación Final'), 0, 1, 'C');
$pdf->Ln(10);


$n_materia = i_materia($id_materia);
$nombre_m = mysqli_fetch_assoc($n_materia)['nombre'];
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Asignatura: ' . utf8_decode($nombre_m), 0, 1, 'L');

date_default_timezone_set('America/Mexico_City');
$fecha_ac = date("Y-m-d");
$pdf->Cell(0, 10, 'Fecha: ' . $fecha_ac, 0, 1, 'L');
$pdf->Ln(10);


$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'No.', 1);
$pdf->Cell(17, 10, utf8_decode('Matrícula'), 1);
$pdf->Cell(55, 10, 'Nombre del alumno(a)', 1);
$pdf->Cell(25, 10, 'Primer parcial', 1);
$pdf->Cell(30, 10, 'Segundo parcial', 1);
$pdf->Cell(27, 10, utf8_decode('Calificación F.'), 1);
$pdf->Cell(25, 10, 'Estatus', 1);
$pdf->Ln();


$pdf->SetFont('Arial', '', 10);
while($fila = mysqli_fetch_assoc($i_alumnos)){
    $i=1;
    $calificaciones = m_calificacion($id_grupo, $id_materia, $fila['id_alumno']);
    while($fila2 = mysqli_fetch_assoc($calificaciones)) {
        $calificacion2 = m_calificacion2($id_grupo, $id_materia,$fila['id_alumno']);
        while($fila3 = mysqli_fetch_assoc($calificacion2)){
            $calificacion = ($fila2['valor1'] + $fila3['valor2']) / 2;
            $estatus = ($calificacion > 8) ? "Aprobado" : "Extraordinario";

            $pdf->Cell(10,10, $i,1);
            $pdf->Cell(17,10, $fila['id_alumno'],1);
            $pdf->Cell(55, 10, utf8_decode($fila['nombre'].' '. $fila['ap_pat'].' '. $fila['ap_mat']), 1);
            $pdf->Cell(25, 10, $fila2['valor1'], 1);
            $pdf->Cell(30, 10, $fila3['valor2'], 1);
            $pdf->Cell(27, 10, $calificacion, 1);
            $pdf->Cell(25, 10, $estatus, 1);
            $pdf->Ln();

            $i++;
        }
    }
}

$pdf->Output('D', 'calificaciones.pdf');
?>