function proverka(event, id) {

    $(function () {
        el=$("#inp_"+id).val();
        if((el>10) ||(el<1)){
            $("#inp_"+id).val("");
        }
    });

    if((event.keyCode==8) || (event.keyCode==27) ) {
        return;
    }

    if (!isNaN(parseInt(event.key))) return;
    return false;
}


$(function () {
    $("input.inp_cell").focus(function () {
        id_input=$(this).attr('id');
    });
});

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
    $("div.grade").each(function () {
        if($(this).text()!=""){
            $(this).text(Decrypt($(this).text()));
        }
        if($(this).text()=="Н"){
            $(this).addClass("undef");
        }
    });
});

$(function () {
    $("div.statistic").append("<div class='date_col_stat'><div class='title'>Ср. б.</div><div class='average'></div></div>");
    // $("div.statistic").html($r);
    var count=$("div.fio_student").length;
    for(var i=0; i<count; i++){
        data_idS=$(".grade:eq("+i+")").attr('data-idStudent');
        $("div .average:last").append("<div class='avg' data-idStudent='"+data_idS+"'></div>");
    }
    $("div .average:last").append("<div class='avg result_div' id='avg_avrige'></div>");

   $("div.date_col_stat:last").after("<div class='date_col_stat'><div class='title'>% отв.</div><div class='answer'></div></div>");
    for(var i=0; i<count; i++){
        data_idS=$(".grade:eq("+i+")").attr('data-idStudent');
        $("div .answer:last").append("<div class='ans' data-idStudent='"+data_idS+"'></div>");
    }

    $("div.date_col_stat:last").after("<div class='date_col_stat'><div class='title'>Н(уваж.)</div><div class='absenteeism'></div></div>");
    for(var i=0; i<count; i++){
        data_idS=$(".grade:eq("+i+")").attr('data-idStudent');
        $("div .absenteeism:last").append("<div class='abs' data-idStudent='"+data_idS+"'></div>");
    }
});





$(function () {
    $("div.avg").each(function () {
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
        $('div.avg[data-idStudent="'+elem+'"]').html(Math.round(10*(sum/countGrade))/10);
    });
    $("div.ans").each(function () {
        var countAnswer=0;
        var elem=$(this).attr('data-idStudent');
        $('div.grade[data-idStudent="'+elem+'"]').each(function () {
            var gr=$(this).text().split("/");
                if(Number(gr[0])){
                    countAnswer++
            }

        });
        $('div.ans[data-idStudent="'+elem+'"]').html(Math.round(100*(countAnswer*100/$('div.grade[data-idStudent="'+elem+'"]').length))/100+"%");
    });

    $("div.abs").each(function () {
        var countAbsenteesm=0, countAbsRespect=0;
        var elem=$(this).attr('data-idStudent');
        $('div.grade[data-idStudent="'+elem+'"]').each(function () {
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
        $('div.abs[data-idStudent="'+elem+'"]').html(countAbsenteesm+"("+countAbsRespect+")");
    });
});


$(function () {
    $("div.avg").each(function () {
        if(Number($(this).text()) < 4){
            $(this).addClass("fail");
        }
    });
});

$(function () {
    $("div.ans").each(function () {
        if(Number($(this).text().substr(0,$(this).text().length-1))< 50){
            $(this).addClass("fail");
        }
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

$(function () {
    $.datepicker.regional['ru'] = {
        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель',
            'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь',
            'Октябрь', 'Ноябрь', 'Декабрь'],
        dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб']
    };
    $('.datepicker').datepicker({dateFormat: 'dd.mm.yy', firstDay: 1});
    $.datepicker.setDefaults($.datepicker.regional['ru']);
    $('.datepicker').mask("99.99.9999");
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

// $(function () {
//     $("div.grade").each(function () {
//         var gr=$(this).text().split("/");
//         for(var i=0; i<gr.length; i++){
//             if(gr[i] < 4){
//                 $(this).addClass("fail");
//             }
//         }
//
//     });
// });

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

    var  form, edit_dialog, edit_form, log_dialog, log_form;
    var myStudentId = new Array();
    var myStudentZapis = new Array();


    edit_dialog = $("#form-edit").dialog({
        resizable:false,
        autoOpen: false,
        height: 'auto',
        width: 300,
        modal: true
    });
    edit_form = edit_dialog.find("form").on("submit", function (event) {
        event.preventDefault();
    });

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

    $('div').delegate(".grade", "mouseover", function () {
        data_st=$(this).attr('data-idStudent');
        $('div [data-idStudent="'+data_st+'"]').addClass("illumination");
    });

    $('div').delegate(".grade", "mouseout", function () {
        data_st=$(this).attr('data-idStudent');
        $('div [data-idStudent="'+data_st+'"]').removeClass("illumination");
    });

    $('div').delegate(".grade", "dblclick", function () {
        $("button#edit").removeAttr('disabled');
        $("button#close").removeAttr('disabled');
        elem = $(this);

        if(elem.text()!=""){
            if((elem.text().indexOf('Ну')!=-1)||(elem.text().indexOf('Нб.у')!=-1)||(elem.text().indexOf('Нб.о.')!=-1) || (elem.text().indexOf('Н')!=-1)){
                dat=$(this).parent().find('div.date_title').html();//Дата столбца
                student_id=$(this).attr('data-idStudent');
                id_Less=$(this).attr('data-idLes');
                PKE=$(this).attr('data-PKE');
                id_Zapis=$(this).attr('data-zapis');

                edit_dialog.dialog("open");
                edit_form[0].reset();
                $("#inp_0").focus().blur();
                $('#inp_2').slideUp(1);
                --countCell;
                $('#inp_1').slideUp(1);
                --countCell;
                cur_grade = $(this).text();

                grades = cur_grade.split("/");
                for (var i = 0; i < grades.length; i++) {
                    $("div.panel").find('input#inp_' + i).slideDown(1);
                    $("div.panel").find('input#inp_' + i).val(grades[i]);
                }
                inp_id=-1;
                // $('input#inp_0').focus();
                // $('input#inp_0').select();
                $(".inp_cell:text").focus(function () {
                    inp_id = $(this).attr('id');

                    //При нажатии на кнопку с результатами текст выводится в поле ввода
                    $("b.tool").click(function () {
                        var text = $(this).text();
                        $("#"+inp_id).val(text);
                    });
                });
                var countOpenCell = 0, enabled=false;
                for (j = 0; j < 3; j++) {
                    $("#inp_" + j).removeAttr('disabled');
                    if ($("#inp_" + j).val() != "") {
                        countOpenCell++;
                        if(($("#inp_" + j).val()!='Ну')&&($("#inp_" + j).val()!='Нб.у') && ($("#inp_" + j).val()!='Нб.о.') && ($("#inp_" + j).val()!='Н')){
                        // if(($("#inp_" + j).val()!='Ну')&&($("#inp_" + j).val()!='Нб.у') && ($("#inp_" + j).val()!='Нб.о.')){//условие на случай изменения только причинных отсутствий

                            $("#inp_" + j).attr('disabled', 'disabled');
                            // $("#inp_" + j).hide(1);
                        }
                        else if (!enabled){
                            $("#inp_" + j).focus();
                            enabled=true;
                        }
                    }
                }

                var absenteeisms = /\w/;
                $(".inp_cell:text").keydown(function (event) {
                    if (event.keyCode == 8 || event.keyCode == 46) {   //если это удаление
                        if (!absenteeisms.test(this.value)) {
                            $(this).val("")
                        }
                    }
                });
            }


        }
    });

    $("#edit").click(function () {

        var coding = "";
        var bit1 = $("#inp_0").val();
        var bit2 = $("#inp_1").val();
        var bit3 = $("#inp_2").val();
        bit1 = (bit1 == "") ? "" : bit1;
        bit2 = (bit2 == "") ? "" : "/" + bit2;
        bit3 = (bit3 == "") ? "" : "/" + bit3;
        var cur_res = bit1 + bit2 + bit3;
        coding = Encrypt(cur_res);
        elem.text(cur_res);

        if(id_Zapis == 0 && myStudentZapis[id_Less+'Zapis'+student_id]==0){
            alert("�_�_�_из�_�_�>а �_�_и�+ка п�_и п���_���_а�+�� �_а�_�_�<�:");
        }else{
            if(id_Zapis == 0) id_Zapis = myStudentZapis[id_Less+'Zapis'+student_id];
            $.ajax({
                type:'get',
                url:'d.php',
                data:{
                    'id_Zapis': id_Zapis,
                    'dateLes': dat,
                    'idStudent': student_id,
                    'idPrepod': $("input#idPrepod").val(),
                    'menuactiv': "editLessonStudent",
                    'grades': coding
                },
                success:function (st) {
                    if (st=="Access is denied!"){
                        alert("Доступ запрещен!");
                    }
                    else if (st=="No access rights!"){
                        alert("Не достаточно прав!");
                    }
                },
                error: function () {
                    alert("Произошла ошибка при передаче данных");
                }
            });
        }

        inp_id=2;

        $("button#edit").attr('disabled', true);
        $("button#close").attr('disabled', true);
        edit_dialog.dialog("close");
    });
    $("#close").click(function () {
        edit_dialog.dialog("close");
    });
    $(".inp_cell:text").click(function () {
        $(this).select();
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


});


$(document).ready(function () {
    PopUpHide();


    //Дорисовка триугольника
    $("div.grade[data-Log='1']").each(function () {
        $(this).append('<div class="triangle-topright"></div>');
    });
    // $("div.grade").each(function () {
    //     if($(this).text()!=""){
    //         $(this).append('<div class="triangle-topright"></div>');
    //     }
    // });


    // //оказать-скрыть блок при наведении на треугольник
    //
    // $('div').delegate(".triangle-topright", "mouseleave", function () {
    //     PopUpHide();
    // });
    //
    // $('div').delegate(".triangle-topright", "mouseover", function (e) {
    //
    //     var id_Zap=$(this).closest("div .grade").attr('data-zapis');
    //     $("#window-popup").css("left",Number(e.pageX+15));
    //     $("#window-popup").css("top",Number(e.pageY+10));
    //     PopUpShow();
    //
    //     $.ajax({
    //         type:'get',
    //         url:'d.php',
    //         data:{
    //             'id_Zapis':id_Zap,
    //             'idGroup': $("input#idGroup").val()
    //         },
    //         success:function (info) {
    //             $(".loader").hide();
    //             $(".popup-content").text(info);
    //         },
    //         error: function () {
    //             $(".popup-content").text("Данные отсутствуют!");
    //         }
    //     });
    //
    // });


    countCell = 1;
    groupNumber="";
    subject="";
    teacher="";
    dateLesson=$("div.date_title:last").val();
    idLesson="";

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

