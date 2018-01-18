<?php
unset($_SESSION['SesVar']);
session_start();

if(!isset($_SESSION['SesVar']['Auth']) || $_SESSION['SesVar']['Auth']!==true){
   echo "AisD";
}
?>
