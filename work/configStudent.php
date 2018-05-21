<?php

ini_set("mssql.datetimeconvert", false);
ini_set("display_errors", 1);

$opStud = array ('host' => '172.20.0.143\serverapp2012','login' => 'forTST','password' => '2726607','db' => 'Students');

$dbStud=mssql_connect($opStud['host'], $opStud['login'], $opStud['password']) or die ("Ошибка: не могу соединиться с сервером Студенты");
@mssql_select_db($opStud['db'],$dbStud) or die("Невозможно выбрать базу данных на сервере Студенты");

//function s_query($query) {
//  $result = mssql_query($query,$dbStud) or die("Что-то пошло не так в базе данных Студенты.");
//  return $result;
//} 

$verS='?v=18'; //‚ҐабЁп бЄаЁЇв®ў ¤«п Ї®¤бв ­®ўЄЁ ў html
$verC='?v=14'; //‚ҐабЁп css Ё css ¤«п Ї®¤бв ­®ўЄЁ ў html

?>
