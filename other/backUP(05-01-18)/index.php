<?php
unset($_SESSION['SesVar']);
session_unset();
session_destroy();
ini_set("display_errors", 1);
session_start();

$_SESSION['SesVar']['Auth']=false;                  


/*
if(isset($_GET['go']) && $_GET['go']=='exit'){
   ExitFromSystem();
}
*/


// $dbStud - указатель на соединения с БД Студенты (mssql)
// $dbMain - указатель на соединения с БД Главной (mysqli)


if(isset($_SERVER['REMOTE_USER']) && strlen($_SERVER['REMOTE_USER'])>=3){
   $validUser = GetLU($_SERVER['REMOTE_USER']);
   if(!$validUser){
      echo "Не найден пользователь в LDAP или проблемы с данными!";
      exit;
   } else {
      include_once 'configMain.php';
      include_once 'configStudent.php';
      $LdapBDUser = GetMainBD($validUser,$dbMain,$dbStud);
   }
} else {
   echo "Проблемы с логином пользователя!";
   exit;
}




function GetStudentBD($namekaf,$dbStud){
   $result = mssql_query("SELECT IdF FROM dbo.Facultets WHERE Name='".$namekaf."'",$dbStud) or die ("Ошибка: не могу отправить запрос на сервер Студенты со стороны преподавателя");
   if(mssql_num_rows($result)>=1){
      list($idKaf)=mssql_fetch_row($result);
      return $idKaf;      
   } else {
      return false;
   }

   mssql_free_result($result);
}


function GetStudentBDDekan($namekaf,$dbStud){
   $result = mssql_query("SELECT IdF FROM dbo.Facultets WHERE From1C='".$namekaf."'",$dbStud) or die ("Ошибка: не могу отправить запрос на сервер Студенты со стороны декана");
   if(mssql_num_rows($result)>=1){
      list($idKaf)=mssql_fetch_row($result);
      return $idKaf;      
   } else {
      return false;
   }

   mssql_free_result($result);
}

function GetStudentBDRector($namekaf,$dbStud){
   $result = mssql_query("SELECT IdF FROM dbo.Facultets WHERE From1C='".$namekaf."'",$dbStud) or die ("Ошибка: не могу отправить запрос на сервер Студенты со стороны декана");
   if(mssql_num_rows($result)>=1){
      list($idKaf)=mssql_fetch_row($result);
      return $idKaf;      
   } else {
      return false;
   }

   mssql_free_result($result);
}


function GetMainBD($vser,$dbMain,$dbStud){
   include_once 'configMain.php';   
   $resM = mysqli_query($dbMain, "SELECT id, fio, department, favor FROM employees2 WHERE valid='$vser'");
   if(mysqli_num_rows($resM)>=1){
      list($id, $fio, $department, $favor)=mysqli_fetch_row($resM);
      $_SESSION['SesVar']['FIO']=Array($id,$fio,$favor);
      $department = explode("#",$department);
      $countdep=count($department);
      $Indepartment = array();  
      $lev = 0;
      $levIndex = 0;
      $levTrue = 1;
      
      for($i=0; $i<=($countdep-1); $i++){
         $Indepartment[$i] = explode("=",$department[$i]);
         $resM = mysqli_query($dbMain, "SELECT level FROM postoffice WHERE name='".$Indepartment[$i][0]."'");
         if(mysqli_num_rows($resM)>=1){
            list($lev)=mysqli_fetch_row($resM);

            if($lev == 3 && $levTrue){
               $_SESSION['SesVar']['Level'][$levIndex] = $lev;
               $levIndex++;
               $idKaf=GetStudentBD($Indepartment[$i][1],$dbStud);
               if($idKaf){
                  $resPredmet = mysqli_query($dbMain, "SELECT id, IF(CHAR_LENGTH(name)>88,CONCAT(LEFT(name, 85),'...'),name), f1, f2, f3, f4, f5, f6, f7, f8, f9, f10 FROM lessons WHERE k1=$idKaf or k2=$idKaf or k3=$idKaf or k4=$idKaf or k5=$idKaf or k6=$idKaf or k7=$idKaf or k8=$idKaf ORDER BY name");
                  if(mysqli_num_rows($resPredmet)>=1){
                     $iPredmet = 0;
                     while($arr = mysqli_fetch_row($resPredmet)){
                        $fak='';
                        if($arr[2]>0){
                           $fak=$arr[2];
                           if($arr[3]>0) $fak.="%".$arr[3]; 
                           if($arr[4]>0) $fak.="%".$arr[4]; 
                           if($arr[5]>0) $fak.="%".$arr[5]; 
                           if($arr[6]>0) $fak.="%".$arr[6]; 
                           if($arr[7]>0) $fak.="%".$arr[7]; 
                           if($arr[8]>0) $fak.="%".$arr[8]; 
                           if($arr[9]>0) $fak.="%".$arr[9]; 
                           if($arr[10]>0) $fak.="%".$arr[10]; 
                           if($arr[11]>0) $fak.="%".$arr[11]; 
                        }                     
                        $_SESSION['SesVar']['Predmet'][$iPredmet]=Array($arr[0],$arr[1],$fak);
                        $iPredmet++;
                     }
                  }
                  mysqli_free_result($resPredmet);
                  $_SESSION['SesVar']['Prepod']=Array($Indepartment[$i][0],$Indepartment[$i][1],$idKaf);
                  $_SESSION['SesVar']['Auth']=true;                  
                  $levTrue = 0;
               }

//               echo $_SESSION['SesVar']['Auth']."<br>";                  
//               echo $_SESSION['SesVar']['FIO'][0]." ".$_SESSION['SesVar']['FIO'][1]."<br>";                  
//               echo $_SESSION['SesVar']['Prepod'][0]." ".$_SESSION['SesVar']['Prepod'][1]." ".$_SESSION['SesVar']['Prepod'][2]."<br>";

//               $countPredmet=count($_SESSION['SesVar']['Predmet']);
//               for($ii=0; $ii<=($countPredmet-1); $ii++){
//                  echo $_SESSION['SesVar']['Predmet'][$ii][0]." ".$_SESSION['SesVar']['Predmet'][$ii][1]." ".$_SESSION['SesVar']['Predmet'][$ii][2]."<br>";                  
//               }


            } else if($lev == 2) {
               $_SESSION['SesVar']['Level'][$levIndex] = $lev;
               $levIndex++;
               $idDek=GetStudentBDDekan($Indepartment[$i][1],$dbStud);
               if($idDek){
                  $resPredmet = mysqli_query($dbMain, "SELECT id, IF(CHAR_LENGTH(name)>88,CONCAT(LEFT(name, 85),'...'),name) FROM lessons WHERE f1=$idDek or f2=$idDek or f3=$idDek or f4=$idDek or f5=$idDek or f6=$idDek or f7=$idDek or f8=$idDek or f9=$idDek or f10=$idDek ORDER BY name");
                  if(mysqli_num_rows($resPredmet)>=1){
                     $iPredmet = 0;
                     while($arr = mysqli_fetch_row($resPredmet)){
                        $_SESSION['SesVar']['PredmetDekan'][$iPredmet]=Array($arr[0],$arr[1]);
                        $iPredmet++;
                     }
                  }
                  mysqli_free_result($resPredmet);
                  $_SESSION['SesVar']['Dekan']=Array($Indepartment[$i][0],$Indepartment[$i][1],$idDek);
                  $_SESSION['SesVar']['Auth']=true;                  
               }

//               echo "<br><br>".$_SESSION['SesVar']['Auth']."<br>";                  
//               echo $_SESSION['SesVar']['FIO'][0]." ".$_SESSION['SesVar']['FIO'][1]."<br>";                  
//               echo $_SESSION['SesVar']['Dekan'][0]." ".$_SESSION['SesVar']['Dekan'][1]." ".$_SESSION['SesVar']['Dekan'][2]."<br>";

//               $countPredmet=count($_SESSION['SesVar']['PredmetDekan']);
//               for($ii=0; $ii<=($countPredmet-1); $ii++){
//                  echo $_SESSION['SesVar']['PredmetDekan'][$ii][0]." ".$_SESSION['SesVar']['PredmetDekan'][$ii][1]."<br>";                  
//               }

            } else if($lev == 4){
               $_SESSION['SesVar']['Level'][$levIndex] = $lev;
               $levIndex++;
               $idKaf=GetStudentBD($Indepartment[$i][1],$dbStud);
               if($idKaf){
                  $resPredmet = mysqli_query($dbMain, "SELECT id, IF(CHAR_LENGTH(name)>88,CONCAT(LEFT(name, 85),'...'),name), f1, f2, f3, f4, f5, f6, f7, f8, f9, f10 FROM lessons WHERE k1=$idKaf or k2=$idKaf or k3=$idKaf or k4=$idKaf or k5=$idKaf or k6=$idKaf or k7=$idKaf or k8=$idKaf ORDER BY name");
                  if(mysqli_num_rows($resPredmet)>=1){
                     $iPredmet = 0;
                     while($arr = mysqli_fetch_row($resPredmet)){
                        $fak='';
                        if($arr[2]>0){
                           $fak=$arr[2];
                           if($arr[3]>0) $fak.="%".$arr[3]; 
                           if($arr[4]>0) $fak.="%".$arr[4]; 
                           if($arr[5]>0) $fak.="%".$arr[5]; 
                           if($arr[6]>0) $fak.="%".$arr[6]; 
                           if($arr[7]>0) $fak.="%".$arr[7]; 
                           if($arr[8]>0) $fak.="%".$arr[8]; 
                           if($arr[9]>0) $fak.="%".$arr[9]; 
                           if($arr[10]>0) $fak.="%".$arr[10]; 
                           if($arr[11]>0) $fak.="%".$arr[11]; 
                        }                     
                        $_SESSION['SesVar']['PredmetZav'][$iPredmet]=Array($arr[0],$arr[1],$fak);
                        $iPredmet++;
                     }
                  }
                  mysqli_free_result($resPredmet);
                  $_SESSION['SesVar']['Zav']=Array($Indepartment[$i][0],$Indepartment[$i][1],$idKaf);
                  $_SESSION['SesVar']['Auth']=true;                  
               }

            } else if($lev == 1) {
               $_SESSION['SesVar']['Level'][$levIndex] = $lev;
               $levIndex++;
               $_SESSION['SesVar']['Auth']=true;
               $_SESSION['SesVar']['Rector']=Array($Indepartment[$i][0],$Indepartment[$i][1]);                  

            }            
         }
         mysqli_free_result($resM);
      }
      
      if($lev == 0){
         echo "Нет доступа по категориям сотрудников!";
         exit;
      }

      $conutLev = count($_SESSION['SesVar']['Level']);

      if($conutLev>=2){
         header("location: pre.php"); return;
      } else {
         switch($_SESSION['SesVar']['Level'][0]){
            case 1:
               header("location: r.php"); return;
               break;
            case 2:
               header("location: d.php"); return;
               break;
            case 3:
               header("location: p.php"); return;
               break;
            case 4:
               header("location: z.php"); return;
               break;
         }
      }

   
   } else {
      echo "Не найден пользователь в главной БД!";
      exit;
   }
}

function GetLU($user){
   include_once 'configLdap.php';
   $ad = ldap_connect($opLdap['host'],$opLdap['port']);
   @ldap_bind($ad,$opLdap['login'],$opLdap['password']) or die("Couldn't connect to AD!");
   $filter = "(&(objectClass=User)(samaccountname={$user}))";
   $sr=ldap_list($ad, $opLdap['dn'], $filter);
   if(!$sr){
     return false;
   } else {
      $info = ldap_get_entries($ad, $sr);
      if(!$info){
        return false;         
      } else {
         if(empty($info[0]["employeeid"][0])){
            return false;         
         } else {
            return $info[0]["employeeid"][0];
         }
     }                                
   }
   ldap_close($ad);
}

/*
function ExitFromSystem(){

$_SESSION['SesVar']['Auth']=false;                  
unset($_SESSION['SesVar']);
session_unset();
session_destroy();
unset($_SERVER['REMOTE_USER'], $_SERVER['PHP_AUTH_PW'],  $_SERVER['PHP_AUTH_USER']);
header('Refresh: 0;URL=');
//header('WWW-Authenticate: Basic realm="Auth"');
//header('HTTP/1.0 401 Unauthorized');
echo "До встречи.";
exit;
}
*/

?>
