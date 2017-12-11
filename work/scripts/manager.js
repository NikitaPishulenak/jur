function showSub() {
    var id_faculty = $('select[name="faculty"]').val();
    var id_course = $('select[name="course"]').val();
    if((id_faculty!="") && (id_course!="")){
        $.ajax({
            type: "GET",
            url: "../ajax.manager.php",
            data: {
                action: 'showSubjectsFromDB',
                id_faculty: id_faculty,
                id_course: id_course
            },
            cache: false,
            success: function(responce){
                $('div#subjects').html(responce);
            }
        });

    }
    else {
        alert("Для получения списка предметов необходимо выбрать факультет и/или курс!");
    }
}

$(function () {
    $("td.sub").each(function () {
        $(this).append('<img src="img/close.png" class="close" title="Удалить дисциплину из БД">');
        $(this).hide();
    });
   $("td").delegate(".sub", "mouseover", function () {
       $(this).find("img.close").show();
   });
    $("td").delegate(".sub", "ouseout", function () {
        $(this).find("img.close").hide();
    });
});
