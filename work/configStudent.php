<?php

ini_set("mssql.datetimeconvert", false);
ini_set("display_errors", 1);

$opStud = array ('host' => '172.20.0.143\serverapp2012','login' => 'forTST','password' => '2726607','db' => 'Students');

$dbStud=mssql_connect($opStud['host'], $opStud['login'], $opStud['password']) or die ("������: �� ���� ����������� � �������� ��������");
@mssql_select_db($opStud['db'],$dbStud) or die("���������� ������� ���� ������ �� ������� ��������");

//function s_query($query) {
//  $result = mssql_query($query,$dbStud) or die("���-�� ����� �� ��� � ���� ������ ��������.");
//  return $result;
//} 

$verS='?v=18'; //����� �ਯ⮢ ��� ����⠭���� � html
$verC='?v=14'; //����� css � css ��� ����⠭���� � html

?>
