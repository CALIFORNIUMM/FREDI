<?php

require_once "init.php";

// initiate FPDI
$pdf = new Mon_fpdi;

// Créé la constante pour le symbole ascii euro (sinon probleme d'affichage)
$date = date('d/m/Y');
define('EURO'," ".utf8_encode(chr(128))); 

// Metadonnées
$pdf->SetTitle('Cerfa', true);
$pdf->SetAuthor('FREDI', true);
$pdf->SetSubject('Cerfa', true);
$pdf->mon_fichier="cerfa.pdf";

// add a page
$pdf->AddPage();

// set the source file
$pdf->setSourceFile("fpdi/CERFA_vierge.pdf");

// import page 1
$tplIdx = $pdf->importPage(1);

$pdf->useImportedPage($tplIdx);

// now write some text above the imported page
$pdf->SetFont('Helvetica');
$pdf->SetTextColor(255, 0, 0);
$pdf->SetXY(30, 30);
$pdf->Write(0, 'This is just a simple text');

$pdf->Output('F','../outfiles/'.$pdf->mon_fichier);
header('Location: profil.php');
?>