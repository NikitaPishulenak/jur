<!doctype html>
<head>
    <meta charset="windows-1251">
    <!--        <meta charset="utf-8">-->
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title>Оценочная ведомость</title>
    <script src="scripts/jquery-3.2.1.min.js"></script>
    <script src="scripts/jquery-ui.js"></script>
    <script src="scripts/jquery.mask.js"></script>
    <script src="scripts/scriptLec.js"></script>
    <script src="scripts/corporate.js"></script>
    <script src="scripts/teachers.js"></script>


</head>
<body>

<div id='form-lesson' title='Создание занятия'>
    <form>
        <fieldset>
            <div class='box'>
                <b align='center'>Дата занятия</b>
                <div id='date_col'>
                    <input type='text' id='lesson-date' required class='datepicker' value='<?php echo date('d.m.Y') ?>' placeholder='дд.мм.гггг' >
                </div>
                <br><br>
            </div>
        </fieldset>
    </form>
</div>

<div id='form-edit' title='Редактирование отметки'>
    <form id='form-edit'>
        <fieldset>
            <div class='panel'>
                <div id='panel'>
                    <b id='1' class='tool' title='Пропуск занятия целиком.'><b>Н</b></b>
                    <span class='space'></span>
                    <b id='11' class='tool absenteeism_closed' title='Занятие отработано.'><b>Отр.</b></b>
                    <br><br>
                    <span id='5' class='tool' title='Пропуск занятия на 1 час.'><span>Н<sub>1ч.</sub></span></span>
                    <span class='space'></span>
                    <span id='6' class='tool' title='Пропуск занятия на 2 часа.'><span>Н<sub>2ч.</sub></span></span>
                    <span class='space'></span>
                    <span id='7' class='tool' title='Пропуск занятия на 3 часа.'> <span>Н<sub>3ч.</sub></span></span>
                    <span class='space'></span>
                    <span id='8' class='tool' title='Пропуск занятия на 4 часа.'><span>Н<sub>4ч.</sub></span></span>
                    <span class='space'></span>
                    <span id='9' class='tool' title='Пропуск занятия на 5 часов.'><span>Н<sub>5ч.</sub></span></span>
                    <span class='space'></span>
                    <span id='10' class='tool' title='Пропуск занятия на 6 часов.'><span>Н<sub>6ч.</sub></span></span>
                </div>


                <br>

                <input class='inp_cell' id='inp_0' type=text maxlength='0'
                       onkeydown='return proverka(event,0);' onblur='return proverka(event,0);'>

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
    <div class="tools" align="center">
        <button id="create_lesson">Новая лекция</button>
    </div>
    <br>
    <hr>
    <br>

    <input type="hidden" id="idSubject" value="25">
    <input type="hidden" id="idPrepod" value="43">
    <input type="hidden" id="idGroup" value="342">
    <input type="hidden" id="idLesson" value="5">
    <input type="hidden" name="idPL" value="1">
    <div class="container">
        <div class="fio">
            <div class="title">
                ФИО
            </div>
            <!--            data-idStudent- ид студента по БД. Для каждого студента уникален.
                            data-hover- порядковый номер студента (необходим для подсветки строки)
                            data-idLesson- ид занятия. Для каждого занятия уникален
                            data-idRating-ид оценки. Для каждой клетки уникален-->
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
                <div class="date_title" data-idLesson="1">01.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3"></div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2">21</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1">Нб.отр.</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6"></div>
                <div class="grade" data-idStudent="8" data-idRating="17">20</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45"></div>
                <div class="grade" data-idStudent="13" data-idRating="3">Нб.отр.</div>
                <div class="grade" data-idStudent="14" data-idRating="4"></div>
                <div class="grade" data-idStudent="15" data-idRating="2"></div>
                <div class="grade" data-idStudent="16" data-idRating="7"></div>
                <div class="grade" data-idStudent="17" data-idRating="1"></div>
                <div class="grade" data-idStudent="18" data-idRating="2"></div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17">Ну</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14"></div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7"></div>
                <div class="grade" data-idStudent="29" data-idRating="1"></div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">16.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">21</div>
                <div class="grade" data-idStudent="2" data-idRating="4">20</div>
                <div class="grade" data-idStudent="3" data-idRating="2"></div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1">22</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6"></div>
                <div class="grade" data-idStudent="8" data-idRating="17">Нб.отр.</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45"></div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4"></div>
                <div class="grade" data-idStudent="15" data-idRating="2"></div>
                <div class="grade" data-idStudent="16" data-idRating="7"></div>
                <div class="grade" data-idStudent="17" data-idRating="1"></div>
                <div class="grade" data-idStudent="18" data-idRating="2"></div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17">Нб.отр.</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14"></div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7"></div>
                <div class="grade" data-idStudent="29" data-idRating="1"></div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>

        </div>

    </div>

</div>

</body>
</html>