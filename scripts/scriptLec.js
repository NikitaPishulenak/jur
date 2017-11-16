$(function () {
    var dialog, form, edit_dialog, edit_form;
    var myStudentId = new Array();
    var myStudentZapis = new Array();

    function addLesson() {
        checkDate("lesson-date");
        if ($("#lesson-date").val() != ""){
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
                },
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

    //Форма выставления оценок
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
        dat=$(this).parent().find('div.date_title').html();
        student_id=$(this).attr('data-idStudent');
        id_Less=$(this).attr('data-idLes');
        id_Zapis=$(this).attr('data-zapis');
        edit_dialog.dialog("open");
        edit_form[0].reset();

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

              $("b.tool, span.tool").click(function () {
                var text = $(this).text();
                $("#"+inp_id).val(text);
                $("#"+inp_id).blur();
            });
        });
        var absenteeism = /\w/;
        $(".inp_cell:text").keydown(function (event) {
            if (event.keyCode == 8 || event.keyCode == 46) {   //если это удаление
                if (!absenteeism.test(this.value)) {
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
                }
                else{
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

    countCell = 1;
    groupNumber="";
    subject="";
    teacher="";
    dateLesson=$("div.date_title:last").val();
    idLesson="";

});

//Функция по вызову последующих функций редактирования даты занятия
$(function () {
    var edit_date_dialog, edit_date_form;
    edit_date_dialog = $("#form-edit-date").dialog({
        resizable:false,
        autoOpen: false,
        modal: true,
        buttons: {
            "Изменить": editDate,
            "Отмена": function () {
                edit_date_dialog.dialog("close");
            }
        },
        close: function () {
            edit_date_form[0].reset();
        }
    });
    edit_date_form = edit_date_dialog.find("form").on("submit", function (event) {
        event.preventDefault();
    });

    function editDate() {
        checkDate("edit-lesson-date");
        dat=(dat.length==9)? "0" + dat : dat;
        if($("#edit-lesson-date").val()!=""){
            var new_date=$("#edit-lesson-date").val();// дата после изменения

            if(dat!=new_date){
                //Замена даты
                    $.ajax({
                        type:'get',
                        url:'p.php',
                        data:{
                            'Date': new_date,
                            'PKE': "0",
                            'idGroup': $("input#idGroup").val(),
                            'idLesson': id_Lesson,
                             'menuactiv': "editDate"
                        },
                        success:function (st) {
                            if ((st!="Access is denied!")&&(st!="No access rights!")){
                                dat_col_object.html(new_date);
                                // alert("Дата "+dat+" успешно заменена на "+new_date+"!");
                                window.location.reload();
                            }
                            else{
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
                        error: function () {
                            alert("Произошла ошибка при передаче данных");
                        }
                    });

                edit_date_dialog.dialog("close");
            }
            else{
                alert("Для сохранения необходимо изменить дату! В противном случае нажмите кнопку 'Отмена'");
            }
        }
    }

    $('div').delegate(".date_title", "dblclick", function () {
        dat=$(this).parent().find('div.date_title').html();//Дата столбца
        // var datemass = dat.split(".");
        // var datepickerDate=datemass[1]+'.'+datemass[0]+'.'+datemass[2];
        dat_col_object=$(this).parent().find('div.date_title');// объект которому принадлежит значение
        id_Lesson=$(this).attr('data-idLesson');
        edit_date_dialog.dialog("open");
        edit_date_form[0].reset();
        edit_date_dialog.dialog({title: dat});
        $("#edit-lesson-date").val(dat);
        $('.datepicker').datepicker("setDate", dat.toString());

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
