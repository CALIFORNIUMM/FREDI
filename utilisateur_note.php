
<?php
$title = "Notes";
include('header.php');

$notedao = New NoteDAO();
$note = $notedao->findByUser($session->get_id_utilisateur());
$periode = New PeriodeDAO();
$motifdao = New MotifDAO();

?>
    <h1>Ma note de frais</h1>

    <h3>Mes frais en cours <a href="">Ajouter</a></h3> 
    <p><b>Periode</b> n° <?= $periode->findLibEnCours()->get_lib_periode() ?> - <?= $periode->findLibEnCours()->get_lib_periode()+1 ?></p>
    <p>Montant total en cours : <b><?= $note->get_mt_total() ?></b> €</p>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Trajet</th>
            <th>Motif</th>
            <th>Nombre de Km</th>
            <th>Montant total Km €</th>
            <th>Montant peages €</th>
            <th>Montant repas €</th>
            <th>Montant hebergement €</th>
            <th>Montant total €</th>
            <th>Actions</th>
        </tr>
        <?php
        foreach($note->get_lignes() as $ligne){
            echo '<tr>';
            echo '<td>'.$ligne->get_id_ligne().'</td>';
            echo '<td>'.date('d-m-Y', strtotime($ligne->get_dat_ligne())).'</td>';
            echo '<td>'.$ligne->get_lib_trajet().'</td>';
            echo '<td>'.$motifdao->find($ligne->get_id_motif())->get_lib_motif().'</td>';
            echo '<td>'.$ligne->get_nb_km().'</td>';
            echo '<td>'.$ligne->get_mt_km().'</td>';
            echo '<td>'.$ligne->get_mt_peage().'</td>';
            echo '<td>'.$ligne->get_mt_repas().'</td>';
            echo '<td>'.$ligne->get_mt_hebergement().'</td>';
            echo '<td>'.$ligne->get_mt_total().'</td>';
            echo '<td><a href="ligne_modifier.php?id_ligne='.$ligne->get_id_ligne().'">Modifier</a> <a href="">Supprimer</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
  
<?php include('footer.php'); ?>
