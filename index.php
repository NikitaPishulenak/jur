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
    <script src="scripts/script.js"></script>

</head>
<body>

<div id="form-lesson" title="Создание занятия">
    <form>
        <fieldset>
            <div class="box">
                <b align="center">Дата занятия</b>
                <div id="date_col">
                    <input type="text" id="lesson-date" required class="datepicker" value="<?php echo date('d.m.Y') ?>">
                </div>
                <br>
                <label><input type="radio" class="type_lesson" id="simple_lesson_rb" name="type_lesson" value="sl" checked><b class="type_lesson">Обычное занятие</b></label>
                <br><br>
                <label><input type="radio" class="type_lesson" id="colloquium_rb" name="type_lesson" value="col"><b class="type_lesson">Коллоквиум</b></label>
                <br><br>
                <label><input type="radio" class="type_lesson" id="exam_rb" name="type_lesson" value="exam"><b class="type_lesson">Аттестация</b></label>
                <br><br>
            </div>
        </fieldset>
    </form>
</div>

<div id="form-edit" title="Редактирование отметки">
    <form id="form-edit">
        <fieldset>
            <div class="panel">
                <button id="add_grade_input" class="add_grade"
                        title="Для добавления дополнительной оценки нажмите на кнопку!">+
                </button>
                <span class="space"></span>
                <b id="1" class="tool"><b>Н<sub>у</sub></b></b>
                <span class="space"></span>
                <b id="2" class="tool"><b>Н<sub>б.у</sub></b></b>
                <span class="space"></span>
                <b id="3" class="tool"><b>Н<sub>б.о.</sub></b></b>
                <span class="space"></span>
                <b id="4" class="tool"><b>Зач.</b></b>
                <span class="space"></span>
                <b id="5" class="tool"><b>Незач.</b></b>
                <span class="space"></span>
                <b id="6" class="tool fail"><b>Недоп</b></b>

                <br><br>

                <input class='inp_cell' id="inp_0" type=text maxlength='6'
                       onkeyup="this.value=this.value.replace(/[^0-9]/,''); if (this.value<1 || this.value>10) this.value='';">
                <input class='inp_cell' id="inp_1" type='text' maxlength='6'
                       onkeyup="this.value=this.value.replace(/[^0-9]/,''); if (this.value<1 || this.value>10) this.value='';">
                <input class='inp_cell' id="inp_2" type='text' maxlength='6'
                       onkeyup="this.value=this.value.replace(/[^0-9]/,''); if (this.value<1 || this.value>10) this.value='';">

                <br>
                <hr>
                <br>
                <button id="edit" class="button"><b>Сохранить</b></button>
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


        <div class="result_box">
            <div class='date_col hidden'></div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">01.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">111213</div>
                <div class="grade" data-idStudent="2" data-idRating="4">22</div>
                <div class="grade" data-idStudent="3" data-idRating="2">23</div>
                <div class="grade" data-idStudent="4" data-idRating="7">11</div>
                <div class="grade" data-idStudent="5" data-idRating="1">1219</div>
                <div class="grade" data-idStudent="6" data-idRating="2">2</div>
                <div class="grade" data-idStudent="7" data-idRating="6">10</div>
                <div class="grade" data-idStudent="8" data-idRating="17">Нб.отр.</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14">5</div>
                <div class="grade" data-idStudent="11" data-idRating="13">3</div>
                <div class="grade" data-idStudent="12" data-idRating="45"></div>
                <div class="grade" data-idStudent="13" data-idRating="3">5</div>
                <div class="grade" data-idStudent="14" data-idRating="4"></div>
                <div class="grade" data-idStudent="15" data-idRating="2"></div>
                <div class="grade" data-idStudent="16" data-idRating="7">9</div>
                <div class="grade" data-idStudent="17" data-idRating="1">4</div>
                <div class="grade" data-idStudent="18" data-idRating="2">2</div>
                <div class="grade" data-idStudent="19" data-idRating="6">10</div>
                <div class="grade" data-idStudent="20" data-idRating="17">Нб.отр.</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">5</div>
                <div class="grade" data-idStudent="23" data-idRating="13">3</div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3">5</div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">9</div>
                <div class="grade" data-idStudent="29" data-idRating="1">4</div>
                <div class="grade" data-idStudent="30" data-idRating="2">2</div>
            </div>
            <div class="date_col">
                <div class="date_title" data-idLesson="1">12.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">8</div>
                <div class="grade" data-idStudent="2" data-idRating="4">7</div>
                <div class="grade" data-idStudent="3" data-idRating="2"></div>
                <div class="grade" data-idStudent="4" data-idRating="7">3</div>
                <div class="grade" data-idStudent="5" data-idRating="1">9</div>
                <div class="grade" data-idStudent="6" data-idRating="2">2</div>
                <div class="grade" data-idStudent="7" data-idRating="6">1</div>
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
                <div class="grade" data-idStudent="18" data-idRating="2">2</div>
                <div class="grade" data-idStudent="19" data-idRating="6">8</div>
                <div class="grade" data-idStudent="20" data-idRating="17">Нб.отр.</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14"></div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45">7</div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2">5</div>
                <div class="grade" data-idStudent="28" data-idRating="7">9</div>
                <div class="grade" data-idStudent="29" data-idRating="1">9</div>
                <div class="grade" data-idStudent="30" data-idRating="2">10</div>
            </div>

            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">2</div>
                <div class="grade" data-idStudent="2" data-idRating="4">2</div>
                <div class="grade" data-idStudent="3" data-idRating="2"></div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1">9</div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6"></div>
                <div class="grade" data-idStudent="8" data-idRating="17">Нб.отр.</div>
                <div class="grade" data-idStudent="9" data-idRating="16">9</div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45">8</div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4"></div>
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
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3"></div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2"></div>
                <div class="grade" data-idStudent="4" data-idRating="7">8</div>
                <div class="grade" data-idStudent="5" data-idRating="1"></div>
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
                <div class="date_title" data-idLesson="1">01.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">21</div>
                <div class="grade" data-idStudent="2" data-idRating="4">22</div>
                <div class="grade" data-idStudent="3" data-idRating="2">23</div>
                <div class="grade" data-idStudent="4" data-idRating="7">11</div>
                <div class="grade" data-idStudent="5" data-idRating="1">12</div>
                <div class="grade" data-idStudent="6" data-idRating="2">2</div>
                <div class="grade" data-idStudent="7" data-idRating="6">10</div>
                <div class="grade" data-idStudent="8" data-idRating="17">Нб.отр.</div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14">5</div>
                <div class="grade" data-idStudent="11" data-idRating="13">3</div>
                <div class="grade" data-idStudent="12" data-idRating="45"></div>
                <div class="grade" data-idStudent="13" data-idRating="3">5</div>
                <div class="grade" data-idStudent="14" data-idRating="4"></div>
                <div class="grade" data-idStudent="15" data-idRating="2"></div>
                <div class="grade" data-idStudent="16" data-idRating="7">9</div>
                <div class="grade" data-idStudent="17" data-idRating="1">4</div>
                <div class="grade" data-idStudent="18" data-idRating="2">2</div>
                <div class="grade" data-idStudent="19" data-idRating="6">10</div>
                <div class="grade" data-idStudent="20" data-idRating="17">Нб.отр.</div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">5</div>
                <div class="grade" data-idStudent="23" data-idRating="13">3</div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3">5</div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">9</div>
                <div class="grade" data-idStudent="29" data-idRating="1">4</div>
                <div class="grade" data-idStudent="30" data-idRating="2">2</div>
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
                <div class="date_title" data-idLesson="1">20.09.2017</div>
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
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3">2</div>
                <div class="grade" data-idStudent="2" data-idRating="4"></div>
                <div class="grade" data-idStudent="3" data-idRating="2">3</div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1"></div>
                <div class="grade" data-idStudent="6" data-idRating="2"></div>
                <div class="grade" data-idStudent="7" data-idRating="6">6</div>
                <div class="grade" data-idStudent="8" data-idRating="17"></div>
                <div class="grade" data-idStudent="9" data-idRating="16">5</div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
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
            <div class="date_col">
                <div class="date_title" data-idLesson="1">20.09.2017</div>
                <div class="grade" data-idStudent="1" data-idRating="3"></div>
                <div class="grade" data-idStudent="2" data-idRating="4">8</div>
                <div class="grade" data-idStudent="3" data-idRating="2"></div>
                <div class="grade" data-idStudent="4" data-idRating="7"></div>
                <div class="grade" data-idStudent="5" data-idRating="1"></div>
                <div class="grade" data-idStudent="6" data-idRating="2">4</div>
                <div class="grade" data-idStudent="7" data-idRating="6">3</div>
                <div class="grade" data-idStudent="8" data-idRating="17"></div>
                <div class="grade" data-idStudent="9" data-idRating="16"></div>
                <div class="grade" data-idStudent="10" data-idRating="14"></div>
                <div class="grade" data-idStudent="11" data-idRating="13"></div>
                <div class="grade" data-idStudent="12" data-idRating="45"></div>
                <div class="grade" data-idStudent="13" data-idRating="3"></div>
                <div class="grade" data-idStudent="14" data-idRating="4">6</div>
                <div class="grade" data-idStudent="15" data-idRating="2"></div>
                <div class="grade" data-idStudent="16" data-idRating="7">4</div>
                <div class="grade" data-idStudent="17" data-idRating="1"></div>
                <div class="grade" data-idStudent="18" data-idRating="2">4</div>
                <div class="grade" data-idStudent="19" data-idRating="6"></div>
                <div class="grade" data-idStudent="20" data-idRating="17"></div>
                <div class="grade" data-idStudent="21" data-idRating="16"></div>
                <div class="grade" data-idStudent="22" data-idRating="14">3</div>
                <div class="grade" data-idStudent="23" data-idRating="13"></div>
                <div class="grade" data-idStudent="24" data-idRating="45"></div>
                <div class="grade" data-idStudent="25" data-idRating="3"></div>
                <div class="grade" data-idStudent="26" data-idRating="4"></div>
                <div class="grade" data-idStudent="27" data-idRating="2"></div>
                <div class="grade" data-idStudent="28" data-idRating="7">9</div>
                <div class="grade" data-idStudent="29" data-idRating="1"></div>
                <div class="grade" data-idStudent="30" data-idRating="2">9</div>
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


        </div>

<!--        <div class="statistic">-->
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