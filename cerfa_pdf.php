<?php

require_once "../init.php";

$id = isset($_GET['id']) ? $_GET['id'] : null;
//Renvoie l'utilisateur
$userDAO = new UserDAO;
$user = $userDAO->find($id);
$adherentDAO = new AdherentDAO;
$adherent = $adherentDAO->find($id);
$clubDAO = new ClubDAO;
$club = $clubDAO->find($adherent->get_id_club());
$ligneDAO = new LigneDAO;
$periodeDAO = new PeriodeDAO;
$periode = $periodeDAO->findLibEnCours();

$motifDAO = new MotifDAO;
$ligueDAO = new LigueDAO;
$ligue = $ligueDAO->find($club->get_id_ligue());

//Trouver moyen de convertir chiffres en lettres

$fields = array(
    //REMPLIR INFOS
);

$pdf = new FPDM('../fpdf/fpdm/src/CERFA_vierge.pdf');
$pdf->mon_fichier="CERFA.pdf";
$pdf->useCheckboxParser = true; //gestion des checkbox
$pdf->Load($fields, true); // second parameter: false if field values are in ISO-8859-1, true if UTF-8
$pdf->Merge();
$pdf->Output('F','../outfiles/'.$user->get_nom()."-".$periode->get_lib_periode()."-".$pdf->mon_fichier);
header('Location: profil.php');
?>