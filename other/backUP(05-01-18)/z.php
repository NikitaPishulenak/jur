<?php
unset($_SESSION['SesVar']);
session_start();

if (!isset($_SESSION['SesVar']['Auth']) || $_SESSION['SesVar']['Auth'] !== true) {
    echo "Access is denied!";
    exit;
}

$Nepuschu = 0;
$countLev = count($_SESSION['SesVar']['Level']);
for ($ii = 0; $ii <= ($countLev - 1); $ii++) {
    if ($_SESSION['SesVar']['Level'][$ii] == 4) $Nepuschu = 1;
}

if (!$Nepuschu) {
    echo "����������� ������� �������! ��������.";
    exit;
}


if (isset($_GET['menuactiv'])) {
    switch ($_GET['menuactiv']) {

        case "deleteGrade":
            delLess();
            break;

        case "addLesson":
            addLess();
            break;

        case "editDate":
            edtLess();
            break;

        case "editLessonStudent":
            edtLessonStudent();
            break;

        case "addLessonStudent":
            addLessonStudent();
            break;

        case "goG":
            if ($_GET['PL'] == 0) {
                GroupViewP();
            } else if ($_GET['PL'] == 1) {
                GroupViewL();
            }
            break;

        case "goF":
            Fakultet();
            break;

        default:
            MainF();
            break;
    }
} else {
    MainF();
}


//----------------------------------------------------------------------------------------------


function delLess()
{
    include_once 'configMain.php';
    mysqli_query($dbMain, "UPDATE rating SET del=1 WHERE del=0 AND idLesson=".$_GET['idLesson']." AND idStud=".$_GET['idStud']);
}


function edtLess()
{
    include_once 'configMain.php';
    $dt = explode(".", $_GET['Date']);
    mysqli_query($dbMain, "UPDATE lesson SET LDate='".$dt[2]."-".$dt[1]."-".$dt[0]."', PKE=".$_GET['PKE'].", nLesson=".$_GET['numberThemeLesson']." WHERE id=".$_GET['idLesson']." AND idGroup=".$_GET['idGroup']);
    mysqli_query($dbMain, "UPDATE rating SET DateO='" . $dt[2] . "-" . $dt[1] . "-" . $dt[0] . "', PKE=" . $_GET['PKE'] . " WHERE del=0 AND idLesson=" . $_GET['idLesson']);
}


function edtLessonStudent()
{
    include_once 'configMain.php';
    $resTime = mysqli_query($dbMain, "SELECT TIMESTAMPDIFF(MINUTE, CONCAT(DateO, ' ', TimeO), NOW()), idLessons, idLesson, DateO, TimeO, RatingO, idEmployess FROM rating WHERE del=0 AND id=" . $_GET['id_Zapis'] . " AND idStud=" . $_GET['idStudent']);
    if (mysqli_num_rows($resTime) >= 1) {
        $arr = mysqli_fetch_row($resTime);
        if($arr[6]!=$_SESSION['SesVar']['FIO'][0] || $arr[0] > 10){
            mysqli_query($dbMain, "INSERT INTO logi (idRating,idLessons,idLesson,idStud,DateO,TimeO,RatingO,idEmployess) VALUES (" . $_GET['id_Zapis'] . "," . $arr[1] . "," . $arr[2] . "," . $_GET['idStudent'] . ",'" . $arr[3] . "','" . $arr[4] . "'," . $arr[5] . "," . $arr[6] . ")");
            mysqli_query($dbMain, "UPDATE rating SET DateO=CURDATE(), TimeO=CURTIME(), RatingO=" . $_GET['grades'] . ", idEmployess=" . $_SESSION['SesVar']['FIO'][0] . " WHERE del=0 AND id=" . $_GET['id_Zapis'] . " AND idStud=" . $_GET['idStudent']);
        } else {
            mysqli_query($dbMain, "UPDATE rating SET RatingO=" . $_GET['grades'] . ", idEmployess=" . $_SESSION['SesVar']['FIO'][0] . " WHERE del=0 AND id=" . $_GET['id_Zapis'] . " AND idStud=" . $_GET['idStudent']);
        }
        mysqli_free_result($resTime);
    }
}


function addLessonStudent()
{
    include_once 'configMain.php';
    $dt = explode(".", $_GET['dateLes']);

    mysqli_query($dbMain, "INSERT INTO rating (idLessons,idStud,PL,PKE,DateO,TimeO,RatingO,idEmployess,idLesson) VALUES (" . $_GET['idLessons'] . "," . $_GET['idStudent'] . "," . $_GET['PL'] . "," . $_GET['PKE'] . ",'" . $dt[2] . "-" . $dt[1] . "-" . $dt[0] . "',CURTIME()," . $_GET['grades'] . "," . $_SESSION['SesVar']['FIO'][0] . "," . $_GET['idLess'] . ")");
    echo mysqli_insert_id($dbMain);
}


function addLess()
{
    include_once 'configMain.php';
    $dt = explode(".", $_GET['dateLesson']);
    mysqli_query($dbMain, "INSERT INTO lesson (LDate,idGroup,idLessons,PL,PKE,nLesson) VALUES ('" . $dt[2] . "-" . $dt[1] . "-" . $dt[0] . "'," . $_GET['idGroup'] . "," . $_GET['idLessons'] . "," . $_GET['PL'] . "," . $_GET['PKE'] . ",".$_GET['numberThemeLesson'].")");
    echo mysqli_insert_id($dbMain);

    mysqli_free_result($result);
}


//----------------------------------------------------------------------------------------------



function GroupViewL()
{

    include_once 'configStudent.php';
    include_once 'configMain.php';
    $retVal = "<p>" . $_SESSION['SesVar']['Zav'][0] . " (" . $_SESSION['SesVar']['Zav'][1] . ")</p>";

    $retVal .= "<h3><a href='z.php'>" . $_GET['nPredmet'] . "</a><br>&nbsp;<font color='#ff0000'>&darr;</font><br>";
    $retVal .= "<a href='z.php?menuactiv=goF&idPrepod=" . $_SESSION['SesVar']['FIO'][0] . "&idKaf=" . $_SESSION['SesVar']['Zav'][2] . "&idPredmet=" . $_GET['idPredmet'] . "&idF=" . $_GET['idF'] . "'>" . $_GET['nF'] . "</a><br>&nbsp;<font color='#ff0000'>&darr;</font><br>";

    $retVal .= "������ � " . $_GET['nGroup'] . " (<a href='z.php?menuactiv=goG&idPrepod=" . $_SESSION['SesVar']['FIO'][0] . "&idKaf=" . $_SESSION['SesVar']['Zav'][2] . "&idPredmet=" . $_GET['idPredmet'] . "&idF=" . $_GET['idF'] . "&idGroup=" . $_GET['idGroup'] . "&PL=0&nPredmet=" . $_GET['nPredmet'] . "&nF=" . $_GET['nF'] . "&nGroup=" . $_GET['nGroup'] . "'>������������</a> / ������)</h3><hr>";


    $retVal .= "
    <input type='hidden' id='idSubject' value='" . $_GET['idPredmet'] . "'>
    <input type='hidden' id='idPrepod' value='" . $_GET['idPrepod'] . "'>
    <input type='hidden' id='idGroup' value='" . $_GET['idGroup'] . "'>
    <input type='hidden' id='idPL' value='1'>";

    $result = mssql_query("SELECT IdStud, CONCAT(Name_F,' ',Name_I,' ',Name_O) FROM dbo.Student WHERE IdGroup=" . $_GET['idGroup'] . " AND IdStatus IS NULL ORDER BY Name_F", $dbStud);
    $resultL = mysqli_query($dbMain, "SELECT id, LDate, PKE, DATE_FORMAT(LDate,'%e.%m.%Y'), nLesson FROM lesson WHERE idGroup=" . $_GET['idGroup'] . " AND idLessons=" . $_GET['idPredmet'] . " AND PL=1 ORDER BY LDate,id");

    if (mysqli_num_rows($resultL) >= 1) {
        $preStud = "";
        $preRating = "";

        if (mssql_num_rows($result) >= 1) {
            $arrStud = Array();
            $i = 0;
            while ($arrS = mssql_fetch_row($result)) {
                $preStud .= "<div class='fio_student' data-idStudent='" . $arrS[0] . "'>" . ($i + 1) . ". " . $arrS[1] . "</div>\n";
                $arrStud[$i] = $arrS[0];
                if (!$i) {
                    $sqlStud = "idStud=" . $arrS[0] . "";
                } else {
                    $sqlStud .= " OR idStud=" . $arrS[0] . "";
                }
                $i++;
            }
            $countarrStud = count($arrStud);

            if (mysqli_num_rows($resultL) >= 1) {
                while ($arr = mysqli_fetch_row($resultL)) {
                    $prepreRating = "";
                    switch ($arr[2]) {
                        case 1:
                            $prepreRating .= "<div class='date_col colloquium_theme'>".($arr[4] ? "<div class='nLesson'>".$arr[4]."</div>" : "")."<div class='date_title' data-idLesson='".$arr[0]."' data-number_theme_lesson='".$arr[4]."'>".$arr[3]."</div>\n";
                            break;
                        case 2:
                            $prepreRating .= "<div class='date_col exam_theme'>".($arr[4] ? "<div class='nLesson'>".$arr[4]."</div>" : "")."<div class='date_title' data-idLesson='".$arr[0]."' data-number_theme_lesson='".$arr[4]."'>".$arr[3]."</div>\n";
                            break;
                        default:
                            $prepreRating .= "<div class='date_col'>".($arr[4] ? "<div class='nLesson'>".$arr[4]."</div>" : "")."<div class='date_title' data-idLesson='".$arr[0]."' data-number_theme_lesson='".$arr[4]."'>".$arr[3]."</div>\n";
                            break;
                    }
                    $resultS = mysqli_query($dbMain, "SELECT id, idStud, RatingO FROM rating WHERE del=0 AND (" . $sqlStud . ") AND PKE=" . $arr[2] . " AND idLesson=" . $arr[0] . " AND idLessons=" . $_GET['idPredmet'] . " AND PL=1");
                    $arrSStud = Array();
                    if (mysqli_num_rows($resultS) >= 1) {
                        $ii = 0;
                        while ($arrSS = mysqli_fetch_row($resultS)) {
                            $arrSStud[$ii] = array($arrSS[0], $arrSS[1], $arrSS[2]);
                            $ii++;
                        }
                    }
                    mysqli_free_result($resultS);

                    $countSStud = count($arrSStud);
                    for ($iS = 0; $iS <= ($countarrStud - 1); $iS++) {
                        $trueS = 0;
                        for ($iSS = 0; $iSS <= ($countSStud - 1); $iSS++) {
                            if ($arrStud[$iS] == $arrSStud[$iSS][1]) {
                                $prepreRating .= "<div class='grade' data-idLes=" . $arr[0] . " data-idStudent=" . $arrStud[$iS] . " data-PKE=" . $arr[2] . " data-zapis=" . $arrSStud[$iSS][0] . ">" . $arrSStud[$iSS][2] . "</div>\n";
                                $trueS = 1;
                            }
                        }
                        if (!$trueS) {
                            $prepreRating .= "<div class='grade' data-idLes=" . $arr[0] . " data-idStudent=" . $arrStud[$iS] . " data-PKE=" . $arr[2] . " data-zapis=0></div>\n";
                        }
                    }

                    $preRating .= $prepreRating . "</div>\n";
                }
            }

        }

        $retVal .= StudentViewL($preStud, $preRating);

    } else {
        if (mssql_num_rows($result) >= 1) {
            $preStud = "";
            $i = 1;
            while ($arrStud = mssql_fetch_row($result)) {
                $preStud .= "<div class='fio_student' data-idStudent='" . $arrStud[0] . "'>" . $i . ". " . $arrStud[1] . "</div>\n";
                $i++;
            }
            $retVal .= StudentViewL($preStud);
        }
    }

    mssql_free_result($result);
    mysqli_free_result($resultL);


    echo HeaderFooterGroupL($retVal, "� " . $_GET['nGroup'], $verC, $verS);
}




function GroupViewP()
{
    include_once 'configStudent.php';
    include_once 'configMain.php';
    $retVal = "<p>" . $_SESSION['SesVar']['Zav'][0] . " (" . $_SESSION['SesVar']['Zav'][1] . ")</p>";

    $retVal .= "<h3><a href='z.php'>" . $_GET['nPredmet'] . "</a><br>&nbsp;<font color='#ff0000'>&darr;</font><br>";
    $retVal .= "<a href='z.php?menuactiv=goF&idPrepod=" . $_SESSION['SesVar']['FIO'][0] . "&idKaf=" . $_SESSION['SesVar']['Zav'][2] . "&idPredmet=" . $_GET['idPredmet'] . "&idF=" . $_GET['idF'] . "'>" . $_GET['nF'] . "</a><br>&nbsp;<font color='#ff0000'>&darr;</font><br>";

    $retVal .= "������ � " . $_GET['nGroup'] . " (������������ / <a href='z.php?menuactiv=goG&idPrepod=" . $_SESSION['SesVar']['FIO'][0] . "&idKaf=" . $_SESSION['SesVar']['Zav'][2] . "&idPredmet=" . $_GET['idPredmet'] . "&idF=" . $_GET['idF'] . "&idGroup=" . $_GET['idGroup'] . "&PL=1&nPredmet=" . $_GET['nPredmet'] . "&nF=" . $_GET['nF'] . "&nGroup=" . $_GET['nGroup'] . "'>������</a>)</h3><hr>";


    $retVal .= "
    <input type='hidden' id='idSubject' value='" . $_GET['idPredmet'] . "'>
    <input type='hidden' id='idPrepod' value='" . $_GET['idPrepod'] . "'>
    <input type='hidden' id='idGroup' value='" . $_GET['idGroup'] . "'>
    <input type='hidden' id='idPL' value='0'>";

    $result = mssql_query("SELECT IdStud, CONCAT(Name_F,' ',Name_I,' ',Name_O) FROM dbo.Student WHERE IdGroup=" . $_GET['idGroup'] . " AND IdStatus IS NULL ORDER BY Name_F", $dbStud);
    $resultL = mysqli_query($dbMain, "SELECT id, LDate, PKE, DATE_FORMAT(LDate,'%e.%m.%Y'), nLesson FROM lesson WHERE idGroup=" . $_GET['idGroup'] . " AND idLessons=" . $_GET['idPredmet'] . " AND PL=0 ORDER BY LDate,id");

    if (mysqli_num_rows($resultL) >= 1) {
        $preStud = "";
        $preRating = "";

        if (mssql_num_rows($result) >= 1) {
            $arrStud = Array();
            $i = 0;
            while ($arrS = mssql_fetch_row($result)) {
                $preStud .= "<div class='fio_student' data-idStudent='" . $arrS[0] . "'>" . ($i + 1) . ". " . $arrS[1] . "</div>\n";
                $arrStud[$i] = $arrS[0];
                if (!$i) {
                    $sqlStud = "idStud=" . $arrS[0] . "";
                } else {
                    $sqlStud .= " OR idStud=" . $arrS[0] . "";
                }
                $i++;
            }
            $countarrStud = count($arrStud);

            if (mysqli_num_rows($resultL) >= 1) {
                while ($arr = mysqli_fetch_row($resultL)) {
                    $prepreRating = "";
                    switch ($arr[2]) {
                        case 1:
                            $prepreRating .= "<div class='date_col colloquium_theme'>".($arr[4] ? "<div class='nLesson'>".$arr[4]."</div>" : "")."<div class='date_title' data-idLesson='" . $arr[0] . "' data-number_theme_lesson='".$arr[4]."'>".$arr[3]."</div>\n";
                            break;
                        case 2:
                            $prepreRating .= "<div class='date_col exam_theme'>".($arr[4] ? "<div class='nLesson'>".$arr[4]."</div>" : "")."<div class='date_title' data-idLesson='" . $arr[0] . "' data-number_theme_lesson='".$arr[4]."'>".$arr[3]."</div>\n";
                            break;
                        default:
                            $prepreRating .= "<div class='date_col'>".($arr[4] ? "<div class='nLesson'>".$arr[4]."</div>" : "")."<div class='date_title' data-idLesson='".$arr[0]."' data-number_theme_lesson='".$arr[4]."'>".$arr[3]."</div>\n";
                            break;
                    }
                    $resultS = mysqli_query($dbMain, "SELECT id, idStud, RatingO FROM rating WHERE del=0 AND (" . $sqlStud . ") AND PKE=" . $arr[2] . " AND idLesson=" . $arr[0] . " AND idLessons=" . $_GET['idPredmet'] . " AND PL=0");
                    $arrSStud = Array();
                    if (mysqli_num_rows($resultS) >= 1) {
                        $ii = 0;
                        while ($arrSS = mysqli_fetch_row($resultS)) {
                            $arrSStud[$ii] = array($arrSS[0], $arrSS[1], $arrSS[2]);
                            $ii++;
                        }
                    }
                    mysqli_free_result($resultS);

                    $countSStud = count($arrSStud);
                    for ($iS = 0; $iS <= ($countarrStud - 1); $iS++) {
                        $trueS = 0;
                        for ($iSS = 0; $iSS <= ($countSStud - 1); $iSS++) {
                            if ($arrStud[$iS] == $arrSStud[$iSS][1]) {
                                $prepreRating .= "<div class='grade' data-idLes=" . $arr[0] . " data-idStudent=" . $arrStud[$iS] . " data-PKE=" . $arr[2] . " data-zapis=" . $arrSStud[$iSS][0] . ">" . $arrSStud[$iSS][2] . "</div>\n";
                                $trueS = 1;
                            }
                        }
                        if (!$trueS) {
                            $prepreRating .= "<div class='grade' data-idLes=" . $arr[0] . " data-idStudent=" . $arrStud[$iS] . " data-PKE=" . $arr[2] . " data-zapis=0></div>\n";
                        }
                    }

                    $preRating .= $prepreRating . "</div>\n";
                }
            }

        }

        $retVal .= StudentView($preStud, $preRating);

    } else {
        if (mssql_num_rows($result) >= 1) {
            $preStud = "";
            $i = 1;
            while ($arrStud = mssql_fetch_row($result)) {
                $preStud .= "<div class='fio_student' data-idStudent='" . $arrStud[0] . "'>" . $i . ". " . $arrStud[1] . "</div>\n";
                $i++;
            }
            $retVal .= StudentView($preStud);
        }
    }

    mssql_free_result($result);
    mysqli_free_result($resultL);


    echo HeaderFooterGroup($retVal, "� " . $_GET['nGroup'], $verC, $verS);
}


//----------------------------------------------------------------------------------------------


function Fakultet()
{
    include_once 'configStudent.php';
    include_once 'configMain.php';
    include_once 'config.php';

    $retVal = "<p>".$_SESSION['SesVar']['Zav'][0]." (".$_SESSION['SesVar']['Zav'][1].")</a></p>";

    $resPredmet = mysqli_query($dbMain, "SELECT name FROM lessons WHERE id=" . $_GET['idPredmet'] . "");
    if (mysqli_num_rows($resPredmet) >= 1) {
        list($Pre) = mysqli_fetch_row($resPredmet);

        if ($_GET['idF'] == 233) {
            $rescourse = mysqli_query($dbMain, "SELECT course,id_faculty FROM schedule WHERE id_lesson=".$_GET['idPredmet']);
        } else {
            $rescourse = mysqli_query($dbMain, "SELECT course FROM schedule WHERE id_lesson=".$_GET['idPredmet']." AND id_faculty=".$_GET['idF']);
        }
        if (mysqli_num_rows($rescourse) >= 1) {
            if ($_GET['idF'] == 283) {
                $i = 0;
                while (list($arrS) = mysqli_fetch_row($rescourse)) {
                    if (!$i) {
                        $sqlSr = "SUBSTRING(Name,2,1)='".$arrS."'";
                        $sqlS = "LEFT(Name,2)='".$fac[$_GET['idF']][0].$arrS."'";
                        $sqlSS = "LEFT(Name,2)='".$fac[$_GET['idF']][2].$arrS."'";
                        $i=1;
                    } else {
                        $sqlSr.=" OR SUBSTRING(Name,2,1)='".$arrS."'";
                        $sqlS.=" OR LEFT(Name,2)='".$fac[$_GET['idF']][0].$arrS."'";
                        $sqlSS.=" OR LEFT(Name,2)='".$fac[$_GET['idF']][2].$arrS."'";
                    }
                }
                $sqlSO="((IdF=".$_GET['idF']." AND (".$sqlSr.") AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<".$fac[$_GET['idF']][1]." AND LEN(Name)>=4) OR ((".$sqlS.") AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<=".$fac[$_GET['idF']][1]." AND LEN(Name)>=4)) OR ((IdF=".$_GET['idF']." AND (".$sqlSr.") AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<".$fac[$_GET['idF']][3]." AND LEN(Name)>=4) OR ((".$sqlSS.") AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<=".$fac[$_GET['idF']][3]." AND LEN(Name)>=4))";
            } else if($_GET['idF'] == 233){
                $i = 0;
                while ($arrS = mysqli_fetch_row($rescourse)) {
                    if (!$i) {
                        $sqlS = "LEFT(Name,2)='".$fac[$arrS[1]][0].$arrS[0]."'";
                        $i=1;
                    } else {
                        $sqlS.=" OR LEFT(Name,2)='".$fac[$arrS[1]][0].$arrS[0]."'";
                    }
                }
                $sqlSO="(IdF=".$_GET['idF']." AND (".$sqlS.") AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<".$fac[$_GET['idF']][1]." AND LEN(Name)>=4)";
            } else {
                $i = 0;
                while (list($arrS) = mysqli_fetch_row($rescourse)) {
                    if (!$i) {
                        $sqlSr = "SUBSTRING(Name,2,1)='".$arrS."'";
                        $sqlS = "LEFT(Name,2)='".$fac[$_GET['idF']][0].$arrS."'";
                        $i=1;
                    } else {
                        $sqlSr.=" OR SUBSTRING(Name,2,1)='".$arrS."'";
                        $sqlS.=" OR LEFT(Name,2)='".$fac[$_GET['idF']][0].$arrS."'";
                    }
                }
                $sqlSO="(IdF=".$_GET['idF']." AND (".$sqlSr.") AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<".$fac[$_GET['idF']][1]." AND LEN(Name)>=4) OR ((".$sqlS.") AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<=".$fac[$_GET['idF']][1]." AND LEN(Name)>=4)";
            }
        } else {
            if ($_GET['idF'] == 283) {
                $sqlSO="((IdF=".$_GET['idF']." AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<".$fac[$_GET['idF']][1]." AND LEN(Name)>=4) OR (LEFT(Name,1)='".$fac[$_GET['idF']][0]."' AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<=".$fac[$_GET['idF']][1]." AND LEN(Name)>=4)) OR ((IdF=".$_GET['idF']." AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<".$fac[$_GET['idF']][3]." AND LEN(Name)>=4) OR (LEFT(Name,1)='".$fac[$_GET['idF']][2]."' AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<=".$fac[$_GET['idF']][3]." AND LEN(Name)>=4))";
            } else {
                $sqlSO="(IdF=".$_GET['idF']." AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<".$fac[$_GET['idF']][1]." AND LEN(Name)>=4) OR (LEFT(Name,1)='".$fac[$_GET['idF']][0]."' AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<=".$fac[$_GET['idF']][1]." AND LEN(Name)>=4)";
            }
        }

        $retVal .= "<h3><a href='z.php'>$Pre</a><br>&nbsp;<font color='#ff0000'>&darr;</font><br>";
        $result = mssql_query("SELECT Name FROM dbo.Facultets WHERE IdF=" . $_GET['idF'] . "", $dbStud);
        if (mssql_num_rows($result) >= 1) {
            list($idName) = mssql_fetch_row($result);
            $retVal .= "$idName</h3><hr>";


            $retVal .= "
      <div class='DialogP'>
      <div class='titleBox'><H2>������</H2></div>
      ";
            $result = mssql_query("SELECT IdGroup, Name FROM dbo.Groups WHERE ".$sqlSO." ORDER BY Name", $dbStud);
            if (mssql_num_rows($result) >= 1) {
                $preChar = "";
                while ($arr = mssql_fetch_row($result)) {
                    if ($preChar != substr($arr[1], 0, 2)) $retVal .= "<div class='HRnext'></div>";
                    $preChar = substr($arr[1], 0, 2);
                    $retVal .= "<div class='DialogGr'><strong>" . $arr[1] . "</strong><div class='GroupPL'>";
                    $retVal .= "<a href='z.php?menuactiv=goG&idPrepod=".$_SESSION['SesVar']['FIO'][0]."&idKaf=".$_SESSION['SesVar']['Zav'][2]."&idPredmet=" . $_GET['idPredmet'] . "&idF=" . $_GET['idF'] . "&idGroup=" . $arr[0] . "&PL=0&nPredmet=" . $Pre . "&nF=" . $idName . "&nGroup=" . $arr[1] . "'>�����.</a>&nbsp;&nbsp;&nbsp;";
                    $retVal .= "<a href='z.php?menuactiv=goG&idPrepod=".$_SESSION['SesVar']['FIO'][0]."&idKaf=".$_SESSION['SesVar']['Zav'][2]."&idPredmet=" . $_GET['idPredmet'] . "&idF=" . $_GET['idF'] . "&idGroup=" . $arr[0] . "&PL=1&nPredmet=" . $Pre . "&nF=" . $idName . "&nGroup=" . $arr[1] . "'>������</a>";
                    $retVal .= "</div></div></div>\n";
                }
            }
            $retVal .= "</div>";


        }
    }

    unset($sqlSO, $sqlS, $sqlSr, $sqlSS);
    mssql_free_result($result);
    mysqli_free_result($resPredmet);

    echo HeaderFooter($retVal, $_SESSION['SesVar']['Zav'][0]."(".$_SESSION['SesVar']['Zav'][1].")", $verC);
}

/*
function Fakultet()
{
    include_once 'configStudent.php';
    include_once 'configMain.php';
    include_once 'config.php';

    $retVal = "<p>" . $_SESSION['SesVar']['Zav'][0] . " (" . $_SESSION['SesVar']['Zav'][1] . ")</p>";

    $resPredmet = mysqli_query($dbMain, "SELECT name FROM lessons WHERE id=" . $_GET['idPredmet'] . "");
    if (mysqli_num_rows($resPredmet) >= 1) {
        list($Pre) = mysqli_fetch_row($resPredmet);
        $retVal .= "<h3><a href='z.php'>$Pre</a><br>&nbsp;<font color='#ff0000'>&darr;</font><br>";
        $result = mssql_query("SELECT Name FROM dbo.Facultets WHERE IdF=" . $_GET['idF'] . "", $dbStud);
        if (mssql_num_rows($result) >= 1) {
            list($idName) = mssql_fetch_row($result);
            $retVal .= "$idName</h3><hr>";


            $retVal .= "
      <div class='DialogP'>
      <div class='titleBox'><H2>������</H2></div>
      ";
            if ($_GET['idF'] == 283) {
                $result = mssql_query("SELECT IdGroup, Name FROM dbo.Groups WHERE ((IdF=" . $_GET['idF'] . " AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<" . $fac[$_GET['idF']][1] . " AND LEN(Name)>=4) OR (LEFT(Name,1)='" . $fac[$_GET['idF']][0] . "' AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<=" . $fac[$_GET['idF']][1] . " AND LEN(Name)>=4)) OR ((IdF=" . $_GET['idF'] . " AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<" . $fac[$_GET['idF']][3] . " AND LEN(Name)>=4) OR (LEFT(Name,1)='" . $fac[$_GET['idF']][2] . "' AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<=" . $fac[$_GET['idF']][3] . " AND LEN(Name)>=4)) ORDER BY Name", $dbStud);
            } else {
                $result = mssql_query("SELECT IdGroup, Name FROM dbo.Groups WHERE (IdF=" . $_GET['idF'] . " AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<" . $fac[$_GET['idF']][1] . " AND LEN(Name)>=4) OR (LEFT(Name,1)='" . $fac[$_GET['idF']][0] . "' AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<=" . $fac[$_GET['idF']][1] . " AND LEN(Name)>=4) ORDER BY Name", $dbStud);
            }
            if (mssql_num_rows($result) >= 1) {
                $preChar = "";
                while ($arr = mssql_fetch_row($result)) {
                    if ($preChar != substr($arr[1], 0, 2)) $retVal .= "<div class='HRnext'></div>";
                    $preChar = substr($arr[1], 0, 2);
                    $retVal .= "<div class='DialogGr'><strong>" . $arr[1] . "</strong><div class='GroupPL'>";
                    $retVal .= "<a href='z.php?menuactiv=goG&idPrepod=" . $_SESSION['SesVar']['FIO'][0] . "&idKaf=" . $_SESSION['SesVar']['Zav'][2] . "&idPredmet=" . $_GET['idPredmet'] . "&idF=" . $_GET['idF'] . "&idGroup=" . $arr[0] . "&PL=0&nPredmet=" . $Pre . "&nF=" . $idName . "&nGroup=" . $arr[1] . "'>�����.</a>&nbsp;&nbsp;&nbsp;";
                    $retVal .= "<a href='z.php?menuactiv=goG&idPrepod=" . $_SESSION['SesVar']['FIO'][0] . "&idKaf=" . $_SESSION['SesVar']['Zav'][2] . "&idPredmet=" . $_GET['idPredmet'] . "&idF=" . $_GET['idF'] . "&idGroup=" . $arr[0] . "&PL=1&nPredmet=" . $Pre . "&nF=" . $idName . "&nGroup=" . $arr[1] . "'>������</a>";
                    $retVal .= "</div></div></div>\n";
                }
            }

            $retVal .= "</div>";


        }
    }

    mssql_free_result($result);
    mysqli_free_result($resPredmet);

    echo HeaderFooter($retVal, $_SESSION['SesVar']['Zav'][0] . " (" . $_SESSION['SesVar']['Zav'][1] . ")", $verC);
}
*/

//----------------------------------------------------------------------------------------------

function MainF()
{
    $retVal = "<p>" . $_SESSION['SesVar']['Zav'][0] . " (" . $_SESSION['SesVar']['Zav'][1] . ")</p><hr>";

    $countPredmet = count($_SESSION['SesVar']['PredmetZav']);
    $retVal .= "
      <div class='DialogP'>
      <div class='titleBox'><H2>����������</H2></div>
   ";

    include_once 'configStudent.php';

    for ($ii = 0; $ii <= ($countPredmet - 1); $ii++) {
        $retVal .= "<div class='DialogFak'><h3>" . $_SESSION['SesVar']['PredmetZav'][$ii][1] . "</h3>";
        $fak = explode("%", $_SESSION['SesVar']['PredmetZav'][$ii][2]);
        $countFak = count($fak);
        for ($i = 0; $i <= ($countFak - 1); $i++) {
            $result = mssql_query("SELECT Name FROM dbo.Facultets WHERE IdF=" . $fak[$i] . "", $dbStud);
            if (mssql_num_rows($result) >= 1) {
                list($idName) = mssql_fetch_row($result);
                $retVal .= "<p><a href='z.php?menuactiv=goF&idPrepod=" . $_SESSION['SesVar']['FIO'][0] . "&idKaf=" . $_SESSION['SesVar']['Zav'][2] . "&idPredmet=" . $_SESSION['SesVar']['PredmetZav'][$ii][0] . "&idF=" . $fak[$i] . "'>" . $idName . "</a></p>";
            }
        }
        $retVal .= "</div>";
    }
    mssql_free_result($result);
    $retVal .= "</div>";
    echo HeaderFooter($retVal, $_SESSION['SesVar']['Zav'][0] . " (" . $_SESSION['SesVar']['Zav'][1] . ")", $verC);
}


//----------------------------------------------------------------------------------------------

function HeaderFooter($content, $title, $vC = '')
{
    ?>
    <!doctype html>
    <html>
    <head>
        <meta charset="windows-1251">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css<?php echo $vC; ?>">
        <title><?php echo $title; ?></title>
        <script src="scripts/jquery-3.2.1.min.js"></script>
        <script src="scripts/online.js"></script>
    </head>
    <body>
    <?php
    //<div class="Exit"><a href="index.php?go=exit" title="������">������</a></div>
    echo LevelView();
    ?>
    <div class="Header">
        <H2><?php echo $_SESSION['SesVar']['FIO'][1]; ?></H2>
    </div>

    <?php echo $content; ?>
    <div style="clear:both; margin-bottom:100px;">&nbsp;</div>
    </body>
    </html>
    <?php
}

function HeaderFooterGroup($content, $title, $vC = '', $vS = '')
{
    ?>

    <!doctype html>
    <head>
        <meta charset="windows-1251">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css<?php echo $vC; ?>">
        <link rel="stylesheet" href="mystyle.css<?php echo $vC; ?>">
        <link rel="stylesheet" href="scripts/jquery-ui.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <title><?php echo $title; ?></title>
        <script src="scripts/jquery-3.2.1.min.js"></script>
        <script src="scripts/jquery-ui.js"></script>
        <script src="scripts/jquery.mask.js"></script>
        <script src="scripts/scriptZav.js<?php echo $vS; ?>"></script>
        <script src="scripts/online.js"></script>
        <script src="scripts/corporate.js<?php echo $vS; ?>"></script>



    </head>
    <body>
    <?php echo LevelView(); ?>
    <div class="Header">
        <H2><?php echo $_SESSION['SesVar']['FIO'][1]; ?></H2>
    </div>

    <div class="export">
        <img class="export_img" src="img/doc.png" title="�������������� � .csv">
    </div>

    <?php echo $content; ?>
    <div style="clear:both; margin-bottom:100px;">&nbsp;</div>
    </body>
    </html>
    <?php
}


function HeaderFooterGroupL($content, $title, $vC = '', $vS = '')
{
    ?>

    <!doctype html>
    <head>
        <meta charset="windows-1251">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css<?php echo $vC; ?>">
        <link rel="stylesheet" href="mystyle.css<?php echo $vC; ?>">
        <link rel="stylesheet" href="scripts/jquery-ui.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <title><?php echo $title; ?></title>
        <script src="scripts/jquery-3.2.1.min.js"></script>
        <script src="scripts/jquery-ui.js"></script>
        <script src="scripts/jquery.mask.js"></script>
        <script src="scripts/scriptZavLec.js<?php echo $vS; ?>"></script>
        <script src="scripts/online.js"></script>
        <script src="scripts/corporate.js<?php echo $vS; ?>"></script>


    </head>
    <body>
    <?php echo LevelView(); ?>
    <div class="Header">
        <H2><?php echo $_SESSION['SesVar']['FIO'][1]; ?></H2>
    </div>

    <div class="export">
        <img class="export_img" src="img/doc.png" title="�������������� � .csv">
    </div>

    <?php echo $content; ?>
    <div style="clear:both; margin-bottom:100px;">&nbsp;</div>
    </body>
    </html>
    <?php
}


//----------------------------------------------------------------------------------------------

function StudentView($content, $contentO = '')
{

    $ret = "<div id='form-lesson' title='�������� �������'>
    <form>
        <fieldset>
            <div class='box'>
            <div class='dat'>
                <b align='center'>���� �������</b>
                <div id='date_col'>
                    <input type='text' id='lesson-date' required class='datepicker' value='" . date('d.m.Y') . "' placeholder='��.��.����'>
                </div>
            </div>
            <div class='number_theme'>
                <b align='center'>� ����</b><br>
                <input type='text' id='number_theme' maxlength='2' onkeydown='return checkNumberThemeLesson(event);' onkeyup=\"this.value=this.value.replace(/[^0-9]/,'');\">
            </div>
                
                <br>
                <label><input type='radio' class='type_lesson' id='simple_lesson_rb' name='type_lesson' value='sl' checked><b class='type_lesson'>������� �������</b></label>
                <br><br>
                <label><input type='radio' class='type_lesson' id='colloquium_rb' name='type_lesson' value='col'><b class='type_lesson'>����������</b></label>
                <br><br>
                <label><input type='radio' class='type_lesson' id='exam_rb' name='type_lesson' value='exam'><b class='type_lesson'>����������</b></label>
                <br><br>
            </div>
        </fieldset>
    </form>
</div>


<div id='form-edit' title='������������� �������'>
    <form id='form-edit'>
        <fieldset>
            <div class='panel'>

                    <b id='1' class='tool' title='������� ������� �������.'><b>�</b></b>
                    <span class='space'></span>
                    <b id='11' class='tool absenteeism_closed' title='������� ����������.'><b>���.</b></b>
                    <span class='space'></span>
                    <b id='2' class='tool' title='�������.'><b>���.</b></b>
                    <span class='space'></span>
                    <b id='3' class='tool' title='�� �������.'><b>�����.</b></b>
                    <span class='space'></span>
                    <b id='4' class='tool fail' title='�������� � ����������.'><b>�����</b></b>

                    <hr class='marg-line'>

                    <span id='5' class='tool' title='������� ������� �� 1 ���.'><span>�<sub>1�.</sub></span></span>
                    <span class='space'></span>
                    <span id='6' class='tool' title='������� ������� �� 2 ����.'><span>�<sub>2�.</sub></span></span>
                    <span class='space'></span>
                    <span id='7' class='tool' title='������� ������� �� 3 ����.'><span>�<sub>3�.</sub></span></span>
                    <span class='space'></span>
                    <span id='8' class='tool' title='������� ������� �� 4 ����.'><span>�<sub>4�.</sub></span></span>
                    <span class='space'></span>
                    <span id='9' class='tool' title='������� ������� �� 5 �����.'><span>�<sub>5�.</sub></span></span>
                    <span class='space'></span>
                    <span id='10' class='tool' title='������� ������� �� 6 �����.'><span>�<sub>6�.</sub></span></span>
                    <hr class='marg-line'>
                    <span class='tool' title='�������: ����'>1</span>
                    <span class='space'></span>
                    <span class='tool' title='�������: ���'>2</span>
                    <span class='space'></span>
                    <span class='tool' title='�������: ���'>3</span>
                    <span class='space'></span>
                    <span class='tool' title='�������: ������'>4</span>
                    <span class='space'></span>
                    <span class='tool' title='�������: ����'>5</span>
                    <span class='space'></span>
                    <span class='tool' title='�������: �����'>6</span>
                    <span class='space'></span>
                    <span class='tool' title='�������: ����'>7</span>
                    <span class='space'></span>
                    <span class='tool' title='�������: ������'>8</span>
                    <span class='space'></span>
                    <span class='tool' title='�������: ������'>9</span>
                    <span class='space'></span>
                    <span class='tool' title='�������: ������'>10</span>

                <br><br>

               <input class='inp_cell' id='inp_0' type=text maxlength='6'
                       onkeydown='return proverka(event,0);' onblur='return proverka(event,0);'>
                <input class='inp_cell' id='inp_1' type='text' maxlength='6'
                       onkeydown='return proverka(event,1);' onblur='return proverka(event,1);'>
                <input class='inp_cell' id='inp_2' type='text' maxlength='6'
                       onkeydown='return proverka(event,2);' onblur='return proverka(event,2);'>
      <button id='add_grade_input' class='add_grade' title='��� ���������� �������������� ������ ������� �� ������!'>+</button>
      <br><br>
      
        </fieldset>
                <hr class='marg-line'>
                <button id='close' class='attention'>������</button>
                <button id='edit' class='button'>���������</button>
                
            </div>

    </form>
</div>

<div id='confirm_delete' title='������������� ��������!'>
    <form><br>
    <fieldset>
       <span id='delSt'></span><br><br>
       <span id='delDat'></span><br><br>
       <b id='delGr'></b><br>
    </fieldset>
    <span class='kursiv'><i>������ ����� ������� ������������!</i></span>

    </form>
</div>

<div id=\"form-edit-date\" title=\"�������������� ���� �������\">
    <form>
        <fieldset>
            <div class=\"box\">
            <div class='dat'>
                <b align='center'>���� �������</b><br>
                <input type='text' id='edit-lesson-date' required class='datepicker' value='" . date('d.m.Y') . "' placeholder='��.��.����'>
            </div>
            <div class='number_theme'>
                <b align='center'>� ����</b><br>
                <input type='text' id='edit_number_theme' maxlength='2' onkeydown='return checkNumberThemeLesson(event);' onkeyup=\"this.value=this.value.replace(/[^0-9]/,'');\">
            </div>
            <br>

                <label><input type='radio' class='edit_type_lesson' id='edit_simple_lesson_rb' name='type_lesson' value='0' checked><b class='type_lesson'>������� �������</b></label>
                <br><br>
                <label><input type='radio' class='edit_type_lesson' id='edit_colloquium_rb' name='type_lesson' value='1'><b class='type_lesson'>����������</b></label>
                <br><br>
                <label><input type='radio' class='edit_type_lesson' id='edit_exam_rb' name='type_lesson' value='2'><b class='type_lesson'>����������</b></label>
                <br>
            </div>
        </fieldset>
    </form>
</div>


<div class='popup-content' id='history'>
    <span id='log_text'></span>
</div>


<div class='container-list'>

    <div class='tools' align='center'>
        <button id='create_lesson'>����� �������</button>
    </div>
    <div class='container'>
        <div class='fio'>
            <div class='title'>���</div>\n" . $content . "
        </div>

        <div class='result_box'><div class='date_col hidden'></div>" . $contentO . "

        </div><div class='statistic'></div>
    </div>
</div>";


    return $ret;

}


//----------------------------------------------------------------------------------------------


function StudentViewL($content, $contentO = '')
{
    $ret = "<div id='form-lesson' title='�������� ������'>
    <form>
        <fieldset>
            <div class='box'>
            <div class='dat'>
                <b align='center'>���� �������</b><br>
                <div id='date_col'>
                    <input type='text' id='lesson-date' required class='datepicker' value='" . date('d.m.Y') . "'>
                </div>
            </div>
            <div class='number_theme'>
                <b align='center'>� ����</b><br>
                <input type='text' id='number_theme' maxlength='2' onkeydown='return checkNumberThemeLesson(event);' onkeyup=\"this.value=this.value.replace(/[^0-9]/,'');\">
            </div>
              
            <br>
            </div>
        </fieldset>
    </form>
</div>



<div id='form-edit' title='�������������� �������'>
    <form id='form-edit'>
        <fieldset>
            <div class='panel'>
                    <b id='1' class='tool' title='������� ������� �������.'><b>�</b></b>
                     <span class='space'></span>
                    <b id='11' class='tool absenteeism_closed' title='������� ����������.'><b>���.</b></b>
                     <span class='space'></span>

                    <hr class='marg-line'>
                    
                    <span id='5' class='tool' title='������� ������� �� 1 ���.'><span>�<sub>1�.</sub></span></span>
                    <span class='space'></span>
                    <span id='6' class='tool' title='������� ������� �� 2 ����.'><span>�<sub>2�.</sub></span></span>
                    <span class='space'></span>
                    <span id='7' class='tool' title='������� ������� �� 3 ����.'><span>�<sub>3�.</sub></span></span>
                    <span class='space'></span>
                    <span id='8' class='tool' title='������� ������� �� 4 ����.'><span>�<sub>4�.</sub></span></span>
                    <span class='space'></span>
                    <span id='9' class='tool' title='������� ������� �� 5 �����.'><span>�<sub>5�.</sub></span></span>
                    <span class='space'></span>
                    <span id='10' class='tool' title='������� ������� �� 6 �����.'><span>�<sub>6�.</sub></span></span>
                    <span class='space'></span>
                    
                    <br><br>               
                 


                    <input class='inp_cell' id='inp_0' type=text maxlength='0'
                       onkeydown='return proverka(event,0);' onblur='return proverka(event,0);'><br><br>
        </fieldset>      
                <hr class='marg-line'>
                <button id='close' class='attention'>������</button>
                <button id='edit' class='button'>���������</button>
                

                
            </div>
        
    </form>
</div>

<div id=\"form-edit-date\" title=\"�������������� ���� �������\">
    <form>
        <fieldset>
            <div class=\"box\">
            <div class='dat'>
                <b align='center'>���� �������</b><br>
                <input type='text' id='edit-lesson-date' required class='datepicker' value='" . date('d.m.Y') . "' placeholder='��.��.����'>
            </div>
            <div class='number_theme'>
                <b align='center'>� ����</b><br>
                <input type='text' id='edit_number_theme' maxlength='2' onkeydown='return checkNumberThemeLesson(event);' onkeyup=\"this.value=this.value.replace(/[^0-9]/,'');\">
            </div>
                
            <br>
            </div>
        </fieldset>
    </form>
</div>

<div class='popup-content' id='history'>
    <span id='log_text'></span>
</div>

<div id='confirm_delete' title='������������� ��������!'>
    <form><br>
    <fieldset>
       <span id='delSt'></span><br><br>
       <span id='delDat'></span><br><br>
       <b id='delGr'></b><br>
    </fieldset>
    <span class='kursiv'><i>������ ����� ������� ������������!</i></span>

    </form>
</div>

<div class='container-list'>

    <div class='tools' align='center'>
        <button id='create_lesson'>����� ������</button>
    </div>
    <div class='container'>
        <div class='fio'>
            <div class='title'>���</div>\n" . $content . "
        </div>

        <div class='result_box'><div class='date_col hidden'></div>" . $contentO . "

        </div><div class='statistic'></div>
    </div>
</div>";

    return $ret;
}

function LevelView()
{
    $countLev = count($_SESSION['SesVar']['Level']);
    if ($countLev >= 2) {
        $preDiv = '';
        for ($ii = 0; $ii <= ($countLev - 1); $ii++) {
            switch ($_SESSION['SesVar']['Level'][$ii]) {
                case 1:
                    $preDiv .= "<p><a href='r.php'><strong>" . $_SESSION['SesVar']['Rector'][0] . "</strong> (" . $_SESSION['SesVar']['Rector'][1] . ")</a></p>";
                    break;
                case 2:
                    $preDiv .= "<p><a href='d.php'><strong>" . $_SESSION['SesVar']['Dekan'][0] . "</strong> (" . $_SESSION['SesVar']['Dekan'][1] . ")</a></p>";
                    break;
                case 3:
                    $preDiv .= "<p><a href='p.php'><strong>" . $_SESSION['SesVar']['Prepod'][0] . "</strong> (" . $_SESSION['SesVar']['Prepod'][1] . ")</a></p>";
                    break;
            }
        }
        return "<div class='Exit'>" . $preDiv . "</div><div class='C'></div>";
    }
}

?>
