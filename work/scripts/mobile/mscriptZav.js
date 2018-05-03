var edit_dialog, edit_form, edit_date_dialog, edit_date_form;
var edit_grade_flag = 0, edit_dateTitle_flag = 0;

// Долгое нажатие для выставления оценки
$('div').delegate(".grade", "touchstart", function () {
    elGrade = $(this);
    edit_grade_flag = 1;
});
$('div').delegate(".grade", "touchend", function () {
    edit_grade_flag = 0;
});
$('div').delegate(".grade", "touchmove", function () {
    edit_grade_flag = 0;
});

// Долгое нажатие для редактирования даты
$('div').delegate(".date_title", "touchstart", function () {
    elDateTitle = $(this);
    edit_dateTitle_flag = 1;
});
$('div').delegate(".date_title", "touchend", function () {
    edit_dateTitle_flag = 0;
});
$('div').delegate(".date_title", "touchmove", function () {
    edit_dateTitle_flag = 0;
});


setInterval(function () {
    if (edit_grade_flag == 1) {
        edit_grade_flag = 0;
        create_new_grade(elGrade);
    }
    else if (edit_dateTitle_flag == 1) {
        edit_dateTitle_flag == 0;
        create_new_dateTitle(elDateTitle);
    }
}, 1000);


//Редактирование отметки
edit_dialog = $("#form-edit").dialog({
    resizable: false,
    autoOpen: false,
    height: 'auto',
    width: 'auto',
    modal: true

});
edit_form = edit_dialog.find("form").on("submit", function (event) {
    event.preventDefault();
});

//Форма редактирование даты-типа занятия и номера темы
edit_date_dialog = $("#form-edit-date").dialog({
    resizable: false,
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
    dat = (dat.length == 9) ? "0" + dat : dat;
    if ($("#edit-lesson-date").val() != "") {
        var new_date = $("#edit-lesson-date").val();// дата после изменения
        var newPKE = $("input.edit_type_lesson:checked").val();
        var new_number_theme_lesson = $('input#edit_number_theme').val();
        (new_number_theme_lesson == "") ? new_number_theme_lesson = 0 : new_number_theme_lesson;

        if ((dat != new_date) || (newPKE != pke_lesson) || (new_number_theme_lesson != numb_theme_lesson)) {
            //Замена даты, типа занятия или номера темы занятия
            $.ajax({
                type: 'get',
                url: 'z.php',
                data: {
                    'Date': new_date,
                    'PKE': newPKE,
                    'idGroup': $("input#idGroup").val(),
                    'idLesson': id_Lesson,
                    'numberThemeLesson': new_number_theme_lesson,
                    'menuactiv': "editDate",
                    'ajaxTrue':"1"
                },
                success: function (st) {
                    if ((st != "Access is denied!") && (st != "No access rights!")) {
                        dat_col_object.html(new_date);
                        // alert("Дата "+dat+" успешно заменена на "+new_date+"!");
                        window.location.reload();
                    }
                    else {
                        if (st == "Access is denied!") {
                            alert("Извините, время вашей рабочей сессии истекло. Пожалуйста, закройте браузер и заново авторизуйтесь.");
                        }
                        else if (st == "No access rights!") {
                            alert("Не достаточно прав!");
                        }
                        else {
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
        else {
            alert("Для сохранения необходимо изменить дату и/или тип занятия! В ином случае нажмите кнопку 'Отмена'");
        }
    }
}

function create_new_grade(e) {
    edit_grade_flag = 0;
    var curStatus=e.attr("data-Status");

    switch (e.attr("data-pke")){
        case "2":
            $("div#item_grade").html(items_grade[2]);
            break;
        case "1":
            $("div#item_grade").html(items_grade[1]);
            break;
        case "0":
            $("div#item_grade").html(items_grade[0]);
            break;
    }

    $("button#edit").removeAttr('disabled');
    $("button#close").removeAttr('disabled');
    dat = e.parent().find('div.date_title').html();//Дата столбца
    student_id = e.attr('data-idStudent');
    id_Less = e.attr('data-idLes');
    PKE = e.attr('data-PKE');
    id_Zapis = e.attr('data-zapis');

    edit_dialog.dialog("open");
    edit_form[0].reset();
    $("div.more").hide(1);
    var data_studentID = e.attr('data-idStudent');
    var fio_stud = $('div.fio_student[data-idStudent="' + data_studentID + '"]').text();
    edit_dialog.dialog({title: fio_stud});
    $("button#add_grade_input").removeAttr('disabled');
    $("#inp_0").blur();
    $('#inp_2').slideUp(1);
    $('#inp_1').slideUp(1);
    cur_grade = e.text();
    elem = e;
    grades = cur_grade.split("/");
    switch (curStatus) {
            case "0":
                for (var i = 0; i < grades.length; i++) {
                    $("#inp_" + i).removeAttr('disabled');
                    $("div.panel").find('input#inp_' + i).slideDown(1);
                    $("div.panel").find('input#inp_' + i).val(grades[i]);
                }
            break;
            case "1":
                for (var i = 0; i < grades.length; i++) {
                    $("#inp_" + i).removeAttr('disabled');
                    $("button#add_grade_input").attr('disabled', true); //для любителей которые любят видеть что было раньше и сейчас
                    $("div.panel").find('input#inp_' + i).slideDown(1);
                    $("div.panel").find('input#inp_' + i).val(grades[i]);
                    if (absenteeisms_with_cause.indexOf(grades[i]) != -1) 
                    {
                        $("#inp_" + i).attr('disabled', 'disabled');
                        $("#inp_" + i).blur();
                    }
                }
            break;
   }

    $("span.moreBtn").click(function () {
        $("div.more").toggle(600);
    });

    $(".inp_cell:text").focus(function () {
        inp_id = $(this).attr('id');

        //При нажатии на кнопку с результатами текст выводится в поле ввода
        $("b.tool, span.tool").on("touchstart", function () {
            //$("b.tool, span.tool").click(function () {
            var text = $(this).text();
            $("#" + inp_id+":enabled").val(text);
            $("#" + inp_id).blur();
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

    $(".inp_cell:text").keydown(function (event) {
        if (event.keyCode == 8 || event.keyCode == 46) {   //если это удаление
            $(this).val("");
        }
    });
}

function create_new_dateTitle(e) {
    edit_dateTitle_flag = 0;
    dat = e.parent().find('div.date_title').html();//Дата столбца
    // var datemass = dat.split(".");
    // var datepickerDate=datemass[1]+'.'+datemass[0]+'.'+datemass[2];
    dat_col_object = e.parent().find('div.date_title');// объект которому принадлежит значение
    pke_lesson = e.parent().find("div.grade:first").attr('data-PKE');
    id_Lesson = e.attr('data-idLesson');
    numb_theme_lesson = e.attr('data-number_theme_lesson');
    edit_date_dialog.dialog("open");
    edit_date_form[0].reset();
    edit_date_dialog.dialog({title: dat});
    $("#edit-lesson-date").val(dat);
    (numb_theme_lesson == "0") ? $('input#edit_number_theme').val("") : $('input#edit_number_theme').val(numb_theme_lesson);
    //$('.datepicker').datepicker("setDate", new Date(datepickerDate) );

    $('.datepicker').datepicker("setDate", dat.toString());
    switch (pke_lesson) {
        case '0':
            $("#edit_simple_lesson_rb").prop("checked", true);
            break;
        case'1':
            $("#edit_colloquium_rb").prop("checked", true);
            break;
        case'2':
            $("#edit_exam_rb").prop("checked", true);
            break;
    }
}
