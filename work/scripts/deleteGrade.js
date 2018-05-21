$(function () {
    var dialog_confirm_delete, form_confirm_delete;

    //форма удаления оценки
    dialog_confirm_delete = $("#confirm_delete").dialog({
        resizable: false,
        autoOpen: false,
        modal: true,
        width: '400',
        buttons: {
            "Удалить": deleteGrade,
            "Отмена": function () {
                dialog_confirm_delete.dialog("close");
            }
        },
        close: function () {
            form_confirm_delete[0].reset();
        }
    });
    form_confirm_delete = dialog_confirm_delete.find("form").on("submit", function (event) {
        event.preventDefault();
    });


    function deleteGrade() {
        $.ajax({
            type: 'get',
            url: 'z.php',
            data: {
                'idStud': id_st_name,
                'idLesson': idLes,
                'menuactiv': "deleteGrade",
                'ajaxTrue': "1"
            },
            success: function (st) {
                if ((st != "Access is denied!") && (st != "No access rights!")) {
                    delObj.html("");
                    alert("Запись успешно удалена!");
                    updateAvg(id_st_name);
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
                alert("Произошла ошибка при попытке удалить запись из БД");
            }
        });
        dialog_confirm_delete.dialog("close");
        updateAvg(id_st_name, "avg_small");
        updateAns(id_st_name, "ans_small");
    }


    $('div').delegate(".close", "click", function () {
        delObj = $(this).parent();
        id_st_name = delObj.attr("data-idStudent");
        idLes = delObj.attr('data-idLes');

        var st_name = $('div.fio_student[data-idStudent="' + id_st_name + '"]').html();
        var datGr = $(this).parent().parent().find('div.date_title').html();
        var gr = $(this).parent().text();

        $("#delSt").text(st_name.slice(3));
        $("#delDat").text(datGr);
        $("#delGr").text(gr);
        dialog_confirm_delete.dialog("open");

    });
});