$(document).ready(function () {

    idStudent = $("input#idStudent").val();
    idSubject = "";
    var subjDivWidth = $("div.DialogFakFak").css('width');
    grades = [];

    $("div.DialogFakFak").click(function () {
        var obj_this_contentGrade = $(this).find(".content_grade");
        if (obj_this_contentGrade.is(':hidden')) {
            grades = [];
            $(this).css("cursor", "default");
            obj_this_contentGrade.html("");

            if ($(".content_grade").is(':visible')) {
                grades = [];
                $(".CO").not($(this).find(".CO")).show();
                $(".content_grade").not(obj_this_contentGrade).hide();
                $(".fullText").not($(this).find(".fullText")).hide();
                $(".shortText").not($(this).find(".shortText")).show();
                $(".fullTextClose").not($(this)).css('display', 'none');
                $(".DialogFakFak").animate({width: subjDivWidth}, 400);
                $(".DialogFakFak").not($(this)).css("cursor", "pointer");
                $("div.selected").each(function () { //удаляю выделенные Н в скрытых блоках(предмет)
                    $(this).removeClass("selected");
                });
            }
            idSubject = $(this).attr('data-idSubject');
            $(this).find(".CO").hide();
            $(this).find(".shortText").hide();
            $(this).find(".fullText").show();
            obj_this_contentGrade.show();
            $(this).animate({width: "95%"}, 400, function () {
                $.ajax({
                    type: 'get',
                    url: 'd.php',
                    data: {
                        'idStudent': idStudent,
                        'idSubject': idSubject,
                        'ajaxTrue': "1",
                        'menuactiv': "OpenDetails"
                    },
                    beforeSend:function () {
                        obj_this_contentGrade.html("Загрузка...");
                    },
                    success: function (response) {
                        obj_this_contentGrade.html(response);
                        $(function () {
                            obj_this_contentGrade.find('div.Otmetka').each(function () {
                                $(this).html(Decrypt($(this).html()));
                                smallText($(this));
                                var block = 0;
                                block = Available($(this).text());
                                (block == 1) ? $(this).parent(".Oc").addClass("available_grade") : "";
                            });
                        });

                    },
                    error: function () {
                        alert("Не удалось отразить оценки!");
                    }
                });
                $(this).find(".fullTextClose").css('display', 'block');
            });
        }

        // else if (obj_this_contentGrade.is(':visible')) { //если открыт блок и я там что-либо делаю
        //
        // }
    });

    $('div').delegate(".fullTextClose", "click", function (event) {
        event.stopPropagation();
        event.preventDefault();
        $(this).parent().find(".content_grade").hide();
        $(this).hide();
        $(this).parent().find(".fullText").hide();
        $(this).parent().find(".shortText").show();
        $(this).parent().animate({width: subjDivWidth}, 400);
        $(this).parent().find(".CO").show();
        $(this).parent().css("cursor", "pointer");
        $(".available_grade").removeClass("selected");
    });

    $("div.content_grade").click(function (event) {
        event.stopPropagation();
        event.preventDefault();
        return false;
    });

    //Если клик по выделенной ячейке отменить выделение и наоборот
    $('div').delegate(".available_grade", "click", function () {
        if ($(this).hasClass("selected")) {
            $(this).removeClass("selected");
        }
        else {
            $(this).addClass("selected");
        }
    });

});

$(function () {
    var edit_dialog, edit_form;

    //Форма замены оценок
    edit_dialog = $("#form-update").dialog({
        resizable: false,
        autoOpen: false,
        height: 'auto',
        width: 240,
        modal: true
    });
    edit_form = edit_dialog.find("form").on("submit", function (event) {
        event.preventDefault();
    });


    $("#updateAbs").click(function () {
        var replace = $("#inp_0").val();
        if (replace != "") {
            grades.length = 0;
            $('div.selected').each(function () {
                var elem = $(this).find('.Otmetka');
                grades.push({0: elem.attr("data-zapis"), 1: ReplaceAbs(String(elem.text()), replace)});
            });
            countAbs = grades.length;
            //console.log(grades);

            $.ajax({
                type: 'get',
                url: 'd.php',
                data: {
                    'idStudent': idStudent,
                    'menuactiv': "repAbsenteeisms",
                    'arrGrade': grades,
                    'ajaxTrue': "1"
                },
                success: function (st) {
                    if (st == "Access is denied!") {
                        alert("Извините, время вашей рабочей сессии истекло. Пожалуйста, закройте браузер и заново авторизуйтесь.");
                    }
                    else if (st == "No access rights!") {
                        alert("Не достаточно прав!");
                    }
                    else if (st == "No") {
                        alert("Ой, что-то пошло не так!");
                    }
                    else {
                        alert("Успешно произведена замена записей: \n       Дисциплина: " + lessonTitle + "\n       Количество: " + countAbs);
                        window.location.reload();
                        $('body').addClass("loading");
                    }
                },
                error: function () {
                    alert("Произошла ошибка при передаче данных");

                }
            });

            edit_dialog.dialog("close");
        } else {
            alert("Для продолжения необходимо заполнить поле ввода!");
        }
    });

    $("#close").click(function () {
        edit_dialog.dialog("close");
    });

    //Кнопки выделить Все и отменить Все
    $('div').delegate("#selAll", "click", function () {
        $(".content_grade").not($(this).parent().parent()).html("");
        $('div.available_grade').each(function () {
            var curObj=0;
            curObj = $(this).find(".Otmetka").text();
            var isSel=0;
            isSel= AvailableAbs(curObj);
            (isSel != 1) ? $(this).addClass("selected") : "";
        });
    });

    $('div').delegate("#canselSelAll", "click", function () {
        $(this).parents().children(".available_grade").removeClass("selected");
    });

    $("b.tool").click(function () {
        var text = $(this).text();
        $("#inp_0").val(text);
    });

    $(".inp_cell:text").keydown(function (event) {
        if (event.keyCode == 8 || event.keyCode == 46) {   //если это удаление
            $(this).val("");
        }
    });

    $('div').delegate(".replaceAbs", "click", function () {
        var countSelBlock = $("div.selected").length;
        if (countSelBlock != 0) {
            edit_dialog.dialog("open");
            edit_form[0].reset();
            lessonTitle = $(this).parents().parents().children("span.shortText").html();
            edit_dialog.dialog({title: lessonTitle});
        } else {
            alert("Вы не выбрали пропуски, которые желаете заменить!");
        }
    });

});

//функция сделать видимыми только где есть прогул
function Available(grade) {
    var c_gr = grade.split("/");
    for (var i = 0; i < c_gr.length; i++) {
        if ((absenteeisms.indexOf(c_gr[i]) != -1) || (absenteeisms_with_cause.indexOf(c_gr[i]) != -1)) {
            return 1;
        }
    }
}

//функция сделать видимыми только где есть прогул. Выделяет все Н, кроме Ну....
function AvailableAbs(grade) {
    var c_gr = grade.split("/");
    for (var i = 0; i < c_gr.length; i++) {
        if ((absenteeisms_with_cause.indexOf(c_gr[i]) != -1)) {
            return 1;
        }
    }
}

function ReplaceAbs(value, sub) {
    var res = "";
    var mas = value.split("/");
    for (i = 0; i < mas.length; i++) {
        if ((absenteeisms.indexOf(mas[i]) != -1) || (absenteeisms_with_cause.indexOf(mas[i]) != -1)) {
            mas[i] = sub;
        }
        res += MatchEncrypt(mas[i]);
    }
    return res;
}


function smallText(object) {
    if ((object.text().length >= 6) && (object.text().length < 10)) {
        object.css("font-size", "0.85em");
    }
    else if (object.text().length >= 10) {
        object.css("font-size", "0.75em");
    }
}