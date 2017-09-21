<<<<<<< HEAD
﻿/*function proverka(event, id) {
=======
﻿function proverka(event, id) {
>>>>>>> 5af9f40fcd3ebfcc4060e2e29a10a78d3bd3f477
    $(function () {
        el=$("#inp_"+id).val();
        if((el>10) ||(el<1)){
            $("#inp_"+id).val("");
        }
    });


    if((event.keyCode==8) || (event.keyCode==46) ) {
        return;
    }
<<<<<<< HEAD

    else if((event.key<48) || (event.keyCode>57) && ((event.key<96) || (event.keyCode>105)) {
            return false;
        }
}*/
function proverka(event, id) {
    if((event.keyCode==8) || (event.keyCode==46) ) {
        return;
    }

    if (!isNaN(parseInt(event.key))) return;
    return false
}


window.addEventListener('keyDown', function(e){
    if (!isNaN(parseInt(e.key))){
        console.log(e);
    }
}, false);



document.addEventListener('keydown', function(e){
    var val = parseInt(e.key);
    val = (!isNaN(val)) ? val : false;
    if (val !== false)
        if ((e.altKey)){
            alert('Hello chukcha!'+val);
        }
}, false);



=======
    else if((event.keyCode<48) || (event.keyCode>57)) {
            return false;
        }
}


>>>>>>> 5af9f40fcd3ebfcc4060e2e29a10a78d3bd3f477
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
    $("div.grade").each(function () {
        if($(this).text()!=""){
            $(this).text(Decrypt($(this).text()));
        }
    });
});

$(function () {
    $("div.average").each(function () {
        var sum=0,countGrade=0;
        var elem=$(this).attr('data-idStudent');
        $('div.grade[data-idStudent="'+elem+'"]').each(function () {
            var gr=$(this).text().split("/");
            for (var i=0; i<gr.length; i++){
                if(Number(gr[i])){
                    sum+=Number(gr[i]);
                    countGrade++;
                }
            }

        });
        $('div.average[data-idStudent="'+elem+'"]').html(Math.round(10*(sum/countGrade))/10);
    });
    $("div.answer").each(function () {
        var countAnswer=0;
        var elem=$(this).attr('data-idStudent');
        $('div.grade[data-idStudent="'+elem+'"]').each(function () {
            var gr=$(this).text().split("/");
            if(Number(gr[0])){
                countAnswer++
            }

        });
        $('div.answer[data-idStudent="'+elem+'"]').html(Math.round(100*(countAnswer*100/$('div.grade[data-idStudent="'+elem+'"]').length))/100+"%");
    });
});

// $(function () {
//     $("div.grade").each(function () {
//         var gr=$(this).text().split("/");
//         for(var i=0; i<gr.length; i++){
//             if(gr[i] < 4){
//                 $(this).addClass("fail");
//             }
//         }
//
//     });
// });

$(function () {
    $('b.tool').mousedown(function(event){
        event.stopPropagation();
        event.preventDefault();
        return false;
    });
});

$(function () {
    $('div .grade').mousedown(function(event){
        event.stopPropagation();
        event.preventDefault();
        return false;
    });

    var dialog, form, edit_dialog, edit_form;
    var myStudentId = new Array();
    var myStudentZapis = new Array();

    function addLesson() {
        if ($("#lesson-date").val() == "")
            alert("Для сохранения необходимо заполнить поле 'Дата'");
        else {
            var dateLesson = $("#lesson-date").val();
            var cnt = $("div.container-list").find("div.fio_student").length;
            $('div.fio_student').each(function (index, element) {
                myStudentId[index]=$(element).attr('data-idStudent');
            });
            if ($("#colloquium_rb").is(':checked')) {
                $.ajax({
                    type:'get',//тип запроса: get,post либо head
                    url:'p.php',//url адрес файла обработчика
                    data:{
                        'dateLesson':dateLesson,
                        'PKE':"1",
                        'idGroup': $("input#idGroup").val(),
                        'idLessons': $("input#idSubject").val(),
                        'PL':"0",
                        'menuactiv': "addLesson"
                        // 'idLesson': $("input#idLesson").val()
                    },
                    success:function (st) {
                        if ((st!="No")&&(st!="Access is denied!")&&(st!="No access rights!")){
                            $("<div class='date_col colloquium_theme'><div class='date_title'>" + dateLesson + "</div></div>").insertAfter('div.date_col:last');
                            for (var i = 0; i < cnt; i++) {
                                $("div.date_col:last").append("<div class='grade' data-idLes="+st+" data-idStudent="+myStudentId[i]+" data-PKE=1 data-zapis=0></div>");
                                myStudentZapis[st+'Zapis'+myStudentId[i]]=0;
                            }
                        }
                        else{
                            if(st=="No"){
                                alert("Колонка с указанной датой уже была создана! Редактируйте существующую или создайте с новой датой!");
                            }
                            else if (st=="Access is denied!"){
                                alert("Доступ запрещен!");
                            }
                            else if (st=="No access rights!"){
                                alert("Не достаточно прав!");
                            }
                            else{
                                alert("Что-то пошло не так! ");
                            }

                        }

                    },
                    error: function () {
                        alert("Произошла ошибка при передаче данных");
                    }
                });
            }
            else if ($("#exam_rb").is(':checked')) {
                $.ajax({
                    type:'get',
                    url:'p.php',
                    data:{
                        'dateLesson':dateLesson,
                        'PKE':"2",
                        'idGroup': $("input#idGroup").val(),
                        'idLessons': $("input#idSubject").val(),
                        'PL':"0",
                        'menuactiv': "addLesson"
                    },
                    success:function (st) {
                        if ((st!="No")&&(st!="Access is denied!")&&(st!="No access rights!")){
                            $("<div class='date_col exam_theme'><div class='date_title'>" + dateLesson + "</div></div>").insertAfter('div.date_col:last');
                            for (var i = 0; i < cnt; i++) {
                                $("div.date_col:last").append("<div class='grade' data-idLes="+st+" data-idStudent="+myStudentId[i]+" data-PKE=2 data-zapis=0></div>");
                                myStudentZapis[st+'Zapis'+myStudentId[i]]=0;
                            }
                        }
                        else{
                            if(st=="No"){
                                alert("Колонка с указанной датой уже была создана! Редактируйте существующую или создайте с новой датой!");
                            }
                            else if (st=="Access is denied!"){
                                alert("Доступ запрещен!");
                            }
                            else if (st=="No access rights!"){
                                alert("Не достаточно прав!");
                            }
                            else{
                                alert("Что-то пошло не так! ");
                            }

                        }


                    },
                    error: function () {
                        alert("Произошла ошибка при передаче данных");
                    }
                });

            }
            else {

                $.ajax({
                    type:'get',
                    url:'p.php',
                    data:{
                        'dateLesson':dateLesson,
                        'PKE':"0",
                        'idGroup': $("input#idGroup").val(),
                        'idLessons': $("input#idSubject").val(),
                        'PL':"0",
                        'menuactiv': "addLesson"
                    },
                    success:function (st) {
                        if ((st!="No")&&(st!="Access is denied!")&&(st!="No access rights!")){
                            $("<div class='date_col'><div class='date_title'>" + dateLesson + "</div></div>").insertAfter('div.date_col:last');
                            for (var i = 0; i < cnt; i++) {
                                $("div.date_col:last").append("<div class='grade' data-idLes="+st+" data-idStudent="+myStudentId[i]+" data-PKE=0 data-zapis=0></div>");
                                myStudentZapis[st+'Zapis'+myStudentId[i]]=0;
                            }
                        }
                        else{
                            if(st=="No"){
                                alert("Колонка с указанной датой уже была создана! Редактируйте существующую или создайте с новой датой!");
                            }
                            else if (st=="Access is denied!"){
                                alert("Доступ запрещен!");
                            }
                            else if (st=="No access rights!"){
                                alert("Не достаточно прав!");
                            }
                            else{
                                alert("Что-то пошло не так! ");
                            }

                        }
                    },
                    error: function () {
                        alert("Произошла ошибка при передаче данных");
                    }
                });
            }
            dialog.dialog("close");
        }
    }

    $("button#close").click(function () {

    });
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

    $("#close").click(function () {
        edit_dialog.dialog("close");
    });

    $('div').delegate(".grade", "mouseover", function () {
        data_st=$(this).attr('data-idStudent');
        $('div [data-idStudent="'+data_st+'"]').addClass("illumination");
    });

    $('div').delegate(".grade", "mouseout", function () {
        data_st=$(this).attr('data-idStudent');
        $('div [data-idStudent="'+data_st+'"]').removeClass("illumination");
    });

    $('div').delegate(".grade", "dblclick", function () {
        dat=$(this).parent().find('div.date_title').html();//Дата столбца
        student_id=$(this).attr('data-idStudent');
        id_Less=$(this).attr('data-idLes');
        PKE=$(this).attr('data-PKE');
        id_Zapis=$(this).attr('data-zapis');

        edit_dialog.dialog("open");
        edit_form[0].reset();
        $("button#add_grade_input").removeAttr('disabled');
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
                $("#" + inp_id).val("Нб.о.");
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
            if (event.keyCode == 8 || event.keyCode == 46) {   //если это удаление
                if (!absenteeisms.test(this.value)) {
                    $(this).val("")
                }
            }
        });


    });
    $("#edit").click(function () {
        var coding = "";
        var bit1 = $("#inp_0").val();
        var bit2 = $("#inp_1").val();
        var bit3 = $("#inp_2").val();
        bit1 = (bit1 == "") ? "" : bit1;
        bit2 = (bit2 == "") ? "" : "/" + bit2;
        bit3 = (bit3 == "") ? "" : "/" + bit3;
        var cur_res = bit1 + bit2 + bit3;
        coding = Encrypt(cur_res);
        elem.text(cur_res);
        if((cur_grade=="") && (cur_res!="")){
            $.ajax({
                type:'get',
                url:'p.php',//url адрес файла обработчика
                data:{
                    'dateLes': dat,
                    'idLessons': $("input#idSubject").val(),
                    'idStudent': student_id,
                    'PL': $("input#idPL").val(),
                    'PKE': PKE,
                    'idPrepod': $("input#idPrepod").val(),
                    'idLess': id_Less,
                    'menuactiv': "addLessonStudent",
                    'grades': coding
                },
                success:function (st) {
                    if ((st!="Access is denied!")&&(st!="No access rights!")){
                        myStudentZapis[id_Less+'Zapis'+student_id]=st;
                    }else{
                        if (st=="Access is denied!"){
                            alert("��_�_�'�_п зап�_���%���_!");
                        }
                        else if (st=="No access rights!"){
                            alert("�_�� �_�_�_�'а�'�_�+�_�_ п�_а�_!");
                        }
                        else{
                            alert("Ч�'�_-�'�_ п�_�_�>�_ �_�� �'ак! ");
                        }

                    }
                },
                error: function () {
                    alert("Произошла ошибка при передаче данных");
                }
            });
        }
        else{
            if(id_Zapis == 0 && myStudentZapis[id_Less+'Zapis'+student_id]==0){
                alert("�_�_�_из�_�_�>а �_�_и�+ка п�_и п���_���_а�+�� �_а�_�_�<�:");
            }else{
                if(id_Zapis == 0) id_Zapis = myStudentZapis[id_Less+'Zapis'+student_id];
                $.ajax({
                    type:'get',
                    url:'p.php',
                    data:{
                        'id_Zapis': id_Zapis,
                        'dateLes': dat,
                        'idStudent': student_id,
                        'idPrepod': $("input#idPrepod").val(),
                        'menuactiv': "editLessonStudent",
                        'grades': coding
                    },
                    success:function (st) {
                        if (st=="Access is denied!"){
                            alert("Доступ запрещен!");
                        }
                        else if (st=="No access rights!"){
                            alert("Не достаточно прав!");
                        }
                    },
                    error: function () {
                        alert("Произошла ошибка при передаче данных");
                    }
                });
            }
        }

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
    PopUpHide();


    //Дорисовка триугольника
    // $("div.grade").each(function () {
    //     if($(this).text()!=""){
    //         $(this).append('<div class="triangle-topright"></div>');
    //     }
    // });

    $('div').delegate(".triangle-topright", "mouseleave", function () {
      PopUpHide();
    });

    $('div').delegate(".triangle-topright", "mouseover", function (e) {

        var id_Zap=$(this).closest("div .grade").attr('data-zapis');
        $("#window-popup").css("left",Number(e.pageX+15));
        $("#window-popup").css("top",Number(e.pageY+10));
        PopUpShow();

        $.ajax({
            type:'get',
            url:'p.php',
            data:{
                'id_Zapis':id_Zap,
                'idGroup': $("input#idGroup").val()
            },
            success:function (info) {
                $(".loader").hide();
                $(".popup-content").text(info);
            },
            error: function () {
                $(".popup-content").text("Данные отсутствуют!");
            }
        });

    });


    countCell = 1;
    groupNumber="";
    subject="";
    teacher="";
    dateLesson=$("div.date_title:last").val();
    idLesson="";

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
    // alert(res);
    return res;
}
function MatchEncrypt(val) {

    if (val>=1 && val<=10){
        return Number(val)+9;
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
        return Number(val)-9;
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

//Функция отображения PopUp
function PopUpShow(){
    $("#window-popup").show();
}
//Функция скрытия PopUp
function PopUpHide(){
    $("#window-popup").hide();
}

