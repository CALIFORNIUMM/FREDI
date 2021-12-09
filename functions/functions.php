<?php

/**
 * Autoload
 * @param string $classe
 */
function my_autoloader($classe) {
  if(file_exists('app/class/' . $classe . '.php')){
    include 'app/class/' . $classe . '.php';
  }else{
    include 'app/dao/' . $classe . '.php';
  }
    
}

spl_autoload_register('my_autoloader');

/**
 * Chargement CSV
 */
function load_from_csv(string $filename, int $start = 1)
{
    // Ouverture du fichier
    $file_handler = fopen($filename, "r") or exit("<p>Impossible de lire le fichier $filename</p>");
    $nb = 1;
    $rows = array();
    // Boucle de lecture
    while (!feof($file_handler)) {
        $row = fgetcsv($file_handler, 0, ';');
        if ($nb >= $start) {
        $rows[] = $row;
        }
        $nb++;
    }
    // Fermeture du fichier
    fclose($file_handler);
    // Renvoie le tableau PHP
    return $rows;
}

function convertir_date(string $date1)
{
$datetime = DateTime::createFromFormat('d/m/Y', $date1, new DateTimeZone("Europe/Paris"));
$date2 = $datetime->format("Y-m-d");
return $date2;
}

require_once "fpdf/fpdf.php";
require_once "fpdi/src/autoload.php";

?>