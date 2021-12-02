<?php
/**
 * Note de frais de la période active en PDF
 */
require_once "init.php";

if(isset($_SESSION['user'])){
  $session = $_SESSION['user'];
}

$lignes=array();
$dao = new NoteDAO();
$notes = $dao->findAllByUser($session->get_id_utilisateur());

// Instanciation de l'objet dérivé
$pdf = new Mon_pdf();

// Metadonnées
$pdf->SetTitle('Note', true);
$pdf->SetAuthor('', true);
$pdf->SetSubject('Note', true);
$pdf->mon_fichier="note.pdf";

// Création d'une page
$pdf->AddPage();

// Définit l'alias du nombre de pages {nb}
$pdf->AliasNbPages();

// Titre de page
$pdf->SetFont('Arial', '', 24);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 20, utf8_decode('Note de frais'), 0, 1, 'C');
$pdf->Ln(8);

$pdf->SetX(10);
$pdf->Image("",8,2);

// Boucle des lignes
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0); // Noir
// Entête
$pdf->SetFont('', 'B');
$pdf->SetX(20);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(30, 5, utf8_decode("Date jj/mm/aaaa"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Motif"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Trajet"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Kms parcourus"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Total frais Kms"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Coût péages"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Coût repas"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Coût hébergement"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Total"), 1,1,"C",true);



// Note
  foreach($notes as $note) {
    $pdf->Cell(0,5,utf8_decode($note->get_id_note(),$note->get_est_valide(),$note->get_mt_total(),$note->get_dat_remise(),$note->get_nr_ordre(),$note->get_id_periode()),1,1,"L");
    foreach ($note->get_lignes() as $ligne){
      $pdf->Cell(0,5,utf8_decode($ligne->get_id_ligne(),$ligne->get_dat_ligne(),$ligne->get_lib_trajet(),$ligne->get_nb_km(),$ligne->get_mt_km(),$ligne->get_mt_peage(),$ligne->get_mt_repas(),$ligne->get_mt_hebergement(),$ligne->get_mt_total(),$ligne->get_id_motif()),1,1,"L");
    }
  }


// Génération du document PDF
$pdf->Output('f','outfiles/'.$pdf->mon_fichier);
header('Location: profil.php');