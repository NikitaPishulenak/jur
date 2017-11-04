﻿<!doctype html>
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
    <script src="scripts/scriptDecLec.js"></script>
    <script src="scripts/corporate.js"></script>

</head>
<body>
<div class="popup" id="window-popup">
    <div class="popup-content">

        <div class="loader">
            <img class="loading" src="img/loading.gif"><br><strong class="header">Идет загрузка...</strong>
        </div>

    </div>
</div>

<div id='form-edit' title='Редактирование отметки'>
    <form id='form-edit'>
        <fieldset>
            <div class='panel'>

                <div id='panel'>
                    <b id='1' class='tool' title='Пропуск занятия по уважительной причине.'><b>Н<sub>у</sub></b></b>
                    <span class='space'></span>
                    <b id='2' class='tool' title='Пропуск занятия без уважительной причины.'><b>Н<sub>б.у</sub></b></b>
                    <span class='space'></span>
                    <b id='3' class='tool' title='Пропуск занятия без отработки.'><b>Н<sub>б.о.</sub></b></b>
                </div>


                <br><br>

                <input class='inp_cell' id='inp_0' type=text maxlength='6'
                       onkeydown='return proverka(event,0);' onblur='return proverka(event,0);'>
                <input class='inp_cell' id='inp_1' type='text' maxlength='6'
                       onkeydown='return proverka(event,1);' onblur='return proverka(event,1);'>
                <input class='inp_cell' id='inp_2' type='text' maxlength='6'
                       onkeydown='return proverka(event,2);' onblur='return proverka(event,2);'>

                <br>
                <hr>
                <br>
                <button id='edit' class='button'><b>ОК</b></button>
                <button id='close' class='attention'><b>Отмена</b></button>
            </div>
        </fieldset>
    </form>
</div>

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


        <div class="result_box">
            <div class='date_col hidden'></div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3"></div>
                <div class="grade" data-idStudent="2" data-idRating="4">22</div>
                <div class="grade" data-idStudent="3" data-idRating="2">26</div>
                <div class="grade" data-idStudent="4" data-idRating="7">26</div>
                <div class="grade" data-idStudent="5" data-idRating="1">21</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17">27</div>
                <div class="grade" data-idStudent="9" data-idRating="16">34</div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">33</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4"></div>
                <div class="grade" data-idStudent="15" data-idRating="2"></div>
                <div class="grade" data-idStudent="16" data-idRating="7">20</div>
                <div class="grade" data-idStudent="17" data-idRating="1"></div>
                <div class="grade" data-idStudent="18" data-idRating="2">21</div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17"></div>
                <div class="grade" data-idStudent="21" data-idRating="16">20</div>
                <div class="grade" data-idStudent="22" data-idRating="14">2132</div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2">22</div>
                <div class="grade" data-idStudent="28" data-idRating="7"></div>
                <div class="grade" data-idStudent="29" data-idRating="1"></div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3"></div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2">27</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1"></div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6">21</div>
                <div class="grade" data-idStudent="8" data-idRating="17"></div>
                <div class="grade" data-idStudent="9" data-idRating="16">30</div>
                <div class="grade" data-idStudent="10" data-idRating="14">22</div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45"></div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">23</div>
                <div class="grade" data-idStudent="15" data-idRating="2"></div>
                <div class="grade" data-idStudent="16" data-idRating="7">23</div>
                <div class="grade" data-idStudent="17" data-idRating="1"></div>
                <div class="grade" data-idStudent="18" data-idRating="2">24</div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17">23</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">21</div>
                <div class="grade" data-idStudent="23" data-idRating="13">27</div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">23</div>
                <div class="grade" data-idStudent="29" data-idRating="1"></div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3"></div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2"></div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1"></div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6"></div>
                <div class="grade" data-idStudent="8" data-idRating="17"></div>
                <div class="grade" data-idStudent="9" data-idRating="16">27</div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45"></div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4"></div>
                <div class="grade" data-idStudent="15" data-idRating="2"></div>
                <div class="grade" data-idStudent="16" data-idRating="7">21</div>
                <div class="grade" data-idStudent="17" data-idRating="1"></div>
                <div class="grade" data-idStudent="18" data-idRating="2"></div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17"></div>
                <div class="grade" data-idStudent="21" data-idRating="16">27</div>
                <div class="grade" data-idStudent="22" data-idRating="14"></div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3">21</div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7"></div>
                <div class="grade" data-idStudent="29" data-idRating="1"></div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>

        </div>

        <div class="statistic">


        </div>


</div>

</body>
</html>