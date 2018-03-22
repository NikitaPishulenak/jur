<?php
unset($_SESSION['SesVar']);
session_start();

ini_set("display_errors", 1);

if(!isset($_SESSION['SesVar']['Auth']) || $_SESSION['SesVar']['Auth']!==true){
    header('Location: index.php?closet=Время сессии истекло!');
    exit;
}

include_once 'configStudent.php';
include_once 'configMain.php';

$_GET['id_group']=trim(preg_replace('/\s+/', ' ', $_GET['id_group']));
$_GET['Lessons']=trim(preg_replace('/\s+/', ' ', $_GET['Lessons']));
$_GET['PL']=trim(preg_replace('/\s+/', ' ', $_GET['PL']));

if((isset($_GET['id_group'])) && (strlen($_GET['id_group'])==4) && (isset($_GET['Lessons'])) && (strlen($_GET['Lessons'])<=3) && (isset($_GET['PL'])) && (strlen($_GET['PL'])==1)){
    $res = mssql_query("SELECT Name FROM dbo.Groups WHERE IdGroup=".$_GET['id_group'], $dbStud)
    or die("Не удалось извлечь имя группы!");

    list($row) = mssql_fetch_row($res);
    $name_group=$row;

    $query="SELECT lessons.name  FROM lessons WHERE id = ".$_GET['Lessons'];
    $res = mysqli_query($dbMain, $query)
    or die("Не удалось извлечь название дисциплины!");

    list($row)=mysqli_fetch_row($res);
    $lessons_name=$row;

    $type_lesson="";
    switch($_GET['PL']){
        case 0:
            $type_lesson="ПЗ";
            break;
        case 1:
            $type_lesson="ЛК";
            break;
        default:
            $type_lesson="";
            break;
    }

    $file_name=$name_group."(".translit($lessons_name)."-".translit($type_lesson).").csv";

    $idStudentArray=array(); //Массив с id студентами
    $idLessonArray=array(); //Массив с id анятиями

    $csv_str = '"гр. '.$name_group.'"; Дисциплина: '.$lessons_name.' ; '.$type_lesson.';
"№";"ФИО";';

    $query_fio="SELECT IdStud, CONCAT(Name_F,' ',Name_I,' ',Name_O) AS fio FROM dbo.Student WHERE IdGroup=".$_GET['id_group']." AND IdStatus IS NULL ORDER BY Name_F";
    $res = mssql_query($query_fio, $dbStud)
    or die("Не удалось извлечь ФИО студентов!");
    while ($row = mssql_fetch_assoc($res)) {
        foreach($row as $key => $value) {
            $value = trim(preg_replace('/\s+/', ' ', $value));
            $row[$key] = htmlspecialchars_decode(str_replace("\"", "\"\"", $value));
        }
        $idStudentArray['idStudent'][]=$row['IdStud'];
        $idStudentArray['studentFIO'][]=$row['fio'];

    }
    $query_lesson = "SELECT id, PKE, DATE_FORMAT(LDate,'%d.%m.%Y') AS Date_Lesson, nLesson  FROM `lesson` WHERE `idGroup` = ".$_GET['id_group']." and idLessons=".$_GET['Lessons']." and PL=".$_GET['PL']." ORDER BY LDate ASC";
    $res=mysqli_query($dbMain, $query_lesson)
    or die("Не удалось извлечь даты занятий!");
    while ($row = mysqli_fetch_assoc($res)) {
        foreach($row as $key => $value) {
            $value = trim(preg_replace('/\s+/', ' ', $value));
            $row[$key] = htmlspecialchars_decode(str_replace("\"", "\"\"", $value));
        }
        $idLessonArray[]=$row['id'];
        $csv_str.=$row['Date_Lesson'];
        switch ($row['PKE']){
            case 0:
                $csv_str.=";";
                break;
            case 1:
                $csv_str.="(k);";
                break;
            case 2:
                $csv_str.="(a);";
                break;

        }
    }

    $csv_str .= "\r\n";
    for($i=0;$i<count($idStudentArray['idStudent']); $i++){
        $csv_str.=($i+1).";".$idStudentArray['studentFIO'][$i].";";
        for($j=0;$j<count($idLessonArray); $j++){
            $query="SELECT RatingO FROM rating WHERE idStud=".$idStudentArray['idStudent'][$i]." and `idLesson`='$idLessonArray[$j]' and del=0 LIMIT 1 ";
            $res=mysqli_query($dbMain, $query)
            or die("Не удалось извлечь оценки!");
            $row=mysqli_fetch_row($res);
            //$csv_str.=$row[0].";";
            $csv_str.=Decrypt($row[0]).";";//расшифрованые оценки
        }
        $csv_str .= "\r\n";
    }
    $file = fopen("data/".$file_name, "w+");

    fwrite($file, trim($csv_str)); // записываем в файл строки
    fclose($file);
    header('Content-type: application/csv');
    header("Content-Disposition: inline; filename=\"".$file_name."\"");


    readfile("data/".$file_name);
    unlink("data/".$file_name);
}
else{
    echo "Извините, но вы вмешались куда не следовало!";
}




function Decrypt($value)
{
    $mas=array();
    preg_match_all('/.{2}/', $value, $mas);
    for ($i = 0; $i < count($mas[0]); $i++) {
        $mas[0][$i]=MatchDecrypt($mas[0][$i]);
    }
    $res=implode(",", $mas[0]);
    return $res;
}


function MatchDecrypt($val)
{
    if ($val >= 10 && $val < 20) {
        return ($val - 9);
    } else {
        switch ($val) {
            case "20":
                return "Ну";
                break;
            case "21":
                return "Нб.у";
                break;
            case "22":
                return "Нб.о.";
                break;
            case "23":
                return "Зач.";
                break;
            case "24":
                return "Незач.";
                break;
            case "25":
                return "Недоп";
                break;
            case "26":
                return "Н";
                break;
            case "27":
                return "Отр.";
                break;
            case "28":
                return "Доп.";
                break;

            case "31":
                return "Н1";
                break;
            case "32":
                return "Н2";
                break;
            case "33":
                return "Н3";
                break;
            case "34":
                return "Н4";
                break;
            case "35":
                return "Н5";
                break;
            case "36":
                return "Н6";
                break;
            case "37":
                return "Н7";
                break;

            case "40":
                return "Н1.5";
                break;
            case "41":
                return "Н2.5";
                break;
            case "42":
                return "Н3.5";
                break;
            case "43":
                return "Н4.5";
                break;
            case "44":
                return "Н5.5";
                break;
            case "45":
                return "Н6.5";
                break;
        }
    }
}

function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', ' ');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', '_');
    return str_replace($rus, $lat, $str);
}
?>
