<?php

$opMain = array ('host' => 'localhost','login' => 'cabStudent','password' => '99dNAPtJ2u7wWHYd','db' => 'Labuten');

$dbMain=mysqli_connect($opMain['host'], $opMain['login'], $opMain['password']) or die ("������: �� ���� ����������� � �������� ������");
@mysqli_select_db($dbMain, $opMain['db']) or die("���������� ������� ���� ������ �� ������� ������");
mysqli_query($dbMain,'SET NAMES cp1251');

?>
