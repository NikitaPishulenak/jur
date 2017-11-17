<?php
include_once '../configMain';


//mysqli_query($dbMain,'SET NAMES utf8');
$dbMain=mysqli_connect(HOST, USER_NAME, USER_PWD, DB_NAME)
or die("Не удалось подключиться к БД");

switch ($_GET['action']){

    case "showSubjectsFromDB":
        //echo '<table>';
        $query="SELECT lessons.name FROM lessons INNER JOIN schedule ON lessons.id=schedule.id_lesson
                WHERE (schedule.course=1) and (schedule.id_faculty=210) ORDER BY lessons.name ASC";
        $res=mysqli_query($dbMain, $query)
        or die("Не удалось извлечь ");
        while($row=mysqli_fetch_array($res))
        {
            print_r($row);
            //echo '<option value="'.$row['id_region'].'">'.$row['region'].'</option>';
        }

        //echo '</table>';
        break;

    case "showCityForInsert":
        echo '<select size="1" name="city">';
        $queryRep="SELECT * FROM tbl_city WHERE id_region=".$_POST['id_region']." ORDER BY city ASC";
        $res=mysqli_query($DB, $queryRep)
        or die("Не удалось извлечь ");
        while($row=mysqli_fetch_array($res))
        {
            echo '<option value="'.$row['id_city'].'">'.$row['city'].'</option>';
        }
        echo '</select>';
        break;

};
?>