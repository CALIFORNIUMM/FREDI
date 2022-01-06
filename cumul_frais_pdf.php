<?php
/**
 * Cumul de frais de la période active en PDF
 */
require_once "init.php";

$ligueDAO = new LigueDAO;
$ligues = $ligueDAO->cumulFraisLigue();

$clubDAO = new ClubDAO;
$clubs = $clubDAO->cumulFraisClub();

$motifDAO = new MotifDAO;
$motifs = $motifDAO->cumulFraisMotif();

$periodeDAO = new PeriodeDAO;
$periode = $periodeDAO->findLibEnCours();


/* echo '<pre>';
var_dump($ligues, $clubs, $motifs);
echo '</pre>';
die(); */

// Instanciation de l'objet dérivé
$pdf = new Mon_pdf();

// Créé la constante pour le symbole ascii euro (sinon probleme d'affichage)
$date = date('d/m/Y');
define('EURO'," ".utf8_encode(chr(128))); 

// Metadonnées
$pdf->SetTitle('Cumul Frais', true);
$pdf->SetAuthor('FREDI', true);
$pdf->SetSubject('Cumul des Frais', true);
$pdf->mon_fichier="cumul_frais.pdf";

// Création d'une page
$pdf->AddPage();

// Définit l'alias du nombre de pages {nb}
$pdf->AliasNbPages();

// Titre de page ligues
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(208,252,204);
$pdf->Cell(200, 10, utf8_decode("Cumul de frais des ligues pour l'année ".$periode->get_lib_periode()), 0, 1, 'C');
$pdf->Ln(5);

// Entête ligue
$pdf->SetFont('Arial', '', 8);
$pdf->SetX(15);
$pdf->Cell(50, 10, utf8_decode("ID de la ligue"), 1,0,"C",true);
$pdf->Cell(80, 10, utf8_decode("Nom de la ligue"), 1,0,"C",true);
$pdf->Cell(50, 10, utf8_decode("Montant dépensé par la ligue"), 1,1,"C",true);
// Contenu Ligue
$fill=false;
$pdf->SetFillColor(224,235,255);
foreach ($ligues as $ligue) {
    $pdf->SetFont('', '', 10);
    $pdf->SetX(15);
    $pdf->Cell(50, 10, utf8_decode($ligue['id_ligue']),1,0,"C", $fill);
    $pdf->Cell(80, 10, utf8_decode($ligue['lib_ligue']),1,0,"C", $fill);
    $pdf->Cell(50, 10, utf8_decode($ligue['total']),1,1,"C", $fill);
    $fill=!$fill;
}
$pdf->Ln(5);
// Titre de page clubs
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(208,252,204);
$pdf->Cell(200, 10, utf8_decode("Cumul de frais des clubs pour l'année ".$periode->get_lib_periode()), 0, 1, 'C');
$pdf->Ln(5);

// Entête clubs
$pdf->SetFont('Arial', '', 8);
$pdf->SetX(15);
$pdf->Cell(50, 10, utf8_decode("ID du club"), 1,0,"C",true);
$pdf->Cell(80, 10, utf8_decode("Nom du club"), 1,0,"C",true);
$pdf->Cell(50, 10, utf8_decode("Montant dépensé par le club"), 1,1,"C",true);
// Contenu clubs
$fill=false;
$pdf->SetFillColor(224,235,255);
foreach ($clubs as $club) {
    $pdf->SetFont('', '', 10);
    $pdf->SetX(15);
    $pdf->Cell(50, 10, utf8_decode($club['id_club']),1,0,"C", $fill);
    $pdf->Cell(80, 10, utf8_decode($club['lib_club']),1,0,"C", $fill);
    $pdf->Cell(50, 10, utf8_decode($club['total']),1,1,"C", $fill);
    $fill=!$fill;
}
$pdf->Ln(5);
// Titre de page motifs
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(208,252,204);
$pdf->Cell(200, 10, utf8_decode("Cumul de frais par motif pour l'année ".$periode->get_lib_periode()), 0, 1, 'C');
$pdf->Ln(5);

// Entête motifs
$pdf->SetFont('Arial', '', 8);
$pdf->SetX(15);
$pdf->Cell(50, 10, utf8_decode("ID du motif"), 1,0,"C",true);
$pdf->Cell(80, 10, utf8_decode("Nom du motif"), 1,0,"C",true);
$pdf->Cell(50, 10, utf8_decode("Montant dépensé"), 1,1,"C",true);
// Contenu motifs
$fill=false;
$pdf->SetFillColor(224,235,255);
foreach ($motifs as $motif) {
    $pdf->SetFont('', '', 10);
    $pdf->SetX(15);
    $pdf->Cell(50, 10, utf8_decode($motif['id_motif']),1,0,"C", $fill);
    $pdf->Cell(80, 10, utf8_decode($motif['lib_motif']),1,0,"C", $fill);
    $pdf->Cell(50, 10, utf8_decode($motif['total']),1,1,"C", $fill);
    $fill=!$fill;
}
$pdf->Ln(5);

// Titre de page montant total
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(208,252,204);
$pdf->Cell(200, 10, utf8_decode("Montant total des frais pour l'année ".$periode->get_lib_periode()), 0, 1, 'C');
$pdf->Ln(5);
// Entête total
$pdf->SetFont('Arial', '', 8);
$pdf->SetX(80);
$pdf->Cell(50, 10, utf8_decode("Montant dépensé"), 1,1,"C",true);
//contenu
$pdf->SetFillColor(224,235,255);
$pdf->SetFont('', '', 10);
$pdf->SetX(80);
$total=0;
foreach($motifs as $motif){
    $total+=$motif['total'];
}
$pdf->Cell(50, 10, utf8_decode($total),1,1,"C", $fill);
// Génération du document PDF
$pdf->Output('f','outfiles/'.$pdf->mon_fichier);
header('Location: profil.php');
?>