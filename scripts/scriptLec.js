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
    var dialog, form, edit_dialog, edit_form;
    function addLesson() {
        if ($("#lesson-date").val() == "")
            alert("Для сохранения необходимо заполнить поле 'Дата'");
        else {
            var dateLesson = $("#lesson-date").val();
            var cnt = $("div.container-list").find("div.fio_student").length;
            $.ajax({
                type:'post',//тип запроса: get,post либо head
                url:'ajax.php',//url адрес файла обработчика
                data:{'dateLesson':dateLesson, 'idGroup': $("input#idGroup").val(),'idSubject': $("input#idSubject").val(),'typeLesson':"1",'idLesson': $("input#idLesson").val()},//параметры запроса
                response:'text',//тип возвращаемого ответа text либо xml
                success:function (data,status) {//возвращаемый результат от сервера
                    // $$('result',$$('result').innerHTML+'<br />'+data);
                    if(status=="1"){
                        alert("Возможно, колонка с указанной датой уже была создана! Редактируйте существующую или создайте с новой датой!");
                    }
                    else if (status=="2"){
                        alert("Закройте, пожалуйста, окно и авторизуйтесь заново!");
                    }
                    else{
                        $("<div class='date_col'><div class='date_title'>" + dateLesson + "</div></div>").insertAfter('div.date_col:last');
                        for (var i = 0; i < cnt; i++) {
                            $("div.date_col:last").append("<div class='grade' data-hover="+(i+1)+"></div>");
                        }
                    }

                }
            });
            // console.log(dateLesson);
            dialog.dialog("close");
        }
    }
    dialog = $("#form-lesson").dialog({
        resizable:false,
        autoOpen: false,
        height: 'auto',
        width: 'auto',
        modal: true,
        buttons: {
            "Создать": addLesson,
            Отмена: function () {
                dialog.dialog("close");
            }
        },
        close: function () {
            form[0].reset();
        }
    });
    form = dialog.find("form").on("submit", function (event) {
        event.preventDefault();
    });
    edit_dialog = $("#form-edit").dialog({
        resizable:false,
        autoOpen: false,
        height: 'auto',
        width: 'auto',
        modal: true
    });
    edit_form = edit_dialog.find("form").on("submit", function (event) {
        event.preventDefault();
    });

    $('div').delegate(".grade", "mouseover", function () {
        data_hover=$(this).attr('data-hover');
        $('div [data-hover="'+data_hover+'"]').css('background', 'greenyellow');
    });
    $('div').delegate(".grade", "mouseout", function () {
        data_hover=$(this).attr('data-hover');
        $('div [data-hover="'+data_hover+'"]').css('background', 'inherit');
    });

    $('div').delegate(".grade", "dblclick", function () {
        dat=$(this).parent().find('div.date_title').html();//Дата столбца
        //console.log(dat);
        student_id=$(this).attr('data-idStudent');
        edit_dialog.dialog("open");
        edit_form[0].reset();
        $("#inp_0").focus();
        cur_grade = $(this).text();
        elem = $(this);
        grades = cur_grade.split("/");
        for (var i = 0; i < grades.length; i++) {
            $("div.panel").find('input#inp_' + i).slideDown(1);
            $("div.panel").find('input#inp_' + i).val(grades[i]);
        }
        $('input#inp_0').focus();
        $('input#inp_0').select();
        $(".inp_cell:text").focus(function () {
            inp_id = $(this).attr('id');

            $("b#1").click(function(){
                $("#" + inp_id).val("Ну");
            });
            $("b#2").click(function(){
                $("#" + inp_id).val("Нб.у");
            });
            $("b#3").click(function(){
                $("#" + inp_id).val("Нб.о.");
            });
        });
        var absenteeisms = /\w/;
        $(".inp_cell:text").keydown(function (event) {
            if (event.keyCode == 8 || event.keyCode == 46) {	//если это удаление
                if (!absenteeisms.test(this.value)) {
                    $(this).val("")
                }
            }
        });
    });
    $("#edit").click(function () {
        var coding = "";
        //alert(student_id);

        var cur_res = $("#inp_0").val();
        //alert(cur_res);
        coding = Encrypt(cur_res);
        elem.text(cur_res);

        if((cur_grade=="") && (cur_res!="")){
            $.ajax({
                type:'post',//тип запроса: get,post либо head
                url:'ajax.php',//url адрес файла обработчика
                data:{'dateLes': dat,'typeProcedure': "ADD",'idStudent': student_id, 'grades': coding},//параметры запроса'grades': coding,
                response:'text',//тип возвращаемого ответа text либо xml
                success:function (data, status) {//возвращаемый результат от сервера
                    // $$('result',$$('result').innerHTML+'<br/>'+data);
                    if (status=="2"){
                        alert("Закройте, пожалуйста, окно и авторизуйтесь заново!");
                    }
                }
            });
        }
        else{
            $.ajax({
                type:'post',//тип запроса: get,post либо head
                url:'ajax.php',//url адрес файла обработчика
                data:{'dateLes': dat,'typeProcedure': "UPDATE",'idStudent': student_id, 'grades': coding},//параметры запроса'grades': coding,
                response:'text',//тип возвращаемого ответа text либо xml
                success:function (data, status) {//возвращаемый результат от сервера
                    // $$('result',$$('result').innerHTML+'<br/>'+data);
                    if (status=="2"){
                        alert("Закройте, пожалуйста, окно и авторизуйтесь заново!");
                    }
                }
            });
        }
        // console.log(coding);
        // console.log(dat);
        // console.log(student_id);
        edit_dialog.dialog("close");
    });
    $(".inp_cell:text").click(function () {
        $(this).select();
    });
    $("#create_lesson").button().on("click", function () {
        dialog.dialog("open");
    });

});

$(document).ready(function () {
    countCell = 1;
    groupNumber="";
    subject="";
    teacher="";
    dateLesson=$("div.date_title:last").val();
    idLesson="";

    $("#lesson-date").change(function () {
        if ($("#lesson-date").val().length == 10) {
            var arrD = $("#lesson-date").val().split(".");
            arrD[1] -= 1;
            var d = new Date(arrD[2], arrD[1], arrD[0]);
            if ((d.getFullYear() == arrD[2]) && (d.getMonth() == arrD[1]) && (d.getDate() == arrD[0])) {
                if ((arrD[2] > 2016) && (arrD[2]) < 2030) {
                    return true;
                }
                else {
                    alert("Проверьте правильность введенного значения года!");
                    $("#lesson-date").val('');
                    return false;
                }
            } else {
                alert("Введена некорректная дата! " + $("#lesson-date").val());
                $("#lesson-date").val('');
                return false;
            }
        }
        else {
            alert("Дата должна быть введена в формате: дд.мм.гггг");
            return false;
        }
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
    //alert(res);
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
        }
    }

}

//        var s="262524232221201113182527"; //пробую расшифровать
//        alert(Decrypt(s));