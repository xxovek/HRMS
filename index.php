<?php 
error_reporting(E_ALL);
   session_start();
   if(!isset($_SESSION['a_id'])){
      
         header('Location:/Public_html/login.php');
   }
  else{
       header('Location:/Public_html/index.php');
  }
?>
