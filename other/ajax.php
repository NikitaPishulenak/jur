<?php

header("Content-Type: text/html; charset=windows-1251");
if(isset($_POST['dateLesson'])){
    echo ' Текущая дата занятия='.$_POST['dateLesson'];
}

if(isset($_POST['typePractice'])){
    echo ' Тип практического занятия='.$_POST['typePractice'];
}

if(isset($_POST['idGroup'])){
    echo ' ИД группы='.$_POST['idGroup'];
}
if(isset($_POST['idSubject'])){
    echo ' ИД предмета='.$_POST['idSubject'];
}

if(isset($_POST['idLesson'])){
    echo ' ИД занятия='.$_POST['idLesson'];
}

if(isset($_POST['typeLesson'])){
    echo ' ИД типа занятия (лк,пз)='.$_POST['typeLesson'];
}

if(isset($_POST['dateLes'])){
    echo ' Дата занятия (не последнего)='.$_POST['dateLes'];
}

if(isset($_POST['typeProcedure'])){
    echo ' Тип процедуры (добавление или редактирование)='.$_POST['typeProcedure'];
}

if(isset($_POST['idStudent'])){
    echo ' ИД студента='.$_POST['idStudent'];
}

if(isset($_POST['grades'])){
    echo ' Оценки в зашифрованном виде='.$_POST['grades'];
}

if(isset($_GET['id_Zapis'])){
    echo'Отметки: 10/5; Исправил: Кульба О.Е. 22.09.2017';

}

?>