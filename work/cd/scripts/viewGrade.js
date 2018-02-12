$(document).ready(function () {

    idStudent = $("input#idStudent").val();
    idPrepod=$("input#idPrepod").val();
    idSubject = "";
    var subjDivWidth = $("div.DialogFakFak").css('width');

    var grades=[];

    $("div.DialogFakFak").click(function () {
        var obj_this_contentGrade = $(this).find(".content_grade");
        obj_this_contentGrade.html("");
        if (obj_this_contentGrade.is(':hidden')) {

            if ($(".content_grade").is(':visible')) {
                $(".CO").not($(this).find(".CO")).show();
                $(".content_grade").not(obj_this_contentGrade).hide();
                $(".fullText").not($(this).find(".fullText")).hide();
                $(".shortText").not($(this).find(".shortText")).show();
                $(".fullTextClose").not($(this)).css('display', 'none');
                $(".DialogFakFak").animate({width: subjDivWidth}, 400);
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
                    url: 'view.php',
                    data: {
                        'idStudent': idStudent,
                        'idSubject': idSubject
                    },
                    success: function (response) {
                        obj_this_contentGrade.html(response);
                        $(function () {
                            obj_this_contentGrade.find('div.Otmetka').each(function () {
                                $(this).html(Decrypt($(this).html()));
                                smallText($(this));
                                var block = 0;
                                block = Available($(this).html());
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
        else if (obj_this_contentGrade.is(':visible')) {
            $(this).find(".fullTextClose").css('display', 'none');
            obj_this_contentGrade.hide();
            $(this).find(".fullText").hide();
            $(this).find(".shortText").show();
            $(this).animate({width: subjDivWidth}, 400, function () {
                $(this).find(".CO").show();
            });
        }

    });

    $("div.content_grade").click(function (event) {
        event.stopPropagation();
        event.preventDefault();
        return false;
    });

    $(function () {
        var  edit_dialog, edit_form;

        //Форма замены оценок
        edit_dialog = $("#form-edit").dialog({
            resizable:false,
            autoOpen: false,
            height: 'auto',
            width: 230,
            modal: true
        });
        edit_form = edit_dialog.find("form").on("submit", function (event) {
            event.preventDefault();
        });

        $('div').delegate(".replaceAbs", "click", function () {
            var countSelBlock=$("div.selected").length;
            if(countSelBlock!=0){
                edit_dialog.dialog("open");
                edit_form[0].reset();
                lessonTitle=$(this).parents().parents().children("span.shortText").html();
                edit_dialog.dialog({title: lessonTitle});
            }else{
                alert("Вы не выбрали прогулы, которые желаете заменить!");
            }
        });


        $("#edit").click(function () {
            var replace=$("#inp_0").val();
            if(replace!=""){
                grades.length=0;
                $('div.selected').each(function () {
                    var elem=$(this).find('.Otmetka');
                    countAbs=grades.length+1;
                    grades.push({idZapis : elem.attr("data-zapis"), newGrade : ReplaceAbs(String(elem.text()), replace), PL : $(this).parents().find("input#idPL").val()});
                });

                console.log(grades);
                console.log("Студент: "+idStudent+" Преподаватель: "+idPrepod +" Предмет: "+idSubject);


                $.ajax({
                    type:'get',
                    url:'d.php',
                    data:{
                        'idStudent': idStudent,
                        'idPrepod':idPrepod,
                        'idSubject':idSubject,
                        'menuactiv': "repAbsenteeisms",
                        'arrGrade': grades
                    },
                    success:function (st) {
                        if (st=="Access is denied!"){
                            alert("Извините, время вашей рабочей сессии истекло. Пожалуйста, закройте браузер и заново авторизуйтесь.");
                        }
                        else if (st=="No access rights!"){
                            alert("Не достаточно прав!");
                        }
                        else{
                            alert("Успешно произведена замена записей: \n      -По дисциплине: "+lessonTitle+";\n      -В количестве: "+countAbs+";");
                            window.location.reload();
                        }
                    },
                    error: function () {
                        alert("Произошла ошибка при передаче данных");

                    }
                });

                edit_dialog.dialog("close");
            }else {
                alert("Для продолжения необходимо заполнить поле ввода!");
            }
        });

        $("#close").click(function () {
            edit_dialog.dialog("close");
        });


        //Если клик по выделенной ячейке отменить выделение и наоборот
        $('div').delegate(".available_grade", "click", function () {
            if ($(this).hasClass("selected")) {
                $(this).removeClass("selected");
                // grades.splice(0,1);
            }
            else {
                $(this).addClass("selected");
                // grades.push({id:8, val:'Нб.у.'});
            }
        });

        //Кнопки выделить Все и отменить Все
        $('div').delegate("#selAll", "click", function () {
            $(this).parents().children(".available_grade").addClass("selected");
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


    });
});

//функция сделать видимыми только где есть прогул
function Available(grade) {
    var c_gr = grade.split("/");
    for (var i = 0; i < c_gr.length; i++) {
        if ((absenteeisms.indexOf(c_gr[i]) != -1) || (absenteeisms_with_cause.indexOf(c_gr[i])!=-1)) {
            return 1;
        }
        else {
            return 0;
        }
    }

}

function ReplaceAbs(value,sub) {
    var res = "";
    var mas = value.split("/");
    for (i = 0; i < mas.length; i++) {
        if((absenteeisms.indexOf(mas[i])!=-1) || (absenteeisms_with_cause.indexOf(mas[i])!=-1)){
            mas[i]=sub;
            // console.log(mas[i]);
        }
        res += MatchEncrypt(mas[i]);
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


function MatchDecrypt(val) {
    if (val >= 10 && val < 20) {
        return Number(val) - 9;
    }
    else {
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
            case '26':
                return 'Н';
                break;
            case '27':
                return 'Отр.';
                break;
            case '28':
                return 'Доп.';
                break;

            case '31':
                return 'Н1ч.';
                break;
            case '32':
                return 'Н2ч.';
                break;
            case '33':
                return 'Н3ч.';
                break;
            case '34':
                return 'Н4ч.';
                break;
            case '35':
                return 'Н5ч.';
                break;
            case '36':
                return 'Н6ч.';
                break;

        }
    }
}


function smallText(object) {
    if ((object.text().length >= 6) && (object.text().length < 10)) {
        object.css("font-size", "0.85em");
    }
    else if (object.text().length >= 10) {
        object.css("font-size", "0.75em");
    }
}