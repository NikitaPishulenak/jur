<?php

$_SESSION['SesVar']['Auth']=false;                  
unset($_SESSION['SesVar']);
session_start();
session_unset();
session_destroy();


//header('Refresh: 0;URL=');

header('HTTP/1.1 401 Unauthorized');
echo "До встречи."

?>
