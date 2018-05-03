<?php

$_SESSION['SesVar']['Auth']=false;                  
unset($_SESSION['SesVar']);

    session_start();
    session_unset();
    session_destroy();


    setcookie('login', '', 0, "/");
    setcookie('password', '', 0, "/");
    header('Location: index.php');
    exit;

?>
