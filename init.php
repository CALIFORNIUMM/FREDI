<?php
/**
* Initialisations dans chaque page
*
* @author 
*/

/**
 * Paramétrage pour certains serveurs qui n'affichent pas les erreurs PHP par défaut
 */
ini_set('display_errors', '1');
ini_set('html_errors', '1');

/**
 * Autoload
 * @param string $classe
 */
function my_autoloader($classe) {
  include 'app/class/' . $classe . '.php';
}

spl_autoload_register('my_autoloader');

/**
 * Vide le cache du navigateur
 */
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

/**
 * Paramètre de la base de données
 */
 define('DB_USER','fredi21');
 define('DB_PASSWORD','Limayrac#31');
 define('DB_HOST','localhost');
 define('DB_NAME','fredi21');