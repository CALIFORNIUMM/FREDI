<?php
    function my_autoloader($classe) {
        include 'app/class/'.$classe.'.php';
    }
    spl_autoload_register('my_autoloader');
    $db = new sql();
    $reponse = $db->select_all('utilisateur');
    
?>