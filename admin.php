<?php
  $title = "Admin";
  include('header.php'); 

  $choix = isset($_POST['choix']) ? $_POST['choix'] : NULL;
  $submit = isset($_POST['submit']) ? $_POST['submit'] : NULL;
  //messages
  $messages = New Messages("error");
  if(isset($submit)){
    if(empty(trim($choix))){
      $messages->add_messages("Choisir une table à recharger");
    }

    if($messages->is_empty() == TRUE){
      //csv dao
      $csv = new Csv($choix);
      $csvDAO = new CsvDAO($csv);
      $csvDAO = $csvDAO->$choix($csv->get_sql());
    }
  }
  
?>

  <h1>Admin</h1>
  <h2>Charger Table</h2>
  <ul>
    <li><a href="admin.php">Charger</a> les tables</li>
    <li><a href="utilisateur_liste.php">Liste</a> des utilisateurs</li>
  </ul>
  <?php 
    if($messages->is_empty() == FALSE){
        $messages->afficher();
    }
  ?>
  <form action="" method="POST">
    <label for="choix">Choix</label><br>
    <select name="choix" id="choix">
      <option value=""selected>--Please choose an option--</option>
      <option value="motif">Motifs</option>
      <option value="ligue">Ligues</option>
      <option value="club">Clubs</option>
    </select><br><br>  
    <input type="submit" name="submit" id="submit" value="Recharger">
  </form>

<?php include('footer.php'); ?>