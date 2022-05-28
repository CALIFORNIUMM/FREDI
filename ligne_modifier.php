<?php
  $title = "Modifier ligne";
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
      'id_ligne'=>$id_ligne,
      'lib_trajet'=>$lib_trajet,
      'nb_km'=>$nb_km,
      'mt_peage'=>$mt_peage,
      'mt_repas'=>$mt_repas,
      'mt_hebergement'=>$mt_hebergement,
      'id_motif'=>$id_motif
    ));
      // Modifie l'enregistrement dans la BD
      $ligneDAO->update($ligne);
      // Redirection vers la liste des lignes
      header("Location: adherent.php");
} else {
  // Formulaire non soumi : lit l'objet métier
  $ligne = $ligneDAO->find($id_ligne);
}

?>
<h1>User</h1>
<h2>Modifier Ligne</h2>

<form action="<?= $_SERVER['PHP_SELF'] ?>?id_ligne=<?= $ligne->get_id_ligne() ?>" method="post">

  <label for="lib_trajet">Nom du trajet</label><br>
  <input type="text" name="lib_trajet" id="lib_trajet" value="<?= $ligne->get_lib_trajet() ?>"><br>

  <label for="nb_km">Nombre de kilomètre</label><br>
  <input type="text" name="nb_km" id="nb_km" value="<?= $ligne->get_nb_km() ?>"><br>

  <label for="mt_peage">Montant péage</label><br>
  <input type="text" name="mt_peage" id="mt_peage" value="<?= $ligne->get_mt_peage() ?>"><br>

  <label for="mt_repas">Montant repas</label><br>
  <input type="text" name="mt_repas" id="mt_repas" value="<?= $ligne->get_mt_repas() ?>"><br>

  <label for="mt_hebergement">Montant hebergement</label><br>
  <input type="text" name="mt_hebergement" id="mt_hebergement" value="<?= $ligne->get_mt_hebergement() ?>"><br>
  
  <label for="id_motif">Motif</label><br>
    <select name="id_motif" id="id_motif">
        <option value=""selected>--Please choose an option--</option>
        <?php
            foreach($motifDAO->findAll() as $motif){
                $selectede = NULL;
                if($motif->get_id_motif() == $ligne->get_id_motif()){
                    $selectede = "selected";
                }else{
                    $selectede = NULL;
                }
                echo "<option value=\"".$motif->get_id_motif()."\" $selectede>".$motif->get_lib_motif()."</option>";
            }
        ?>
    </select><br><br>

  <input type="submit" value="Modifier" name="submit"> &nbsp;
  <input type="reset" value="Réinitialiser" name="reset">
</form>

<?php include('footer.php'); ?>
