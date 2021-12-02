<?php
  $title = "Ajouter ligne";
  include('header.php');

  //Modifier une ligne
  require_once "init.php";

  //Instanciation des DAO
  $ligneDAO = new LigneDAO();
  $motifDAO = new MotifDAO();

  //Récupère l'ID dans l'URL
  $id_ligne = isset($_GET['id_ligne']) ? $_GET['id_ligne'] : null;

  // Lecture du formulaire
  $submit = isset($_POST['submit']);
  if ($submit) {
    //Formulaire soumi
    //Récupère les données du formulaire
    $lib_trajet=isset($_POST['lib_trajet']) ? $_POST['lib_trajet'] :  "";
    $nb_km=isset($_POST['nb_km']) ? $_POST['nb_km'] :  "";
    $mt_peage=isset($_POST['mt_peage']) ? $_POST['mt_peage'] :  "";
    $mt_repas=isset($_POST['mt_repas']) ? $_POST['mt_repas'] :  "";
    $mt_hebergement=isset($_POST['mt_hebergement']) ? $_POST['mt_hebergement'] :  "";
    $id_motif=isset($_POST['id_motif']) ? $_POST['id_motif'] :  "";
    //Créer un objet ligne à l'image des données
    $ligne = new Ligne(array(
      'lib_trajet'=>$lib_trajet,
      'nb_km'=>$nb_km,
      'mt_peage'=>$mt_peage,
      'mt_repas'=>$mt_repas,
      'mt_hebergement'=>$mt_hebergement,
      'id_motif'=>$id_motif
    ));
      // Ajouter l'enregistrement dans la BD
      $ligneDAO->insert($ligne);
      // Redirection vers la liste des lignes
      header("Location: profil.php");
} else {
  // Formulaire non soumi : lit l'objet métier
}

?>
<h1>User</h1>
<h2>Ajouter Ligne</h2>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">

  <label for="lib_trajet">Nom du trajet</label><br>
  <input type="text" name="lib_trajet" id="lib_trajet"><br>

  <label for="nb_km">Nombre de kilomètre</label><br>
  <input type="text" name="nb_km" id="nb_km"><br>

  <label for="mt_peage">Montant péage</label><br>
  <input type="text" name="mt_peage" id="mt_peage"><br>

  <label for="mt_repas">Montant repas</label><br>
  <input type="text" name="mt_repas" id="mt_repas"><br>

  <label for="mt_hebergement">Montant hebergement</label><br>
  <input type="text" name="mt_hebergement" id="mt_hebergement"><br>
  
  <label for="id_motif">Motif</label><br>
    <select name="id_motif" id="id_motif">
        <option value=""selected>--Please choose an option--</option>
        <?php
            foreach($motifDAO->findAll() as $motif){
                echo '<option value="'.$motif->get_lib_motif().'"></option>';
            }
        ?>
    </select><br><br>

  <input type="submit" value="Ajouter" name="submit"> &nbsp;
  <input type="reset" value="Réinitialiser" name="reset">
</form>

<?php include('footer.php'); ?>
