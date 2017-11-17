$(function () {
    $("div.grade").each(function () {
        if($(this).text()!=""){
            $(this).text(Decrypt($(this).text()));
        }
    });
});

$(function () {
    $("div.statistic").append("<div class='date_col_stat'><div class='title'>Ср. б.</div><div class='average'></div></div>");
    // $("div.statistic").html($r);
    var count=$("div.subject_student").length;
    for(var i=0; i<count; i++){
        data_idS=$(".grade:eq("+i+")").attr('data-idSubject');
        $("div .average:last").append("<div class='avg' data-idSubject='"+data_idS+"'></div>");
    }
    $("div .average:last").append("<div class='avg result_div' id='avg_avrige'></div>");

    $("div.date_col_stat:last").after("<div class='date_col_stat'><div class='title'>% отв.</div><div class='answer'></div></div>");
    for(var i=0; i<count; i++){
        data_idS=$(".grade:eq("+i+")").attr('data-idSubject');
        $("div .answer:last").append("<div class='ans' data-idSubject='"+data_idS+"'></div>");
    }

    $("div.date_col_stat:last").after("<div class='date_col_stat'><div class='title'>Н(ув.)</div><div class='absenteeism'></div></div>");
    for(var i=0; i<count; i++){
        data_idS=$(".grade:eq("+i+")").attr('data-idSubject');
        $("div .absenteeism:last").append("<div class='abs' data-idSubject='"+data_idS+"'></div>");
    }
});

$(function () {
    $("div.avg").each(function () {
        var sum=0,countGrade=0;
        var elem=$(this).attr('data-idSubject');
        $('div.grade[data-idSubject="'+elem+'"]').each(function () {
            var gr=$(this).text().split("/");
            for (var i=0; i<gr.length; i++){
                if(Number(gr[i])){
                    sum+=Number(gr[i]);
                    countGrade++;
                }
            }

        });
        $('div.avg[data-idSubject="'+elem+'"]').html(Math.round(10*(sum/countGrade))/10);
    });

    $("div.ans").each(function () {
        var countAnswer=0;
        var elem=$(this).attr('data-idSubject');
        $('div.grade[data-idSubject="'+elem+'"]').each(function () {
            var gr=$(this).text().split("/");
            if(Number(gr[0])){
                countAnswer++
            }

        });
        $('div.ans[data-idSubject="'+elem+'"]').html(Math.round(100*(countAnswer*100/$('div.grade[data-idSubject="'+elem+'"]').length))/100+"%");
    });

    $("div.abs").each(function () {
        var countAbsenteesm=0, countAbsRespect=0, countAbsUnrespect=0, countAbsFree=0;
        var elem=$(this).attr('data-idSubject');
        $('div.grade[data-idSubject="'+elem+'"]').each(function () {
            var gr=$(this).text().split("/");
            for(i=0; i<gr.length;i++){
                if(gr[i]=="Н" || gr[i]=="Ну"|| gr[i]=="Нб.у"|| gr[i]=="Нб.о."){
                    countAbsenteesm++;
                    if(gr[i]=="Ну"){
                        countAbsRespect++;
                    }
                }
            }
        });
        $('div.abs[data-idSubject="'+elem+'"]').html(countAbsenteesm+"("+countAbsRespect+")");
    });
});

$(function () {
    var avg_sum=0, avg_count=0;
    var count=$("div.avg").length;
    for (var k=0; k<count-1; k++){
        if($("div.avg:eq("+k+")").text()!=""){
            avg_sum+=Number($("div.avg:eq("+k+")").text());
            avg_count++;
        }
    }
    $("div#avg_avrige").html(Math.round(100*(avg_sum/avg_count))/100);
});



//Горизонтальная прокрутка при кручении колесом
document.addEventListener('wheel', function(e){
    el = document.querySelector('div.result_box_statistic');
    if(e.path.indexOf(el)!=-1){
        e.preventDefault();
        var delta=100;
        var curLeft=$(".result_box_statistic").scrollLeft();
        if(e.deltaY==100){
            $(".result_box_statistic").scrollLeft(curLeft+delta);
        }
        else if(e.deltaY==-100){
            $(".result_box_statistic").scrollLeft(curLeft-delta);
        }
    }
}, false);

document.addEventListener('keydown', function(e){

    var val = parseInt(e.key);
    val = (!isNaN(val)) ? val : false;
    if (val !== false){
        if (e.altKey){
            $("#"+id_input).val($("#panel>#"+val).text());
            $("#"+id_input).blur();
        }
    }

    if(e.keyCode==13){
        $("#edit").click();
    }


}, false);



$(function () {
    $('b.tool').mousedown(function(event){
        event.stopPropagation();
        event.preventDefault();
        return false;
    });
});


$(function () {
    $('div .grade').mousedown(function(event){
        event.stopPropagation();
        event.preventDefault();
        return false;
    });


    $('div').delegate(".grade", "mouseover", function () {
        data_st=$(this).attr('data-idSubject');
        $('div [data-idSubject="'+data_st+'"]').addClass("illumination");
    });

    $('div').delegate(".grade", "mouseout", function () {
        data_st=$(this).attr('data-idSubject');
        $('div [data-idSubject="'+data_st+'"]').removeClass("illumination");
    });


});


$(document).ready(function () {
    PopUpHide();


    //Дорисовка триугольника
    // $("div.grade").each(function () {
    //     if($(this).text()!=""){
    //         $(this).append('<div class="triangle-topright"></div>');
    //     }
    // });

    $('div').delegate(".info", "mouseleave", function () {
      PopUpHide();
    });



    $('div').delegate(".info", "mouseover", function (e) {

        var id_Zap=$(this).closest("div .grade").attr('data-zapis');
        $("#window-popup").css("left",Number(e.pageX+15));
        $("#window-popup").css("top",Number(e.pageY+10));
        PopUpShow();


    });

});
function Encrypt(value) {
    var res = "";
    var grade = value.split("/");
    for (i = 0; i < grade.length; i++) {
        res += MatchEncrypt(grade[i]);
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
    // alert(res);
    return res;
}
function MatchEncrypt(val) {

    if (val>=1 && val<=10){
        return Number(val)+9;
    }
    else{
        switch (val) {
            case 'Ну':
                return '20';
                break;
            case 'Нб.у':
                return '21';
                break;
            case 'Нб.о.':
                return '22';
                break;
            case 'Зач.':
                return '23';
                break;
            case 'Незач.':
                return '24';
                break;
            case 'Недоп':
                return '25';
                break;
            case 'Н':
                return '26';
                break;
        }
    }

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
            case '26':
                return 'Н';
                break;
        }
    }

}

//Функция отображения PopUp
function PopUpShow(){
    $("#window-popup").show();
}
//Функция скрытия PopUp
function PopUpHide(){
    $("#window-popup").hide();
}

