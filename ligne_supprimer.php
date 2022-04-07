<?php
$title = "Supprimer ligne";
include('header.php');

//Supprimer une ligne
require_once "init.php";
//dao messages flash
$flash = New Flash();
// Instanciation des DAO
$ligneDAO = new LigneDAO();

// Récupère l'ID dans l'URL
$id_ligne = isset($_GET['id_ligne']) ? $_GET['id_ligne'] : null;

// Lecture du formulaire
$submit = isset($_POST['submit']);
if ($submit) {
    // Formulaire soumi
    // Supprime l'enregistrement dans la BD
    $ligneDAO->delete($id_ligne);
    //message flash
    $flash->set_type('succes')->add_messages('Vous avez bien supprimé la ligne de frais n°'.$id_ligne)->put();
    // Redirection vers la liste des pays
    header('Location: profil.php');
} else {
    // Formulaire non soumi : lit l'objet métier
    $ligne = $ligneDAO->find($id_ligne);
}
?>

  <h1>User</h1>
  <h2>Supprimer une ligne</h2>
  
  <form action="<?= $_SERVER['PHP_SELF'] ?>?id_ligne=<?= $ligne->get_id_ligne() ?>" method="post">
  
    <label for="dat_ligne">Date du trajet</label><br>
    <input type="date" name="dat_ligne" id="dat_ligne" value="<?php echo $ligne->get_dat_ligne(); ?>" disabled>
    <label for="lib_trajet">Nom du trajet</label><br>
    <input type="text" name="lib_trajet" id="lib_trajet" value="<?php echo $ligne->get_lib_trajet(); ?>" disabled>
    <label for="nb_km">Nombre de kilomètres</label><br>
    <input type="text" name="nb_km" id="nb_km" value="<?php echo $ligne->get_nb_km(); ?>" disabled>
    <label for="mt_km">Montant Kilomètres</label><br>
    <input type="text" name="mt_km" id="mt_km" value="<?php echo $ligne->get_mt_km(); ?>" disabled>
    <label for="mt_peage">Montant Péages</label><br>
    <input type="text" name="mt_peage" id="mt_peage" value="<?php echo $ligne->get_mt_peage(); ?>" disabled>
    <label for="mt_repas">Montant Repas</label><br>
    <input type="text" name="mt_repas" id="mt_repas" value="<?php echo $ligne->get_mt_repas(); ?>" disabled>
    <label for="mt_hebergement">Montant Hébergement</label><br>
    <input type="text" name="mt_hebergement" id="mt_hebergement" value="<?php echo $ligne->get_mt_hebergement(); ?>" disabled>
    <label for="mt_total">Montant total</label><br>
    <input type="text" name="mt_total" id="mt_total" value="<?php echo $ligne->get_mt_total(); ?>" disabled>
    <label for="id_motif">Motif</label><br>
    <input type="text" name="id_motif" id="id_motif" value="<?php echo $ligne->get_id_motif(); ?>" disabled>
  
  
    <input type="submit" value="Supprimer" name="submit">
  </form>

  <?php include('footer.php'); ?>