<?php
unset($_SESSION['SesVar']);
session_start();

if(!isset($_SESSION['SesVar']['Auth']) || $_SESSION['SesVar']['Auth']!==true){
   if(isset($_GET['ajaxTrue']) && $_GET['ajaxTrue']){
    echo "Access is denied!";
    exit;
   } else {
      header('Location: index.php?closet=Время сессии истекло!');
      exit;
   }
}

$Nepuschu = 0;
$countLev = count($_SESSION['SesVar']['Level']);
for ($ii = 0; $ii <= ($countLev - 1); $ii++) {
    if ($_SESSION['SesVar']['Level'][$ii] == 3) $Nepuschu = 1;
}

if (!$Nepuschu) {
    header('Location: index.php?closet=Запрещённый уровень доступа! Досвидос.');
    exit;
}


if (isset($_GET['menuactiv'])) {
    switch ($_GET['menuactiv']) {

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


function edtLess()
{
    include_once 'configMain.php';
    $dt = explode(".", $_GET['Date']);
    if(is_numeric($_GET['PKE']) && is_numeric($_GET['numberThemeLesson']) && is_numeric($_GET['idLesson']) && is_numeric($_GET['idGroup'])){
        mysqli_query($dbMain, "UPDATE lesson SET LDate='".$dt[2]."-".$dt[1]."-".$dt[0]."', PKE=".$_GET['PKE'].", nLesson=".$_GET['numberThemeLesson']." WHERE id=".$_GET['idLesson']." AND idGroup=".$_GET['idGroup']);
        mysqli_query($dbMain, "UPDATE rating SET DateO='".$dt[2]."-".$dt[1]."-".$dt[0]."', PKE=".$_GET['PKE']." WHERE del=0 AND idLesson=".$_GET['idLesson']);
    } else {
        echo "No";
    }
}


function edtLessonStudent()
{
    include_once 'configMain.php';
    if(is_numeric($_GET['id_Zapis']) && is_numeric($_GET['idStudent']) && is_numeric($_GET['grades']) && is_numeric($_SESSION['SesVar']['FIO'][0])){
        $resTime = mysqli_query($dbMain, "SELECT TIMESTAMPDIFF(MINUTE, CONCAT(DateO, ' ', TimeO), NOW()), idLessons, idLesson, DateO, TimeO, RatingO, idEmployess FROM rating WHERE del=0 AND id=".$_GET['id_Zapis']." AND idStud=".$_GET['idStudent']);
        if (mysqli_num_rows($resTime) >= 1) {
            $arr = mysqli_fetch_row($resTime);
            if($arr[6]!=$_SESSION['SesVar']['FIO'][0] || $arr[0] > 10){
                mysqli_query($dbMain, "INSERT INTO logi (idRating,idLessons,idLesson,idStud,DateO,TimeO,RatingO,idEmployess) VALUES (".$_GET['id_Zapis'].",".$arr[1].",".$arr[2].",".$_GET['idStudent'].",'".$arr[3]."','".$arr[4]."',".$arr[5].",".$arr[6].")");
                mysqli_query($dbMain, "UPDATE rating SET DateO=CURDATE(), TimeO=CURTIME(), RatingO=".$_GET['grades'].", idEmployess=".$_SESSION['SesVar']['FIO'][0]." WHERE del=0 AND pStatus=0 AND id=" . $_GET['id_Zapis'] . " AND idStud=" . $_GET['idStudent']);
            }else{
                mysqli_query($dbMain, "UPDATE rating SET RatingO=".$_GET['grades'].", idEmployess=".$_SESSION['SesVar']['FIO'][0]." WHERE del=0 AND pStatus=0 AND id=".$_GET['id_Zapis']." AND idStud=".$_GET['idStudent']);
            }
            mysqli_free_result($resTime);
        }
    } else {
        echo "No";
    }
}


function addLessonStudent()
{
    include_once 'configMain.php';
    $dt = explode(".", $_GET['dateLes']);
    if(isset($_GET['nGroup']) && $_GET['nGroup']){ $nGr=trim(substr($_GET['nGroup'],0,6)); } else { $nGr=""; }
    if(is_numeric($_GET['idLessons']) && is_numeric($_GET['idStudent']) && is_numeric($_GET['PL']) && is_numeric($_GET['PKE']) && is_numeric($_GET['grades']) && is_numeric($_SESSION['SesVar']['FIO'][0]) && is_numeric($_GET['idLess'])){
        $res = mysqli_query($dbMain, "SELECT 1 FROM rating WHERE idLessons=".$_GET['idLessons']." AND idStud=".$_GET['idStudent']." AND PL=".$_GET['PL']." AND PKE=".$_GET['PKE']." AND idLesson=".$_GET['idLess']." AND del=0");        
        if (!mysqli_num_rows($res)) {
           mysqli_query($dbMain, "INSERT INTO rating (idLessons,idStud,PL,PKE,DateO,TimeO,RatingO,idEmployess,idLesson,nGroup) VALUES (".$_GET['idLessons'].",".$_GET['idStudent'].",".$_GET['PL'].",".$_GET['PKE'].",'".$dt[2]."-".$dt[1]."-".$dt[0]."',CURTIME(),".$_GET['grades'].",".$_SESSION['SesVar']['FIO'][0].",".$_GET['idLess'].",'".$nGr."')");
           echo mysqli_insert_id($dbMain);
        } else {
           echo "No";
        }
    } else {
        echo "No";
    }
}


function addLess()
{
    include_once 'configMain.php';
    $dt = explode(".", $_GET['dateLesson']);
    if(is_numeric($_GET['idGroup']) && is_numeric($_GET['idLessons']) && is_numeric($_GET['PL']) && is_numeric($_GET['PKE']) && is_numeric($_GET['numberThemeLesson'])){
        mysqli_query($dbMain, "INSERT INTO lesson (LDate,idGroup,idLessons,PL,PKE,nLesson) VALUES ('" . $dt[2] . "-" . $dt[1] . "-" . $dt[0] . "'," . $_GET['idGroup'] . "," . $_GET['idLessons'] . "," . $_GET['PL'] . "," . $_GET['PKE'] . ",".$_GET['numberThemeLesson'].")");
        echo mysqli_insert_id($dbMain);
    } else {
        echo "No";
    }
}




//----------------------------------------------------------------------------------------------


function GroupViewL()
{

    include_once 'configStudent.php';
    include_once 'configMain.php';
    $retVal = "<p>" . $_SESSION['SesVar']['Prepod'][0] . " (" . $_SESSION['SesVar']['Prepod'][1] . ")</p>";

    $retVal .= "<h3><a href='p.php'>" . $_GET['nPredmet'] . "</a><br>&nbsp;<font color='#ff0000'>&darr;</font><br>";
    $retVal .= "<a href='p.php?menuactiv=goF&idPrepod=".$_SESSION['SesVar']['FIO'][0]."&idKaf=".$_SESSION['SesVar']['Prepod'][2]."&idPredmet=".$_GET['idPredmet']."&idF=".$_GET['idF']."'>".$_GET['nF']."</a><br>&nbsp;<font color='#ff0000'>&darr;</font><br>";
    $retVal .= "Группа № ".$_GET['nGroup']." (<a href='p.php?menuactiv=goG&idPrepod=".$_SESSION['SesVar']['FIO'][0]."&idKaf=".$_SESSION['SesVar']['Prepod'][2]."&idPredmet=".$_GET['idPredmet']."&idF=".$_GET['idF']."&idGroup=".$_GET['idGroup']."&PL=0&nPredmet=".$_GET['nPredmet']."&nF=".$_GET['nF']."&nGroup=".$_GET['nGroup']."&IdCaptain=".$_GET['IdCaptain']."'>Практическое</a> / ЛЕКЦИЯ)</h3><hr>";


    $retVal .= "
    <input type='hidden' id='idSubject' value='" . $_GET['idPredmet'] . "'>
    <input type='hidden' id='idPrepod' value='" . $_GET['idPrepod'] . "'>
    <input type='hidden' id='idGroup' value='" . $_GET['idGroup'] . "'>
    <input type='hidden' id='nGroup' value='".$_GET['nGroup']."'>
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
                if($arrS[0] == $_GET['IdCaptain']){
                   $preStud .= "<div class='fio_student' data-idStudent='".$arrS[0]."' title='Капитан шлюпки'>".($i + 1).". <strong>".$arrS[1]."</strong></div>\n";
                } else {
                   $preStud .= "<div class='fio_student' data-idStudent='".$arrS[0]."'>".($i + 1).". ". $arrS[1]."</div>\n";
                }
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
                    $resultS = mysqli_query($dbMain, "SELECT id, idStud, RatingO, pStatus FROM rating WHERE del=0 AND (" . $sqlStud . ") AND PKE=" . $arr[2] . " AND idLesson=" . $arr[0] . " AND idLessons=" . $_GET['idPredmet'] . " AND PL=1");
                    $arrSStud = Array();
                    if (mysqli_num_rows($resultS) >= 1) {
                        $ii = 0;
                        while ($arrSS = mysqli_fetch_row($resultS)) {
                            $arrSStud[$ii] = array($arrSS[0], $arrSS[1], $arrSS[2], $arrSS[3]);
                            $ii++;
                        }
                    }
                    mysqli_free_result($resultS);

                    $countSStud = count($arrSStud);
                    for ($iS = 0; $iS <= ($countarrStud - 1); $iS++) {
                        $trueS = 0;
                        for ($iSS = 0; $iSS <= ($countSStud - 1); $iSS++) {
                            if ($arrStud[$iS] == $arrSStud[$iSS][1]) {
                                $prepreRating .= "<div class='grade' data-idLes=" . $arr[0] . " data-idStudent=" . $arrStud[$iS] . " data-PKE=" . $arr[2] . " data-zapis=".$arrSStud[$iSS][0]." data-Status=".$arrSStud[$iSS][3].">" . $arrSStud[$iSS][2] . "</div>\n";
                                $trueS = 1;
                            }
                        }
                        if (!$trueS) {
                            $prepreRating .= "<div class='grade' data-idLes=" . $arr[0] . " data-idStudent=" . $arrStud[$iS] . " data-PKE=" . $arr[2] . " data-zapis=0 data-Status=0></div>\n";
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
                if($arrStud[0] == $_GET['IdCaptain']){
                   $preStud .= "<div class='fio_student' data-idStudent='".$arrStud[0]."' title='Капитан шлюпки'>".$i.". <strong>".$arrStud[1]."</strong></div>\n";
                } else {
                   $preStud .= "<div class='fio_student' data-idStudent='".$arrStud[0]."'>".$i.". ".$arrStud[1]."</div>\n";
                }
                $i++;
            }
            $retVal .= StudentViewL($preStud);
        }
    }

    mssql_free_result($result);
    mysqli_free_result($resultL);


    echo HeaderFooterGroupL($retVal, "№ " . $_GET['nGroup'], $verC, $verS);
}




//----------------------------------------------------------------------------------------------


function GroupViewP()
{
    include_once 'configStudent.php';
    include_once 'configMain.php';
    $retVal = "<p>" . $_SESSION['SesVar']['Prepod'][0] . " (" . $_SESSION['SesVar']['Prepod'][1] . ")</p>";

    $retVal .= "<h3><a href='p.php'>".$_GET['nPredmet']."</a><br>&nbsp;<font color='#ff0000'>&darr;</font><br>";
    $retVal .= "<a href='p.php?menuactiv=goF&idPrepod=".$_SESSION['SesVar']['FIO'][0]."&idKaf=".$_SESSION['SesVar']['Prepod'][2]."&idPredmet=".$_GET['idPredmet']."&idF=".$_GET['idF']."'>".$_GET['nF']."</a><br>&nbsp;<font color='#ff0000'>&darr;</font><br>";
    $retVal .= "Группа № ".$_GET['nGroup']." (ПРАКТИЧЕСКОЕ / <a href='p.php?menuactiv=goG&idPrepod=".$_SESSION['SesVar']['FIO'][0]."&idKaf=".$_SESSION['SesVar']['Prepod'][2]."&idPredmet=".$_GET['idPredmet']."&idF=".$_GET['idF']."&idGroup=".$_GET['idGroup']."&PL=1&nPredmet=".$_GET['nPredmet']."&nF=".$_GET['nF']."&nGroup=".$_GET['nGroup']."&IdCaptain=".$_GET['IdCaptain']."'>Лекция</a>)</h3><hr>";


    $retVal .= "
    <input type='hidden' id='idSubject' value='" . $_GET['idPredmet'] . "'>
    <input type='hidden' id='idPrepod' value='" . $_GET['idPrepod'] . "'>
    <input type='hidden' id='idGroup' value='" . $_GET['idGroup'] . "'>
    <input type='hidden' id='nGroup' value='".$_GET['nGroup']."'>
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
                if($arrS[0] == $_GET['IdCaptain']){
                   $preStud .= "<div class='fio_student' data-idStudent='".$arrS[0]."' title='Капитан шлюпки'>".($i + 1).". <strong>".$arrS[1]."</strong></div>\n";
                } else {
                   $preStud .= "<div class='fio_student' data-idStudent='".$arrS[0]."'>".($i + 1).". ".$arrS[1]."</div>\n";
                }
                $arrStud[$i] = $arrS[0];
                if (!$i) {
                    $sqlStud = "idStud=".$arrS[0]."";
                } else {
                    $sqlStud .= " OR idStud=".$arrS[0]."";
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
                    $resultS = mysqli_query($dbMain, "SELECT id, idStud, RatingO, pStatus FROM rating WHERE del=0 AND (" . $sqlStud . ") AND PKE=" . $arr[2] . " AND idLesson=" . $arr[0] . " AND idLessons=" . $_GET['idPredmet'] . " AND PL=0");
                    $arrSStud = Array();
                    if (mysqli_num_rows($resultS) >= 1) {
                        $ii = 0;
                        while ($arrSS = mysqli_fetch_row($resultS)) {
                            $arrSStud[$ii] = array($arrSS[0], $arrSS[1], $arrSS[2], $arrSS[3]);
                            $ii++;
                        }
                    }
                    mysqli_free_result($resultS);

                    $countSStud = count($arrSStud);
                    for ($iS = 0; $iS <= ($countarrStud - 1); $iS++) {
                        $trueS = 0;
                        for ($iSS = 0; $iSS <= ($countSStud - 1); $iSS++) {
                            if ($arrStud[$iS] == $arrSStud[$iSS][1]) {
                                $prepreRating .= "<div class='grade' data-idLes=" . $arr[0] . " data-idStudent=" . $arrStud[$iS] . " data-PKE=" . $arr[2] . " data-zapis=".$arrSStud[$iSS][0]." data-Status=".$arrSStud[$iSS][3].">" . $arrSStud[$iSS][2] . "</div>\n";
                                $trueS = 1;
                            }
                        }
                        if (!$trueS) {
                            $prepreRating .= "<div class='grade' data-idLes=".$arr[0]." data-idStudent=".$arrStud[$iS]." data-PKE=".$arr[2]." data-zapis=0 data-Status=0></div>\n";
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
                if($arrStud[0] == $_GET['IdCaptain']){
                   $preStud .= "<div class='fio_student' data-idStudent='".$arrStud[0]."' title='Капитан шлюпки'>".$i.". <strong>".$arrStud[1]."</strong></div>\n";
                } else {
                   $preStud .= "<div class='fio_student' data-idStudent='".$arrStud[0]."'>".$i.". ".$arrStud[1]."</div>\n";
                }
                $i++;
            }
            $retVal .= StudentView($preStud);
        }
    }

    mssql_free_result($result);
    mysqli_free_result($resultL);


    echo HeaderFooterGroup($retVal, "№ " . $_GET['nGroup'], $verC, $verS);
}


//----------------------------------------------------------------------------------------------



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
      <div class='titleBox'><H2>Группы</H2></div>
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
                    $retVal .= "<a href='z.php?menuactiv=goG&idPrepod=" . $_SESSION['SesVar']['FIO'][0] . "&idKaf=" . $_SESSION['SesVar']['Zav'][2] . "&idPredmet=" . $_GET['idPredmet'] . "&idF=" . $_GET['idF'] . "&idGroup=" . $arr[0] . "&PL=0&nPredmet=" . $Pre . "&nF=" . $idName . "&nGroup=" . $arr[1] . "'>Практ.</a>&nbsp;&nbsp;&nbsp;";
                    $retVal .= "<a href='z.php?menuactiv=goG&idPrepod=" . $_SESSION['SesVar']['FIO'][0] . "&idKaf=" . $_SESSION['SesVar']['Zav'][2] . "&idPredmet=" . $_GET['idPredmet'] . "&idF=" . $_GET['idF'] . "&idGroup=" . $arr[0] . "&PL=1&nPredmet=" . $Pre . "&nF=" . $idName . "&nGroup=" . $arr[1] . "'>Лекция</a>";
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


function Fakultet()
{
    include_once 'configStudent.php';
    include_once 'configMain.php';
    include_once 'config.php';

    $retVal = "<p>".$_SESSION['SesVar']['Prepod'][0]." (".$_SESSION['SesVar']['Prepod'][1].")</a></p>";

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

        $retVal .= "<h3><a href='p.php'>$Pre</a><br>&nbsp;<font color='#ff0000'>&darr;</font><br>";
        $result = mssql_query("SELECT Name FROM dbo.Facultets WHERE IdF=" . $_GET['idF'] . "", $dbStud);
        if (mssql_num_rows($result) >= 1) {
            list($idName) = mssql_fetch_row($result);
            $retVal .= "$idName</h3><hr>";


            $retVal .= "
      <div class='DialogP'>
      <div class='titleBox'><H2>Группы</H2></div>
      ";
            $result = mssql_query("SELECT IdGroup, Name, IIF(IdF != ".$_GET['idF'].", 1, 0), IIF(IdCaptain!=null, IdCaptain, 0) FROM dbo.Groups WHERE ".$sqlSO." ORDER BY Name, IdF", $dbStud);
            if (mssql_num_rows($result) >= 1) {
                $preChar = "";
                while ($arr = mssql_fetch_row($result)) {
                    if ($preChar != substr($arr[1], 0, 2)) $retVal .= "<div class='HRnext'></div>";
                    $preChar = substr($arr[1], 0, 2);
                    $retVal .= "<div class='DialogGr'><strong>" . $arr[1] . "</strong>".($arr[2] ? "<div class='Inostr' title='Группа иностранных учащихся'>и</div>" : "")."<div class='GroupPL'>";
                    $retVal .= "<a href='p.php?menuactiv=goG&idPrepod=" . $_SESSION['SesVar']['FIO'][0] . "&idKaf=" . $_SESSION['SesVar']['Prepod'][2] . "&idPredmet=" . $_GET['idPredmet'] . "&idF=" . $_GET['idF'] . "&idGroup=" . $arr[0] . "&PL=0&nPredmet=" . $Pre . "&nF=" . $idName . "&nGroup=" . $arr[1] . "&IdCaptain=".$arr[3]."'>Практ.</a>&nbsp;&nbsp;&nbsp;";
                    $retVal .= "<a href='p.php?menuactiv=goG&idPrepod=" . $_SESSION['SesVar']['FIO'][0] . "&idKaf=" . $_SESSION['SesVar']['Prepod'][2] . "&idPredmet=" . $_GET['idPredmet'] . "&idF=" . $_GET['idF'] . "&idGroup=" . $arr[0] . "&PL=1&nPredmet=" . $Pre . "&nF=" . $idName . "&nGroup=" . $arr[1] . "&IdCaptain=".$arr[3]."'>Лекция</a>";
                    $retVal .= "</div></div></div>\n";
                }
            }

            $retVal .= "</div>";


        }
    }

    unset($sqlSO, $sqlS, $sqlSr, $sqlSS);
    mssql_free_result($result);
    mysqli_free_result($resPredmet);

    echo HeaderFooter($retVal, $_SESSION['SesVar']['Prepod'][0] . " (" . $_SESSION['SesVar']['Prepod'][1] . ")", $verC);
}


//----------------------------------------------------------------------------------------------

function MainF()
{
    $retVal = "<p>" . $_SESSION['SesVar']['Prepod'][0] . " (" . $_SESSION['SesVar']['Prepod'][1] . ")</p><hr>";

    $countPredmet = count($_SESSION['SesVar']['Predmet']);
    $retVal .= "
      <div class='DialogP'>
      <div class='titleBox'><H2>Дисциплина</H2></div>
   ";

    include_once 'configStudent.php';

    for ($ii = 0; $ii <= ($countPredmet - 1); $ii++) {
        $retVal .= "<div class='DialogFak'><h3>" . $_SESSION['SesVar']['Predmet'][$ii][1] . "</h3>";
        $fak = explode("%", $_SESSION['SesVar']['Predmet'][$ii][2]);
        $countFak = count($fak);
        for ($i = 0; $i <= ($countFak - 1); $i++) {
            $result = mssql_query("SELECT Name FROM dbo.Facultets WHERE IdF=" . $fak[$i] . "", $dbStud);
            if (mssql_num_rows($result) >= 1) {
                list($idName) = mssql_fetch_row($result);
                $retVal .= "<p><a href='p.php?menuactiv=goF&idPrepod=".$_SESSION['SesVar']['FIO'][0]."&idKaf=".$_SESSION['SesVar']['Prepod'][2]."&idPredmet=".$_SESSION['SesVar']['Predmet'][$ii][0]."&idF=". $fak[$i]."'>".$idName."</a></p>";
                mssql_free_result($result);
            }
        }
        $retVal .= "</div>";
    }
    $retVal .= "</div>";
    echo HeaderFooter($retVal, $_SESSION['SesVar']['Prepod'][0] . " (" . $_SESSION['SesVar']['Prepod'][1] . ")", $verC);
}


//----------------------------------------------------------------------------------------------

function HeaderFooter($content, $title, $vC = '')
{
    ?>
    <!doctype html>
    <html>
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="windows-1251">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="style.css<?php echo $vC; ?>">
        <script src="scripts/jquery-3.2.1.min.js"></script>
        <script src="scripts/online.js"></script>
    </head>
    <body>
    <?php
    //<div class="Exit"><a href="index.php?go=exit" title="Выхожу">Выхожу</a></div>
    echo LevelView();
    ?>
    <div class="Header">
        <H2><?php echo $_SESSION['SesVar']['FIO'][1]; ?></H2>
    </div>

    <?php echo $content; ?>
    <div style="clear:both;">&nbsp;</div>
    <div class="support"><a href="help/index.html">Руководство пользователя "Эл. журнала"</a> <br> По техническим вопросам работы электронного журнала обращаться: 277-22-74 (вн. 474) </div>
    <div style="clear:both; margin-bottom:100px;">&nbsp;</div>
    </body>
    </html>
    <?php
}

function HeaderFooterGroup($content, $title, $vC = '', $vS = '')
{
    ?>

    <!doctype html>
    <html>
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="windows-1251">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="style.css<?php echo $vC; ?>">
        <link rel="stylesheet" href="scripts/jquery-ui.css">
        <script src="scripts/jquery-3.2.1.min.js"></script>
        <script src="scripts/jquery-ui.js"></script>
        <script src="scripts/jquery.mask.js"></script>
        <script src="scripts/script.js<?php echo $vS; ?>"></script>
        <script src="scripts/online.js"></script>
        <script src="scripts/corporate.js<?php echo $vS; ?>"></script>

    </head>
    <body>
    <?php echo LevelView(); ?>
    <div class="Header">
        <H2><?php echo $_SESSION['SesVar']['FIO'][1]; ?></H2>
    </div>
    <?php echo $content; ?>
    <div style="clear:both;">&nbsp;</div>
    <div class="export" alt="Экспортировать в .CSV">
        <a href="#" title="Экспортировать в .CSV"><img src="img/csv.png">Экспортировать в .CSV</a>
    </div>
    <div class="support"><a href="help/index.html">Руководство пользователя "Эл. журнала"</a> <br> По техническим вопросам работы электронного журнала обращаться: 277-22-74 (вн. 474) </div>
    <div style="clear:both; margin-bottom:100px;">&nbsp;</div>
    </body>
    </html>
    <?php
}


function HeaderFooterGroupL($content, $title, $vC = '', $vS = '')
{
    ?>

    <!doctype html>
    <html>
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="windows-1251">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="style.css<?php echo $vC; ?>">
        <link rel="stylesheet" href="scripts/jquery-ui.css">
        <script src="scripts/jquery-3.2.1.min.js"></script>
        <script src="scripts/jquery-ui.js"></script>
        <script src="scripts/jquery.mask.js"></script>
        <script src="scripts/scriptLec.js<?php echo $vS; ?>"></script>
        <script src="scripts/online.js"></script>
        <script src="scripts/corporate.js<?php echo $vS; ?>"></script>

    </head>
    <body>
    <?php echo LevelView(); ?>
    <div class="Header">
        <H2><?php echo $_SESSION['SesVar']['FIO'][1]; ?></H2>
    </div>
    <?php echo $content; ?>
    <div style="clear:both;">&nbsp;</div>
    <div class="export">
        <a href="#" title="Экспортировать в .CSV"><img src="img/csv.png">Экспортировать в .CSV</a>
    </div>
    <div class="support"><a href="help/index.html">Руководство пользователя "Эл. журнала"</a> <br> По техническим вопросам работы электронного журнала обращаться: 277-22-74 (вн. 474) </div>
    <div style="clear:both; margin-bottom:100px;">&nbsp;</div>
    </body>
    </html>
    <?php
}


//----------------------------------------------------------------------------------------------

function StudentView($content, $contentO = '')
{

    $ret = "<div id='form-lesson' title='Создание занятия'>
    <form>
        <fieldset>
            <div class='box'>
            <div class='dat'>
                <b align='center'>Дата занятия</b><br>
                <div id='date_col'>
                    <input type='text' id='lesson-date' required class='datepicker' value='" . date('d.m.Y') . "' placeholder='дд.мм.гггг'>
                </div>
            </div>
            <div class='number_theme'>
                <b align='center'>№ темы</b><br>
                <input type='text' id='number_theme' maxlength='2' onkeydown='return checkNumberThemeLesson(event);' onkeyup=\"this.value=this.value.replace(/[^0-9]/,'');\">
            </div>
                
                <br>
                <label><input type='radio' class='type_lesson' id='simple_lesson_rb' name='type_lesson' value='sl' checked><b class='type_lesson'>Обычное занятие</b></label>
                <br><br>
                <label><input type='radio' class='type_lesson' id='colloquium_rb' name='type_lesson' value='col'><b class='type_lesson'>Коллок. / Ист. болезни</b></label>
                <br><br>
                <label><input type='radio' class='type_lesson' id='exam_rb' name='type_lesson' value='exam'><b class='type_lesson'>Аттестация</b></label>
                <br><br>
            </div>
        </fieldset>
    </form>
</div>


<div id='form-edit' title='Редактировать отметку'>
    <form id='form-edit'>
        <fieldset>
            <div class='panel'>
                    <div id='item_grade'></div>

                    <hr class='marg-line'>
                    
                    <span class='tool' title='Отметка: один'>1</span>
                    <span class='space'></span>
                    <span class='tool' title='Отметка: два'>2</span>
                    <span class='space'></span>
                    <span class='tool' title='Отметка: три'>3</span>
                    <span class='space'></span>
                    <span class='tool' title='Отметка: четыре'>4</span>
                    <span class='space'></span>
                    <span class='tool' title='Отметка: пять'>5</span>
                    <span class='space'></span>
                    <span class='tool' title='Отметка: шесть'>6</span>
                    <span class='space'></span>
                    <span class='tool' title='Отметка: семь'>7</span>
                    <span class='space'></span>
                    <span class='tool' title='Отметка: восемь'>8</span>
                    <span class='space'></span>
                    <span class='tool' title='Отметка: девять'>9</span>
                    <span class='space'></span>
                    <span class='tool' title='Отметка: десять'>10</span>

                <br><br>

                <input class='inp_cell' id='inp_0' type=text maxlength='6' autocomplete='off'
                       onkeydown='return proverka(event,0);' onblur='return proverka(event,0);'>
                <input class='inp_cell' id='inp_1' type='text' maxlength='6' autocomplete='off'
                       onkeydown='return proverka(event,1);' onblur='return proverka(event,1);'>
                <input class='inp_cell' id='inp_2' type='text' maxlength='6' autocomplete='off'
                       onkeydown='return proverka(event,2);' onblur='return proverka(event,2);'>
                <button id='add_grade_input' class='add_grade' title='Для добавления дополнительной оценки нажмите на кнопку!'>+</button>


                <br><br>
            </div>
        </fieldset>
        <hr class='marg-line'>
        <button id='close' class='attention'>Отмена</button>
        <button id='edit' class='button'>Сохранить</button>        

    </form>
</div>

<div id=\"form-edit-date\" title=\"Редактирование даты занятия\">
    <form>
        <fieldset>
            <div class=\"box\">
            <div class='dat'>
                <b align='center'>Дата занятия</b><br>
                <input type='text' id='edit-lesson-date' required class='datepicker' value='" . date('d.m.Y') . "' placeholder='дд.мм.гггг'>
            </div>
            <div class='number_theme'>
                <b align='center'>№ темы</b><br>
                <input type='text' id='edit_number_theme' maxlength='2' onkeydown='return checkNumberThemeLesson(event);' onkeyup=\"this.value=this.value.replace(/[^0-9]/,'');\">
            </div>
                
                <br>
                <label><input type='radio' class='edit_type_lesson' id='edit_simple_lesson_rb' name='type_lesson' value='0' checked><b class='type_lesson'>Обычное занятие</b></label>
                <br><br>
                <label><input type='radio' class='edit_type_lesson' id='edit_colloquium_rb' name='type_lesson' value='1'><b class='type_lesson'>Коллок. / Ист. болезни</b></label>
                <br><br>
                <label><input type='radio' class='edit_type_lesson' id='edit_exam_rb' name='type_lesson' value='2'><b class='type_lesson'>Аттестация</b></label>
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
        <button id='create_lesson'>Новое занятие</button>
    </div>
    <div class='container'>
        <div class='fio'>
            <div class='title'>ФИО</div>\n" . $content . "
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
    $ret = "<div id='form-lesson' title='Создание лекции'>
    <form>
        <fieldset>
            <div class='box'>
            <div class='dat'>
                <b align='center'>Дата занятия</b>
                <div id='date_col'>
                    <input type='text' id='lesson-date' required class='datepicker' value='" . date('d.m.Y') . "'>
                </div>
            </div>
            <div class='number_theme'>
                <b align='center'>№ темы</b><br>
                <input type='text' id='number_theme' maxlength='2' onkeydown='return checkNumberThemeLesson(event);' onkeyup=\"this.value=this.value.replace(/[^0-9]/,'');\">
            </div>
                
            <br>
            </div>
        </fieldset>
    </form>
</div>



<div id='form-edit' title='Редактирование отметки'>
    <form id='form-edit'>
        <fieldset>
            <div class='panel'>
                 <b id='1' class='tool' title='Пропуск занятия целиком.'><b>Н</b></b>
                    <span class='space'></span>
                    <b id='11' class='tool absenteeism_closed' title='Занятие отработано.'><b>Отр.</b></b>
                    
                    
                <br><br>

                <input class='inp_cell' id='inp_0' type=text maxlength='0'
                       onkeydown='return proverka(event,0);' onblur='return proverka(event,0);' autocomplete='off'><br><br>
        </fieldset>      
                <hr class='marg-line'>
                <button id='close' class='attention'>Отмена</button>
                <button id='edit' class='button'>Сохранить</button>
                                
            </div>
        
    </form>
</div>

<div id=\"form-edit-date\" title=\"Редактирование даты занятия\">
    <form>
        <fieldset>
            <div class=\"box\">
            <div class='dat'>
                <b align='center'>Дата занятия</b><br>
                <input type='text' id='edit-lesson-date' required class='datepicker' value='" . date('d.m.Y') . "' placeholder='дд.мм.гггг'>
            </div>
            <div class='number_theme'>
                <b align='center'>№ темы</b><br>
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

<div class='container-list'>

    <div class='tools' align='center'>
        <button id='create_lesson'>Новая лекция</button>
    </div>
    <div class='container'>
        <div class='fio'>
            <div class='title'>ФИО</div>\n" . $content . "
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
    $preDiv = '';
    if ($countLev >= 2) {
        for ($ii = 0; $ii <= ($countLev - 1); $ii++) {
            switch ($_SESSION['SesVar']['Level'][$ii]) {
                case 1:
                    $preDiv .= "<p><a href='r.php'><strong>" . $_SESSION['SesVar']['Rector'][0] . "</strong> (" . $_SESSION['SesVar']['Rector'][1] . ")</a></p>";
                    break;
                case 2:
                    $preDiv .= "<p><a href='d.php'><strong>" . $_SESSION['SesVar']['Dekan'][0] . "</strong> (" . $_SESSION['SesVar']['Dekan'][1] . ")</a></p>";
                    break;
                /*            case 3:
                               echo "<p><a href='p.php'><strong>".$_SESSION['SesVar']['Prepod'][0]."</strong> (".$_SESSION['SesVar']['Prepod'][1].")</a></p>";
                               break;
                */
                case 4:
                    $preDiv .= "<p><a href='z.php'><strong>" . $_SESSION['SesVar']['Zav'][0] . "</strong> (" . $_SESSION['SesVar']['Zav'][1] . ")</a></p>";
                    break;
            }
        }
    }
    return "<div class='Exit'>".$preDiv."<a href='exit.php'><H2>Выход</H2></a></div><div class='C'></div>";
}

?>
