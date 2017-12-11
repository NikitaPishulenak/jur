<?php

$_SESSION['SesVar']['Auth']=false;                  
unset($_SESSION['SesVar']);
session_start();
session_unset();
session_destroy();


//header('Refresh: 0;URL=');
unset($_SERVER['REMOTE_USER'], $_SERVER['PHP_AUTH_PW'],  $_SERVER['PHP_AUTH_USER']);
//   header('WWW-Authenticate: Basic realm="Auth"');
//   header('HTTP/1.0 401 Unauthorized');


//setcookie ("login", "", time()-14800);
//setcookie ("password", "", time()-14800);

echo "До встречи.";
?>
