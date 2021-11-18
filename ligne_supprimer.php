<?php
$title = "Supprimer ligne";
include('header.php');

//Supprimer une ligne
require_once "init.php";

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
    // Redirection vers la liste des pays
    header('Location: utilisateur_note.php');
} else {
    // Formulaire non soumi : lit l'objet métier
    $ligne = $ligneDAO->find($id_ligne);
}
?>

  <h1>User</h1>
  <h2>Supprimer une ligne</h2>
  
  <form action="#" method="post">
  <p>
    <input type="text" name="dat_ligne" id="dat_ligne" value="<?php echo $ligne->get_dat_ligne(); ?>" disabled>
  </p>
  <p>
    <input type="text" name="lib_trajet" id="lib_trajet" value="<?php echo $ligne->get_lib_trajet(); ?>" disabled>
  </p>
  <p>
    <input type="text" name="nb_km" id="nb_km" value="<?php echo $ligne->get_nb_km(); ?>" disabled>
  </p>
  <p>
    <input type="text" name="mt_km" id="mt_km" value="<?php echo $ligne->get_mt_km(); ?>" disabled>
  </p>
  <p>
    <input type="text" name="mt_peage" id="mt_peage" value="<?php echo $ligne->get_mt_peage(); ?>" disabled>
  </p>
  <p>
    <input type="text" name="mt_repas" id="mt_repas" value="<?php echo $ligne->get_mt_repas(); ?>" disabled>
  </p>
  <p>
    <input type="text" name="mt_hebergement" id="mt_hebergement" value="<?php echo $ligne->get_mt_hebergement(); ?>" disabled>
  </p>
  <p>
    <input type="text" name="mt_total" id="mt_total" value="<?php echo $ligne->get_mt_total(); ?>" disabled>
  </p>
  <p>
    <input type="text" name="id_motif" id="id_motif" value="<?php echo $ligne->get_id_motif(); ?>" disabled>
  </p>
  <div>
  <input name="id_ligne" id="id_ligne" type="hidden" value="<?php echo $ligne->get_id_ligne(); ?>" disabled>
  </div>
  <p><input type="submit" value="Supprimer" name="submit"></p>
</form>

  <?php include('footer.php'); ?>