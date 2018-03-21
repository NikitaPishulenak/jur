$(function () {
    var dialog, form, edit_dialog, edit_form;
    var myStudentId = new Array();
    var myStudentZapis = new Array();

    function addLesson() {
        checkDate("lesson-date");
        if ($("#lesson-date").val() != ""){
            var dateLesson = $("#lesson-date").val();
            var cnt = $("div.container-list").find("div.fio_student").length;
            var number_theme_lesson=$('input#number_theme').val();
            number_theme_lesson=(number_theme_lesson=="") ? "0" : number_theme_lesson;
            $('div.fio_student').each(function (index, element) { myStudentId[index]=$(element).attr('data-idStudent'); });
            $.ajax({
                type:'get',
                url:'z.php',
                data:{
                    'dateLesson':dateLesson,
                    'idGroup': $("input#idGroup").val(),
                    'idLessons': $("input#idSubject").val(),
                    'PL':"1",
                    'numberThemeLesson':number_theme_lesson,
                    'menuactiv': "addLesson",
                    'PKE': '0',
                    'ajaxTrue':"1"
                },
                success:function (st) {
                    if ((st!="No")&&(st!="Access is denied!")&&(st!="No access rights!")){
                        dateLesson=(dateLesson.charAt(0)=="0") ? dateLesson.slice(1) : dateLesson;

                        (number_theme_lesson==0) ? $("<div class='date_col'><div class='date_title' data-idLesson="+st+" data-number_theme_lesson="+number_theme_lesson+">"+ dateLesson + "</div></div>").insertAfter('div.date_col:last') :
                            $("<div class='date_col'><div class='nLesson'>" +number_theme_lesson+"</div><div class='date_title' data-idLesson="+st+" data-number_theme_lesson="+number_theme_lesson+">"+ dateLesson + "</div></div>").insertAfter('div.date_col:last');

                        for (var i = 0; i < cnt; i++) {
                            $("div.date_col:last").append("<div class='grade' data-idLes="+st+" data-idStudent="+myStudentId[i]+" data-zapis=0></div>");
                            myStudentZapis[st+'Zapis'+myStudentId[i]]=0;
                        }
                        $(".result_box").animate({scrollLeft: '10000px'}, timeScroll);
                    }
                    else{
                        if(st=="No"){
                            alert("Произошел сбой при записи данных!");
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
                $('input#number_theme').blur();
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
            elem.html(cur_res);
            smallText(elem);

            if((cur_grade=="") && (cur_res!="")){
                $.ajax({
                    type:'get',
                    url:'z.php',
                    data:{
                        'dateLes': dat,
                        'idLessons': $("input#idSubject").val(),
                        'idStudent': student_id,
                        'PL': $("input#idPL").val(),
                        'idPrepod': $("input#idPrepod").val(),
                        'idLess': id_Less,
                        'menuactiv': "addLessonStudent",
                        'grades': coding,
                        'PKE': '0',
                        'ajaxTrue':"1"
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
                        url:'z.php',
                        data:{
                            'id_Zapis': id_Zapis,
                            'dateLes': dat,
                            'idStudent': student_id,
                            'idPrepod': $("input#idPrepod").val(),
                            'menuactiv': "editLessonStudent",
                            'grades': coding,
                            'PKE': '0',
                            'ajaxTrue':"1"
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
            ShowLogTools(); //Дорисовать треугольники и крестики красные
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
        var cr_d=new Date();
        var cr_dStr=cr_d.getDate()+"."+Number(cr_d.getMonth()+1)+"."+cr_d.getFullYear();
        $('.datepicker').datepicker("setDate", cr_dStr.toString());
        $("#number_theme").val("");
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

    $.getScript('scripts/deleteGrade.js', function(){});
    if (is_touch_device()) {
        $.getScript('scripts/mobile/mscriptZavLec.js', function(){});
    }

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
            var new_number_theme_lesson=$('input#edit_number_theme').val();
            (new_number_theme_lesson=="") ? new_number_theme_lesson=0 : new_number_theme_lesson;

            if((dat!=new_date) || (new_number_theme_lesson!=numb_theme_lesson)){
                //Замена даты
                $.ajax({
                    type:'get',
                    url:'z.php',
                    data:{
                        'Date': new_date,
                        'PKE': "0",
                        'idGroup': $("input#idGroup").val(),
                        'idLesson': id_Lesson,
                        'numberThemeLesson':new_number_theme_lesson,
                        'menuactiv': "editDate",
                        'ajaxTrue':"1"
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
                alert("Для сохранения необходимо изменить дату! В ином случае нажмите кнопку 'Отмена'");
            }
        }
    }

    $('div').delegate(".date_title", "dblclick", function () {
        dat=$(this).parent().find('div.date_title').html();//Дата столбца
        // var datemass = dat.split(".");
        // var datepickerDate=datemass[1]+'.'+datemass[0]+'.'+datemass[2];
        dat_col_object=$(this).parent().find('div.date_title');// объект которому принадлежит значение
        id_Lesson=$(this).attr('data-idLesson');
        numb_theme_lesson=$(this).attr('data-number_theme_lesson');
        edit_date_dialog.dialog("open");
        edit_date_form[0].reset();
        edit_date_dialog.dialog({title: dat});
        $("#edit-lesson-date").val(dat);
        (numb_theme_lesson=="0") ? $('input#edit_number_theme').val("") : $('input#edit_number_theme').val(numb_theme_lesson);
        $('.datepicker').datepicker("setDate", dat.toString());

    });

});

//Функция дешифрирования оценок
$(function () {
    $("div.grade").each(function () {
        if($(this).text()!=""){
            $(this).html(Decrypt($(this).text()));
        }
    });

});