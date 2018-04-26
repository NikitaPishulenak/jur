var edit_dialog, edit_form, edit_grade_flag = 0;

// Долгое нажатие для выставления оценки
$('div').delegate(".grade", "touchstart", function () {
    elGrade=$(this);
    edit_grade_flag = 1;
});
$('div').delegate(".grade","touchend", function () {
    edit_grade_flag = 0;
});
$('div').delegate(".grade","touchmove", function () {
    edit_grade_flag = 0;
});


setInterval(function(){
    if(edit_grade_flag == 1) {
        edit_grade_flag=0;
        create_new_grade(elGrade);
    }
    else{

    }
},1000);


//Редактирование отметки
edit_dialog = $("#form-edit").dialog({
    resizable: false,
    autoOpen: false,
    height: 'auto',
    width: 'auto',
    modal: true

});
edit_form = edit_dialog.find("form").on("submit", function (event) {
    event.preventDefault();
});


function create_new_grade(e) {
    edit_grade_flag = 0;
    var curStatus=e.attr("data-Status");
    $("button#edit").removeAttr('disabled');
    $("button#close").removeAttr('disabled');
    elem = e;

    if(elem.text()!=""){
        var c_res=elem.text().split("/");
        for(var i=0; i<c_res.length; i++){
            if((absenteeisms.indexOf(c_res[i])!=-1) || (absenteeisms_with_cause.indexOf(c_res[i])!=-1) ){
                dat=e.parent().find('div.date_title').html();
                student_id=e.attr('data-idStudent');
                id_Less=e.attr('data-idLes');
                PKE=e.attr('data-PKE');
                id_Zapis=e.attr('data-zapis');

                edit_dialog.dialog("open");
                edit_form[0].reset();

                var data_studentID=e.attr('data-idStudent');
                var fio_stud=$('div.fio_student[data-idStudent="'+data_studentID+'"]').text();
                edit_dialog.dialog({title: fio_stud});

                $("#inp_0").focus().blur();
                $('#inp_2').slideUp(1);
                --countCell;
                $('#inp_1').slideUp(1);
                --countCell;
                cur_grade = e.text();

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

                    $("b.tool").on("touchstart", function (){
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
}
