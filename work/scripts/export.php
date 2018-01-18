<?php
include_once 'configStudent.php';
include_once 'configMain.php';
//mysqli_query($dbMain,'SET NAMES utf8');


$query_nameGroup="SELECT Name FROM dbo.Groups WHERE IdGroup=".$_GET['id_group'];
$res = mssql_query($query_nameGroup, $dbStud)
or die("Не удалось извлечь имя группы!");

list($row) = mssql_fetch_row($res);
$name_group=$row;


$file_name=$name_group.".csv";

    $idStudentArray=array(); //Массив с id студентами
    $idLessonArray=array(); //Массив с id анятиями
    $csv_str = "гр.".$name_group.';
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
    $query_lesson = "SELECT id, DATE_FORMAT(LDate,'%d.%m.%Y') LDate, nLesson  FROM `lesson` WHERE `idGroup` = ".$_GET['id_group']." and idLessons=".$_GET['Lessons']." and PL=".$_GET['PL']." ORDER BY LDate ASC";
    $res=mysqli_query($dbMain, $query_lesson)
    or die("Не удалось извлечь даты занятий!");
    while ($row = mysqli_fetch_assoc($res)) {
        foreach($row as $key => $value) {
            $value = trim(preg_replace('/\s+/', ' ', $value));
            $row[$key] = htmlspecialchars_decode(str_replace("\"", "\"\"", $value));
        }
        $idLessonArray[]=$row['id'];
        $csv_str.=$row['LDate'].";";
    }
    $csv_str .= "\r\n";
    for($i=0;$i<count($idStudentArray['idStudent']); $i++){
        $csv_str.=($i+1).";".$idStudentArray['studentFIO'][$i].";";
        for($j=0;$j<count($idLessonArray); $j++){
            $query="SELECT RatingO FROM rating WHERE idStud=".$idStudentArray['idStudent'][$i]." and `idLesson`='$idLessonArray[$j]' and del=0 LIMIT 1 ";
            $res=mysqli_query($dbMain, $query)
            or die("Не удалось извлечь оценки!");
            $row=mysqli_fetch_row($res);
            $csv_str.=$row[0].";";
//            $csv_str.=Decrypt($row[0]).";";//расшифрованые оценки
        }
        $csv_str .= "\r\n";
    }
$file = fopen($file_name, "w");
fwrite($file, trim($csv_str)); // записываем в файл строки
fclose($file);
header('Content-type: application/csv; charset=cp-1251');
header("Content-Disposition: inline; filename=$file_name");

//readfile($file_name);
//unlink($file_name);


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
                return "Допуск";
                break;

            case "31":
                return "Н1ч.";
                break;
            case "32":
                return "Н2ч.";
                break;
            case "33":
                return "Н3ч.";
                break;
            case "34":
                return "Н4ч.";
                break;
            case "35":
                return "Н5ч.";
                break;
            case "36":
                return "Н6ч.";
                break;
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="windows-1251">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>
