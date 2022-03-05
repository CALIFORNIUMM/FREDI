<?php
/**
 * Note de frais de la période active en PDF
 */
require_once "init.php";

$id_note = isset($_GET['id']) ? $_GET['id'] : null;

//recupere la note
$noteDAO = new NoteDAO();
$note = $noteDAO->find($id_note);

//Renvoie l'utilisateur
$userDAO = new UserDAO();
$user = $userDAO->find($note->get_id_utilisateur());

$adherentDAO = new AdherentDAO();
$adherent = $adherentDAO->findByIdUtilisateur($note->get_id_utilisateur());

$clubDAO = new ClubDAO();
$club = $clubDAO->find($adherent->get_id_club());

$ligneDAO = new LigneDAO();

$periodeDAO = new PeriodeDAO();
$periode = $periodeDAO->findLibEnCours();

//Renvoie les lignes de la note active
$lignes = $ligneDAO->findAllByIdNote($id_note, $periode->get_lib_periode());

$motifDAO = new MotifDAO();

// Instanciation de l'objet dérivé
$pdf = new Mon_pdf();

// Créé la constante pour le symbole ascii euro (sinon probleme d'affichage)
$date = date('d/m/Y');
define('EURO'," ".utf8_encode(chr(128))); 

// Metadonnées
$pdf->SetTitle('Note', true);
$pdf->SetAuthor('FREDI', true);
$pdf->SetSubject('Note', true);
$pdf->mon_fichier="note_".$user->get_nom().".pdf";

// Création d'une page
$pdf->AddPage();

// Définit l'alias du nombre de pages {nb}
$pdf->AliasNbPages();

// Titre de page
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(208,252,204);
$pdf->SetX(5);
$pdf->Cell(50, 10, utf8_decode("Note de frais des bénévoles"), 0, 0, 'L');
$pdf->SetX(155);
$pdf->Cell(50, 10, utf8_decode("Année civile ".$periode->get_lib_periode()), 0,1,"C", true);
$pdf->Ln(5);

$pdf->SetFont('Times', 'B', 14);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetX(12);
$pdf->Cell(20, 10, utf8_decode("Je soussigné(e)"), 0,1,"C", false);
$pdf->Cell(195, 8, utf8_decode($user->get_nom()." ".$user->get_prenom()), 0,1,"C",true);
$pdf->Ln(5);
$pdf->Cell(20, 10, utf8_decode("demeurant"), 0,1,"C",false);
$pdf->SetFont('Times', '', 14);
$pdf->Cell(195, 8, utf8_decode($adherent->get_adr1()." ".$adherent->get_adr2()." ".$adherent->get_adr3()), 0,1,"C",true);
$pdf->SetX(35);
$pdf->Ln(5);
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(500, 10, utf8_decode("certifie renoncer au remboursement des frais ci-dessous et les laisser à l'association"), 0,1,"L",false);
$pdf->SetFont('Times', '', 14);
$pdf->Cell(195, 8, utf8_decode($club->get_lib_club()), 0,1,"C",true);
$pdf->Cell(195, 8, utf8_decode($club->get_adr1()." ".$club->get_adr2()." ".$club->get_adr3()), 0,1,"C",true);
$pdf->SetX(15);
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(20, 10, utf8_decode("en tant que don."), 0,1,"C",false);
$pdf->Ln(5);
$pdf->SetX(20);
$pdf->Cell(20, 5, utf8_decode("Frais de déplacement"), 0,0,"C",false);
$pdf->SetX(120);
$pdf->SetFont('Times', '', 14);
$pdf->Cell(20, 5, utf8_decode("Tarif kilométrique appliqué pour le remboursement : ".$periode->get_mt_km()), 0,1,"C",false);
$pdf->Ln(5);

// Entête
$pdf->SetFont('Times', '', 8);
$pdf->SetX(5);
$pdf->Cell(20, 10, utf8_decode("Date jj/mm/aaaa"), 1,0,"C",true);
$pdf->Cell(35, 10, utf8_decode("Motif"), 1,0,"C",true);
$pdf->Cell(30, 10, utf8_decode("Trajet"), 1,0,"C",true);
$pdf->Cell(20, 10, utf8_decode("Kms parcourus"), 1,0,"C",true);
$pdf->Cell(20, 10, utf8_decode("Total frais Kms"), 1,0,"C",true);
$pdf->Cell(18, 10, utf8_decode("Coût Péages"), 1,0,"C",true);
$pdf->Cell(18, 10, utf8_decode("Coût Repas"), 1,0,"C",true);
$pdf->Cell(18, 10, utf8_decode("Coût Hébergement"), 1,0,"C",true);
$pdf->Cell(20, 10, utf8_decode("Total"), 1,1,"C",true);

// Contenu
$fill=false;  // panachage pour la couleur du fond
$pdf->SetFillColor(224,235,255);  // bleu clair
$total = 0;
foreach ($lignes as $ligne) {
    $pdf->SetX(5);
    $pdf->Cell(20, 10, utf8_decode($ligne->get_dat_ligne()),1,0,"C");
    $pdf->Cell(35, 10, utf8_decode($motifDAO->find($ligne->get_id_motif())->get_lib_motif()),1,0,"C");
    $pdf->Cell(30, 10, utf8_decode($ligne->get_lib_trajet()),1,0,"C");
    $pdf->Cell(20, 10, utf8_decode($ligne->get_nb_km()),1,0,"C");
    $pdf->Cell(20, 10, utf8_decode($ligne->get_mt_km()),1,0,"C");
    $pdf->Cell(18, 10, utf8_decode($ligne->get_mt_peage()),1,0,"C");
    $pdf->Cell(18, 10, utf8_decode($ligne->get_mt_repas()),1,0,"C");
    $pdf->Cell(18, 10, utf8_decode($ligne->get_mt_hebergement()),1,0,"C");
    $pdf->Cell(20, 10, utf8_decode($ligne->get_mt_total().EURO),1, 1,"C", true);
    $total = $total + $ligne->get_mt_total();
}

$pdf->SetFont('Times', '', 14);
$pdf->SetX(5);
$pdf->Cell(179, 10, utf8_decode("Montant total des frais de déplacements"), 1,0,"C",false);
$pdf->SetFillColor(204, 255, 255);  // bleu clair
$pdf->Cell(20, 10, utf8_decode($total.EURO), 1,1,"C",true);
$pdf->Ln(5);

$pdf->SetFillColor(208,252,204);
$pdf->SetX(10);
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(80, 8, utf8_decode("Je suis licencié sous le n° de licence suivant :"), 0,0,"L");
$pdf->SetX(125);
$pdf->SetFont('Times', '', 14);
$pdf->Cell(40, 8, utf8_decode("Licence n° ".$adherent->get_nr_licence()), 0,1,"C",true);
$pdf->Ln(5);
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(40, 8, utf8_decode("Montant total des dons :"), 0,0,"L");
$pdf->SetFillColor(204, 255, 255);  // bleu clair
$pdf->SetX(100);
$pdf->SetFont('Times', '', 14);
$pdf->Cell(40, 8, utf8_decode($total.EURO), 0,1,"C",true);
$pdf->Ln(5);

$pdf->SetFont('Times', 'I', 10);
$pdf->SetX(65);
$pdf->Cell(80, 10, utf8_decode("Pour bénéficier du reçu de dons, cette note de frais doit être accompagnée de tous les justificatifs correspondants."), 0,1,"C");
$pdf->SetFont('Times', '', 14);
$pdf->SetFillColor(208,252,204);
$pdf->Ln(5);

$pdf->SetX(60);
$pdf->Cell(20, 10, utf8_decode("A"), 0,0,"C");
$pdf->Cell(50, 10, utf8_decode("Toulouse"), 0,0,"C", true);
$pdf->Cell(20, 10, utf8_decode("Le"), 0,0,"C");
$pdf->Cell(50, 10, utf8_decode($date), 0,1,"C", true);
$pdf->Ln(2);
$pdf->SetX(70);
$pdf->Cell(50, 20, utf8_decode("Signature du bénévole :"), 0,0,"C", false);
$pdf->Cell(80, 20, utf8_decode($user->get_prenom()." ".$user->get_nom()), 0,1,"C", true);
$pdf->Ln(25);

$pdf->SetFillColor(255, 156, 204);
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(80, 10, utf8_decode("Partie réservée à l'association"), 0,1,"C", true);
$pdf->SetFont('Times', '', 14);
$pdf->Cell(40, 10, utf8_decode("N° d'ordre du reçu : "), 0,0,"L", true);
$pdf->Cell(40, 10, utf8_decode($note->get_nr_ordre()), 0,1,"L", true);
$pdf->Cell(40, 10, utf8_decode("Remis le : "), 0,0,"L", true);
$pdf->Cell(40, 10, utf8_decode($note->get_dat_remise()), 0,1,"L", true);
$pdf->Cell(80, 10, utf8_decode("Signature du trésorier :"), 0,1,"L", true);

// Génération du document PDF
$pdf->Output('f','outfiles/'.$pdf->mon_fichier);
header('Location: profil.php');