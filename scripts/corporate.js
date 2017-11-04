//Календарь
$(function () {
    $.datepicker.regional['ru'] = {
        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель',
            'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь',
            'Октябрь', 'Ноябрь', 'Декабрь'],
        dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
        maxDate: 0
    };
    $('.datepicker').datepicker({dateFormat: 'dd.mm.yy', firstDay: 1});
    $.datepicker.setDefaults($.datepicker.regional['ru']);
    //$('.datepicker').mask("99.99.9999");

});

//Горизонтальная прокрутка при кручении колесом
// Функция для добавления обработчика событий
function addHandler(object, event, handler) {
    if (object.addEventListener) {
        object.addEventListener(event, handler, false);
    }
    else if (object.attachEvent) {
        object.attachEvent('on' + event, handler);
    }
    else alert("Обработчик не поддерживается");
}

addHandler(window, 'DOMMouseScroll', wheel);
addHandler(window, 'mousewheel', wheel);
addHandler(document, 'mousewheel', wheel);

function wheel(event) {
    var target=$(event.target);
    if (target.is("div.grade")){
        var curLeft=$(".result_box_statistic").scrollLeft();
        var delta; // Направление колёсика мыши
        event = event || window.event;
        // Opera и IE работают со свойством wheelDelta
        if (event.wheelDelta) { // В Opera и IE
            delta = event.wheelDelta / 120;
            // В Опере значение wheelDelta такое же, но с противоположным знаком
            if (window.opera) delta = -delta; // Дополнительно для Opera
        }
        else if (event.detail) { // Для Gecko
            delta = -event.detail / 3;
        }
        // Запрещаем обработку события браузером по умолчанию
        if (event.preventDefault) event.preventDefault();
        event.returnValue = false;
        //alert(delta); // Выводим направление колёсика мыши
        if(delta==1){
            $(".result_box_statistic").scrollLeft(curLeft+50);
        }
        else if(delta==-1){
            $(".result_box_statistic").scrollLeft(curLeft-50);
        }

    }
}

// функция по отмене возможности "Зач.878787" т е запрет дописывать после вставленного значения
$(function () {
    $('input.inp_cell').mousedown(function(event){
        event.stopPropagation();
        event.preventDefault();
        return false;
    });
});

$(function (event) {
    if(event.keyCode==38 || event.keyCode==40){
        return false;
    }
});


//функция проверки введенных данных в поле оценка
function proverka(event, id) {

    var str_id='inp_'+id;
    var el=document.getElementById(str_id);

    if((event.keyCode==8) || (event.keyCode==27) ) {
        return;
    }
    if(((event.keyCode>=48) && (event.keyCode<=57)) || ((event.keyCode>=96) && (event.keyCode<=105))){

        $(function () {

            if((el.value>10) || (el.value<1)){
                el.value="";
            }
        });
    }
    else if((el.value>10) || (el.value<1)){
        el.value="";
        return false;
    }
    else{
        return false;
    }
}

//Функция по проверке дату на корректность. Запрещено выбирать дату будущего
function checkDate() {
    if($("#lesson-date").val()==""){
        alert("Заполните поле 'Дата'.");
        return false;
    }
    if ($("#lesson-date").val().length == 10) {
        var arrD = $("#lesson-date").val().split(".");
        arrD[1] -= 1;
        var d = new Date(arrD[2], arrD[1], arrD[0]);//0-день 1-месяц 2-год
        if ((d.getFullYear() == arrD[2]) && (d.getMonth() == arrD[1]) && (d.getDate() == arrD[0])) {
            if (arrD[2] < 2017) {
                alert("Скорее всего Вы ошиблись с годом! Проверьте правильность даты.");
                $("#lesson-date").val('');
                return false;
            }

            var newDate=new Date();
            var now=newDate.getDate()+"."+(newDate.getMonth()+1)+"."+newDate.getFullYear();

            if ((arrD[2]>newDate.getFullYear()) || ((arrD[2]>=newDate.getFullYear()) && (arrD[1]>newDate.getMonth()))
                || ((arrD[2]>=newDate.getFullYear()) && (arrD[1]>=newDate.getMonth()) && arrD[0]>newDate.getDate())){
                alert("Введенная Вами дата '"+$("#lesson-date").val()+"' еще не наступила!");
                $("#lesson-date").val('');
                return false;
            }
        }
        else{
            alert("Введена некорректная дата! " + $("#lesson-date").val());
            $("#lesson-date").val('');
            return false;
        }

    }
    else{
        alert("Дата должна быть введена в формате: дд.мм.гггг");
        $("#lesson-date").val('');
        return false;
    }
}


//Функция шифрования расшифрования оценок
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
            case 'Отр.':
                return '27';
                break;

            case 'Н1ч.':
                return '31';
                break;
            case 'Н2ч.':
                return '32';
                break;
            case 'Н3ч.':
                return '33';
                break;
            case 'Н4ч.':
                return '34';
                break;
            case 'Н5ч.':
                return '35';
                break;
            case 'Н6ч.':
                return '36';
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
            case '27':
                return 'Отр.';
                break;

            case '31':
                return 'Н1ч.';
                break;
            case '32':
                return 'Н2ч.';
                break;
            case '33':
                return 'Н3ч.';
                break;
            case '34':
                return 'Н4ч.';
                break;
            case '35':
                return 'Н5ч.';
                break;
            case '36':
                return 'Н6ч.';
                break;

        }
    }

}