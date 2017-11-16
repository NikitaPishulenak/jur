<?php

$opMain = array ('host' => 'localhost','login' => 'root','password' => '7781715','db' => 'Labuten');

$dbMain=mysqli_connect($opMain['host'], $opMain['login'], $opMain['password']) or die ("Ошибка: не могу соединиться с сервером Оценок");
@mysqli_select_db($dbMain, $opMain['db']) or die("Невозможно выбрать базу данных на сервере Оценок");
//mysqli_query($dbMain,'SET NAMES UTF8');
mysqli_query($dbMain,'SET NAMES cp1251');

function m_query($query,$con) {
  $result = mysqli_query($con,$query) or die("Что-то пошло не так в основной базе данных.");
  return $result;
} 

?>
