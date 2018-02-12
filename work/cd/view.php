<?php
unset($_SESSION['SesStud']);
session_start();

ini_set("display_errors", 1);

if (!isset($_SESSION['SesStud']['Auth']) || $_SESSION['SesStud']['Auth'] !== true) {
    echo "<div class='Not'>Время просмотра истекло!</div>";
    exit;
}


if (isset($_GET['idSubject']) && is_numeric($_GET['idSubject']) && isset($_GET['idStudent']) && is_numeric($_GET['idStudent'])) {
    $_GET['idSubject'] = substr($_GET['idSubject'], 0, 4);
    $_GET['idStudent'] = substr($_GET['idStudent'], 0, 6);
    GroupViewP($_GET['idSubject'], $_GET['idStudent']);
} else {
    MainF();
}

function GroupViewP($idSu, $idSt)
{
    include_once 'configMain.php';

    $resultS = mysqli_query($dbMain, "SELECT DATE_FORMAT(B.LDate,'%e.%m.%Y'), A.RatingO, A.PL, A.PKE FROM rating A LEFT JOIN lesson B ON (B.id=A.idLesson) WHERE A.idStud=" . $idSt . " AND A.idLessons=" . $idSu . " AND A.del=0 ORDER BY A.PL,B.LDate");
    if (mysqli_num_rows($resultS) >= 1) {
        $retVal = "";
        $trueS = 0;
        $retVal .= "<div id='selAll' class='sel_tool'> Выделить все</div> <div id='canselSelAll' class='sel_tool'> Отменить выделение</div><div class='replaceAbs'>Заменить прогулы</div><br><br>";
        while ($arrSS = mysqli_fetch_row($resultS)) {

            if (!$arrSS[2] && !$trueS) {
                $trueS = 1;
                $retVal .= "<div class='titleO'>Практические</div>\n
                            <input type='hidden' id='idPL' value='0'>";
            } else if ($arrSS[2] && $trueS) {
                $trueS = 0;
                $retVal .= "<div class='clr'></div><div class='titleO'>Лекции</div>\n
                            <input type='hidden' id='idPL' value='1'>";
            }
            switch ($arrSS[3]) {
                case 1:
                    $retVal .= "<div class='Oc Koll' title='Коллоквиум / История болезни'><div class='DataO'>" . $arrSS[0] . "</div><div class='Otmetka'>" . $arrSS[1] . "</div></div>\n";
                    break;
                case 2:
                    $retVal .= "<div class='Oc Exm' title='Аттестация'><div class='DataO'>" . $arrSS[0] . "</div><div class='Otmetka'>" . $arrSS[1] . "</div></div>\n";
                    break;
                default:
                    $retVal .= "<div class='Oc'><div class='DataO'>" . $arrSS[0] . "</div><div class='Otmetka'>" . $arrSS[1] . "</div></div>\n";
                    break;
            }

        }
        mysqli_free_result($resultS);
        echo $retVal;
        unset($retVal);
    } else {
        echo "<div class='Not'>По данной дисциплине отметок ещё нет!</div>";
    }
}


//----------------------------------------------------------------------------------------------


function MainF()
{
    $retVal = "<p>Группа № <strong>" . $_SESSION['SesStud']['gnameS'] . "</strong> (" . $_SESSION['SesStud']['kursS'] . "-й курс)<br>" . $_SESSION['SesStud']['fnameS'] . "</p><hr>";

    $countPredmet = count($_SESSION['SesStud']['Predmet']);
    $retVal .= "\n<div class='DialogP'><div class='titleBox'><H2>Дисциплина</H2></div>\n";

    include_once 'configStudent.php';

    for ($ii = 0; $ii <= ($countPredmet - 1); $ii++) {
        $retVal .= "<div class='DialogFakFak' data-idSubject='" . $_SESSION['SesStud']['Predmet'][$ii][0] . "'>\n<span class='shortText'>" . $_SESSION['SesStud']['Predmet'][$ii][2] . "</span>\n<span class='fullText'>" . $_SESSION['SesStud']['Predmet'][$ii][1] . "</span>&nbsp;<span class='fullTextClose' title='Закрыть'>X</span>\n<div class='content_grade'></div>\n" . ($_SESSION['SesStud']['Predmet'][$ii][3] ? "<div class='CO' title='Количество отметок: " . $_SESSION['SesStud']['Predmet'][$ii][3] . "'>" . $_SESSION['SesStud']['Predmet'][$ii][3] . "</div>\n" : "") . "</div>\n";
    }
    $retVal .= "</div>\n";
    echo HeaderFooter($retVal, $verC, $verS);
}


//----------------------------------------------------------------------------------------------


function HeaderFooter($content, $vC = '', $vS = '')
{
    ?>
    <!doctype html>
    <html>
    <head>
        <title><?php echo $_SESSION['SesStud']['nameS']; ?></title>
        <meta charset="windows-1251">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css<?php echo $vC; ?>">
        <link rel="stylesheet" href="scripts/jquery-ui.css">
        <script src="scripts/jquery-3.2.1.min.js"></script>
        <script src="scripts/jquery-ui.js"></script>
        <script src="scripts/viewGrade.js<?php echo $vS; ?>"></script>
        <script src="scripts/corporate.js<?php echo $vS; ?>"></script>


    </head>
    <body>
    <?php echo LevelView(); ?>
    <input type='hidden' id='idStudent' value='<?php echo $_SESSION['SesStud']['idS']; ?>'>
    <div class="Header"><H2><?php echo $_SESSION['SesStud']['nameS']; ?></H2></div>
    <?php echo $content; ?>
    <div style="clear:both; margin-bottom:100px;">&nbsp;</div>
    <div id='form-edit' title='Заменить прогул'>
        <form id='form-edit'>
            <fieldset>
                <div class='panel'>
                    <b id='1' class='tool'><b>Н<sub>у</sub></b></b><span class='space'></span>
                    <b id='2' class='tool'><b>Н<sub>б.у</sub></b></b><span class='space'></span>
                    <b id='3' class='tool'><b>Н<sub>б.о.</sub></b></b><span class='space'></span>

                    <br><br>

                    <input class='inp_cell' id='inp_0' type=text maxlength='0'
                           onkeydown='return proverka(event,0);' onblur='return proverka(event,0);'>

                    <br><br>
            </fieldset>
            <hr class='marg-line'>
            <button id='close' class='attention'>Отмена</button>
            <button id='edit' class='button'>Заменить</button>
        </form>
    </div>
    </body>
    </html>
    <?php
}

function LevelView()
{
    return "
<div class='Exit'>
<div class='Kvadrat OO'></div><div>Обычная отметка</div><div class='C'></div>
<div class='Kvadrat OK'></div><div>Коллоквиум / История болезни</div><div class='C'></div>
<div class='Kvadrat OE'></div><div>Аттестация (экзамен)</div><div class='C'></div>
</div>
<div class='C'></div>";
}

?>
