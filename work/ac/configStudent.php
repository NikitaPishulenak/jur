<?php

ini_set("mssql.datetimeconvert", false);
ini_set("display_errors", 1);

$opStud = array ('host' => '172.20.0.143\serverapp2012','login' => 'for_student','password' => 'fHydbsy27iuehTtskjds','db' => 'Students');

$dbStud=mssql_connect($opStud['host'], $opStud['login'], $opStud['password']) or die ("Îøèáêà: íå ìîãó ñîåäèíèòüñÿ ñ ñåðâåðîì Ñòóäåíòû");
@mssql_select_db($opStud['db'],$dbStud) or die("Íåâîçìîæíî âûáðàòü áàçó äàííûõ íà ñåðâåðå Ñòóäåíòû");

$verS='?v=3'; //‚¥àá¨ï áªà¨¯â®¢ ¤«ï ¯®¤áâ ­®¢ª¨ ¢ html
$verC='?v=5'; //‚¥àá¨ï css ¨ css ¤«ï ¯®¤áâ ­®¢ª¨ ¢ html

?>
