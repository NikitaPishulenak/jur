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
    <script src="scripts/jquery.mask.js"></script>
    <script src="scripts/script.js"></script>
    <script src="scripts/corporate.js"></script>
    <script src="scripts/teachers.js"></script>
    <script src="scripts/jquery.mobile-1.4.5.min.js"></script>

</head>
<body>



<!--//замена даты-->
<div id="form-edit-date" title="Редактирование даты занятия">
    <form>
        <fieldset>
            <div class="box">
                <b align='center'>Дата занятия</b>
                    <input type='text' id='edit-lesson-date' required class='datepicker' value='<?php echo date('d.m.Y') ?>' placeholder='дд.мм.гггг'>
                <br><br>
                <label><input type='radio' class='edit_type_lesson' id='edit_simple_lesson_rb' name='type_lesson' value='0' checked><b class='type_lesson'>Обычное занятие</b></label>
                <br><br>
                <label><input type='radio' class='edit_type_lesson' id='edit_colloquium_rb' name='type_lesson' value='1'><b class='type_lesson'>Коллоквиум</b></label>
                <br><br>
                <label><input type='radio' class='edit_type_lesson' id='edit_exam_rb' name='type_lesson' value='2'><b class='type_lesson'>Аттестация</b></label>
                <br>
            </div>
        </fieldset>
    </form>
</div>

<div id='form-lesson' title='Создание занятия'>
    <form>
        <fieldset>
            <div class='box'>
                <b align='center'>Дата занятия</b>
                <div id='date_col'>
                    <input type='text' id='lesson-date' required class='datepicker' value='<?php echo date('d.m.Y') ?>' placeholder='дд.мм.гггг'>
                </div>
                <br>
                <label><input type='radio' class='type_lesson' id='simple_lesson_rb' name='type_lesson' value='sl' checked><b class='type_lesson'>Обычное занятие</b></label>
                <br><br>
                <label><input type='radio' class='type_lesson' id='colloquium_rb' name='type_lesson' value='col'><b class='type_lesson'>Коллоквиум</b></label>
                <br><br>
                <label><input type='radio' class='type_lesson' id='exam_rb' name='type_lesson' value='exam'><b class='type_lesson'>Аттестация</b></label>
                <br><br>
            </div>
        </fieldset>
    </form>
</div>

<div id='form-edit' title='Редактирование отметки '>
    <form id='form-edit'>
        <fieldset>
            <div class='panel'>
                <div id='panel'>
                <button id='add_grade_input' class='add_grade'
                        title='Для добавления дополнительной оценки нажмите на кнопку!'>+
                </button>

                    <span class='space'></span>
                    <b id='1' class='tool' title='Пропуск занятия целиком.'><b>Н</b></b>
                    <span class='space'></span>
                    <b id='11' class='tool absenteeism_closed' title='Занятие отработано.'><b>Отр.</b></b>
                    <span class='space'></span>
                    <b id='2' class='tool' title='Зачтено.'><b>Зач.</b></b>
                    <span class='space'></span>
                    <b id='3' class='tool' title='Не зачтено.'><b>Незач.</b></b>
                    <span class='space'></span>
                    <b id='4' class='tool fail' title='Недопуск к аттестации.'><b>Недоп</b></b>


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

                    <br><br>

                    <span class='tool fail' title='Отметка: один'>1</span>
                    <span class='space'></span>
                    <span class='tool fail' title='Отметка: два'>2</span>
                    <span class='space'></span>
                    <span class='tool fail' title='Отметка: три'>3</span>
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

                </div>


                <br>

                <input class='inp_cell' id='inp_0' type=text maxlength='6'
                       onkeydown='return proverka(event,0);' onblur='return proverka(event,0);'>
                <input class='inp_cell' id='inp_1' type='text' maxlength='6'
                       onkeydown='return proverka(event,1);' onblur='return proverka(event,1);'>
                <input class='inp_cell' id='inp_2' type='text' maxlength='6'
                       onkeydown='return proverka(event,2);' onblur='return proverka(event,2);'>

                <br>
                <hr>
                <br>
                <button id='edit' class='button'>Сохранить</button>
                <button id='close' class='attention'>Отмена</button>
            </div>
        </fieldset>
    </form>
</div>





    <div class="container-list">

    <div class="tools" align="center">
        <button id="create_lesson">Новое занятие</button>
    </div>
    <hr>
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


        <div class="result_box_statistic result_box">
            <div class='date_col hidden'></div>
            <div class="date_col">
                <div class="date_title exam_theme" data-idLesson="1">01.09.2017</div>
                <div class="grade exam_theme" data-idStudent="1" data-idRating="3" data-zapis="1">111213</div>
                <div class="grade exam_theme" data-idStudent="2" data-idRating="4" data-zapis="2">122215</div>
                <div class="grade exam_theme" data-idStudent="3" data-idRating="2" data-zapis="3">30</div>
                <div class="grade exam_theme" data-idStudent="4" data-idRating="7" data-zapis="4">1127</div>
                <div class="grade exam_theme" data-idStudent="5" data-idRating="1" data-zapis="5">1219</div>
                <div class="grade exam_theme" data-idStudent="6" data-idRating="2" data-zapis="6">2</div>
                <div class="grade exam_theme" data-idStudent="7" data-idRating="6" data-zapis="7">10</div>
                <div class="grade exam_theme" data-idStudent="8" data-idRating="17" data-zapis="8">Нб.отр.</div>
                <div class="grade exam_theme" data-idStudent="9" data-idRating="16" data-zapis="9"data-Log="1"></div>
                <div class="grade exam_theme" data-idStudent="10" data-idRating="14" data-zapis="10">5</div>
                <div class="grade exam_theme" data-idStudent="11" data-idRating="13" data-zapis="11">3</div>
                <div class="grade exam_theme" data-idStudent="12" data-idRating="45" data-zapis="12"data-Log="1"></div>
                <div class="grade exam_theme" data-idStudent="13" data-idRating="3" data-zapis="13">5</div>
                <div class="grade exam_theme" data-idStudent="14" data-idRating="4" data-zapis="14">31</div>
                <div class="grade exam_theme" data-idStudent="15" data-idRating="2" data-zapis="15">32</div>
                <div class="grade exam_theme" data-idStudent="16" data-idRating="7" data-zapis="16">9</div>
                <div class="grade exam_theme" data-idStudent="17" data-idRating="1" data-zapis="17">4</div>
                <div class="grade exam_theme" data-idStudent="18" data-idRating="2" data-zapis="18" data-Log="1">227</div>
                <div class="grade exam_theme" data-idStudent="19" data-idRating="6" data-zapis="19">10</div>
                <div class="grade exam_theme" data-idStudent="20" data-idRating="17" data-zapis="20">Нб.отр.</div>
                <div class="grade exam_theme" data-idStudent="21" data-idRating="16" data-zapis="21"></div>
                <div class="grade exam_theme" data-idStudent="22" data-idRating="14" data-zapis="22">5</div>
                <div class="grade exam_theme" data-idStudent="23" data-idRating="13" data-zapis="23">33</div>
                <div class="grade exam_theme" data-idStudent="24" data-idRating="45" data-zapis="24">27</div>
                <div class="grade exam_theme" data-idStudent="25" data-idRating="3" data-zapis="25">5</div>
                <div class="grade exam_theme" data-idStudent="26" data-idRating="4" data-zapis="26"></div>
                <div class="grade exam_theme" data-idStudent="27" data-idRating="2" data-zapis="27">34</div>
                <div class="grade exam_theme" data-idStudent="28" data-idRating="7" data-zapis="28">9</div>
                <div class="grade exam_theme" data-idStudent="29" data-idRating="1" data-zapis="29">4</div>
                <div class="grade exam_theme" data-idStudent="30" data-idRating="2" data-zapis="30">2</div>
            </div>
            <div class="date_col">
                <div class="date_title colloquium_theme" data-idLesson="1">03.09.2017</div>
                <div class="grade  colloquium_theme" data-idStudent="1" data-idRating="3" data-Log="1">8</div>
                <div class="grade colloquium_theme" data-idStudent="2" data-idRating="4">34</div>
                <div class="grade colloquium_theme" data-idStudent="3" data-idRating="2">26</div>
                <div class="grade colloquium_theme" data-idStudent="4" data-idRating="7">3</div>
                <div class="grade colloquium_theme" data-idStudent="5" data-idRating="1">9</div>
                <div class="grade colloquium_theme" data-idStudent="6" data-idRating="2">27</div>
                <div class="grade colloquium_theme" data-idStudent="7" data-idRating="6">27</div>
                <div class="grade colloquium_theme" data-idStudent="8" data-idRating="17">Нб.отр.</div>
                <div class="grade colloquium_theme" data-idStudent="9" data-idRating="16">36</div>
                <div class="grade colloquium_theme" data-idStudent="10" data-idRating="14"></div>
                <div class="grade colloquium_theme" data-idStudent="11" data-idRating="13"></div>
                <div class="grade colloquium_theme" data-idStudent="12" data-idRating="45"></div>
                <div class="grade colloquium_theme" data-idStudent="13" data-idRating="3">27</div>
                <div class="grade colloquium_theme" data-idStudent="14" data-idRating="4"></div>
                <div class="grade colloquium_theme" data-idStudent="15" data-idRating="2">26</div>
                <div class="grade colloquium_theme" data-idStudent="16" data-idRating="7">3</div>
                <div class="grade colloquium_theme" data-idStudent="17" data-idRating="1"></div>
                <div class="grade colloquium_theme" data-idStudent="18" data-idRating="2">2</div>
                <div class="grade colloquium_theme" data-idStudent="19" data-idRating="6">8</div>
                <div class="grade colloquium_theme" data-idStudent="20" data-idRating="17">Нб.отр.</div>
                <div class="grade colloquium_theme" data-idStudent="21" data-idRating="16"></div>
                <div class="grade colloquium_theme" data-idStudent="22" data-idRating="14"></div>
                <div class="grade colloquium_theme" data-idStudent="23" data-idRating="13"></div>
                <div class="grade colloquium_theme" data-idStudent="24" data-idRating="45">7</div>
                <div class="grade colloquium_theme" data-idStudent="25" data-idRating="3"></div>
                <div class="grade colloquium_theme" data-idStudent="26" data-idRating="4"></div>
                <div class="grade colloquium_theme" data-idStudent="27" data-idRating="2">5</div>
                <div class="grade colloquium_theme" data-idStudent="28" data-idRating="7">9</div>
                <div class="grade colloquium_theme" data-idStudent="29" data-idRating="1">9</div>
                <div class="grade colloquium_theme" data-idStudent="30" data-idRating="2">10</div>
            </div>

            <div class="date_col">
                <div class="date_title" data-idLesson="1">06.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">2</div>
                <div class="grade" data-idStudent="2" data-idRating="4">2</div>
                <div class="grade" data-idStudent="3" data-idRating="2"></div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1">9</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6"></div>
                <div class="grade" data-idStudent="8" data-idRating="17">Нб.отр.</div>
                <div class="grade" data-idStudent="9" data-idRating="16">27</div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">27</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">27</div>
                <div class="grade" data-idStudent="15" data-idRating="2">2</div>
                <div class="grade" data-idStudent="16" data-idRating="7"></div>
                <div class="grade" data-idStudent="17" data-idRating="1">7</div>
                <div class="grade" data-idStudent="18" data-idRating="2">7</div>
                <div class="grade" data-idStudent="19" data-idRating="6">7</div>
                <div class="grade" data-idStudent="20" data-idRating="17">5</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14"></div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2">4</div>
                <div class="grade" data-idStudent="28" data-idRating="7">3</div>
                <div class="grade" data-idStudent="29" data-idRating="1"></div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">10.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3"></div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2"></div>
                <div class="grade" data-idStudent="4" data-idRating="7">8</div>
                <div class="grade" data-idStudent="5" data-idRating="1" data-Log="1">5</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6">10</div>
                <div class="grade" data-idStudent="8" data-idRating="17"></div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45"></div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">7</div>
                <div class="grade" data-idStudent="15" data-idRating="2"></div>
                <div class="grade" data-idStudent="16" data-idRating="7"></div>
                <div class="grade" data-idStudent="17" data-idRating="1"></div>
                <div class="grade" data-idStudent="18" data-idRating="2">4</div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17"></div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">7</div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45">4</div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2">2</div>
                <div class="grade" data-idStudent="28" data-idRating="7">1</div>
                <div class="grade" data-idStudent="29" data-idRating="1"></div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">12.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">8</div>
                <div class="grade" data-idStudent="2" data-idRating="4">7</div>
                <div class="grade" data-idStudent="3" data-idRating="2"></div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1"></div>
                <div class="grade" data-idStudent="6" data-idRating="2">2</div>
                <div class="grade" data-idStudent="7" data-idRating="6"></div>
                <div class="grade" data-idStudent="8" data-idRating="17">Нб.отр.</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45"></div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4"></div>
                <div class="grade" data-idStudent="15" data-idRating="2"></div>
                <div class="grade" data-idStudent="16" data-idRating="7">3</div>
                <div class="grade" data-idStudent="17" data-idRating="1"></div>
                <div class="grade" data-idStudent="18" data-idRating="2"></div>
                <div class="grade" data-idStudent="19" data-idRating="6">8</div>
                <div class="grade" data-idStudent="20" data-idRating="17">Нб.отр.</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14"></div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45">7</div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7"></div>
                <div class="grade" data-idStudent="29" data-idRating="1">9</div>
                <div class="grade" data-idStudent="30" data-idRating="2">10</div>
            </div>

            <div class="date_col">
                <div class="date_title" data-idLesson="1">18.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">2</div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2"></div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1"></div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6"></div>
                <div class="grade" data-idStudent="8" data-idRating="17">Нб.отр.</div>
                <div class="grade" data-idStudent="9" data-idRating="16">9</div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">8</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4"></div>
                <div class="grade" data-idStudent="15" data-idRating="2"></div>
                <div class="grade" data-idStudent="16" data-idRating="7"></div>
                <div class="grade" data-idStudent="17" data-idRating="1">7</div>
                <div class="grade" data-idStudent="18" data-idRating="2">7</div>
                <div class="grade" data-idStudent="19" data-idRating="6">7</div>
                <div class="grade" data-idStudent="20" data-idRating="17">5</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14"></div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2">4</div>
                <div class="grade" data-idStudent="28" data-idRating="7"></div>
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
                <div class="grade" data-idStudent="7" data-idRating="6">1</div>
                <div class="grade" data-idStudent="8" data-idRating="17"></div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">8</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">7</div>
                <div class="grade" data-idStudent="15" data-idRating="2"></div>
                <div class="grade" data-idStudent="16" data-idRating="7">4</div>
                <div class="grade" data-idStudent="17" data-idRating="1"></div>
                <div class="grade" data-idStudent="18" data-idRating="2">4</div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17"></div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">7</div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2">2</div>
                <div class="grade" data-idStudent="28" data-idRating="7">1</div>
                <div class="grade" data-idStudent="29" data-idRating="1"></div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">24.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">2</div>
                <div class="grade" data-idStudent="2" data-idRating="4">11</div>
                <div class="grade" data-idStudent="3" data-idRating="2">3</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1"></div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6">6</div>
                <div class="grade" data-idStudent="8" data-idRating="17"></div>
                <div class="grade" data-idStudent="9" data-idRating="16">5</div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13">22</div>
                <div class="grade" data-idStudent="12" data-idRating="45">4</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4"></div>
                <div class="grade" data-idStudent="15" data-idRating="2"></div>
                <div class="grade" data-idStudent="16" data-idRating="7"></div>
                <div class="grade" data-idStudent="17" data-idRating="1"></div>
                <div class="grade" data-idStudent="18" data-idRating="2"></div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17"></div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14"></div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2">2</div>
                <div class="grade" data-idStudent="28" data-idRating="7">10</div>
                <div class="grade" data-idStudent="29" data-idRating="1"></div>
                <div class="grade" data-idStudent="30" data-idRating="2"></div>
            </div>


        </div>

        <div class="statistic"></div>
<!--            <div class="date_col_stat">-->
<!--                <div class="date_title">Ср. балл.</div>-->
<!--                <div class="average" data-idStudent="1"></div>-->
<!--                <div class="average" data-idStudent="2"></div>-->
<!--                <div class="average" data-idStudent="3"></div>-->
<!--                <div class="average" data-idStudent="4"></div>-->
<!--                <div class="average" data-idStudent="5"></div>-->
<!--                <div class="average" data-idStudent="6"></div>-->
<!--                <div class="average" data-idStudent="7"></div>-->
<!--                <div class="average" data-idStudent="8"></div>-->
<!--                <div class="average" data-idStudent="9"></div>-->
<!--                <div class="average" data-idStudent="10"></div>-->
<!--                <div class="average" data-idStudent="11"></div>-->
<!--                <div class="average" data-idStudent="12"></div>-->
<!--                <div class="average" data-idStudent="13"></div>-->
<!--                <div class="average" data-idStudent="14"></div>-->
<!--                <div class="average" data-idStudent="15"></div>-->
<!--                <div class="average" data-idStudent="16"></div>-->
<!--                <div class="average" data-idStudent="17"></div>-->
<!--                <div class="average" data-idStudent="18"></div>-->
<!--                <div class="average" data-idStudent="19"></div>-->
<!--                <div class="average" data-idStudent="20"></div>-->
<!--                <div class="average" data-idStudent="21"></div>-->
<!--                <div class="average" data-idStudent="22"></div>-->
<!--                <div class="average" data-idStudent="23"></div>-->
<!--                <div class="average" data-idStudent="24"></div>-->
<!--                <div class="average" data-idStudent="25"></div>-->
<!--                <div class="average" data-idStudent="26"></div>-->
<!--                <div class="average" data-idStudent="27"></div>-->
<!--                <div class="average" data-idStudent="28"></div>-->
<!--                <div class="average" data-idStudent="29"></div>-->
<!--                <div class="average" data-idStudent="30"></div>-->
<!--            </div>-->
<!--            <div class="date_col_stat">-->
<!--                <div class="date_title">% отв.</div>-->
<!--                <div class="answer" data-idStudent="1"></div>-->
<!--                <div class="answer" data-idStudent="2"></div>-->
<!--                <div class="answer" data-idStudent="3"></div>-->
<!--                <div class="answer" data-idStudent="4"></div>-->
<!--                <div class="answer" data-idStudent="5"></div>-->
<!--                <div class="answer" data-idStudent="6"></div>-->
<!--                <div class="answer" data-idStudent="7"></div>-->
<!--                <div class="answer" data-idStudent="8"></div>-->
<!--                <div class="answer" data-idStudent="9"></div>-->
<!--                <div class="answer" data-idStudent="10"></div>-->
<!--                <div class="answer" data-idStudent="11"></div>-->
<!--                <div class="answer" data-idStudent="12"></div>-->
<!--                <div class="answer" data-idStudent="13"></div>-->
<!--                <div class="answer" data-idStudent="14"></div>-->
<!--                <div class="answer" data-idStudent="15"></div>-->
<!--                <div class="answer" data-idStudent="16"></div>-->
<!--                <div class="answer" data-idStudent="17"></div>-->
<!--                <div class="answer" data-idStudent="18"></div>-->
<!--                <div class="answer" data-idStudent="19"></div>-->
<!--                <div class="answer" data-idStudent="20"></div>-->
<!--                <div class="answer" data-idStudent="21"></div>-->
<!--                <div class="answer" data-idStudent="22"></div>-->
<!--                <div class="answer" data-idStudent="23"></div>-->
<!--                <div class="answer" data-idStudent="24"></div>-->
<!--                <div class="answer" data-idStudent="25"></div>-->
<!--                <div class="answer" data-idStudent="26"></div>-->
<!--                <div class="answer" data-idStudent="27"></div>-->
<!--                <div class="answer" data-idStudent="28"></div>-->
<!--                <div class="answer" data-idStudent="29"></div>-->
<!--                <div class="answer" data-idStudent="30"></div>-->
<!--            </div>-->
<!--        </div>-->
    </div>

</div>

</body>
</html>