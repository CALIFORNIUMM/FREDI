<?php
    function my_autoloader($classe) {
        include 'app/class/'.$classe.'.php';
    }
    spl_autoload_register('my_autoloader');
    $db = new sql();
    $user1 = New User($db->get_user(1));
    echo $user1->get_nom();

    
?>