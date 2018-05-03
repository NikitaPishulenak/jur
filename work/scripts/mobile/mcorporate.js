$('div').delegate(".triangle-topright", "touchstart", function (e) {
    log_object=$(this).parent();
    if($("#history").is(":visible")){
        showTools(log_object);
        log_object.append('<img src="img/tr.png" class="tr">');
    }

    var stud_id = $(this).parent().attr("data-idStudent");
    var zap_id = $(this).parent().attr("data-zapis");

    var remainder = Number($(window).width() - e.pageX);

    $("#history").css("top", Number($(this).offset().top + 11));//11 размер триугольника
    if (remainder > 290) {
        $("#history").css("left", Number($(this).offset().left + 10));
    }
    else {
        $("#history").css("left", Number($(this).offset().left - 280)); //250- ширина окна логов + 10 в резерв
    }


    $.ajax({
        type: 'get',
        url: 'log.php',
        data: {
            'idStudent': stud_id,
            'idZapis': zap_id,
            'ajaxTrue':"1"
        },
        success: function (st, event) {

            if (st == "Access is denied!") {
                hideHistory();
                alert("Извините, время вашей рабочей сессии истекло. Пожалуйста, закройте браузер и заново авторизуйтесь.");

            }
            else {
                $("#log_text").html(st);
                $("#log_text").find(".gLog").each(function () {
                    var c_g = $(this).html();
                    $(this).html(Decrypt(c_g));
                });
            }

        },
        error: function () {
            alert("Не удалось просмотреть историю изменений!");
        }
    });
    showHistory();

    $(function () {
        $(document).on("touchstart", function (){
            //Если кликаешь по всплывающему окну ничего не пропадет
            if (!$("#history").is(e.target) && $("#history").has(e.target).length === 0) {
                $("img.tr").hide();
                hideHistory();
            }
        });
    });
});