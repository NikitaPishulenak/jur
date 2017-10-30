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
    $('.datepicker').mask("99.99.9999");
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

    if((event.keyCode==8) || (event.keyCode==27) ) {
        return;
    }
    if(((event.keyCode>=48) && (event.keyCode<=57)) || ((event.keyCode>=96) && (event.keyCode<=105))){

        $(function () {
            var str_id='inp_'+id;
            var el=document.getElementById(str_id);
            if((el.value>10) || (el.value<1)){
                el.value="";
            }
        });
    }
    else{
        return false;
    }
}
