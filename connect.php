<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Конференция</title>
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.0.0.min.js"></script>
    <script src="scriptStyle.js"></script>
</head>
<body>

<?php

define("HOST", 'localhost');
define("USER_NAME", 'root');
define("USER_PWD", '');
define("DB_NAME", 'foo');
ini_set('display_errors', '1');
$dbc=mysqli_connect(HOST, USER_NAME, USER_PWD, DB_NAME);
or die("Не удалось подключиться к БД");
mysqli_query($dbc,'SET NAMES utf8');
$queryRep="SELECT id_report FROM reports ORDER BY id_report DESC LIMIT 1";
$res=mysqli_query($dbc, $queryRep)
or die("Не удалось извлечь id report");
$row=mysqli_fetch_row($res);

?>
</body>
</html>


