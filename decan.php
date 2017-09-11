<!doctype html>
<head>
    <meta charset="windows-1251">
    <!--        <meta charset="utf-8">-->
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="scripts/jquery-ui.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title>Оценочная ведомость</title>
    <script src="scripts/jquery-3.2.1.min.js"></script>
    <script src="scripts/jquery-ui.js"></script>
    <script src="scripts/jquery.maskedinput.js"></script>
    <script src="scripts/scriptDec.js"></script>

</head>
<body>

<div class="container-list">

    <br>

    <input type="hidden" id="idSubject" value="25">
    <input type="hidden" id="idPrepod" value="43">
    <input type="hidden" id="idGroup" value="342">
    <input type="hidden" id="idPL" value="0">
    <div class="container">
        <div class="fio">
            <div class="title">
                ФИО
            </div>

            <div class="fio_student" data-idStudent="1" data-idLess="2">Абрамов Александр Иванович</div>
            <div class="fio_student" data-idStudent="2" data-idLess="4">Бабушкин Степан Леонидович</div>
            <div class="fio_student" data-idStudent="3" data-idLess="3">Волкова Алевтина Никитишна</div>
            <div class="fio_student" data-idStudent="4" data-idLess="5">Гриб Салтан Лаикович</div>
            <div class="fio_student" data-idStudent="5" data-idLess="6">Евдакимова Янна Викторовна</div>
            <div class="fio_student" data-idStudent="6" data-idLess="27">Климанович Ян Янович</div>
            <div class="fio_student" data-idStudent="7" data-idLess="28">Лис Павел Владимирович</div>
            <div class="fio_student" data-idStudent="8" data-idLess="25">Попов Алексей Георгиевич</div>
            <div class="fio_student" data-idStudent="9" data-idLess="24">Рудяк Марк Николаевич</div>
            <div class="fio_student" data-idStudent="10" data-idLess="23">Шеко Артем Викторович</div>
            <div class="fio_student" data-idStudent="11" data-idLess="22">Шершень Степан Яковлевич</div>
            <div class="fio_student" data-idStudent="12" data-idLess="21">Шут Павел Владимирович</div>
            <div class="fio_student" data-idStudent="13" data-idLess="20">Якубович Александр Дмитриевич</div>
            <div class="fio_student" data-idStudent="14" data-idLess="33">Ясько Елена Максимовна</div>
            <div class="fio_student" data-idStudent="15" data-idLess="34">Абрамова Софья Игоревна</div>
            <div class="fio_student" data-idStudent="16" data-idLess="36">Абрамова Александра Федоровна</div>
            <div class="fio_student" data-idStudent="17" data-idLess="37">Ильин Степан Мойшавич</div>
            <div class="fio_student" data-idStudent="18" data-idLess="283">Абдым ын Салын Халы</div>
            <div class="fio_student" data-idStudent="19" data-idLess="387">Федоров Геннадий Андреевич</div>
            <div class="fio_student" data-idStudent="20" data-idLess="435">Копытов Александр Васильевич</div>
            <div class="fio_student" data-idStudent="21" data-idLess="364">Шапка Василий Иванович</div>
            <div class="fio_student" data-idStudent="22" data-idLess="345">Соломахина Анжелика Никитишна</div>
            <div class="fio_student" data-idStudent="23" data-idLess="264">Никитин Николай Николаевич</div>
            <div class="fio_student" data-idStudent="24" data-idLess="387">Шульц Максим Витальевич</div>
            <div class="fio_student" data-idStudent="25" data-idLess="388">Высоцкий Михаил Владимирович</div>
            <div class="fio_student" data-idStudent="26" data-idLess="885">Данилова Галина Владимировна</div>
            <div class="fio_student" data-idStudent="27" data-idLess="676">Басова Янина Александровна</div>
            <div class="fio_student" data-idStudent="28" data-idLess="666">Бахтизин Вячеслав Вениаминович</div>
            <div class="fio_student" data-idStudent="29" data-idLess="777">Кружкин Михаил Геннадьевич</div>
            <div class="fio_student" data-idStudent="30" data-idLess="888">Заикин Василий Фомич</div>
        </div>


        <div class="result_box_statistic">
            <div class='date_col hidden'></div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111214</div>
                <div class="grade" data-idStudent="2" data-idRating="4">22</div>
                <div class="grade" data-idStudent="3" data-idRating="2"></div>
                <div class="grade" data-idStudent="4" data-idRating="7">151110</div>
                <div class="grade" data-idStudent="5" data-idRating="1">21</div>
                <div class="grade" data-idStudent="6" data-idRating="2">16</div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17"></div>
                <div class="grade" data-idStudent="9" data-idRating="16">1511</div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">14</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4"></div>
                <div class="grade" data-idStudent="15" data-idRating="2">16</div>
                <div class="grade" data-idStudent="16" data-idRating="7">20</div>
                <div class="grade" data-idStudent="17" data-idRating="1"></div>
                <div class="grade" data-idStudent="18" data-idRating="2">21</div>
                <div class="grade" data-idStudent="19" data-idRating="6">17</div>
                <div class="grade" data-idStudent="20" data-idRating="17">111113</div>
                <div class="grade" data-idStudent="21" data-idRating="16">20</div>
                <div class="grade" data-idStudent="22" data-idRating="14">21</div>
                <div class="grade" data-idStudent="23" data-idRating="13">151611</div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3">111012</div>
                <div class="grade" data-idStudent="26" data-idRating="4">13</div>
                <div class="grade" data-idStudent="27" data-idRating="2">22</div>
                <div class="grade" data-idStudent="28" data-idRating="7"></div>
                <div class="grade" data-idStudent="29" data-idRating="1"></div>
                <div class="grade" data-idStudent="30" data-idRating="2">1211</div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111516</div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2">15</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1">14</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17">252423</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14">22</div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">13</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">23</div>
                <div class="grade" data-idStudent="15" data-idRating="2">11</div>
                <div class="grade" data-idStudent="16" data-idRating="7">23</div>
                <div class="grade" data-idStudent="17" data-idRating="1">111112</div>
                <div class="grade" data-idStudent="18" data-idRating="2">24</div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17">23</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">14</div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">23</div>
                <div class="grade" data-idStudent="29" data-idRating="1">10</div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111214</div>
                <div class="grade" data-idStudent="2" data-idRating="4">22</div>
                <div class="grade" data-idStudent="3" data-idRating="2"></div>
                <div class="grade" data-idStudent="4" data-idRating="7">151110</div>
                <div class="grade" data-idStudent="5" data-idRating="1">21</div>
                <div class="grade" data-idStudent="6" data-idRating="2">16</div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17"></div>
                <div class="grade" data-idStudent="9" data-idRating="16">1511</div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">14</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4"></div>
                <div class="grade" data-idStudent="15" data-idRating="2">16</div>
                <div class="grade" data-idStudent="16" data-idRating="7">20</div>
                <div class="grade" data-idStudent="17" data-idRating="1"></div>
                <div class="grade" data-idStudent="18" data-idRating="2">21</div>
                <div class="grade" data-idStudent="19" data-idRating="6">17</div>
                <div class="grade" data-idStudent="20" data-idRating="17">111113</div>
                <div class="grade" data-idStudent="21" data-idRating="16">20</div>
                <div class="grade" data-idStudent="22" data-idRating="14">21</div>
                <div class="grade" data-idStudent="23" data-idRating="13">151611</div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3">111012</div>
                <div class="grade" data-idStudent="26" data-idRating="4">13</div>
                <div class="grade" data-idStudent="27" data-idRating="2">22</div>
                <div class="grade" data-idStudent="28" data-idRating="7"></div>
                <div class="grade" data-idStudent="29" data-idRating="1"></div>
                <div class="grade" data-idStudent="30" data-idRating="2">1211</div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111516</div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2">15</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1">14</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17">252423</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14">22</div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">13</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">23</div>
                <div class="grade" data-idStudent="15" data-idRating="2">11</div>
                <div class="grade" data-idStudent="16" data-idRating="7">23</div>
                <div class="grade" data-idStudent="17" data-idRating="1">111112</div>
                <div class="grade" data-idStudent="18" data-idRating="2">24</div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17">23</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">14</div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">23</div>
                <div class="grade" data-idStudent="29" data-idRating="1">10</div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111214</div>
                <div class="grade" data-idStudent="2" data-idRating="4">22</div>
                <div class="grade" data-idStudent="3" data-idRating="2"></div>
                <div class="grade" data-idStudent="4" data-idRating="7">151110</div>
                <div class="grade" data-idStudent="5" data-idRating="1">21</div>
                <div class="grade" data-idStudent="6" data-idRating="2">16</div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17"></div>
                <div class="grade" data-idStudent="9" data-idRating="16">1511</div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">14</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4"></div>
                <div class="grade" data-idStudent="15" data-idRating="2">16</div>
                <div class="grade" data-idStudent="16" data-idRating="7">20</div>
                <div class="grade" data-idStudent="17" data-idRating="1"></div>
                <div class="grade" data-idStudent="18" data-idRating="2">21</div>
                <div class="grade" data-idStudent="19" data-idRating="6">17</div>
                <div class="grade" data-idStudent="20" data-idRating="17">111113</div>
                <div class="grade" data-idStudent="21" data-idRating="16">20</div>
                <div class="grade" data-idStudent="22" data-idRating="14">21</div>
                <div class="grade" data-idStudent="23" data-idRating="13">151611</div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3">111012</div>
                <div class="grade" data-idStudent="26" data-idRating="4">13</div>
                <div class="grade" data-idStudent="27" data-idRating="2">22</div>
                <div class="grade" data-idStudent="28" data-idRating="7"></div>
                <div class="grade" data-idStudent="29" data-idRating="1"></div>
                <div class="grade" data-idStudent="30" data-idRating="2">1211</div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111516</div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2">15</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1">14</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17">252423</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14">22</div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">13</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">23</div>
                <div class="grade" data-idStudent="15" data-idRating="2">11</div>
                <div class="grade" data-idStudent="16" data-idRating="7">23</div>
                <div class="grade" data-idStudent="17" data-idRating="1">111112</div>
                <div class="grade" data-idStudent="18" data-idRating="2">24</div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17">23</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">14</div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">23</div>
                <div class="grade" data-idStudent="29" data-idRating="1">10</div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111214</div>
                <div class="grade" data-idStudent="2" data-idRating="4">22</div>
                <div class="grade" data-idStudent="3" data-idRating="2"></div>
                <div class="grade" data-idStudent="4" data-idRating="7">151110</div>
                <div class="grade" data-idStudent="5" data-idRating="1">21</div>
                <div class="grade" data-idStudent="6" data-idRating="2">16</div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17"></div>
                <div class="grade" data-idStudent="9" data-idRating="16">1511</div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">14</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4"></div>
                <div class="grade" data-idStudent="15" data-idRating="2">16</div>
                <div class="grade" data-idStudent="16" data-idRating="7">20</div>
                <div class="grade" data-idStudent="17" data-idRating="1"></div>
                <div class="grade" data-idStudent="18" data-idRating="2">21</div>
                <div class="grade" data-idStudent="19" data-idRating="6">17</div>
                <div class="grade" data-idStudent="20" data-idRating="17">111113</div>
                <div class="grade" data-idStudent="21" data-idRating="16">20</div>
                <div class="grade" data-idStudent="22" data-idRating="14">21</div>
                <div class="grade" data-idStudent="23" data-idRating="13">151611</div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3">111012</div>
                <div class="grade" data-idStudent="26" data-idRating="4">13</div>
                <div class="grade" data-idStudent="27" data-idRating="2">22</div>
                <div class="grade" data-idStudent="28" data-idRating="7"></div>
                <div class="grade" data-idStudent="29" data-idRating="1"></div>
                <div class="grade" data-idStudent="30" data-idRating="2">1211</div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111516</div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2">15</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1">14</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17">252423</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14">22</div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">13</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">23</div>
                <div class="grade" data-idStudent="15" data-idRating="2">11</div>
                <div class="grade" data-idStudent="16" data-idRating="7">23</div>
                <div class="grade" data-idStudent="17" data-idRating="1">111112</div>
                <div class="grade" data-idStudent="18" data-idRating="2">24</div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17">23</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">14</div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">23</div>
                <div class="grade" data-idStudent="29" data-idRating="1">10</div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111516</div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2">15</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1">14</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17">252423</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14">22</div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">13</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">23</div>
                <div class="grade" data-idStudent="15" data-idRating="2">11</div>
                <div class="grade" data-idStudent="16" data-idRating="7">23</div>
                <div class="grade" data-idStudent="17" data-idRating="1">111112</div>
                <div class="grade" data-idStudent="18" data-idRating="2">24</div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17">23</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">14</div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">23</div>
                <div class="grade" data-idStudent="29" data-idRating="1">10</div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111516</div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2">15</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1">14</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17">252423</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14">22</div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">13</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">23</div>
                <div class="grade" data-idStudent="15" data-idRating="2">11</div>
                <div class="grade" data-idStudent="16" data-idRating="7">23</div>
                <div class="grade" data-idStudent="17" data-idRating="1">111112</div>
                <div class="grade" data-idStudent="18" data-idRating="2">24</div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17">23</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">14</div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">23</div>
                <div class="grade" data-idStudent="29" data-idRating="1">10</div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111516</div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2">15</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1">14</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17">252423</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14">22</div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">13</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">23</div>
                <div class="grade" data-idStudent="15" data-idRating="2">11</div>
                <div class="grade" data-idStudent="16" data-idRating="7">23</div>
                <div class="grade" data-idStudent="17" data-idRating="1">111112</div>
                <div class="grade" data-idStudent="18" data-idRating="2">24</div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17">23</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">14</div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">23</div>
                <div class="grade" data-idStudent="29" data-idRating="1">10</div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111516</div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2">15</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1">14</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17">252423</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14">22</div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">13</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">23</div>
                <div class="grade" data-idStudent="15" data-idRating="2">11</div>
                <div class="grade" data-idStudent="16" data-idRating="7">23</div>
                <div class="grade" data-idStudent="17" data-idRating="1">111112</div>
                <div class="grade" data-idStudent="18" data-idRating="2">24</div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17">23</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">14</div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">23</div>
                <div class="grade" data-idStudent="29" data-idRating="1">10</div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111516</div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2">15</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1">14</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17">252423</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14">22</div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">13</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">23</div>
                <div class="grade" data-idStudent="15" data-idRating="2">11</div>
                <div class="grade" data-idStudent="16" data-idRating="7">23</div>
                <div class="grade" data-idStudent="17" data-idRating="1">111112</div>
                <div class="grade" data-idStudent="18" data-idRating="2">24</div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17">23</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">14</div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">23</div>
                <div class="grade" data-idStudent="29" data-idRating="1">10</div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111516</div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2">15</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1">14</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17">252423</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14">22</div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">13</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">23</div>
                <div class="grade" data-idStudent="15" data-idRating="2">11</div>
                <div class="grade" data-idStudent="16" data-idRating="7">23</div>
                <div class="grade" data-idStudent="17" data-idRating="1">111112</div>
                <div class="grade" data-idStudent="18" data-idRating="2">24</div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17">23</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">14</div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">23</div>
                <div class="grade" data-idStudent="29" data-idRating="1">10</div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111516</div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2">15</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1">14</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17">252423</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14">22</div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">13</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">23</div>
                <div class="grade" data-idStudent="15" data-idRating="2">11</div>
                <div class="grade" data-idStudent="16" data-idRating="7">23</div>
                <div class="grade" data-idStudent="17" data-idRating="1">111112</div>
                <div class="grade" data-idStudent="18" data-idRating="2">24</div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17">23</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">14</div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">23</div>
                <div class="grade" data-idStudent="29" data-idRating="1">10</div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>

            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3"></div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2">13</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1"></div>
                <div class="grade" data-idStudent="6" data-idRating="2">15</div>
                <div class="grade" data-idStudent="7" data-idRating="6"></div>
                <div class="grade" data-idStudent="8" data-idRating="17">1311</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45"></div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">1711</div>
                <div class="grade" data-idStudent="15" data-idRating="2"></div>
                <div class="grade" data-idStudent="16" data-idRating="7">21</div>
                <div class="grade" data-idStudent="17" data-idRating="1"></div>
                <div class="grade" data-idStudent="18" data-idRating="2">19</div>
                <div class="grade" data-idStudent="19" data-idRating="6">13</div>
                <div class="grade" data-idStudent="20" data-idRating="17"></div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">18</div>
                <div class="grade" data-idStudent="23" data-idRating="13">15</div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3">21</div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">17</div>
                <div class="grade" data-idStudent="29" data-idRating="1"></div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111214</div>
                <div class="grade" data-idStudent="2" data-idRating="4">22</div>
                <div class="grade" data-idStudent="3" data-idRating="2"></div>
                <div class="grade" data-idStudent="4" data-idRating="7">151110</div>
                <div class="grade" data-idStudent="5" data-idRating="1">21</div>
                <div class="grade" data-idStudent="6" data-idRating="2">16</div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17"></div>
                <div class="grade" data-idStudent="9" data-idRating="16">1511</div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">14</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4"></div>
                <div class="grade" data-idStudent="15" data-idRating="2">16</div>
                <div class="grade" data-idStudent="16" data-idRating="7">20</div>
                <div class="grade" data-idStudent="17" data-idRating="1"></div>
                <div class="grade" data-idStudent="18" data-idRating="2">21</div>
                <div class="grade" data-idStudent="19" data-idRating="6">17</div>
                <div class="grade" data-idStudent="20" data-idRating="17">111113</div>
                <div class="grade" data-idStudent="21" data-idRating="16">20</div>
                <div class="grade" data-idStudent="22" data-idRating="14">21</div>
                <div class="grade" data-idStudent="23" data-idRating="13">151611</div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3">111012</div>
                <div class="grade" data-idStudent="26" data-idRating="4">13</div>
                <div class="grade" data-idStudent="27" data-idRating="2">22</div>
                <div class="grade" data-idStudent="28" data-idRating="7"></div>
                <div class="grade" data-idStudent="29" data-idRating="1"></div>
                <div class="grade" data-idStudent="30" data-idRating="2">1211</div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111516</div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2">15</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1">14</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17">252423</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14">22</div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">13</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">23</div>
                <div class="grade" data-idStudent="15" data-idRating="2">11</div>
                <div class="grade" data-idStudent="16" data-idRating="7">23</div>
                <div class="grade" data-idStudent="17" data-idRating="1">111112</div>
                <div class="grade" data-idStudent="18" data-idRating="2">24</div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17">23</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">14</div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">23</div>
                <div class="grade" data-idStudent="29" data-idRating="1">10</div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3"></div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2">13</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1"></div>
                <div class="grade" data-idStudent="6" data-idRating="2">15</div>
                <div class="grade" data-idStudent="7" data-idRating="6"></div>
                <div class="grade" data-idStudent="8" data-idRating="17">1311</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45"></div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">1711</div>
                <div class="grade" data-idStudent="15" data-idRating="2"></div>
                <div class="grade" data-idStudent="16" data-idRating="7">21</div>
                <div class="grade" data-idStudent="17" data-idRating="1"></div>
                <div class="grade" data-idStudent="18" data-idRating="2">19</div>
                <div class="grade" data-idStudent="19" data-idRating="6">13</div>
                <div class="grade" data-idStudent="20" data-idRating="17"></div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">18</div>
                <div class="grade" data-idStudent="23" data-idRating="13">15</div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3">21</div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">17</div>
                <div class="grade" data-idStudent="29" data-idRating="1"></div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>




        </div>

                <div class="statistic">
                    <div class="date_col_stat">
                        <div class="date_title">Ср. б.</div>
                        <div class="average" data-idStudent="1"></div>
                        <div class="average" data-idStudent="2"></div>
                        <div class="average" data-idStudent="3"></div>
                        <div class="average" data-idStudent="4"></div>
                        <div class="average" data-idStudent="5"></div>
                        <div class="average" data-idStudent="6"></div>
                        <div class="average" data-idStudent="7"></div>
                        <div class="average" data-idStudent="8"></div>
                        <div class="average" data-idStudent="9"></div>
                        <div class="average" data-idStudent="10"></div>
                        <div class="average" data-idStudent="11"></div>
                        <div class="average" data-idStudent="12"></div>
                        <div class="average" data-idStudent="13"></div>
                        <div class="average" data-idStudent="14"></div>
                        <div class="average" data-idStudent="15"></div>
                        <div class="average" data-idStudent="16"></div>
                        <div class="average" data-idStudent="17"></div>
                        <div class="average" data-idStudent="18"></div>
                        <div class="average" data-idStudent="19"></div>
                        <div class="average" data-idStudent="20"></div>
                        <div class="average" data-idStudent="21"></div>
                        <div class="average" data-idStudent="22"></div>
                        <div class="average" data-idStudent="23"></div>
                        <div class="average" data-idStudent="24"></div>
                        <div class="average" data-idStudent="25"></div>
                        <div class="average" data-idStudent="26"></div>
                        <div class="average" data-idStudent="27"></div>
                        <div class="average" data-idStudent="28"></div>
                        <div class="average" data-idStudent="29"></div>
                        <div class="average" data-idStudent="30"></div>
                    </div>
                    <div class="date_col_stat">
                        <div class="date_title">% отв.</div>
                        <div class="answer" data-idStudent="1"></div>
                        <div class="answer" data-idStudent="2"></div>
                        <div class="answer" data-idStudent="3"></div>
                        <div class="answer" data-idStudent="4"></div>
                        <div class="answer" data-idStudent="5"></div>
                        <div class="answer" data-idStudent="6"></div>
                        <div class="answer" data-idStudent="7"></div>
                        <div class="answer" data-idStudent="8"></div>
                        <div class="answer" data-idStudent="9"></div>
                        <div class="answer" data-idStudent="10"></div>
                        <div class="answer" data-idStudent="11"></div>
                        <div class="answer" data-idStudent="12"></div>
                        <div class="answer" data-idStudent="13"></div>
                        <div class="answer" data-idStudent="14"></div>
                        <div class="answer" data-idStudent="15"></div>
                        <div class="answer" data-idStudent="16"></div>
                        <div class="answer" data-idStudent="17"></div>
                        <div class="answer" data-idStudent="18"></div>
                        <div class="answer" data-idStudent="19"></div>
                        <div class="answer" data-idStudent="20"></div>
                        <div class="answer" data-idStudent="21"></div>
                        <div class="answer" data-idStudent="22"></div>
                        <div class="answer" data-idStudent="23"></div>
                        <div class="answer" data-idStudent="24"></div>
                        <div class="answer" data-idStudent="25"></div>
                        <div class="answer" data-idStudent="26"></div>
                        <div class="answer" data-idStudent="27"></div>
                        <div class="answer" data-idStudent="28"></div>
                        <div class="answer" data-idStudent="29"></div>
                        <div class="answer" data-idStudent="30"></div>
                    </div>
                </div>


</div>

</body>
</html>