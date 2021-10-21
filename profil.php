<?php
  include('header.php'); 
  
  $title = "Profil";

  $notes = new NoteDAO();
  $notes = $notes->findAll();
?>
  <h1>Bienvenu(e) <?= $session->get_pseudo() ?></h1>
  <h2>Page de mon profil</h2>
  <p>Mon rôle : <?= $session->get_role() ?></p>
  <h2>Liste des Notes</h2>

  <?php
    echo '<table>';
        echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Validé ?</th>';
            echo '<th>Montant Total</th>';
            echo '<th>Date Remise</th>';
            echo '<th>N° Ordre</th>';
            echo '<th>ID Période</th>';
        echo '</tr>';

    foreach ($notes as $note)
    {
        echo '<tr>';
            echo '<td>' . $note->get_id_note() . '</td>';
            echo '<td>' . $note->get_est_valide() . '</td>';
            echo '<td>' . $note->get_mt_total() . '</td>';
            echo '<td>' . $note->get_dat_remise() . '</td>';
            echo '<td>' . $note->get_nr_ordre() . '</td>';
            echo '<td>' . $note->get_id_periode() . '</td>';
            echo '<td><a href="ligne_modifier.php?id_ligne='.$note->get_id_note().'">Modifier</a></td>';
            echo '<td><a href="ligne_supprimer.php?id_ligne='.$note->get_id_note().'">Supprimer</a></td>';
        echo '</tr>';
    }
    echo '</table>';

    echo "<p>". count($notes)." note(s)</p>";

    echo '<p><a href="note_ajouter.php">Ajouter</a> une note</p>';

    ?>

<?php include('footer.php'); ?>