<?php

require_once "init.php";

//Renvoie l'utilisateur
$userDAO = new UserDAO();
$user = $userDAO->find($_GET['id']);

$noteDAO = new NoteDAO();
$note = $noteDAO->findByUser($user->get_id_utilisateur());

$adherentDAO = new AdherentDAO();
$adherent = $adherentDAO->findByIdUtilisateur($user->get_id_utilisateur());

$clubDAO = new ClubDAO();
$club = $clubDAO->find($adherent->get_id_club());

$ligueDAO = new LigueDAO();
$ligue = $ligueDAO->find($club->get_id_ligue());

// Instanciation de l'objet dérivé
$pdf = new Mon_pdf();

// Créé la constante pour le symbole ascii euro (sinon probleme d'affichage)
$date = date('d/m/Y');
define('EURO'," ".utf8_encode(chr(128))); 

// Metadonnées
$pdf->SetTitle('Cerfa', true);
$pdf->SetAuthor('FREDI', true);
$pdf->SetSubject('Cerfa', true);
$pdf->mon_fichier="cerfa_".$user->get_nom().".pdf";

// add a page
$pdf->AddPage();

// Définit l'alias du nombre de pages {nb}
$pdf->AliasNbPages();

$pdf->Image('img\CERFA_vierge.png', 0, 0, 210, 300);
$pdf->setY(18);
$pdf->setX(165);
$pdf->SetFont('Times', '', 8);
$pdf->SetTextColor(0, 0, 0); // Noir
$pdf->SetFont('', 'B');

//N° ordre
$pdf->SetFillColor(255,255,255);
$pdf->Cell(25, 5, utf8_decode($note->get_nr_ordre()),  0, "C", true);

//Nom du club
$pdf->setY(37);
$pdf->setX(80);
$pdf->Cell(25, 3, utf8_decode($club->get_lib_club()), 0, "C", true);

//Adresse
$pdf->setY(46);
$pdf->setX(75);
$pdf->Cell(16, 3, utf8_decode($club->get_adr1()),  0, "L", true);
//Code postal
$pdf->setY(52);
$pdf->setX(30);
$pdf->Cell(13, 3, utf8_decode($club->get_adr2()),  0, "C", true);
//Commune
$pdf->setY(52);
$pdf->setX(80);
$pdf->Cell(17, 3, utf8_decode($club->get_adr3()),  0, "C", true);
//Objet
$pdf->setY(61);
$pdf->setX(75);
$pdf->Cell(4, 3, utf8_decode($ligue->get_lib_ligue()),  0, "C", true);

//Case cochée
$pdf->setY(79);
$pdf->setX(12);
$pdf->Cell(4, 3, 'X',  0, "C", true);

//Prenom Nom
$pdf->setY(178);
$pdf->setX(60);
$pdf->Cell(4, 3, utf8_decode($user->get_prenom()." ".$user->get_nom()),  0, "C", true);

//Adresse
$pdf->setY(187);
$pdf->setX(80);
$pdf->Cell(4, 3, utf8_decode($adherent->get_adr1()." ".$adherent->get_adr2()." ".$adherent->get_adr3()),  0, "C", true);

//Code Postal
$pdf->setY(192);
$pdf->setX(35);
$pdf->Cell(4, 3, utf8_decode($adherent->get_adr2()),  0, "C", true);

//Commune
$pdf->setY(192);
$pdf->setX(80);
$pdf->Cell(4, 3, utf8_decode($adherent->get_adr3()),  0, "L", true);

//Somme
$pdf->setY(202);
$pdf->setX(180);
$pdf->Cell(4, 3, utf8_decode($note->get_mt_total().EURO),  0, "C", true);

//Date paiement
$pdf->setY(215);
$pdf->setX(55);
$pdf->Cell(4, 3, utf8_decode($date),  0, "C", true);

//Case cochée
$pdf->setY(241);
$pdf->setX(12);
$pdf->Cell(4, 3, 'X',  0, "C", true);
























$pdf->Output('f','outfiles/'.$pdf->mon_fichier);
header('Location: profil.php');
?>