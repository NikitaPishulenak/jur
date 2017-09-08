$(function () {
    $("div.grade").each(function () {
        if($(this).text()!=""){
            $(this).text(Decrypt($(this).text()));
        }
    });
});

$(function () {
    $("div.average").each(function () {
        var sum=0,countGrade=0;
        var elem=$(this).attr('data-idStudent');
        $('div.grade[data-idStudent="'+elem+'"]').each(function () {
            var gr=$(this).text().split("/");
            for (var i=0; i<gr.length; i++){
                if(Number(gr[i])){
                    sum+=Number(gr[i]);
                    countGrade++;
                }
            }

        });
        $('div.average[data-idStudent="'+elem+'"]').html(Math.round(10*(sum/countGrade))/10);
    });
    $("div.answer").each(function () {
        var countAnswer=0;
        var elem=$(this).attr('data-idStudent');
        $('div.grade[data-idStudent="'+elem+'"]').each(function () {
            var gr=$(this).text().split("/");
                if(Number(gr[0])){
                    countAnswer++
            }

        });
        $('div.answer[data-idStudent="'+elem+'"]').html(Math.round(100*(countAnswer*100/$('div.grade[data-idStudent="'+elem+'"]').length))/100+"%");
    });
});

$(function () {
    $("div.grade").each(function () {
        var gr=$(this).text().split("/");
        for(var i=0; i<gr.length; i++){
            if(gr[i] < 4){
                $(this).css('color', 'red');
                $(this).css('font-weight', 'bolder');
            }
        }
    });
});

$(function () {
    $("div.average").each(function () {
        if(Number($(this).text()) < 4){
            $(this).css('color', 'red');
            $(this).css('font-weight', 'bolder');
        }
    });
});

$(function () {
    $("div.answer").each(function () {
        if(Number($(this).text().substr(0,1))< 5){
            $(this).css('color', 'red');
            $(this).css('font-weight', 'bolder');
        }
    });
});


$(function () {

    $('div').delegate(".grade", "mouseover", function () {
        data_st=$(this).attr('data-idStudent');
        $('div [data-idStudent="'+data_st+'"]').css('background', 'greenyellow');
    });

    $('div').delegate(".grade", "mouseout", function () {
        data_st=$(this).attr('data-idStudent');
        $('div [data-idStudent="'+data_st+'"]').css('background', 'inherit');
    });


});


$(document).ready(function () {

    $("div.grade").each(function () {
        if($(this).text()!=""){
            $(this).append('<div class="triangle-topright"></div>');
        }
    });

    prepod="Пискун Олег Маркович";
    $('div').delegate(".triangle-topright", "mouseover", function () {
        dat=$(this).parent().parent().find('div.date_title').html();//Дата столбца
        console.log(dat+"-"+$("input#idGroup").val()+"-"+$("input#idSubject").val());
        $.ajax({
            type:'get',
            url:'p.php',
            data:{
                'dateLesson':dat,
                'idGroup': $("input#idGroup").val(),
                'idLessons': $("input#idSubject").val()
            },
            success:function () {
                $(this).attr('title',"Преподаватель: "+prepod);
            },
            error: function () {
                $(this).attr('title',"Данные отсутствуют");
            }
        });

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
            case '23':
                return 'Зач.';
                break;
            case '24':
                return 'Незач.';
                break;
            case '25':
                return 'Недоп';
                break;
        }
    }
}

