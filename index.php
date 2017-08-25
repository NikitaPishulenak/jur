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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
                <!--                <b id="ddd">ddd</b>-->
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
    <div class="userData">
        <h3 id="teacher">Забухин Степан Иванович </h3>
        <p>Дисциплина: <b id="subject">Наркология</b></p>
        <p>Группа№: <b id="group">6524</b></p>
        <p><b id="idLesson"></b></p>

    </div>


    <div class="tools" align="center">
        <button id="create_lesson">Новое занятие</button>
    </div>
    <br>
    <hr>
    <br>

    <input type="hidden" name="idPrepod" value="43">
    <input type="hidden" name="idGroup" value="342">
    <input type="hidden" name="idLesson" value="5">
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
            <div class="fio_student" data-hover="1" data-idStudent="23">Абрамов Александр Иванович</div>
            <div class="fio_student" data-hover="2" data-idStudent="423">Бабушкин Степан Леонидович</div>
            <div class="fio_student" data-hover="3" data-idStudent="563">Волкова Алевтина Никитишна</div>
            <div class="fio_student" data-hover="4" data-idStudent="21">Гриб Салтан Лаикович</div>
            <div class="fio_student" data-hover="5" data-idStudent="1">Евдакимова Янна Викторовна</div>
            <div class="fio_student" data-hover="6" data-idStudent="4">Климанович Ян Янович</div>
            <div class="fio_student" data-hover="7" data-idStudent="5">Лис Павел Владимирович</div>
            <div class="fio_student" data-hover="8" data-idStudent="456">Попов Алексей Георгиевич</div>
            <div class="fio_student" data-hover="9" data-idStudent="4578">Рудяк Марк Николаевич</div>
            <div class="fio_student" data-hover="10" data-idStudent="93">Шеко Артем Викторович</div>
            <div class="fio_student" data-hover="11" data-idStudent="97">Шершень Степан Яковлевич</div>
            <div class="fio_student" data-hover="12" data-idStudent="653">Шут Павел Владимирович</div>
            <div class="fio_student" data-hover="13" data-idStudent="293">Якубович Александр Дмитриевич</div>
            <div class="fio_student" data-hover="14" data-idStudent="905">Ясько Елена Максимовна</div>
            <div class="fio_student" data-hover="15" data-idStudent="104">Абрамова Софья Игоревна</div>
            <div class="fio_student" data-hover="16" data-idStudent="909">Абрамова Александра Федоровна</div>
            <div class="fio_student" data-hover="17" data-idStudent="100">Ильин Степан Мойшавич</div>
            <div class="fio_student" data-hover="18" data-idStudent="72">Абдым ын Салын Халы</div>
            <div class="fio_student" data-hover="19" data-idStudent="77">Федоров Геннадий Андреевич</div>
            <div class="fio_student" data-hover="20" data-idStudent="66">Копытов Александр Васильевич</div>
            <div class="fio_student" data-hover="21" data-idStudent="10">Шапка Василий Иванович</div>
            <div class="fio_student" data-hover="22" data-idStudent="38">Соломахина Анжелика Никитишна</div>
            <div class="fio_student" data-hover="23" data-idStudent="7653">Никитин Николай Николаевич</div>
            <div class="fio_student" data-hover="24" data-idStudent="7928">Шульц Максим Витальевич</div>
            <div class="fio_student" data-hover="25" data-idStudent="7009">Высоцкий Михаил Владимирович</div>
            <div class="fio_student" data-hover="26" data-idStudent="1879">Данилова Галина Владимировна</div>
            <div class="fio_student" data-hover="27" data-idStudent="5398">Басова Янина Александровна</div>
            <div class="fio_student" data-hover="28" data-idStudent="2876">Бахтизин Вячеслав Вениаминович</div>
            <div class="fio_student" data-hover="29" data-idStudent="9748">Кружкин Михаил Геннадьевич</div>
            <div class="fio_student" data-hover="30" data-idStudent="2876">Заикин Василий Фомич</div>
        </div>


        <div class="result_box">
            <div class='date_col'>
                <div class="date_title" data-idLesson="1">01.09.2017</div>
                <div class="grade" data-hover="1" data-idStudent="23" data-idRating="3">5</div>
                <div class="grade" data-hover="2"  data-idStudent="423" data-idRating="4"></div>
                <div class="grade" data-hover="3"  data-idStudent="563" data-idRating="2"></div>
                <div class="grade" data-hover="4"  data-idStudent="21" data-idRating="7">9</div>
                <div class="grade" data-hover="5">4</div>
                <div class="grade" data-hover="6">2</div>
                <div class="grade" data-hover="7">10</div>
                <div class="grade" data-hover="8">Нб.отр.</div>
                <div class="grade" data-hover="9"></div>
                <div class="grade" data-hover="10">5</div>
                <div class="grade" data-hover="11">3</div>
                <div class="grade" data-hover="12"></div>
                <div class="grade" data-hover="13"></div>
                <div class="grade" data-hover="14"></div>
                <div class="grade" data-hover="15">5</div>
                <div class="grade" data-hover="16">5</div>
                <div class="grade" data-hover="17">6</div>
                <div class="grade" data-hover="18">5</div>
                <div class="grade" data-hover="19">Нб.отр.</div>
                <div class="grade" data-hover="20">10</div>
                <div class="grade" data-hover="21">8</div>
                <div class="grade" data-hover="22">3</div>
                <div class="grade" data-hover="23">9</div>
                <div class="grade" data-hover="24">1</div>
                <div class="grade" data-hover="25">2</div>
                <div class="grade" data-hover="26">1</div>
                <div class="grade" data-hover="27"></div>
                <div class="grade" data-hover="28">2</div>
                <div class="grade" data-hover="29">1</div>
                <div class="grade" data-hover="30">8</div>
            </div>
            <div class='date_col'>
                <div class="date_title" data-idLesson="2">02.09.2017</div>
                <div class="grade" data-hover="1">7</div>
                <div class="grade" data-hover="2"></div>
                <div class="grade" data-hover="3"></div>
                <div class="grade" data-hover="4">9</div>
                <div class="grade" data-hover="5"></div>
                <div class="grade" data-hover="6">2</div>
                <div class="grade" data-hover="7">10</div>
                <div class="grade" data-hover="8">Нб.отр.</div>
                <div class="grade" data-hover="9"></div>
                <div class="grade" data-hover="10">5</div>
                <div class="grade" data-hover="11">5</div>
                <div class="grade" data-hover="12"></div>
                <div class="grade" data-hover="13"></div>
                <div class="grade" data-hover="14"></div>
                <div class="grade" data-hover="15">5</div>
                <div class="grade" data-hover="16">5</div>
                <div class="grade" data-hover="17">6</div>
                <div class="grade" data-hover="18">5</div>
                <div class="grade" data-hover="19">Нб.отр.</div>
                <div class="grade" data-hover="20">10</div>
                <div class="grade" data-hover="21">8</div>
                <div class="grade" data-hover="22">2</div>
                <div class="grade" data-hover="23">9</div>
                <div class="grade" data-hover="24">1</div>
                <div class="grade" data-hover="25">2</div>
                <div class="grade" data-hover="26">1</div>
                <div class="grade" data-hover="27"></div>
                <div class="grade" data-hover="28">2</div>
                <div class="grade" data-hover="29">10</div>
                <div class="grade" data-hover="30">8</div>
            </div>
            <div class='date_col' data-idLesson="3">
                <div class="date_title">04.09.2017</div>
                <div class="grade" data-hover="1">3</div>
                <div class="grade" data-hover="2">9</div>
                <div class="grade" data-hover="3"></div>
                <div class="grade" data-hover="4">9</div>
                <div class="grade" data-hover="5">4</div>
                <div class="grade" data-hover="6">2</div>
                <div class="grade" data-hover="7">5</div>
                <div class="grade" data-hover="8">Нб.отр.</div>
                <div class="grade" data-hover="9"></div>
                <div class="grade" data-hover="10">5</div>
                <div class="grade" data-hover="11">3</div>
                <div class="grade" data-hover="12"></div>
                <div class="grade" data-hover="13"></div>
                <div class="grade" data-hover="14"></div>
                <div class="grade" data-hover="15">9</div>
                <div class="grade" data-hover="16">5</div>
                <div class="grade" data-hover="17">6</div>
                <div class="grade" data-hover="18">8</div>
                <div class="grade" data-hover="19">Нб.отр.</div>
                <div class="grade" data-hover="20">10</div>
                <div class="grade" data-hover="21">8</div>
                <div class="grade" data-hover="22">3</div>
                <div class="grade" data-hover="23">9</div>
                <div class="grade" data-hover="24">10</div>
                <div class="grade" data-hover="25">2</div>
                <div class="grade" data-hover="26">1</div>
                <div class="grade" data-hover="27"></div>
                <div class="grade" data-hover="28">2</div>
                <div class="grade" data-hover="29">10</div>
                <div class="grade" data-hover="30">8</div>
            </div>
            <div class='date_col' data-idLesson="4">
                <div class="date_title">09.09.2017</div>
                <div class="grade" data-hover="1">2</div>
                <div class="grade" data-hover="2"></div>
                <div class="grade" data-hover="3"></div>
                <div class="grade" data-hover="4">9</div>
                <div class="grade" data-hover="5">7</div>
                <div class="grade" data-hover="6">2</div>
                <div class="grade" data-hover="7">10</div>
                <div class="grade" data-hover="8">Нб.отр.</div>
                <div class="grade" data-hover="9"></div>
                <div class="grade" data-hover="10">5</div>
                <div class="grade" data-hover="11">9</div>
                <div class="grade" data-hover="12"></div>
                <div class="grade" data-hover="13"></div>
                <div class="grade" data-hover="14"></div>
                <div class="grade" data-hover="15">6</div>
                <div class="grade" data-hover="16">5</div>
                <div class="grade" data-hover="17">6</div>
                <div class="grade" data-hover="18">9</div>
                <div class="grade" data-hover="19">Нб.отр.</div>
                <div class="grade" data-hover="20">10</div>
                <div class="grade" data-hover="21">8</div>
                <div class="grade" data-hover="22">4</div>
                <div class="grade" data-hover="23">9</div>
                <div class="grade" data-hover="24">1</div>
                <div class="grade" data-hover="25">3</div>
                <div class="grade" data-hover="26">1</div>
                <div class="grade" data-hover="27"></div>
                <div class="grade" data-hover="28">2</div>
                <div class="grade" data-hover="29">8</div>
                <div class="grade" data-hover="30">8</div>
            </div>


        </div>

    </div>

    <div id="data">

    </div>


</div>

</body>
</html>