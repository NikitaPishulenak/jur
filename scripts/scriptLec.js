function proverka(event, id) {
    $(function () {
        el=$("#inp_"+id).val();
        if((el>10) ||(el<1)){
            $("#inp_"+id).val("");
        }
    });


    if((event.keyCode==8) || (event.keyCode==46) ) {
        return;
    }
    else if((event.keyCode<48) || (event.keyCode>57)) {
        return false;
    }
}

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
        width: 'auto',
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
        data_st=$(this).attr('data-idStudent');
        $('div [data-idStudent="'+data_st+'"]').addClass("illumination");
    });

    $('div').delegate(".grade", "mouseout", function () {
        data_st=$(this).attr('data-idStudent');
        $('div [data-idStudent="'+data_st+'"]').removeClass("illumination");
    });

    $('div').delegate(".grade", "dblclick", function () {
        dat=$(this).parent().find('div.date_title').html();//�"а�'а �_�'�_�>�+�+а
        student_id=$(this).attr('data-idStudent');
        id_Less=$(this).attr('data-idLes');
        id_Zapis=$(this).attr('data-zapis');
        edit_dialog.dialog("open");
        edit_form[0].reset();
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

            $("b#1").click(function(){
                $("#" + inp_id).val("Ну");
            });
            $("b#2").click(function(){
                $("#" + inp_id).val("Нб.у");
            });
            $("b#3").click(function(){
                $("#" + inp_id).val("Нб.о.");
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
                    'grades': coding,
                    'PKE': '0'
                },
                success:function (st) {
                    if (st=="Access is denied!"){
                        alert("� �_�_�'�_п зап�_���%���_!");
                    }
                    else if (st=="No access rights!"){
                        alert("�_�� �_�_�_�'а�'�_�+�_�_ п�_а�_!");
                    }
                },
                error: function () {
                    alert("�_�_�_из�_�_�>а �_�_и�+ка п�_и п���_���_а�+�� �_а�_�_�<�:");
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