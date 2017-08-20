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
                        $("div.result_box").find('div.date:last').after($("<div class='date exam_theme'>" + date + "</div>"));
                        for (var i = 0; i < cnt; i++) {
                            $("div.date:last").append($("<div class='grade'>7</div>"));
                        }
                    }
                    else{
                        $("<div class='date'>" + date + "</div>").insertAfter($('div.date:last'));
                        //$('div.date:last').after("<div class='date'>" + date + "</div>");

                        for (var i = 0; i < cnt; i++) {
                            $("div.date:last").append($("<div class='grade'>5</div>"));
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


            $('div.grade').dblclick(function () {
                edit_dialog.dialog("open");
                edit_form[0].reset();
                $('#inp_2').slideUp();
                --countCell;
                $('#inp_1').slideUp();
                --countCell;
                var cur_grade=$(this).text();
                elem=$(this);

                grades = cur_grade.split("/");
                 for(var i=0; i<grades.length; i++){
                     $("div.panel").find('input#inp_'+i).slideDown();
                     $("div.panel").find('input#inp_'+i).val(grades[i]);
                 }

                $(".inp_cell:text").focus(function () {
                    inp_id=$(this).attr('id');
                    //alert(inp_id);
                    $("b.tool").click(function () {
                        var text=$(this).text();
                        $("#" + inp_id).val(text);
                        $("#" + inp_id).focus();
                    });
                });

                var absenteeisms = /\w/;
                $(".inp_cell:text").keydown(function (event) {
                    if (event.keyCode == 8 || event.keyCode == 46) {	//если это удаление
                        if (!absenteeisms.test(this.value)) {
                            $(this).val("")
                        }
                    }
                });

                $("#edit").click(function () {
                    var bit1 = $("#inp_0").val();
                    var bit2 = $("#inp_1").val();
                    var bit3 = $("#inp_2").val();
                    bit1 = (bit1 == "") ? "" : bit1;
                    bit2 = (bit2 == "") ? "" : "/" + bit2;
                    bit3 = (bit3 == "") ? "" : "/" + bit3;
                    var cur_res = bit1 + bit2 + bit3;
                    //alert("Result"+cur_res);
                    elem.text(cur_res);

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
                    if(countCell<=0)
                        countCell=1;
                    if($("#inp_"+(countCell-1)).val() !=""){
                        $("#inp_" + countCell).slideDown();
                        ++countCell;
                    }
                    else{

                        alert("Заполните, пожалуйста, доступное поле ввода оценки!");
                    }

                }
                else {
                    alert("Допускается не более 3 полей ввода!");
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
                <b id="2" class="tool"><b>Н<sub>б_у</sub></b></b>
                <b id="3" class="tool"><b>Н<sub>б_отр.</sub></b></b>
                <b id="4" class="tool"><b>Зач.</b></b>
                <b id="5" class="tool"><b>Незач.</b></b>
                <b id="6" class="tool"><b style="color: #8c0000">Недоп.</b></b>

                <br><br>

                <input class='inp_cell' id="inp_0" type=text maxlength='2' onkeyup="this.value=this.value.replace(/[^0-9]/,''); if (this.value<1 || this.value>10) this.value='';">
                <input class='inp_cell' id="inp_1" type='text' maxlength='2' onkeyup="this.value=this.value.replace(/[^0-9]/,''); if (this.value<1 || this.value>10) this.value='';">
                <input class='inp_cell' id="inp_2" type='text' maxlength='2' onkeyup="this.value=this.value.replace(/[^0-9]/,''); if (this.value<1 || this.value>10) this.value='';">

                <br><hr><br>
                <button id="edit" class="button"><b>Сохранить</b></button>
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
                    echo "<div class='grade'>3";
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