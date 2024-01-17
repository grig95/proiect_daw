<?php

require_once 'constants.php';
require_once 'utility.php';
require_once 'fpdf/fpdf.php';

// Redirect in case no cookie is passed
if(!isset($_COOKIE['sessionid']))
    {
        $parentURI = getCurrentParentURI();
        header('Location: '.$parentURI.'/login.php');
        exit;
    }
        
$userInfo = getUserInfoForSession($_COOKIE['sessionid']);
// Redirect in case of invalid user
if(!$userInfo)
    {
        $parentURI = getCurrentParentURI();
        header('Location: '.$parentURI.'/login.php');
        exit;
    }


$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$query = "select o.bun bun, o.pret pret, t.data data, u.nume cumparator from tranzactii t join oferte o on t.id_oferta=o.id join utilizatori u on t.id_cumparator=u.id where o.id_vanzator=".$userInfo['id'].";";
$result = $link->query($query);

mysqli_close($link);


$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Report generated for MGOS user '.$userInfo['nume'].':', 0, 1, 'C');
$pdf->Cell(0, 20, '', 0, 1, 'C');

// Table header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Bun', 1);
$pdf->Cell(40, 10, 'Pret', 1);
$pdf->Cell(40, 10, 'Data', 1);
$pdf->Cell(40, 10, 'Cumparator', 1);
$pdf->Ln();

// Rows
$row=$result->fetch_array();
$pdf->SetFont('Arial', '', 12);
while($row) 
{
    $pdf->Cell(40, 10, $row['bun'], 1);
    $pdf->Cell(40, 10, $row['pret'], 1);
    $pdf->Cell(40, 10, $row['data'], 1);
    $pdf->Cell(40, 10, $row['cumparator'], 1);
    $pdf->Ln();
    $row=$result->fetch_array();
}


$pdf->Output('tranzactii_table.pdf', 'I');


?>