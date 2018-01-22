<?php

unset($_SESSION['SesStud']);
session_unset();
session_destroy();
session_start();

$_SESSION['SesStud']['Auth']=false;                  

if(isset($_SERVER['REMOTE_USER']) && strlen($_SERVER['REMOTE_USER'])>=3){

   if(!GiveData($_SERVER['REMOTE_USER']))
   {
      echo "Не найден студент!";
      exit;
   } else {
      if(!GivePredmet()){
         echo "Для вашей учётной записи не найдены дисциплины!";
         exit;
      } else {
         header("location: view.php"); return;
      }
   }
   
} else {
   echo "Доступ запрещён!";
   exit;
}

function GiveData($loginStud)
{
   include_once 'configStudent.php';
   $result = mssql_query("SELECT A.idStud, CONCAT(B.Name_F,' ',B.Name_I,' ',B.Name_O), B.Idf, B.IdKurs, B.IdGroup, C.Name, LEFT(C.Name,1), D.Name FROM dbo.Student_logins_2 A LEFT JOIN dbo.Student B ON (B.IdStud=A.idStud AND B.IdStatus IS NULL) LEFT JOIN dbo.Groups C ON C.IdGroup=B.IdGroup LEFT JOIN dbo.Facultets D ON D.Idf=B.Idf WHERE A.login='".$_SERVER['REMOTE_USER']."'",$dbStud);

   if(mssql_num_rows($result)>=1){
      $arr=mssql_fetch_row($result);
      $_SESSION['SesStud']['idS']=$arr[0]; // ид Студента                 
      $_SESSION['SesStud']['nameS']=$arr[1]; // ФИО Студента
      $_SESSION['SesStud']['idFakS']=$arr[2]; // ид факультета
      $_SESSION['SesStud']['kursS']=$arr[3]; // номер курса
      $_SESSION['SesStud']['idGroupS']=$arr[4]; // ид группы
      $_SESSION['SesStud']['gnameS']=$arr[5]; // номер группы
      $_SESSION['SesStud']['gfS']=$arr[6]; // первый номер из названия группы принадлежащий к номеру факультета (1 - лечфак, 2 - педфак...)
      $_SESSION['SesStud']['fnameS']=$arr[7]; // название факультета
      $_SESSION['SesStud']['Auth']=true; 

      unset($arr);
      mssql_free_result($result);
      return true;      
   } else {
      return false;
   }
}


function GivePredmet()
{
   include_once 'configMain.php';
   include_once 'config.php';

   $res = mysqli_query($dbMain, "SELECT A.id_lesson, B.name, IF(CHAR_LENGTH(B.name)>70,CONCAT(LEFT(B.name, 67),'...'),B.name), (SELECT COUNT(C.id) FROM rating C WHERE C.idLessons=A.id_lesson AND C.idStud=".$_SESSION['SesStud']['idS']." AND C.del=0) FROM schedule A LEFT JOIN lessons B ON B.id=A.id_lesson WHERE (A.course=".$_SESSION['SesStud']['kursS']." AND A.id_faculty=".$_SESSION['SesStud']['idFakS'].") OR (A.course=".$_SESSION['SesStud']['kursS']." AND A.id_faculty=".$fac[$_SESSION['SesStud']['gfS']].") GROUP BY A.id_lesson ORDER BY B.name");
   if (mysqli_num_rows($res)>=1) {
      $iPredmet = 0;
      while ($arr = mysqli_fetch_row($res)) {
         $_SESSION['SesStud']['Predmet'][$iPredmet]=Array($arr[0],$arr[1],$arr[2],$arr[3]);
         $iPredmet++;
      }
      unset($arr);
      mysqli_free_result($res);
      return true;
   } else {
      return false;
   }
}

?>