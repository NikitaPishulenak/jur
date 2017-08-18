<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title>Оценочная ведомость</title>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="scripts/script.js"></script>
    <script src="scripts/jquery.maskedinput.js"></script>

    <script>
        $(function () {
            var dialog, form, edit_dialog, edit_form;

            function addLesson() {
                //$("div.box").find('input#lesson-date').blur();
                if ($("#lesson-date").val() == "")
                    alert("Для сохранения необходимо заполнить поле 'Дата'");
                else {
                    var date = $("#lesson-date").val();
                    var cnt = $("div.container-list").find("div.fio_student").length;

                    if ($("#colloquium_rb").is(':checked')){
                        $("div.result_box").find('div.date:last').after("<div class='date colloquium_theme'>" + date +"</div>");
                        for (var i = 0; i < cnt; i++) {
                            $("div.date:last").append("<div class='grade'>9</div>");
                        }
                    }
                    else if ($("#exam_rb").is(':checked')){
                        $("div.result_box").find('div.date:last').after("<div class='date exam_theme'>" + date + "</div>");
                        for (var i = 0; i < cnt; i++) {
                            $("div.date:last").append("<div class='grade'>7</div>");
                        }
                    }
                    else{
                        $("div.result_box").find('div.date:last').after("<div class='date'>" + date + "</div>");

                        for (var i = 0; i < cnt; i++) {
                            $("div.date:last").append("<div class='grade'>5</div>");
                        }
                    }


                    dialog.dialog("close");
                }
            }

            function edit() {
//                //$("div.box").find('input#lesson-date').blur();
//                if ($("#lesson-date").val() == "")
//                    alert("Для сохранения необходимо заполнить поле 'Дата'");
//                else {
//                    var date = $("#lesson-date").val();
//                    var cnt = $("div.container-list").find("div.fio_student").length;
//
//                    if ($("#colloquium_rb").is(':checked')){
//                        $("div.result_box").find('div.date:last').after("<div class='date colloquium_theme'>" + date +"</div>");
//                        for (var i = 0; i < cnt; i++) {
//                            $("div.date:last").append("<div class='grade'>9</div>");
//                        }
//                    }
//                    else if ($("#exam_rb").is(':checked')){
//                        $("div.result_box").find('div.date:last').after("<div class='date exam_theme'>" + date + "</div>");
//                        for (var i = 0; i < cnt; i++) {
//                            $("div.date:last").append("<div class='grade'>7</div>");
//                        }
//                    }
//                    else{
//                        $("div.result_box").find('div.date:last').after("<div class='date'>" + date + "</div>");
//
//                        for (var i = 0; i < cnt; i++) {
//                            $("div.date:last").append("<div class='grade'>5</div>");
//                        }
//                    }
//
//
//                    dialog.dialog("close");
//                }
            }


            dialog = $("#form-lesson").dialog({
                autoOpen: false,
                height: 350,
                width: 400,
                modal: true,
                buttons: {
                    "Создать": addLesson,
                    Отмена: function () {
                        dialog.dialog("close");
                    }
                },
                close: function () {
                    form[0].reset();
                }
            });
            form = dialog.find("form").on("submit", function (event) {
                event.preventDefault();
            });

            edit_dialog = $("#form-edit").dialog({
                autoOpen: false,
                height: 250,
                width: 400,
                modal: true,
                buttons: {
                    "Сохранить": edit,
                    Отмена: function () {
                        edit_dialog.dialog("close");
                    }
                },
                close: function () {
                    edit_form[0].reset();
                }
            });
            edit_form = edit_dialog.find("form").on("submit", function (event) {
                event.preventDefault();
            });

            $("div.grade").dblclick(function () {
                edit_dialog.dialog("open");
                var cur_grade=$(this).text();
                var grades = cur_grade.split("/");
                 for(var i=0; i<grades.length; i++){
                     $("div.panel").find('input#inp_'+i).slideDown();
                     $("div.panel").find('input#inp_'+i).val(grades[i]);
                 }
                var str_result=grades.join('/');
                alert(str_result);

            });


            $("#create_lesson").button().on("click", function () {
                dialog.dialog("open");
            });

            var countCell = 1;
            $("#add_grade_input").click(function () {
                if (countCell < 3) {
                    $("#inp_" + countCell).slideDown();
                    ++countCell;
                }
                else {
                    alert("Допускается не более 3 полей ввода!");
                }
            });




//            $("div.grade").dblclick(function () {
//                $( "#div-test" ).show();
//                var value=$(this).text();
//                //var val = $(this).html();
//                //формируем код текстового поля
//                var code = '<input type="text" class="cell" id="edit" style="width: 60px" value="' + value + '" onkeyup="this.value=this.value.replace(/[^0-9]/,\'\'); if (this.value<1 || this.value>10) this.value = \'\';" />';
////                $("div#help").show();
//               //удаляем содержимое ячейки, вставляем в нее сформированное поле
//                $(this).empty().append(code);
//               //устанавливаем фокус на свеженарисованное поле
//                $('#edit').focus();
//                $('#edit').blur(function () {	//устанавливаем обработчик
//                    var val = $(this).val();	//получаем то, что в поле находится
//                    //находим ячейку, опустошаем, вставляем значение из поля
//                    $(this).parent().empty().html(val);
////                    $("div#help").hide();
//                });
//
//            });

//            $(function(){
//                $('div.grade').mouseenter(function(){ // Навели на ссылку?
//                    $( "#div-test" ).show(); // Показываем блок
//                });
//
//                $('div.grade,#div-test').mouseleave(function(e){
//                    if (e.relatedTarget.id == 'new-ref' || e.relatedTarget.id == 'div-test') return;
//                    if ($('#login').val() || $('#password').val()) return;
//                    $('#div-test').hide();
//                });
//
//
//                $(document).click(function(e){ // Функция скрывает элемент если произошёл клик в не поля #div-test
//                    if ($(e.target).closest('#div-test').length) return;  // Не знаю что тут происходит
//                    $('#div-test').hide(); // Скрываем блок
//                    e.stopPropagation(); // Не знаю что тут происходит
//                });
//
//            });


        });


        $(function () {
            $.datepicker.regional['ru'] = {
                monthNames: ['Яварь', 'Февраль', 'Март', 'Апрель',
                    'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь',
                    'Октябрь', 'Ноябрь', 'Декабрь'],
                dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб']
            };
            $('.datepicker').datepicker({dateFormat: 'dd.mm.yy', firstDay: 1});
            $.datepicker.setDefaults($.datepicker.regional['ru']);
            $('.datepicker').mask("99.99.9999");
        });

        $(document).ready(function () {
            //$("div.box").find('input#lesson-date').blur();
            $("#inp_1").slideUp();
            $("#inp_2").slideUp();

            $(".cell:text, .cell1:text, .cell2:text, .col_cell:text, .col_cell1:text, .col_cell2:text, .exam_cell:text, .exam_cell1:text, .exam_cell2:text").focus(function () {
                inp_id = $(this).attr('id');
                //alert(inp_id);

                $("button.grade").click(function () {
                    var text = $(this).text();
                    $("#" + inp_id).val(text);
                    $("#" + inp_id).focus();
                });

                var absenteeisms = /\w/;
                $(".cell:text, .cell1:text, .cell2:text, .col_cell:text, .col_cell1:text, .col_cell2:text, .exam_cell:text, .exam_cell1:text, .exam_cell2:text").keydown(function (event) {
                    if (event.keyCode == 8 || event.keyCode == 46) {	//если это удаление
                        if (!absenteeisms.test(this.value)) {
                            $(this).val("")
                        }
                    }
                });


            });

            $(".cell:text").focus(function () {    // получение фокуса текстовым полем
                $(this).select();
            });


            $("#lesson-date").change(function () {

                if ($("#lesson-date").val().length == 10) {
                    var arrD = $("#lesson-date").val().split(".");
                    arrD[1] -= 1;
                    var d = new Date(arrD[2], arrD[1], arrD[0]);
                    if ((d.getFullYear() == arrD[2]) && (d.getMonth() == arrD[1]) && (d.getDate() == arrD[0])) {
                        if ((arrD[2] > 2016) && (arrD[2]) < 2030) {
                            return true;
                        }
                        else {
                            alert("Проверьте правильность введенного значения года!");
                            $("#lesson-date").val('');
                            return false;
                        }
                    } else {
                        alert("Введена некорректная дата! " + $("#lesson-date").val());
                        $("#lesson-date").val('');
                        return false;
                    }
                }
                else {
                    alert("Дата должна быть введена в формате: дд.мм.гггг");
                    return false;
                }

            });


            $(".cell:text, .cell1:text, .cell2:text, .col_cell:text, .col_cell1:text, .col_cell2:text, .exam_cell:text, .exam_cell1:text, .exam_cell2:text").change(function () {
                var len = this.value.length;
                var grade = this.value.split("/");
                var i = 0;
                for (i; i < grade.length; i++) {
                    grade[i].toString();
                    if (grade[i].charAt(0) == "0") {
                        while (grade[i].charAt(0) == "0") {
                            grade[i] = grade[i].substr(1, grade[i].length);
                        }
                        $(this).val(grade[i]);
                    }
                    else if (isNaN(grade[i])) {
                        alert("Вы ввели ошибочное значение: " + grade[i] + " Исправьте, пожалуйста, ошибку!");
                        $(this).val("");
                        $(this).select();
                    }
                    else if (grade[i] < 1 || grade[i] > 10) {
                        alert("Значение оценки должно входить в диапазон: [1-10]. Вы ввели ошибочное значение: " + grade[i] + " Исправьте, пожалуйста, ошибку!");
                        $(this).val("");
                        $(this).select();
                    }
                    //alert(grade[i]); //вывод каждой оценки
                    //resultStr[i]=grade[i];
                }
            });

        });
    </script>

</head>
<body>

<?php
$array = array("Абрамов Александр Иванович", "Бабушкин Степан Леонидович", "Волкова Алевтина Никитишна", "Гриб Салтан Лаикович", "Евдакимова Янна Викторовна", "Климанович Ян Янович", "Лис Павел Владимирович", "Попов Алексей Георгиевич", "Рудяк Марк Николаевич", "Шеко Артем Викторович", "Шершень Степан Яковлевич", "Шут Павел Владимирович", "Якубович Александр Дмитриевич", "Ясько Елена Максимовна", "Абрамов Александр Иванович", "Бабушкин Степан Леонидович", "Волкова Алевтина Никитишна", "Гриб Салтан Лаикович", "Евдакимова Янна Викторовна", "Климанович Ян Янович", "Лис Павел Владимирович", "Попов Алексей Георгиевич", "Абрамов Александр Иванович", "Бабушкин Степан Леонидович", "Волкова Алевтина Никитишна", "Гриб Салтан Лаикович", "Евдакимова Янна Викторовна", "Климанович Ян Янович", "Лис Павел Владимирович", "Попов Алексей Георгиевич");
$dates = array("01-09", "06-09", "10-09", "15-09", "20-09");
//$dates=array(null);
?>

<div id="form-lesson" title="Создание занятия">
    <form>
        <fieldset>
            <div class="box">
                <b align="center">Дата занятия</b>
                <div id="date">
                    <input type="text" id="lesson-date" required class="datepicker" value="<?php echo date('d.m.Y') ?>"></div>
                <br>
                <div class="type_lesson">
                    <input type="radio" class="type_lesson" id="simple_lesson_rb" name="type_lesson" value="sl" checked><b>Обычное занятие</b></div>
                <br>
                <div class="type_lesson">
                    <input type="radio" class="type_lesson" id="colloquium_rb" name="type_lesson" value="col"><b>Коллоквиум</b></div>
                <br>
                <div class="type_lesson">
                    <input type="radio" class="type_lesson" id="exam_rb" name="type_lesson" value="exam"><b>Аттестация</b></div>
                <br>
            </div>
        </fieldset>
    </form>
</div>

<div id="form-edit" title="Редактирование отметки">
    <form>
        <fieldset>
            <div class="panel">
                <button id="add_grade_input" class="add_grade" title="Для добавления дополнительной оценки нажмите на кнопку!">+</button>
                <b id="1" class="tool"><b>Н<sub>у</sub></b></b>
                <b id="2" class="tool"><b>Н<sub>б/у</sub></b></b>
                <b id="3" class="tool"><b>Н<sub>б/отр.</sub></b></b>
                <b id="4" class="tool"><b>Зач.</b></b>
                <b id="5" class="tool"><b>Незач.</b></b>
                <b id="6" class="tool"><b style="color: #8c0000">Недоп.</b></b>

                <br><br>

                <input class='inp_cell' id="inp_0" type=text maxlength='2' onkeyup="this.value=this.value.replace(/[^0-9]/,''); if (this.value<1 || this.value>10) this.value='';">
                <input class='inp_cell' id="inp_1" type='text' maxlength='2' onkeyup="this.value=this.value.replace(/[^0-9]/,''); if (this.value<1 || this.value>10) this.value='';">
                <input class='inp_cell' id="inp_2" type='text' maxlength='2' onkeyup="this.value=this.value.replace(/[^0-9]/,''); if (this.value<1 || this.value>10) this.value='';">

            </div>
        </fieldset>
    </form>
</div>


<div class="container-list">
    <div class="tools" align="center">
        <button id="create_lesson">Создать занятие</button>
    </div><br><hr><br>
    <div class="box">
        <div class="fio">
            <div class="title">
                ФИО
            </div>
            <?php
            $i = 0;
            foreach ($array as $v) {
                echo "<div class='fio_student'>$v</div>";
            }
            ?>
        </div>

        <div class="result_box">
            <?php
            foreach ($dates as $date) {
                echo "<div class='date'>$date";
                for ($i = 0; $i < count($array); $i++) {
                    echo "<div class='grade'>6/3";
                    echo "</div>";
                }

                echo "</div>";
            }
            ?>

        </div>
        <div id="div-test">
            <input id="login" type="text">
            <input id="password" type="text">
        </div>

        <!--        <div id="help" style="display: none; border: solid green 2px;">-->
        <!--            <button id="1" class="grade" style="width: 80px;"><b>Н<sub>у</sub></b></button>-->
        <!--            <button id="2" class="grade" style="width: 80px;"><b>Н<sub>б/у</sub></b></button>-->
        <!--            <button id="3" class="grade" style="width: 80px;"><b>Н<sub>б/отр.</sub></b></button>-->
        <!--            <button id="4" class="grade" style="width: 80px;"><b>Зач.</b></button>-->
        <!--            <button id="5" class="grade" style="width: 80px;"><b>Незач.</b></button>-->
        <!--            <button id="6" class="grade" style="width: 80px;"><b style="color: #8c0000">Недоп.</b></button>-->
        <!--        </div>-->
    </div>


</div>

</body>
</html>