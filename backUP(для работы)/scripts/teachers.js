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
        if($("#edit-lesson-date").val()!=""){
            var new_date=$("#edit-lesson-date").val();// дата после изменения

            $.ajax({
                type:'get',
                url:'p.php',
                data:{
                    'dateLesson':dateLesson,
                    'PKE':"",
                    'idGroup': $("input#idGroup").val(),
                    'idLessons': $("input#idSubject").val(),
                    'PL':"0",
                    'menuactiv': "editDate"
                },
                success:function (st) {
                    if ((st!="Access is denied!")&&(st!="No access rights!")){
                        dat_col_object.html(new_date);
                        alert("Операция произведена успешно!");
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
    }

    $('div').delegate(".date_title", "dblclick", function () {
        dat=$(this).parent().find('div.date_title').html();//Дата столбца
        dat_col_object=$(this).parent().find('div.date_title');// объект которому принадлежит значение
        pke_lesson=$(this).parent().find("div.grade:first").attr('data-PKE');
        id_Zapis=$(this).attr('data-zapis');
        edit_date_dialog.dialog("open");
        edit_date_form[0].reset();
        edit_date_dialog.dialog({title: dat});
        $("#edit-lesson-date").val(dat);
        switch (pke_lesson){
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

    });
});

//Функция дешифрирования оценок
$(function () {
    $("div.grade").each(function () {
        if($(this).text()!=""){
            $(this).text(Decrypt($(this).text()));
        }
        if($(this).text()=="Отр."){
            $(this).addClass("absenteeism_closed_cell");
        }
    });
});
