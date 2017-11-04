﻿$(function () {
    $("input.inp_cell").focus(function () {
        id_input=$(this).attr('id');
    });
});

document.addEventListener('keydown', function(e){

    var val = parseInt(e.key);
    val = (!isNaN(val)) ? val : false;
    if (val !== false){
        if (e.altKey){
            $("#"+id_input).val($("#panel>#"+val).text());
            $("#"+id_input).blur();
        }
    }

    if(e.keyCode==13){
        if($("#edit").prop("disabled"))
        {
            return false;
        }
        else{
            $("#edit").click();
        }
    }


}, false);

$(function () {
    $('b.tool, span.tool').mousedown(function(event){
        event.stopPropagation();
        event.preventDefault();
        return false;
    });
});

//Функция дешифрирования оценок
$(function () {
    $("div.grade").each(function () {
        if($(this).text()!=""){
            $(this).text(Decrypt($(this).text()));
        }

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
        checkDate();
        if ($("#lesson-date").val() == ""){
            //alert("Для сохранения необходимо заполнить поле 'Дата'");
        }
        else {
            var dateLesson = $("#lesson-date").val();
            var cnt = $("div.container-list").find("div.fio_student").length;
            $('div.fio_student').each(function (index, element) { myStudentId[index]=$(element).attr('data-idStudent'); });
            $.ajax({
                type:'get',
                url:'p.php',
                data:{
                    'dateLesson':dateLesson,
                    'idGroup': $("input#idGroup").val(),
                    'idLessons': $("input#idSubject").val(),
                    'PL':"1",
                    'menuactiv': "addLesson",
                    'PKE': '0'
                },//параметры запроса
                success:function (st) {
                    if ((st!="No")&&(st!="Access is denied!")&&(st!="No access rights!")){
                        $("<div class='date_col'><div class='date_title'>" + dateLesson + "</div></div>").insertAfter('div.date_col:last');
                        for (var i = 0; i < cnt; i++) {
                            $("div.date_col:last").append("<div class='grade' data-idLes="+st+" data-idStudent="+myStudentId[i]+" data-zapis=0></div>");
                            myStudentZapis[st+'Zapis'+myStudentId[i]]=0;
                        }
                    }
                    else{
                        if(st=="No"){
                            alert("Колонка с указанной датой уже была создана! Редактируйте существующую или создайте с новой датой!");
                        }
                        else if (st=="Access is denied!"){
                            alert("Извините, время вашей рабочей сессии истекло. Пожалуйста, закройте браузер и заново авторизуйтесь.");
                        }
                        else if (st=="No access rights!"){
                            alert("Не достаточно прав!");
                        }
                        else{
                            alert("Что-то пошло не так! ");
                        }

                    }
                },
                error:function(){
                    alert("Произошла ошибка при передаче данных");
                }
            });
            dialog.dialog("close");
        }
    }
    dialog = $("#form-lesson").dialog({
        resizable:false,
        autoOpen: false,
        height: 'auto',
        width: 300,
        modal: true,
        buttons: {
            "Создать": addLesson,
            "Отмена": function () {
                dialog.dialog("close");
            }
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
        data_st=$(this).attr('data-idStudent');
        $('div [data-idStudent="'+data_st+'"]').addClass("illumination");
    });

    $('div').delegate(".grade", "mouseout", function () {
        data_st=$(this).attr('data-idStudent');
        $('div [data-idStudent="'+data_st+'"]').removeClass("illumination");
    });

    $('div').delegate(".grade", "dblclick", function () {
        $("button#edit").removeAttr('disabled');
        $("button#close").removeAttr('disabled');
        dat=$(this).parent().find('div.date_title').html();//�"а�'а �_�'�_�>�+�+а
        student_id=$(this).attr('data-idStudent');
        id_Less=$(this).attr('data-idLes');
        id_Zapis=$(this).attr('data-zapis');
        edit_dialog.dialog("open");
        edit_form[0].reset();

        //title формы= ФИО студента
        var data_studentID=$(this).attr('data-idStudent');
        var fio_stud=$('div.fio_student[data-idStudent="'+data_studentID+'"]').text();
        edit_dialog.dialog({title: fio_stud});
        $("#inp_0").focus();
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

            //При нажатии на кнопку с результатами текст выводится в поле ввода
            $("b.tool, span.tool").click(function () {
                var text = $(this).text();
                $("#"+inp_id).val(text);
                $("#"+inp_id).blur();
            });
        });
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
        var cur_res = $("#inp_0").val();
        if(cur_res!=""){
            coding = Encrypt(cur_res);
            elem.text(cur_res);

            if((cur_grade=="") && (cur_res!="")){
                $.ajax({
                    type:'get',
                    url:'p.php',
                    data:{
                        'dateLes': dat,
                        'idLessons': $("input#idSubject").val(),
                        'idStudent': student_id,
                        'PL': $("input#idPL").val(),
                        'idPrepod': $("input#idPrepod").val(),
                        'idLess': id_Less,
                        'menuactiv': "addLessonStudent",
                        'grades': coding,
                        'PKE': '0'
                    },
                    success:function (st) {
                        if ((st!="Access is denied!")&&(st!="No access rights!")){
                            myStudentZapis[id_Less+'Zapis'+student_id]=st;
                        }else{
                            if (st=="Access is denied!"){
                                alert("Извините, время вашей рабочей сессии истекло. Пожалуйста, закройте браузер и заново авторизуйтесь.");
                            }
                            else if (st=="No access rights!"){
                                alert("Не достаточно прав!");
                            }
                            else{
                                alert("Что-то пошло не так! ");
                            }

                        }
                    },
                    error: function (x,t) {
                        if( t === 'timeout') {
                            alert("Не удалось получить ответ от сервера");
                            edit_dialog.dialog("close");
                            window.location.reload();

                        }
                        else{
                            alert("Произошла ошибка при передаче данных");
                        }
                    },
                    timeout:30000
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
                            'grades': coding,
                            'PKE': '0'
                        },
                        success:function (st) {
                            if (st=="Access is denied!"){
                                alert("Извините, время вашей рабочей сессии истекло. Пожалуйста, закройте браузер и заново авторизуйтесь.");
                            }
                            else if (st=="No access rights!"){
                                alert("Не достаточно прав!");
                            }
                        },
                        error: function (x,t) {
                            if( t === 'timeout') {
                                alert("Не удалось получить ответ от сервера");
                                edit_dialog.dialog("close");
                                window.location.reload();

                            }
                            else{
                                alert("Произошла ошибка при передаче данных");
                            }
                        },
                        timeout:30000
                    });
                }

            }
            $("button#edit").attr('disabled', true);
            $("button#close").attr('disabled', true);
            edit_dialog.dialog("close");
        }
        else {
            alert("Для сохранения необходимо ввести хоть одну оценку!");
        }


    });
    $("#close").click(function () {
        edit_dialog.dialog("close");
    });
    $(".inp_cell:text").click(function () {
        $(this).select();
    });
    $("#create_lesson").button().on("click", function () {
        dialog.dialog("open");
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


});


//Функция отображения PopUp
function PopUpShow(){
    $("#window-popup").show();
}

//Функция скрытия PopUp
function PopUpHide(){
    $("#window-popup").hide();
}