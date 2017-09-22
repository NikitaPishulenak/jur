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
        $('div.average[data-idSubject="'+elem+'"]').html(Math.round(10*(sum/countGrade))/10);
    });
    $("div.answer").each(function () {
        var countAnswer=0;
        var elem=$(this).attr('data-idSubject');
        $('div.grade[data-idSubject="'+elem+'"]').each(function () {
            var gr=$(this).text().split("/");
            if(Number(gr[0])){
                countAnswer++
            }

        });
        $('div.answer[data-idSubject="'+elem+'"]').html(Math.round(100*(countAnswer*100/$('div.grade[data-idSubject="'+elem+'"]').length))/100+"%");
    });

    $("div.absenteeism").each(function () {
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
                    // if(gr[i]=="Нб.у"){
                    //     countAbsUnrespect++;
                    // }
                    // if(gr[i]=="Нб.о."){
                    //     countAbsFree++;
                    // }
                }
            }
        });
        $('div.absenteeism[data-idSubject="'+elem+'"]').html(countAbsenteesm+"("+countAbsRespect+")");
    });
});


var wDelta = 120;
function scrollDoc(e) {
    if (!e) e = event;
    if (e.preventDefault) { e.preventDefault(); } else { e.returnValue = false; }
    var __delta = e.wheelDelta || -e.detail;
    __delta /= Math.abs(__delta);
    document.documentElement.scrollLeft -= __delta * wDelta; // FF, Opera, IE
    if (this.attachEvent) return false;
    document.body.scrollLeft -= __delta * wDelta; // Chrome
}
window.onload = function() {
        var html = document.documentElement;
        if (html.attachEvent) {
            html.attachEvent("onmousewheel", scrollDoc); // IE and Opera
        } else {
            html.addEventListener("DOMMouseScroll", scrollDoc, false); // FF
            html.addEventListener("mousewheel", scrollDoc, false); // Chrome
        }
    }


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

