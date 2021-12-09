<?php
include('init.php'); 
//Liste des ligues existantes
$ligues = New LigueDAO();
$ligues = $ligues->findAll();
//Liste des clubs existantes

//liste des données déjà existantes

$ligue=isset($_POST['id_ligue']) ? $_POST['id_ligue'] : NULL;


	$clubs = New ClubDAO();
    $clubs = $clubs->findClubByLigue($_POST['id_ligue']);
?>
	<option value="">Sélectionnez le club</option>
<?php
	foreach($clubs as $club) {
?>
	<option value="<?php echo $club->get_id_club(); ?>"><?php echo $club->get_lib_club(); ?></option>
<?php
	}
?>