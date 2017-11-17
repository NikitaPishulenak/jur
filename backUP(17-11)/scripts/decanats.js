//Функция логирования
$(function () {
   var log_dialog, log_form;
    //Форма логирования
    log_dialog = $("#log").dialog({
        resizable:false,
        autoOpen: false,
        height: 'auto',
        width: 'auto',
        modal: true
    });
    log_form = log_dialog.find("form").on("submit", function (event) {
        event.preventDefault();
    });

    $('div').delegate(".triangle-topright", "click", function () {
        log_dialog.dialog("open");
        // $.ajax({
        //     type:'get',
        //     url:'d.php',
        //     data:{
        //         'id_Zapis': id_Zapis,
        //         'dateLes': dat,
        //         'idStudent': student_id,
        //         'idPrepod': $("input#idPrepod").val(),
        //         'menuactiv': "editLessonStudent",
        //         'grades': coding
        //     },
        //     success:function (st) {
        //         if (st=="Access is denied!"){
        //             alert("Доступ запрещен!");
        //         }
        //         else if (st=="No access rights!"){
        //             alert("Не достаточно прав!");
        //         }
        //     },
        //     error: function () {
        //         alert("Произошла ошибка при передаче данных");
        //     }
        // });
    });

//Дорисовка треугольника
    $("div.grade[data-Log='1']").each(function () {
        $(this).append('<div class="triangle-topright"></div>');
    });
});

