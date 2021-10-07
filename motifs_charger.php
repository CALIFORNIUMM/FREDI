<?php
  include('header.php'); 
  $title = "Motifs";

  //csv dao
  $csv = new CsvDAO();
  $csv = $csv->insert('motifs');
?>

  <h1>Application</h1>
  <h2>Charger motifs</h2>

<?php include('footer.php'); ?>