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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="scripts/jquery.maskedinput.js"></script>


    <script>
        $(function () {
            var dialog, form, edit_dialog, edit_form;

            function addLesson() {
                if ($("#lesson-date").val() == "")
                    alert("Для сохранения необходимо заполнить поле 'Дата'");
                else {
                    var date = $("#lesson-date").val();
                    var cnt = $("div.container-list").find("div.fio_student").length;

                    if ($("#colloquium_rb").is(':checked')) {
                        $("div.result_box").find('div.date_col:last').after("<div class='date_col colloquium_theme'><div class='date_title'>" + date + "</div></div>");
                        for (var i = 0; i < cnt; i++) {
                            $("div.date_col:last").append("<div class='grade' ></div>");
                        }
                    }

                    else if ($("#exam_rb").is(':checked')) {
                        $("div.result_box").find('div.date_col:last').after("<div class='date_col exam_theme'><div class='date_title'>" + date + "</div></div>");
                        for (var i = 0; i < cnt; i++) {
                            $("div.date_col:last").append("<div class='grade'></div>");
                        }
                    }
                    else {
                        $("<div class='date_col'><div class='date_title'>" + date + "</div></div>").insertAfter('div.date_col:last');

                        for (var i = 0; i < cnt; i++) {
                            $("div.date_col:last").append("<div class='grade' ></div>");
                        }
                    }
                    dialog.dialog("close");
                }
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
                height: 'auto',
                width: 'auto',
                modal: true
            });
            edit_form = edit_dialog.find("form").on("submit", function (event) {
                event.preventDefault();
            });


            $('div').delegate(".grade", "dblclick", function () {

                edit_dialog.dialog("open");
                edit_form[0].reset();
                $("button#add_grade_input").removeAttr('disabled');

                //$("#inp_0").focus();
                $('#inp_2').slideUp();
                --countCell;
                $('#inp_1').slideUp();
                --countCell;

                var cur_grade = $(this).text();
                elem = $(this);

                grades = cur_grade.split("/");
                for (var i = 0; i < grades.length; i++) {
                    $("div.panel").find('input#inp_' + i).slideDown();
                    $("div.panel").find('input#inp_' + i).val(grades[i]);
                }
                $('input#inp_0').focus();
                $('input#inp_0').select();

                $(".inp_cell:text").focus(function () {
                    inp_id = $(this).attr('id');
                    //console.log(inp_id);
                    //alert(inp_id);

//                    $("b.tool").click(function () {
//                        var text = $(this).text();
//                        $("#" + inp_id).val(text);
//                        $("#" + inp_id).focus();
//                    });

                });
                $("b#1").click(function(){
                    $("#" + inp_id).val("Ну");
                    //$("#" + inp_id).focus();
                });
                $("b#2").click(function(){
                    $("#" + inp_id).val("Нб_у");
                    //$("#" + inp_id).focus();
                });
                $("b#3").click(function(){
                    $("#" + inp_id).val("Нб_отр.");
                    //$("#" + inp_id).focus();
                });
                $("b#4").click(function(){
                    $("#" + inp_id).val("Зач.");
                    // $("#" + inp_id).focus();
                });
                $("b#5").click(function(){
                    $("#" + inp_id).val("Незач.");
                    //$("#" + inp_id).focus();
                });
                $("b#6").click(function(){
                    $("#" + inp_id).val("Недопуск");
                    //$("#" + inp_id).focus();
                });

                var countOpenCell = 0;
                for (j = 0; j < 3; j++) {
                    if ($("#inp_" + j).val() != "") {
                        countOpenCell++;
                    }
                }
                if (countOpenCell == 3) {
                    $("button#add_grade_input").attr('disabled', true);
                }

                var absenteeisms = /\w/;
                $(".inp_cell:text").keydown(function (event) {
                    if (event.keyCode == 8 || event.keyCode == 46) {	//если это удаление
                        if (!absenteeisms.test(this.value)) {
                            $(this).val("")
                        }
                    }
                });

                $("#edit").click(function () {
                    //console.log($('#form-edit').serializeArray());
                    var coding = "";
                    var bit1 = $("#inp_0").val();
                    var bit2 = $("#inp_1").val();
                    var bit3 = $("#inp_2").val();
                    bit1 = (bit1 == "") ? "" : bit1;
                    bit2 = (bit2 == "") ? "" : "/" + bit2;
                    bit3 = (bit3 == "") ? "" : "/" + bit3;
                    var cur_res = bit1 + bit2 + bit3;
                    //alert(cur_res);
                    coding = Encrypt(cur_res);
                    elem.text(cur_res);
                    //alert(coding);
                    edit_dialog.dialog("close");
                });

            });

            $(".inp_cell:text").click(function () {
                $(this).select();
            });


            $("#create_lesson").button().on("click", function () {
                dialog.dialog("open");
            });


            $("#add_grade_input").click(function () {

                if (countCell < 3) {
                    if (countCell <= 0)
                        countCell = 1;


                    if ($("#inp_" + (countCell - 1)).val() != "") {
                        $("#inp_" + countCell).slideDown();
                        $("#inp_" + countCell).focus();
                        ++countCell;
                    }
                    else {
                        alert("Заполните, пожалуйста, доступное поле ввода оценки!");
                    }

                }
                else {
                    alert("Допускается не более 3 полей ввода!");
                    $("button#add_grade_input").attr('disabled', true);

                }
            });

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
            countCell = 1;


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
        });



        function Encrypt(value) {
            var res = "";
            var grade = value.split("/");
            for (i = 0; i < grade.length; i++) {
                res += MatchEncrypt(grade[i]);

            }
            return res;
        }

        function Decrypt(value) {
            var res = "";
            var mas = value.match(/.{2}/g);
            for (i = 0; i < mas.length; i++) {
                mas[i] = MatchDecrypt(mas[i]);
            }
            res = mas.join('/');
            //alert(res);
            return res;
        }

        function MatchEncrypt(val) {
            switch (val) {
                case '1':
                    return '11';
                    break;
                case '2':
                    return '12';
                    break;
                case '3':
                    return '13';
                    break;
                case '4':
                    return '14';
                    break;
                case '5':
                    return '15';
                    break;
                case '6':
                    return '16';
                    break;
                case '7':
                    return '17';
                    break;
                case '8':
                    return '18';
                    break;
                case '9':
                    return '19';
                    break;
                case '10':
                    return '20';
                    break;
                case 'Ну':
                    return '21';
                    break;
                case 'Нб_у':
                    return '22';
                    break;
                case 'Нб_отр.':
                    return '23';
                    break;
                case 'Зач.':
                    return '24';
                    break;
                case 'Незач.':
                    return '25';
                    break;
                case 'Недопуск':
                    return '26';
                    break;
            }

        }

        function MatchDecrypt(val) {
            switch (val) {
                case '11':
                    return '1';
                    break;
                case '12':
                    return '2';
                    break;
                case '13':
                    return '3';
                    break;
                case '14':
                    return '4';
                    break;
                case '15':
                    return '5';
                    break;
                case '16':
                    return '6';
                    break;
                case '17':
                    return '7';
                    break;
                case '18':
                    return '8';
                    break;
                case '19':
                    return '9';
                    break;
                case '20':
                    return '10';
                    break;
                case '21':
                    return 'Ну';
                    break;
                case '22':
                    return 'Нб_у';
                    break;
                case '23':
                    return 'Нб_отр.';
                    break;
                case '24':
                    return 'Зач.';
                    break;
                case '25':
                    return 'Незач.';
                    break;
                case '26':
                    return 'Недопуск';
                    break;
            }

        }

        //        var s="262524232221201113182527"; //пробую расшифровать
        //        alert(Decrypt(s));
    </script>

</head>
<body>

<?php
$array = array("Ананич Злата Сергеевна", "Гунева Кристина Дмитриевна", "Дмитрущенкова Анастасия Олеговна", "Жерко Любовь Вячеславовна", "Ибадова Марйам Этибар кызы", "Ильюшкова Мария Сергеевна", "Казакова Анастасия Сергеевна", "Клакоцкая Анна Анатольевна", "Лицкевич Елизавета Александровна", "Шафран Роман Валентинович", "Якунович	Екатерина Викторовна");
//$dates = array("01.09.2017", "06.09.2017", "10.09.2019", "15.09.2017", "20.09.2017");
//$dates = array("01.09.2017");
?>

<div id="form-lesson" title="Создание занятия">
    <form>
        <fieldset>
            <div class="box">
                <b align="center">Дата занятия</b>
                <div id="date_col">
                    <input type="text" id="lesson-date" required class="datepicker" value="<?php echo date('d.m.Y') ?>">
                </div>
                <br>
                <label><input type="radio" class="type_lesson" id="simple_lesson_rb" name="type_lesson" value="sl" checked><b>Обычное занятие</b></label>
                <br><br>
                <label><input type="radio" class="type_lesson" id="colloquium_rb" name="type_lesson" value="col"><b>Коллоквиум</b></label>
                <br><br>
                <label><input type="radio" class="type_lesson" id="exam_rb" name="type_lesson" value="exam"><b>Аттестация</b></label>
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
                <b id="2" class="tool"><b>Н<sub>б_у</sub></b></b>
                <span class="space"></span>
                <b id="3" class="tool"><b>Н<sub>б_отр.</sub></b></b>
                <span class="space"></span>
                <b id="4" class="tool"><b>Зач.</b></b>
                <span class="space"></span>
                <b id="5" class="tool"><b>Незач.</b></b>
                <span class="space"></span>
                <b id="6" class="tool fail"><b>Недопуск</b></b>

                <br><br>

                <input class='inp_cell' id="inp_0" type=text maxlength='2'
                       onkeyup="this.value=this.value.replace(/[^0-9]/,''); if (this.value<1 || this.value>10) this.value='';">
                <input class='inp_cell' id="inp_1" type='text' maxlength='2'
                       onkeyup="this.value=this.value.replace(/[^0-9]/,''); if (this.value<1 || this.value>10) this.value='';">
                <input class='inp_cell' id="inp_2" type='text' maxlength='2'
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
    <h3>Сикорский Анатолий Викторович (2-я кафедра детских болезней)</h3>
    <p>Дисциплина: <b> Педиатрия</b></p>
    <p>Группа№: <b>2404</b></p>

    <div class="tools" align="center">
        <button id="create_lesson">Создать занятие</button>
    </div>
    <br>
    <hr>
    <br>
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
            echo "<div class='date_col' style='display: none'></div>";
            foreach ($dates as $date) {
                echo "<div class='date_col'><div class='date_title'>$date</div>";
                for ($i = 0; $i < count($array); $i++) {
                    echo "<div class='grade'>";
                    echo "</div>";
                }

                echo "</div>";
            }
            ?>

        </div>

    </div>


</div>

</body>
</html>