<?php
    function my_autoloader($classe) {
        include 'app/class/'.$classe.'.php';
    }
    spl_autoload_register('my_autoloader');
    
?>