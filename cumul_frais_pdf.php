<?php
/**
 * Cumul de frais de la période active en PDF
 */
require_once "init.php";

$id = isset($_GET['id']) ? $_GET['id'] : null;
$lib_periode = isset($_GET['lib_periode']) ? $_GET['lib_periode'] : null;

$ligueDAO = new LigueDAO;
$rows = $ligueDAO->cumulFrais($id_ligue, $annee)
$ligue = $ligueDAO->find($id_ligue);

// Instanciation de l'objet dérivé
$pdf = new Mon_pdf();

// Créé la constante pour le symbole ascii euro (sinon probleme d'affichage)
$date = date('d/m/Y');
define('EURO'," ".utf8_encode(chr(128))); 

// Metadonnées
$pdf->SetTitle('Cumul Frais', true);
$pdf->SetAuthor('FREDI', true);
$pdf->SetSubject('Cumul Frais', true);
$pdf->mon_fichier="cumul_frais.pdf";

// Création d'une page
$pdf->AddPage();

// Titre de page
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(208,252,204);
$pdf->Cell(200, 10, utf8_decode("Cumul de frais de la ligue de ".$ligue->get_lib_ligue()." pour l'année ".$annee), 0, 1, 'C');
$pdf->Ln(5);

// Entête
$pdf->SetFont('Times', '', 8);
$pdf->SetX(25);
$pdf->Cell(50, 10, utf8_decode("Club"), 1,0,"C",true);
$pdf->Cell(50, 10, utf8_decode("Motif"), 1,0,"C",true);
$pdf->Cell(50, 10, utf8_decode("Cumul"), 1,1,"C",true);

// Contenu
$fill=false;  // panachage pour la couleur du fond
$pdf->SetFillColor(224,235,255);  // bleu clair
$total = 0;
$club = '';
foreach ($rows as $row) { // compte le nombre de ligne par club
    if (isset($nbLignes[$row['lib_club']])){
        $nbLignes[$row['lib_club']] = $nbLignes[$row['lib_club']]+1; //si la variable existe, on incrémente
    }
    else{
        $nbLignes[$row['lib_club']] = 1; //sinon on l'initie à 1
    }
}

foreach ($rows as $row) {
    $pdf->SetX(25);

    if ($club != $row['lib_club']) {
        $pdf->Cell(50, 10*$nbLignes[$row['lib_club']], utf8_decode($row['lib_club']), 1, 0, "C"); //pour la première cellule, la hauteur dépend du nombre de lignes
        $club = $row['lib_club'];
    }
    else {
        $pdf->SetX(75);
    }
    $pdf->Cell(50, 10, utf8_decode($row['lib_motif']),1,0,"C");
    $pdf->Cell(50, 10, utf8_decode($row['total'].EURO),1,1,"C");
    $total = $total + $row['total'];
}

$pdf->Cell(100, 10, utf8_decode("Montant total des frais de déplacements"), 1,0,"C",false);
$pdf->SetFillColor(204, 255, 255);  // bleu clair
$pdf->Cell(50, 10, utf8_decode($total.EURO), 1,1,"C",true);
$pdf->Ln(5);

// Génération du document PDF
$pdf->Output('f','outfiles/'.$pdf->mon_fichier);
header('Location: profil.php');