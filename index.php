<?php
   include "autoload.php";
   $db=new sql();
   if($db->is_exist_pseudo('test') == True){
      echo 'oui';
   }else{
      echo 'non';
   }
?>