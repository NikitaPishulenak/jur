<!doctype html>
<html lang="en">
<head>
    <meta charset="windows-1251">
    <!--    <meta charset="utf-8">-->
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

        id_students=new Array();


        for(y=0;y<100;y++){
            id_students[y]=Math.floor(Math.random() * 1000) + 1;
            //console.log(id_students[y]);
        }

        $(function () {
            var dialog, form, edit_dialog, edit_form;


            function addLecture() {
                if ($("#lesson-date").val() == "")
                    alert("Для сохранения необходимо заполнить поле 'Дата'");
                else {
                    var dateLesson = $("#lesson-date").val();
                    var cnt = $("div.container-list").find("div.fio_student").length;

                        $.ajax({
                            type: 'POST',
                            url: '',
                            data: {dateLesson: dateLesson, groupNumber: groupNumber, subjectName: subject, typeLesson: "1 n", idLesson: idLesson},
                            success: function(status){
                                if(status=="false"){
                                    alert("Возможно, колонка с указанной датой уже была создана! Редактируйте существующую или создайте с новой датой!");
                                }
                                else{
                                    $("<div class='date_col'><div class='date_title'>" + dateLesson + "</div></div>").insertAfter('div.date_col:last');

                                    for (var i = 0; i < cnt; i++) {
                                        $("div.date_col:last").append("<div class='grade' data-id="+id_students[i]+"></div>");
                                    }
                                }

                            }
                        });

                    dialog.dialog("close");
                }
            }


            dialog = $("#form-lesson").dialog({
                resizable:false,
                autoOpen: false,
                height: 'auto',
                width: 'auto',
                modal: true,
                buttons: {
                    "Создать": addLecture,
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
                resizable:false,
                autoOpen: false,
                height: 'auto',
                width: 'auto',
                modal: true
            });
            edit_form = edit_dialog.find("form").on("submit", function (event) {
                event.preventDefault();
            });


            $('div').delegate(".grade", "dblclick", function () {
                dat=$(this).parent().find('div.date_title').html();//Дата столбца
                //console.log(dat);
                student_id=$(this).attr('data-id');
//                $("#ddd").html(dat);
                edit_dialog.dialog("open");
                edit_form[0].reset();
                $("button#add_grade_input").removeAttr('disabled');
                //dateLes=$("b#dateLesson").val();

                $("#inp_0").focus();
//                $('#inp_2').slideUp();
//                --countCell;
//                $('#inp_1').slideUp();
//                --countCell;

                cur_grade = $(this).text();
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
                    $("b#1").click(function(){
                        $("#" + inp_id).val("Ну");
                    });
                    $("b#2").click(function(){
                        $("#" + inp_id).val("Нб_у");
                    });
                    $("b#3").click(function(){
                        $("#" + inp_id).val("Нб_отр.");
                    });

                });

                //var countOpenCell = 0;
//                for (j = 0; j < 3; j++) {
//                    if ($("#inp_" + j).val() != "") {
//                        countOpenCell++;
//                    }
//                }
//                if (countOpenCell == 3) {
//                    $("button#add_grade_input").attr('disabled', true);
//                }

                var absenteeisms = /\w/;
                $(".inp_cell:text").keydown(function (event) {
                    if (event.keyCode == 8 || event.keyCode == 46) {	//если это удаление
                        if (!absenteeisms.test(this.value)) {
                            $(this).val("")
                        }
                    }
                });

            });

            $("#edit").click(function () {
                var coding = "";
                //alert(student_id);
//                var bit1 = $("#inp_0").val();
//                var bit2 = $("#inp_1").val();
//                var bit3 = $("#inp_2").val();
//                bit1 = (bit1 == "") ? "" : bit1;
//                bit2 = (bit2 == "") ? "" : "/" + bit2;
//                bit3 = (bit3 == "") ? "" : "/" + bit3;
                var cur_res = $("#inp_0").val();
                //alert(cur_res);
                coding = Encrypt(cur_res);
                elem.text(cur_res);
                //alert(coding);
                //alert("cur_grade "+cur_grade+" cur_res "+cur_res);
                if((cur_grade=="") && (cur_res!="")){
                    $.ajax({
                        type: 'POST',
                        url: '',
                        data: {grades: coding, typeProcedure: "ADD", dateLesson: dat, studentId: student_id}
                    });
                }
                else{
                    $.ajax({
                        type: 'POST',
                        url: '',
                        data: {grades: coding, typeProcedure: "UPDATE", dateLesson: dat, studentId: student_id}
                    });

                }
                console.log(coding);
                console.log(dat);
                console.log(student_id);
                edit_dialog.dialog("close");
            });

            $(".inp_cell:text").click(function () {
                $(this).select();
            });


            $("#create_lesson").button().on("click", function () {
                dialog.dialog("open");
            });


//            $("#add_grade_input").click(function () {
//
//                if (countCell < 3) {
//                    if (countCell <= 0)
//                        countCell = 1;
//
//
//                    if ($("#inp_" + (countCell - 1)).val() != "") {
//                        $("#inp_" + countCell).slideDown();
//                        $("#inp_" + countCell).focus();
//                        ++countCell;
//                    }
//                    else {
//                        alert("Заполните, пожалуйста, доступное поле ввода оценки!");
//                    }
//
//                }
//                else {
//                    alert("Допускается не более 3 полей ввода!");
//                    $("button#add_grade_input").attr('disabled', true);
//
//                }
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
            countCell = 1;
            groupNumber="7777";
            subject="Хирургия";
            teacher="Ибрагимов Леон Измайлович";
            dateLesson=$("div.date_title:last").val();
            idLesson="4";
            //alert(groupNumber+"+"+subject+"+"+teacher+"+"+dateLast+"+"+idLesson);
            $("b#group").html(groupNumber);
            $("b#subject").html(subject);
            $("h3#teacher").html(teacher);
            $("#idLesson").html(idLesson);
            $("b#dateLesson").html(dateLesson);

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
                    return '10';
                    break;
                case '2':
                    return '11';
                    break;
                case '3':
                    return '12';
                    break;
                case '4':
                    return '13';
                    break;
                case '5':
                    return '14';
                    break;
                case '6':
                    return '15';
                    break;
                case '7':
                    return '16';
                    break;
                case '8':
                    return '17';
                    break;
                case '9':
                    return '18';
                    break;
                case '10':
                    return '19';
                    break;
                case 'Ну':
                    return '20';
                    break;
                case 'Нб_у':
                    return '21';
                    break;
                case 'Нб_отр.':
                    return '22';
                    break;
                case 'Зач.':
                    return '23';
                    break;
                case 'Незач.':
                    return '24';
                    break;
                case 'Недопуск':
                    return '25';
                    break;
            }

        }

        function MatchDecrypt(val) {
            switch (val) {
                case '10':
                    return '1';
                    break;
                case '11':
                    return '2';
                    break;
                case '12':
                    return '3';
                    break;
                case '13':
                    return '4';
                    break;
                case '14':
                    return '5';
                    break;
                case '15':
                    return '6';
                    break;
                case '16':
                    return '7';
                    break;
                case '17':
                    return '8';
                    break;
                case '18':
                    return '9';
                    break;
                case '19':
                    return '10';
                    break;
                case '20':
                    return 'Ну';
                    break;
                case '21':
                    return 'Нб_у';
                    break;
                case '22':
                    return 'Нб_отр.';
                    break;
                case '23':
                    return 'Зач.';
                    break;
                case '24':
                    return 'Незач.';
                    break;
                case '25':
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
$array = array("Абрамов Александр Иванович", "Бабушкин Степан Леонидович", "Волкова Алевтина Никитишна", "Гриб Салтан Лаикович", "Евдакимова Янна Викторовна", "Климанович Ян Янович", "Лис Павел Владимирович", "Попов Алексей Георгиевич", "Рудяк Марк Николаевич", "Шеко Артем Викторович", "Шершень Степан Яковлевич", "Шут Павел Владимирович", "Якубович Александр Дмитриевич", "Ясько Елена Максимовна", "Абрамов Александр Иванович", "Бабушкин Степан Леонидович", "Волкова Алевтина Никитишна", "Гриб Салтан Лаикович", "Евдакимова Янна Викторовна", "Климанович Ян Янович", "Лис Павел Владимирович", "Попов Алексей Георгиевич", "Абрамов Александр Иванович", "Бабушкин Степан Леонидович", "Волкова Алевтина Никитишна", "Гриб Салтан Лаикович", "Евдакимова Янна Викторовна", "Климанович Ян Янович", "Лис Павел Владимирович", "Попов Алексей Георгиевич");
$dates = array("01.09.2017");
?>

<div id="form-lesson" title="Создание занятия">
    <form>
        <fieldset>
            <div class="box">
                <b align="center">Дата занятия</b>
                <div id="date_col">
                    <input type="text" id="lesson-date" required class="datepicker" value="<?php echo date('d.m.Y') ?>">
                </div>

            </div>
        </fieldset>
    </form>
</div>

<div id="form-edit" title="Выставление пропусков">
    <form id="form-edit">
        <fieldset>
            <div class="panel">
                <!--                <b id="ddd">ddd</b>-->
<!--                <button id="add_grade_input" class="add_grade"-->
<!--                        title="Для добавления дополнительной оценки нажмите на кнопку!">+-->
<!--                </button>-->

                <b id="1" class="tool"><b>Н<sub>у</sub></b></b>
                <span class="space"></span>
                <b id="2" class="tool"><b>Н<sub>б_у</sub></b></b>
                <span class="space"></span>
                <b id="3" class="tool"><b>Н<sub>б_отр.</sub></b></b>

                <br><br>

                <input class='inp_cell' id="inp_0" type=text maxlength='0'
                       onkeyup="this.value=this.value.replace(/[^*]/,'');">
<!--                <input class='inp_cell' id="inp_1" type='text' maxlength='2'-->
<!--                       onkeyup="this.value=this.value.replace(/[^0-9]/,''); if (this.value<1 || this.value>10) this.value='';">-->
<!--                <input class='inp_cell' id="inp_2" type='text' maxlength='2'-->
<!--                       onkeyup="this.value=this.value.replace(/[^0-9]/,''); if (this.value<1 || this.value>10) this.value='';">-->

                <hr>
                <button id="edit" class="button"><b>Ок</b></button>
            </div>
        </fieldset>
    </form>
</div>


<div class="container-list">
    <div class="userData">
        <h3 id="teacher"></h3>
        <p>Дисциплина: <b id="subject"></b></p>
        <p>Группа№: <b id="group"></b></p>
        <p><b id="idLesson"></b></p>

    </div>


    <div class="tools" align="center">
        <button id="create_lesson">Создать лекцию</button>
    </div>
    <br>
    <hr>
    <br>
    <div class="box">
        <div class="fio">
            <div class="title">
                ФИО
            </div>

            <script>
                dates = ["01.09.2017","05.09.2017","15.09.2017"];
                //dates = new Array();
                arrayFIO = ["Абрамов Александр Иванович", "Бабушкин Степан Леонидович", "Волкова Алевтина Никитишна", "Гриб Салтан Лаикович", "Евдакимова Янна Викторовна", "Климанович Ян Янович", "Лис Павел Владимирович", "Попов Алексей Георгиевич", "Рудяк Марк Николаевич", "Шеко Артем Викторович", "Шершень Степан Яковлевич", "Шут Павел Владимирович", "Якубович Александр Дмитриевич", "Ясько Елена Максимовна", "Абрамов Александр Иванович", "Бабушкин Степан Леонидович", "Волкова Алевтина Никитишна", "Гриб Салтан Лаикович", "Евдакимова Янна Викторовна", "Климанович Ян Янович", "Лис Павел Владимирович", "Попов Алексей Георгиевич", "Абрамов Александр Иванович", "Бабушкин Степан Леонидович", "Волкова Алевтина Никитишна", "Гриб Салтан Лаикович", "Евдакимова Янна Викторовна", "Климанович Ян Янович", "Лис Павел Владимирович", "Попов Алексей Георгиевич"];

                for(var i=0;i<arrayFIO.length;i++){
                    $(".fio").append("<div class=\"fio_student\" data-id="+id_students[i]+">"+arrayFIO[i]+"</div>");
                }
                $("div .fio").after("<div class='date_col hidden'>Первый столбец</div>");

            </script>
        </div>

        <div class="result_box">

            <script>

                for(var i=0;i<dates.length;i++){
                    $("div .date_col:last").after("<div class='date_col'><div class='date_title'>"+dates[i]+"</div>");
                    for(var j=0;j<arrayFIO.length;j++){
                        $("div .date_col:last").append("<div class='grade' data-id="+id_students[j]+" ></div>");
                    }
                    $("div.date_col:last").append("</div>");
                }

            </script>

        </div>

    </div>


</div>

</body>
</html>