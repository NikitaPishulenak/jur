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
            var dialog_simple_les, form1, form2, form3, dialog_colloquium, dialog_exam;

            function addSimpleLesson() {
                if ($("#simple_les-date").val() == "")
                    alert("Для сохранения необходимо заполнить поле 'Дата'");
                else {
                    var date = $("#simple_les-date").val();
                    var cnt = $("div.container-list").find("div.fio_student").length;
                    $("div.result_box").find('div.date:last').after("<div class='date' style='border: solid black 1px; width: 80px; float: left;'>" + date + "<div class='grade'></div></div>");

                    for (var i = 0; i < cnt; i++) {
                        var bit1 = $("#0sl_inp" + i).val();
                        var bit2 = $("#1sl_inp" + i).val();
                        var bit3 = $("#2sl_inp" + i).val();
                        bit1 = (bit1 == "") ? "" : bit1;
                        bit2 = (bit2 == "") ? "" : "/" + bit2;
                        bit3 = (bit3 == "") ? "" : "/" + bit3;
                        var cur_res = bit1 + bit2 + bit3;
                        //alert(cur_res);
                        $("div.date:last").find('div.grade:last').after("<div  class='grade' style=\"border: solid black 1px; width: 80px; height: 30px;\">" + cur_res + "</div>");
                    }

                    dialog_simple_les.dialog("close");
                }
            }


            function addColloquium() {
                if ($("#colloquium-date").val() == "")
                    alert("Для сохранения необходимо заполнить поле 'Дата'");
                else {
                    var date = $("#colloquium-date").val();
                    var cnt = $("div.container-list").find("div.fio_student").length;
                    $("div.result_box").find('div.date:last').after("<div class='date' style='border: solid black 1px; width: 80px; float: left; background-color: #B0E0E6'>" + date + "<div class='grade'></div></div>");

                    for (var i = 0; i < cnt; i++) {
                        var bit1 = $("#0col_inp" + i).val();
                        var bit2 = $("#1col_inp" + i).val();
                        var bit3 = $("#2col_inp" + i).val();
                        bit1 = (bit1 == "") ? "" : bit1;
                        bit2 = (bit2 == "") ? "" : "/" + bit2;
                        bit3 = (bit3 == "") ? "" : "/" + bit3;
                        var cur_res = bit1 + bit2 + bit3;
                        $("div.date:last").find('div.grade:last').after("<div  class='grade' style=\"border: solid black 1px; width: 80px; height: 30px; background-color: #B0E0E6 \">" + cur_res + "</div>");
                    }
                    dialog_colloquium.dialog("close");
                }
            }

            function addExam() {
                if ($("#exam-date").val() == "")
                    alert("Для сохранения необходимо заполнить поле 'Дата'");
                else {
                    var date = $("#exam-date").val();
                    var cnt = $("div.container-list").find("div.fio_student").length;
                    $("div.result_box").find('div.date:last').after("<div class='date' style='border: solid black 1px; width: 80px; float: left; background-color: #F5DEB3'>" + date + "<div class='grade'></div></div>");

                    for (var i = 0; i < cnt; i++) {
                        var bit1 = $("#0exam_inp" + i).val();
                        var bit2 = $("#1exam_inp" + i).val();
                        var bit3 = $("#2exam_inp" + i).val();
                        bit1 = (bit1 == "") ? "" : bit1;
                        bit2 = (bit2 == "") ? "" : "/" + bit2;
                        bit3 = (bit3 == "") ? "" : "/" + bit3;
                        var cur_res = bit1 + bit2 + bit3;
                        $("div.date:last").find('div.grade:last').after("<div  class='grade' style=\"border: solid black 1px; width: 80px; height: 30px; background-color: #F5DEB3 \">" + cur_res + "</div>");
                    }
                    dialog_exam.dialog("close");
                }
            }


            dialog_simple_les = $("#form-simple-les").dialog({
                autoOpen: false,
                height: 850,
                width: 800,
                modal: true,
                buttons: {
                    "Сохранить": addSimpleLesson,
                    Отмена: function () {
                        dialog_simple_les.dialog("close");
                    }
                },
                close: function () {
                    form1[0].reset();
                }
            });
            form1 = dialog_simple_les.find("form").on("submit", function (event) {
                event.preventDefault();
            });

            dialog_colloquium = $("#form-colloquim").dialog({
                autoOpen: false,
                height: 850,
                width: 800,
                modal: true,
                buttons: {
                    "Сохранить": addColloquium,
                    Отмена: function () {
                        dialog_colloquium.dialog("close");
                    }
                },
                close: function () {
                    form2[0].reset();
                }
            });


            form2 = dialog_colloquium.find("form").on("submit", function (event) {
                event.preventDefault();
            });

            dialog_exam = $("#form-exam").dialog({
                autoOpen: false,
                height: 850,
                width: 800,
                modal: true,
                buttons: {
                    "Сохранить": addExam,
                    Отмена: function () {
                        dialog_exam.dialog("close");
                    }
                },
                close: function () {
                    form3[0].reset();
                }
            });
            form3 = dialog_exam.find("form").on("submit", function (event) {
                event.preventDefault();
            });


            $("#create_simple_lesson").button().on("click", function () {
                dialog_simple_les.dialog("open");
            });

            $("#create_colloquium").button().on("click", function () {
                dialog_colloquium.dialog("open");
            });
            $("#create_exam").button().on("click", function () {
                dialog_exam.dialog("open");
            });


//            $('td').dblclick(function () {
//                var val = $(this).html();
//                //формируем код текстового поля
//                //onkeyup="this.value=this.value.replace(/\D/,''); if (this.value<1 || this.value>10) this.value = '';"
//                var code = '<input type="text" class="cell" id="edit" value="' + val + '" style="width: 30px;" />';
//                //удаляем содержимое ячейки, вставляем в нее сформированное поле
//                $(this).empty().append(code);
//                //устанавливаем фокус на свеженарисованное поле
//                $('#edit').focus();
//                $('#edit').blur(function () {	//устанавливаем обработчик
//                    var val = $(this).val();	//получаем то, что в поле находится
//                    //находим ячейку, опустошаем, вставляем значение из поля
//                    $(this).parent().empty().html(val);
//                });
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
            $(".cell1").slideUp();
            $(".cell2").slideUp();
            $(".col_cell1").slideUp();
            $(".col_cell2").slideUp();
            $(".exam_cell1").slideUp();
            $(".exam_cell2").slideUp();
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


            $("#simple_les-date").change(function () {

                if ($("#simple_les-date").val().length == 10) {
                    var arrD = $("#simple_les-date").val().split(".");
                    arrD[1] -= 1;
                    var d = new Date(arrD[2], arrD[1], arrD[0]);
                    if ((d.getFullYear() == arrD[2]) && (d.getMonth() == arrD[1]) && (d.getDate() == arrD[0])) {
                        if ((arrD[2] > 2016) && (arrD[2]) < 2030) {
                            return true;
                        }
                        else {
                            alert("Проверьте правильность введенного значения года!");
                            $("#simple_les-date").val('');
                            return false;
                        }
                    } else {
                        alert("Введена некорректная дата! " + $("#simple_les-date").val());
                        $("#simple_les-date").val('');
                        return false;
                    }
                }
                else {
                    alert("Дата должна быть введена в формате: дд.мм.гггг");
                    return false;
                }

            });

            $("#colloquium-date").change(function () {
                if ($("#colloquium-date").val().length == 10) {
                    var arrD = $("#colloquium-date").val().split(".");
                    arrD[1] -= 1;
                    var d = new Date(arrD[2], arrD[1], arrD[0]);
                    if ((d.getFullYear() == arrD[2]) && (d.getMonth() == arrD[1]) && (d.getDate() == arrD[0])) {
                        if ((arrD[2] > 2016) && (arrD[2]) < 2030) {
                            return true;
                        }
                        else {
                            alert("Проверьте правильность введенного значения года!");
                            $("#colloquium-date").val('');
                            return false;
                        }
                    } else {
                        alert("Введена некорректная дата! " + $("#colloquium-date").val());
                        $("#colloquium-date").val('');
                        return false;
                    }
                }
                else {
                    alert("Дата должна быть введена в формате: дд.мм.гггг");
                    return false;
                }

            });

            $("#exam-date").change(function () {
                if ($("#exam-date").val().length == 10) {
                    var arrD = $("#exam-date").val().split(".");
                    arrD[1] -= 1;
                    var d = new Date(arrD[2], arrD[1], arrD[0]);
                    if ((d.getFullYear() == arrD[2]) && (d.getMonth() == arrD[1]) && (d.getDate() == arrD[0])) {
                        if ((arrD[2] > 2016) && (arrD[2]) < 2030) {
                            return true;
                        }
                        else {
                            alert("Проверьте правильность введенного значения года!");
                            $("#exam-date").val('');
                            return false;
                        }
                    } else {
                        alert("Введена некорректная дата! " + $("#exam-date").val());
                        $("#exam-date").val('');
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


            var countAddCellSL = 1, countAddCellCol = 1, countAddCellExam = 1;
            $("#add_grade_sl").click(function () {
                if (countAddCellSL < 3) {
                    $(".cell" + countAddCellSL).slideDown();
                    ++countAddCellSL;
                }
                else {
                    alert("Допускается не более 3 полей ввода!");
                }
            });

            $("#add_grade_col").click(function () {
                if (countAddCellCol < 3) {
                    $(".col_cell" + countAddCellCol).slideDown();
                    ++countAddCellCol;
                }
                else {
                    alert("Допускается не более 3 полей ввода!");
                }
            });

            $("#add_grade_exam").click(function () {
                if (countAddCellExam < 3) {
                    $(".exam_cell" + countAddCellExam).slideDown();
                    ++countAddCellExam;
                }
                else {
                    alert("Допускается не более 3 полей ввода!");
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

<div id="form-simple-les" title="Тип занятия: Обычное занятие">
    <form>
        <fieldset>
            <div class="left_header">
                <b>Дата занятия</b>
                <input type="text" id="simple_les-date" required class="datepicker" value="<?php echo date('d.m.Y') ?>">

            </div>
            <div class="info">
                <button id="add_grade_sl" class="add_grade" style="color: blue; top: 20px;"
                        title="Для добавления дополнительной оценки нажмите на кнопку!">+
                </button>
                <br>
            </div>
            <br>
            <hr>

            <div class="container" style="width='80%';">
                <div class="box" style="width: 480px">
                    <div class="fio" style="float: left; width: 280px; ">
                        <h4>Фамилия, имя, отчество</h4>
                        <?php
                        $i = 0;
                        foreach ($array as $v) {
                            echo "<div class='fio_student' style=\"width: 280px; border: solid black 1px; height: 30px;\">$v</div>";
                        }
                        ?>
                    </div>

                    <div class="cell" style="float: right; width: 200px">
                        <h4>Отметка</h4>
                        <?php
                        $i = 0;
                        foreach ($array as $v) {
                            echo "<div class='cell_student' style='border: solid black 1px;height: 30px;'>
                            <input class='cell' type=\"text\" id=\"0sl_inp$i\" maxlength=\"2\"onkeyup=\"this.value=this.value.replace(/[^0-9]/,''); if(this.value<1 || this.value>10) this.value='';\" style='width: 50px'>
                            <input class='cell1' type='text' id='1sl_inp$i' maxlength='2' onkeyup=\"this.value=this.value.replace(/[^0-9]/,''); if(this.value<1 || this.value>10) this.value='';\" style='width: 50px;'>
                            <input class='cell2' type='text' id='2sl_inp$i' maxlength='2' onkeyup=\"this.value=this.value.replace(/[^0-9]/,''); if(this.value<1 || this.value>10) this.value='';\" style='width: 50px;'>
                            </div>";

                            $i++;
                        }
                        ?>
                    </div>

                </div>

                <div id="simple_les-toll-result" style="position: fixed; top: 40%; left: 60%;" class="tools">
                    <button id="1" class="grade" style="width: 80px;"><b>Н<sub>у</sub></b></button>
                    <br>
                    <button id="2" class="grade" style="width: 80px;"><b>Н<sub>б/у</sub></b></button>
                    <br>
                    <button id="3" class="grade" style="width: 80px;"><b>Н<sub>б/отр.</sub></b></button>
                    <br>
                    <button id="4" class="grade" style="width: 80px;"><b>Зач.</b></button>
                    <br>
                    <button id="5" class="grade" style="width: 80px;"><b>Незач.</b></button>
                    <br>
                </div>

            </div>
</div>

</fieldset>
</form>
</div>

<div id="form-colloquim" title="Тип занятия: Коллоквиум">
    <form>
        <fieldset>

            <div class="left_header">
                <b>Дата занятия</b>
                <input type="text" id="colloquium-date" required class="datepicker" value="<?php echo date('d.m.Y') ?>"><br>
            </div>

            <div class="info">
                <button id="add_grade_col" class="add_grade" style="color: blue; top: 20px;"
                        title="Для добавления дополнительной оценки нажмите на кнопку!">+
                </button>
                <br>
            </div>
            <br>
            <hr>

            <div class="container" style="width='80%';">
                <div class="box" style="width: 480px">
                    <div class="fio" style="float: left; width: 280px; ">
                        <h4>Фамилия, имя, отчество</h4>
                        <?php
                        $i = 0;
                        foreach ($array as $v) {
                            echo "<div class='fio_student' style=\"width: 280px; border: solid black 1px; height: 30px;\">$v</div>";
                        }
                        ?>
                    </div>

                    <div class="cell" style="float: right; width: 200px">
                        <h4>Отметка</h4>
                        <?php
                        $i = 0;
                        foreach ($array as $v) {
                            echo "<div class='cell_student' style='border: solid black 1px;height: 30px;'>
                            <input class='col_cell' type=\"text\" id=\"0col_inp$i\" maxlength=\"2\"onkeyup=\"this.value=this.value.replace(/[^0-9]/,''); if(this.value<1 || this.value>10) this.value='';\" style='width: 50px'>
                            <input class='col_cell1' type='text' id='1col_inp$i' maxlength='2' onkeyup=\"this.value=this.value.replace(/[^0-9]/,''); if(this.value<1 || this.value>10) this.value='';\" style='width: 50px;'>
                            <input class='col_cell2' type='text' id='2col_inp$i' maxlength='2' onkeyup=\"this.value=this.value.replace(/[^0-9]/,''); if(this.value<1 || this.value>10) this.value='';\" style='width: 50px;'>
                            </div>";

                            $i++;
                        }
                        ?>
                    </div>


                </div>

                <div id="simple_les-toll-result" style="position: fixed; top: 40%; left: 60%;" class="tools">
                    <button id="1" class="grade" style="width: 80px;"><b>Н<sub>у</sub></b></button>
                    <br>
                    <button id="2" class="grade" style="width: 80px;"><b>Н<sub>б/у</sub></b></button>
                    <br>
                    <button id="3" class="grade" style="width: 80px;"><b>Н<sub>б/отр.</sub></b></button>
                    <br>
                </div>

            </div>
</div>

</fieldset>
</form>
</div>

<div id="form-exam" title="Тип занятия: Аттестация">
    <form>
        <fieldset>

            <div class="left_header">
                <b>Дата занятия</b>
                <input type="text" id="exam-date" required class="datepicker" value="<?php echo date('d.m.Y') ?>"><br>
            </div>
            <div class="info">
                <button id="add_grade_exam" class="add_grade"
                        title="Для добавления дополнительной оценки нажмите на кнопку!">+
                </button>
                <br>
            </div>
            <br>
            <hr>

            <div class="container" style="width='80%';">
                <div class="box" style="width: 480px">
                    <div class="fio" style="float: left; width: 280px; ">
                        <h4>Фамилия, имя, отчество</h4>
                        <?php
                        $i = 0;
                        foreach ($array as $v) {
                            echo "<div class='fio_student' style=\"width: 280px; border: solid black 1px; height: 30px;\">$v</div>";
                        }
                        ?>
                    </div>

                    <div class="cell" style="float: right; width: 200px">
                        <h4>Отметка</h4>
                        <?php
                        $i = 0;
                        foreach ($array as $v) {
                            echo "<div class='cell_student' style='border: solid black 1px;height: 30px;'>
                            <input class='exam_cell' type=\"text\" id=\"0exam_inp$i\" maxlength=\"2\"onkeyup=\"this.value=this.value.replace(/[^0-9]/,''); if(this.value<1 || this.value>10) this.value='';\" style='width: 50px'>
                            <input class='exam_cell1' type='text' id='1exam_inp$i' maxlength='2' onkeyup=\"this.value=this.value.replace(/[^0-9]/,''); if(this.value<1 || this.value>10) this.value='';\" style='width: 50px;'>
                            <input class='exam_cell2' type='text' id='2exam_inp$i' maxlength='2' onkeyup=\"this.value=this.value.replace(/[^0-9]/,''); if(this.value<1 || this.value>10) this.value='';\" style='width: 50px;'>
                            </div>";

                            $i++;
                        }
                        ?>
                    </div>


                </div>

                <div id="simple_les-toll-result" style="position: fixed; top: 40%; left: 60%;" class="tools">
                    <button id="1" class="grade" style="width: 80px;"><b>Н<sub>у</sub></b></button>
                    <br>
                    <button id="2" class="grade" style="width: 80px;"><b>Н<sub>б/у</sub></b></button>
                    <br>
                    <button id="3" class="grade" style="width: 80px;"><b>Н<sub>б/отр.</sub></b></button>
                    <br>
                    <button id="4" class="grade" style="width: 80px;"><b>Зач.</b></button>
                    <br>
                    <button id="5" class="grade" style="width: 80px;"><b>Незач.</b></button>
                    <br>
                    <button id="6" class="grade" style="width: 80px;"><b style="color: #8c0000">Недоп.</b></button>
                    <br>
                </div>

            </div>
</div>


</fieldset>
</form>
</div>

<div class="container-list">
    <div class="box" style="width: 95%; display: inline-block" align="center">
        <div class="fio" style="float: left; width: 20%;">
            <div class="title" style="border: solid black 1px; height: 20px;">
                <b>Фамилия, имя, отчество</b>
            </div>
            <?php
            $i = 0;
            foreach ($array as $v) {
                echo "<div class='fio_student' style=\"border: solid black 1px; height: 30px;\">$v</div>";
            }
            ?>
        </div>

        <div class="result_box" style="float: right; width: 80%;">
            <?php
            foreach ($dates as $date) {
                echo "<div class='date' style=\"border: solid black 1px; width: 80px; float: left; \">$date";
                for ($i = 0; $i < count($array); $i++) {
                    echo "<div class='grade' style=\"border: solid black 1px; width: 80px; height: 30px; \">6";

                    echo "</div>";

                }

                echo "</div>";
            }
            ?>

        </div>
    </div>

    <div class="tools" align="center">
        <button id="create_simple_lesson">Обычное занятие</button>
        <button id="create_colloquium">Коллоквиум</button>
        <button id="create_exam">Аттестация</button>
    </div>
</div>

</body>
</html>