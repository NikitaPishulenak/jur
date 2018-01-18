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