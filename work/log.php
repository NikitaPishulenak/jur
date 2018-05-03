<?php
unset($_SESSION['SesVar']);
session_start();

if (!isset($_SESSION['SesVar']['Auth']) || $_SESSION['SesVar']['Auth'] !== true) {
   echo "Access is denied!";
   exit;
}

    include_once 'configMain.php';
    $res = mysqli_query($dbMain, "SELECT DATE_FORMAT(CONCAT(A.DateO,' ',A.TimeO),'%e.%m.%Y в %H:%i'), A.RatingO, (SELECT B.fio FROM employees2 B WHERE B.id=A.idEmployess) FROM rating A WHERE A.id=".$_GET['idZapis']." AND A.idStud=".$_GET['idStudent']);
    if (mysqli_num_rows($res) >= 1) {
        $arr = mysqli_fetch_row($res);
        $retV="<div class='inLog'><div class='oLog'><span class='gLog'>".$arr[1]."</span>&nbsp;&nbsp; ".$arr[0]."</div><div class='fLog'>".$arr[2]."</div></div>";
            $res = mysqli_query($dbMain, "SELECT DATE_FORMAT(CONCAT(A.DateO,' ',A.TimeO),'%e.%m.%Y в %H:%i'), A.RatingO, (SELECT B.fio FROM employees2 B WHERE B.id=A.idEmployess) FROM logi A WHERE A.idRating=".$_GET['idZapis']." AND A.idStud=".$_GET['idStudent']." ORDER BY CONCAT(A.DateO,' ',A.TimeO) DESC");
            if (mysqli_num_rows($res) >= 1) {
               while($arr = mysqli_fetch_row($res)){
                 $retV.="<div class='inLog'><div class='oLog'><span class='gLog'>".$arr[1]."</span>&nbsp;&nbsp;  ".$arr[0]."</div><div class='fLog'>".$arr[2]."</div></div>";
               }
            }
        echo $retV;
        mysqli_free_result($res);
    } else {
      echo "<div class='inLog'>Произошёл сбой!</div>";
    }

?>