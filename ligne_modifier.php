<?php
  $title = "Modifier ligne";
  include('header.php');

  //Modifier une ligne
  require_once "init.php";

  //Instanciation des DAO
  $ligneDAO = new LigneDAO();

  //Récupère l'ID dans l'URL
  $id_ligne = isset($_GET['id_ligne']) ? $_GET['id_ligne'] : null;

  // Lecture du formulaire
  $submit = isset($_POST['submit']);
  if ($submit) {
    //Formulaire soumi
    //Récupère les données du formulaire
    $dat_ligne=isset($_POST['dat_ligne']) ? $_POST['dat_ligne'] :  "";
    $lib_trajet=isset($_POST['lib_trajet']) ? $_POST['lib_trajet'] :  "";
    $nb_km=isset($_POST['nb_km']) ? $_POST['nb_km'] :  "";
    $mt_km=isset($_POST['mt_km']) ? $_POST['mt_km'] :  "";
    $mt_peage=isset($_POST['mt_peage']) ? $_POST['mt_peage'] :  "";
    $mt_repas=isset($_POST['mt_repas']) ? $_POST['mt_repas'] :  "";
    $mt_hebergement=isset($_POST['mt_hebergement']) ? $_POST['mt_hebergement'] :  "";
    $mt_total=isset($_POST['mt_total']) ? $_POST['mt_total'] :  "";
    $id_motif=isset($_POST['id_motif']) ? $_POST['id_motif'] :  "";
    $id_note=isset($_POST['id_note']) ? $_POST['id_note'] :  "";
    //Créer un objet ligne à l'image des données
    $ligne = new Ligne(array(
      'id_ligne'=>$id_ligne,
      'dat_ligne'=>$dat_ligne,
      'lib_trajet'=>$lib_trajet,
      'nb_km'=>$nb_km,
      'mt_km'=>$mt_km,
      'mt_peage'=>$mt_peage,
      'mt_repas'=>$mt_repas,
      'mt_hebergement'=>$mt_hebergement,
      'mt_total'=>$mt_total,
      'id_motif'=>$id_motif,
      'id_note'=>$id_note
    ));
      // Modifie l'enregistrement dans la BD
      $ligneDAO->update($ligne);
      // Redirection vers la liste des lignes
      header("Location: utilisateur_note.php");
} else {
  // Formulaire non soumi : lit l'objet métier
  $ligne = $ligneDAO->find($id_ligne);
}

?>
<h1>User</h1>
<h2>Modifier Ligne</h2>

<form action="#" method="post">
  <p>
    <input type="text" name="dat_ligne" id="dat_ligne" value="<?php echo $ligne->get_dat_ligne(); ?>">
  </p>
  <p>
    <input type="text" name="lib_trajet" id="lib_trajet" value="<?php echo $ligne->get_lib_trajet(); ?>">
  </p>
  <p>
    <input type="text" name="nb_km" id="nb_km" value="<?php echo $ligne->get_nb_km(); ?>">
  </p>
  <p>
    <input type="text" name="mt_km" id="mt_km" value="<?php echo $ligne->get_mt_km(); ?>">
  </p>
  <p>
    <input type="text" name="mt_peage" id="mt_peage" value="<?php echo $ligne->get_mt_peage(); ?>">
  </p>
  <p>
    <input type="text" name="mt_repas" id="mt_repas" value="<?php echo $ligne->get_mt_repas(); ?>">
  </p>
  <p>
    <input type="text" name="mt_hebergement" id="mt_hebergement" value="<?php echo $ligne->get_mt_hebergement(); ?>">
  </p>
  <p>
    <input type="text" name="mt_total" id="mt_total" value="<?php echo $ligne->get_mt_total(); ?>">
  </p>
  <p>
    <input type="text" name="id_motif" id="id_motif" value="<?php echo $ligne->get_id_motif(); ?>">
  </p>
  <div>
  <input name="id_ligne" id="id_ligne" type="hidden" value="<?php echo $ligne->get_id_ligne(); ?>">
  </div>
  <p><input type="submit" value="Modifier" name="submit"></p>
  <p><input type="reset" value="Réinitialiser" name="reset"></p>
</form>

<?php include('footer.php'); ?>
