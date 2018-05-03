//Функция выделения серым цветом поля, где есть Н без причины
$(function () {
    $("div.grade").each(function () {
        if($(this).text()!=""){
            $(this).html(Decrypt($(this).text()));
        }
        var c_res=$(this).text().split("/");
        for (var i=0; i<c_res.length; i++) {
            if(absenteeisms.indexOf(c_res[i])!=-1){
                $(this).addClass("undef");
            }
        }
    });
});


//Функции вычисления статистики
$(function () {
    $("div.statistic").append("<div class='date_col_stat'></div>");
    var count=$("div.fio_student").length;

    $("div.date_col_stat:last").after("<div class='date_col_stat'><div class='title'>Н(ув.)</div><div class='absenteeism'></div></div>");
    for(var i=0; i<count; i++){
        data_idS=$(".grade:eq("+i+")").attr('data-idStudent');
        $("div.absenteeism:last").append("<div class='abs' data-idStudent='"+data_idS+"'></div>");
    }
});

$(function () {
    $("div.abs").each(function () {
        var elem = $(this).attr('data-idStudent');
        generateAbs(elem);
    });
});


$(function () {
    var  form, edit_dialog, edit_form;
    var myStudentId = new Array();
    var myStudentZapis = new Array();


    //Форма редактирования оценки
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


    $('div').delegate(".grade", "dblclick", function () {
        var curStatus=$(this).attr("data-Status");
        $("button#edit").removeAttr('disabled');
        $("button#close").removeAttr('disabled');
        elem=0;
        elem = $(this);

        if(elem.text()!=""){
            var c_res=elem.text().split("/");
            for(var i=0; i<c_res.length; i++){
                if((absenteeisms.indexOf(c_res[i])!=-1) || (absenteeisms_with_cause.indexOf(c_res[i])!=-1) ){
                    dat=$(this).parent().find('div.date_title').html();//Дата столбца
                    student_id=$(this).attr('data-idStudent');
                    id_Less=$(this).attr('data-idLes');
                    PKE=$(this).attr('data-PKE');
                    id_Zapis=$(this).attr('data-zapis');

                    edit_dialog.dialog("open");
                    edit_form[0].reset();

                    var data_studentID=$(this).attr('data-idStudent');
                    var fio_stud=$('div.fio_student[data-idStudent="'+data_studentID+'"]').text();
                    edit_dialog.dialog({title: fio_stud});

                    $("#inp_0").focus().blur();
                    $('#inp_2').slideUp(1);
                    --countCell;
                    $('#inp_1').slideUp(1);
                    --countCell;
                    cur_grade = $(this).text();

                    grades = cur_grade.split("/");
                    switch (curStatus) {
                        case "0":
                            for (var i = 0; i < grades.length; i++) {
                                $("div.panel").find('input#inp_' + i).slideDown(1);
                                $("div.panel").find('input#inp_' + i).val(grades[i]);
                            }
                        break;

                        case "1": //тоже самое
                            for (var i = 0; i < grades.length; i++) {
                                $("div.panel").find('input#inp_' + i).slideDown(1);
                                $("div.panel").find('input#inp_' + i).val(grades[i]);
                            }
                        break;
                    }
                    
                    inp_id=-1;
                    $(".inp_cell:text").focus(function () {
                        inp_id = $(this).attr('id');

                        $("b.tool").click(function () {
                            var text = $(this).text();
                            $("#"+inp_id+":enabled").val(text);
                            $("#"+inp_id).blur();
                        });
                    });
                    var countOpenCell = 0, enabled=false;
                    for (j = 0; j < 3; j++) {
                        $("#inp_" + j).removeAttr('disabled');
                        if ($("#inp_" + j).val() != "") {
                            countOpenCell++;
                            if((absenteeisms.indexOf($("#inp_" + j).val())==-1) && (absenteeisms_with_cause.indexOf($("#inp_" + j).val())==-1)){
                                $("#inp_" + j).attr('disabled', 'disabled');
                            }
                            else if (!enabled){
                                $("#inp_" + j).focus();
                                enabled=true;
                            }
                        }
                    }

                    var absenteeism = /\w/;
                    $(".inp_cell:text").keydown(function (event) {
                        if (event.keyCode == 8 || event.keyCode == 46) {   //если это удаление
                            if (!absenteeism.test(this.value)) {
                                $(this).val("")
                            }
                        }
                    });
                }
            }
        }
    });

    $("#edit").click(function () {
        var coding = "";
        var cur_res = $("#inp_0").val();
        coding = Encrypt(cur_res);
        elem.html(lowIndex(cur_res));
        smallText(elem);

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
                    'grades': coding,
                    'ajaxTrue':"1"
                },
                success:function (st) {
                    if (st=="Access is denied!"){
                        alert("Извините, время вашей рабочей сессии истекло. Пожалуйста, закройте браузер и заново авторизуйтесь.");
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
        ShowLogTools();
        generateAbs(student_id);
        illuminationAbs(elem);
    });
    $(".inp_cell:text").click(function () {
        $(this).select();
    });
    $("#close").click(function () {
        edit_dialog.dialog("close");
    });
});


$(document).ready(function () {

    countCell = 1;
    groupNumber="";
    subject="";
    teacher="";
    dateLesson=$("div.date_title:last").val();
    idLesson="";

    if (is_touch_device()) {
        $.getScript('scripts/mobile/mscriptDecLec.js', function(){});
    }

});
