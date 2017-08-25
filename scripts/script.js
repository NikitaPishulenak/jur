$(function () {
    $.datepicker.regional['ru'] = {
        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель',
            'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь',
            'Октябрь', 'Ноябрь', 'Декабрь'],
        dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб']
    };
    $('.datepicker').datepicker({dateFormat: 'dd.mm.yy', firstDay: 1});
    $.datepicker.setDefaults($.datepicker.regional['ru']);
    $('.datepicker').mask("99.99.9999");
});

$(function () {
    var dialog, form, edit_dialog, edit_form;
    function addLesson() {
        if ($("#lesson-date").val() == "")
            alert("Для сохранения необходимо заполнить поле 'Дата'");
        else {
            var dateLesson = $("#lesson-date").val();
            var cnt = $("div.container-list").find("div.fio_student").length;
            if ($("#colloquium_rb").is(':checked')) {
                $.ajax({
                    type: 'POST',
                    url: '',
                    data: {dateLesson: dateLesson, typePractice:"1", groupNumber: groupNumber, subjectName: subject, typeLesson: "0", idLesson: idLesson},
                    success: function(status){
                        if(status=="false"){
                            alert("Возможно, колонка с указанной датой уже была создана! Редактируйте существующую или создайте с новой датой!");
                        }
                        else{
                            $("<div class='date_col colloquium_theme'><div class='date_title'>" + dateLesson + "</div></div>").insertAfter('div.date_col:last');
                            for (var i = 0; i < cnt; i++) {
                                $("div.date_col:last").append("<div class='grade' data-hover="+(i+1)+"></div>");
                            }
                        }
                    }
                });
            }
            else if ($("#exam_rb").is(':checked')) {
                $.ajax({
                    type: 'POST',
                    url: '',
                    data: {dateLesson: dateLesson, typePractice:"2", groupNumber: groupNumber, subjectName: subject, typeLesson: "0", idLesson: idLesson},
                    success: function(status){
                        if(status=="false"){
                            alert("Возможно, колонка с указанной датой уже была создана! Редактируйте существующую или создайте с новой датой!");
                        }
                        else{
                            $("<div class='date_col exam_theme'><div class='date_title'>" + dateLesson + "</div></div>").insertAfter('div.date_col:last');
                            for (var i = 0; i < cnt; i++) {
                                $("div.date_col:last").append("<div class='grade' data-hover="+(i+1)+"></div>");
                            }
                        }
                    }
                });
            }
            else {
                $.ajax({
                    type: 'POST',
                    url: '',
                    data: {dateLesson: dateLesson, typePractice:"0",groupNumber: groupNumber, subjectName: subject, typeLesson:"0", idLesson: idLesson},
                    success: function(status){
                        if(status=="false"){
                            alert("Возможно, колонка с указанной датой уже была создана! Редактируйте существующую или создайте с новой датой!");
                        }
                        else{
                            $("<div class='date_col'><div class='date_title'>" + dateLesson + "</div></div>").insertAfter('div.date_col:last');
                            for (var i = 0; i < cnt; i++) {
                                $("div.date_col:last").append("<div class='grade' data-hover="+(i+1)+"></div>");
                            }
                        }
                    }
                });
            }
            // console.log(dateLesson);
            dialog.dialog("close");
        }
    }
    dialog = $("#form-lesson").dialog({
        resizable:false,
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
        resizable:false,
        autoOpen: false,
        height: 'auto',
        width: 'auto',
        modal: true
    });
    edit_form = edit_dialog.find("form").on("submit", function (event) {
        event.preventDefault();
    });

    $('div').delegate(".grade", "mouseover", function () {
        data_hover=$(this).attr('data-hover');
        //$(this).css('background', 'greenyellow');
        $('div [data-hover="'+data_hover+'"]').css('background', 'greenyellow');
    });
    $('div').delegate(".grade", "mouseout", function () {
        data_hover=$(this).attr('data-hover');
        //$(this).css('background', 'white');
        $('div [data-hover="'+data_hover+'"]').css('background', 'inherit');
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
        $('#inp_2').slideUp(1);
        --countCell;
        $('#inp_1').slideUp(1);
        --countCell;
        cur_grade = $(this).text();
        elem = $(this);
        grades = cur_grade.split("/");
        for (var i = 0; i < grades.length; i++) {
            $("div.panel").find('input#inp_' + i).slideDown(1);
            $("div.panel").find('input#inp_' + i).val(grades[i]);
        }
        $('input#inp_0').focus();
        $('input#inp_0').select();
        $(".inp_cell:text").focus(function () {
            inp_id = $(this).attr('id');

            $("b#1").click(function(){
                $("#" + inp_id).val("Ну");
            });
            $("b#2").click(function(){
                $("#" + inp_id).val("Нб.у");
            });
            $("b#3").click(function(){
                $("#" + inp_id).val("Нб.отр.");
            });
            $("b#4").click(function(){
                $("#" + inp_id).val("Зач.");
            });
            $("b#5").click(function(){
                $("#" + inp_id).val("Незач.");
            });
            $("b#6").click(function(){
                $("#" + inp_id).val("Недоп");
            });
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
    });
    $("#edit").click(function () {
        var coding = "";
        //alert(student_id);
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
    $("#add_grade_input").click(function () {
        if (countCell < 3) {
            if (countCell <= 0)
                countCell = 1;
            if ($("#inp_" + (countCell - 1)).val() != "") {
                $("#inp_" + countCell).slideDown(1);
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

$(document).ready(function () {
    countCell = 1;
    groupNumber="";
    subject="";
    teacher="";
    dateLesson=$("div.date_title:last").val();
    idLesson="";
    //alert(groupNumber+"+"+subject+"+"+teacher+"+"+dateLast+"+"+idLesson);
//            $("b#group").html(groupNumber);
//            $("b#subject").html(subject);
//            $("h3#teacher").html(teacher);
//            $("#idLesson").html(idLesson);
//            $("b#dateLesson").html(dateLesson);
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

    if (val>=1 && val<=10){
        return val+9;
    }
    else{
        switch (val) {
            case 'Ну':
                return '20';
                break;
            case 'Нб.у':
                return '21';
                break;
            case 'Нб.о.':
                return '22';
                break;
            case 'Зач.':
                return '23';
                break;
            case 'Незач.':
                return '24';
                break;
            case 'Недоп':
                return '25';
                break;
        }
    }

}
function MatchDecrypt(val) {
    if(val>=10 && val<20){
        return val-9;
    }
    else{
        switch (val) {
            case '20':
                return 'Ну';
                break;
            case '21':
                return 'Нб.у';
                break;
            case '22':
                return 'Нб.о.';
                break;
            case '23':
                return 'Зач.';
                break;
            case '24':
                return 'Незач.';
                break;
            case '25':
                return 'Недоп';
                break;
        }
    }

}

//        var s="262524232221201113182527"; //пробую расшифровать
//        alert(Decrypt(s));