<?php

ini_set("mssql.datetimeconvert", false);
ini_set("display_errors", 1);

$opStud = array ('host' => '172.20.0.143\serverapp2012','login' => 'for_student','password' => 'fHydbsy27iuehTtskjds','db' => 'Students');

$dbStud=mssql_connect($opStud['host'], $opStud['login'], $opStud['password']) or die ("������: �� ���� ����������� � �������� ��������");
@mssql_select_db($opStud['db'],$dbStud) or die("���������� ������� ���� ������ �� ������� ��������");

$verS='?v=3'; //����� �ਯ⮢ ��� ����⠭���� � html
$verC='?v=5'; //����� css � css ��� ����⠭���� � html

?>
