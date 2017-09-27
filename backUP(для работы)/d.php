<?php
unset($_SESSION['SesVar']);
session_start();

ini_set("display_errors", 1);

if(!isset($_SESSION['SesVar']['Auth']) || $_SESSION['SesVar']['Auth']!==true){
   echo "Access is denied!";
   exit;
}                  

$Nepuschu=0;
$countLev=count($_SESSION['SesVar']['Level']);
   for($ii=0; $ii<=($countLev-1); $ii++){
      if($_SESSION['SesVar']['Level'][$ii]==2) $Nepuschu=1;
   }

if(!$Nepuschu){
   echo "No access rights!";
   exit;
}


if(isset($_GET['menuactiv'])){
   switch($_GET['menuactiv']) {
   
    case "editLessonStudent":
       edtLessonStudent();
    break;
   
    case "goG":
      if($_GET['PL']==0){
         GroupViewP();
      } else if ($_GET['PL'] == 1){
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
}else{
   MainF();
}


//               echo "<br><br>".$_SESSION['SesVar']['Auth']."<br>";                  
//               echo $_SESSION['SesVar']['FIO'][0]." ".$_SESSION['SesVar']['FIO'][1]."<br>";                  
//               echo $_SESSION['SesVar']['Dekan'][0]." ".$_SESSION['SesVar']['Dekan'][1]." ".$_SESSION['SesVar']['Dekan'][2]."<br>";

//               $countPredmet=count($_SESSION['SesVar']['PredmetDekan']);
//               for($ii=0; $ii<=($countPredmet-1); $ii++){
//                  echo $_SESSION['SesVar']['PredmetDekan'][$ii][0]." ".$_SESSION['SesVar']['PredmetDekan'][$ii][1]."<br>";                  


//----------------------------------------------------------------------------------------------


function GroupViewL(){

   include_once 'configStudent.php';
   include_once 'configMain.php';
   $retVal="<p>".$_SESSION['SesVar']['Dekan'][0]." (".$_SESSION['SesVar']['Dekan'][1].")</p>";

   $retVal.="<h3>".$_GET['nPredmet']."<br>&nbsp;<font color='#ff0000'>&darr;</font><br>";
   $retVal.=$_GET['nF']."<br>&nbsp;<font color='#ff0000'>&darr;</font><br>";
   $retVal.="Группа № ".$_GET['nGroup']." (ЛЕКЦИЯ / <a href='d.php?menuactiv=goG&idPrepod=".$_SESSION['SesVar']['FIO'][0]."&idKaf=".$_SESSION['SesVar']['Prepod'][2]."&idPredmet=".$_GET['idPredmet']."&idF=".$_GET['idF']."&idGroup=".$_GET['idGroup']."&PL=0&nPredmet=".$_GET['nPredmet']."&nF=".$_GET['nF']."&nGroup=".$_GET['nGroup']."'>Практическое</a>)</h3><hr>";


   $retVal.="
    <input type='hidden' id='idSubject' value='".$_GET['idPredmet']."'>
    <input type='hidden' id='idPrepod' value='".$_GET['idPrepod']."'>
    <input type='hidden' id='idGroup' value='".$_GET['idGroup']."'>
    <input type='hidden' id='idPL' value='1'>";

   $result = mssql_query("SELECT IdStud, CONCAT(Name_F,' ',Name_I,' ',Name_O) FROM dbo.Student WHERE IdGroup=".$_GET['idGroup']." ORDER BY Name_F",$dbStud);
   $resultL = mysqli_query($dbMain, "SELECT id, LDate, PKE, DATE_FORMAT(LDate,'%e.%m.%Y') FROM lesson WHERE idGroup=".$_GET['idGroup']." AND idLessons=".$_GET['idPredmet']." AND PL=1 ORDER BY LDate,id");

   if(mysqli_num_rows($resultL)>=1){
      $preStud = "";
      $preRating = "";

      if(mssql_num_rows($result)>=1){
         $arrStud = Array();
         $i=0;
         while($arrS = mssql_fetch_row($result)){            
            $preStud.="<div class='fio_student' data-idStudent='".$arrS[0]."'>".$arrS[1]."</div>\n";
            $arrStud[$i]=$arrS[0];
            if(!$i){ $sqlStud="idStud=".$arrS[0].""; }else{ $sqlStud.=" OR idStud=".$arrS[0].""; }
            $i++;
         }
         $countarrStud = count($arrStud);

         if(mysqli_num_rows($resultL)>=1){
            while($arr = mysqli_fetch_row($resultL)){
               $prepreRating = "";
               switch($arr[2]){
                  case 1:
                     $prepreRating.="<div class='date_col colloquium_theme'><div class='date_title' data-idLesson='".$arr[0]."'>".$arr[3]."</div>\n";
                  break;
                  case 2:
                     $prepreRating.="<div class='date_col exam_theme'><div class='date_title' data-idLesson='".$arr[0]."'>".$arr[3]."</div>\n";
                  break;
                  default:
                     $prepreRating.="<div class='date_col'><div class='date_title' data-idLesson='".$arr[0]."'>".$arr[3]."</div>\n";
                  break;
               }
               $resultS = mysqli_query($dbMain, "SELECT id, idStud, RatingO FROM rating WHERE (".$sqlStud.") AND PKE=".$arr[2]." AND idLesson=".$arr[0]." AND idLessons=".$_GET['idPredmet']." AND PL=1");               
               $arrSStud = Array();               
               if(mysqli_num_rows($resultS)>=1){
                  $ii=0;
                  while($arrSS = mysqli_fetch_row($resultS)){            
                     $arrSStud[$ii]=array($arrSS[0],$arrSS[1],$arrSS[2]);
                     $ii++;
                  }
               }
               mysqli_free_result($resultS); 
  
               $countSStud = count($arrSStud);
               for($iS=0; $iS<=($countarrStud-1); $iS++){
                  $trueS=0;
                  for($iSS=0; $iSS<=($countSStud-1); $iSS++){
                     if($arrStud[$iS]==$arrSStud[$iSS][1]){
                        $prepreRating.="<div class='grade' data-idLes=".$arr[0]." data-idStudent=".$arrStud[$iS]." data-PKE=".$arr[2]." data-zapis=".$arrSStud[$iSS][0].">".$arrSStud[$iSS][2]."</div>";
                        $trueS=1;
                     }
                  }                  
                  if(!$trueS){ $prepreRating.="<div class='grade' data-idLes=".$arr[0]." data-idStudent=".$arrStud[$iS]." data-PKE=".$arr[2]." data-zapis=0></div>"; }
               }

               $preRating.=$prepreRating."</div>";
            }
         }

      }

      $retVal.=StudentViewL($preStud,$preRating);

   }else{
         if(mssql_num_rows($result)>=1){
            $preStud = "";
            while($arrStud = mssql_fetch_row($result)){            
               $preStud.="<div class='fio_student' data-idStudent='".$arrStud[0]."'>".$arrStud[1]."</div>\n";
            }
            $retVal.=StudentViewL($preStud);
         }
   }

   mssql_free_result($result);
   mysqli_free_result($resultL);   
   

   echo HeaderFooterGroupL($retVal, "№ ".$_GET['nGroup']);



}


//----------------------------------------------------------------------------------------------


function edtLessonStudent(){
   include_once 'configMain.php';   
   mysqli_query($dbMain, "UPDATE rating SET RatingO=".$_GET['grades']." WHERE id=".$_GET['id_Zapis']." AND idStud=".$_GET['idStudent']);
} 





//----------------------------------------------------------------------------------------------


function GroupViewP(){
   include_once 'configStudent.php';
   include_once 'configMain.php';
   $retVal="<p>".$_SESSION['SesVar']['Dekan'][0]." (".$_SESSION['SesVar']['Dekan'][1].")</p>";

   $retVal.="<h3>".$_GET['nPredmet']."<br>&nbsp;<font color='#ff0000'>&darr;</font><br>";
   $retVal.=$_GET['nF']."<br>&nbsp;<font color='#ff0000'>&darr;</font><br>";
   $retVal.="Группа № ".$_GET['nGroup']." (ПРАКТИЧЕСКОЕ / <a href='d.php?menuactiv=goG&idPrepod=".$_SESSION['SesVar']['FIO'][0]."&idKaf=".$_SESSION['SesVar']['Prepod'][2]."&idPredmet=".$_GET['idPredmet']."&idF=".$_GET['idF']."&idGroup=".$_GET['idGroup']."&PL=1&nPredmet=".$_GET['nPredmet']."&nF=".$_GET['nF']."&nGroup=".$_GET['nGroup']."'>Лекция</a>)</h3><hr>";


   $retVal.="
    <input type='hidden' id='idSubject' value='".$_GET['idPredmet']."'>
    <input type='hidden' id='idPrepod' value='".$_GET['idPrepod']."'>
    <input type='hidden' id='idGroup' value='".$_GET['idGroup']."'>
    <input type='hidden' id='idPL' value='0'>";

   $result = mssql_query("SELECT IdStud, CONCAT(Name_F,' ',Name_I,' ',Name_O) FROM dbo.Student WHERE IdGroup=".$_GET['idGroup']." ORDER BY Name_F",$dbStud);
   $resultL = mysqli_query($dbMain, "SELECT id, LDate, PKE, DATE_FORMAT(LDate,'%e.%m.%Y') FROM lesson WHERE idGroup=".$_GET['idGroup']." AND idLessons=".$_GET['idPredmet']." AND PL=0 ORDER BY LDate,id");

   if(mysqli_num_rows($resultL)>=1){
      $preStud = "";
      $preRating = "";

      if(mssql_num_rows($result)>=1){
         $arrStud = Array();
         $i=0;
         while($arrS = mssql_fetch_row($result)){            
            $preStud.="<div class='fio_student' data-idStudent='".$arrS[0]."'>".$arrS[1]."</div>\n";
            $arrStud[$i]=$arrS[0];
            if(!$i){ $sqlStud="idStud=".$arrS[0].""; }else{ $sqlStud.=" OR idStud=".$arrS[0].""; }
            $i++;
         }
         $countarrStud = count($arrStud);

         if(mysqli_num_rows($resultL)>=1){
            while($arr = mysqli_fetch_row($resultL)){
               $prepreRating = "";
               switch($arr[2]){
                  case 1:
                     $prepreRating.="<div class='date_col colloquium_theme'><div class='date_title' data-idLesson='".$arr[0]."'>".$arr[3]."</div>\n";
                  break;
                  case 2:
                     $prepreRating.="<div class='date_col exam_theme'><div class='date_title' data-idLesson='".$arr[0]."'>".$arr[3]."</div>\n";
                  break;
                  default:
                     $prepreRating.="<div class='date_col'><div class='date_title' data-idLesson='".$arr[0]."'>".$arr[3]."</div>\n";
                  break;
               }
               $resultS = mysqli_query($dbMain, "SELECT id, idStud, RatingO FROM rating WHERE (".$sqlStud.") AND PKE=".$arr[2]." AND idLesson=".$arr[0]." AND idLessons=".$_GET['idPredmet']." AND PL=0");               
               $arrSStud = Array();               
               if(mysqli_num_rows($resultS)>=1){
                  $ii=0;
                  while($arrSS = mysqli_fetch_row($resultS)){            
                     $arrSStud[$ii]=array($arrSS[0],$arrSS[1],$arrSS[2]);
                     $ii++;
                  }
               }
               mysqli_free_result($resultS); 
  
               $countSStud = count($arrSStud);
               for($iS=0; $iS<=($countarrStud-1); $iS++){
                  $trueS=0;
                  for($iSS=0; $iSS<=($countSStud-1); $iSS++){
                     if($arrStud[$iS]==$arrSStud[$iSS][1]){
                        $prepreRating.="<div class='grade' data-idLes=".$arr[0]." data-idStudent=".$arrStud[$iS]." data-PKE=".$arr[2]." data-zapis=".$arrSStud[$iSS][0].">".$arrSStud[$iSS][2]."</div>";
                        $trueS=1;
                     }
                  }                  
                  if(!$trueS){ $prepreRating.="<div class='grade' data-idLes=".$arr[0]." data-idStudent=".$arrStud[$iS]." data-PKE=".$arr[2]." data-zapis=0></div>"; }
               }

               $preRating.=$prepreRating."</div>";
            }
         }

      }

      $retVal.=StudentView($preStud,$preRating);

   }else{
         if(mssql_num_rows($result)>=1){
            $preStud = "";
            while($arrStud = mssql_fetch_row($result)){            
               $preStud.="<div class='fio_student' data-idStudent='".$arrStud[0]."'>".$arrStud[1]."</div>\n";
            }
            $retVal.=StudentView($preStud);
         }
   }

   mssql_free_result($result);
   mysqli_free_result($resultL);   
   

   echo HeaderFooterGroup($retVal, "№ ".$_GET['nGroup']);

}




//----------------------------------------------------------------------------------------------


function Fakultet(){
   include_once 'configStudent.php';
   include_once 'configMain.php';
   include_once 'config.php';

   $retVal="<p>".$_SESSION['SesVar']['Dekan'][0]." (".$_SESSION['SesVar']['Dekan'][1].")</p>";

   $resPredmet = mysqli_query($dbMain, "SELECT name FROM lessons WHERE id=".$_GET['idPredmet']."");
      if(mysqli_num_rows($resPredmet)>=1){
      list($Pre)=mysqli_fetch_row($resPredmet);
      $retVal.="<h3>$Pre<br>&nbsp;<font color='#ff0000'>&darr;</font><br>";
         $result = mssql_query("SELECT Name FROM dbo.Facultets WHERE IdF=".$_GET['idF']."",$dbStud);
         if(mssql_num_rows($result)>=1){
            list($idName)=mssql_fetch_row($result);
            $retVal.="$idName</h3><hr>";



      $retVal.="
      <div class='DialogP'>
      <div class='titleBox'><H2>Группы</H2></div>
      ";
      if($_GET['idF']==283){
         $result = mssql_query("SELECT IdGroup, Name FROM dbo.Groups WHERE ((IdF=".$_GET['idF']." AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<".$fac[$_GET['idF']][1]." AND LEN(Name)>=4) OR (LEFT(Name,1)='".$fac[$_GET['idF']][0]."' AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<=".$fac[$_GET['idF']][1]." AND LEN(Name)>=4)) OR ((IdF=".$_GET['idF']." AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<".$fac[$_GET['idF']][3]." AND LEN(Name)>=4) OR (LEFT(Name,1)='".$fac[$_GET['idF']][2]."' AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<=".$fac[$_GET['idF']][3]." AND LEN(Name)>=4)) ORDER BY Name",$dbStud);
      } else {
         $result = mssql_query("SELECT IdGroup, Name FROM dbo.Groups WHERE (IdF=".$_GET['idF']." AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<".$fac[$_GET['idF']][1]." AND LEN(Name)>=4) OR (LEFT(Name,1)='".$fac[$_GET['idF']][0]."' AND DATEDIFF(month,CONCAT(Year,'0101'),GETDATE())<=".$fac[$_GET['idF']][1]." AND LEN(Name)>=4) ORDER BY Name",$dbStud);
      }
         if(mssql_num_rows($result)>=1){
            $preChar="";
            while($arr = mssql_fetch_row($result)){
               if($preChar!=substr($arr[1], 0, 2)) $retVal.="<div class='HRnext'></div>"; $preChar = substr($arr[1], 0, 2);
               $retVal.="<div class='DialogGr'><strong>".$arr[1]."</strong><div class='GroupPL'>";
               $retVal.="<a href='d.php?menuactiv=goG&idPrepod=".$_SESSION['SesVar']['FIO'][0]."&idKaf=".$_SESSION['SesVar']['Prepod'][2]."&idPredmet=".$_GET['idPredmet']."&idF=".$_GET['idF']."&idGroup=".$arr[0]."&PL=0&nPredmet=".$Pre."&nF=".$idName."&nGroup=".$arr[1]."'>Практ.</a>&nbsp;|&nbsp;";      
               $retVal.="<a href='d.php?menuactiv=goG&idPrepod=".$_SESSION['SesVar']['FIO'][0]."&idKaf=".$_SESSION['SesVar']['Prepod'][2]."&idPredmet=".$_GET['idPredmet']."&idF=".$_GET['idF']."&idGroup=".$arr[0]."&PL=1&nPredmet=".$Pre."&nF=".$idName."&nGroup=".$arr[1]."'>Лекция</a>";      
               $retVal.="</div></div></div>\n";
            }
         }
      
      $retVal.="</div>";





         }
   }

   mssql_free_result($result);
   mysqli_free_result($resPredmet);   

   echo HeaderFooter($retVal, $_SESSION['SesVar']['Prepod'][0]." (".$_SESSION['SesVar']['Prepod'][1].")");
}


//----------------------------------------------------------------------------------------------

//               echo "<br><br>".$_SESSION['SesVar']['Auth']."<br>";                  
//               echo $_SESSION['SesVar']['FIO'][0]." ".$_SESSION['SesVar']['FIO'][1]."<br>";                  
//               echo $_SESSION['SesVar']['Dekan'][0]." ".$_SESSION['SesVar']['Dekan'][1]." ".$_SESSION['SesVar']['Dekan'][2]."<br>";

//               $countPredmet=count($_SESSION['SesVar']['PredmetDekan']);
//               for($ii=0; $ii<=($countPredmet-1); $ii++){
//                  echo $_SESSION['SesVar']['PredmetDekan'][$ii][0]." ".$_SESSION['SesVar']['PredmetDekan'][$ii][1]."<br>";                  


function MainF(){
$retVal="<p>".$_SESSION['SesVar']['Dekan'][0]." (".$_SESSION['SesVar']['Dekan'][1].")</p><hr>";

   $countPredmet=count($_SESSION['SesVar']['PredmetDekan']);
   $retVal.="
      <div class='DialogP'>
      <div class='titleBox'><H2>Дисциплина</H2></div>
   ";

   include_once 'configStudent.php';

   for($ii=0; $ii<=($countPredmet-1); $ii++){
      $retVal.="<div class='DialogFakFak'><a href='d.php?menuactiv=goF&idPrepod=".$_SESSION['SesVar']['FIO'][0]."&idKaf=".$_SESSION['SesVar']['Prepod'][2]."&idPredmet=".$_SESSION['SesVar']['PredmetDekan'][$ii][0]."&idF=".$_SESSION['SesVar']['Dekan'][2]."'>".$_SESSION['SesVar']['PredmetDekan'][$ii][1]."</a>";
      $retVal.="</div>";
   }
   $retVal.="</div>";
   echo HeaderFooter($retVal, $_SESSION['SesVar']['Dekan'][0]." (".$_SESSION['SesVar']['Dekan'][1].")");
}


//----------------------------------------------------------------------------------------------

function HeaderFooter($content,$title){
?>
<!doctype html>
<html>
<head>
    <meta charset="windows-1251">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title><?php echo $title; ?></title>
</head>
<body>
<div class="Exit"><a href="exit.php" title="Выхожу">Выхожу</a></div>
<div class="Header"><H2><?php echo $_SESSION['SesVar']['FIO'][1]; ?><H2></div>

<?php echo $content; ?>
<div style="clear:both; margin-bottom:100px;">&nbsp;</div>
</body>
</html>
<?php
}

function HeaderFooterGroup($content,$title){
?>

<!doctype html>
<head>
    <meta charset="windows-1251">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="scripts/jquery-ui.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title><?php echo $title; ?></title>
    <script src="scripts/jquery-3.2.1.min.js"></script>
    <script src="scripts/jquery-ui.js"></script>
    <script src="scripts/jquery.maskedinput.js"></script>
    <script src="scripts/scriptDec.js"></script>
    <script src="scripts/corporate.js"></script>
</head>
<body>
<div class="Exit"><a href="exit.php" title="Выхожу">Выхожу</a></div>
<div class="Header"><H2><?php echo $_SESSION['SesVar']['FIO'][1]; ?><H2></div>

<?php echo $content; ?>
<div style="clear:both; margin-bottom:100px;">&nbsp;</div>
</body>
</html>
<?php
}


function HeaderFooterGroupL($content,$title){
?>

<!doctype html>
<head>
    <meta charset="windows-1251">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="scripts/jquery-ui.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title><?php echo $title; ?></title>
    <script src="scripts/jquery-3.2.1.min.js"></script>
    <script src="scripts/jquery-ui.js"></script>
    <script src="scripts/jquery.maskedinput.js"></script>
    <script src="scripts/scriptDecLec.js"></script>
    <script src="scripts/corporate.js"></script>
</head>
<body>
<div class="Exit"><a href="exit.php" title="Выхожу">Выхожу</a></div>
<div class="Header"><H2><?php echo $_SESSION['SesVar']['FIO'][1]; ?><H2></div>

<?php echo $content; ?>
<div style="clear:both; margin-bottom:100px;">&nbsp;</div>
</body>
</html>
<?php
}




//----------------------------------------------------------------------------------------------

function StudentView($content,$contentO=''){
$ret="<div id='form-edit' title='Редактировать отметку'>
    <form id='form-edit'>
        <fieldset>
            <div class='panel'>
                <div id=\"panel\">
                    <b id=\"1\" class=\"tool\"><b>Н<sub>у</sub></b></b>
                    <span class=\"space\"></span>
                    <b id=\"2\" class=\"tool\"><b>Н<sub>б.у</sub></b></b>
                    <span class=\"space\"></span>
                    <b id=\"3\" class=\"tool\"><b>Н<sub>б.о.</sub></b></b>
                </div>

                <br><br>

                <input class='inp_cell' id=\"inp_0\" type=text maxlength='6'
                       onkeydown=\"return proverka(event,0);\">
                <input class='inp_cell' id=\"inp_1\" type='text' maxlength='6'
                       onkeydown=\"return proverka(event,1);\">
                <input class='inp_cell' id=\"inp_2\" type='text' maxlength='6'
                       onkeydown=\"return proverka(event,2);\">

                <br>
                <hr>
                <br>
                <button id='edit' class='button'><b>ОК</b></button>
                <button id='close' class='attention'><b>Отмена</b></button>
            </div>
        </fieldset>
    </form>
</div>


<div class='container-list'>
    <div class='container'>
        <div class='fio'>
            <div class='title'>ФИО</div>".$content."
        </div>

        <div class='result_box_statistic'><div class='date_col hidden'></div>".$contentO."</div><div class='statistic'></div>
    </div>
</div>";

return $ret;
}



//----------------------------------------------------------------------------------------------



function StudentViewL($content,$contentO=''){
$ret="<div id='form-edit' title='Редактирование отметки'>
    <form id='form-edit'>
        <fieldset>
            <div class='panel'>
                <div id=\"panel\">
                    <b id=\"1\" class=\"tool\"><b>Н<sub>у</sub></b></b>
                    <span class=\"space\"></span>
                    <b id=\"2\" class=\"tool\"><b>Н<sub>б.у</sub></b></b>
                    <span class=\"space\"></span>
                    <b id=\"3\" class=\"tool\"><b>Н<sub>б.о.</sub></b></b>
                </div>

                <br><br>


                <input class='inp_cell' id=\"inp_0\" type=text maxlength='6'
                       onkeydown=\"return proverka(event,0);\">

                <br>
                <hr>
                <br>
                <button id='edit' class='button'><b>ОК</b></button>
                <button id='close' class='attention'><b>Отмена</b></button>
            </div>
        </fieldset>
    </form>
</div>

<div class='container-list'>

    <div class='container'>
        <div class='fio'>
            <div class='title'>ФИО</div>".$content."
        </div>

        <div class='result_box'><div class='date_col hidden'></div>".$contentO."

        </div>
        <div class='statistic'></div>
    </div>
</div>";

return $ret;
}
?>