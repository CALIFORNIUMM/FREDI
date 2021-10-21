<?php
/**
* Initialisations dans chaque page
*
* @author 
*/
include('app/class/User.php');
include('app/class/Flash.php');
session_start();
/**
 * Paramétrage pour certains serveurs qui n'affichent pas les erreurs PHP par défaut
 */
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', '1');
ini_set('html_errors', '1');
// Autorise les uploads de fichier
ini_set('file_uploads', '1');
// Encodage avec les fonctions mb_*
mb_internal_encoding('UTF-8');
// Force le fuseau de Paris
date_default_timezone_set('Europe/Paris');
// Chemins dans l'OS
define('DS', DIRECTORY_SEPARATOR);   // Séparateur des noms de dossier (dépend de l'OS)
define('ROOT', dirname(__FILE__));  // Racine du site en absolu (à utiliser dans les includes par exemple)

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
 * Session messages flash
 */
//$messages = New Messages();
/**
 * Vide le cache du navigateur
 */
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

/**
 * Paramètre de la base de données
 */
 define('DB_USER','root');
 define('DB_PASSWORD','');
 define('DB_HOST','localhost');
 define('DB_NAME','fredi21');
 
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
