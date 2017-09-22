<?php

unset($_SESSION['SesVar']);
session_start();

if(!isset($_SESSION['SesVar']['Auth']) || $_SESSION['SesVar']['Auth']!==true){
   echo "Доступ запрещён!";
   exit;
}                  



//               echo $_SESSION['SesVar']['Auth']."<br>";                  
//               echo $_SESSION['SesVar']['FIO'][0]." ".$_SESSION['SesVar']['FIO'][1]."<br>";                  
//               echo $_SESSION['SesVar']['Prepod'][0]." ".$_SESSION['SesVar']['Prepod'][1]." ".$_SESSION['SesVar']['Prepod'][2]."<br>";

//               $countPredmet=count($_SESSION['SesVar']['Predmet']);
//               for($ii=0; $ii<=($countPredmet-1); $ii++){
//                  echo $_SESSION['SesVar']['Predmet'][$ii][0]." ".$_SESSION['SesVar']['Predmet'][$ii][1]." ".$_SESSION['SesVar']['Predmet'][$ii][2]."<br>";                  
//               }



//               echo "<br><br>".$_SESSION['SesVar']['Auth']."<br>";                  
//               echo $_SESSION['SesVar']['FIO'][0]." ".$_SESSION['SesVar']['FIO'][1]."<br>";                  
//               echo $_SESSION['SesVar']['Dekan'][0]." ".$_SESSION['SesVar']['Dekan'][1]." ".$_SESSION['SesVar']['Dekan'][2]."<br>";

//               $countPredmet=count($_SESSION['SesVar']['PredmetDekan']);
//               for($ii=0; $ii<=($countPredmet-1); $ii++){
//                  echo $_SESSION['SesVar']['PredmetDekan'][$ii][0]." ".$_SESSION['SesVar']['PredmetDekan'][$ii][1]."<br>";                  
//               }



//               echo "<br><br>".$_SESSION['SesVar']['Auth']."<br>";                  
//               echo $_SESSION['SesVar']['FIO'][0]." ".$_SESSION['SesVar']['FIO'][1]."<br>";      
//               echo $_SESSION['SesVar']['Rector'][0]." ".$_SESSION['SesVar']['Rector'][1]."<br>";            

?>

<!doctype html>
<head>
    <meta charset="windows-1251">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Куда идём?</title>
</head>
<body>
<div class="Exit"><a href="exit.php" title="Выйти">Выйти</a></div>
<div class="Header"><H1><?php echo $_SESSION['SesVar']['FIO'][1]; ?><H1></div>
<div class="DialogV">
<div class="titleBox"><H2>Куда идём?</H2></div>
<?php
      $countLev=count($_SESSION['SesVar']['Level']);
      for($ii=0; $ii<=($countLev-1); $ii++){
         switch($_SESSION['SesVar']['Level'][$ii]){
            case 1:
               echo "<p><a href='r.php'><strong>".$_SESSION['SesVar']['Rector'][0]."</strong> (".$_SESSION['SesVar']['Rector'][1].")</a></p>";
               break;
            case 2:
               echo "<p><a href='d.php'><strong>".$_SESSION['SesVar']['Dekan'][0]."</strong> (".$_SESSION['SesVar']['Dekan'][1].")</a></p>";
               break;
            case 3:
               echo "<p><a href='p.php'><strong>".$_SESSION['SesVar']['Prepod'][0]."</strong> (".$_SESSION['SesVar']['Prepod'][1].")</a></p>";
               break;
         }
      }
?>
</div>
</body>
</html>