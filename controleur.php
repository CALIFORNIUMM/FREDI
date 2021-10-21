<?php
  $title = "Contrôleur";
  include('header.php'); 
  $session = $_SESSION['user'];
?>
  <h1>Menu Contrôleur</h1>
  <h2>Page de contrôle</h2>

  <?php
    
    foreach($notes as $note) {
    echo '<br><br><br><br><br>';
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
    foreach($note->get_lignes() as $ligne) {
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
        echo '<th>ID Motif</th>';
        echo '<th>Modifier</th>';
        echo '<th>Supprimer</th>';
    echo '</tr>';
    echo '<tr>';
        echo '<td>' . $ligne->get_id_ligne() . '</td>';
        echo '<td>' . $ligne->get_dat_ligne() . '</td>';
        echo '<td>' . $ligne->lib_trajet() . '</td>';
        echo '<td>' . $ligne->get_nb_km() . '</td>';
        echo '<td>' . $ligne->get_mt_km() . '</td>';
        echo '<td>' . $ligne->get_mt_peage() . '</td>';
        echo '<td>' . $ligne->get_mt_repas() . '</td>';
        echo '<td>' . $ligne->get_mt_hebergement() . '</td>';
        echo '<td>' . $ligne->get_mt_total() . '</td>';
        echo '<td>' . $ligne->get_id_motif() . '</td>';
        echo '<td><a href="ligne_modifier.php?id_ligne='.$ligne->get_id_ligne().'">Modifier</a></td>';
        echo '<td><a href="ligne_supprimer.php?id_ligne='.$ligne->get_id_ligne().'">Supprimer</a></td>';
    }
    echo '</tr>';
    echo '</table>';
  }
  

    ?>
<?php include('footer.php'); ?>