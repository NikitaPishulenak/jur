<?php
$mas=array();
$value="102019";
echo $value;
preg_match_all('/.{2}/', $value, $mas);

for ($i = 0; $i < count($mas[0]); $i++) {
    $mas[0][$i]=MatchDecrypt($mas[0][$i]);
}

$res=implode("/", $mas[0]);
echo $res;


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
