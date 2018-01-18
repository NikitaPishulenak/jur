$(document).ready(function () {

    var idStudent=$("input#idStudent").val();
    var idSubject="";
    var subjDivWidth=$("div.DialogFakFak").width();

    $("div.DialogFakFak").click(function () {
        var obj_tsis_contentGrade=$(this).find(".content_grade");
        if(obj_tsis_contentGrade.is(':hidden')){
            //alert("h");
            if($(".content_grade").is(':visible')){
                //alert("any v");
                $(".content_grade").not(obj_tsis_contentGrade).hide();
                $(".fullText").not($(this).find(".fullText")).hide();
                $(".shortText").not($(this).find(".shortText")).show();
                $(".DialogFakFak").animate({width: "150px"}, 400);
            }
            idSubject=$(this).attr('data-idSubject');
            $(this).animate({width: "97%"}, 400);
            $(this).find(".shortText").hide();
            $(this).find(".fullText").show();
            obj_tsis_contentGrade.show();

            //alert(idStudent+"-"+idSubject);

            $.ajax({
                type: 'get',
                url: 'view.php',
                data: {
                    'idStudent': idStudent,
                    'idSubject': idSubject
                },
                success: function (response) {
                    obj_tsis_contentGrade.html(response);

                },
                error: function () {
                    alert("Не удалось отразить оценки!");
                }
            });
        }
        else if(obj_tsis_contentGrade.is(':visible')){
            //alert("v");
            obj_tsis_contentGrade.hide();
            $(this).find(".fullText").hide();
            $(this).find(".shortText").show();
            $(this).animate({width: subjDivWidth}, 400);
        }

    });
});