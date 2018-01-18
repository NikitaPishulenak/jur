<?php
include_once 'configMain.php';
mysqli_query($dbMain,'SET NAMES utf8');

switch ($_GET['action']){

    case "showSubjectsFromDB":
        $query="SELECT lessons.name FROM lessons INNER JOIN schedule ON lessons.id=schedule.id_lesson
                WHERE (schedule.course=".$_GET['id_course'].") and (schedule.id_faculty=".$_GET['id_faculty'].") ORDER BY lessons.name ASC";
        $res=mysqli_query($dbMain, $query)
        or die("Не удалось извлечь предметы");

        if(mysqli_num_rows($res)!=0){
            echo '<h3 id="sub_title">Читаемые дисциплины:</h3>';
            echo '<table>';
            while($row=mysqli_fetch_array($res))
            {
                echo '<tr class="sub"><td><button class="del">x</button>'.$row['name'].'</td></tr>';
                //print_r($row['name']);
            }

            echo '</table>';
        }
        else
        {
            echo '<h3 id="sub_title">Выбранное вами сочетание "Факультет"-"Курс" в базе данных не найдено!</h3>';
        }

        break;

//    case "showCityForInsert":
//        echo '<select size="1" name="city">';
//        $queryRep="SELECT * FROM tbl_city WHERE id_region=".$_POST['id_region']." ORDER BY city ASC";
//        $res=mysqli_query($DB, $queryRep)
//        or die("Не удалось извлечь ");
//        while($row=mysqli_fetch_array($res))
//        {
//            echo '<option value="'.$row['id_city'].'">'.$row['city'].'</option>';
//        }
//        echo '</select>';
//        break;

};
?>