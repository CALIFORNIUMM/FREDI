<?php
    class Fredi_Errors extends Exception{
        public function __construct($message, $code=255)
        {
            parent::__construct($message, $code);
        }

        public static function e($chaine){
            echo "<p><b>". $chaine ."</b><p>";
        }
    }
?>