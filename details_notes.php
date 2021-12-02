<?php
$title = "Profil";
include('header.php');

$lignes=array();
$id_user = isset($_GET['id_utilisateur']) ? $_GET['id_utilisateur'] : null;
$dao = new NoteDAO();
$notes = $dao->findAllByUser($id_user);

$motifdao = New MotifDAO();
$motifdao=$motifdao->findAll();

?>


  <?php

    foreach($notes as $note) {
    echo '<br><br><br>';
    echo '<table>';
    echo '<tr>';
        echo '<th>ID Note</th>';
        echo '<th>Validé ?</th>';
        echo '<th>Montant Total</th>';
        echo '<th>Date Remise</th>';
        echo '<th>N° Ordre</th>';
        echo '<th>ID Période</th>';
    echo '</tr>';
    echo '<tr>';
        echo '<td>' . $note->get_id_note() . '</td>';
        echo '<td>' . $note->get_est_valide() . '</td>';
        echo '<td>' . $note->get_mt_total() . '</td>';
        echo '<td>' . $note->get_dat_remise() . '</td>';
        echo '<td>' . $note->get_nr_ordre() . '</td>';
        echo '<td>' . $note->get_id_periode() . '</td>';
    echo '</tr>';
    echo '</table>';

    echo '<table>';
    echo '<tr>';
        echo '<th>ID Ligne</th>';
        echo '<th>Date Ligne</th>';
        echo '<th>Libellé Trajet</th>';
        echo '<th>Nb Km</th>';
        echo '<th>Montant Km</th>';
        echo '<th>Montant Péage</th>';
        echo '<th>Montant Repas</th>';
        echo '<th>Montant Hébergement</th>';
        echo '<th>Montant Total</th>';
        echo '<th>Motif</th>';
        echo '<th>Modifier</th>';
        echo '<th>Supprimer</th>';
    echo '</tr><br>';
    foreach($note->get_lignes() as $ligne) {
        $m=NULL;
        foreach($motifdao as $motif){
            if($ligne->get_id_motif() == $motif->get_id_motif()){
                $m = $motif->get_lib_motif();
            }
        }
    echo '<tr>';
        echo '<td>' . $ligne->get_id_ligne() . '</td>';
        echo '<td>' . $ligne->get_dat_ligne() . '</td>';
        echo '<td>' . $ligne->get_lib_trajet() . '</td>';
        echo '<td>' . $ligne->get_nb_km() . '</td>';
        echo '<td>' . $ligne->get_mt_km() . '</td>';
        echo '<td>' . $ligne->get_mt_peage() . '</td>';
        echo '<td>' . $ligne->get_mt_repas() . '</td>';
        echo '<td>' . $ligne->get_mt_hebergement() . '</td>';
        echo '<td>' . $ligne->get_mt_total() . '</td>';
        echo '<td>' . $m . '</td>';
    }
    echo '</tr>';
    echo '</table>';
  }

    ?>
      <p><a href="liste_note_controleur.php">Retour</a> liste des controleur</p>

<?php include('footer.php'); ?>
