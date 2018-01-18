<?php
include_once 'configStudent.php';
include_once 'configMain.php';

$_GET['id_group']=trim(preg_replace('/\s+/', ' ', $_GET['id_group']));
$_GET['Lessons']=trim(preg_replace('/\s+/', ' ', $_GET['Lessons']));
$_GET['PL']=trim(preg_replace('/\s+/', ' ', $_GET['PL']));

if((isset($_GET['id_group'])) && (strlen($_GET['id_group'])==4) && (isset($_GET['Lessons'])) && (strlen($_GET['Lessons'])<=3) && (isset($_GET['PL'])) && (strlen($_GET['PL'])==1)){
    $res = mssql_query("SELECT Name FROM dbo.Groups WHERE IdGroup=".$_GET['id_group'], $dbStud)
    or die("�� ������� ������� ��� ������!");

    list($row) = mssql_fetch_row($res);
    $name_group=$row;

    $query="SELECT lessons.name  FROM lessons WHERE id = ".$_GET['Lessons'];
    $res = mysqli_query($dbMain, $query)
    or die("�� ������� ������� �������� ����������!");

    list($row)=mysqli_fetch_row($res);
    $lessons_name=$row;

    $type_lesson="";
    switch($_GET['PL']){
        case 0:
            $type_lesson="��";
            break;
        case 1:
            $type_lesson="��";
            break;
        default:
            $type_lesson="";
            break;
    }

    $file_name=$name_group."(".translit($lessons_name)."-".translit($type_lesson).").csv";

    $idStudentArray=array(); //������ � id ����������
    $idLessonArray=array(); //������ � id ��������

    $csv_str = '"��. '.$name_group.'"; ����������: '.$lessons_name.' ; '.$type_lesson.';
"�";"���";';

    $query_fio="SELECT IdStud, CONCAT(Name_F,' ',Name_I,' ',Name_O) AS fio FROM dbo.Student WHERE IdGroup=".$_GET['id_group']." AND IdStatus IS NULL ORDER BY Name_F";
    $res = mssql_query($query_fio, $dbStud)
    or die("�� ������� ������� ��� ���������!");
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
    or die("�� ������� ������� ���� �������!");
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
            or die("�� ������� ������� ������!");
            $row=mysqli_fetch_row($res);
            //$csv_str.=$row[0].";";
            $csv_str.=Decrypt($row[0]).";";//������������� ������
        }
        $csv_str .= "\r\n";
    }
    $file = fopen($file_name, "w");

    fwrite($file, trim($csv_str)); // ���������� � ���� ������
    fclose($file);
    header('Content-type: application/csv');
    header("Content-Disposition: inline; filename=$file_name");


    readfile($file_name);
    unlink($file_name);
}
else{
    echo "��������, �� �� ��������� ���� �� ���������!";
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
                return "��";
                break;
            case "21":
                return "��.�";
                break;
            case "22":
                return "��.�.";
                break;
            case "23":
                return "���.";
                break;
            case "24":
                return "�����.";
                break;
            case "25":
                return "�����";
                break;
            case "26":
                return "�";
                break;
            case "27":
                return "���.";
                break;
            case "31":
                return "�1�.";
                break;
            case "32":
                return "�2�.";
                break;
            case "33":
                return "�3�.";
                break;
            case "34":
                return "�4�.";
                break;
            case "35":
                return "�5�.";
                break;
            case "36":
                return "�6�.";
                break;
        }
    }
}

function translit($str) {
    $rus = array('�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', ' ');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', '_');
    return str_replace($rus, $lat, $str);
}
?>
