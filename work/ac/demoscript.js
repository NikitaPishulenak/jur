$(document).ready(function () {

    var idStudent=$("input#idStudent").val();
    var idSubject="";
    var subjDivWidth=$("div.DialogFakFak").css('width');

    $("div.DialogFakFak").click(function () {
        var obj_this_contentGrade=$(this).find(".content_grade");
        obj_this_contentGrade.html("");
        if(obj_this_contentGrade.is(':hidden')){

            if($(".content_grade").is(':visible')){
                $(".CO").not($(this).find(".CO")).show();
                $(".content_grade").not(obj_this_contentGrade).hide();
                $(".fullText").not($(this).find(".fullText")).hide();
                $(".shortText").not($(this).find(".shortText")).show();
                $(".fullTextClose").not($(this)).css('display', 'none');
                $(".DialogFakFak").animate({width: subjDivWidth}, 400);
            }
            idSubject=$(this).attr('data-idSubject');

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
        else if(obj_this_contentGrade.is(':visible')){
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

});


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
    if((object.text().length>=6) && (object.text().length<10)){
        object.css("font-size", "0.85em");
    }
    else if(object.text().length>=10){
        object.css("font-size", "0.75em");
    }
}